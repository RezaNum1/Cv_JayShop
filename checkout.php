<?php
session_start();
$koneksi = new mysqli("localhost","root","","jayshop2");

if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silhkan login');</script>";
	echo "<script>location='login.php';</script>";
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
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
						</tr>
					</thead>
					<tbody>
						<?php $nomor=1; ?>
						<?php $totalbelanja =0;?>
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
						</tr>
						<?php $nomor++; ?>
						<?php $totalbelanja+=$subharga?>
						<?php endforeach?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="4">Total Belanja</th>
							<th>Rp. <?php echo number_format($totalbelanja) ?></th>
						</tr>
					</tfoot>
				</table>

				<form method="post">

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<input type="tex" readonly value="<?php echo $_SESSION["pelanggan"] ['nama_pelanggan'] ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="tex" readonly value="<?php echo $_SESSION["pelanggan"] ['telepon_pelanggan'] ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<select class="form-control" name="id_ongkir">
								<option value="">Pilih Ongkos Kirim</option>
								<?php
								$ambil = $koneksi->query("Select * from ongkir");
								while($perongkir = $ambil->fetch_assoc())
								{?>
									<option value="">
										<?php echo $perongkir['nama_kota'] ?>
										Rp. <?php echo number_format($perongkir['tarif']) ?>								
									</option>
								<?php } ?>
							</select>							
						</div>
					</div>
					<button class="btn btn-primary" name="checkout">CheckOut</button>
				</form>

				<?php
					if(isset($_POST["checkout"])) 
					{
						$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
						$id_ongkir = $_POST["id_ongkir"];
						$tanggal_pembelian = date("y-m-d");

						$ambil = $koneksi->query("Select * from ongkir where id_ongkir='$id_ongkir'");
						$arrayongkir = $ambil->fetch_assoc();
						$tarif = $arrayongkir['tarif'];

						$total_pembelian = $totalbelanja + $tarif;

						//1.menyimpan ke table pembelian
						$koneksi->query("insert into pembelian(id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif)
							values ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian')");

						// mendapatkan id_pembelian barusan terjadi

				 		$id_pembelian_barusan = $koneksi->insert_id;

				 		foreach($_SESSION["keranjang"] as $id_produk =>$jumlah)
						{
							$koneksi->query("insert into pembelian_produk(id_pembelian,id_produk,jumlah)
								values('$id_pembelian_barusan','$id_produk','$jumlah')");
						}

						//kosongin belanja


						//tampilan ke nota
						echo "<script>alert('pembelian sukses');</script>";
						echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

					}
				?>
			</div>
		</section>

<pre><?php print_r($_SESSION['pelanggan']) ?></pre>
<pre><?php print_r($_SESSION['keranjang']) ?></pre>
</pre>
</body>
</html>