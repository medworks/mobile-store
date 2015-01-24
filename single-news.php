<?php
	session_start();	

$html1=<<<cd
	<body id="product" class="product product-20 product-printed-summer-dress category-11 category-camcorder hide-right-column lang_en">
	<div id="page">
cd;

$itemscount = count($_SESSION["products"]);
$html2=<<<cd
<div id="center_column" class="center_column col-xs-12" style="width:80%;">				
	<!-- Breadcrumb -->
	<div class="breadcrumb clearfix rtl">
		<a class="home" href="./" title="Return to Home"><i class="icon-home"></i></a>
		<span class="navigation-pipe">&gt;</span>
		اخبار
	</div>
	<!-- /Breadcrumb -->
	<div class="rte">
		<h2 style="margin-bottom:15px;">عنوان خبر</h2>
		<img src="./img/slides/1.jpg" alt="" width="770px" height="328px" />
		<p style="font-size:22px;line-height:1.5;margin-top:15px;">
			توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... توضیحات خبر... 
		</p>
	</div>
</div>
	
cd;
	include_once('./inc/header.php');
	echo $html1;
	include_once('./inc/main-sidebar.php');
	echo $html2;
	include_once('./inc/footer.php');
?>