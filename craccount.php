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
					<label for="id_gender1" class="top" style="font-size:15px">
						<div class="radio" id="uniform-id_gender1">
							<span>
								<input type="radio" name="id_gender" id="id_gender1" value="1">
							</span>
						</div>
						آقا
					</label>
				</div>
				<div class="radio-inline">
					<label for="id_gender2" class="top" style="font-size:15px">
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
				<input type="text" class="is_required validate form-control" id="customer_firstname" name="customer_firstname" value="">
			</div>
			<div class="required form-group rtl">
				<label for="customer_lastname">نام فروشگاه <sup>*</sup></label>
				<input type="text" class="is_required validate form-control" id="customer_lastname" name="customer_lastname" value="">
			</div>
			<div class="required form-group rtl">
				<label for="email">ایمیل <sup>*</sup></label>
				<input type="text" class="is_required validate form-control" id="email" name="email" value="">
			</div>
			<div class="required password form-group rtl">
				<label for="passwd">رمز عبور <sup>*</sup></label>
				<input type="password" class="is_required validate form-control" name="passwd" id="passwd">
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
			<p class="pull-right required" style="font-size:18px"><span><sup>*</sup> فیلدهای ضروری</span></p>
		</div>
	</form>
</div>

<?php
	include_once('./inc/footer.php');
?>