<?php 

    $con = mysqli_connect('localhost', 'root', '', 'auto-suggestion');

    if (!$con) {
        die("Connection failed: " + mysqli_connect_error());
    }
?>