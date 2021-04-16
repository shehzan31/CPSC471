<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/medicalRecordCondition.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$insertmedicalcondition= new MedicalRecordCondition($db);

// Object Properties
$mr_number = 101010108;
$condition = "food poisoning";    

// query products
$stmt = $insertmedicalcondition->insert($mr_number, $condition);

?>