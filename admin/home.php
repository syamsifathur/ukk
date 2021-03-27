<?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
		<?php while ($pecah = $ambil->fetch_assoc()){ ?>
		<h2>Selamat Datang, <?php echo $pecah['username']; ?></h2>
		<?php } ?>
