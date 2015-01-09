<?php
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php"); 
	include_once("../lib/Zebra_Pagination.php"); 
	
	
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	} 
	$db = Database::GetDatabase(); 
	if ($_GET['act']=="del")
	{
		$db->Delete("goods"," id",$_GET["did"]);		
		header('location:editproduce.php?act=new');	
	}		
    
$html.=<<<cd
<style>
#contents { 
    background-color:#fff;
    border-radius:15px;
    color:#000;
    display:none; 
    padding:20px;
    min-width:400px;
    min-height: 180px;
}
.b-close{
    cursor:pointer;
    position:absolute;
    right:10px;
    top:5px;
}

} 
</style>
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ویرایش محصولات</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">ویرایش محصولات</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">لیست محصولات</h3>
                                </div>
                                <div class="panel-body">
                                    <!--Table Wrapper Start-->
                                    <div class="table-responsive ls-table">
                                        <div id="ls-editable-table_filter" class="dataTables_filter">
                                            <label>جستجو:<input type="search" class="" aria-controls="ls-editable-table"></label>
                                        </div>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
											<th>#</th>
												<th>کد قطعه</th>
                                                <th>عنوان محصول</th>                                                                                                
                                                <th>برند</th>
                                                <th>گروه</th>
												<th>کیفیت</th>                              
                                                <th>قیمت محصول</th>
                                                <th>موجودی</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
cd;

	$records_per_page = 10;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	$reccount = $db->CountAll("goods");
	$pagination->records($reccount); 
	
    $pagination->records_per_page($records_per_page);	

$rows = $db->SelectAll(
				"goods",
				"*",
				NULL,
				"id ASC",
				($pagination->get_page() - 1) * $records_per_page,
				$records_per_page);
				
	
$vals = array();
for($i = 0; $i < Count($rows); $i++)
{
	$rownumber = $i+1;
	$rows[$i]["name"] =(mb_strlen($rows[$i]["name"])>30)?mb_substr($rows[$i]["name"],0,30,"UTF-8")."...":$rows[$i]["name"];
	$brand=$db->Select("brands","name","id='{$rows[$i]["bid"]}'",NULL);
	$group=$db->Select("groups","name","id='{$rows[$i]["gid"]}'",NULL);		
	$quality=$db->Select("quality","name","id='{$rows[$i]["qid"]}'",NULL);		
	$rows[$i]["bid"] = $brand[0];
	$rows[$i]["gid"] = $group[0];
	$rows[$i]["qid"] = $quality[0];

$html.=<<<cd

                                                
                                            <tr>
                                                <td>{$rownumber}</td>
												<td>{$rows[$i]["code"]}</td>
                                                <td>{$rows[$i]["name"]}</td>
												<td>{$rows[$i]["bid"]}</td>
												<td>{$rows[$i]["gid"]}</td>
												<td>{$rows[$i]["qid"]}</td>
												<td>
													<a href="#" class="price" name="{$rows[$i][id]}">...</a>
													<div id="contents" class="content" style="display:none;">
													<a class="b-close">x<a/>
													</div>
													 
												</td>
												<td>
												<a href="#" class="price" name="{$rows[$i][id]}" id="mojodi">...</a>
												<div id="contents" class="content" style="display:none;">
													<a class="b-close">x<a/>
													</div>
												</td>
                                                <td class="text-center">
    												<a href="addproduce.php?act=edit&did={$rows[$i]["id"]}"  >					
                                                        <button class="btn btn-xs btn-warning" title="ویرایش"><i class="fa fa-pencil-square-o"></i></button>
    												</a>
    												<a href="?act=del&did={$rows[$i]["id"]}"  >												
                                                        <button class="btn btn-xs btn-danger" title="پاک کردن"><i class="fa fa-minus"></i></button>
    												</a>	
                                                </td>
                                            </tr>
cd;
}

	$pgcodes = $pagination->render(true);
	//var_dump($pagination);
$html.=<<<cd
                                            </tbody>
                                        </table>
                                    </div>
									{$pgcodes}
                                    <!--Table Wrapper Finish-->                                    
                                </div>
                            </div>
                        </div>
                    </div>           
                <!-- Main Content Element  End-->
            </div>
        </div>
    </section>
    <!--Page main section end -->
	<script type="text/javascript">
		$(document).ready(function(){
		 $(function() {           
            $('.price').bind('click', function(e) {			
                e.preventDefault();
				var id = $(this).attr("name");				
		     $('#contents').bPopup({					
				// content:'ajax',
                 //   contentContainer:'.content',
                    loadUrl: 'goodsinfos.php?pm='+id
                });	
            });

        });
			
		});			
	</script>	
cd;
	include_once("./inc/header.php");
	echo $html;
    include_once("./inc/footer.php");
?>