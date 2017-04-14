<?php 
    session_start();

    $_SESSION['logged_in'] = null;
    header('location: index.php');
    exit();
?>