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
	
	function uploadpics($mode,$fileup,$db,$id,$lvl,$filename=NULL)
	{
		$target_dir = "../goodspics/";
		$imageFileType = pathinfo($_FILES[$fileup]["name"],PATHINFO_EXTENSION);
		//$target_file = $target_dir . basename($_FILES[$fileup]["name"]);
		if (!isset($filename))
		{
			$target_file = $target_dir . basename($_FILES[$fileup]["name"]);
		}
		else
		{
			$target_file = $target_dir .$filename.".".$imageFileType;
		}
		$uploadOk = 1;
		
		
		if(isset($_POST["submit"])) 
		{
			$check = getimagesize($_FILES[$fileup]["tmp_name"]);
			if($check !== false) 
			{				
				$uploadOk = 1;
			} 
			else 
			{
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		/* if (file_exists($target_file)) 
		{
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		} */
		// Check file size
		if ($_FILES[$fileup]["size"] > 500000) 
		{
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && 
		$imageFileType != "jpeg"&& $imageFileType != "gif" ) 
		{
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) 
		{
			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} 
		else 
		{    
			if ($mode == "insert")
			{
				// kind 1 is for goods pics, 2 is for news pics
				if (move_uploaded_file($_FILES[$fileup]["tmp_name"], $target_file)) 
				{	
					$fn = $filename.".".$imageFileType;
					$fields = array("`kind`","`gid`","`lvl`","`name`");				
					$values = array("'1'","'{$id}'","{$lvl}","'{$fn}'");
					$db->InsertQuery('pics',$fields,$values);
				} 
				else 
				{
					echo "Sorry, there was an error uploading your file.";
				}
			}
			else
			{
				//if (!empty($_FILES[$fileup]["name"])) 
				{
					$lpic = $db->Select("pics","*","gid = '{$id}' AND kind='1' AND lvl='{$lvl}'");
					$lfn = $target_dir.$lpic["name"];
					if (file_exists($lfn)&& $lpic["name"]!="")
					{
						unlink($lfn);
					}
					$db->Delete("pics"," id",$lpic["id"]);	
					if (move_uploaded_file($_FILES[$fileup]["tmp_name"], $target_file)) 
					{	
						$fn = $filename.".".$imageFileType;
						$fields = array("`kind`","`gid`","`lvl`","`name`");				
						$values = array("'1'","'{$id}'","{$lvl}","'{$fn}'");
						$db->InsertQuery('pics',$fields,$values);
						//echo $db->cmd;
					} 
					else 
					{
						echo "Sorry, there was an error uploading your file.";
					}
				}	
			}
		}
	}
	
	if ($_POST["mark"]=="savegoods")
	{		
		//$date = date('Y-m-d H:i:s');
		$fields = array("`bid`","`gid`","`code`","`name`","`qid`","`price`","`mojodi`","`desc`");
		$values = array("'{$_POST[cbbrands]}'","'{$_POST[cbgroups]}'","'{$_POST[edtcode]}'",
		                "'{$_POST[edtname]}'","'{$_POST[cbquality]}'","'{$_POST[edtprice]}'",
						"'{$_POST[edtmojodi]}'","'{$_POST[txtdesc]}'");	
		if (!$db->InsertQuery('goods',$fields,$values)) 
		{			
			header('location:addproduce.php?act=new&msg=2');			
		} 	
		else 
		{  	
			$id = $db->InsertId();
			$quality = $db->SelectAll("quality","*");
			$fields = array("`gid`","`qid`","`price`","`mojodi`");
			for($i=0;$i<count($quality);$i++)
			{
				$ii = $i+1;
				if ($_POST["chbqlty$ii"])
				{
					$values = array("'{$id}'","'{$_POST[chbqlty.$ii]}'","'{$_POST[edtprice.$ii]}'","'{$_POST[edtmojodi.$ii]}'");
					$db->InsertQuery('gquality',$fields,$values);
				}	
			}	
			uploadpics("insert","userfile1",$db,$id,"1",$id."-1");
			uploadpics("insert","userfile2",$db,$id,"2",$id."-2");
			uploadpics("insert","userfile3",$db,$id,"3",$id."-3");
			header('location:addproduce.php?act=new&msg=1');
		}
		//echo $db->cmd;
	}
	else
	if ($_POST["mark"]=="editgoods")
	{		
				
		$values = array("`bid`"=>"'{$_POST[cbbrands]}'","`gid`"=>"'{$_POST[cbgroups]}'",
						"`code`"=>"'{$_POST[edtcode]}'","`name`"=>"'{$_POST[edtname]}'",
						"`qid`"=>"'{$_POST[cbquality]}'","`price`"=>"'{$_POST[edtprice]}'",
						"`mojodi`"=>"'{$_POST[edtmojodi]}'","`desc`"=>"'{$_POST[txtdesc]}'");
        $db->UpdateQuery("goods",$values,array("id='{$_GET[did]}'"));

			$id = $_GET["did"];
			$db->Delete("gquality"," gid",$id);	
			$quality = $db->SelectAll("quality","*");
			$fields = array("`gid`","`qid`","`price`","`mojodi`");
			for($i=0;$i<count($quality);$i++)
			{
				$ii = $i+1;
				if ($_POST["chbqlty$ii"])
				{
					$values = array("'{$id}'","'{$_POST[chbqlty.$ii]}'","'{$_POST[edtprice.$ii]}'","'{$_POST[edtmojodi.$ii]}'");
					$db->InsertQuery('gquality',$fields,$values);
				}	
			}	
			uploadpics("edit","userfile1",$db,$id,"1",$id."-1");
			uploadpics("edit","userfile2",$db,$id,"2",$id."-2");
			uploadpics("edit","userfile3",$db,$id,"3",$id."-3");
			
		header('location:addproduce.php?act=new&msg=1');
	}
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savegoods' /> ";
					
		$brands = $db->SelectAll("brands","*");	
		$cbbrands = DbSelectOptionTag("cbbrands",$brands,"name",NULL,NULL,"form-control",NULL,"  انتخاب برند  ");
		
		$groups = $db->SelectAll("groups","*");	
		$cbgroups = DbSelectOptionTag("cbgroups",$groups,"name",NULL,NULL,"form-control",NULL,"  انتخاب گروه  ");
		
		$quality = $db->SelectAll("quality","*");		
$gquality=<<<cd
	<table border="0">
		<tr>
			<th style="width:150px;">کیفیت</th>
			<th style="width:110px;">قیمت</th> 
			<th style="width:110px;">تعداد</th>
		</tr>
cd;
for($i=0;$i<count($quality);$i++)
{
	$ii= $i+1;
$gquality.=<<<cd
		<tr>
			<td> <input type="checkbox" id="chbqlty{$ii}" name="chbqlty{$ii}" value="{$quality[$i][id]}" /> {$quality[$i]["name"]} </td>
			<td> <input type="text" id="edtprice{$ii}" name="edtprice{$ii}" style="width:80px;" /> </td> 
			<td> <input type="text" id="edtmojodi{$ii}" name="edtmojodi{$ii}" style="width:80px;"/> </td>
		</tr>		
cd;
}
$gquality.=<<<cd
	</table>	
cd;
	}
	
		
	if ($_GET['act']=="edit")
	{
	    $row=$db->Select("goods","*","id='{$_GET["did"]}'",NULL);
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editgoods' /> ";

		$brands = $db->SelectAll("brands","*");	
		$cbbrands = DbSelectOptionTag("cbbrands",$brands,"name",$row["bid"],NULL,"form-control",NULL,"  انتخاب برند  ");
		
		$groups = $db->SelectAll("groups","*");	
		$cbgroups = DbSelectOptionTag("cbgroups",$groups,"name",$row["gid"],NULL,"form-control",NULL,"  انتخاب گروه  ");
		
		$ggquality = $db->SelectAll("gquality","*","gid ='{$row[id]}'");
//echo $db->cmd;		
		$quality = $db->SelectAll("quality","*");
$gquality=<<<cd
	<table border="0">
		<tr>
			<th style="width:150px;">کیفیت</th>
			<th style="width:110px;">قیمت</th> 
			<th style="width:110px;">تعداد</th>
		</tr>
cd;
for($i=0;$i<count($quality);$i++)
{
	$ii= $i+1;
	//if ($i<count($ggquality))
	{
		//echo "$i->",$ggquality[$i]["qid"]."<br/>";
		if (in_array($quality[$i]["id"],array_column($ggquality, 'qid')))
		//if ($ggquality[$i]["qid"]==$quality[$i]["id"])		
		{
			$ggqual = $db->Select("gquality","*","qid ='{$quality[$i][id]}'");	
			$eprice  = $ggqual["price"];
			$emojodi = $ggqual["mojodi"];
		}
		else
		{
			$eprice = "";
			$emojodi = "";
		}
	}	
$gquality.=<<<cd
		<tr>
			<td> <input type="checkbox" id="chbqlty{$ii}" name="chbqlty{$ii}" value="{$quality[$i][id]}" /> {$quality[$i]["name"]} </td>
			<td> <input type="text" id="edtprice{$ii}" name="edtprice{$ii}" style="width:80px;" value="{$eprice}" /> </td> 
			<td> <input type="text" id="edtmojodi{$ii}" name="edtmojodi{$ii}" style="width:80px;" value="{$emojodi}"/> </td>
		</tr>		
cd;

}
$gquality.=<<<cd
	</table>	
cd;
	}
  
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ایجاد محصول</h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">ایجاد محصول</li>
                        </ol>
                        <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <form id="frmnews" name="frmnews" enctype="multipart/form-data" action="" method="post" class="form-inline ls_form" role="form">   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب برند</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio-inline">
                                    	{$cbbrands}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب گروه</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio-inline">
                                    	{$cbgroups}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">نام محصول</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtname" name="edtname" type="text" class="form-control" value = " {$row["name"]}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">کد محصول</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtcode" name="edtcode" type="text" class="form-control" value = " {$row["code"]}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">کیفیت محصول</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="radio-inline">
                                    	{$gquality}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<!--
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">قیمت محصول</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtprice" name="edtprice" type="text" class="form-control" value = " {$row["price"]}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">تعداد در انبار</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtmojodi" name="edtmojodi" type="text" class="form-control" value = " {$row["mojodi"]}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
					-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">توضیحات</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="col-md-10 ls-group-input">
                                            <textarea class="animatedTextArea form-control " id="txtdesc" name="txtdesc"> {$row["desc"]}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">عکس اول محصول</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2 ls-group-input">
                                                <input kl_virtual_keyboard_secure_input="on" id="userfile1"  name="userfile1" class="file" multiple="true" data-preview-file-type="any" type="file" />
                                            </div>
                                        </div>
                                    </div>
									{$imgload}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">عکس دوم محصول</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2 ls-group-input">
                                                <input kl_virtual_keyboard_secure_input="on" id="userfile2"  name="userfile2" class="file" multiple="true" data-preview-file-type="any" type="file" />
                                            </div>
                                        </div>
                                    </div>
									{$imgload}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">عکس سوم محصول</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2 ls-group-input">
                                                <input kl_virtual_keyboard_secure_input="on" id="userfile3"  name="userfile3" class="file" multiple="true" data-preview-file-type="any" type="file" />
                                            </div>
                                        </div>
                                    </div>
									{$imgload}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">ثبت محصول</h3>
                                </div>
                                <div class="panel-body">
                                    {$insertoredit}
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cbmenu").change(function(){
				var id= $(this).val();
				$.get('./ajaxcommand.php?smid='+id,function(data) {			
						$('#sm1').html(data);
						
						$("#cbsm1").change(function(){
							var id= $(this).val();
							$.get('./ajaxcommand.php?smid2='+id,function(data) {			
								$('#sm2').html(data);
							});
						});			
				});
			});			
		
		});
	</script>
cd;
	include_once("./inc/header.php");
	echo $html;
	include_once("./inc/footer.php")
?>