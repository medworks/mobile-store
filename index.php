<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//FA" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>فروشگاه تجهیزات موبایل</title>
<link href="./css/custom.css" rel="stylesheet" type="text/css" />
<!-- Accordin Menu Script files Start -->
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/ddaccordion.js"></script>
<script type="text/javascript" src="./js/acordin.js"></script>
<!-- Accordin Menu Script files End -->
<!-- Banner Start -->
<!-- <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script> -->
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/scripts.js"></script>
<link rel="stylesheet" href="./css/banner.css" type="text/css" media="screen" />  
<!-- Banner End -->
<!-- Drop Down Start -->
<link rel="stylesheet" type="text/css" href="./css/jqueryslidemenu.css" />

<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->

<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/jqueryslidemenu.js"></script>
<!-- Drop Down End -->

</head>

<body>

<!-- Wrapper div -->
<div id="wrapper">
	<!-- Top header including top navigation -->
	<div id="header_navi">
        <div class="center_header">
        	<!-- Logo -->
    		<div class="logo">
                <a href="./">
                    <img src="./img/logo.png" alt="" width="75" height="50" />
                </a><br>
            </div>
            <div class="navi_right">
                <ul>
                    <li><a href="#" class="signin"><span class="dis_none">Sign In</span></a></li>
                    <li><a href="#" class="contact"><span class="dis_none">Contact</span></a></li>
                    <li><a href="#" class="faqs"><span class="dis_none">FAQs</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- Banner -->
    <div id="header">
        <div class="wrap">
            <div id="slide-holder">
                <div id="slide-runner">
                    <a href=""><img id="slide-img-1" src="img/slides/4.jpg" class="slide" alt=""></a>
                    <a href=""><img id="slide-img-2" src="img/slides/5.jpg" class="slide" alt=""></a>
                    <a href=""><img id="slide-img-3" src="img/slides/6.jpg" class="slide" alt=""></a>
                    
                </div>
        	<!--content featured gallery here -->
            </div>
            <script type="text/javascript">
                if(!window.slider) var slider={};slider.data=[{"id":"slide-img-1","client":"Valentine Day Special","desc":"14% off for only 7 days"},{"id":"slide-img-2","client":"Redesigned to keep you moving","desc":"25% off"},{"id":"slide-img-3","client":"Introducing the:","desc":"New classic messenger"}];
            </script>
        </div>
    </div>
    <div id="slide-controls">
         <!-- <p id="slide-client" class="text"><span></span></p> -->
         <!-- <p id="slide-desc" class="text"></p> -->
         <p id="slide-nav"></p>
    </div>
    <div class="clear"></div>
    <!-- <div class="cont_top">&nbsp;</div> -->
    <!-- Content Section -->
	<div id="content">
        <!-- Right Column -->
        <div class="right_sec">
            
            <div class="clear"></div>
            <div class="wht_sec">
            	<ul class="grid">
                	<li>
                    	<a href="main.php"><img src="img/product/battery.jpg" alt=""></a>
                    </li>
                    <li>
                    	<a href="main.php"><img src="img/product/hard.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href="main.php"><img src="img/product/housing.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href="main.php"><img src="img/product/battery.jpg" alt=""></a>
                    </li>
                </ul>
                <ul class="grid">
                    <li>
                        <a href="main.php"><img src="img/product/battery.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href="main.php"><img src="img/product/hard.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href="main.php"><img src="img/product/housing.jpg" alt=""></a>
                    </li>
                    <li>
                        <a href="main.php"><img src="img/product/battery.jpg" alt=""></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- <div class="cont_botm">&nbsp;</div> -->
    <div class="clear"></div>
</div>
<?php
    include_once('./inc/index-footer.php');
?>