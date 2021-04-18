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

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$H_Number = $_POST['h_num'];


// query products
$stmt = $patient->delete($H_Number);

?>