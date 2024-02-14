<!-- edit.php -->
<?php
include('../connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM bencana WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Donasi</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
        }

        .container {
            margin-top: 20px;
        }

        .table th, .table td {
            text-align: center;
        }

        .modal-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Data </h1>
    <form method="POST" enctype="multipart/form-data" action='edit_proses.php'>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <div class="form-group">
            <label>Nama Bencana</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?php echo $row['deskripsi']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <textarea name="lokasi" class="form-control"><?php echo $row['lokasi']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Target Donasi</label>
            <textarea name="target_donasi" class="form-control"><?php echo $row['target_donasi']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Link Donasi</label>
            <textarea name="link_donasi" class="form-control"><?php echo $row['link_donasi']; ?></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="<?php echo $row['status']; ?>">
        </div>

        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name='edit'>Simpan</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>