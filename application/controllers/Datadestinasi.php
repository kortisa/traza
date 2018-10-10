<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datadestinasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('destinasi_model','destinasinya');
	}

    function index()
	{
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();
		$this->load->view('datadestinasi/destinasi',$data);
	}

	public function ajax_list()
	{
		$list = $this->destinasinya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $destinasinya) {
			$row = array();
			//$row[] = $destinasinya->code;
			$row[] = $destinasinya->name_destination;
			$row[] = $destinasinya->name;
			$row[] = $destinasinya->currency;
			$row[] = $destinasinya->constant;
			$row[] = '<center><a href="'.base_url("datadestinasi/ubah?code=$destinasinya->code").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->destinasinya->count_all(),
						"recordsFiltered" => $this->destinasinya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambah()
	{
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();

		$this->load->view('datadestinasi/tambahdestinasi',$data);
	}

	function ubah()
	{
		$kode=$_GET['code'];
		
		$data['destinasi']=$this->db->query("SELECT * FROM program.fu_viewdestinationcode('$kode')")->row();
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();

		$this->load->view('datadestinasi/ubahdestinasi',$data);
	}
	
	function proses_tambah()
	{
		$namadestinasi=$_POST['namadestinasi'];
		$areakode=$_POST['areakode'];
		$currency=$_POST['currency'];
		$konstanta=$_POST['konstanta'];
		
		$res=$this->db->query("SELECT * FROM program.fu_adddestination('$namadestinasi','$areakode','$currency','$konstanta')");
		
		if($res){
			redirect(base_url('datadestinasi'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('datadestinasi/tambah').'">Kembali</a>';
		}
	}
	function proses_ubah()
	{
		$code=$_POST['code'];
		$namadestinasi=$_POST['namadestinasi'];
		$areakode=$_POST['areakode'];
		$currency=$_POST['currency'];
		$konstanta=$_POST['konstanta'];

		$res=$this->db->query("SELECT * FROM program.fu_updatedestination('$code','$namadestinasi','$areakode','$currency','$konstanta')");
		
		if($res){
			redirect(base_url('datadestinasi'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datadestinasi/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$areakode=$_GET['areakode'];

		$res=$this->db->query("SELECT * FROM fu_hapusjabatan('$areakode')");

		if($res){
			redirect(base_url('datajabatan'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datajabatan').'">Kembali</a>';
		}
	}
}