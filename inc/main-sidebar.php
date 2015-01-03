<?php

	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	include_once("./lib/persiandate.php");
				
	$db = Database::GetDatabase();
	
	$brands = $db->SelectAll("brands","*",NULL,"id ASC");
	$groups = $db->SelectAll("groups","*",NULL,"id ASC");
	
$html=<<<cd

<div class="header-container">
	<header id="header">
		<div class="banner">
			<div class="container">
				<div class="row"></div>
			</div>
		</div>
		<div>
			<div class="container">
				<div class="row">
					<div id="header_logo">
						<a href="./" title="Demo Store">
							<img class="logo img-responsive" src="./img/logo.png" alt="فروشگاه موبایل" height="100" width="100">
						</a>
					</div>
					<!-- Block search module TOP -->
					<!-- <div id="search_block_top" class="col-sm-4 clearfix">
						<form id="searchbox" method="get" action="">
							<input name="controller" value="search" type="hidden">
							<input name="orderby" value="position" type="hidden">
							<input name="orderway" value="desc" type="hidden">
							<input kl_virtual_keyboard_secure_input="on" class="search_query form-control" id="search_query_top" name="search_query" value="" type="text">
							<button type="submit" name="submit_search" class="btn btn-default button-search">
								<span>جستجو</span>
							</button>
						</form>
					</div> -->
					<!-- /Block search module TOP -->
					<!-- MODULE Block cart -->
					<div class="col-sm-4 block_cart clearfix" style="float:left">
						<div class="shopping_cart">
							<a href="http://prestashop-demos.org/PRS06/PRS060144/en/order" title="View my shopping cart" rel="nofollow">
								<b>سبد خرید</b>
								<span class="ajax_cart_quantity unvisible">0</span>
								<span class="ajax_cart_product_txt unvisible">محصول</span>
								<span class="ajax_cart_product_txt_s unvisible">محصولات</span>
								<span class="ajax_cart_total unvisible"></span>
								<span class="ajax_cart_no_product">(خالی)</span>
							</a>
							<div class="cart_block block exclusive">
								<div class="block_content">
									<!-- block list of products -->
									<div class="cart_block_list">
										<p class="cart_block_no_products">
											بدون محصول
										</p>
										<div class="cart-prices">
											<!-- <div class="cart-prices-line first-line">
												<span class="price cart_block_shipping_cost ajax_cart_shipping_cost">Free shipping!</span>
												<span>
													Shipping
												</span>
											</div> -->
											<div class="cart-prices-line last-line">
												<span class="price cart_block_total ajax_block_cart_total">0 ریال</span>
												<span>مجموع</span>
											</div>
										</div>
										<p class="cart-buttons">
											<a id="button_order_cart" class="btn btn-default button button-small" href="http://prestashop-demos.org/PRS06/PRS060144/en/order" title="Check out" rel="nofollow">
												<span>پرداخت
													<i class="icon-chevron-left right"></i>
												</span>
											</a>
										</p>
									</div>
								</div>
							</div><!-- .cart_block -->
						</div>
					</div>
					<div id="layer_cart">
						<div class="clearfix">
							<div class="layer_cart_product col-xs-12 col-md-6">
								<span class="cross" title="Close window"></span>
								<h2>
									<i class="icon-ok"></i>Product successfully added to your shopping cart
								</h2>
								<div class="product-image-container layer_cart_img">
								</div>
								<div class="layer_cart_product_info">
									<span id="layer_cart_product_title" class="product-name"></span>
									<span id="layer_cart_product_attributes"></span>
									<div>
										<strong class="dark">Quantity</strong>
										<span id="layer_cart_product_quantity"></span>
									</div>
									<div>
										<strong class="dark">Total</strong>
										<span id="layer_cart_product_price"></span>
									</div>
								</div>
							</div>
							<div class="layer_cart_cart col-xs-12 col-md-6">
								<h2>
									<!-- Plural Case [both cases are needed because page may be updated in Javascript] -->
									<span class="ajax_cart_product_txt_s  unvisible">
										There are <span class="ajax_cart_quantity">0</span> items in your cart.
									</span>
									<!-- Singular Case [both cases are needed because page may be updated in Javascript] -->
									<span class="ajax_cart_product_txt ">
										There is 1 item in your cart.
									</span>
								</h2>
					
								<div class="layer_cart_row">
									<strong class="dark">
										Total products
																	(tax excl.)
															</strong>
									<span class="ajax_block_products_total">
															</span>
								</div>
					
												<div class="layer_cart_row">
									<strong class="dark">
										Total shipping&nbsp;(tax excl.)
									</strong>
									<span class="ajax_cart_shipping_cost">
																	Free shipping!
															</span>
								</div>
												<div class="layer_cart_row">	
									<strong class="dark">
										Total
																	(tax excl.)
															</strong>
									<span class="ajax_block_cart_total">
															</span>
								</div>
								<div class="button-container">	
									<span class="continue btn btn-default button exclusive-medium" title="Continue shopping">
										<span>
											<i class="icon-chevron-left left"></i>Continue shopping
										</span>
									</span>
									<a class="btn btn-default button button-medium" href="http://prestashop-demos.org/PRS06/PRS060144/en/order" title="Proceed to checkout" rel="nofollow">
										<span>
											Proceed to checkout<i class="icon-chevron-right right"></i>
										</span>
									</a>	
								</div>
							</div>
						</div>
						<div class="crossseling"></div>
					</div> <!-- #layer_cart -->
					<div class="layer_cart_overlay"></div>
					<!-- /MODULE Block cart -->
					<div class="clearfix"></div>
					<!-- Menu -->
					<div id="block_top_menu" class="sf-contener clearfix col-lg-12">
						<div class="menu_inner">
							<div class="cate_inner">
								<p class="title_block" id="left_categorytitle">
									<span class="cat_title">محصولات</span>
									<span class="cate_bullet">&nbsp;</span>
								</p>
							</div>
							<ul class="sf-menu clearfix menu-content">
