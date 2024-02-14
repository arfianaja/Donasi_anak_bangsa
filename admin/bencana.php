<?php
// Koneksi ke database
include '../connect.php';	

// Tampilkan data bencana 
$result = mysqli_query($conn, "SELECT * FROM bencana");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Donasi</title>
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

        /* Custom style for the modal */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 80%;
            max-width: 600px;
        }

        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #888;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Data Donasi</h1>
    
    <button 
        type="button" 
        class="btn btn-primary mb-3" 
        onclick="showTambahModal()">
        Tambah Data
    </button>

    <!-- Tabel data bencana -->
	<?php 
	$no = 1;
	?>
    <table class="table table-bordered">
        <thead>
            <tr>
				<th>No</th>
                <th>Gambar</th>
                <th>Nama </th>
                <th>Deskripsi</th>
				<th>Lokasi</th>
				<th>Target Donasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
						<td><?php echo $no++; ?></td>
                        <td>
                            <img src="uploads/<?php echo $row['gambar']; ?>" width="100"> 
                        </td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><p><?php echo $row['deskripsi']; ?></p></td>
						<td><?php echo $row['lokasi']; ?></td>
						<td><?php echo $row['target_donasi']; ?></td>
						<td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                            <a href="#" onclick="deleteData(<?php echo $row['id']; ?>, '<?php echo $row['gambar']; ?>')">Hapus</a>
                        </td>               
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Data -->
<div id="tambahModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="hideTambahModal">&times;</span>
        <form method="POST" enctype="multipart/form-data" action='tambah_proses.php' class="form-container">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Bencana</h5>
            </div>
            <div class="modal-body">
                <!-- Your form content here -->

                <div class="form-group">
                    <label for="nama">Nama Bencana</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>   
                    <textarea name="deskripsi" class="form-control" required></textarea>                          
                </div>
                
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>   
                    <textarea name="lokasi" class="form-control" required></textarea>                          
                </div>

                <div class="form-group">
                    <label for="target_donasi">Target Donasi</label>
                    <input type="text" name="target_donasi" id="">
                </div>

                <div class="form-group">
                    <label for="link_donasi">Link Donasi</label>
                    <input type="text" name="link_donasi" id="">
                </div>
                
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hideTambahModal()">Tutup</button>
                <button type="submit" class="btn btn-primary" name='tambah'>Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Additional JavaScript for modal functionality -->
<script>
    function deleteData(id, gambar) {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
        
        if (confirmation) {
            // Make an AJAX request to delete data
            var xhr = new XMLHttpRequest();
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Data deleted successfully, you can handle additional UI updates here
                    location.reload(); // Reload the page for simplicity, you might want to update the UI without reloading
                }
            };
            
            xhr.open("GET", "hapus.php?id=" + id + "&gambar=" + gambar, true);
            xhr.send();
        }
    }

    function showTambahModal() {
        var modal = document.getElementById('tambahModal');
        modal.style.display = 'block';
    }

    function hideTambahModal() {
        var modal = document.getElementById('tambahModal');
        modal.style.display = 'none';
    }

    function showEditModal(id) {
        // You can fetch the data for the specific ID and fill in the edit form here
        var modal = document.getElementById('editModal');
        modal.style.display = 'block';
    }

    function hideEditModal() {
        var modal = document.getElementById('editModal');
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        var tambahModal = document.getElementById('tambahModal');
        var editModal = document.getElementById('editModal');

        if (event.target == tambahModal) {
            tambahModal.style.display = 'none';
        }

        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    };
</script>

</body>
</html>
