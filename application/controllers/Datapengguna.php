<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataPengguna extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('pengguna_model','penggunanya');
	}

    function index()
	{

		$this->load->view('datapengguna/pengguna');
	}

	public function ajax_list()
	{
		$list = $this->penggunanya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $penggunanya) {
			$no++;
			$row = array();
			//$row[] = $no;
			$row[] = $penggunanya->nik;
			$row[] = $penggunanya->password;
			$row[] = ucfirst($penggunanya->level);
			$row[] = ucfirst($penggunanya->status);
			$row[] = '<center><a href="'.base_url("datapengguna/ubah?nik=$penggunanya->nik").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->penggunanya->count_all(),
						"recordsFiltered" => $this->penggunanya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambah()
	{
		$data['karyawan']=$this->db->query("SELECT * FROM program.ta_employee")->result();
		$this->load->view('datapengguna/tambahpengguna',$data);
	}
	function ubah()
	{
		$nik=$_GET['nik'];
		
		$data['pengguna']=$this->db->query("SELECT * FROM program.fu_viewusernik('$nik')")->row();

		$this->load->view('datapengguna/ubahpengguna',$data);
	}
	
	function proses_tambah()
	{
		$nik=$_POST['nik'];
		$this->db->from('program.ta_user');
	    $this->db->where('nik',$nik);
	    $query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			$this->session->set_flashdata('ada','Nik is already exist!');
			redirect(base_url('datapengguna/tambah'));
		}
		else
		{
			$nik=$_POST['nik'];
			$katasandi=$_POST['katasandi'];
			$level=$_POST['level'];
			$status=$_POST['status'];
			
			$res=$this->db->query("SELECT * FROM program.fu_adduser('$nik','$katasandi','$level','$status')");
			
			if($res){
				redirect(base_url('datapengguna'));
			}else{
				echo "Penambahan Data Gagal <br>";
				echo '<a href="'.base_url('datapengguna/tambah').'">Kembali</a>';
			}
		}
	}
	function proses_ubah()
	{
		
		$nik=$_POST['nik'];
		$katasandi=$_POST['katasandi'];
		$level=$_POST['level'];
		$status=$_POST['status'];

		$res=$this->db->query("SELECT * FROM program.fu_updateuser('$nik','$katasandi','$level','$status')");
		
		if($res){
			redirect(base_url('datapengguna'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datapengguna/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$nik=$_GET['nik'];

		$res=$this->db->query("SELECT * FROM fu_hapuspengguna('$nik')");

		if($res){
			redirect(base_url('datapengguna'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datapengguna').'">Kembali</a>';
		}
	}
}