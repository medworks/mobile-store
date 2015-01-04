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
	$return_url = base64_decode($_POST["return_url"]); //return url
	
	//limit quantity for single product
	if($product_qty > 10){
		die('<div align="center">This demo does not allowed more than 10 quantity!<br /><a href="http://sanwebe.com/assets/paypal-shopping-cart-integration/">Back To Products</a>.</div>');
	}

	//MySqli query - get details of item from db using product code
	$results = $mysqli->query("SELECT * FROM goods WHERE id='$goodsid' LIMIT 1");
	$obj = $results->fetch_object();
	
	if ($results) { //we have the product info 
		
		//prepare array for the session variable
		$new_product = array(array( 'id'=>$goodsid,'name'=>$obj->name, 'qty'=>$qty, 'price'=>$obj->price));
		
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["id"] == $goodsid){ //the item exist in array

					$product[] = array('id'=>$cart_itm["id"],'name'=>$cart_itm["name"],  'qty'=>$qty, 'price'=>$cart_itm["price"]);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('id'=>$cart_itm["id"],'name'=>$cart_itm["name"],  'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
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
			$product[] = array( 'id'=>$cart_itm["id"],'name'=>$cart_itm["name"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
		}
		
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}
?>