<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/medicalRecordCondition.php';
include_once '../../objects/patient.php';
include_once '../../objects/finds.php';
include_once ',,/,,/objects/patient.php';

session_start();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
$mrc = new MedicalRecordCondition($db);
$prescriptions = new Finds($db);
$patient = new Patient($db);

$user = $_SESSION['user'];

// Query MR_Number 
$stmt1 = $patient->mr_number($user);
$num1 = $stmt1->rowCount();

if ($num1 == 1) {
    $p = $stmt1-> fetch();
    $mr_number = $p['MR_Number'];

    $stmt2 = $patient->returnHnum($mr_number);
    $num2 = $stmt2->rowCount();

    if ($num2 > 0) {
        
        $arr = array();
        $arr['records'] = array();

//         while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
         $row = $stmt2->fetch(PDO::FETCH_ASSOC);
           $h_id = $row['H_Number'];
            
            $stmt3 = $mrc->showAllHConditions($h_id);
            $num3 = $stmt3->rowCount(); 
           if ($num3 > 0) {
                
              while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
           
//                 while ($row1 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                    
                    extract($row1);

                    $item = array(
                        "Dcotor_ID"   => $Doctor_ID,
                        "H_Number"     => $H_Number,
                        "Condition"    => $Condition,
                        "Date"         => $Date,
                        "Chart"         => $Chart
                    );

                    array_push($arr['records'], $item);
//                 }
            }
            // show products data in json format
            echo json_encode($arr);
        }
        
        else {
            echo json_encode(
                array("message" => "No Condition found.")
                );
        }



    }


}
  
?>