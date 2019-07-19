<?php 
session_start();

//mendapatkan id produk dari findek
$id_produk = $_GET['id'];
//jika sudah ada barang dikerangjang maka ditambah 1
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
else
{	
	$_SESSION['keranjang'][$id_produk] = 1;
}

echo"<script>alert('produk telah dimasukan kedalam keranjang');</script>";
echo"<script>location='keranjang.php';</script>"
?>