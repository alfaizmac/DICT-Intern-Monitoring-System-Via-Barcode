<?php
$serverName = "MSI";
$username = "";
$password = "";
$dbName = "DICTFULL";

$conn = sqlsrv_connect($serverName, array(
    "Database" => $dbName,
    "UID" => $username,
    "PWD" => $password
));

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>