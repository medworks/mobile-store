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
   $row = $db->Select("clients","*"," id ='{$cid}'");
   
   $regdate = ToJalali($row["regdate"]," l d F  Y ساعت H:i");
	if($row["sex"] ==0)
	{
	  $male = "checked";
	  $man = "";
	}
	else
	{
	  $male = "";
      $man = "checked";
	}
    
    if ((isset($_POST["mark"]) and $_POST["mark"]=="edit"))
    {
	$values = array("`sex`"=>"'1'","`name`"=>"'{$_POST[edtname]}'","`company`"=>"'{$_POST[edtcompany]}'",
			"`email`"=>"'{$_POST[edtemail]}'","`tel`"=>"'{$_POST[edttel]}'",
			"`mobile`"=>"'{$_POST[edtmobile]}'","`address`"=>"'{$_POST[edtaddress]}'");
	$db->UpdateQuery("clients",$values,array("id='{$cid}'"));		
	header('location:profile.php');
	//echo $db->cmd;
    }
	
$html=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <form id="frmnews" name="frmnews" enctype="multipart/form-data" action="" method="post" class="form-inline ls_form" role="form">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">اطلاعات حساب</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">اطلاعات حساب</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
				            <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">جنسیت</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                       <div class="radio-inline">
					<label for="id_gender1" class="top" style="font-size:15px">
						<div class="radio" id="uniform-id_gender1">
							<span>
								<input type="radio" name="gender" id="id_gender1" value="1" {$man}>
							</span>
						</div>
						آقا
					</label>
				</div>
				<div class="radio-inline">
					<label for="id_gender2" class="top" style="font-size:15px">
						<div class="radio" id="uniform-id_gender2">
							<span>
								<input type="radio" name="gender" id="id_gender2" value="0" {$male}>
							</span>
						</div>
						خانم
					</label>
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
                                    <h3 class="panel-title">نام و نام خانوادگی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtname" name="edtname" type="text" class="form-control" value="{$row[name]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">نام فروشگاه</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtcompany" name="edtcompany" type="text" class="form-control" value="{$row[company]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ایمیل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtemail" name="edtemail" type="text" class="form-control" value="{$row[email]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تلفن</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edttel" name="edttel" type="text" class="form-control" value="{$row[tel]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">موبایل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtmobile" name="edtmobile" type="text" class="form-control" value="{$row[mobile]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">آدرس</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <textarea id="edtaddress" name="edtaddress" type="text" class="form-control" value="">{$row["address"]}</textarea>
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
                                </div>
                            </div>
                        </div>
                    </div>
					<input type="hidden" name="mark" value="edit"/>
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