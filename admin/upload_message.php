// File confirm.php
<?php
include '../connect.php';

$id = $_GET['id'];

// Query untuk mendapatkan data donatur
$query = mysqli_query($conn, "SELECT * FROM donasi WHERE id='$id'");
$donatur = mysqli_fetch_assoc($query);

// Simpan pesan terima kasih
$pesan = "Terima kasih ".$donatur["nama"]." atas donasi Anda sebesar Rp ".number_format($donatur['jumlah_donasi'])." untuk membantu korban ".$donatur['nama_bencana'].".";

// Update ke tabel donasi 
mysqli_query($conn, "UPDATE donasi SET pesan='$pesan' WHERE id='$id'");

// Redirect
header("Location: index.php?p=donasi");

?>