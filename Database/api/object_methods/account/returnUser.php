<?php
    session_start();

    $user = $_SESSION['user'];

    echo json_encode($user);
?>