<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembelianbarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Pembelianbarangmodel');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','pembelianbarang/tbl_pembelian_barang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Pembelianbarangmodel->json();
    }

    public function read($id) 
    {
        $row = $this->Pembelianbarangmodel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'photo' => $row->photo,
		'id_barang' => $row->id_barang,
		'qty' => $row->qty,
		'harga_pembelian_satuan' => $row->harga_pembelian_satuan,
		'total_pembelian' => $row->total_pembelian,
		'nama_suplayer' => $row->nama_suplayer,
		'photo_bukti_pembelian' => $row->photo_bukti_pembelian,
		'tanggal_pembelian' => $row->tanggal_pembelian,
	    );
            $this->template->load('template','pembelianbarang/tbl_pembelian_barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembelianbarang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pembelianbarang/create_action'),
	    'id' => set_value('id'),
	    'photo' => set_value('photo'),
	    'id_barang' => set_value('id_barang'),
	    'qty' => set_value('qty'),
	    'harga_pembelian_satuan' => set_value('harga_pembelian_satuan'),
	    'total_pembelian' => set_value('total_pembelian'),
	    'nama_suplayer' => set_value('nama_suplayer'),
	    'photo_bukti_pembelian' => set_value('photo_bukti_pembelian'),
	    'tanggal_pembelian' => set_value('tanggal_pembelian'),
	);
        $this->template->load('template','pembelianbarang/tbl_pembelian_barang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'photo' => $this->input->post('photo',TRUE),
		'id_barang' => $this->input->post('id_barang',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'harga_pembelian_satuan' => $this->input->post('harga_pembelian_satuan',TRUE),
		'total_pembelian' => $this->input->post('total_pembelian',TRUE),
		'nama_suplayer' => $this->input->post('nama_suplayer',TRUE),
		'photo_bukti_pembelian' => $this->input->post('photo_bukti_pembelian',TRUE),
		'tanggal_pembelian' => $this->input->post('tanggal_pembelian',TRUE),
	    );

            $this->Pembelianbarangmodel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pembelianbarang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pembelianbarangmodel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pembelianbarang/update_action'),
		'id' => set_value('id', $row->id),
		'photo' => set_value('photo', $row->photo),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'qty' => set_value('qty', $row->qty),
		'harga_pembelian_satuan' => set_value('harga_pembelian_satuan', $row->harga_pembelian_satuan),
		'total_pembelian' => set_value('total_pembelian', $row->total_pembelian),
		'nama_suplayer' => set_value('nama_suplayer', $row->nama_suplayer),
		'photo_bukti_pembelian' => set_value('photo_bukti_pembelian', $row->photo_bukti_pembelian),
		'tanggal_pembelian' => set_value('tanggal_pembelian', $row->tanggal_pembelian),
	    );
            $this->template->load('template','pembelianbarang/tbl_pembelian_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembelianbarang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'photo' => $this->input->post('photo',TRUE),
		'id_barang' => $this->input->post('id_barang',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'harga_pembelian_satuan' => $this->input->post('harga_pembelian_satuan',TRUE),
		'total_pembelian' => $this->input->post('total_pembelian',TRUE),
		'nama_suplayer' => $this->input->post('nama_suplayer',TRUE),
		'photo_bukti_pembelian' => $this->input->post('photo_bukti_pembelian',TRUE),
		'tanggal_pembelian' => $this->input->post('tanggal_pembelian',TRUE),
	    );

            $this->Pembelianbarangmodel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pembelianbarang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pembelianbarangmodel->get_by_id($id);

        if ($row) {
            $this->Pembelianbarangmodel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pembelianbarang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pembelianbarang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('photo', 'photo', 'trim|required');
	$this->form_validation->set_rules('id_barang', 'id barang', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('harga_pembelian_satuan', 'harga pembelian satuan', 'trim|required|numeric');
	$this->form_validation->set_rules('total_pembelian', 'total pembelian', 'trim|required|numeric');
	$this->form_validation->set_rules('nama_suplayer', 'nama suplayer', 'trim|required');
	$this->form_validation->set_rules('photo_bukti_pembelian', 'photo bukti pembelian', 'trim|required');
	$this->form_validation->set_rules('tanggal_pembelian', 'tanggal pembelian', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_pembelian_barang.xls";
        $judul = "tbl_pembelian_barang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Photo");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Qty");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Pembelian Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Total Pembelian");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Suplayer");
	xlsWriteLabel($tablehead, $kolomhead++, "Photo Bukti Pembelian");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Pembelian");

	foreach ($this->Pembelianbarangmodel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->photo);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->qty);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_pembelian_satuan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total_pembelian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_suplayer);
	    xlsWriteLabel($tablebody, $kolombody++, $data->photo_bukti_pembelian);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_pembelian);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Pembelianbarang.php */
/* Location: ./application/controllers/Pembelianbarang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-21 09:02:46 */
/* http://harviacode.com */