<?php

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'sueb_hospital';

$conn = mysqli_connect($host,$dbUsername,$dbPassword,$dbName);
// $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die('Koneksi ke database gagal: ' . $conn->connect_error);
}

?>