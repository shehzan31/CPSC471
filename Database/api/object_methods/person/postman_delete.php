<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/person.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$person = new Person($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);


$SIN = $_POST['sin'];

  
// query products
$stmt = $person->delete($SIN);

echo json_encode( " " . $SIN);
?>