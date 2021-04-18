<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/patient.php';
include_once '../../objects/person.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$person = new Person($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$SIN = $_POST['sin'];

$H_Number = $_POST['h_num'];

$MR_Number = $_POST['mr_num'];

$stmt1 = $person->sin($SIN);
$num1 = $stmt1->rowCount();

// query products
if($num1 > 0){
    $stmt = $patient->edit($H_Number, $MR_Number, $SIN);
}

?>