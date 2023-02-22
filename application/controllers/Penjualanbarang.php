<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penjualanbarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Penjualanbarangmodel');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','penjualanbarang/tbl_penjualan_barang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Penjualanbarangmodel->json();
    }

    public function read($id) 
    {
        $row = $this->Penjualanbarangmodel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_barang' => $row->id_barang,
		'qty' => $row->qty,
		'harga_jual_satuan' => $row->harga_jual_satuan,
		'total_harga_jual' => $row->total_harga_jual,
		'tanggal_transaksi' => $row->tanggal_transaksi,
		'photo_bukti' => $row->photo_bukti,
	    );
            $this->template->load('template','penjualanbarang/tbl_penjualan_barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualanbarang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('penjualanbarang/create_action'),
	    'id' => set_value('id'),
	    'id_barang' => set_value('id_barang'),
	    'qty' => set_value('qty'),
	    'harga_jual_satuan' => set_value('harga_jual_satuan'),
	    'total_harga_jual' => set_value('total_harga_jual'),
	    'tanggal_transaksi' => set_value('tanggal_transaksi'),
	    'photo_bukti' => set_value('photo_bukti'),
	);
        $this->template->load('template','penjualanbarang/tbl_penjualan_barang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_barang' => $this->input->post('id_barang',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'harga_jual_satuan' => $this->input->post('harga_jual_satuan',TRUE),
		'total_harga_jual' => $this->input->post('total_harga_jual',TRUE),
		'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
		'photo_bukti' => $this->input->post('photo_bukti',TRUE),
	    );

            $this->Penjualanbarangmodel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('penjualanbarang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Penjualanbarangmodel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penjualanbarang/update_action'),
		'id' => set_value('id', $row->id),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'qty' => set_value('qty', $row->qty),
		'harga_jual_satuan' => set_value('harga_jual_satuan', $row->harga_jual_satuan),
		'total_harga_jual' => set_value('total_harga_jual', $row->total_harga_jual),
		'tanggal_transaksi' => set_value('tanggal_transaksi', $row->tanggal_transaksi),
		'photo_bukti' => set_value('photo_bukti', $row->photo_bukti),
	    );
            $this->template->load('template','penjualanbarang/tbl_penjualan_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualanbarang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_barang' => $this->input->post('id_barang',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'harga_jual_satuan' => $this->input->post('harga_jual_satuan',TRUE),
		'total_harga_jual' => $this->input->post('total_harga_jual',TRUE),
		'tanggal_transaksi' => $this->input->post('tanggal_transaksi',TRUE),
		'photo_bukti' => $this->input->post('photo_bukti',TRUE),
	    );

            $this->Penjualanbarangmodel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penjualanbarang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Penjualanbarangmodel->get_by_id($id);

        if ($row) {
            $this->Penjualanbarangmodel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penjualanbarang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penjualanbarang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_barang', 'id barang', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('harga_jual_satuan', 'harga jual satuan', 'trim|required|numeric');
	$this->form_validation->set_rules('total_harga_jual', 'total harga jual', 'trim|required|numeric');
	$this->form_validation->set_rules('tanggal_transaksi', 'tanggal transaksi', 'trim|required');
	$this->form_validation->set_rules('photo_bukti', 'photo bukti', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_penjualan_barang.xls";
        $judul = "tbl_penjualan_barang";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Jual Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Total Harga Jual");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Transaksi");
	xlsWriteLabel($tablehead, $kolomhead++, "Photo Bukti");

	foreach ($this->Penjualanbarangmodel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->qty);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_jual_satuan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_harga_jual);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_transaksi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->photo_bukti);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Penjualanbarang.php */
/* Location: ./application/controllers/Penjualanbarang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-21 21:58:37 */
/* http://harviacode.com */