<?php
include('../connect.php');

// Cek dahulu, jika tombol tambah di klik
if (isset($_POST['tambah'])) {

    // Jika tombol tambah benar di klik maka lanjut prosesnya
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $nomor_telp = isset($_POST['nomor_telp']) ? $_POST['nomor_telp'] : '';
    $pesan_donatur = isset($_POST['pesan_donatur']) ? $_POST['pesan_donatur'] : '';
    $nama_bencana = isset($_POST['nama_bencana']) ? $_POST['nama_bencana'] : '';
    $deskripsi_bencana = isset($_POST['deskripsi_bencana']) ? $_POST['deskripsi_bencana'] : '';
    $jumlah_donasi = isset($_POST['jumlah_donasi']) ? $_POST['jumlah_donasi'] : '';

    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    // Cek apakah gambar berhasil diupload
    if ($_FILES['gambar']['error'] == 0) {

        // Validasi gambar (ukuran dan ekstensi)
        $valid_extensions = array('jpg', 'jpeg', 'png');
        $max_size = 2048 * 1024; // 2MB
        $extension = pathinfo($nama_file, PATHINFO_EXTENSION);

        if (in_array(strtolower($extension), $valid_extensions) && $_FILES['gambar']['size'] < $max_size) {

            // Upload gambar
            $folder_tujuan = 'uploads/';
            move_uploaded_file($tmp_file, $folder_tujuan . $nama_file);

            // Melakukan query dengan perintah INSERT INTO untuk memasukkan data ke database
            $sql = "INSERT INTO donasi (nama, email, tanggal, nomor_telp, pesan_donatur, jumlah_donasi, nama_bencana, gambar, deskripsi) VALUES ('$nama', '$email', '$tanggal', '$nomor_telp', '$pesan_donatur', '$jumlah_donasi', '$nama_bencana', '$nama_file', '$deskripsi_bencana')";

            
            echo $sql; // Debugging: Print the actual SQL query

            $result = mysqli_query($conn, $sql);

            // Jika query input sukses
            if ($result) {

                // Ambil ID donasi baru
                $id_donasi_baru = mysqli_insert_id($conn);
              
                // Redirect ke halaman bukti donasi
                header("Location: bencana.php");

            } else {

                // Jika gagal, tampilkan pesan error
                echo "Error: " . mysqli_error($conn);

            }
        }
    } else { // <-- Added this closing brace
        // If there is an error with file upload
        echo "Error uploading file.";
    }
} else { // <-- Added this closing brace
    // If the 'tambah' button is not set
    echo "Tombol tambah tidak diklik.";
}

// Tutup koneksi
mysqli_close($conn);
?>
