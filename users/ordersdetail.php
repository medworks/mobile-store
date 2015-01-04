<?php
    include_once("../config.php");
    include_once("../classes/functions.php");
    include_once("../classes/messages.php");
    include_once("../classes/session.php"); 
    include_once("../classes/security.php");
    include_once("../classes/database.php");    
    include_once("../classes/login.php");
    include_once("../lib/persiandate.php"); 

    $login = Login::GetLogin();
    if (!$login->IsLogged())
    {
        header("Location: ../index.php");
        die(); // solve a security bug
    }
    $db = Database::GetDatabase();
    
       
           
    if (isset($_GET["act"]) and $_GET["act"]=="view")
    {
	$row = $db->Select("classes","*","id ={$_GET['did']}");
	$pic = $db->Select("clspics","*","cid='{$_GET['did']}' AND tid='1' ");
	$class = $db->Select("defclasses","*","id ={$row['clsid']}");
	$img = base64_encode($pic['img']);
	$src = 'data: '.$pic['itype'].';base64,'.$img;
	$regdate = ToJalali($row["regdate"]," l d F  Y ساعت H:i");
        if($row["tahol"] ==0)
        {
          $row["tahol"] = "مجرد" ;
        }
        else
        {
            $row["tahol"]="متاهل" ;
        }
    
        //echo $db->cmd;
    }
	
    if ((isset($_POST["mark"]) and $_POST["mark"]=="confirm"))
    {
	$values = array("`confirm`"=>"'1'");
	$db->UpdateQuery("classes",$values,array("id='{$_GET[did]}'"));		
	header('location:regclassconf.php?act=new');
    }
    
$html=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">مشخصات سفارش دهنده</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">مشخصات سفارش دهنده</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form id="frmdata" name="frmdata" enctype="multipart/form-data" action="" method="post" class="form-inline ls_form" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تاریخ</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        {$regdate}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">شماره پیگیری بانک</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">مبلغ</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">نام و نام خانوادگی</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtname" name="edtname" type="text" class="form-control" value="{$row["name"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">نام فروشگاه</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtfather" name="edtfather" type="text" class="form-control" value="{$row["father"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">استان</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtostan" name="edtostan" type="text" class="form-control" value="{$row["ostan"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">شهر</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtshahr" name="edtshahr" type="text" class="form-control" value="{$row["shahr"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">آدرس</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtaddress" name="edtaddress" type="text" class="form-control" value="{$row["address"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تلفن</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edttel" name="edttel" type="text" class="form-control" value="{$row["tel"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">موبایل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtmobile" name="edtmobile" type="text" class="form-control" value="{$row["mobile"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ایمیل</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtemail" name="edtemail" type="text" class="form-control" value="{$row["email"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">توضیحات</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtdesc" name="edtdesc" type="text" class="form-control" value="{$row["desc"]}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">وضعیت کالا</h3>
                                </div>
                                <div class="panel-body">
                                        برگشتی<input id="edtdesc" name="status" type="radio" class="form-control" value="bargashti"/><br />
                                        وصولی<input id="edtdesc" name="status" type="radio" class="form-control" value="vosuli" checked/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تایید</h3>
                                </div>
                                <div class="panel-body">
                                    <button id="submit" type="submit" class="btn btn-default">تایید</button>
                                    <input type="hidden" name="mark" value="confirm"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Main Content Element  End-->
            </div>
        </div>
    </section>
    <!--Page main section end -->
cd;

    include_once("./inc/header.php");
    echo $html;
    include_once("./inc/footer.php");
?>