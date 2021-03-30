	<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="index.php"><img src="img/logo1.png" alt="logo"></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav mr-auto">
		      	<li class="nav-item active">
		        	<a class="nav-link" href="index.php">Beranda</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="keranjang.php">Keranjang</a>
			    </li>
		      	<!-- jika sudah login(ada session pelanggan)-->
				<?php if (isset($_SESSION["pelanggan"])):?>
				<li class="nav-item">
					<a class="nav-link" href="riwayat.php">Riwayat Belanja</a>		
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
				<!-- selain itu (blm login) blm ada session pelanggan -->
				<?php else: ?>
				<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="daftar.php">Daftar</a>
				</li>
				<?php endif ?>
				<li class="nav-item">
					<a class="nav-link" href="checkout.php">Checkout</a>
				</li>
		    </ul>

		    <form action="pencarian.php" method="get" class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Cari" name="keyword">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
		    </form>
		  </div>
	  </div>
	</nav>
	</header>
