<?php
        include_once("config.php");
	include_once("classes/functions.php");
  	include_once("classes/session.php");	
  	include_once("classes/security.php");
  	include_once("classes/database.php");	
	
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	
	$db = Database::GetDatabase();
	
	$rwnews = $db->SelectAll("news","*",NULL,"id DESC",0,4);
	
	$Tell_Number = GetSettingValue('Tell_Number',0);
	$Address = GetSettingValue('Address',0);
	$Contact_Email = GetSettingValue('Contact_Email',0);
        $Rss_Add = GetSettingValue('Rss_Add',0);
	$FaceBook_Add = GetSettingValue('FaceBook_Add',0);
	$Twitter_Add = GetSettingValue('Twitter_Add',0);
	$Gplus_Add = GetSettingValue('Gplus_Add',0);
	
	$About_System = GetSettingValue('About_System',0);
	$About_System= (mb_strlen($About_System)>450) ? mb_substr($About_System,0,450,"UTF-8")."..." : $About_System;
        
$html=<<<cd
                </div><!-- .row -->
            </div><!-- #columns -->
        </div><!-- .columns-container -->
    </div><!-- #page -->    <!-- Footer -->
    <div class="footer">
        <div class="containfoot ">
            <div class="social">
                <ul>
                    <li><a href="{$FaceBook_Add}" title="Facebook" class="facebook"></a></li>
                    <li><a href="{$Twitter_Add}" title="Twitter" class="twitter"></a></li>
                    <li><a href="{$Gplus_Add}" title="Google plus" class="gplus"></a></li>
                    <li><a href="{$Rss_Add}" title="RSS" class="rss"></a></li>
                </ul>
            <div class="clear"></div>

                 <div class="contactus">
                    <a href="javascript:void(0);" title="تماس با ما"></a>
                </div>
            </div>

            <div class="option">
                <ul>
                    <li><span class="deliver"></span><p>حمل به تمام کشور با سریع ترین زمان</p></li>
                    <li><span class="garanty"></span><p>گارانتی برگشت محصول</p></li>
                    <li><span class="gift"></span><p>هدایای ویژه در ایام خاص</p></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="column">
                <div class="one">
                    <h4>اطلاعات تماس</h4>
                    <ul>
                        <li>ایمیل: <a href="gavascript:void(0);" title="">{$Contact_Email}</a></li>
                        <li>تلفن: <a href="gavascript:void(0);" title="" style="display:inline-block;direction:ltr">{$Tell_Number}</a></li>
                        <li>آدرس: <a href="gavascript:void(0);" title="">{$Address}</a></li>
                    </ul>
                </div>
                <div class="two">
                    <h4>پرفروش ترین ها</h4>
                    <ul>
                        <li><a href="gavascript:void(0);" title="">ال سی دی</a></li>
                        <li><a href="gavascript:void(0);" title="">تاچ</a></li>
                        <li><a href="gavascript:void(0);" title="">باطری</a></li>
                        <li><a href="gavascript:void(0);" title="">باطری</a></li>
                    </ul>
                </div>
                <div class="three">
                    <h4>اخبار و تازه ها</h4>
                    <ul>
                        <li><a href="gavascript:void(0);" title="{$rwnews[0]["subject"]}">{$rwnews[0]["subject"]}</a></li>
                        <li><a href="gavascript:void(0);" title="{$rwnews[1]["subject"]}">{$rwnews[1]["subject"]}</a></li>
                        <li><a href="gavascript:void(0);" title="{$rwnews[2]["subject"]}">{$rwnews[2]["subject"]}</a></li>
                        <li><a href="gavascript:void(0);" title="{$rwnews[3]["subject"]}">{$rwnews[3]["subject"]}</a></li>
                    </ul>
                </div>
                <div class="four">
                    <h4>اطلاعات مفید</h4>
                    <ul>
                        <li><a href="gavascript:void(0);" title="">نحوه پرداخت</a></li>
                        <li><a href="gavascript:void(0);" title="">نحوه گارانتی کالا</a></li>
                        <li><a href="gavascript:void(0);" title="">نحوه خرید از ما</a></li>
                        <li><a href="gavascript:void(0);" title="">نحوه خرید از ما</a></li>
                    </ul>
                </div>
                <div class="five">
                    <h4>بانک ها</h4>
                    <ul>
                        <li><a href="gavascript:void(0);" title=""><img src="./img/bank-mellat.png" alt="bank mellat" height="40" width="40" /></a></li>
                        <li><a href="gavascript:void(0);" title=""><img src="./img/bank-melli.png" alt="bank melli" height="40" width="40" /></a></li>
                        <li><a href="gavascript:void(0);" title=""><img src="./img/bank-pasargad.png" alt="bank pasargad" height="40" width="40" /></a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- BOT Footer -->
    <div class="botfooter">
        <p class="left latin">Copyright 2014 Mobile </p>
        <p class="right latin">Design by <a href="http://www.mediateq.ir">Mediateq.ir</a></p>
    </div>
    <script type="text/javascript">
        var CUSTOMIZE_TEXTFIELD = 1;
        var FancyboxI18nNext = 'Next';
        var FancyboxI18nPrev = 'Previous';
        var FancyboxboxI18nClose = 'Close';
        var added_to_wishlist = 'Added to your wishlist.';
        var ajax_allowed = true;
        var ajaxsearch = true;
        var baseDir = '';
        var baseUri = '';
        var blocksearch_type = 'top';
        var contentOnly = false;
        var customizationIdMessage = 'Customization #';
        var delete_txt = 'Delete';
        var favorite_products_url_add = '';
        var favorite_products_url_remove = '';
        var freeProductTranslation = 'Free!';
        var freeShippingTranslation = 'Free shipping!';
        var id_lang = 1;
        var img_dir = '';
        var instantsearch = false;
        var isGuest = 0;
        var isLogged = 0;
        var loggin_required = 'You must be logged in to manage your wishlist.';
        var mywishlist_url = '';
        var page_name = 'index';
        var placeholder_blocknewsletter = 'Enter your e-mail';
        var priceDisplayMethod = 1;
        var priceDisplayPrecision = 2;
        var quickView = true;
        var removingLinkText = 'remove this product from my cart';
        var roundMode = 2;
        var search_url = '';
        var static_token = '95b0ad58420de6f608d1631007e0bde2';
        var token = 'fe6aaea9a580e36f76197eea52daf9cf';
        var usingSecureMode = false;
        var wishlistProductsIds = false;
    </script>
    <script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="./js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="./js/jquery.easing.js"></script>
    <script type="text/javascript" src="./js/tools.js"></script>
    <script type="text/javascript" src="./js/global.js"></script>
    <script type="text/javascript" src="./js/10-bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/15-jquery.total-storage.min.js"></script>
    <script type="text/javascript" src="./js/15-jquery.uniform-modified.js"></script>
    <script type="text/javascript" src="./js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="./js/products-comparison.js"></script>
    <script type="text/javascript" src="./js/ajax-cart.js"></script>
    <script type="text/javascript" src="./js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="./js/jquery.serialScroll.js"></script>
    <script type="text/javascript" src="./js/jquery.bxslider.js"></script>
    <script type="text/javascript" src="./js/product.js"></script>
    <script type="text/javascript" src="./js/treeManagement.js"></script>
    <script type="text/javascript" src="./js/blocknewsletter.js"></script>
    <script type="text/javascript" src="./js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="./js/blocksearch.js"></script>
    <script type="text/javascript" src="./js/ajax-wishlist.js"></script>
    <script type="text/javascript" src="./js/favoriteproducts.js"></script>
    <script type="text/javascript" src="./js/tmhomeslider.js"></script>
    <script type="text/javascript" src="./js/hoverIntent.js"></script>
    <script type="text/javascript" src="./js/superfish-modified.js"></script>
    <script type="text/javascript" src="./js/blocktopmenu.js"></script>
    <script type="text/javascript" src="./js/owl.carousel.js"></script>
    <script type="text/javascript" src="./js/custom.js"></script>
    <!-- <script type="text/javascript">
    var tmhomeslider_loop=1;
         var tmhomeslider_width=770;
         var tmhomeslider_speed=500;
         var tmhomeslider_pause=3000;
    </script> -->
    
</body>
</html>
cd;

    echo $html;
?>
