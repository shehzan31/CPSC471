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
$H_Number = 123432441;
$MR_Number = 932492390;
$SIN = 2100789;

  
// query products
$stmt = $admin->post_patient($H_Number, $MR_Number, $SIN);
?>