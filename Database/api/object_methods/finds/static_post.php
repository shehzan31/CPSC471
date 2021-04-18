<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/finds.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$finds= new Finds($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$Doctor_ID = 123456789;
$H_Number = 200200200;
$Condition = "headache";
$Date = "2021-01-16";
$Chart = "stress";

// query products
$stmt = $finds->post($Doctor_ID, $H_Number, $Condition, $Date, $Chart);

?>