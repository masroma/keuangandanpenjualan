<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bukubesar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Bukubesar_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
      
        // $cek = $this->session->userdata('logged_in');
       
            $cari = $this->input->post('no_rek');
            if(empty($cari)){
                $where = " WHERE no_rek='xxx' ";
                $data['judul']="Buku Besar";
                $data['no_rek'] = '';
            }else{
                $where = " WHERE (no_rek='$cari' OR no_rek LIKE '$cari.%')";
                $nama_rek = $this->Bukubesar_model->CariNamaRek($cari);
                $data['judul']="Buku Besar No.Rek ".$cari." - ".$nama_rek;
                $data['no_rek'] = $cari;
            }

            $text = "SELECT * FROM tbl_jurnal_umum $where
					ORDER BY no_jurnal ASC";
			$data['data'] = $this->Bukubesar_model->manualQuery($text);
            $data['list_rek'] =  $this->Bukubesar_model->listRek();
        // var_dump($data);exit;
            $this->template->load('template','bukubesar/bukubesar_list',$data);
        
        
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Bukubesar_model->json();
    }

    public function read($id) 
    {
        $row = $this->Bukubesar_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
	    );
            $this->template->load('template','bukubesar/bukubesar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bukubesar'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bukubesar/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	);
        $this->template->load('template','bukubesar/bukubesar_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Bukubesar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('bukubesar'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Bukubesar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bukubesar/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
	    );
            $this->template->load('template','bukubesar/bukubesar_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bukubesar'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Bukubesar_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bukubesar'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bukubesar_model->get_by_id($id);

        if ($row) {
            $this->Bukubesar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bukubesar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bukubesar'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "bukubesar.xls";
        $judul = "bukubesar";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");

	foreach ($this->Bukubesar_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Bukubesar.php */
/* Location: ./application/controllers/Bukubesar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-22 17:44:31 */
/* http://harviacode.com */