<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../../config/database.php';
include_once '../../../objects/medical_record_appointments.php';
include_once '../../../objects/patient.php';
include_once '../../../objects/appointments.php';
include_once '../../../objects/schedules.php';

session_start();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$mra = new Medical_Records_Appointments($db);
$appointments = new Appointment($db);
$schedules = new Schedule($db);


// Get contents of post
$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Put contents of post into variable
$user = $_SESSION['user'];
$hnum = $_POST['hnum'];
$location = $_POST['data1'];
$date = $_POST['data2'];
$time = $_POST['data3'];

$stmt1 = $appointments->getMax();
$num1 = $stmt1->rowCount();

if ($num1 == 1) {

    $row1 = $stmt1-> fetch();
    $a_id = intval($row1['largestID']) + 1;

    $stmt2 = $appointments->insert($a_id, $location, $date, $time);
    $num2 = $stmt2->rowCount();

    if (true) {

        $stmt3 = $schedules->insert($hnum, $a_id, $user);
        $num3 = $stmt3->rowCount();

        if ($num3 == 1) {

            $stmt4 = $patient->mr_number($hnum);
            $num4 = $stmt4->rowCount();

            if ($num4 == 1) {
                $row2 = $stmt4->fetch();
                $mr_num = intval($row2['MR_Number']);
                $stmt4 = $mra->insert($mr_num, $a_id);
                http_response_code(200);
                echo json_encode('');
            }
        }
    }
}



?>