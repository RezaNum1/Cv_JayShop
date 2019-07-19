<h2>data pelanggan</h2>

<table class ="table table-bordered">
	<thead>
		<tr>
			<th>NO</th>
			<th>nama</th>
			<th>email</th>
			<th>telepon</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("select * from pelanggan");?>
		<?php while ($pecah = $ambil->fetch_assoc()) { ?>	 
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_pelanggan'] ?></td>
			<td><?php echo $pecah['email_pelanggan'] ?></td>
			<td><?php echo $pecah['telepon_pelanggan'] ?></td>
			<td>
				<a href="" class ="btn-danger btn">Hapus</a>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>	
	</tbody>
</table>