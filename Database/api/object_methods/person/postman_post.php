<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/person.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$person = new Person($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);


$SIN = $_POST['sin'];

$FName = $_POST['fname'];
$MInit = $_POST['minit'];
$LName = $_POST['lname'];
$Address_line = $_POST['address_line'];
$Province = $_POST['province'];
$City = $_POST['city'];
$Postal_code = $_POST['postal_code'];
$Gender = $_POST['gender'];
$DOB = $_POST['dob'];

  
// query products
$stmt = $person->post($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB);

echo json_encode( " " . $SIN . " " . $FName . " " . $MInit . " " . $LName . " " . $Address_line . " " . $Province . " " . $City . " " . $Postal_code . " " . $Gender . " " . $DOB);
?>