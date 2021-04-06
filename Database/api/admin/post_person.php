<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/admin.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$admin = new Admin($db);

// Object properties
$SIN = 891887444;
$FName = "Eric";
$MInit = "U";
$LName = "Doe";
$Address_line = "2330 12th St NW";
$Province = "AB";
$City = "Calgary";
$Postal_code = "T3X 4E4";
$Gender = "Female";
$DOB = "2021-01-02";
  
// query products
$stmt = $admin->post_person($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB);

?>