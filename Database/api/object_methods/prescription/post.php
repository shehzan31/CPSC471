<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/prescription.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$prescription = new Prescription($db);

// Object Properties
$Pname = "Colon medicine";
$Type = "Tablets";
$Field = "Painkiller";

// query products
$stmt = $prescription->post($Pname, $Type, $Field);

?>