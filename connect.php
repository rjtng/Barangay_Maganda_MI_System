<?php

session_start();

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'barangay_maganda';

$connect = new mysqli($host, $username, $password, $database);

if ($connect-> connect_error){
    die ("Oops! Server not Connected: " . $connect-> connect_error);
}

?>