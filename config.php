<?php
  error_reporting (E_ALL ^ E_NOTICE);
  
  define("_DB_NAME","shop");
  define("_DB_USER", "root");
  define("_DB_PASS", "");
  define("_DB_SERVER", "localhost");
  define("_DOMAIN", "http://localhost/mobile-store");
  

/* 
  define("_USER_IP",$_SERVER['REMOTE_ADDR']);  
  define("_ADMIN", 1);
  define("_USER", 2);
  define("_ANONYMOUS", 3); 

  define ('SITE_ROOT', '');
  define ('OS_ROOT', $_SERVER['DOCUMENT_ROOT']);
*/
  
  define ('SITE_ROOT', '/mobile-store');
  define ('OS_ROOT', $_SERVER['DOCUMENT_ROOT']."/mobile-store");
  


  //  for cart 
    $currency = 'ریال'; //Currency sumbol or code

    $db_username = 'root';
    $db_password = '';
    $db_name = 'shop';
    $db_host = 'localhost';
    $mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);

?>