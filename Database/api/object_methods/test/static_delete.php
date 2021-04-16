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

// Object properties
$Test_ID = 153453543;
  
// query products
$stmt = $test->delete_test($Test_ID);

?>