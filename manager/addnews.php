<?php
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");
	
	$imgload="";
	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
	
	
	if ($_POST["mark"]=="savenews")
	{
		
		$date = date('Y-m-d H:i:s');
		$fields = array("`gid`","`smid`","`subject`","`text`","`regdate`","`picid`");		
		$values = array("'{$grp}'","'{$sm}'","'{$_POST[edtsubject]}'","'{$_POST[edttext]}'","'{$date}'","'0'");	
		if (!$db->InsertQuery('news',$fields,$values)) 
		{			
			header('location:addnews.php?act=new&msg=2');			
		} 	
		else 
		{  		
			$did = $db->InsertId();
				header('location:addnews.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="editnews")
	{		
		
		$values = array("`gid`"=>"'{$_POST[cbgroup]}'","`smid`"=>"'{$sm}'",
				"`subject`"=>"'{$_POST[edtsubject]}'","`text`"=>"'{$_POST[edttext]}'",
				"`picid`"=>"'0'");
		$db->UpdateQuery("news",$values,array("id='{$_GET[did]}'"));	
		header('location:dataentry.php?act=new&msg=1');
	}
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savenews' /> ";
	}
	
	
	
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("news","*","id='{$_GET["did"]}'",NULL);		
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editnews' /> ";
	}
  
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ثبت خبر</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">ثبت خبر</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form id="frmnews" name="frmnews" enctype="multipart/form-data" action="" method="post" class="form-inline ls_form" role="form">
                   
                      <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">عنوان</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtsubject" name="edtsubject" type="text" class="form-control" value = " {$row["subject"]}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">متن</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="col-md-10 ls-group-input">
                                            <textarea class="animatedTextArea form-control " id="edttext" name="edttext"> {$row["text"]}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب عکس</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2 ls-group-input">
                                                <input kl_virtual_keyboard_secure_input="on" id="userfile"  name="userfile" class="file" multiple="true" data-preview-file-type="any" type="file" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ثبت خبر</h3>
                                </div>
                                <div class="panel-body">
                                    {$insertoredit}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Main Content Element  End-->
            </div>
        </div>
    </section>
    <!--Page main section end -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cbmenu").change(function(){
				var id= $(this).val();
				$.get('./ajaxcommand.php?smid='+id,function(data) {			
						$('#sm1').html(data);
						
						$("#cbsm1").change(function(){
							var id= $(this).val();
							$.get('./ajaxcommand.php?smid2='+id,function(data) {			
								$('#sm2').html(data);
							});
						});			
				});
			});			
		
		});
	</script>
cd;
	include_once("./inc/header.php");
	echo $html;
	include_once("./inc/footer.php")
?>