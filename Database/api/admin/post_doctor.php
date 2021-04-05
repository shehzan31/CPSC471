<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/admin.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$admin = new Admin($db);

// Object properties
$Doctor_ID = 1234567;
$SIN = 891887442;

  
// query products
$stmt = $person->post_doctor($Doctor_ID, $SIN);
?>

