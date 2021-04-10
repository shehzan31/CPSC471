<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/person.php';
include_once '../../objects/patient.php';

session_start();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);

$user = $_SESSION['user'];
  
// query products
$stmt = $patient->mr_number($user);
$num = $stmt->rowCount();

if ($num = 1) {
    $user = $stmt->fetch();
    $sin = $user['SIN'];

    // initialize object
    $person = new Person($db);
  
    // query products
    $stmt = $person->sin($sin);
    $num = $stmt->rowCount();
  
    // check if more than 0 record found
    if($num == 1){
  
        $per = $stmt->fetch();
        $name = $per['FName'] . " " . $per['LName'];
        // show products data in json format
        echo json_encode($name);
    }
}

  


?>