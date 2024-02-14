<?php include '../connect.php'; ?>
<link href="assets/lightbox/lightbox.css" rel="stylesheet" />

<div class="row">
  <div class="col s12 m9">
    <h3 class="orange-text">Donasi</h3>
  </div>
</div>

<table id="example" class="display table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Jumlah Donasi</th>
      <th>Pesan Donatur</th>
      <th>No Hp</th>
      <th>Bukti Transfer</th>
      <th>Nama Bencana</th>
      <th>Tanggal</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $no = 1;
    $totalDonasi = 0; // Tambahkan variabel totalDonasi
    $query = mysqli_query($conn, "SELECT * FROM donasi");
    while ($r = mysqli_fetch_assoc($query)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $r['nama']; ?></td>
        <td><?php echo $r['jumlah_donasi']; ?></td>
        <td><?php echo $r['pesan_donatur']; ?></td>
        <td><?php echo $r['nomor_telp']; ?></td>
        <td>
          <a href="../user/uploads/<?php echo $r['gambar']; ?>" data-lightbox="roadtrip" width="100""><img src="../user/uploads/<?php echo $r['gambar']; ?>" width="100"></a>
        </td>
        <td><?php echo $r['nama_bencana']; ?></td>
        <td><?php echo $r['tanggal']; ?></td>
        <td>

          <a href="#" onclick="deleteData(<?php echo $r['id']; ?>)">Hapus</a>|
          <a href="upload_message.php?id=<?php echo $r['id']; ?>" onclick="return confirm('Apakah Anda ingin konfirmasi pembayaran?')">Konfirmasi</a>
        </td>
        
      </tr>

      <?php
      $totalDonasi += $r['jumlah_donasi'];
      ?>
    <?php } ?>

  </tbody>
</table>


<!-- Tampilkan jumlah donasi masing-masing bencana -->
<h4>Jumlah Donasi per Bencana</h4>
<table>
  <thead>
    <tr>
      <th>Nama Bencana</th>
      <th>Total Donasi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $queryBencana = mysqli_query($conn, "SELECT nama_bencana, SUM(jumlah_donasi) as total_donasi FROM donasi GROUP BY nama_bencana");
    while ($rowBencana = mysqli_fetch_assoc($queryBencana)) {
		$namaBencana = $rowBencana['nama_bencana'];
		$totalDonasi = $rowBencana['total_donasi'];

		// Check if the record already exists in the total_donasi table
		$checkQuery = mysqli_query($conn, "SELECT * FROM total_donasi WHERE nama_bencana = '$namaBencana'");

		if (mysqli_num_rows($checkQuery) > 0) {
			// Update existing record
			$updateQuery = mysqli_query($conn, "UPDATE total_donasi SET total_donasi = '$totalDonasi' WHERE nama_bencana = '$namaBencana'");
		} else {
			// Insert new record
			$insertQuery = mysqli_query($conn, "INSERT INTO total_donasi (nama_bencana, total_donasi) VALUES ('$namaBencana', '$totalDonasi')");
		}
      echo "<tr>";
      echo "<td>" . $rowBencana['nama_bencana'] . "</td>";
      echo "<td>Rp " . number_format($rowBencana['total_donasi']) . "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<!-- AJAX Script -->
<script>
function deleteData(id) {
  var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
  if (confirmation) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        location.reload();
      }
    };
    xhr.open("GET", "delete.php?id=" + id, true);
    xhr.send();
  }
}

lightbox.option({
      'resizeDuration': 100,
      'wrapAround': true
    })
</script>
<script src="assets/lightbox/lightbox.js"></script>
