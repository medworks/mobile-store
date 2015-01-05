<?php    
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php");  
	    
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$login = Login::GetLogin();	
	$db = Database::GetDatabase();	
	
	if (!$login->IsUserLogged())
	{
		header("Location: ../index.php");
		die(); //solve security bug
	}		
	$mes = Message::GetMessage();
	
	if (isset($_GET["act"]) and $_GET["act"] == "logout")
   {
	   if ($login->UserLogOut())
			header("Location: ../index.php");
	   else
		    echo $mes->ShowError("عملیات خروج با خطا مواجه شد، لطفا مجددا سعی نمایید.");
   }
  
   $db = Database::GetDatabase();
   $sess = Session::GetSesstion();
   $cid = $sess->Get("clientid");   
   
   if ((isset($_POST["mark"]) and $_POST["mark"]=="edit"))
   {
		$row = $db->Select("clients","*"," id ='{$cid}'");
        if ($row["password"] != md5($_POST["curpass"]) )
		{
			//$msgs = $mes->ShowError("رمز عبور فعلی اشتباه است!!");
			header('location:chpass.php?msg=11');
		}
		else
		if ($_POST["newpass"] == $_POST["repnewpass"])
		{
			$pass = md5($_POST[newpass]);
			$values = array("`password`"=>"'{$pass}'");
			$db->UpdateQuery("clients",$values,array("id='{$cid}'"));
			header('location:chpass.php?msg=1');
		}
		else
		{
			//$msgs = $mes->ShowError("رمز عبور جدید با تکرار آن برابر نیست!!");
			header('location:chpass.php?msg=12');
		}
	//echo $db->cmd;
   }
   $msgs = GetMessage($_GET["msg"]);
$html=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <form id="frmnews" name="frmnews" enctype="multipart/form-data" action="" method="post" class="form-inline ls_form" role="form">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">تغییر رمز عبور</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">تغییر رمز عبور</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
				{$msgs}
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">رمز عبور فعلی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="curpass" name="curpass" type="password" class="form-control" value="{$row["father"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">رمز جدید</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="newpass" name="newpass" type="password" class="form-control" value="{$row["father"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تکرار رمز جدید</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="repnewpass" name="repnewpass" type="password" class="form-control" value="{$row["father"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ویرایش اطلاعات</h3>
                                </div>
                                <div class="panel-body">
                                    <input type="submit" name="submit" value="ویرایش"/>
									<input type="hidden" name="mark" value="edit"/>
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
cd;
	include_once("./inc/header.php");	
	echo $html;
    include_once("./inc/footer.php");	
?>