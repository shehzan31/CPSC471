<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/finds.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$finds= new Finds($db);

// Get contents of post

$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Object Properties
$Doctor_ID = $_POST['d_id'];
$H_Number = $_POST['h_num'];
$Condition = $_POST['cond'];
$Date = $_POST['date'];
$Chart = $_POST['chart'];

// query products
$stmt = $finds->edit($Doctor_ID, $H_Number, $Condition, $Date, $Chart);

?>