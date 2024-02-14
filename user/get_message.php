<?php

include '../connect.php';

// cek koneksi
if(!$conn){
   echo "Gagal koneksi database";
   exit;
}  

$sql = "SELECT pesan FROM donasi ORDER BY id DESC LIMIT 10";

$result = mysqli_query($conn, $sql);

// cek query 
if(!$result){
   echo "Query Error: " . mysqli_error($conn);
   exit;
}

$messages = []; 

while($row = mysqli_fetch_assoc($result)) {
  $messages[] = $row['pesan'];
} 

// debug
echo count($messages) . " data pesan";  

echo json_encode($messages);
?>