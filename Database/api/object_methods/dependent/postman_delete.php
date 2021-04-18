<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/dependent.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$dependent= new Dependent($db); 

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$SIN = $_POST['sin'];
$D_SSN = $_POST['d_ssn'];

// query products
if($SIN != $D_SSN){
    $stmt = $dependent->delete($SIN, $D_SSN);
}

?>