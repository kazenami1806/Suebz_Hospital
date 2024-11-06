<?php
// m_login.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Menghubungkan ke database
    $host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'sueb_hospital';

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die('Koneksi ke database gagal: ' . $conn->connect_error);
    }

    // Melakukan query untuk memeriksa email dan password
    $query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Jika data ditemukan, ambil data role
        $row = $result->fetch_assoc();

        // Mulai sesi
        session_start();

        // Simpan data pengguna ke dalam sesi
        $_SESSION['email'] = $email;

        // Redirect to dashboard.php if login is successful
        header("Location: dashboard.php");
        exit();
    } else {
        // Tampilkan pop-up alert jika login gagal
        echo "<script>alert('Email atau password salah.'); window.history.back();</script>";
    }

    $conn->close();
}
?>
