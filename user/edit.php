<?php
session_start();

if (!isset($_SESSION['member'])) {
    // Redirect to login page if not logged in
    header("Location: ../login.php");
    exit();
}

include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_name']) && isset($_POST['new_email']) && isset($_POST['new_address'])) {
    // Handle form submission
    $newName = mysqli_real_escape_string($conn, $_POST['new_name']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['new_email']);
    $newAddress = mysqli_real_escape_string($conn, $_POST['new_address']);
    
    // Update the user's information in the database
    $updateQuery = "UPDATE users SET name = ?, email = ?, alamat = ? WHERE name = ?";
    $updateStmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($updateStmt, "ssss", $newName, $newEmail, $newAddress, $_SESSION['member']);
    
    if (mysqli_stmt_execute($updateStmt)) {
        echo '<script language="javascript">alert("Informasi berhasil diupdate!");</script>';
    } else {
        echo '<script language="javascript">alert("Gagal mengupdate informasi!");</script>';
    }

    // Redirect back to the profile page
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .container {
            font-family: Arial, sans-serif;
            background-image: url('../assets/img/bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }


        .profile-box {
            background-color: #fff;
            padding: 20px;
            width: 60%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            text-align: center;
        }

        label {
            display: block;
            font-size: 18px;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"] {
            width: 40%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            opacity: 0.8;
        }
        .edit-button {
            margin-right: 10px; /* Add margin-right to create space between buttons */
        }
        .cancel{
            margin:20px;
        }

        .cancel-button {
            background-color: #ccc;
            color: #000;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="profile-box">
            <div class="profile-info">
                <h2>Edit Profil</h2>
                <form action="edit.php" method="post">
                    <label for="new_name">Nama Baru:</label>
                    <input type="text" name="new_name" required>

                    <label for="new_email">Email Baru:</label>
                    <input type="email" name="new_email" required>

                    <label for="new_address">Alamat Baru:</label>
                    <input type="text" name="new_address" required>
                    <br>
                    <input type="submit" class="edit-button" value="Simpan Perubahan">
                </form>
                <form action="akun.php" class="cancel">
                    <input type="submit" class="cancel-button" value="Batal">
                </form>
            </div>
        </div>
    </div>
</body>
</html>