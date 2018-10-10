<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model {

	var $table = 'program.ta_user';
	var $column_order = array('nik', 'password','level','status'); //set column field database for datatable orderable
	var $column_search = array('nik', 'password','level','status'); //set column field database for datatable searchable 
	var $order = array('nik' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		//add custom filter here
		if($this->input->post('nik'))
		{
			$this->db->like('nik', $this->input->post('nik'));
		}
		if($this->input->post('password'))
		{
			$this->db->like('password', $this->input->post('password'));
		}
		if($this->input->post('level'))
		{
			$this->db->like('level::text', $this->input->post('level'));
		}
		if($this->input->post('status'))
		{
			$this->db->like('status::text', $this->input->post('status'));
		}

		$this->db->from($this->table);
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
