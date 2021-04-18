<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/medical_record_tests.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$insertmedicaltests= new Medical_Records_Tests($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$mr_number = $_POST['mr_num'];
$test = $_POST['test'];    

// query products
$stmt = $insertmedicaltests->post($mr_number, $test);

?>