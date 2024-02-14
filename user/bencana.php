<?php
include '../connect.php';

// Fetch data from the database
$result = mysqli_query($conn, "SELECT bencana.id, bencana.nama, bencana.deskripsi, bencana.target_donasi, bencana.lokasi, bencana.terkumpul, SUM(donasi.jumlah_donasi) AS total_donasi, bencana.gambar, bencana.link_donasi
                                FROM bencana
                                LEFT JOIN donasi ON bencana.nama = donasi.nama_bencana
                                GROUP BY bencana.id, bencana.nama, bencana.deskripsi, bencana.target_donasi, bencana.lokasi, bencana.terkumpul, bencana.gambar, bencana.link_donasi");


$bencana = array();

// Check if there is data in the result
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bencana[] = array(
            "nama" => $row['nama'],
            "deskripsi" => $row['deskripsi'],
            "target_donasi" => $row['target_donasi'],
            "lokasi" => $row['lokasi'],
            "terkumpul" => $row['terkumpul'],
            "total_donasi" => $row['total_donasi'],
            "gambar" => $row['gambar'],
            "link_donasi" => $row['link_donasi'], // Assuming your images are stored in an 'uploads' directory
        );
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Bencana</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assests/css/style.css">
  <script type="text/javascript"
		src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-rJhBRt7974t8FoG0"></script>

    <style>
      body {
          background-image: url('../assets/img/bg.png');
          background-size: cover;
          background-repeat: no-repeat;
          font-family: Arial, sans-serif;
          background-color: #f2f2f2; /* This is a fallback color in case the image is not loaded or available */
      }

      .bencana-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        padding: 20px;
      }

      .bencana-box {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        margin: 15px;
        padding: 20px;
        width: 300px;
        width: calc(25% - 30px);
        background-color: #fff;
        transition: transform 0.3s ease-in-out;
      }

      .bencana-box:hover {
        transform: scale(1.05);
      }

      .bencana-box img {
        width: 80%;
        height: auto;
        padding: 20px;
        object-fit: cover;
        border-radius: 25px;
        margin: 0 auto; /* Menengahkan gambar */
        display: block; /* Untuk memastikan margin: 0 auto; berfungsi */
      }

      .bencana-box h1 {
        font-size: 1.5rem;
        margin: 10px;
      }

      .bencana-box p {
        margin: 10px;
      }

      .progress-bar {
        height: 15px;
        background-color: #ecf0f1;
        margin: 10px;
        border-radius: 5px;
        overflow: hidden;
      }

      .progress-fill {
        height: 100%;
        background-color: #3498db;
      }

      .bencana-box p, .bencana-box button {
        text-align: center;
      }
      /* Media queries for responsiveness */
    @media only screen and (max-width: 768px) {
      .bencana-box {
        width: calc(50% - 30px);
      }
    }

    @media only screen and (max-width: 576px) {
      .bencana-box {
        width: calc(100% - 30px);
      }
    }

    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="bencana-container">
  <?php foreach ($bencana as $data_bencana): ?>
    <div class="bencana-box">
    <img src="<?php echo "../admin/uploads/" . $data_bencana["gambar"]; ?>" alt="<?php echo $data_bencana["nama"]; ?>">
      <h1><?php echo $data_bencana["nama"] ?></h1>

      <p><?php echo $data_bencana["deskripsi"] ?></p>
      <p><?php echo $data_bencana["lokasi"] ?></p>

      <div class="progress-bar">
      <div class="progress-fill" style="width: <?php echo ($data_bencana["total_donasi"] / $data_bencana["target_donasi"]) * 100 ?>%;"></div>
      </div>

      <p>Total Donasi: Rp <?php echo ($data_bencana["total_donasi"] !== null) ? number_format($data_bencana["total_donasi"]) : '0' ?></p>
      <p>Target: Rp <?php echo ($data_bencana["target_donasi"] !== null) ? number_format($data_bencana["target_donasi"]) : '0' ?></p>


      <!-- Mengarahkan langsung ke link donasi untuk setiap bencana -->
      <button onclick="openDonationPopup('<?php echo $data_bencana['link_donasi']; ?>')" class="btn">
      <i class="fas fa-donate"> donasi</i> 
      </button>

      <button onclick="openModal('<?php echo $data_bencana['nama']; ?>')" class="btn">
        <i class="fas fa-donate"> bukti donasi</i> 
      </button>
    </div>
  <?php endforeach; ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Form Donasi - <span id="bencanaTitle"></span></h2>
    <!-- Tambahkan formulir donasi di sini -->
    <form method="POST" enctype="multipart/form-data" action='tambah_donasi.php' class="don">
      <!-- Tambahkan input tersembunyi untuk menyimpan nama bencana -->
      <input type="hidden" name="nama_bencana" id="nama_bencana">

      <input type="hidden" name="gambar_bencana" id="gambar_bencana">

      <input type="hidden" name="deskripsi_bencana" id="deskripsi_bencana">

      <label for="nama">Nama Lengkap:</label>
      <input type="text" id="nama" name="nama" required>

      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>

      <label for="tanggal">Tanggal:</label>
      <input type="date" id="tanggal" name="tanggal" required>

      <label for="nomor_telp">Nomor Telepon:</label>
      <input type="tel" id="nomor_telp" name="nomor_telp" required>

      <label for="jumlah_donasi">Jumlah Donasi:</label>
      <input type="number" name="jumlah_donasi" id="jumlah_donasi" required>

      <label for="pesan_donatur">Pesan</label>
      <input type="text" name="pesan_donatur" id="pesan_donatur">


      <label for="gambar">Bukti Donasi</label>
      <input type="file" name="gambar" id="gambar" accept="image/*" required>

      <button type="submit" name="tambah">Donasi</button>
    </form>
  </div>
</div>

<script>
  // JavaScript untuk menangani modal
  function openModal(bencanaTitle, gambarURL, deskripsi) {
    document.getElementById('bencanaTitle').innerText = bencanaTitle;
    document.getElementById('nama_bencana').value = bencanaTitle;
    document.getElementById('deskripsi_bencana').value = deskripsi;
    document.getElementById('gambar_bencana').value = gambarURL; // Set the value of the hidden input for image URL
    document.getElementById('myModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('myModal').style.display = 'none';
  }

  // Additional script to set the description value
  document.addEventListener('DOMContentLoaded', function () {
    <?php foreach ($bencana as $data_bencana): ?>
      document.getElementById('deskripsi_bencana_display').innerText = '<?php echo $data_bencana["deskripsi"]; ?>';
    <?php endforeach; ?>
  });
</script>

<script src="js/app.js"></script>
</body>
</html>
