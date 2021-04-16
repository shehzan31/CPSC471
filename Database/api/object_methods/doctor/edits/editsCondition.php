<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../../config/database.php';
include_once '../../../objects/medicalRecordCondition.php';
include_once '../../../objects/patient.php';
include_once '../../../objects/findsCondition.php';
include_once '../../../objects/finds.php';
include_once '../../../objects/diagnosis.php';

session_start();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$mrc = new MedicalRecordCondition($db);
$diagnosis = new Diagnosis($db);
$finds = new Finds($db);


// Get contents of post
$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Put contents of post into variable
$user = $_SESSION['user'];
$hnum = $_POST['hnum'];
$did = $_POST['data1'];
$cond = $_POST['data2'];
$date = $_POST['data3'];
$chart = $_POST['data4'];

$stmt1 = $diagnosis->findCond($cond);
$num1 = $stmt1->rowCount();

if($num1 == 0){
    $stmt2 = $diagnosis->post($cond);
    $num2 = $stmt2->rowCount();
}

if (true) {

    $stmt3 = $finds->post($did, $hnum, $cond, $date, $chart);
    $num3 = $stmt3->rowCount();

    if ($num3 == 1) {

        $stmt4 = $patient->mr_number($hnum);
        $num4 = $stmt4->rowCount();

        if ($num4 == 1) {
            $row2 = $stmt4->fetch();
            $mr_num = intval($row2['MR_Number']);
            $stmt4 = $mrc->insert($mr_num, $cond);
            http_response_code(200);
            echo json_encode('');
        }
    }
}

?>