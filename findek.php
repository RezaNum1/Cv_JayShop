<?php
session_start();
    //koneksi database
  $koneksi = new mysqli("localhost","root","","jayshop2");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>JAYSHOP</title>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
<!-- navbar-->
	
	<nav class="navbar nabar-default">
			<div class="container">
				<ul class="nav navbar-nav">
					<li><a href="findek.php">Home</a></li>
					<li><a href="keranjang.php">Keranjang</a></li>
					<!-- jika sudah login-->

					<?php if (isset($_SESSION["pelanggan"])): ?>
						<li><a href="logout.php">Logout</a></li>
					<?php else: ?>
						<li><a href="login.php">Login</a></li>
					<?php endif ?>
					<li><a href="checkout.php">Checkout</a></li>
				</ul>
		</nav>

	
	<!-- kontent-->
	<section class="konten">
		<div class="container">
			<h1>produk terbaru</h1>
			<br>
         		 </div>
					<div class="row">
					<?php $ambil = $koneksi->query("select * from produk"); ?>
					<?php while($perproduk = $ambil->fetch_assoc()){ ?>	
					<div class="col-md-3">
							<div class="thumbnail">
								<img style="height: 500px;" src="foto_produk/<?php echo $perproduk['foto_produk'] ?>" alt="">
								<div class="caption">
									<h3><?php echo $perproduk['nama_produk']; ?></h3>
									<h5>Rp.<?php echo number_format($perproduk['harga_produk']);?> </h5>
									<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
								</div>
							</div>				
						</div>	
					<?php } ?>	
					</div>	
	</section>
</body>
</html>	