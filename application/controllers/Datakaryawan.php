<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datakaryawan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('karyawan_model','karyawannya');
	}

    function index()
	{

		$data['departemen']=$this->db->query("SELECT * FROM program.vi_department")->result();
		$data['jabatan']=$this->db->query("SELECT * FROM program.vi_position")->result();

		$this->load->view('datakaryawan/karyawan',$data);
	}

	public function ajax_list()
	{
		$list = $this->karyawannya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $karyawannya) {
			$no++;
			$row = array();
			//$row[] = $no;
			$row[] = $karyawannya->nik;
			$row[] = $karyawannya->name;
			$row[] = $karyawannya->telegramid;
			$row[] = $karyawannya->email;
			$row[] = $karyawannya->deptname;
			$row[] = $karyawannya->postname;
			$row[] = $karyawannya->grade;
			$row[] = $karyawannya->token;
			$row[] = $karyawannya->joindate;
			
			$row[] = '<center><a href="'.base_url("datakaryawan/ubah?nik=$karyawannya->nik").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->karyawannya->count_all(),
						"recordsFiltered" => $this->karyawannya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	function tambah()
	{
		$data['departemen']=$this->db->query("SELECT * FROM program.ta_department")->result();
		$data['jabatan']=$this->db->query("SELECT * FROM program.ta_position")->result();

		$this->load->view('datakaryawan/tambahkaryawan',$data);
	}
	
	function ubah()
	{
		$nik=$_GET['nik'];
		
		$data['karyawan']=$this->db->query("SELECT * FROM program.fu_viewemployeenik('$nik')")->row();

		$data['departemen']=$this->db->query("SELECT * FROM program.vi_department")->result();
		$data['jabatan']=$this->db->query("SELECT * FROM program.vi_position")->result();


		$this->load->view('datakaryawan/ubahkaryawan',$data);
	}

	function ubah_profil()
	{
		$nik=$_GET['nik'];
		
		$data['karyawan']=$this->db->query("SELECT * FROM fu_lihatkaryawannik('$nik')")->row();

		$data['departemen']=$this->db->query("SELECT * FROM vi_departemen")->result();
		$data['jabatan']=$this->db->query("SELECT * FROM vi_jabatan")->result();


		$this->load->view('profil/profil',$data);
	}
	
	function proses_tambah()
	{
		$nik=$_POST['nik'];
		$this->db->from('program.ta_employee');
	    $this->db->where('nik',$nik);
	    $query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			$this->session->set_flashdata('ada','Nik is already exist!');
			redirect(base_url('datakaryawan/tambah'));
		}
		else
		{
			$nik=$_POST['nik'];
			$idtelegram=$_POST['idtelegram'];
			$email=$_POST['email'];
			$namakaryawan=$_POST['namakaryawan'];
			$iddepartemen=$_POST['iddepartemen'];
			$idjabatan=$_POST['idjabatan'];
			$tingkat=$_POST['tingkat'];
			$tanggal=$_POST['tanggal'];
			$res=$this->db->query("SELECT * FROM program.fu_addemployee('$nik','$namakaryawan','$email','$idtelegram','$iddepartemen','$idjabatan','$tingkat','$tanggal')");
		
			if($res){
				redirect(base_url('datakaryawan'));
			}else{
				echo "Penambahan Data Gagal <br>";
				echo '<a href="'.base_url('datakaryawan/tambah').'">Kembali</a>';
			}
		}
	}

	function proses_ubah()
	{
		$nik=$_POST['nik'];
		$idtelegram=$_POST['idtelegram'];
		$email=$_POST['email'];
		$namakaryawan=$_POST['namakaryawan'];
		$iddepartemen=$_POST['iddepartemen'];
		$idjabatan=$_POST['idjabatan'];
		$tingkat=$_POST['tingkat'];

		$res=$this->db->query("SELECT * FROM program.fu_updateemployee('$nik','$namakaryawan','$email','$idtelegram','$iddepartemen','$idjabatan','$tingkat')");
		
		if($res){
			redirect(base_url('datakaryawan'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datakaryawan/ubah').'">Kembali</a>';
		}
	}

	function proses_ubah_profil()
	{
		$nik=$_POST['nik'];
		$idtelegram=$_POST['idtelegram'];
		$email=$_POST['email'];
		$namakaryawan=$_POST['namakaryawan'];
		$iddepartemen=$_POST['iddepartemen'];
		$idjabatan=$_POST['idjabatan'];
		$ingkat=$_POST['tingkat'];

		$res=$this->db->query("SELECT * FROM fu_ubahkaryawan('$nik','$idtelegram','$email','$namakaryawan','$iddepartemen','$idjabatan','$ingkat')");
		
		if($res){
			redirect(base_url());
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datakaryawan/ubah_profil').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$nik=$_GET['nik'];
		
		$res=$this->db->query("SELECT * FROM fu_hapuskaryawan('$nik')");

		if($res){
			redirect(base_url('datakaryawan'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datakaryawan').'">Kembali</a>';
		}
	}
}