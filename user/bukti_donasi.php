<?php
include '../connect.php';

// Ambil ID donasi dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan informasi donasi berdasarkan ID
    $query = "SELECT * FROM donasi WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $donasi_info = mysqli_fetch_assoc($result);
        
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Bukti Donasi</title>
            <link rel="stylesheet" href="../style.css">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }

                .navbar {
                    background-color: #333;
                    color: #fff;
                    padding: 10px;
                    text-align: center;
                }

                .bukti-donasi-container {
                    background-color: #fff;
                    margin: 20px;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 600px;
                    margin: 20px auto;
                    display: flex;
                    align-items: flex-start; /* Align items to the start of the container */
                    justify-content: space-between;
                    flex-wrap: wrap;
                }

                .donasi-details {
                    max-width: 300px;
                    display: flex;
                    flex-direction: column; /* Align items vertically */
                    margin-bottom: 20px;
                }

                img {
                    max-width: 100%;
                    height: auto;
                    margin-bottom: 20px;
                }

                h2 {
                    color: #333;
                    margin-bottom: 10px; /* Add some space below the heading */
                }

                p {
                    margin: 5px 0;
                }

                button {
                    background-color: #4caf50;
                    color: #fff;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }

                button:hover {
                    background-color: #45a049;
                }

                img {
                    max-width: 100%;
                    height: auto;
                    margin-bottom: 20px;
                }

                @media print {
                    body {
                        background-image: none; /* Menghilangkan gambar latar saat mencetak */
                    }

                    button {
                        display: none; /* Menyembunyikan tombol cetak saat mencetak */
                    }
                }
            </style>
        </head>
        <body>
            <?php include 'navbar.php'; ?>
            <div class="bukti-donasi-container">
                <div class="donasi-details">
                    <h2>Bukti Donasi</h2>
                    <img src="<?php echo "../admin/uploads/" . $donasi_info["gambar"]; ?>">
                    <p>Nama: <?php echo $donasi_info['nama']; ?></p>
                    <p>Email: <?php echo $donasi_info['email']; ?></p>
                    <p>Alamat: <?php echo $donasi_info['alamat']; ?></p>
                    <p>Tanggal: <?php echo $donasi_info['tanggal']; ?></p>
                    <p>Nomor Telepon: <?php echo $donasi_info['nomor_telp']; ?></p>
                </div>
                <div class="donasi-details1">
                    <!-- Tambahkan elemen <img> untuk menampilkan gambar -->
                    
                    <p>Nama Bencana: <?php echo $donasi_info['nama_bencana']; ?></p>
                    <p>Jumlah Donasi: Rp <?php echo number_format($donasi_info['jumlah_donasi']); ?></p>
                    <p>Bank: <?php echo $donasi_info['nama_bank']; ?></p>
                </div>
            </div>
            <button onclick="printPage()">Cetak Riwayat Donasi</button>

            <script>
                function printPage() {
                    window.print();
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "Data donasi tidak ditemukan.";
    }
} else {
    echo "ID Donasi tidak diberikan.";
}

// Jangan lupa untuk menutup koneksi database setelah selesai menggunakan
mysqli_close($conn);
?>
