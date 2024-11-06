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
$name_img = $_POST['name_img'];
$notes = $_POST['notes'];
// Menangkap file foto profil yang diunggah
$nama_file = $_FILES['img']['name'];
$ukuran_file = $_FILES['img']['size'];
$tmp_file = $_FILES['img']['tmp_name'];

// Mengambil ekstensi file
$ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);

// Menentukan lokasi penyimpanan file
$tujuan_file = "../../../img/slideshow/" . $nama_file;

// Memeriksa apakah file foto profil berhasil diunggah
if (move_uploaded_file($tmp_file, $tujuan_file)) {
    // Menyiapkan pernyataan SQL untuk menambahkan data ke tabel
    $sql = "INSERT INTO gambar (name_img, notes, img)
            VALUES ('$name_img', '$notes', '$nama_file')";

    // Menjalankan pernyataan SQL
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, tampilkan pesan pop-up dan arahkan ke halaman ../data_akun.php setelah pengguna menekan tombol OK
        echo '<script>alert("Gambar berhasil ditambahkan."); window.location.href="../gambar.php";</script>';
    } else {
        // Jika gagal, tampilkan pesan pop-up dan arahkan kembali ke halaman sebelumnya setelah pengguna menekan tombol OK
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.history.back();</script>';
    }
} else {
    // Jika gagal mengunggah file, tampilkan pesan pop-up dan arahkan kembali ke halaman sebelumnya setelah pengguna menekan tombol OK
    echo '<script>alert("Error dalam mengunggah file."); window.history.back();</script>';
}

// Menutup koneksi
mysqli_close($conn);

?>