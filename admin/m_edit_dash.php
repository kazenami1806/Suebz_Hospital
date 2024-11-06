<?php

include("../config/koneksi.php");

$id_admin = $_GET["id"];
$query = "SELECT * FROM admin WHERE id = '$id_admin'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $id = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $nama = $_POST["nama"];
    $password = $_POST["password"];
    // Mengunggah gambar baru
    $targetDir = "../img/";
    $fileName = basename($_FILES["foto_profil"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Ambil nilai foto profil lama dari database
    $oldFotoProfil = $id['foto_profil'];

    // Jika ada file baru yang diunggah, perbarui foto profil
    if ($_FILES['foto_profil']['error'] === UPLOAD_ERR_OK) {
        // Verifikasi jenis file
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        $fileType = strtolower(pathinfo($_FILES['foto_profil']['name'], PATHINFO_EXTENSION));

        if (in_array($fileType, $allowTypes)) {
            // Memindahkan gambar baru ke direktori tujuan
            if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $targetFilePath)) {
                // Menghapus gambar lama jika ada
                if (!empty($oldFotoProfil)) {
                    $oldFilePath = $targetDir . $oldFotoProfil;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Update data gambar di database
                $updateQuery = "UPDATE admin SET nama = '$nama', password = '$password', foto_profil = '$fileName' WHERE id = '$id_admin'";
                if ($conn->query($updateQuery) === TRUE) {
                    // Redirect ke halaman gambar setelah berhasil mengedit
                    echo '<script>alert("Profil berhasil diedit."); window.location.href="dashboard.php";</script>';
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        // Jika tidak ada file baru yang diunggah, hanya perbarui data profil lainnya
        $updateQuery = "UPDATE admin SET nama = '$nama', password = '$password' WHERE id = '$id_admin'";
        if ($conn->query($updateQuery) === TRUE) {
            // Redirect ke halaman gambar setelah berhasil mengedit
            echo '<script>alert("Profil berhasil diedit."); window.location.href="dashboard.php";</script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$conn->close();

?>
