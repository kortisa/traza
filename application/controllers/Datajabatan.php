<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datajabatan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('jabatan_model','jabatannya');
	}

    function index()
	{
		$this->load->view('datajabatan/jabatan');
	}

	public function ajax_list()
	{
		$list = $this->jabatannya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jabatannya) {
			$row = array();
			//$row[] = $jabatannya->postid;
			$row[] = $jabatannya->postname;
			$row[] = '<center><a href="'.base_url("datajabatan/ubah?id=$jabatannya->postid").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jabatannya->count_all(),
						"recordsFiltered" => $this->jabatannya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambah()
	{
		$this->load->view('datajabatan/tambahjabatan');
	}
	function ubah()
	{
		$idjabatan = $_GET['id'];
		
		$data['jabatan']=$this->db->query("SELECT * FROM program.fu_viewpositionid('$idjabatan')")->row();

		$this->load->view('datajabatan/ubahjabatan',$data);
	}
	
	function proses_tambah()
	{
		$namajabatan=$_POST['namajabatan'];
		
		$res=$this->db->query("SELECT * FROM program.fu_addpost('$namajabatan')");
		
		if($res){
			redirect(base_url('datajabatan'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('datajabatan/tambah').'">Kembali</a>';
		}
	}
	function proses_ubah()
	{
		
		$idjabatan=$_POST['idjabatan'];
		$namajabatan=$_POST['namajabatan'];


		$res=$this->db->query("SELECT * FROM program.fu_updateposition('$idjabatan','$namajabatan')");
		
		if($res){
			redirect(base_url('datajabatan'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datajabatan/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$idjabatan=$_GET['idjabatan'];

		$res=$this->db->query("SELECT * FROM fu_hapusjabatan('$idjabatan')");

		if($res){
			redirect(base_url('datajabatan'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datajabatan').'">Kembali</a>';
		}
	}
}