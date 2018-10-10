<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Databiayakonfigurasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

    function index()
	{
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();

		$data['basicrate']=$this->db->query("SELECT * FROM program.fu_view_basic_rate()")->result();
		$data['basicratehotel']=$this->db->query("SELECT * FROM program.fu_view_basic_rate_hotel()")->result();
		$data['basicratepocket']=$this->db->query("SELECT * FROM program.fu_view_basic_rate_pocket()")->result();

		$this->load->view('databiayakonfigurasi/biayakonfigurasi',$data);
	}


	
	function tambah_basic_rate()
	{
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();

		$this->load->view('databiayakonfigurasi/tambahbiayakonfigurasi',$data);
	}

	function tambah_basic_rate_hotel()
	{
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();

		$this->load->view('databiayakonfigurasi/tambahbiayakonfigurasi1',$data);
	}

	function tambah_basic_rate_pocket_allowance()
	{
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();

		$this->load->view('databiayakonfigurasi/tambahbiayakonfigurasi2',$data);
	}

	function proses_tambah_basic_rate()
	{
		$idlokasi=$_POST['name'];
		$frequency=$_POST['frequency'];
		$homebase=$_POST['homebase'];
		$nilai=$this->to_pg_array($_POST['nilai']);
		$receipt=$_POST['receipt'];

		
		$res=$this->db->query("SELECT * FROM program.fu_addbasic_rate('$idlokasi','$frequency','$homebase','$nilai','$receipt')");
		
		if($res){
			redirect(base_url('databiayakonfigurasi'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('databiayakonfigurasi/tambah').'">Kembali</a>';
		}
	}

	function proses_tambah_basic_rate_hotel()
	{
		$idlokasi=$_POST['name'];
		$frequency=$_POST['frequency'];
		$homebase=$_POST['homebase'];
		$nilai=$this->to_pg_array($_POST['nilai']);
		$min=$_POST['min'];
		$max=$_POST['max'];

		
		$res=$this->db->query("SELECT * FROM program.fu_addbasic_rate_hotel('$idlokasi','$frequency','$homebase','$nilai','$min','$max')");
		
		if($res){
			redirect(base_url('databiayakonfigurasi'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('databiayakonfigurasi/tambah').'">Kembali</a>';
		}
	}

	function proses_tambah_basic_rate_pocket_allowance()
	{
		$idlokasi=$_POST['name'];
		$frequency=$_POST['frequency'];
		$homebase=$_POST['homebase'];
		$nilai=$this->to_pg_array($_POST['nilai']);
		$min=$_POST['min'];
		$max=$_POST['max'];

		
		$res=$this->db->query("SELECT * FROM program.fu_addbasic_rate_pocket_allowance('$idlokasi','$frequency','$homebase','$nilai','$min','$max')");
		
		if($res){
			redirect(base_url('databiayakonfigurasi'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('databiayakonfigurasi/tambah').'">Kembali</a>';
		}
	}

	function ubah_basic_rate()
	{
		$base=$_GET['base'];
		
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();
		
		$data['basicrate']=$this->db->query("SELECT * FROM program.fu_view_basic_rate_id('$base')")->result();

		$this->load->view('databiayakonfigurasi/ubahbiayakonfigurasi',$data);
	}

	function ubah_basic_rate_hotel()
	{
		$base=$_GET['base'];
		
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();
		
		$data['basicrate']=$this->db->query("SELECT * FROM program.fu_view_basic_rate_hotel_id('$base')")->result();

		$this->load->view('databiayakonfigurasi/ubahbiayakonfigurasi1',$data);
	}

	function ubah_basic_rate_pocket()
	{
		$base=$_GET['base'];
		
		$data['areakode']=$this->db->query("SELECT * FROM program.ta_area_code")->result();
		
		$data['basicrate']=$this->db->query("SELECT * FROM program.fu_view_basic_rate_pocket_id('$base')")->result();

		$this->load->view('databiayakonfigurasi/ubahbiayakonfigurasi2',$data);
	}

	function to_pg_array($set) 
    {

        settype($set, 'array');

        $result = array();

        foreach ($set as $t) {

        if (is_array($t)) {

        $result[] = to_pg_array($t);

        } else {

        $t = str_replace('"', '\\"', $t);

        if (! is_numeric($t))

        $t = '"' . $t . '"';

        $result[] = $t;

        }

        }

        return '{' . implode(",", $result) . '}';

    }
	
	
	function proses_ubah_basicrate()
	{
		$nameasli=$_POST['nameasli'];
		$name=$_POST['name'];
		$frequency=$_POST['frequency'];
		$homebase=$_POST['homebase'];
		$nilai=$this->to_pg_array($_POST['nilai']);
		$receipt=$_POST['receipt'];

		$res=$this->db->query("SELECT * FROM program.fu_updatebasic_rate('$nameasli','$name','$frequency','$homebase','$nilai','$receipt')");
		
		if($res){
			redirect(base_url('databiayakonfigurasi'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('databiayakonfigurasi/ubah').'">Kembali</a>';
		}
	}

	function proses_ubah_basicratehotel()
	{
		$nameasli=$_POST['nameasli'];
		$name=$_POST['name'];
		$frequency=$_POST['frequency'];
		$homebase=$_POST['homebase'];
		$nilai=$this->to_pg_array($_POST['nilai']);
		$min=$_POST['min'];
		$max=$_POST['max'];

		$res=$this->db->query("SELECT * FROM program.fu_updatebasic_rate_hotel('$nameasli','$name','$frequency','$homebase','$nilai','$min','$max')");
		
		if($res){
			redirect(base_url('databiayakonfigurasi'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('databiayakonfigurasi/ubah').'">Kembali</a>';
		}
	}

	function proses_ubah_basicratepocket()
	{
		$nameasli=$_POST['nameasli'];
		$name=$_POST['name'];
		$frequency=$_POST['frequency'];
		$homebase=$_POST['homebase'];
		$nilai=$this->to_pg_array($_POST['nilai']);
		$min=$_POST['min'];
		$max=$_POST['max'];

		$res=$this->db->query("SELECT * FROM program.fu_updatebasic_rate_pocket('$nameasli','$name','$frequency','$homebase','$nilai','$min','$max')");
		
		if($res){
			redirect(base_url('databiayakonfigurasi'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('databiayakonfigurasi/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$nikpeminta=$_GET['nikpeminta'];

		$res=$this->db->query("SELECT * FROM fu_hapusbiayakonfigurasi('$nikpeminta')");

		if($res){
			redirect(base_url('databiayakonfigurasi'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('databiayakonfigurasi').'">Kembali</a>';
		}
	}
}