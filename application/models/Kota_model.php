<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kota_model extends CI_Model {

	var $table = 'ta_kota';
	var $column_order = array('idkota', 'namakota','namanegara','kodelokasi'); //set column field database for datatable orderable
	var $column_search = array('idkota', 'namakota','namanegara','kodelokasi'); //set column field database for datatable searchable 
	var $order = array('idkota' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select('a.idkota, a.namakota, a.namanegara, a.kodelokasi, b.idlokasi, b.namalokasi');
		
		//add custom filter here
		if($this->input->post('idkota'))
		{
			$this->db->like('idkota', $this->input->post('idkota'));
		}
		if($this->input->post('namakota'))
		{
			$this->db->like('namakota', $this->input->post('namakota'));
		}
		if($this->input->post('namanegara'))
		{
			$this->db->like('namanegara', $this->input->post('namanegara'));
		}
		if($this->input->post('kode'))
		{
			$this->db->like('namalokasi', $this->input->post('kode'));
		}

		$this->db->from('ta_kota a, ta_kodelokasi b');
		$where = "(a.kodelokasi = b.idlokasi)";
		$this->db->where($where);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item."::text", $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item."::text", $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
/*
	public function get_list_countries()
	{
		$this->db->select('nik');
		$this->db->from($this->table);
		$this->db->order_by('nik','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[] = $row->nik;
		}
		return $countries;
	}
*/
}
