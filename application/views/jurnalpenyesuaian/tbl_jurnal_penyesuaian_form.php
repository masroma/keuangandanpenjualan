

<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA JURNAL PENYESUAIAN</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
				<tr>
						<td width='200'>Nomor Jurnal <?php echo form_error('no_jurnal') ?></td>
						<td><input type="text" class="form-control" name="no_jurnal" id="no_jurnal" placeholder="Nomor Jurnal" value="<?php echo $no_jurnal;?>" readonly/></td>
					</tr>

					<tr>
						<td width='200'>Nomor Rekening <?php echo form_error('no_jurnal') ?></td>
						<td><select name="no_rek" id="no_rek" class="form-control select2">
						

						<option value="">-PILIH-</option>
    <?php
	foreach($list_rek as $t){
	?>
    <option value="<?php echo $t['no_rek'];?>"><?php echo $t['no_rek'];?> | <?php echo $t['nama_rek'];?></option>
    <?php } ?>
    </select>
						

						
						</select></td>
					</tr>

					<!-- <tr>
						<td width='200'>Nama Rekening <?php //echo form_error('nama_rek') ?></td><td><input type="text" class="form-control" name="nama_rek" id="nama_rek" placeholder="Debet" value="<?php //echo $nama_rek; ?>" readonly/></td>
					</tr> -->
	
					<tr>
						<td width='200'>Tgl Jurnal <?php echo form_error('tgl_jurnal') ?></td>
						<td><input type="date" class="form-control" name="tgl_jurnal" id="tgl_jurnal" placeholder="Tgl Jurnal" value="<?php echo date("d-m-Y"); ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Debet <?php echo form_error('debet') ?></td><td><input type="text" class="form-control" name="debet" id="debet" placeholder="Debet" value="<?php echo $debet; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Kredit <?php echo form_error('kredit') ?></td><td><input type="text" class="form-control" name="kredit" id="kredit" placeholder="Kredit" value="<?php echo $kredit; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Username <?php echo form_error('username') ?></td><td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Tgl Insert <?php echo form_error('tgl_insert') ?></td><td><input type="text" class="form-control" name="tgl_insert" id="tgl_insert" placeholder="Tgl Insert" value="<?php echo $tgl_insert; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="no_jurnal" value="<?php echo $no_jurnal; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('jurnalpenyesuaian') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>

