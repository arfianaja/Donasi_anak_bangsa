<?php
include '../connect.php';

$stmt = $conn->prepare("SELECT * FROM berita");
$stmt->execute();
$result = $stmt->get_result();

// Check if there is data in the result
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $berita[] = [
            "judul" => $row['judul'],
            "deskripsi" => $row['deskripsi'],
            "gambar" => $row['gambar'],
            "alamat" => $row['alamat'],
            "tanggal" => $row['tanggal'],
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
<?php include 'navbar.php'; ?>
<header class="bg-light text-center py-5" style="background-image: url(../assets/img/don2.jpg)">
    <h1 class="display-4">Donasi Anak Bangsa</h1>
    <p class="lead">Terima Kasih Buat kalian yang telah berdonasi</p>
</header>

<?php foreach ($berita as $b): ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="../admin/uploads/<?= $b['gambar']; ?>" class="img-fluid rounded" alt="Bunga">
            </div>
            <div class="col-md-6">
                <h2 class="mb-3"><?= $b['judul']; ?></h2>
                <p><?= $b['deskripsi']; ?></p>
                <p><strong>Alamat:</strong> <?= $b['alamat']; ?></p>
                <p><strong>Tanggal:</strong> <?= $b['tanggal']; ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="flex-grow-1"></div>

<footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 Donasi Anak Bangsa</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
