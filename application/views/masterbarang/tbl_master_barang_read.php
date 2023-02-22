
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_MASTER_BARANG</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Kode Barang</td>
				<td><?php echo $kode_barang; ?></td>
			</tr>
	
			<tr>
				<td>Nama Barang</td>
				<td><?php echo $nama_barang; ?></td>
			</tr>
	
			<tr>
				<td>Keterangan</td>
				<td><?php echo $keterangan; ?></td>
			</tr>
	
			<tr>
				<td>Harga Modal</td>
				<td><?php echo $harga_modal; ?></td>
			</tr>
	
			<tr>
				<td>Harga Jual</td>
				<td><?php echo $harga_jual; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('masterbarang') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>