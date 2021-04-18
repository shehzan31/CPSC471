<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../../config/database.php';
include_once '../../../objects/doctor.php';
include_once '../../../objects/patient.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$doctor = new Doctor($db);

// Put contents of post into variable
$Doctor_ID = $_SESSION['user'];
$H_Number = $_POST['hnum'];
$Test_Name = $_POST['data1'];
$Date = $_POST['data2'];
$Result = "Pending";

$stmt1 = $tests->getMax();
$num1 = $stmt1->rowCount();

if ($num1 == 1) {
    $row1 = $stmt1-> fetch();
    $Test_ID = intval($row1['largestID']) + 1;

    $stmt2 = $patient->mr_number($H_Number);
    $row2 = $stmt2->fetch();

    if ($num2 == 1) {
        $MR_Number = intval($row2['MR_Number']);
        // query products
        $stmt = $doctor->orderNewTest($Doctor_ID, $H_Number, $MR_Number, $Test_ID, $Test_Name, $Date, $Result);
    }
}
?>