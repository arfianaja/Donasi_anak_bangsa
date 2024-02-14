<?php
session_start();

if (!isset($_SESSION['member'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Beranda</title>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .image-container {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }

    .image-box {
        text-align: center;
        margin: 0 20px; /* Menambah jarak antara gambar */
    }

    .image-box img {
        width: 120px; /* Menambah ukuran gambar */
        border-radius: 50%;
    }

    .image-box p {
        margin-top: 10px;
        color: #555;
    }

    .container {
      display: flex;
      height: 100vh;
      align-items: center;
      justify-content: center; /* Tengah secara horizontal */
      background: url('../assets/img/bg.png') no-repeat center center;
      background-size: cover;
    }

    .blur-box {
      background: rgba(255,255,255,0.3);
      backdrop-filter: blur(10px);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 30px rgba(0,0,0,0.1);
      color: #fff;
      border: 1px solid rgba(255,255,255,0.3);
      text-align: center;
      width: 900px;
      height: 600px;
      margin: auto;
      display: flex;
      flex-direction: column; /* Menata elemen-elemen dalam kolom */
      align-items: center; /* Tengah secara horizontal */
      justify-content: center; /* Tengah secara vertikal */
    }

    /* Media queries for responsiveness */
    @media screen and (max-width: 968px) {
        .image-box img {
            width: 60px; /* Adjust the image size for mobile screens */
        }
        .blur-box{
          margin: 30px
        }
    }

    @media screen and (max-width: 480px) {
        .blur-box {
            padding: 10px; /* Further adjust padding for smaller screens */
            margin: 0 30px 0 30px;
        }
    }
</style>
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="container">

    <div class="blur-box">

      <div class="image-container">

        <div class="image-box">
          <img src="../assets/img/lokasi.png">
          <p><a href="bencana.php">Data Bencana</a></p>
        </div>

        <div class="image-box">
        <a href="riwayat.php"><img src="../assets/img/admin.png"></a>
          <p><a href="riwayat.php">Riwayat</a></p>
        </div>
        
        <div class="image-box">
          <a href="../berita.php"> <img src="../assets/img/survey.png"></a>
          <p><a href="berita.php">Berita</p>
        </div>

        <div class="image-box">
          <img src="../assets/img/akun.png">
          <p><a href="akun.php"> My Profile</a></p>
        </div>

      </div>
    </div>

  </div>

</body>
</html>
