<?php
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php"); 

	$login = Login::GetLogin();
    if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();	
	
	if ($_POST["mark"]=="saveqty")
	{
		$fields = array("`name`");		
		$values = array("'{$_POST[edtname]}'");	
		if (!$db->InsertQuery('quality',$fields,$values)) 
		{			
			header('location:addquality.php?act=new&msg=2');			
		} 	
		else 
		{  										
			header('location:addquality.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="editqty")
	{			    
		$values = array("`name`"=>"'{$_POST[edtname]}'");
		$db->UpdateQuery("quality",$values,array("id='{$_GET[qid]}'"));		
		header('location:addquality.php?act=new&msg=1');
	}	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='saveqty' /> ";
	}
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("quality","*","id='{$_GET[qid]}'",NULL);		
		$insertoredit = "
			<button type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editqty' /> ";
	}
	if ($_GET['act']=="del")
	{
		$db->Delete("quality"," id",$_GET["qid"]);		
		header('location:addquality.php?act=new');	
	}	
$msgs = GetMessage($_GET['msg']);

$html=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">تعریف نوع کیفیت محصولات</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">نوع کیفیت محصولات</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">نوع کیفیت محصولات</h3>
                            </div>
                            <div class="panel-body">
                                <form name="frmcat" action="" method="post" class="form-inline ls_form" role="form">
                                    <div class="form-group">
                                        <input id="edtname" name="edtname" type="text" class="form-control" placeholder="نوع کیفیت" value="{$row['name']}"/>
                                    </div>
                                    {$insertoredit}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
							<div class="panel-heading">
                                <h3 class="panel-title">لیست کیفیت محصولات</h3>
                            </div>
							 <div class="panel-body">
							 <!--Table Wrapper Start-->
							 <div class="table-responsive ls-table">
							 <table class="table">
								<thead>
									<tr>
										<th>ردیف</th>
										<th>نوع کیفیت</th>
										<th>عملیات</th>
									</tr>
								</thead>
								<tbody>
								<tr>
cd;
$rows = $db->SelectAll("quality","*",NULL,"id ASC");
for($i = 0; $i < Count($rows); $i++)
{
$rownumber = $i+1;
$html.=<<<cd
	<td>{$rownumber}</td>
	<td>{$rows[$i]["name"]}</td>
	<td>
		<ul class="ls-glyphicons-list">
			<li>
				<a href="?act=del&qid={$rows[$i]["id"]}" title="پاک کردن" style="margin-left:5px"><span class="glyphicon glyphicon-remove"></span></a>
				<a href="?act=edit&qid={$rows[$i]["id"]}" title="ویرایش"><span class="glyphicon glyphicon-edit"></span></a>
			</li>
		</ul>
	</td>
</tr>
cd;
}
$html.=<<<cd
</tbody>
</table>
</div>
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
cd;
	include_once("./inc/header.php");
	echo $html;
	include_once("./inc/footer.php");
?>