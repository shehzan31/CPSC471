<?php

    //session_start();
    session_start();

    // include database and object files
    include_once '../../config/database.php';
    include_once '../../objects/account.php';
  
    // instantiate database and product object

    if (isset($_POST['user']) && isset($_POST['pass'])) {
        
        $database = new Database();
        $db = $database->getConnection();
        
        $username = $_POST['user'];
        $password = $_POST['pass'];

        // To prevent mysql injection 

        $username = stripcslashes($username);
        $password = stripcslashes($password); 

        $account = new Account($db);

        // query products
        $stmt = $account->authenticate($username, $password);
        $num = $stmt->rowCount();


        if ($num == 1) {

            $user = $stmt->fetch();

            if (hash('sha256', $password) == $user['Password']) {   
                echo("Login successful"); 
                $_SESSION["login"] = "1";    
                $_SESSION["user"] = $username;
                header("location: ../../../../Website/dashboard.html");
            } else {
                echo("Login failure");  
                header("location: ./Website/login.html?err=1");
            }
        } else {
            echo("Login failure"); 
            header("location: ./Website/login.html?err=1");
        }
    }
    
    
?>


