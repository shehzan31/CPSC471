<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../../config/database.php';
include_once '../../../objects/medical_record_prescriptions.php';
include_once '../../../objects/patient.php';
include_once '../../../objects/prescription.php';
include_once '../../../objects/prescribes.php';

session_start();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$mrp = new Medical_Records_Prescriptions($db);
$prescription = new Prescription($db);
$prescribes = new Prescribes($db);


// Get contents of post
$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Put contents of post into variable
$user = $_SESSION['user'];
$hnum = $_POST['hnum'];
$pname = $_POST['data1'];
$type = $_POST['data2'];
$field = $_POST['data3'];
$start = $_POST['data4'];
$end = $_POST['data5'];

$row1 = $stmt1-> fetch();
//$a_id = intval($row1['largestID']) + 1;

$stmt2 = $prescription->post($pname, $type, $field);
$num2 = $stmt2->rowCount();

if (true) {

    $stmt3 = $schedules->insert($user, $hnum, $pname, $start, $end);
    $num3 = $stmt3->rowCount();

    if ($num3 == 1) {

        $stmt4 = $patient->mr_number($hnum);
        $num4 = $stmt4->rowCount();

        if ($num4 == 1) {
            $row2 = $stmt4->fetch();
            $mr_num = intval($row2['MR_Number']);
            $stmt4 = $mrp->insert($mr_num, $pname);
            http_response_code(200);
            echo json_encode('');
        }
    }
}

?>