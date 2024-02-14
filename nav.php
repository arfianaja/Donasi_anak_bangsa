<?php
include 'connect.php';

// Ambil nama pengguna dari database berdasarkan sesi login
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $query = "SELECT name FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Periksa apakah query berhasil
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $namaPengguna = $row['name'];
    } else {
        $namaPengguna = "Donatur"; // Jika query gagal, berikan nama pengguna default
    }
} else {
    $namaPengguna = "Donatur"; // Jika tidak ada sesi login, berikan nama pengguna default
}

// Tutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Letakkan gaya di sini */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
            background-color: #AB3037;
            color: #fff;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav li {
            margin-right: 20px;
        }

        nav li:last-child {
            margin-right: 0;
        }

        nav li.left {
            margin-right: auto;
        }

        nav li.right {
            margin-left: auto;
        }

        nav a {
            text-decoration: none;
            color: #fff;
        }
    </style>

</head>
<body>
<nav>
    <ul>
        <li class="left">Donasi Anak Bangsa</li>
    </ul>
    <ul>
    </ul>
</nav>

</body>
</html>
