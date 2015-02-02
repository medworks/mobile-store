<?php

	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$db = Database::GetDatabase();
	if (isset($_POST["mark"]) and $_POST["mark"]="register" )
	{
		$date = date('Y-m-d H:i:s');
		$fields = array("`sex`","`name`","`company`","`email`","`password`",
		                "`tel`","`mobile`","`address`","`regdate`");
		
		$passwd = md5($_POST[password]);
		$values = array("'{$_POST[gender]}'","'{$_POST[name]}'","'{$_POST[company]}'",
						"'{$_POST[email]}'","'{$passwd}'","'{$_POST[tel]}'",
						"'{$_POST[mobile]}'","'{$_POST[address]}'","'{$date}'");	
		if (!$db->InsertQuery('clients',$fields,$values)) 
		{			
			header('location:craccount.html?act=new&msg=2');			
		} 	
		else 
		{  
			header('location:craccount.html?act=new&msg=1');
			
		}  		
		//echo $db->cmd;
	}
$msgs = GetMessage($_GET['msg']);	
	
$html1=<<<cd
<body id="product" class="product product-20 product-printed-summer-dress category-11 category-camcorder hide-right-column lang_en">
	<div id="page">
cd;
	
$html2=<<<cd
<div id="center_column" class="center_column col-xs-12" style="width:80%;">				
	<!-- Breadcrumb -->
	<h1 class="page-heading" style="margin-top:15px;">ایجاد حساب کاربری</h1>
	<!-- /Breadcrumb -->
	{$msgs}
	<form action="" method="post" id="frmregister" class="std box">
		
		<div class="account_creation">
			<h3 class="page-subheading" style="font-size:25px!important;">مشخصات فردی</h3>
			<div class="clearfix rtl">
				<label style="font-size:18px">عنوان</label>
				<br />
				<div class="radio-inline">
					<label for="id_gender1" class="top" style="font-size:15px">
						<div class="radio" id="uniform-id_gender1">
							<span>
								<input type="radio" name="gender" id="id_gender1" value="1">
							</span>
						</div>
						آقا
					</label>
				</div>
				<div class="radio-inline">
					<label for="id_gender2" class="top" style="font-size:15px">
						<div class="radio" id="uniform-id_gender2">
							<span>
								<input type="radio" name="gender" id="id_gender2" value="0">
							</span>
						</div>
						خانم
					</label>
				</div>
			</div>
			<div class="required form-group rtl">
				<label for="customer_firstname">نام و نام خانوادگی <sup>*</sup></label>
				<input type="text" class="is_required validate form-control" id="name" name="name" value="">
			</div>
			<div class="required form-group rtl">
				<label for="customer_lastname">نام فروشگاه <sup>*</sup></label>
				<input type="text" class="is_required validate form-control" id="company" name="company" value="">
			</div>
			<div class="required form-group rtl">
				<label for="email">ایمیل <sup>*</sup></label>
				<input type="text" class="is_required validate form-control" id="email" name="email" value="{$_GET['email']}">
			</div>
			<div class="required password form-group rtl">
				<label for="passwd">رمز عبور <sup>*</sup></label>
				<input type="password" class="is_required validate form-control" name="password" id="password">
				<span class="form_info" style="font-size:15px">(حداقل کارکترهای رمز عبور 5 کاراکتر باشد!)</span>
			</div>
			<div class="required form-group rtl">
				<label for="customer_lastname">تلفن ثابت <sup>*</sup></label>
				<input type="text" class="is_required validate form-control"id="tel" name="tel" value="">
			</div>
			<div class="required form-group rtl">
				<label for="customer_lastname">موبایل <sup>*</sup></label>
				<input type="text" class="is_required validate form-control" id="mobile" name="mobile" value="">
			</div>
			<div class="required form-group rtl">
				<label for="address">آدرس <sup>*</sup></label>
				<textarea name="address" class="is_required validate form-control" style="width:233px;height:100px;"></textarea>
			</div>
		</div>
						
		<div class="submit clearfix">
			<input type="hidden" name="email_create" value="1">
			<input type="hidden" name="is_new_customer" value="1">
			<input type="hidden" class="hidden" name="back" value="">
			<button type="submit" name="submitAccount" id="submitAccount" class="btn btn-default button button-medium">
				<span>ثبت نام<i class="icon-chevron-left left"></i></span>
			</button>
			<input type="hidden" name="mark" value="register" />
			<p class="pull-right required" style="font-size:18px"><span><sup>*</sup> فیلدهای ضروری</span></p>
		</div>
	</form>
</div>
cd;
	include_once('./inc/header.php');
	echo $html1;
	include_once('./inc/main-sidebar.php');
	echo $html2;
	include_once('./inc/footer.php');
?>