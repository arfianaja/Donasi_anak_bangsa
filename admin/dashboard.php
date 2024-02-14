
<h3 class="orange-text">Dahsboard</h3>

	<div class="row">
		<div class="col s4">
			<div class="card red">
				<div class="card-content white-text">
				<?php
					include '../connect.php';
					// Siapkan pernyataan SQL untuk mendapatkan jumlah pengguna
					$sql = "SELECT COUNT(*) AS total_users FROM users WHERE role = 'member'";
					$result = mysqli_query($conn, $sql);

					if ($result) {
						$row = mysqli_fetch_assoc($result);
						$total_users = $row['total_users'];
					} else {
						$total_users = "Error retrieving data";
					}

					// Menutup koneksi
					mysqli_close($conn);
					?>
					<span class="card-title">User <b class="right"><?php echo $total_users; ?></b></span>
					<p></p>
				</div>
			</div>
		</div>

		<div class="col s4">
		    <div class="card teal">
		    <div class="card-content white-text">
			<?php
					include '../connect.php';
					// Siapkan pernyataan SQL untuk mendapatkan jumlah pengguna
					$sql = "SELECT COUNT(*) AS total_bencana FROM bencana";
					$result = mysqli_query($conn, $sql);

					if ($result) {
						$row = mysqli_fetch_assoc($result);
						$total_bencana = $row['total_bencana'];
					} else {
						$total_bencana = "Error retrieving data";
					}

					// Menutup koneksi
					mysqli_close($conn);
					?>
		      <span class="card-title">Data Bencana <b class="right"><?php echo $total_bencana; ?></b></span>
		      <p></p>
		    </div>
		  </div>
		</div>
	</div>