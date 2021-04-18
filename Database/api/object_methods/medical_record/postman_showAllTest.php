<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/medical_record_tests.php';
include_once '../../objects/patient.php';
include_once '../../objects/test.php';

session_start();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$mrt = new Medical_Records_Tests($db);
$tests = new Test($db);

$rest_json = file_get_contents('php://input');

$_GET = json_decode($rest_json, true);

$user = $_GET['user'];

// Query MR_Number 
$stmt1 = $patient->mr_number($user);
$num1 = $stmt1->rowCount();

if ($num1 == 1) {
    $p = $stmt1-> fetch();
    $mr_number = $p['MR_Number'];

    $stmt2 = $mrt->showAllTests($mr_number);
    $num2 = $stmt2->rowCount();

    if ($num2 > 0) {
        $arr = array();
        $arr['records'] = array();

        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            
            $t_id = $row['Test'];

            $stmt3 = $tests->getTests($t_id);
            $num3 = $stmt3->rowCount(); 

            if ($num3 > 0) {

                while ($row1 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                    
                    extract($row1);

                    $item = array(
                        "Test_Name"   => $TName,
                        "Result"      => $Result,
                        "Date"          => $Date
                    );

                    array_push($arr['records'], $item);
                }
            }
        }
  
        // show products data in json format
        echo json_encode($arr);


    }

    else {
        echo json_encode(
            array("message" => "No Tests found.")
        );
    }

}
  
?>