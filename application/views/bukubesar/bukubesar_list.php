<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA BUKUBESAR</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'>
        <?php //echo anchor(site_url('bukubesar/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php //echo anchor(site_url('bukubesar/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div>
            <form method="post" name="form" action="<?php echo base_url();?>index.php/bukubesar">
                <div class="form-group">
                    <label for="sel1">Pilih Rekening:</label>
                    
                    <select class="form-control select2" id="sele" name="no_rek">
                    <?php 
                    if(empty($no_rek)){
                    ?>
                    <option value="">-PILIH-</option>
                    <?php
                    }
                    foreach($list_rek as $t){
                        if($no_rek==$t['no_rek']){	
                    ?>
                        <option value="<?php echo $t['no_rek'];?>" selected="selected" ><?php echo $t['no_rek'];?> | <?php echo $t['nama_rek'];?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $t['no_rek'];?>" ><?php echo $t['no_rek'];?> | <?php echo $t['nama_rek'];?></option>
                    <?php }
                    }?>
                
                
                    
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Cari</button>
            </form>
            <br>
            <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Tgl Jurnal</th>
            <th>No Bukti</th>
		    <th>Ket</th>
		    
		    <th>No Rek</th>
		    <th>Nama Rek</th>
		    <th>Debet</th>
		    <th>Kredit</th>
		    <th>Saldo</th>
                </tr>
            </thead>
            <?php
	//if($data->num_rows()>0){
		$periode = date('Y')-1;
		$saldo = 0;
		$dr_sa = $this->Bukubesar_model->dr_sa($no_rek,$periode);
		$kr_sa = $this->Bukubesar_model->kr_sa($no_rek,$periode);
		$saldo = $saldo+$dr_sa-$kr_sa;
		?>
        <tr>
            <td colspan="6" align="center"><b>Saldo Awal Tahun <?php echo $periode;?></b></td>            
            <td align="right" width="100" ><?php echo number_format($dr_sa); ?></td>
            <td align="right" width="100" ><?php echo number_format($kr_sa); ?></td>
            <td align="right" width="100" ><?php echo number_format($saldo); ?></td>
    	</tr>
        <?php
		$jml_dr=0;
		$jml_kr=0;
		$no =1;
		foreach($data->result_array() as $db){  
		$tgl = $this->Bukubesar_model->tgl_indo($db['tgl_jurnal']);
		$nama_rek = $this->Bukubesar_model->CariNamaRek($db['no_rek']);
		$saldo = $saldo+$db['debet']-$db['kredit'];
		?>    
    	<tr>
            <td align="center" width="100" ><?php echo $db['no_jurnal']; ?></td>
            <td align="center" width="100"><?php echo $tgl; ?></td>
            <td align="center" width="80" ><?php echo $db['no_bukti']; ?></td>
            <td ><?php echo $db['ket']; ?></td>
            <td align="center" width="80" ><?php echo $db['no_rek']; ?></td>
            <td width="150"><?php echo $nama_rek; ?></td>            
            <td align="right" width="80" ><?php echo number_format($db['debet']); ?></td>
            <td align="right" width="80" ><?php echo number_format($db['kredit']); ?></td>
            <td align="right" width="80" ><?php echo number_format($saldo); ?></td>
    </tr>
    <?php
		$jml_dr = $jml_dr+$db['debet'];
		$jml_kr = $jml_kr+$db['kredit'];
		$no++;
		}
?>
	    
        </table>

            


        </div>

        
                    </div>
            </div>
            </div>
    </section>
</div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "bukubesar/json", "type": "POST"},
                    columns: [
                        {
                            "data": "",
                            "orderable": false
                        },{"data": "id"},{"data": "nama"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>