<?php
echo "check";
session_start();
var_dump($_SESSION);
echo $_SESSION["OT"];
echo "name ".$_SESSION['n'];
echo "email ".$_SESSION['e'];
echo "pass".$_SESSION['p'];
?>