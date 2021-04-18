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

// initialize object
$insertmedicalcondition= new MedicalRecordCondition($db);

// Get contents of post

// Object properties\
$Test_ID = $_POST['t_id'];
$TName = $_POST['tname'];
$Date = $_POST['date'];
$Result = $_POST['date'];

// query products
$stmt = $test->post($TName, $Test_ID, $Date, $Result);

?>