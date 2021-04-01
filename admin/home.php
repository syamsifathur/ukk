<?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<h2>Selamat Datang, <?php echo $pecah['username']; ?></h2>
		<hr>
		<?php } ?>

<?php 
$data_pelanggan = mysqli_query($koneksi,"SELECT * FROM pelanggan");
$data_pembelian = mysqli_query($koneksi,"SELECT * FROM pembelian");
$data_produk = mysqli_query($koneksi,"SELECT * FROM produk");
$jumlah_user = mysqli_num_rows($data_pelanggan);
$jumlah_pembelian = mysqli_num_rows($data_pembelian);
$jumlah_produk = mysqli_num_rows($data_produk);
?>

	<div class="content">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-5 col-md-4">
								<div class="text-center">
								<i class="fas fa-shopping-basket fa-4x"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="">
									<p>Total Pembelian</p>
									<p><?php echo $jumlah_pembelian ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-5 col-md-4">
								<div class="text-center">
								<i class="fas fa-user fa-4x"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="">
									<p>Total User</p>
									<p><?php echo $jumlah_user ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-5 col-md-4">
								<div class="text-center">
								<i class="fas fa-cube fa-4x"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="">
									<p>Total Produk Tersedia</p>
									<p><?php echo $jumlah_produk ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>