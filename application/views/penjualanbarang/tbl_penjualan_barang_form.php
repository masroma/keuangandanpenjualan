<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA TBL_PENJUALAN_BARANG</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Id Barang <?php echo form_error('id_barang') ?></td><td><input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="Id Barang" value="<?php echo $id_barang; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Qty <?php echo form_error('qty') ?></td><td><input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Harga Jual Satuan <?php echo form_error('harga_jual_satuan') ?></td><td><input type="text" class="form-control" name="harga_jual_satuan" id="harga_jual_satuan" placeholder="Harga Jual Satuan" value="<?php echo $harga_jual_satuan; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Total Harga Jual <?php echo form_error('total_harga_jual') ?></td><td><input type="text" class="form-control" name="total_harga_jual" id="total_harga_jual" placeholder="Total Harga Jual" value="<?php echo $total_harga_jual; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Tanggal Transaksi <?php echo form_error('tanggal_transaksi') ?></td>
						<td><input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal Transaksi" value="<?php echo $tanggal_transaksi; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Photo Bukti <?php echo form_error('photo_bukti') ?></td><td><input type="text" class="form-control" name="photo_bukti" id="photo_bukti" placeholder="Photo Bukti" value="<?php echo $photo_bukti; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('penjualanbarang') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>