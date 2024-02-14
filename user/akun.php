<?php
session_start();

if (!isset($_SESSION['member'])) {
    echo '<script language="javascript">alert("Anda harus Login!"); document.location="../login.php";</script>';
} else {
    include '../connect.php';

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

<!DOCTYPE html>
<html>
<head>
  <title>Halaman Profil</title>
  <style>
    * {
        padding: 0;
        margin: 0;
    }

    .containers {
        background-image: url('../assets/img/bg.png');
        background-size: cover;
        background-repeat: no-repeat;
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .profile-box {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Distribute items evenly */
        background-color: #fff;
        padding: 20px;
        width: 40%;
        height: 50%;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-info {
        flex-grow: 1; /* Allow the content to grow and take remaining space */
        padding-left: 20px; /* Add some space between image and text */
    }

    .profile-box img {
        border-radius: 40px;
        max-width: 100%;
        max-height: 300px;
        width: 250px;
        height: 260px;
        padding: 20px;
    }

    p {
        font-size: 25px; /* Adjust the font size as needed */
        font-family: 'Arial', sans-serif; /* Use a specific font or font-family */
        margin-bottom: 10px;
        margin-bottom: 10px;
    }

    form {
        margin-top: 10px;
        display: inline-block;
    }

    input[type="submit"] {
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 5px;
        font-size: 16px;
    }

    .edit-button {
        background-color: #4CAF50; /* Green */
        color: #fff;
    }

    .change-password-button {
        background-color: #3498db; /* Blue */
        color: #fff;
    }

    .logout-button {
        background-color: #e74c3c; /* Red */
        color: #fff;
    }

    input[type="submit"]:hover {
        opacity: 0.8;
    }

    /* Media queries for responsiveness */
    @media screen and (max-width: 1200px) {
        .profile-box {
            width: 90%;
            margin: 0 30px 0 30px; /* Adjust the width for tablet screens */
        }
    }

    @media screen and (max-width: 768px) {
        .profile-box {
            width: 100%;
            margin: 0 30px 0 30px /* Adjust the width for mobile screens */
        }
    }
  </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="containers">
        <div class="profile-box">
            <img src="../uploads/<?php echo $hasil['gambar']; ?>" alt="Profile Picture">
            <div class="profile-info">
                <p style="font-size: 24px; font-weight: bold;"><?php echo $_SESSION['member']; ?></p>
                <?php echo "<p style='font-size: 18px;'>Alamat: " . $hasil['alamat'] . "</p>"; ?>
                <?php echo "<p style='font-size: 18px;'>Nomor Telephone: ". $hasil['nomor_telp'] . "</p>"; ?>
                <form action="edit.php" method="post">
                    <input class="edit-button" type="submit" value="Edit Profil">
                </form>
                <form action="ganti_sandi.php" method="post">
                    <input class="change-password-button" type="submit" value="Ganti Kata Sandi">
                </form>
                <form action="../keluar.php" method="post">
                    <input class="logout-button" type="submit" value="Keluar">
                </form>
            </div>
        </div>
    </div>

</body>
</html>