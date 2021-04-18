<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/doctor.php';
include_once '../../objects/person.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$doctor = new Doctor($db);
$person = new Person($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object properties
$Doctor_ID = $_POST['d_id'];
$SIN = $_POST['sin'];

// query products
$stmt = $person->sin($SIN);
$num = $stmt->rowCount();

$stmt2 = $doctor->doctorID($Doctor_ID);
$num2 = $stmt2->rowCount();

if($num > 0 && $num2 > 0){
    $stmt1 = $doctor->edit($Doctor_ID, $SIN);
}

?>