<?php

include_once '../../config/database.php';
include_once '../../objects/patient.php';

session_start();

$user = $_SESSION['user'];

$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patient($db);
  
// query products
$stmt = $patient->mr_number($user);
$num = $stmt->rowCount();

if ($num = 1) {
    $user = $stmt->fetch();
    $_Session['sin'] = $user['SIN'];
}

$sin = $_Session['sin'];
echo $sin;

//echo json_encode($sin);


?>