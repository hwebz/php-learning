<?php 

    // echo time();
    try {
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch (Exception $e) {
        die('Can\'t connect to server'.$e);
    }

?>