<?php
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	

	$db = Database::GetDatabase();
	$pic = NULL;	
	if (isset($_GET["slide"])and $_GET["slide"]=="yes")
	{
		$pic = $db->Select("slides","*","`id`='{$_GET[did]}'");
	}	
	
	//echo $db->cmd;
	header("Content-type: {$pic[itype]}");
	//echo base64_decode($pic['img']);
	//echo base64_encode($pic['img']);
	echo $pic['img']
	//echo $img;	
?>