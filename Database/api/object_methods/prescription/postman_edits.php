<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/prescription.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$prescription = new Prescription($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$Pname = $_POST['pname'];
$Type = $_POST['type'];
$Field = $_POST['field'];

// query products

$stmt2 = $prescription->pname($Pname);
$num = $stmt2 -> rowCount();

if($num > 0){
    $stmt = $prescription->edit($Pname, $Type, $Field);
    echo json_encode($Pname . " edited");
}


?>