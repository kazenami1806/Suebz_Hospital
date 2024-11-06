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
//video
$name_vid = $_POST['name_vid'];
$notes_v = $_POST['notes_v'];
// Menangkap file foto profil yang diunggah
// file video
$nama_file_video = $_FILES['vid']['name'];
$ukuran_file_video = $_FILES['vid']['size'];
$tmp_file_video = $_FILES['vid']['tmp_name'];


// Mengambil ekstensi file
$ext = pathinfo($nama_file_video, PATHINFO_EXTENSION);

// Menentukan lokasi penyimpanan file
$tujuan_file_video = "../../../img/video/" . $nama_file_video;

// Memeriksa apakah file video profil berhasil diunggah
if (move_uploaded_file($tmp_file_video, $tujuan_file_video)) {
    // Menyiapkan pernyataan SQL untuk menambahkan data ke tabel
    $sql = "INSERT INTO video (name_vid, notes_v, vid)
            VALUES ('$name_vid', '$notes_v', '$nama_file_video')";

    // Menjalankan pernyataan SQL
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, tampilkan pesan pop-up dan arahkan ke halaman ../data_akun.php setelah pengguna menekan tombol OK
        echo '<script>alert("Video berhasil ditambahkan."); window.location.href="../video.php";</script>';
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