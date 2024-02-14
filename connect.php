    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dot";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }
    ?>