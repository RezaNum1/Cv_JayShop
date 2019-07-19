<?php
$ambil = $koneksi->query("Select * from produk Where id_produk='$_GET[id]'");
$pecah =$ambil->fetch_assoc();
$fotoproduk = $pecah['fotoproduk'];
if (file_exists("../foto_produk/$fotoproduk"))
{
	unlink("../foto_produk/$fotoproduk");
}
$koneksi->query("delete from produk where id_produk='$_GET[id]'");

echo "<script> alert('produk terhapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";
?>