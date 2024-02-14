<?php
// Koneksi database
$conn = mysqli_connect("localhost", "root", "", "donasi");

// Fungsi kirim email
function send_email($to, $subject, $message) {
  $headers = "From: admin@donasi.com";
  mail($to, $subject, $message, $headers); 
}

// Konfirmasi donasi
if(isset($_GET['confirm'])) {

  $id = $_GET['confirm'];

  // Ambil data donatur
  $sql = "SELECT * FROM donasi WHERE id=$id";
  $result = mysqli_query($conn, $sql);
  $donor = mysqli_fetch_assoc($result);

  // Update status donasi
  $update_sql = "UPDATE donasi SET status='confirmed' WHERE id=$id";
  mysqli_query($conn, $update_sql);

  // Kirim email 
  $to = $donor['email'];
  $subject = "Terima Kasih Atas Donasinya";
  $message = "Halo " . $donor['nama'] . ", terima kasih banyak atas donasi yang telah Anda berikan. Donasi Anda sangat berarti bagi kami.";
  
  send_email($to, $subject, $message);
  
  header("Location: donasi.php");
}

?>

<!-- Halaman donasi -->
<h2>Konfirmasi Donasi</h2>

<table>
  <thead>
    <tr>
      <th>Nama</th>
      <th>Jumlah</th>
      <th>Aksi</th> 
    </tr>
  </thead>

  <tbody>
  
    <?php  
    $sql = "SELECT * FROM donasi WHERE status='pending'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
    ?>
     <tr>
       <td><?php echo $row['nama']; ?></td>
       <td><?php echo $row['jumlah']; ?></td>
       <td>
         <a href="?confirm=<?php echo $row['id']; ?>">Konfirmasi</a> 
       </td>
     </tr>
    <?php } ?>
  
  </tbody>

</table>