<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../../config/database.php';
include_once '../../../objects/medicalRecordCondition.php';
include_once '../../../objects/patient.php';
// include_once '../../objects/finds.php';
session_start();

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$mrc = new MedicalRecordCondition($db);
// $finds = new Finds($db);

// Get contents of post
$rest_json = file_get_contents('php://input');

$_POST = json_decode($rest_json, true);

// Put contents of post into variable
$user = $_POST;

// // Query MR_Number
$stmt1 = $patient->mr_number($user);
$num1 = $stmt1->rowCount();

if ($num1 == 1) {
    $p = $stmt1-> fetch();
    $mr_number = $p['MR_Number'];
    
    $stmt2 = $mrc->showAllConditions($mr_number);
    $num2 = $stmt2->rowCount();
    if($num2 > 0){
        
        $arr = array();
        $arr['records'] = array();
        while ($row1 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

            extract($row1);

            $item = array(
                "MR_Number"   => $MR_Number,
                "Condition"    => $Condition,
            );

            array_push($arr['records'], $item);
        }
        
    }
//     $stmt2 = $patient->returnHnum($mr_number);
//     $num2 = $stmt2->rowCount();
 
//     if ($num2 == 1) {
        
//         $arr = array();
//         $arr['records'] = array();
        
//         $hnum = $stmt2['H_Number'];
//         $stmt3 = $finds->hnumber($hnum);
//         $num3 = $stmt3->rowCount();
//         if ($num3 >= 0) {
                   
//             while ($row1 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                
//                 extract($row1);
                
//                 $item = array(
//                     "Doctor_ID"   => $Doctor_ID,
//                     "H_Number"     => $H_Number,
//                     "Condition"    => $Condition,
//                     "Date"         => $Date,
//                     "Chart"         => $Chart
//                 );
                
//                 array_push($arr['records'], $item);
//             }
//         }
       
            
            // show products data in json format
            echo json_encode($arr);
            
    }
    
    else {
        echo json_encode(
            array("message" => "No Prescriptions found.")
            );
    }
    
// }

?>