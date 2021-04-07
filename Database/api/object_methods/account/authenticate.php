<?php

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/patient.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$username = $_POST['user'];
$password = $_POST['pass'];

// To prevent mysql injection 

$username = stripcslashes($username);
$password = stripcslashes($password);

$account = new account($db);

// query products
$stmt = $account->authenticate($username, $password);
$num = $stmt->rowCount();

if ($num == 1) {
    echo "<h1><center> Login Successful </center></h1>";
} else {
    echo "<h1><center> Login failure: Invalid Username or Password </center></h1>"
}



?>