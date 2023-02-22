
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_PENJUALAN_HARGA</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Id Barang</td>
				<td><?php echo $id_barang; ?></td>
			</tr>
	
			<tr>
				<td>Qty</td>
				<td><?php echo $qty; ?></td>
			</tr>
	
			<tr>
				<td>Harga Jual Satuan</td>
				<td><?php echo $harga_jual_satuan; ?></td>
			</tr>
	
			<tr>
				<td>Total Harga Jual</td>
				<td><?php echo $total_harga_jual; ?></td>
			</tr>
	
			<tr>
				<td>Tanggal Transaksi</td>
				<td><?php echo $tanggal_transaksi; ?></td>
			</tr>
	
			<tr>
				<td>Photo Bukti</td>
				<td><?php echo $photo_bukti; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('penjualanharga') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>