
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_JURNAL_PENYESUAIAN</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Tgl Jurnal</td>
				<td><?php echo $tgl_jurnal; ?></td>
			</tr>
	
			<tr>
				<td>Debet</td>
				<td><?php echo $debet; ?></td>
			</tr>
	
			<tr>
				<td>Kredit</td>
				<td><?php echo $kredit; ?></td>
			</tr>
	
			<tr>
				<td>Username</td>
				<td><?php echo $username; ?></td>
			</tr>
	
			<tr>
				<td>Tgl Insert</td>
				<td><?php echo $tgl_insert; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('jurnalpenyesuaian') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>