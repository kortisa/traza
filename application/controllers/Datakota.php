<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataKota extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('kota_model','kotanya');
	}

    function index()
	{
		//$data['kota']=$this->db->query("SELECT * FROM vi_kota")->result();
		$this->load->view('datakota/kota');
	}

	public function ajax_list()
	{
		$list = $this->kotanya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kotanya) {
			$no++;
			$row = array();
			//$row[] = $no;
			$row[] = $kotanya->idkota;
			$row[] = $kotanya->namakota;
			$row[] = $kotanya->namanegara;
			$row[] = $kotanya->namalokasi;
			$row[] = '<center><a href="'.base_url("datakota/ubah?idkota=$kotanya->idkota").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kotanya->count_all(),
						"recordsFiltered" => $this->kotanya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambah()
	{
		$data['kodelokasi']=$this->db->query("SELECT * FROM ta_kodelokasi ORDER BY namalokasi ASC")->result();
		$this->load->view('datakota/tambahkota',$data);
	}
	
	function ubah()
	{
		$idkota=$_GET['idkota'];
		
		$data['kota']=$this->db->query("SELECT * FROM fu_lihatkotaid('$idkota')")->row();
		$data['kodelokasi']=$this->db->query("SELECT * FROM ta_kodelokasi ORDER BY namalokasi ASC")->result();

		$this->load->view('datakota/ubahkota',$data);
	}
	
	function proses_tambah()
	{
		$namakota=$_POST['namakota'];
		$namanegara=$_POST['namanegara'];
		$kode=$_POST['kode'];
		
		$res=$this->db->query("SELECT * FROM fu_tambahkota('$namakota','$namanegara','$kode')");
		
		if($res){
			redirect(base_url('datakota'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('datakota/tambah').'">Kembali</a>';
		}
	}
	function proses_ubah()
	{
		
		$idkota=$_POST['idkota'];
		$namakota=$_POST['namakota'];
		$namanegara=$_POST['namanegara'];
		$kode=$_POST['kode'];

		$res=$this->db->query("SELECT * FROM fu_ubahkota('$idkota','$namakota','$namanegara','$kode')");
		
		if($res){
			redirect(base_url('datakota'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datakota/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$idkota=$_GET['idkota'];

		$res=$this->db->query("SELECT * FROM fu_hapuskota('$idkota')");

		if($res){
			redirect(base_url('datakota'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datakota').'">Kembali</a>';
		}
	}
}