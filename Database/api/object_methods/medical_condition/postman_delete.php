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

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$condition = $_POST['cond'];    

// query products
$stmt = $insertmedicalcondition->delete($condition);

?>