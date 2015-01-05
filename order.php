<?php
	session_start();
	include_once('./inc/header.php');


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
		سبد خرید 
	</div>
	<h1 id="cart_title" class="page-heading">سبد خرید شما
		<span class="heading-counter">سبد خرید شما شامل:
			<span id="summary_products_quantity">3 محصول</span>
		</span>
	</h1>
	<ul class="step clearfix" id="order_step">
		<li class="step_current  first">
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
		<li id="step_end" class="step_todo last">
			<span><em>5-</em> کد پیگیری</span>
		</li>
	</ul>
	<!-- /Breadcrumb -->
	<div id="order-detail-content" class="table_block table-responsive">
		<table id="cart_summary" class="table table-bordered rtl">
			<thead>
				<tr>
					<th class="cart_product first_item">محصولات</th>
					<th class="cart_description item">توضیحات</th>
					<th class="cart_unit item">قیمت (ریال)</th>
					<th class="cart_quantity item">تعداد</th>					
					<th class="cart_total item">مجموع</th>
					<th class="cart_delete last_item">&nbsp;</th>
				</tr>
			</thead>
			<tfoot>
				<tr class="cart_total_price">
					<td rowspan="3" colspan="2" id="cart_voucher" class="cart_voucher"></td>
					<td colspan="3" class="text-right">مجموع خرید</td>
					<td colspan="2" class="price" id="total_product">75.00</td>
				</tr>
				<tr class="cart_total_delivery">
					<td colspan="3" class="text-right">هزینه حمل و نقل</td>
					<td colspan="2" class="price" id="total_shipping">00</td>
				</tr>
				<tr class="cart_total_price">
					<td colspan="3" class="total_price_container text-right">
						<span>مجموعا</span>
					</td>
					<td colspan="2" class="price" id="total_price_container">
						<span id="total_price">377.00</span>
					</td>
				</tr>
			</tfoot>
			<tbody>
cd;

$i=0;
foreach ($_SESSION["products"] as $cart_itm) 
{
$i++;
$html2.=<<<cd
				<tr id="product_1_1_0_0" class="cart_item last_item first_item address_0 odd">
					<td class="cart_product">
						<a href="#"><img src="./img/product/1.jpg" alt="" width="55" height="55"></a>
					</td>
					<td class="cart_description">
						<p class="product-name">
							<a href="#">{$cart_itm["name"]}</a>
						</p>
				    </td>
					<td class="cart_unit" data-title="Unit price">
						<span class="price" id="product_price_1_1_0">
							<span class="price">{$cart_itm["price"]}</span>
						</span>
					</td>
					<td id="quantity_wanted_p">
						<input type="text" name="qty{$i}" id="quantity_wanted" class="text" value="{$cart_itm['qty']}" style="border: 1px solid rgb(227, 226, 226);width:58px;font-size:15px;font-family:'bmitra'">
						<a href="#" data-field-qty="qty{$i}" class="btn btn-default button-minus product_quantity_down" style="margin-top:5px">
							<span><i class="icon-minus"></i></span>
						</a>
						<a href="#" data-field-qty="qty{$i}" class="btn btn-default button-plus product_quantity_up" style="margin-top:5px">
							<span><i class="icon-plus"></i></span>
						</a>
						<span class="clearfix"></span>
					</td>
					<!--
					<td id="quality_wanted_p">
						<select style="border: 1px solid rgb(227, 226, 226);width:150px;font-size:15px;font-family:'bmitra'">
							<option value="0">انتخاب کیفیت</option>
							<option value="1">اورجینال</option>
							<option value="2">متوسط</option>
							<option value="3">پایین</option>
						</select>
						<span class="clearfix"></span>
					</td>
					-->
					<td class="cart_total" data-title="Total">
						<span class="price" id="total_product_price_1_1_0">375.00</span>
					</td>
					<td class="cart_delete text-center" data-title="Delete">
						<div>
							<a rel="nofollow" title="Delete" class="cart_quantity_delete" id="1_1_0_0" href="#"><i class="icon-trash"></i></a>
						</div>
					</td>
				</tr>
cd;
}

$html2.=<<<cd
			</tbody>
		</table>
	</div>
	<p class="cart_navigation clearfix">
		<a href="authenticate.php" class="button btn btn-default standard-checkout button-medium" title="تکمیل فرایند خرید" style="font-size:18px;padding:18px 10px">
			<span style="padding:0">تکمیل فرایند خرید</span>
		</a>
	</p>
</div>
cd;
	echo $html1;
	include_once('./inc/main-sidebar.php');
	echo $html2;
	include_once('./inc/footer.php');
?>