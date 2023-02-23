<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA REKENING</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Rek Induk <?php echo form_error('induk') ?></td>
						<!-- <td><input type="text" class="form-control" name="induk" id="induk" placeholder="Induk" value="<?php //echo $induk; ?>" /></td> -->

						<td>
						<select name="induk" id="induk" class="form-control select2">
						<option value="0">-PILIH-</option>

						
							<?php
							foreach($list_rek as $t){
							?>
							<option value="<?php echo $t['no_rek'];?> "><?php echo $t['nama_rek']?></option>
							<?php } ?>

							
						

						
						</select>
						</td>

						
					</tr>
	
					<tr>
						<td width='200'>No Rek <?php echo form_error('no_rek') ?></td><td><input type="text" class="form-control" name="no_rek" id="no_rek" placeholder="No Rek" value="<?php echo $no_rek; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Nama Rek <?php echo form_error('nama_rek') ?></td><td><input type="text" class="form-control" name="nama_rek" id="nama_rek" placeholder="Nama Rek" value="<?php echo $nama_rek; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="level" value="<?php echo $level; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('rekening') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>