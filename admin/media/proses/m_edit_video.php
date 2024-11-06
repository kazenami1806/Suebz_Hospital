<?php

include("../../../config/koneksi.php");

$id_video = $_GET["id_video"];
$query = "SELECT * FROM video WHERE id_video = '$id_video'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $video = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari form
    $name_vid = $_POST["name_vid"];
    $notes_v = $_POST["notes_v"];

    // Mengunggah video baru
    $targetDir = "../../../img/video/";
    $fileName = basename($_FILES["vid"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Ambil nilai video lama dari database
    $oldVid = $video['vid'];

    // Jika ada file baru yang diunggah, perbarui foto profil
    if ($_FILES['vid']['error'] === UPLOAD_ERR_OK) {
        // Memeriksa apakah file yang diunggah adalah video
        $allowTypes = array('mp4', 'm4v', 'mkv', 'avi');
        $fileType = strtolower(pathinfo($_FILES['vid']['name'], PATHINFO_EXTENSION));

        if (in_array($fileType, $allowTypes)) {
            // Memindahkan gambar baru ke direktori tujuan
            if (move_uploaded_file($_FILES['vid']['tmp_name'], $targetFilePath)) {
                // Menghapus gambar lama jika ada
                if (!empty($oldVid)) {
                    $oldFilePath = $targetDir . $oldVid;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Mengupdate data video di database
                $updateQuery = "UPDATE video SET name_vid = '$name_vid', notes_v = '$notes_v', vid = '$fileName' WHERE id_video = '$id_video'";
                if ($conn->query($updateQuery) === TRUE) {
                    // Redirect ke halaman gambar setelah berhasil mengedit
                    echo '<script>alert("Video berhasil diedit."); window.location.href="../video.php";</script>';
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Only MP4, M4V, MKV, AVI files are allowed.";
        }
    } else {
        // Jika tidak ada file baru yang diunggah, hanya perbarui data profil lainnya
        $updateQuery = "UPDATE video SET name_vid = '$name_vid', notes_v = '$notes_v' WHERE id_video = '$id_video'";
        if ($conn->query($updateQuery) === TRUE) {
            // Redirect ke halaman gambar setelah berhasil mengedit
            echo '<script>alert("Video berhasil diedit."); window.location.href="../video.php";</script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$conn->close();

?>
