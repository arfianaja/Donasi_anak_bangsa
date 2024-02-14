<?php

session_start();

include 'connect.php';

if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $alamat = $_POST['alamat'];
  $no_telp = $_POST['no_telp'];  

  $id = $_SESSION['member']['id'];

  $sql = "UPDATE users SET name='$name', alamat='$alamat', no_telp='$no_telp', role='member WHERE id=$id";

  if (mysqli_query($conn, $sql)) {
    $_SESSION['member']['nama'] = $nama; 
    header("Location: profil.php");
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }

}

?>