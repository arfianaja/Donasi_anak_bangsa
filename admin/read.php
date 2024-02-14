<?php
  $data = json_decode(file_get_contents('data.json'), true);

  foreach ($data as $bencana) {
    echo "<tr>";
    echo "<td>{$bencana['nama']}</td>";
    echo "<td>{$bencana['deskripsi']}</td>";
    echo "<td>{$bencana['lokasi']}</td>";
    echo "<td>{$bencana['target_donasi']}</td>";
    echo "<td>{$bencana['terkumpul']}</td>";
    echo "<td>{$bencana['gambar']}</td>";
    echo "<td>{$bencana['status']}</td>";
    echo "<td><button class='btn btn-warning'>Edit</button> <button class='btn btn-danger'>Hapus</button></td>";
    echo "</tr>";
  }
?>
