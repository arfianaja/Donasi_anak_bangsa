<?php

// Koneksi database
include '../connect.php';

// Ambil data dari form 
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];

// Query insert data ke tabel bencana
$sql = "INSERT INTO bencana (nama, deskripsi) VALUES ('$nama', '$deskripsi')";

// Mengeksekusi query menggunakan mysqli_query()
if(mysqli_query($conn, $sql)){

    // Jika berhasil alihkan ke halaman index.php 
    header("location: index.php");

} else {

    // Jika gagal tampilkan pesan kesalahan
    echo "Data gagal ditambahkan " . mysqli_error($conn);

}

// Tutup koneksi
mysqli_close($conn);
?>