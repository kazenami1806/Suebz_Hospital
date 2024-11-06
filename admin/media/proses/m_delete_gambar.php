<?php

include("../../../config/koneksi.php");

$id_gambar = $_GET["id_gambar"];
$query = "SELECT * FROM gambar WHERE id_gambar = '$id_gambar'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $gambar = $result->fetch_assoc();
    
    // Menghapus gambar dari direktori
    $targetDir = "../../../img/slideshow/";
    $filePath = $targetDir . $gambar['img'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Menghapus data gambar dari database
    $deleteQuery = "DELETE FROM gambar WHERE id_gambar = '$id_gambar'";
    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect ke halaman gambar setelah berhasil menghapus
        echo '<script>alert("Gambar berhasil dihapus."); window.location.href="../gambar.php";</script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();

?>