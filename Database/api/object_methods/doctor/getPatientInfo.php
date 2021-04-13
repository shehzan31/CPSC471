<?php

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/doctor.php';
include_once '../../objects/patient.php';
include_once '../../objects/person.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Get contents of post
$rest_json = file_get_contents('php://input');
$_POST = json_decode($rest_json, true);

// Put contents of post into variable
$patientID = $_POST['h_num'];

// Instantiate objects
$patient = new Patient($db);

// query products
$stmt1 = $patient->returnPatient($patientID);
$num1 = $stmt1->rowCount();

if ($num1 == 1) {

    $user = $stmt1->fetch();
    $sin = $user['SIN'];

    /*
    $arr = array();
    $arr['records'] = array();
    */
    // initialize object
    $person = new Person($db);
  
    // query products
    $stmt2 = $person->sin($sin);
    $num2 = $stmt2->rowCount();

    if ($num2 == 1) {

        $row = $stmt2->fetch();

        extract($row);
  
        $person_item=array(
            "sin" => $SIN,
            "name" => $FName . " " . $MInit . ". " . $LName,
            "address_line" => html_entity_decode($Address_line),
            "province" => $Province,
            "city" => $City,
            "postal_code" => $Postal_code,
            "gender" => $Gender,
            "dob" => $DOB
        );

        echo json_encode($person_item);
    } else {
        echo json_encode(
            array("message" => "No Patient found.")
        );
    }


}

?>