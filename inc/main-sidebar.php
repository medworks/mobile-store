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
					<div class="clearfix"></div>
					<!-- /Block search module TOP -->
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
								<a href="" title="">درباره ما</a>
								</li>										 
								<li>
								<a href="" title="">راهنمای خرید</a>
								</li>										 
								<li>
								<a href="craccount.html" title="ثبت نام">ثبت نام</a>
								</li>
								<li>
								<a href="users/login.php" title="ورود کاربران">ورود کاربران</a>
								</li>										 
								<li>
								<a href="" title="">تماس با ما</a>
								</li>
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
									        	<a href="cart_update.php?removep=$cart_itm[id]&qid=$cart_itm[priceid]&return_url=$current_url">&times</a>
									        </span>
									        <h4 style="font-size:20px!important;color:#E76453">$cart_itm[name]</h4>
									        <div class="p-code">کد کالا: $cart_itm[id]</div>											
									        <div class="p-qty">تعداد: $cart_itm[qty]</div>
											<div class="p-code">کیفیت: $cart_itm[quality]</div>
									        <div class="p-price">قیمت: $currency $cart_itm[price]</div>
									    </li>
cd;
								        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
								        $total = ($total + $subtotal);
								    }
$html.=<<<cd
									<style>
										.empty,
										.pay{
											display:inline-block;
											direction:rtl;
											text-align:right;
											margin-top:5px;
											border:1px solid #E76453;
											background-color: #E76453;
											padding:5px;
										}
										.empty:hover,
										.pay:hover{
											color:#fff;
										}
									</style>
								   <span class="check-out-txt" style="direction:rtl">
								   		<strong style="font-size:20px!important;color:#E76453">مجموع قیمت: $total $currency</strong>
								   		<br />
								   		<a href="view_cart.php" class="empty">پرداخت</a>
								   </span>
								   <span class="empty-cart">
								   		<a href="cart_update.php?emptycart=1&return_url=$current_url" class="pay">خالی کردن سبد!</a>
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
