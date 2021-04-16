<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/patient.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);

// Object Properties
$H_Number = 58568858;
$MR_Number = 189456123;
$SIN = 111222;

// query products
$stmt = $patient->post($H_Number, $MR_Number, $SIN);

?>