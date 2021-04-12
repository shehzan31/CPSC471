<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/doctor.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$doctor = new Doctor($db);

// Object properties
$Doctor_ID = 123456781;
$H_Number = 201201201;
$MR_Number = 101010108;
$Test_ID = 123457;
$Test_Name = "Blood Check";
$Result = "Ok";
$Date = "2021-04-16";

// query products
$stmt = $doctor->orderNewTest($Doctor_ID, $H_Number, $MR_Number, $Test_ID, $Test_Name, $Date, $Result);

?>