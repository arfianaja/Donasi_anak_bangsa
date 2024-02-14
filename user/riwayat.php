<?php
include "../connect.php";
session_start();
$email = $_SESSION['email']; // Gantilah ini dengan cara Anda menyimpan informasi pengguna yang sudah login

$query = "SELECT * FROM donasi WHERE email = '$email'";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Donasi</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        body {
            background-image: url('../assets/img/bg.png');
            height: 100vh;
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 700px;
            margin: 10% auto;
            padding: 20px;
            width: 1500px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2, p{
            padding: 20px;
        }

        button {
                    background-color: #4caf50;
                    color: #fff;
                    padding: 10px 20px;
                    margin: 15px 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    position: absolut;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        @media print {
            body {
                background-image: none; /* Menghilangkan gambar latar saat mencetak */
            }

            button {
                display: none; /* Menyembunyikan tombol cetak saat mencetak */
            }
        }

        /* Media queries for responsiveness */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%; /* Adjust the width for tablet screens */
            }

            table {
                font-size: 14px; /* Adjust font size for smaller screens */
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                width: 100%; /* Adjust the width for mobile screens */
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Riwayat Donasi</h2>
    <p>Email: <?php echo $email; ?></p>
<?php if ($result->num_rows > 0): 
    $no = 1;
    ?>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jumlah Donasi</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
            <th>Tanggal</th>
            <th>Nama Bencana</th>
            <th>Deskripsi</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['jumlah_donasi']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['nomor_telp']; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['nama_bencana']; ?></td>
                <td><?php echo $row['deskripsi']; ?></td>
            </tr>
        <?php endwhile; ?>

    </table>
    <button class="btn" onclick="printPage()">Cetak Riwayat Donasi</button>
    <a class="red btn" href="beranda.php">Kembali</a>
<?php else: ?>
    <p>Tidak ada data donasi untuk <?php echo $email; ?>.</p>
<?php endif; ?>
</div>

<script>
        function printPage() {
            window.print();
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>