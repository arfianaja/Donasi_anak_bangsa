<?php
include '../connect.php';

if (isset($_GET['id']) && isset($_GET['gambar'])) {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    // Delete data from the database
    mysqli_query($conn, "DELETE FROM bencana WHERE id = $id");

    // Delete the associated file
    $file_path = "uploads/" . $gambar;
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}
?>