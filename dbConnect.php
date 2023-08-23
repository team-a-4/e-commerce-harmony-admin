<?php
$strHost = "localhost";
$strUser = "root";
$strPass = "";
$strDb = "harmony_2";

// open connection
$con = mysqli_connect($strHost, $strUser, $strPass, $strDb);

// Check connection
if (mysqli_connect_errno()){
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>