<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA TBL_REKENING</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Induk <?php echo form_error('induk') ?></td><td><input type="text" class="form-control" name="induk" id="induk" placeholder="Induk" value="<?php echo $induk; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Level <?php echo form_error('level') ?></td><td><input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Nama Rek <?php echo form_error('nama_rek') ?></td><td><input type="text" class="form-control" name="nama_rek" id="nama_rek" placeholder="Nama Rek" value="<?php echo $nama_rek; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="no_rek" value="<?php echo $no_rek; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('rekening') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>