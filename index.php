<?php    
	include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$db = Database::GetDatabase();
	$slides = $db->SelectAll("slides","*",NULL," id ASC");
	$news = $db->SelectAll("news","*",NULL," id ASC");
	$sections = $db->SelectAll("section","*",NULL," id ASC");

$html=<<<cd
<body>
<!-- Wrapper div -->
<div id="wrapper">
	<!-- Top header including top navigation -->
	<div id="header_navi">
        <div class="center_header">
        	<!-- Logo -->
    		<div class="logo">
                <a href="./">
                    <img src="img/logo.png" alt="" width="75" height="50" />
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
cd;
for($i=0;$i<count($slides);$i++)
{
    $ii = $i+1;
    $img = base64_encode($slides[$i]['img']);
    $src = 'data: '.$slides[$i]['itype'].';base64,'.$img;

$html.=<<<cd
            <a href=""> <img id="slide-img-{$ii}" src="{$src}"
	                class="slide" alt="" width="1000px">
	    </a>
cd;
}

$html.=<<<cd
                </div>
        	<!--content featured gallery here -->
            </div>
	    
            <script type="text/javascript">
                if(!window.slider) var slider={};
		slider.data=[{"id":"slide-img-1","client":"Valentine Day Special","desc":"14% off for only 7 days"},
		{"id":"slide-img-2","client":"Redesigned to keep you moving","desc":"25% off"},{"id":"slide-img-3","client":"Introducing the:","desc":"New classic messenger"}];
            </script>
	    
        </div>
    </div>
    <div id="slide-controls">
         <p id="slide-nav"></p>
    </div>
    <div class="clear"></div>
    <div id="header_navi">
        <div class="center_header news">
            <div class="br-news">
                <h4>تازه ها</h4>
                <ul>
cd;
for($i=0;$i<count($news);$i++)
{
$html.=<<<cd
                    <li>
			<a href='single-news{$news[$i]["id"]}.html' title='{$news[$i]["subject"]}' style="font-size:22px;font-weight:normal">{$news[$i]["subject"]}
			</a>
		    </li>
cd;
}

$html.=<<<cd
                </ul>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                                        createTicker(); 
                                    });
                </script>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <!-- Content Section -->
	<div id="content">
        <!-- Right Column -->
        <div class="right_sec">
            
            <div class="clear"></div>
            <div class="wht_sec">
            	
cd;

for($i=0;$i<count($sections);$i++)
{
	if ($i+1==1 )
	{
		$html.="<ul class='grid'>";
	}

	$pic = $db->Select("pics","*","`gid`={$sections[$i]['id']} AND `kind`='3' ");
$html.=<<<cd
                	<li>
                    	<a href="main.php"><img src="sectionspics/{$pic['name']}" alt="{$sections[$i]['name']}"></a>
                    </li>
cd;
	if (($i+1)%4 == 0 )
	{
		$html.="</ul> <ul class='grid'>";
	}	
}	
	if (($i)%2 != 0 )
	{
		$html.=" </ul> ";
	}	
$html.=<<<cd
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div id="featured-products_block_center" class="block products_block clearfix" style="border-radius:inherit;width:999px">
        <h2 class="centertitle_block">محصولات جدید</h2>
        <div class="block_content">
            <!-- Megnor start -->
            <ul class="product_list grid row">  
            <!-- Megnor End -->                 
                <li class=" ajax_block_product col-xs-12 col-sm-4 col-md-3   first-in-line first-item-of-tablet-line first-item-of-mobile-line">
                    <div class="product-container" itemscope="" itemtype="http://schema.org/Product">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link" href="#" title="" itemprop="url">
                                    <img class="replace-2x img-responsive" src="./img/product/2-1.jpg" alt="Nascetur ridiculus mus" title="Nascetur ridiculus mus" itemprop="image" height="173" width="173">
                                </a>
                                <div class="content_price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                    <span itemprop="price" class="price product-price">125000 ریال</span>
                                    <meta itemprop="priceCurrency" content="1">
                                </div>
                                <span class="new-box">
                                    <span class="new-label">جدید</span>
                                </span>
                            </div>
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name">
                                <a class="product-name" href="#" title="Nascetur ridiculus mus" itemprop="url">ال سی دی</a>
                            </h5>
                            <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="content_price">
                                <span itemprop="price" class="price product-price">125000 ریال</span>
                                <meta itemprop="priceCurrency" content="1">
                            </div>
                            <div class="product-flags"></div>
                        </div>
                    </div><!-- .product-container> -->
                </li>               
                                                  
            </ul>
        </div>
    </div>
</div>
cd;
    include_once('./inc/header.php');
    echo $html;
    include_once('./inc/footer.php');
?>