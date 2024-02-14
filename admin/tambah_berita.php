<?php
include('../connect.php');

// Cek dahulu, jika tombol tambah di klik
if (isset($_POST['tambah'])) {

    // Jika tombol tambah benar di klik maka lanjut prosesnya
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';

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
            $input = mysqli_query($conn, "INSERT INTO berita (judul, deskripsi, alamat, tanggal, gambar) VALUES ('$judul', '$deskripsi', '$alamat', '$tanggal', '$nama_file')") or die(mysqli_error($conn));

            // Jika query input sukses
            if ($input) {
                header("Location: index.php?p=berita");
                exit();
            } else {
                echo 'Gagal menambahkan data! ';      // Pesan jika proses tambah gagal
                header("Location: index.php?p=berita");  // Membuat Link untuk kembali ke halaman tambah
            }
        }
    } else {    // Jika tidak terdeteksi tombol tambah di klik
        // Redirect atau dikembalikan ke halaman tambah
        echo '<script>window.history.back()</script>';
    }
}
?>
