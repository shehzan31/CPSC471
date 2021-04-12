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

// Object Properties
$Doctor_ID = 123456789;
$H_Number = 201201201;
$Condition = "constipation";
$Date = "2021-02-16";
$Chart = "hair blockage";

// query products
$stmt = $finds->post($Doctor_ID, $H_Number, $Condition, $Date, $Chart);

?>