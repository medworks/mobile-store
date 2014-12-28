<?php
	include_once('./inc/header.php')
?>

<body id="product" class="product product-20 product-printed-summer-dress category-11 category-camcorder hide-right-column lang_en">
	<div id="page">
<?php
	include_once('./inc/main-sidebar.php')
?>		
		
<div id="center_column" class="center_column col-xs-12" style="width:80%;">				
	<!-- Breadcrumb -->
	<h1 class="page-heading" style="margin-top:15px;">ایجاد حساب کاربری</h1>
	<!-- /Breadcrumb -->
	<form action="http://prestashop-demos.org/PRS06/PRS060144/en/login" method="post" id="account-creation_form" class="std box">
		
		<div class="account_creation">
			<h3 class="page-subheading" style="font-size:25px!important;">مشخصات فردی</h3>
			<div class="clearfix rtl">
				<label style="font-size:18px">عنوان</label>
				<br />
				<div class="radio-inline">
					<label for="id_gender1" class="top">
						<div class="radio" id="uniform-id_gender1">
							<span>
								<input type="radio" name="id_gender" id="id_gender1" value="1">
							</span>
						</div>
						آقا
					</label>
				</div>
				<div class="radio-inline">
					<label for="id_gender2" class="top">
						<div class="radio" id="uniform-id_gender2">
							<span>
								<input type="radio" name="id_gender" id="id_gender2" value="2">
							</span>
						</div>
						خانم
					</label>
				</div>
			</div>
			<div class="required form-group rtl">
				<label for="customer_firstname">نام و نام خانوادگی <sup>*</sup></label>
				<input onkeyup="$('#firstname').val(this.value);" type="text" class="is_required validate form-control" data-validate="isName" id="customer_firstname" name="customer_firstname" value="">
			</div>
			<div class="required form-group rtl">
				<label for="customer_lastname">نام فروشگاه <sup>*</sup></label>
				<input onkeyup="$('#lastname').val(this.value);" type="text" class="is_required validate form-control" data-validate="isName" id="customer_lastname" name="customer_lastname" value="">
			</div>
			<div class="required form-group rtl">
				<label for="email">ایمیل <sup>*</sup></label>
				<input type="text" class="is_required validate form-control" data-validate="isEmail" id="email" name="email" value="">
			</div>
			<div class="required password form-group rtl">
				<label for="passwd">رمز عبور <sup>*</sup></label>
				<input type="password" class="is_required validate form-control" data-validate="isPasswd" name="passwd" id="passwd">
				<span class="form_info">(حداقل کارکترهای رمز عبور 5 کاراکتر باشد!)</span>
			</div>
			<div class="checkbox rtl">
				<div class="checker" id="uniform-newsletter">
					<span>
						<input type="checkbox" name="newsletter" id="newsletter" value="1">
					</span>
				</div>
				<label for="newsletter">ثبت نام برای خبرنامه!</label>
			</div>
			<div class="checkbox rtl">
				<div class="checker" id="uniform-optin">
					<span>
						<input type="checkbox" name="optin" id="optin" value="1">
					</span>
				</div>
				<label for="optin">ارسال پیشنهادهای ویژه!</label>
			</div>
		</div>
						
		<div class="submit clearfix">
			<input type="hidden" name="email_create" value="1">
			<input type="hidden" name="is_new_customer" value="1">
			<input type="hidden" class="hidden" name="back" value="http://prestashop-demos.org/PRS06/PRS060144/en/order?step=1&amp;multi-shipping=0">			<button type="submit" name="submitAccount" id="submitAccount" class="btn btn-default button button-medium">
				<span>Register<i class="icon-chevron-right right"></i></span>
			</button>
			<p class="pull-right required"><span><sup>*</sup>Required field</span></p>
		</div>
	</form>
</div>

<?php
	include_once('./inc/footer.php');
?>