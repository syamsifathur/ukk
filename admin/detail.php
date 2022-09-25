<h2>Detail Pembelian</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>

		<div class="row">
			<div class="col-md-6">
				<h3>Pembelian</h3>
				<strong>No. Pembelian: <?php echo $detail['id_pembelian'] ?></strong><br>
				Tanggal: <?php echo $detail['tanggal']; ?><br>
				Total: Rp. <?php echo number_format($detail['total']);  ?><br>
				Status Pembelian : <?php echo $detail['status_pembelian']; ?><br>
				Username Akun : <?php echo $detail['username_akun']; ?> <br>
				Password Akun : <?php echo $detail['password_akun']; ?> <br>
			</div>
			<div class="col-md-6">
				<h3>Pelanggan</h3>
				<strong><?php echo $detail['nama_lengkap']; ?></strong><br>
				<p>
					Email :<?php echo $detail['email']; ?><br>
					No.Hp :<?php echo $detail['no_hp']; ?>
				</p>
			</div>
		</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah']); ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>