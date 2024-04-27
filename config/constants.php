<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,GET');
header('Access-Control-Allow-Headers: *');
define('SITEURL','http://localhost/Soft-Lab-API/images/');//this is siturl

        define('HOSTNAME','localhost');
        define('DB_USERNAME','root');
        define('DB_PASSWORD','');
        define('DB_NAME','soft_lab');

    $conn = mysqli_connect(HOSTNAME, DB_USERNAME, DB_PASSWORD);
    $db_conn = mysqli_select_db($conn,DB_NAME);
    //echo $db_conn;
?>