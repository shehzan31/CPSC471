<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/test.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$test = new Test($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$Test_ID = $_POST['test_id'];
$Result = $_POST['result'];


// query products
$stmt = $test->edit_result($Test_ID, $Result);

?>