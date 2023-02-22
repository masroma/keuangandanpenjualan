
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_REKENING</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Induk</td>
				<td><?php echo $induk; ?></td>
			</tr>
	
			<tr>
				<td>Level</td>
				<td><?php echo $level; ?></td>
			</tr>
	
			<tr>
				<td>Nama Rek</td>
				<td><?php echo $nama_rek; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('rekeningcontroller') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>