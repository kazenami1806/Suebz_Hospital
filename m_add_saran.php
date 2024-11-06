<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$database = "sueb_hospital";

// Membuat koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Menangkap data yang dikirimkan melalui form
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];


 // Menyiapkan pernyataan SQL untuk menambahkan data ke tabel
 $sql = "INSERT INTO ulasan (name, email, subject, message)
 VALUES ('$name', '$email', '$subject','$message' )";

// Menjalankan pernyataan SQL
if (mysqli_query($conn, $sql)) {
// Jika berhasil, tampilkan pesan pop-up dan arahkan ke halaman ../data_akun.php setelah pengguna menekan tombol OK
echo '<script>alert("Ulasan berhasil dikirim."); window.location.href="index.php";</script>';
} else {
// Jika gagal, tampilkan pesan pop-up dan arahkan kembali ke halaman sebelumnya setelah pengguna menekan tombol OK
echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.history.back();</script>';
}

// Menutup koneksi
mysqli_close($conn);

?>