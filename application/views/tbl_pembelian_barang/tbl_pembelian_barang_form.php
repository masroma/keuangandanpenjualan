<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA TBL_PEMBELIAN_BARANG</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Photo <?php echo form_error('photo') ?></td><td><input type="text" class="form-control" name="photo" id="photo" placeholder="Photo" value="<?php echo $photo; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Id Barang <?php echo form_error('id_barang') ?></td><td><input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="Id Barang" value="<?php echo $id_barang; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Qty <?php echo form_error('qty') ?></td><td><input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Harga Pembelian Satuan <?php echo form_error('harga_pembelian_satuan') ?></td><td><input type="text" class="form-control" name="harga_pembelian_satuan" id="harga_pembelian_satuan" placeholder="Harga Pembelian Satuan" value="<?php echo $harga_pembelian_satuan; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Total Pembelian <?php echo form_error('total_pembelian') ?></td><td><input type="text" class="form-control" name="total_pembelian" id="total_pembelian" placeholder="Total Pembelian" value="<?php echo $total_pembelian; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Nama Suplayer <?php echo form_error('nama_suplayer') ?></td><td><input type="text" class="form-control" name="nama_suplayer" id="nama_suplayer" placeholder="Nama Suplayer" value="<?php echo $nama_suplayer; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Photo Bukti Pembelian <?php echo form_error('photo_bukti_pembelian') ?></td><td><input type="text" class="form-control" name="photo_bukti_pembelian" id="photo_bukti_pembelian" placeholder="Photo Bukti Pembelian" value="<?php echo $photo_bukti_pembelian; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Tanggal Pembelian <?php echo form_error('tanggal_pembelian') ?></td>
						<td><input type="date" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian" placeholder="Tanggal Pembelian" value="<?php echo $tanggal_pembelian; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_pembelian_barang') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>