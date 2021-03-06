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
	
	$slides = $db->SelectAll("slides","*",NULL," id ASC");
	
$html1=<<<cd
<body id="index" class="index hide-right-column lang_en">
	<div id="page">
cd;

	
$html2=<<<cd
<div id="center_column" class="center_column col-xs-12 accordion" style="width:80%;">
	<div class="clearfix">
		<!-- Module TmHomeSlider -->
		<div id="tmhomepage-slider">
			<ul id="tmhomeslider">
cd;

for($i=0;$i<count($slides);$i++)
{
    $ii = $i+1;
    $img = base64_encode($slides[$i]['img']);
    $src = 'data: '.$slides[$i]['itype'].';base64,'.$img;
$html2.=<<<cd
                <li class="tmhomeslider-container" id="slide_{$ii}">
                    <a href="#" title="{$slides[$i][subject]}">
                        <img src="{$src}" alt="{$slides[$i][subject]}">
                    </a>
                </li>
cd;
}

$html2.=<<<cd
			</ul>
		</div>
		<div class="clearfix">
		</div>
		<!-- /Module TmHomeSlider -->
		<div id="featured-products_block_center" class="block products_block clearfix">
			<h2 class="centertitle_block">محصولات (گروه مورد نظر)</h2>
			<div class="block_content">
				<!-- Megnor start -->
				<ul class="product_list grid row">	
				<!-- Megnor End -->
cd;

	$records_per_page = 8;
	$pagination = new Zebra_Pagination();

	$pagination->navigation_position("right");

	
	if (isset($_GET["gid"]) and isset($_GET["bid"]))
	{
		$reccount = $db->CountOf("goods","gid={$_GET[gid]} AND bid={$_GET[bid]}");
		$rows = $db->SelectAll(
				"goods",
				"*",
				"gid={$_GET[gid]} AND bid={$_GET[bid]}",
				"id desc",
				($pagination->get_page() - 1) * $records_per_page,
				$records_per_page);
	}
	else
	{
		$reccount = $db->CountAll("goods");		
		$rows = $db->SelectAll(
				"goods",
				"*",
				NULL,
				"id desc",
				($pagination->get_page() - 1) * $records_per_page,
				$records_per_page);
	}
	$pagination->records($reccount); 
	$pagination->records_per_page($records_per_page);					
$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
for($i = 0; $i < Count($rows); $i++)
{
$db->cmd = "SELECT gq.*,q.name,CONCAT(gq.price,'(',q.name,')') as pn FROM `gquality` as gq ,`quality` as q where gq.qid = q.id AND gq.gid = '{$rows[$i][id]}'";
//echo $db->cmd;
$res =$db->RunSQL();
$gqualitys = array();
if ($res)
{
	while($rawrow = mysqli_fetch_array($res)) $gqualitys[] = $rawrow;
}		
$cbgquality = DbSelectOptionTag("cbgquality",$gqualitys,"pn",NULL,NULL,NULL,NULL,"کیفیت");
		
$pics = $db->SelectAll("pics","*","`gid`={$rows[$i]['id']}","id ASC");
$html2.=<<<cd
			<form method="post" action="cart_update.php">
			<li class="ajax_block_product col-xs-12 col-sm-4 col-md-3">
				<div class="product-container" itemscope="" itemtype="http://schema.org/Product">
					<div class="left-block">
						<div class="product-image-container">
							<a class="product_img_link" href="#" title="" itemprop="url">
								<img class="replace-2x img-responsive" src="./goodspics/{$pics[0]['name']}" alt="{$rows[$i]['name']}" title="{$rows[$i]['name']}" itemprop="image" height="173" width="173">
							</a>
							
							<a class="quick-view" href="single-product{$rows[$i]['id']}.html" rel="single-product{$rows[$i]['id']}.html">
								<span>نمایش</span>
							</a>
							<!--
							<span class="new-box">
								<span class="new-label">جدید</span>
							</span>
							-->
						</div>
					</div>
					<div class="right-block">
						<h5 itemprop="name">
							<a class="product-name" href="#" title="Nascetur ridiculus mus" itemprop="url">{$rows[$i]["name"]}</a>
						</h5>
						<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="content_price">
							<div class="product-info">
								<p style="text-align:center;font-size:16px;margin-bottom:5px">قیمت {$cbgquality}</p>
					            <p style="text-align:center;font-size:16px;margin-bottom:5px">تعداد <input type="text" name="qty" value="1" size="3" /></p>
								<button class="add_to_cart">اضافه به سبد خرید</button>
							</div>
						</div>
						<div class="product-flags"></div>
					</div>
				</div><!-- .product-container> -->
			
				<input type="hidden" name="goodsid" value="{$rows[$i]["id"]}" />
				<input type="hidden" name="type" value="add" />
				<input type="hidden" name="return_url" value="'.$current_url.'" />
			 </li>
			</form>
cd;
}
$pgcodes = $pagination->render(true);
$html2.=<<<cd
				</ul>
			</div>
			{$pgcodes}
			<div class="clearfix"></div>
		</div>
	</div>
</div><!-- #center_column -->
cd;

	include_once('./inc/header.php');
	echo $html1;
	include_once('./inc/main-sidebar.php');	
	echo $html2;
	include_once('./inc/footer.php');
?>