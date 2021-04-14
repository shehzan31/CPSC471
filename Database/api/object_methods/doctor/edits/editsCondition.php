@@ -0,0 +1,72 @@
<?php 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../../config/database.php';
include_once '../../../objects/medicalRecordCondition.php';
include_once '../../../objects/patient.php';
include_once '../../../objects/finds.php';
include_once '../../../objects/findsCondition.php';
include_once '../../../objects/diagnosis.php';

session_start();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$mrc = new MedicalRecordCondition($db);
$findCondition= new FindCondition($db);
$diagnosis = new Diagnosis($db);


// Get contents of post
$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Put contents of post into variable
$user = $_SESSION['user'];
$hnum = $_POST['hnum'];
$condition = $_POST['data1'];
$date = $_POST['data2'];
$chart = $_POST['data3'];

$stmt1 = $diagnosis->read();
$num1 = $stmt1->rowCount();

if ($num1 >= 0) {

    $stmt2 = $diagnosis->insert($condition);
    
    $stmt3 = $findCondition->insert($user, $hnum, $condition, $date, $diagnosis);
    $num3 = $stmt3->rowCount();

    if ($num3 == 1) {

        $stmt4 = $patient->mr_number($hnum);
        $num4 = $stmt4->rowCount();

        if ($num4 == 1) {
            $row1 = $stmt4->fetch();
            $mr_num = intval($row1['MR_Number']);
            $stmt4 = $mrc->insert($mr_num, $condition);
            http_response_code(200);
            echo json_encode('');
        }
    }
}



?>