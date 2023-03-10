<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembelianbarangmodel extends CI_Model
{

    public $table = 'tbl_pembelian_barang';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,photo,id_barang,qty,harga_pembelian_satuan,total_pembelian,nama_suplayer,photo_bukti_pembelian,tanggal_pembelian');
        $this->datatables->from('tbl_pembelian_barang');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_pembelian_barang.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('pembelianbarang/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('pembelianbarang/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('pembelianbarang/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('photo', $q);
	$this->db->or_like('id_barang', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('harga_pembelian_satuan', $q);
	$this->db->or_like('total_pembelian', $q);
	$this->db->or_like('nama_suplayer', $q);
	$this->db->or_like('photo_bukti_pembelian', $q);
	$this->db->or_like('tanggal_pembelian', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('photo', $q);
	$this->db->or_like('id_barang', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('harga_pembelian_satuan', $q);
	$this->db->or_like('total_pembelian', $q);
	$this->db->or_like('nama_suplayer', $q);
	$this->db->or_like('photo_bukti_pembelian', $q);
	$this->db->or_like('tanggal_pembelian', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pembelianbarangmodel.php */
/* Location: ./application/models/Pembelianbarangmodel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-02-21 09:02:46 */
/* http://harviacode.com */