cd;

for($i=0;$i<count($groups);$i++)
{
$html.=<<<cd
								<li>
									<a href="#" title="">{$groups[$i]["name"]}</a>
									<ul>
									<li>
											<ul>									
cd;
for($j=0;$j<count($brands);$j++)
{
$html.=<<<cd
	
												<li>
													<a href="#" title="">{$brands[$j]["name"]}</a>
												</li>
cd;
}
$html.=<<<cd
											</ul>
										</li>
										<li class="category-thumbnail"></li>
									</ul>
								</li>
cd;
}
$html.=<<<cd
							</ul>
						</div>
						<!--/ Menu -->
					</div>	
					<!-- Block links module -->
					<section class="col-xs-12 col-sm-8" id="tm_links_block4_header">
						<h4 class="title_block">
							Block Title4
						</h4>
						<div class="block_content toggle-footer">
							<ul class="bullet">
									 
								<li>
								<a href="" title="">درباره ما</a></li>
										 
								<li>
								<a href="" title="">راهنمای خرید</a></li>
										 
								<li>
								<a href="craccount.html" title="ثبت نام">ثبت نام</a></li>
										 
								<li>
								<a href="" title="">تماس با ما</a></li>
							</ul>
						</div>
					</section>
					<!-- /Block links module -->
					<!-- MODULE TM - CMS BLOCK  -->
					<div id="tmcmsinfo_block">
						<div class="col-xs-12">
							<ul>
								<li class="shipping">
									<a href="#">حمل و نقل به تمام کشور</a>
								</li>
								<li class="Money">
									<a href="#">گارانتی محصولات</a>
								</li><!-- 
								<li class="Offer">
									<a href="#">پیشنهاد های ویژه</a>
								</li> -->
							</ul>
						</div>
					</div>
					<!-- /MODULE TM - CMS BLOCK  -->
				</div>
			</div>
		</div>
	</header>
</div>	
<div class="columns-container">
			<div id="columns" class="container">
				<div class="row">
					<div id="top_column" class="center_column col-xs-12 col-sm-12"></div>
				</div>
				<div class="row" id="columns_inner">
					<div id="left_column" class="column col-xs-12 accordion" style="width:20%;">
						<!-- Cart shop -->
						<div id="manufacturers_block_left" class="block blockmanufacturer">
							<p class="title_block">
								<a href="javascript:void(0);" title="سبد خرید">
									سبد خرید
								</a>
							</p>
							<div class="block_content list-block">
								<ul>
