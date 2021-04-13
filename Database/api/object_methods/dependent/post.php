<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/dependent.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$dependent= new Dependent($db);

// Object Properties
$SIN = 201201201;
$D_SSN = 200200200;
$Relationship = "brother";

// query products
$stmt = $dependent->post($SIN, $D_SSN, $Relationship);

?>