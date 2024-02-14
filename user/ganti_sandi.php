<?php
// Koneksi ke database
include '../connect.php';

// Ambil email user login
session_start();
$email = $_SESSION['email']; 

// Inisialisasi variabel error
$errorMsg = "";

// Proses form ganti kata sandi
if(isset($_POST['submit'])){

  // Data input
  $oldPass = $_POST['old_password']; 
  $newPass = $_POST['new_password'];
  $confirmNewPass = $_POST['confirm_new_password'];

  // Check if the new password and confirmation match
  if($newPass != $confirmNewPass) {
    $errorMsg = "Konfirmasi kata sandi baru tidak sesuai!";
  } else {
    // Cek kata sandi lama
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$oldPass'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

      // Update kata sandi baru 
      $sql2 = "UPDATE users SET password='$newPass' WHERE email='$email'";
      mysqli_query($conn, $sql2);
      echo "<script>alert('Kata sandi berhasil diubah!');</script>"; 

    } else {
      $errorMsg = "Kata sandi lama salah!";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background-image: url('../assets/img/bg.png');
      height: 100vh;
      background-size: cover;
      background-repeat: no-repeat;
      font-family: 'Arial', sans-serif;
      margin: 0;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    form {
      max-width: 600px;
      width: 100%;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      background-color: #fff;
      margin: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: calc(100% - 16px);
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    h2 {
      padding: 20px 0 15px 0;
    }

    .error-msg {
      color: red;
      padding:10px;
    }

    button {
      background-color: #4CAF50;
      color: white;
      width: 90px;
      padding: 10px;
      margin: 10px;
      float: right;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .cancel-btn {
      background-color: #d9534f;
    }

    .show-password {
      margin-right: 10px;
      align-items: left;
    }

    #showPassword {
        align-self: flex-start; /* Memposisikan tombol di ujung kanan */
    }

  </style>
  <title>Ganti Kata Sandi</title>
</head>
<body>
  <?php include 'navbar.php' ?>
  <!-- Form input -->
  <div class="container">
    <form method="post">
      <h2>Ganti Kata Sandi</h2>
      <label for="old_password">Kata Sandi Lama</label>
      <input type="password" name="old_password" id="old_password" required>

      <label for="new_password">Kata Sandi Baru</label>
      <input type="password" name="new_password" id="new_password" required>

      <label for="confirm_new_password">Ulangi Kata Sandi Baru</label>
      <input type="password" name="confirm_new_password" id="confirm_new_password" required>
    
      <input type="checkbox" id="showPassword" onclick="togglePassword()">
      
      <span class="error-msg"><?php echo $errorMsg; ?></span>

      <button type="submit" name="submit">Ganti</button>
      <a href="akun.php"><button type="button" class="cancel-btn">Batal</button></a>
    </form>
  </div>

  <!-- JavaScript to toggle password visibility -->
  <script>
    function togglePassword() {
      var passwordInput = document.getElementById("new_password");
      var confirmInput = document.getElementById("confirm_new_password");
      var checkbox = document.getElementById("showPassword");

      if (checkbox.checked) {
        passwordInput.type = "text";
        confirmInput.type = "text";
      } else {
        passwordInput.type = "password";
        confirmInput.type = "password";
      }
    }
  </script>
</body>
</html>