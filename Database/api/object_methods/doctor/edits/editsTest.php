<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../../config/database.php';
include_once '../../../objects/medical_record_tests.php';
include_once '../../../objects/patient.php';
include_once '../../../objects/test.php';
include_once '../../../objects/orders.php';

session_start();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$mrt = new Medical_Records_Tests($db);
$tests = new Test($db);
$orders = new Orders($db);


// Get contents of post
$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Put contents of post into variable
$user = $_SESSION['user'];
$H_Number = $_POST['hnum'];
$Test_Name = $_POST['data1'];
$Date = $_POST['data2'];
$Result = "Pending";

// $user = 123456789;
// $H_Number = 200200200;
// $Test_Name = "Urine Test";
// $Date = "2021-09-09";
// $Result = "Pending";

$stmt1 = $tests->getMax();
$num1 = $stmt1->rowCount();

if ($num1 == 1) {

    $row1 = $stmt1-> fetch();
    $Test_ID = intval($row1['largestID']) + 1;

    $stmt2 = $tests->post($Test_Name, $Test_ID, $Date, $Result);
    $num2 = $stmt2->rowCount();

    if (true) {

        $stmt3 = $orders->insert($user, $H_Number, $Test_ID);
        $num3 = $stmt3->rowCount();

        if ($num3 == 1) {

            $stmt4 = $patient->mr_number($H_Number);
            $num4 = $stmt4->rowCount();

            if ($num4 == 1) {
                $row2 = $stmt4->fetch();
                $mr_num = intval($row2['MR_Number']);
                $stmt4 = $mrt->insert($mr_num, $Test_ID);
                http_response_code(200);
                echo json_encode('');
            }
        }
    }
}



?>