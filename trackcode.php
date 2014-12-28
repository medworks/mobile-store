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
	<div class="breadcrumb clearfix rtl">
		<a class="home" href="./" title="Return to Home"><i class="icon-home"></i></a>
		<span class="navigation-pipe">&gt;</span>
		کد پیگیری 
	</div>
	<ul class="step clearfix" id="order_step">
		<li class="step_todo first">
			<span><em>1-</em> سبد خرید</span>
		</li>
		<li class="step_todo second">
			<span><em>2-</em> ورود به حساب</span>
		</li>
		<li class="step_todo third">
			<span><em>3-</em> تایید سفارش</span>
		</li>
		<li class="step_todo four">
			<span><em>4-</em> پرداخت</span>
		</li>
		<li id="step_end" class="step_current last">
			<span><em>5-</em> کد پیگیری</span>
		</li>
	</ul>
	<!-- /Breadcrumb -->
	<div id="order-detail-content" class="table_block table-responsive">
		<table id="cart_summary" class="table table-bordered rtl">
			<thead>
				<tr>
					<th class="cart_product first_item">تاریخ</th>
					<th class="cart_description item">ساعت</th>
					<th class="cart_unit item">کد سفارش</th>
					<th class="cart_quantity item">کد پیگیری</th>
				</tr>
			</thead>
			<tbody>
				<tr id="product_1_1_0_0" class="cart_item last_item first_item address_0 odd">
					<style>
						.price{
							font-size:18px;
						}
					</style>
					<td class="cart_unit" data-title="Unit price">
						<span class="price" id="product_price_1_1_0">
							<span class="price">دوشنبه 12 آبان 93</span>
						</span>
					</td>
					<td class="cart_unit" data-title="Unit price">
						<span class="price" id="product_price_1_1_0">
							<span class="price">12:30</span>
						</span>
					</td>
					<td class="cart_unit" data-title="Unit price">
						<span class="price" id="product_price_1_1_0">
							<span class="price">3545646465456</span>
						</span>
					</td>
					<td class="cart_unit" data-title="Unit price">
						<span class="price" id="product_price_1_1_0">
							<span class="price">3545646465456</span>
						</span>
					</td>
				</tr>				
			</tbody>
		</table>
	</div>
</div>

<?php
	include_once('./inc/footer.php');
?>