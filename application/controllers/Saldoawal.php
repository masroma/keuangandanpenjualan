<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Saldoawal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('SaldoAwalModel');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','saldoawal/tbl_saldo_awal_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->SaldoAwalModel->json();
    }

    public function read($id) 
    {
        $row = $this->SaldoAwalModel->get_by_id($id);
        if ($row) {
            $data = array(
		'periode' => $row->periode,
		'no_rek' => $row->no_rek,
		'debet' => $row->debet,
		'kredit' => $row->kredit,
		'tgl_insert' => $row->tgl_insert,
		'username' => $row->username,
	    );
            $this->template->load('template','saldoawal/tbl_saldo_awal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldoawal'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('saldoawal/create_action'),
	    'periode' => set_value('periode'),
	    'no_rek' => set_value('no_rek'),
	    'debet' => set_value('debet'),
	    'kredit' => set_value('kredit'),
	    'tgl_insert' => set_value('tgl_insert'),
	    'username' => set_value('username'),
	);
        $this->template->load('template','saldoawal/tbl_saldo_awal_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'debet' => $this->input->post('debet',TRUE),
		'kredit' => $this->input->post('kredit',TRUE),
		'tgl_insert' => $this->input->post('tgl_insert',TRUE),
		'username' => $this->input->post('username',TRUE),
	    );

            $this->SaldoAwalModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('saldoawal'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->SaldoAwalModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('saldoawal/update_action'),
		'periode' => set_value('periode', $row->periode),
		'no_rek' => set_value('no_rek', $row->no_rek),
		'debet' => set_value('debet', $row->debet),
		'kredit' => set_value('kredit', $row->kredit),
		'tgl_insert' => set_value('tgl_insert', $row->tgl_insert),
		'username' => set_value('username', $row->username),
	    );
            $this->template->load('template','saldoawal/tbl_saldo_awal_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldoawal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('periode', TRUE));
        } else {
            $data = array(
		'debet' => $this->input->post('debet',TRUE),
		'kredit' => $this->input->post('kredit',TRUE),
		'tgl_insert' => $this->input->post('tgl_insert',TRUE),
		'username' => $this->input->post('username',TRUE),
	    );

            $this->SaldoAwalModel->update($this->input->post('periode', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('saldoawal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->SaldoAwalModel->get_by_id($id);

        if ($row) {
            $this->SaldoAwalModel->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('saldoawal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldoawal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('debet', 'debet', 'trim|required');
	$this->form_validation->set_rules('kredit', 'kredit', 'trim|required');
	$this->form_validation->set_rules('tgl_insert', 'tgl insert', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');

	$this->form_validation->set_rules('periode', 'periode', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_saldo_awal.xls";
        $judul = "tbl_saldo_awal";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Debet");
	xlsWriteLabel($tablehead, $kolomhead++, "Kredit");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Insert");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");

	foreach ($this->SaldoAwalModel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->debet);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kredit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_insert);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Saldoawal.php */
/* Location: ./application/controllers/Saldoawal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-22 16:01:38 */
/* http://harviacode.com */