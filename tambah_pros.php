<?php
include('connect.php');

// Cek dahulu, jika tombol tambah di klik
if (isset($_POST['tambah'])) {

    // Jika tombol tambah benar di klik maka lanjut prosesnya
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
    $nomor_telp = isset($_POST['nomor_telp']) ? $_POST['nomor_telp'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if the file input is set and not empty
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0 && !empty($_FILES['gambar']['name'])) {
        // Corrected line for handling file upload
        $gambar = $_FILES['gambar']['name'];

        // Validasi gambar (ukuran dan ekstensi)
        $valid_extensions = array('jpg', 'jpeg', 'png');
        $max_size = 2048 * 1024; // 2MB
        $extension = pathinfo($gambar, PATHINFO_EXTENSION);

        if (in_array(strtolower($extension), $valid_extensions) && $_FILES['gambar']['size'] < $max_size) {
            // Upload gambar
            $folder_tujuan = 'uploads/';
            move_uploaded_file($_FILES['gambar']['tmp_name'], $folder_tujuan . $gambar);

            $role = 'member'; // Set the role to 'member'
            
            // Use correct variable name $nama instead of $name
            $input = mysqli_query($conn, "INSERT INTO users (name, email, alamat, jenis_kelamin, nomor_telp, password, gambar, role) VALUES ('$name', '$email', '$alamat', '$jenis_kelamin', '$nomor_telp', '$password', '$gambar', '$role')") or die(mysqli_error($conn));

            // Jika query input sukses
            if ($input) {
                echo 'Data Anda Telah Didaftarkan, Silahkan Login'; // Added missing semicolon
                header("Location: login.php");
                exit();
            } else {
                echo 'Gagal menambahkan data! ';      // Pesan jika proses tambah gagal
                header("Location: daftar.php");  // Membuat Link untuk kembali ke halaman tambah
            }
        } else {
            echo 'File tidak valid';
            header("Location: daftar.php");
        }
    } else {
        echo 'File not selected or error uploading file';
    }
}
?>
