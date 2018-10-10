<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persetujuan_model extends CI_Model {

	var $table = 'program.ta_approval';
	var $column_order = array('reqnik', 'approval1','approval2','approval3', 'approval4', 'requeststatus'); //set column field database for datatable orderable
	var $column_search = array('reqnik', 'approval1','approval2','approval3', 'approval4', 'requeststatus'); //set column field database for datatable searchable 
	var $order = array('reqnik' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		//add custom filter here
		if($this->input->post('reqnik'))
		{
			$this->db->like('reqnik', $this->input->post('reqnik'));
		}
		if($this->input->post('approval1'))
		{
			$this->db->like('approval1', $this->input->post('approval1'));
		}
		if($this->input->post('approval2'))
		{
			$this->db->like('approval2', $this->input->post('approval2'));
		}
		if($this->input->post('approval3'))
		{
			$this->db->like('approval3', $this->input->post('approval3'));
		}
		if($this->input->post('approval4'))
		{
			$this->db->like('approval4', $this->input->post('approval4'));
		}
		if($this->input->post('requeststatus'))
		{
			$this->db->like('requeststatus::text', $this->input->post('requeststatus'));
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
}
