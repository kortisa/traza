<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataKodeArea extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('kodearea_model','kodeareanya');
	}

    function index()
	{
		$this->load->view('datakodearea/kodearea');
	}

	public function ajax_list()
	{
		$list = $this->kodeareanya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kodeareanya) {
			$row = array();
			//$row[] = $kodeareanya->postid;
			$row[] = $kodeareanya->name;
			$row[] = '<center><a href="'.base_url("datakodearea/ubah?area_code=$kodeareanya->area_code").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kodeareanya->count_all(),
						"recordsFiltered" => $this->kodeareanya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambah()
	{
		$this->load->view('datakodearea/tambahkodearea');
	}

	function ubah()
	{
		$areakode=$_GET['area_code'];
		
		$data['kodearea']=$this->db->query("SELECT * FROM program.fu_viewareacode('$areakode')")->row();

		$this->load->view('datakodearea/ubahkodearea',$data);
	}
	
	function proses_tambah()
	{
		$idkodearea=$_POST['idkodearea'];
		$namakodearea=$_POST['namakodearea'];
		
		$res=$this->db->query("SELECT * FROM program.fu_addareacode('$idkodearea','$namakodearea')");
		
		if($res){
			redirect(base_url('datakodearea'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('datakodearea/tambah').'">Kembali</a>';
		}
	}
	function proses_ubah()
	{
		$idkodearea=$_POST['idkodearea'];
		$namakodearea=$_POST['namakodearea'];

		$res=$this->db->query("SELECT * FROM program.fu_updateareacode('$idkodearea','$namakodearea')");
		
		if($res){
			redirect(base_url('datakodearea'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datakodearea/ubah').'">Kembali</a>';
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