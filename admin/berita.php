<?php include '../connect.php'; ?>

<link href="assets/lightbox/lightbox.css" rel="stylesheet" />
<style>
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
<div class="row">
  <div class="col s12 m9">
    <h3 class="orange-text">Berita</h3>
  </div>
</div>

<button type="button" class="btn btn-primary mb-3" onclick="showTambahModal()">
        Tambah Data
</button>

<table id="example" class="table table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Judul</th>
      <th>Deskripsi</th>
      <th>Gambar</th>
      <th>Alamat</th>
      <th>Tanggal</th>
      <th>Opsi</th>
    </tr>
  </thead>
	<tbody>        
	<?php 
		$no=1;
		$query = mysqli_query($conn,"SELECT * FROM berita ");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['judul']; ?></td>
			<td><?php echo $r['deskripsi']; ?></td>
			<td><a href="uploads/<?php echo $r['gambar']; ?>" data-lightbox="roadtrip" width="100""><img src="uploads/<?php echo $r['gambar']; ?>" width="100"></a></td>
			<td><?php echo $r['alamat']; ?></td>
			<td><?php echo $r['tanggal']; ?></td>
			<td>
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn blue modal-trigger">Edit</a> | 
                <a href="#" onclick="deleteData(<?php echo $r['id']; ?>, '<?php echo $r['gambar']; ?>')" class="btn red modal-trigger">Hapus</a>
            </td>
		</tr>
        <?php }
             ?>
	</tbody>
</table>   

<!-- Modal Tambah Data -->
<div id="tambahModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="hideTambahModal">&times;</span>
        <form method="POST" enctype="multipart/form-data" action='tambah_berita.php' class="form-container">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Bencana</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>   
                    <input type="text" name="deskripsi" class="form-control" required>                          
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat</label>   
                    <input type="text" name="alamat" class="form-control" required>                          
                </div>

				<div class="form-group">
					<label for="tanggal">Tanggal</label>
					<input type="date" name="tanggal" class="form-control" required">
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
            
            xhr.open("GET", "hapus_berita.php?id=" + id + "&gambar=" + gambar, true);
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

	lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>

<script src="assets/lightbox/lightbox.js"></script>