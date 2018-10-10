<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datadepartemen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('departemen_model','departemennya');
	}

    function index()
	{
		//$data['departemen']=$this->db->query("SELECT * FROM vi_departemen")->result();
		$this->load->view('datadepartemen/departemen');
	}

	public function ajax_list()
	{
		$list = $this->departemennya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $departemennya) {
			//$no++;
			$row = array();
			//$row[] = $no;
			//$row[] = $departemennya->deptid;
			$row[] = $departemennya->deptname;
			$row[] = '<center><a href="'.base_url("datadepartemen/ubah?deptid=$departemennya->deptid").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->departemennya->count_all(),
						"recordsFiltered" => $this->departemennya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambah()
	{
		$this->load->view('datadepartemen/tambahdepartemen');
	}
	function ubah()
	{
		$iddepartemen=$_GET['deptid'];
		
		$data['departemen']=$this->db->query("SELECT * FROM program.fu_viewdeptid('$iddepartemen')")->row();

		$this->load->view('datadepartemen/ubahdepartemen',$data);
	}
	
	function proses_tambah()
	{
		$namadepartemen=$_POST['namadepartemen'];
		
		$res=$this->db->query("SELECT * FROM program.fu_adddept('$namadepartemen')");
		
		if($res){
			redirect(base_url('datadepartemen'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('datadepartemen/tambah').'">Kembali</a>';
		}
	}
	function proses_ubah()
	{
		
		$iddepartemen=$_POST['iddepartemen'];
		$namadepartemen=$_POST['namadepartemen'];

		$res=$this->db->query("SELECT * FROM program.fu_updatedepartment('$iddepartemen','$namadepartemen')");
		
		if($res){
			redirect(base_url('datadepartemen'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datadepartemen/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$iddepartemen=$_GET['iddepartemen'];

		$res=$this->db->query("SELECT * FROM fu_hapusdepartemen('$iddepartemen')");

		if($res){
			redirect(base_url('datadepartemen'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datadepartemen').'">Kembali</a>';
		}
	}
}