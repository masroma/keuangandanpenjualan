<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekening extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('RekeningModel');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['list_rek'] =  $this->RekeningModel->listRekNama();
        
        $this->template->load('template','rekening/tbl_rekening_list',$data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->RekeningModel->json();
    }

    public function read($id) 
    {
        $row = $this->RekeningModel->get_by_id($id);
        if ($row) {
            $data = array(
		'no_rek' => $row->no_rek,
		'induk' => $row->induk,
		'level' => $row->level,
		'nama_rek' => $row->nama_rek,
        
	    );
            $this->template->load('template','rekening/tbl_rekening_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekening'));
        }
    }

    public function create() 
    {
        $data = array(
        'button' => 'Create',
        'action' => site_url('rekening/create_action'),
	    'no_rek' => set_value('no_rek'),
	    'induk' => set_value('induk'),
	    'level' => set_value('level'),
	    'nama_rek' => set_value('nama_rek'),
        'list_rek' =>$this->RekeningModel->listRekNama()
	);
    // var_dump($data);exit;
        $this->template->load('template','rekening/tbl_rekening_form', $data);
    }
    
    public function create_action() 
    
    {    
        $this->_rules();
        $induk = $this->input->post('induk');
        $no_rek = $this->input->post('no_rek',TRUE);
        $out = explode(" ",$no_rek);
		$no_rek_slug = implode("-",$out);
          //var_dump($induk);exit;
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $induk = $this->input->post('induk');
             // var_dump($induk);exit;
            // echo $induk;exit;
				
            if($induk!=0){
                $level = $this->RekeningModel->CariLevel($induk);
                // var_dump($level);exit;
                $indukinput=$this->input->post('induk');
                $levelinput=$level+1;
            }else{
                $indukinput=0;
                $levelinput=0;
            }
            $data = array(

               
            'induk' => $indukinput,
            'level' => $levelinput,

            'no_rek'=> $no_rek_slug,
            'nama_rek' => $this->input->post('nama_rek',TRUE),
            );

            // var_dump($data);exit;

            $this->RekeningModel->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('rekening'));
        }
     }
    
    public function update($id) 
    {
        $row = $this->RekeningModel->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('rekening/update_action'),
		'no_rek' => set_value('no_rek', $row->no_rek),
		'induk' => set_value('induk', $row->induk),
		'level' => set_value('level', $row->level),
		'nama_rek' => set_value('nama_rek', $row->nama_rek),
        'list_rek' =>$this->RekeningModel->listRekNama()
	    );
            $this->template->load('template','rekening/tbl_rekening_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekening'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('no_rek', TRUE));
        } else {
            $data = array(
		'induk' => $this->input->post('induk',TRUE),
		'level' => $this->input->post('level',TRUE),
		'nama_rek' => $this->input->post('nama_rek',TRUE),
	    );

            $this->RekeningModel->update($this->input->post('no_rek', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('rekening'));
        }
    }
    
    public function delete($no_rek) 
    {
        $sql="DELETE FROM tbl_rekening WHERE no_rek='$no_rek'";
        $query = $this->db->query($sql);

        if ($query) {
            $this->RekeningModel->delete($no_rek);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('rekening'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('rekening'));
        }
    }

    public function _rules() 
    {
	// $this->form_validation->set_rules('induk', 'induk', 'trim|required');
	// $this->form_validation->set_rules('level', 'level', 'trim|required');
	$this->form_validation->set_rules('nama_rek', 'nama rek', 'trim|required');

	$this->form_validation->set_rules('no_rek', 'no_rek', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "rek_rekening.xls";
        $judul = "tbl_rekening";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Induk");
	xlsWriteLabel($tablehead, $kolomhead++, "Level");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Rek");

	foreach ($this->RekeningModel->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->induk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->level);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_rek);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Rekening.php */
/* Location: ./application/controllers/Rekening.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-22 16:00:32 */
/* http://harviacode.com */