<?php
include '../connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete data from the database
    $deleteQuery = mysqli_query($conn, "DELETE FROM donasi WHERE id = $id");

    if ($deleteQuery) {
        // Optionally, you can delete associated files or perform other cleanup tasks

        // Return a success message (you can handle this in the AJAX callback)
        echo "Data deleted successfully";
    } else {
        // Return an error message (you can handle this in the AJAX callback)
        echo "Error deleting data";
    }
} else {
    // Handle the case where id or gambar is not set
    echo "Invalid parameters";
}
?>
