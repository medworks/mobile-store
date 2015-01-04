<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
include_once("config.php");

//empty cart by distroying current session
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	session_destroy();
	header('Location:'.$return_url);
	
}

//add item in shopping cart
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	$goodsid 	= filter_var($_POST["goodsid"], FILTER_SANITIZE_STRING); //product code
	$qty 		= filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_INT); //product code
	$priceid    = filter_var($_POST["cbgquality"], FILTER_SANITIZE_NUMBER_INT); //price id
	$return_url = base64_decode($_POST["return_url"]); //return url
	
	$results = $mysqli->query("SELECT * FROM goods WHERE id='$goodsid' LIMIT 1");
	$obj = $results->fetch_object();	
	if ($results) 
	{ //we have the product info 
		$price = $mysqli->query("SELECT * FROM gquality WHERE id='$priceid' LIMIT 1");
		$probj = $price->fetch_object();
		
		$quality = $mysqli->query("SELECT * FROM quality WHERE id='{$probj->qid}' LIMIT 1");
		$qobj = $quality->fetch_object();				
		//prepare array for the session variable
		$new_product = array(array( 'id'=>$goodsid,'name'=>$obj->name, 'qty'=>$qty, 'priceid'=>$priceid,'price'=>$probj->price,'quality'=>$qobj->name));
		
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["id"] == $goodsid){ //the item exist in array

					$product[] = array('id'=>$cart_itm["id"],'name'=>$cart_itm["name"],  'qty'=>$qty+$cart_itm["qty"], 'priceid'=>$cart_itm["priceid"],'price'=>$cart_itm["price"],'quality'=>$cart_itm["quality"]);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('id'=>$cart_itm["id"],'name'=>$cart_itm["name"],  'qty'=>$cart_itm["qty"], 'priceid'=>$cart_itm["priceid"],'price'=>$cart_itm["price"],'quality'=>$cart_itm["quality"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["products"] = array_merge($product, $new_product);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["products"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["products"] = $new_product;
		}
		
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}

//remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"]))
{
	$product_code 	= $_GET["removep"]; //get the product code to remove
	$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
	{
		if($cart_itm["id"]!=$goodsid){ //item does,t exist in the list
			$product[] = array( 'id'=>$cart_itm["id"],'name'=>$cart_itm["name"], 'qty'=>$cart_itm["qty"],'priceid'=>$cart_itm["priceid"],'price'=>$cart_itm["price"],'quality'=>$cart_itm["quality"]);
		}
		
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}
?>