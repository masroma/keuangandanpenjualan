
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_PEMBELIAN_BARANG</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Photo</td>
				<td><?php echo $photo; ?></td>
			</tr>
	
			<tr>
				<td>Id Barang</td>
				<td><?php echo $id_barang; ?></td>
			</tr>
	
			<tr>
				<td>Qty</td>
				<td><?php echo $qty; ?></td>
			</tr>
	
			<tr>
				<td>Harga Pembelian Satuan</td>
				<td><?php echo $harga_pembelian_satuan; ?></td>
			</tr>
	
			<tr>
				<td>Total Pembelian</td>
				<td><?php echo $total_pembelian; ?></td>
			</tr>
	
			<tr>
				<td>Nama Suplayer</td>
				<td><?php echo $nama_suplayer; ?></td>
			</tr>
	
			<tr>
				<td>Photo Bukti Pembelian</td>
				<td><?php echo $photo_bukti_pembelian; ?></td>
			</tr>
	
			<tr>
				<td>Tanggal Pembelian</td>
				<td><?php echo $tanggal_pembelian; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('pembelianbarang') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>