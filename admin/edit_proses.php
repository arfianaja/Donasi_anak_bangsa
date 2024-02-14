<!-- edit_proses.php -->
<?php
include('../connect.php');

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $lokasi = $_POST['lokasi'];
    $target_donasi = intval($_POST['target_donasi']);
    $link_donasi = $_POST['link_donasi']; // Convert to integer
    $status = $_POST['status'];;

    $sql = "UPDATE bencana SET nama='$nama', deskripsi='$deskripsi', lokasi='$lokasi', target_donasi='$target_donasi', status='$status', link_donasi='$link_donasi' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully";
        header("Location: index.php?p=bencana");
    } else {
        echo "Error updating data: " . $conn->error;
    }
}

$conn->close();
?>
