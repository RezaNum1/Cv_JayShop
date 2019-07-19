<?php

session_start();
$koneksi = new mysqli("localhost","root","","jayshop2");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
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


	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel -default">
					<div class="panel -heading">
						<h3 class="panel-title">Login Pelanggan</h3>
				</div>
				<div class="panel -body">
					<form method="post">
						<div class="form-group">
							<label>Email</label> 
							<input type="email" class="form-control" name="email"></input>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password"></input>
						</div>
						<button class="btn btn-primary" name="simpan" >Simpan</button>
					</form>
				</div>
		</div>
<?php
//jika ada tombol simpan (simpan pas d klik)
if(isset($_POST["simpan"]))
{
	$email= $_POST["email"];
	$password = $_POST["password"];
	//cek akun
	$ambil = $koneksi->query("Select * from pelanggan where email_pelanggan='$email' and password_pelanggan='$password'");

	$cocok = $ambil->num_rows;

	if($cocok==1)
	{
		//anda sudah login
		$akun = $ambil->fetch_assoc();
		$_SESSION["pelanggan"] = $akun;
		echo "<script>alert('suskses login');</script>";
		echo "<script>location='checkout.php';</script>";


	}
	else
	{
		echo "<script>alert('anda gagal login,periksa akun anda');</script>";
		echo "<script>location='login.php';</script>";

	}
}

?>
	
</body>
</html>