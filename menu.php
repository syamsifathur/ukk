	<header>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="img/cobal.png" alt="ThuurStore">
			</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      	<li class="nav-item">
		        	<a class="nav-link" href="produk.php">Produk</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="keranjang.php">Keranjang</a>
			    </li>
			    <li class="nav-item">
					<a class="nav-link" href="checkout.php">Checkout</a>
				</li>
			</ul>
				<ul class="navbar-nav ml-auto">
		      	<!-- jika sudah login(ada session pelanggan)-->
				<?php if (isset($_SESSION["pelanggan"])):?>
				<li class="nav-item">
					<a class="nav-link" href="riwayat.php">Riwayat Belanja</a>		
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar ?')">Logout</a>
				</li>
				<!-- selain itu (blm login) blm ada session pelanggan -->
				<?php else: ?>
				<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				</li>
				<?php endif ?>
				</ul>
		    
		  </div>
	  </div>
	</nav>
	</header>
	<br>