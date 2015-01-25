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
	$news = $db->Select("news","*","id ={$_GET['id']}");
	$pic = $db->Select("pics","*","`gid`={$news['id']} AND `kind`='2' ");

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
		اخبار
	</div>
	<!-- /Breadcrumb -->
	<div class="rte">
		<h2 style="margin-bottom:15px;">{$news["subject"]}</h2>
		<img src="./newspics/{$pic['name']}" alt="{$news["subject"]}" width="770px" height="328px" />
		<p style="font-size:22px;line-height:1.5;margin-top:15px;">
			{$news["text"]}
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