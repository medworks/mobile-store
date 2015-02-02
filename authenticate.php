<?php
session_start();
include_once("config.php");
include_once("classes/functions.php");
include_once("classes/security.php");
include_once("classes/database.php");
include_once("./classes/messages.php");
include_once("./classes/session.php");
include_once("./classes/login.php");
include_once("./lib/persiandate.php");
include_once("./lib/Zebra_Pagination.php");
include_once("classes/seo.php");

$login = Login::GetLogin();	
$msg = Message::GetMessage();	

if ($login->IsUserLogged())
{	
	header("Location: ./conforder.php");
}
else
{
	if (isset ($_POST["mark"]) AND $_POST["mark"] == "login")
	{
		if ($login->UserLogin($_POST['email'],$_POST['password']))
		{		 
			header("Location: ./conforder.php");	
		}	
		else
		{ 
			$msgs = $msg->ShowError("نام کاربری یا کلمه عبور اشتباه می باشد !");			
		}	
	}  
    else
	if (isset ($_POST["mark"]) AND $_POST["mark"] == "newacc")
    {
		header("Location: ./craccount.php?email={$_POST['edtemail']}");	
	}	

$html1=<<<cd
<body id="product" class="product product-20 product-printed-summer-dress category-11 category-camcorder hide-right-column lang_en">
	<div id="page">
cd;
	
$html2=<<<cd
<div id="center_column" class="center_column col-xs-12" style="width:80%;">				
	<!-- Breadcrumb -->
	<div class="breadcrumb clearfix rtl">
		<a class="home" href="./" title="Return to Home"><i class="icon-home"></i></a>
		<span class="navigation-pipe">&gt;</span>
		ورود به حساب کاربری
	</div>
	<h1 class="page-heading">ورود به حساب کاربری</h1>
	<ul class="step clearfix" id="order_step">
		<li class="step_todo first">
			<span><em>1-</em> سبد خرید</span>
		</li>
		<li class="step_current second">
			<span><em>2-</em> ورود به حساب</span>
		</li>
		<li class="step_todo third">
			<span><em>3-</em> تایید سفارش</span>
		</li>
		<li class="step_todo four">
			<span><em>4-</em> پرداخت</span>
		</li>
		<li id="step_end" class="step_todo last">
			<span><em>5-</em> کد پیگیری</span>
		</li>
	</ul>
	<!-- /Breadcrumb -->
	{$msgs}
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<form action="" method="post" id="create-account_form" class="box">
				<h3 class="page-subheading">ایجاد حساب کاربری</h3>
				<div class="form_content clearfix">
					<p style="font-size:20px">لطفا آدرس ایمیل خود را وارد نمایید.</p>
					<div class="alert alert-danger" id="create_account_error" style="display:none"></div>
					<div class="form-group">
						<label for="email_create">ایمیل</label>
						<input type="text" class="is_required validate account_input form-control" data-validate="isEmail" id="edtemail" name="edtemail" value="">
					</div>
					<div class="submit">
						<input type="hidden" class="hidden" name="back" value="">			
						<button class="btn btn-default button button-medium exclusive" type="submit" id="SubmitCreate" name="SubmitCreate">
								<span>
									<i class="icon-user left"></i>
									ایجاد حساب
								</span>
					    </button>
						<input type="hidden" class="hidden" name="mark" value="newacc">
					</div>
				</div>
			</form>
		</div>
		<div class="col-xs-12 col-sm-6">
			<form action="" method="post" id="login_form" class="box">
				<h3 class="page-subheading">حساب دارید؟</h3>
				<div class="form_content clearfix">
					<div class="form-group">
						<label for="email">Email address</label>
						<input class="is_required validate account_input form-control" data-validate="isEmail" type="text" id="email" name="email" value="">
					</div>
					<div class="form-group">
						<label for="passwd">Password</label>
						<span><input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="password" name="password" value=""></span>
					</div>
					<p class="submit">
						<input type="hidden" class="hidden" name="mark" value="login">
						<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-default button-medium">
							<span>
								<i class="icon-lock left"></i>
								ورود
							</span>
						</button>
					</p>
				</div>
			</form>
		</div>
	</div>
</div>
cd;
	include_once('./inc/header.php');
	echo $html1;
	include_once('./inc/main-sidebar.php');
	echo $html2;
	include_once('./inc/footer.php');
}	
?>