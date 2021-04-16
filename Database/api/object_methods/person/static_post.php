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

// Object properties
$SIN = 891877442;
$FName = "John";
$MInit = "K";
$LName = "Smoth";
$Address_line = "2334 16th St NW";
$Province = "AB";
$City = "Calgary";
$Postal_code = "T3V 8E7";
$Gender = "Male";
$DOB = "2001-01-02";
  
// query products
$stmt = $person->post($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB);

?>