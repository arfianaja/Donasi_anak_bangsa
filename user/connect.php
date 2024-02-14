<?php
    $servername = "localhost";
    $username = "id21764458_donums";
    $password = "Berkahbersama1!";
    $dbname = "id21764458_donasi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }
    ?>