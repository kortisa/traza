<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataSistemWaktu extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

    function index()
	{
		$data['konfig']=$this->db->query("SELECT * FROM program.ta_config_system")->result();
		$data['waktu']=$this->db->query("SELECT * FROM program.ta_timecost_system")->result();
		$this->load->view('datasistemwaktu/sistemwaktu',$data);
	}

	function ubah_konfig()
	{
		$id=$_GET['id'];
		
		$data['konfig']=$this->db->query("SELECT * FROM program.fu_viewconfig('$id')")->row();

		$this->load->view('datasistemwaktu/ubahsistemwaktu',$data);
	}

	function ubah_waktu()
	{
		$id=$_GET['id'];
		
		$data['waktu']=$this->db->query("SELECT * FROM program.fu_viewtimecost('$id')")->row();

		$this->load->view('datasistemwaktu/ubahsistemwaktu1',$data);
	}
	
	function proses_ubah_konfig()
	{
		
		$id=$_POST['id'];
		$nama=$_POST['nama'];
		$value=$_POST['value'];

		$res=$this->db->query("SELECT * FROM program.fu_updateconfig('$id','$nama','$value')");
		
		if($res){
			redirect(base_url('datasistemwaktu'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datasistemwaktu/ubah_konfig').'">Kembali</a>';
		}
	}
	
	function proses_ubah_waktu()
	{
		
		$id=$_POST['id'];
		$nama=$_POST['nama'];
		$time=$_POST['time'];
		$value=$_POST['value'];


		$res=$this->db->query("SELECT * FROM program.fu_updatetimecost('$id','$nama','$time','$value')");
		
		if($res){
			redirect(base_url('datasistemwaktu'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datasistemwaktu/ubah_waktu').'">Kembali</a>';
		}
	}
}