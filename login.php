<?php 
include 'connect.php';
 
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

 
$query = mysqli_query($conn, "select * from users where email='$email' and password='$password'");

$cek = mysqli_num_rows($query);
$r = mysqli_fetch_assoc($query);

if($cek){
	session_start();

	$_SESSION['email'] = $r['email'];
	$_SESSION['password'] = $r['password'];
	$_SESSION['name'] = $r['name'];
	if($r['role'] == 'admin'){
			$_SESSION['admin']=$r['name'];
			echo '<script language="javascript">alert("Anda berhasil Login Admin!"); document.location="admin/index.php";</script>';
			print($_SESSION['admin']);
		}else{
			$_SESSION['member']=$r['name'];
			echo '<script language="javascript">alert("Anda berhasil Login Member!"); document.location="user/beranda.php";</script>';
		}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tambahkan stylesheet atau styling sesuai kebutuhan Anda -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include 'nav.php'; ?>
<div class="logo">
  <img src="assets/img/logo.png">  
</div>

<div class="div">
    <h2>Aplikasi <br> Donasi Anak Bangsa</h2>
</div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" required>
            
        </div>

        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" required>
        </div>

    <button type="submit">Login</button>
</form>

<?php
if (isset($error_message)) {
    echo "<p style='color:red;'>$error_message</p>";
}
?>

<!-- Tambahkan tautan atau elemen untuk pindah ke halaman pendaftaran -->
<p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

</body>
</html>
