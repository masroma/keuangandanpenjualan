<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Masterbarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Masterbarangmodel');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','masterbarang/tbl_master_barang_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Masterbarangmodel->json();
    }

    public function read($id) 
    {
        $row = $this->Masterbarangmodel->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode_barang' => $row->kode_barang,
		'nama_barang' => $row->nama_barang,
		'keterangan' => $row->keterangan,
		'harga_modal' => $row->harga_modal,
		'harga_jual' => $row->harga_jual,
	    );
            $this->template->load('template','masterbarang/tbl_master_barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('masterbarang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('masterbarang/create_action'),
	    'id' => set_value('id'),
	    'kode_barang' => set_value('kode_barang'),
	    'nama_barang' => set_value('nama_barang'),
	    'keterangan' => set_value('keterangan'),
	    'harga_modal' => set_value('harga_modal'),
	    'harga_jual' => set_value('harga_jual'),
	);
        $this->template->load('template','masterbarang/tbl_master_barang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'harga_modal' => $this->input->post('harga_modal',TRUE),
		'harga_jual' => $this->input->post('harga_jual',TRUE),
	    );

            $this->Masterbarangmodel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('masterbarang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Masterbarangmodel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('masterbarang/update_action'),
		'id' => set_value('id', $row->id),
		'kode_barang' => set_value('kode_barang', $row->kode_barang),
		'nama_barang' => set_value('nama_barang', $row->nama_barang),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'harga_modal' => set_value('harga_modal', $row->harga_modal),
		'harga_jual' => set_value('harga_jual', $row->harga_jual),
	    );
            $this->template->load('template','masterbarang/tbl_master_barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('masterbarang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'kode_barang' => $this->input->post('kode_barang',TRUE),
		'nama_barang' => $this->input->post('nama_barang',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'harga_modal' => $this->input->post('harga_modal',TRUE),
		'harga_jual' => $this->input->post('harga_jual',TRUE),
	    );

            $this->Masterbarangmodel->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('masterbarang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Masterbarangmodel->get_by_id($id);

        if ($row) {
            $this->Masterbarangmodel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('masterbarang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('masterbarang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
	$this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('harga_modal', 'harga modal', 'trim|required|numeric');
	$this->form_validation->set_rules('harga_jual', 'harga jual', 'trim|required|numeric');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_master_barang.xls";
        $judul = "tbl_master_barang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Modal");
	xlsWriteLabel($tablehead, $kolomhead++, "Harga Jual");

	foreach ($this->Masterbarangmodel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_modal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->harga_jual);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Masterbarang.php */
/* Location: ./application/controllers/Masterbarang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-21 09:07:04 */
/* http://harviacode.com */