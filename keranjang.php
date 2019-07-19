<?php
session_start();
$koneksi = new mysqli("localhost","root","","jayshop2");
?>

<!-- if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('keranjang kosong silahkan belanja dulu');</script>";
	echo "<script>location='findex.php';</script>";
} -->

<!<!DOCTYPE html>
<html>
<head>
	<title>Keranjang</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

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

		<section class="kontent">
			<div class="container">
				<h1>Keranjang Belanja</h1>
				<hr>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Produk</th>
							<th>Harga</th>
							<th>Jumlah</th>
							<th>SubHarga</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $nomor=1; ?>
						<?php foreach ($_SESSION["keranjang"] as $id_produk =>$jumlah): ?>
						<!--menampilkan produk yang sedang digunakan berdasarkan id produk-->
						<?php
						$ambil = $koneksi->query("Select * from produk where id_produk= $id_produk");
						$pecah = $ambil->fetch_assoc();
						$subharga = $pecah["harga_produk"]*$jumlah;
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah["nama_produk"]; ?></td>
							<td><?php echo number_format($pecah["harga_produk"]); ?></td>
							<td><?php echo $jumlah; ?></td>
							<td><?php echo number_format($subharga); ?></td>
							<td>
								<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
							</td>
						</tr>
						<?php $nomor++; ?>
						<?php endforeach?>
					</tbody>
				</table>
				<a href="findex.php" class="btn btn-default">Lanjutkan Belanja</a>
				<a href="login.php" class="btn btn-primary">Checkout</a>
			</div>
		</section>


	
</body>
</html>