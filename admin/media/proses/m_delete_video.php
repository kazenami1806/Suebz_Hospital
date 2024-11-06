<?php

include("../../../config/koneksi.php");

$id_video = $_GET["id_video"];
$query = "SELECT * FROM video WHERE id_video = '$id_video'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $video = $result->fetch_assoc();
    
    // Menghapus video dari direktori
    $targetDir = "../../../img/video/";
    $filePath = $targetDir . $video['vid'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Menghapus data video dari database
    $deleteQuery = "DELETE FROM video WHERE id_video = '$id_video'";
    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect ke halaman video setelah berhasil menghapus
        echo '<script>alert("video berhasil dihapus."); window.location.href="../video.php";</script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();

?>