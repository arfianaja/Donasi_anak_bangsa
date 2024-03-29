<link href="assets/lightbox/lightbox.css" rel="stylesheet" />
		
		<div class="row">
          <div class="col s12 m9">
            <h3 class="orange-text">User</h3>
          </div>  
          <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn modal-trigger blue" href="#modal1"><i class="material-icons">add</i></a>
          </div>
        </div>

        <table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Telephone</th>
				<th>Profile Picture</th>
				<th>Alamat</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
	include '../connect.php';
		$no=1;
		$tampil = mysqli_query($conn, "SELECT id, name, email, nomor_telp, gambar, alamat FROM users WHERE role = 'member' ORDER BY id ASC");
		while ($r=mysqli_fetch_assoc($tampil)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['name']; ?></td>
			<td><?php echo $r['email']; ?></td>
			<td><?php echo $r['nomor_telp']; ?></td>
			<td>
				<a href="../user/uploads/<?php echo $r['gambar']; ?>" data-lightbox="roadtrip" width="100""><img src="../user/uploads/<?php echo $r['gambar']; ?>" width="100"></a>
			</td>
			<td><?php echo $r['alamat']; ?></td>
			<td><a class="btn teal modal-trigger" href="#user_edit<?php echo $r['id'] ?>">Edit</a> <a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=user_hapus&id=<?php echo $r['id'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="user_edit<?php echo $r['id'] ?>" class="modal">
          <div class="modal-content">
            <h4>Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="name">Nama</label>
					<input hidden type="text" name="id" value="<?php echo $r['id']; ?>">
					<input id="nama" type="text" name="nama" value="<?php echo $r['name']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?php echo $r['telp']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<p>
						<label>
						  <input value="admin" class="with-gap" name="level" type="radio" <?php if($r['level']=="admin"){echo "checked";} ?> />
						  <span>Admin</span>
						</label>
						<label>
						  <input value="petugas" class="with-gap" name="level" type="radio" <?php if($r['level']=="petugas"){echo "checked";} ?> />
						  <span>Petugas</span>
						</label>
					</p>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					// echo $_POST['name'].$_POST['username'].$_POST['telp'].$_POST['level'];
					$update=mysqli_query($conn,"UPDATE petugas SET name='".$_POST['name']."',username='".$_POST['username']."',telp='".$_POST['telp']."',level='".$_POST['level']."' WHERE id='".$_POST['id']."' ");
					if($update){
						echo "<script>alert('Data di Update')</script>";
						echo "<script>location='index.php?p=user'</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>Add</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="name">Nama</label>
					<input id="name" type="text" name="name">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="password">Password</label>
					<input id="password" type="password" name="password"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp"><br><br>
				</div>

				<div class="col s12 input-field">
					<select class="default" name="level">
						<option selected disabled="">Pilih Level</option>
						<option value="admin">Admin</option>
						<option value="petugas">Petugas</option>
					</select>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="input" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['input'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($conn,"INSERT INTO petugas VALUES (NULL,'".$_POST['name']."','".$_POST['username']."','".$password."','".$_POST['telp']."','".$_POST['level']."')");
					if($query){
						echo "<script>alert('Data Ditambahkan')</script>";
						echo "<script>location='index.php?p=user'</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>

		<script>
			lightbox.option({
			'resizeDuration': 100,
			'wrapAround': true
			})
		</script>
		<script src="assets/lightbox/lightbox.js"></script>