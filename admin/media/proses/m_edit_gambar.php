<?php

include("../../../config/koneksi.php");

$id_gambar = $_GET["id_gambar"];
$query = "SELECT * FROM gambar WHERE id_gambar = '$id_gambar'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $gambar = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $name_img = $_POST["name_img"];
    $notes = $_POST["notes"];

    // Mengunggah gambar baru
    $targetDir = "../../../img/slideshow/";
    $fileName = basename($_FILES["img"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Ambil nilai gambar lama dari database
    $oldImg = $gambar['img'];

    // Jika ada file baru yang diunggah, perbarui foto profil
    if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
        // Verifikasi jenis file
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        $fileType = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));

        if (in_array($fileType, $allowTypes)) {
            // Memindahkan gambar baru ke direktori tujuan
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFilePath)) {
                // Menghapus gambar lama jika ada
                if (!empty($oldImg)) {
                    $oldFilePath = $targetDir . $oldImg;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Update data gambar di database
                $updateQuery = "UPDATE gambar SET name_img = '$name_img', notes = '$notes', img = '$fileName' WHERE id_gambar = '$id_gambar'";
                if ($conn->query($updateQuery) === TRUE) {
                    // Redirect ke halaman gambar setelah berhasil mengedit
                    echo '<script>alert("Gambar berhasil diedit."); window.location.href="../gambar.php";</script>';
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
        $updateQuery = "UPDATE gambar SET name_img = '$name_img', notes = '$notes' WHERE id_gambar = '$id_gambar'";
        if ($conn->query($updateQuery) === TRUE) {
            // Redirect ke halaman gambar setelah berhasil mengedit
            echo '<script>alert("Gambar berhasil diedit."); window.location.href="../gambar.php";</script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$conn->close();

?>
