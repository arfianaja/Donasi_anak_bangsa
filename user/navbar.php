<?php
include '../connect.php';


if (isset($_SESSION['member'])) {
    $nama_pengguna = $_SESSION['member'];

    // Use a prepared statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE name = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);
    
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['member']);
    
    // Execute the query
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch the data
    $hasil = mysqli_fetch_array($result);
}

?>

<!-- -------------------- HTML -------------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Account Drop Down</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assests/css/navbar.css">
</head>

<body>
    <nav>
        <div class="logo">
            <img src="../assets/img/logo.png" alt="">
        </div>
        <ul class="link">
            <li><a href="beranda.php">Beranda</a></li>
            <li><a href="riwayat.php">Riwayat</a></li>
        </ul>
        <div class="account">
            <div class="profile">
                <img src="../uploads/<?php echo $hasil['gambar']; ?>" alt="Profile Picture">
            </div>
            <div class="menu">
                <h3><?php echo $nama_pengguna; ?></h3>
                <p><?php echo $hasil['email']; ?></p>

                <ul>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <a href="akun.php">Profile</a>  
                    </li>
                    <?php
                        $query = mysqli_query($conn, "SELECT * FROM donasi");
                        while ($r = mysqli_fetch_assoc($query)) {
                            // Accessing values from the current row
                            $pesan = $r['pesan'];
                        }
                    ?>
                    <li>
                        <i class="fa-regular fa-message"></i>
                        <a href="#" onclick="showMessages('<?php echo addslashes($pesan); ?>')">Messages</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <a href="keluar.php">Log out</a>  
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    
    <script>
        function showMessages(message) {
        // Use alert to display the message, you can replace this with your preferred method
        alert('Pesan: ' + message);
    }
    </script>
    <script src="assests/js/navbar.js"></script>
</body>

</html>
