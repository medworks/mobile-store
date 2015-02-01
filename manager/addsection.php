<?php
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
	include_once("../lib/persiandate.php");
	
	$imgload="";
	
	$login = Login::GetLogin();
	if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	}
	$db = Database::GetDatabase();
	
	function uploadpics($mode,$fileup,$db,$id,$lvl,$filename=NULL)
	{
		$target_dir = "../sectionspics/";
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
				// kind 1 is for goods pics, 2 is for news pics, 3 is for section pics
				if (move_uploaded_file($_FILES[$fileup]["tmp_name"], $target_file)) 
				{	
					$fn = $filename.".".$imageFileType;
					$fields = array("`kind`","`gid`","`lvl`","`name`");				
					$values = array("'3'","'{$id}'","{$lvl}","'{$fn}'");
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
					$lpic = $db->Select("pics","*","gid = '{$id}' AND kind='3' AND lvl='{$lvl}'");
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
						$values = array("'3'","'{$id}'","{$lvl}","'{$fn}'");
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
	
	if ($_POST["mark"]=="savesec")
	{
		$fields = array("`name`");		
		$values = array("'{$_POST[edtsubject]}'",);	
		if (!$db->InsertQuery('section',$fields,$values)) 
		{			
			header('location:addsection.php?act=new&msg=2');			
		} 	
		else 
		{  		
			$id = $db->InsertId();
			uploadpics("insert","userfile",$db,$id,"1",$id."-1");
			//echo $db->cmd;
			header('location:addsection.php?act=new&msg=1');
		}  		
	}
	else
	if ($_POST["mark"]=="editsec")
	{		
		$id = $_GET["did"];
		$values = array("`name`"=>"'{$_POST[edtsubject]}'");
		$db->UpdateQuery("section",$values,array("id='{$_GET[did]}'"));
		uploadpics("edit","userfile",$db,$id,"1",$id."-1");		
		header('location:addsection.php?act=new&msg=1');
	}
	
	if ($_GET['act']=="new")
	{
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ثبت</button>
			<input type='hidden' name='mark' value='savesec' /> ";
	}
	
	
	
	if ($_GET['act']=="edit")
	{
		$row=$db->Select("section","*","id='{$_GET[did]}'",NULL);		
		$insertoredit = "
			<button id='submit' type='submit' class='btn btn-default'>ویرایش</button>
			<input type='hidden' name='mark' value='editsec' /> ";
	}
  
$html.=<<<cd
    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->
                        <h3 class="ls-top-header">ثبت دسته </h3>
                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="fa fa-home"></i></a></li>
                            <li class="active">ثبت دسته</li>
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
                                    <h3 class="panel-title">عنوان</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input id="edtsubject" name="edtsubject" type="text" class="form-control" value = " {$row["name"]}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">انتخاب عکس</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row ls_divider last">
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-2 ls-group-input">
                                                <input kl_virtual_keyboard_secure_input="on" id="userfile"  name="userfile" class="file" multiple="true" data-preview-file-type="any" type="file" />
                                            </div>
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
                                    <h3 class="panel-title">ثبت دسته</h3>
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
cd;
	include_once("./inc/header.php");
	echo $html;
	include_once("./inc/footer.php")
?>