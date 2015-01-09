<?php
	header('Content-Type: text/html; charset=UTF-8');
	
	include_once("../config.php");
	include_once("../classes/functions.php");
  	include_once("../classes/messages.php");
  	include_once("../classes/session.php");	
  	include_once("../classes/security.php");
  	include_once("../classes/database.php");	
	include_once("../classes/login.php");
    include_once("../lib/persiandate.php"); 
	include_once("../lib/Zebra_Pagination.php"); 
	
	
	$login = Login::GetLogin();
    if (!$login->IsLogged())
	{
		header("Location: ../index.php");
		die(); // solve a security bug
	} 
	$db = Database::GetDatabase(); 
	
	if (isset($_GET["pm"]))
	{
		$rows = $db->SelectAll("gquality","*"," gid ={$_GET["pm"]}");
$html=<<<cd
<table border="0">
		<tr>
			<th style="width:150px;">کیفیت</th>
			<th style="width:110px;">قیمت</th> 
			<th style="width:110px;">تعداد</th>
		</tr>
cd;
		foreach($rows as $key=>$val)
		{
		$q = $db->Select("quality","*"," id ={$val[qid]}");
$html.=<<<cd
		<tr>
			<td> {$q["name"]} </td>
			<td> {$val["price"]} </td> 
			<td> {$val["mojodi"]} </td>
		</tr>		
cd;
		}
$html.=<<<cd
	</table>	
cd;
		
		
	}

echo $html;	
	
?>
