<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/diagnosis.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// initialize object
$diagnosis= new Diagnosis($db);

// Object Properties
$Condition = $_POST['cond'];

// query products
$stmt = $diagnosis->delete($Condition);

?>