cd;
								//current URL of the Page. cart_update.php redirects back to this URL
								$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
								if(isset($_SESSION["products"]))
								{
								    $total = 0;
								    foreach ($_SESSION["products"] as $cart_itm)
								    {
$html.=<<<cd
								        <li class="cart-itm">
									        <span class="remove-itm">
									        	<a href="cart_update.php?removep=$cart_itm[code]&return_url=$current_url">&times</a>
									        </span>
									        <h3>$cart_itm[name]</h3>
									        <div class="p-code">کد کالا: $cart_itm[code]</div>
									        <div class="p-qty">تعداد: $cart_itm[qty]</div>
									        <div class="p-price">قیمت: $currency$cart_itm[price]</div>
									    </li>
cd;
								        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
								        $total = ($total + $subtotal);
								    }
$html.=<<<cd
								   <span class="check-out-txt"><strong>مجموع قیمت: $currency$total</strong>
								   		<br /><a href="view_cart.php">پرداخت!</a>
								   </span>
								   <span class="empty-cart">
								   		<br /><a href="cart_update.php?emptycart=1&return_url=$current_url">خالی کردن سبد</a>
								   	</span>
cd;
								}else{
$html.=<<<cd
								   <p style="font-size:20px;color:#E76453;text-align:left">سبد خرید شما خالی میباشد<p>
cd;
								}
$html.=<<<cd
								</ul>
							</div>
						</div>
						<!-- END Cart shop -->
						<!-- Block CMS module -->
						<section id="informations_block_left_1" class="block informations_block_left">
							<p class="title_block">
								<a href="#">پر فروشترین ها</a>
							</p>
							<div class="block_content list-block">
								<ul>
									<li>
										<a href="#" title="">سخت افزار</a>
									</li>
									<li>
										<a href="#" title="">کامپیوتر</a>
									</li>
									<li>
										<a href="#">موبایل</a>
									</li>
									<li>
										<a href="#" title="">نرم افزار</a>
									</li>
									<li>					
										<a href="" title="">لوازم جانبی</a>
									</li>
									<li>
										<a href="" title="">هندز فری</a>
									</li>
								</ul>
							</div>
						</section>
						<!-- /Block CMS module -->
						<!-- Block manufacturers module -->
						<div id="manufacturers_block_left" class="block blockmanufacturer">
							<p class="title_block">
								<a href="#" title="">
									اطلاعات
								</a>
							</p>
							<div class="block_content list-block">
								<ul>
									<li class="first_item">
										<a href="#">
											حمل و نقل
										</a>
									</li>
									<li class="item">
										<a href="#">
											پرداخت امن
										</a>
									</li>
									<li class="item">
										<a href="#">
											هزینه پستی
										</a>
									</li>
									<li class="item">
										<a href="#">
											درگاه های ما
										</a>
									</li>
									<li class="item">
										<a href="">
											راهنای پرداخت
										</a>
									</li>		
								</ul>
							</div>
						</div>
						<!-- /Block manufacturers module -->
						<!-- Block links module -->
						<div id="tm_links_block2" class="block tm_links_block2">
							<p class="title_block">
								<a href="#" title="">پشتیبانی</a>
							</p>
							<ul class="block_content list-block">
								<li>
									<a href="#" title="">ضمانت تعویض</a>
								</li> 
								<li>
									<a href="#" title="">ضمانت مرجوعی</a>
								</li> 
								<li>
									<a href="#" title="">دلویری فوری</a>
								</li>	 
								<li>
									<a href="#" title="">پرداخت امن</a>
								</li>
							</ul>
						</div>
						<!-- /Block links module -->
						<div id="tmleft-banner" class="block">
						   <ul>
           	                    <li class="tmleftbanner-container">
				                   	<a href="#" title="LeftBanner 1">
				                    	<img src="./img/product/3-1.jpg" alt="">
				                    </a> 
                    			</li>
						    </ul>
						</div>
					</div>
cd;

echo $html;

?>
