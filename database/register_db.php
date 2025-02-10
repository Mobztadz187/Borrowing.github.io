<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "borrowing_system_db";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong" . mysqli_connect_error());
}

