<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurnalumum extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('JurnalumumModel');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','jurnalumum/tbl_jurnal_umum_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->JurnalumumModel->json();
    }

    public function read($id) 
    {
        $row = $this->JurnalumumModel->get_by_id($id);
        if ($row) {
            $data = array(
		'no_jurnal' => $row->no_jurnal,
		'tgl_jurnal' => $row->tgl_jurnal,
		'ket' => $row->ket,
		'no_bukti' => $row->no_bukti,
		'no_rek' => $row->no_rek,
		'debet' => $row->debet,
		'kredit' => $row->kredit,
		'username' => $row->username,
		'tgl_insert' => $row->tgl_insert,
	    );
            $this->template->load('template','jurnalumum/tbl_jurnal_umum_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurnalumum'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jurnalumum/create_action'),
	    'no_jurnal' => set_value('no_jurnal'),
	    'tgl_jurnal' => set_value('tgl_jurnal'),
	    'ket' => set_value('ket'),
	    'no_bukti' => set_value('no_bukti'),
	    'no_rek' => set_value('no_rek'),
	    'debet' => set_value('debet'),
	    'kredit' => set_value('kredit'),
	    'username' => set_value('username'),
	    'tgl_insert' => set_value('tgl_insert'),
	);
        $this->template->load('template','jurnalumum/tbl_jurnal_umum_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tgl_jurnal' => $this->input->post('tgl_jurnal',TRUE),
		'ket' => $this->input->post('ket',TRUE),
		'no_bukti' => $this->input->post('no_bukti',TRUE),
		'debet' => $this->input->post('debet',TRUE),
		'kredit' => $this->input->post('kredit',TRUE),
		'username' => $this->input->post('username',TRUE),
		'tgl_insert' => $this->input->post('tgl_insert',TRUE),
	    );

            $this->JurnalumumModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('jurnalumum'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->JurnalumumModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jurnalumum/update_action'),
		'no_jurnal' => set_value('no_jurnal', $row->no_jurnal),
		'tgl_jurnal' => set_value('tgl_jurnal', $row->tgl_jurnal),
		'ket' => set_value('ket', $row->ket),
		'no_bukti' => set_value('no_bukti', $row->no_bukti),
		'no_rek' => set_value('no_rek', $row->no_rek),
		'debet' => set_value('debet', $row->debet),
		'kredit' => set_value('kredit', $row->kredit),
		'username' => set_value('username', $row->username),
		'tgl_insert' => set_value('tgl_insert', $row->tgl_insert),
	    );
            $this->template->load('template','jurnalumum/tbl_jurnal_umum_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurnalumum'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_jurnal', TRUE));
        } else {
            $data = array(
		'tgl_jurnal' => $this->input->post('tgl_jurnal',TRUE),
		'ket' => $this->input->post('ket',TRUE),
		'no_bukti' => $this->input->post('no_bukti',TRUE),
		'debet' => $this->input->post('debet',TRUE),
		'kredit' => $this->input->post('kredit',TRUE),
		'username' => $this->input->post('username',TRUE),
		'tgl_insert' => $this->input->post('tgl_insert',TRUE),
	    );

            $this->JurnalumumModel->update($this->input->post('no_jurnal', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jurnalumum'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->JurnalumumModel->get_by_id($id);

        if ($row) {
            $this->JurnalumumModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jurnalumum'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurnalumum'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tgl_jurnal', 'tgl jurnal', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');
	$this->form_validation->set_rules('no_bukti', 'no bukti', 'trim|required');
	$this->form_validation->set_rules('debet', 'debet', 'trim|required');
	$this->form_validation->set_rules('kredit', 'kredit', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('tgl_insert', 'tgl insert', 'trim|required');

	$this->form_validation->set_rules('no_jurnal', 'no_jurnal', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_jurnal_umum.xls";
        $judul = "tbl_jurnal_umum";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Jurnal");
	xlsWriteLabel($tablehead, $kolomhead++, "Ket");
	xlsWriteLabel($tablehead, $kolomhead++, "No Bukti");
	xlsWriteLabel($tablehead, $kolomhead++, "Debet");
	xlsWriteLabel($tablehead, $kolomhead++, "Kredit");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Insert");

	foreach ($this->JurnalumumModel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_jurnal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_bukti);
	    xlsWriteNumber($tablebody, $kolombody++, $data->debet);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kredit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_insert);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Jurnalumum.php */
/* Location: ./application/controllers/Jurnalumum.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-22 16:02:32 */
/* http://harviacode.com */