<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataMataUang extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

    function index()
	{
		$data['matauang']=$this->db->query("SELECT * FROM vi_matauang")->result();


		$this->load->view('datamatauang/matauang',$data);
	}
	
	function tambah()
	{
		$this->load->view('datamatauang/tambahmatauang');
	}
	function ubah()
	{
		$idmatauang=$_GET['idmatauang'];
		
		$data['matauang']=$this->db->query("SELECT * FROM fu_lihatmatauangid('$idmatauang')")->row();

		$this->load->view('datamatauang/ubahmatauang',$data);
	}
	
	function proses_tambah()
	{
		$namamatauang=$_POST['namamatauang'];
		$simbolmatauang=$_POST['simbolmatauang'];
		
		$res=$this->db->query("SELECT * FROM fu_tambahmatauang('$namamatauang','$simbolmatauang')");
		
		if($res){
			redirect(base_url('datamatauang'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('datamatauang/tambah').'">Kembali</a>';
		}
	}
	function proses_ubah()
	{
		
		$idmatauang=$_POST['idmatauang'];
		$namamatauang=$_POST['namamatauang'];
		$simbolmatauang=$_POST['simbolmatauang'];

		$res=$this->db->query("SELECT * FROM fu_ubahmatauang('$idmatauang','$namamatauang','$simbolmatauang')");
		
		if($res){
			redirect(base_url('datamatauang'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datamatauang/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$idmatauang=$_GET['idmatauang'];

		$res=$this->db->query("SELECT * FROM fu_hapusmatauang('$idmatauang')");

		if($res){
			redirect(base_url('datamatauang'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datamatauang').'">Kembali</a>';
		}
	}
}