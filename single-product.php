<?php
	session_start();
	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	include_once("./lib/persiandate.php");
	include_once("./lib/Zebra_Pagination.php");
	include_once("classes/seo.php");
			
	$db = Database::GetDatabase();
	$goods = $db->Select("goods","*","id ={$_GET['id']}");
	$pics = $db->SelectAll("pics","*","`gid`={$goods['id']} AND `kind`='1' ");
	
	$db->cmd = "SELECT gq.*,q.name,CONCAT(gq.price,'(',q.name,')') as pn FROM `gquality` as gq ,`quality` as q where gq.qid = q.id AND gq.gid = '{$goods['id']}'";
	$res =$db->RunSQL();
	$gqualitys = array();
	if ($res)
	{
		while($rawrow = mysqli_fetch_array($res)) $gqualitys[] = $rawrow;
	}		
	$cbgquality = DbSelectOptionTag("cbgquality",$gqualitys,"pn",NULL,NULL,NULL,NULL,"کیفیت");
	
	$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);	
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
		<a href="javascript:void(0);" title="">الکترونیکی</a>
		<span class="navigation-pipe">&gt;</span>
		<a href="javascript:void(0);" title="">دوربین</a>
		<span class="navigation-pipe">&gt;</span>
		<a href="javascript:void(0);" title="">سونی</a>
		<span class="navigation-pipe">&gt;</span>
		سونی h300 
	</div>
	<!-- /Breadcrumb -->
	<form method="post" action="cart_update.php">
	<div class="primary_block row" itemscope="" itemtype="http://schema.org/Product">
		<div class="container">
			<div class="top-hr"></div>
		</div>
		<!-- left infos-->  
		<div class="pb-left-column col-xs-12 col-sm-4 col-md-5">
			<!-- product img-->  			
			<div id="image-block" class="clearfix">
			<!---	
				<span class="new-box">
					<span class="new-label">جدید</span>
				</span>
			-->
				<span id="view_full_size">
					<img id="bigpic" itemprop="image" src="./goodspics/{$pics[0]['name']}" alt="{$goods['name']}" title="{$goods['name']}" width="458" height="458">
					<span class="span_link no-print">نمایش بزرگتر</span>
				</span>
			</div> <!-- end image-block -->
			<!-- thumbnails -->
			<div id="views_block" class="clearfix ">
				<span class="view_scroll_spacer">
					<a id="view_scroll_left" class="" title="Other views" href="javascript:{}">
						قبلی
					</a>
				</span>
				<div id="thumbs_list">
					<ul id="thumbs_list_frame" style="width: 1106px;">	
cd;
for ($i=0;$i<= count($pics);$i++)
{
$html2.=<<<cd
						<li id="thumbnail_{$i}">
							<a href="./goodspics/{$pics[$i]['name']}" data-fancybox-group="other-views" class="fancybox" title="">
								<img class="img-responsive" id="thumb_{$i}" src="./goodspics/{$pics[$i]['name']}" alt="{$goods['name']}" title="{$goods['name']}" height="60" width="60" itemprop="image">
							</a>
						</li>																					
cd;
}
$html2.=<<<cd
					</ul>
					</div> <!-- end thumbs_list -->					
						<a id="view_scroll_right" title="Other views" href="javascript:{}">
							بعدی
						</a>		
			</div> <!-- end views-block -->
			<!-- end thumbnails -->
		</div> <!-- end pb-left-column -->
		<!-- end left infos--> 
		<!-- center infos -->
		<div class="pb-center-column col-xs-12 col-sm-7">
			<h1 itemprop="name">{$goods["name"]}</h1>
			<div id="short_description_block">
				<div id="short_description_content" class="rte align_justify" itemprop="description">
					<p>
						{$goods["desc"]}
					</p>
				</div>
				<!---->
			</div> <!-- end short_description_block -->
			<!-- pb-right-column-->
			<div class="pb-right-column">
				<!-- add to cart form-->
				<form id="buy_block" action="" method="post">
					<div class="box-info-product">
						<div class="content_prices clearfix">
							<!-- prices -->
							<div class="price">
								<p class="our_price_display" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
									<link itemprop="availability" href="http://schema.org/InStock">												<span id="our_price_display" itemprop="price">قیمت: 152,000 ریال</span>
										<!---->
								</p>
							</div> <!-- end prices -->
							<p id="reduction_amount" style="display: none;">
								<span id="reduction_amount_display"></span>
							</p>				 
							<div class="clear"></div>
						</div> <!-- end content_prices -->
						<div class="product_attributes clearfix">
							<!-- quantity wanted -->
							<p id="quantity_wanted_p">
								<label>تعداد:</label>
								<input type="text" name="qty" id="quantity_wanted" class="text" value="1" style="border: 1px solid rgb(227, 226, 226);">
								<a href="#" data-field-qty="qty" class="btn btn-default button-minus product_quantity_down">
									<span><i class="icon-minus"></i></span>								
								</a>
								<a href="#" data-field-qty="qty" class="btn btn-default button-plus product_quantity_up">
									<span><i class="icon-plus"></i></span>
								</a>
								<span class="clearfix"></span>
							</p>
							<p id="quality_wanted_p">
								قیمت {$cbgquality}
								<span class="clearfix"></span>
							</p>
							<!-- attributes -->
							<div id="attributes">
								<div class="clearfix"></div>
							</div> <!-- end attributes -->
						</div> <!-- end product_attributes -->
						<div class="box-cart-bottom">
							<div>
								<p id="add_to_cart" class="buttons_bottom_block no-print">
								<div class="product-info">																		
									<button class="add_to_cart">اضافه به سبد خرید</button>
								</div>
								</p>
							</div>
						</div> <!-- end box-cart-bottom -->
					</div> <!-- end box-info-product -->
				</form>
			</div> <!-- end pb-right-column-->
		</div>
		<!-- end center infos-->	
	</div> <!-- end primary_block -->
	
	  <input type="hidden" name="goodsid" value="{$goods[id]}" />
	  <input type="hidden" name="type" value="add" />
	  <input type="hidden" name="return_url" value="'{$current_url}'" />
	</form>
</div>
cd;
	include_once('./inc/header.php');
	echo $html1;
	include_once('./inc/main-sidebar.php');
	echo $html2;
	include_once('./inc/footer.php');
?>