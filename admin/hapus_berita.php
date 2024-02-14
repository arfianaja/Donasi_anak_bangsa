<?php
include '../connect.php';

// Ambil data dari URL
if(isset($_GET['id']) && isset($_GET['gambar'])) {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    // Buat prepared statement
    $stmt = $conn->prepare("DELETE FROM berita WHERE id = ? LIMIT 1");
    
    // Bind parameter
    $stmt->bind_param("i", $id);
    
    // Eksekusi query 
    $stmt->execute();
    
    // Cek jika berhasil
    if($stmt->affected_rows > 0) {

        // Hapus file gambar
        $file_path = "uploads/" . $gambar;
        if(file_exists($file_path)) {
            unlink($file_path); 
        }
        
        // Redirect ke halaman utama
        header("Location: index.php?p=berita"); 
        exit();
        
    } else {
        echo "Gagal menghapus data";
    }
}

$stmt->close();
$conn->close();

?>