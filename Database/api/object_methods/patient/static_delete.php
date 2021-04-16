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

// Object properties
$H_Number = 58568858;
  
// query products
$stmt = $patient->delete_patient($H_Number);

?>