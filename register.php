<?php
// Koneksi ke database
include 'connect.php';	
$result = mysqli_query($conn, "SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <!-- Tambahkan stylesheet atau styling sesuai kebutuhan Anda -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include 'nav.php'; ?>
<div class="logo">
  <img src="assets/img/logo.png">  
</div>

<h2>Daftar</h2>
<form method="post" enctype="multipart/form-data" action='tambah_pros.php'>
        <div class="input-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" required>
        </div>

        <div class="input-group">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" required>
        </div>

        <div class="input-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="input-group">
            <label for="nomor_telp">Nomor Telephone</label>
            <input type="tel" name="nomor_telp" required>
        </div>

        <div class="input-group">
            <label for="password">Kata Sandi</label>
            <input type="password" name="password" required>
        </div>

        <div class="input-group">
            <label for="gambar">Photo Profil</label>
            <input type="file" name="gambar">
        </div>
        
    <button type="submit" class="btn1" name="tambah">Simpan</button>
</form>

<?php
if (isset($success_message)) {
    echo "<p style='color:green;'>$success_message</p>";
}

if (isset($error_message)) {
    echo "<p style='color:red;'>$error_message</p>";
}
?>

<!-- Tambahkan tautan atau elemen untuk pindah ke halaman login -->
<p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

</body>
</html>
