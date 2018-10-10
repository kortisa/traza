<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destinasi_model extends CI_Model {

	var $table = 'program.ta_destination';
	var $column_order = array('name_destination', 'name', 'currency', 'constant' ); //set column field database for datatable orderable
	var $column_search = array('name_destination', 'name', 'currency', 'constant'); //set column field database for datatable searchable 
	var $order = array('name_destination' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select('a.*, b.*');
		//add custom filter here
		if($this->input->post('name_destination'))
		{
			$this->db->like('LOWER('.'name_destination'.')', strtolower($this->input->post('name_destination')));
		}
		if($this->input->post('name'))
		{
			$this->db->like('LOWER('.'name'.')', strtolower($this->input->post('name')));
		}
		if($this->input->post('currency'))
		{
			$this->db->like('LOWER('.'currency'.')', strtolower($this->input->post('currency')));
		}
		if($this->input->post('constant'))
		{
			$this->db->like('LOWER('.'constant::text'.')', strtolower($this->input->post('constant')));
		}

		$this->db->from('program.ta_destination a, program.ta_area_code b');
		$where = "(a.area_code = b.area_code)";
		$this->db->where($where);
		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like('LOWER(' .$item. '::text)', strtolower($_POST['search']['value']));
				}
				else
				{
					$this->db->or_like('LOWER(' .$item. '::text)', strtolower($_POST['search']['value']));
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
