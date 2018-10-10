<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataPersetujuan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('persetujuan_model','persetujuannya');
	}

    function index()
	{
		//$data['persetujuan']=$this->db->query("SELECT * FROM vi_persetujuan")->result();
		$this->load->view('datapersetujuan/persetujuan');
	}

	public function ajax_list()
	{
		$list = $this->persetujuannya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $persetujuannya) {
			$no++;
			$row = array();
			//$row[] = $no;
			$row[] = $persetujuannya->reqnik;
			$row[] = $persetujuannya->approval1;
			$row[] = $persetujuannya->approval2;
			$row[] = $persetujuannya->approval3;
			$row[] = $persetujuannya->approval4;
			$row[] = ucfirst($persetujuannya->requeststatus);
			$row[] = '<center><a href="'.base_url("DataPersetujuan/ubah?nikpeminta=$persetujuannya->reqnik").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->persetujuannya->count_all(),
						"recordsFiltered" => $this->persetujuannya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambah()
	{
		$data['karyawan']=$this->db->query("SELECT * FROM program.vi_employee")->result();

		$this->load->view('datapersetujuan/tambahpersetujuan',$data);
	}
	function ubah()
	{
		$nikpeminta=$_GET['nikpeminta'];

		$data['karyawan']=$this->db->query("SELECT * FROM program.vi_employee")->result();
		
		$data['persetujuan']=$this->db->query("SELECT * FROM program.fu_viewapprovalnik('$nikpeminta')")->row();

		$this->load->view('datapersetujuan/ubahpersetujuan',$data);
	}
	
	function proses_tambah()
	{
		$nikpeminta=$_POST['nikpeminta'];
		$nikpenerima1=$_POST['nikpenerima1'];
		$nikpenerima2=$_POST['nikpenerima2'];
		$nikpenerima3=$_POST['nikpenerima3'];
		$nikpenerima4=$_POST['nikpenerima4'];
		$statuspersetujuan=$_POST['statuspersetujuan'];

		$res=$this->db->query("SELECT * FROM program.fu_addapproval('$nikpeminta','$nikpenerima1','$nikpenerima2','$nikpenerima3','$nikpenerima4','$statuspersetujuan')");
		
		if($res){
			redirect(base_url('datapersetujuan'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('datapersetujuan/tambah').'">Kembali</a>';
		}
	}
	
	function proses_ubah()
	{
		
		$nikpeminta=$_POST['nikpeminta'];
		$nikpenerima1=$_POST['nikpenerima1'];
		$nikpenerima2=$_POST['nikpenerima2'];
		$nikpenerima3=$_POST['nikpenerima3'];
		$nikpenerima4=$_POST['nikpenerima4'];
		$statuspersetujuan=$_POST['statuspersetujuan'];

		$res=$this->db->query("SELECT * FROM program.fu_updateapproval('$nikpeminta','$nikpenerima1','$nikpenerima2','$nikpenerima3','$nikpenerima4','$statuspersetujuan')");
		if(isset($_POST['reqid']))
		{
			$reqid = $_POST['reqid'];
			$q_notif = $this->db->query("SELECT * FROM program.ta_notification WHERE reqid='$reqid'")->row();
			$approval = $q_notif->notcekapp;
			$cek = $this->db->query("SELECT * FROM program.ta_approval WHERE reqnik='$q_notif->reqnik'")->row();
			/*$data = array('$approval' => $cek->$approval, 'approval1' => '');
            $this->db->where('reqid', $reqid);
            $this->db->update('program.ta_notification',$data);*/
            $updatenotif = $this->db->query("UPDATE program.ta_notification SET $approval='".$cek->$approval."', approval1='', time='".time()."' WHERE reqid='$reqid'");
			$q_notcek = $this->db->query("UPDATE program.ta_notification SET notceknik='', notcekapp='' WHERE reqid='$reqid'");
			//Cron Job
            $hour =  date('H', time());
            $minute =  date('i', time());
            $day = date('N', time())+1;
            $notceknik = $cek->$approval;
            $notcekapp = $approval;
            if($day==7)
            {
                $day = 0;
            }
            elseif($day>7)
            {
                $day = 1;
            }
            $delcron = exec("crontab -u daemon -l | grep -v '$reqid'  | crontab -u daemon -;");
            $cron = exec("(crontab -u daemon -l; echo \"$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron $reqid $notceknik $notcekapp > /dev/null 2>&1\") | crontab -u daemon -;");
            //Cron Job
		}

		if($res && $q_notcek){
			redirect(base_url('datapersetujuan'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datapersetujuan/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$nikpeminta=$_GET['nikpeminta'];

		$res=$this->db->query("SELECT * FROM fu_hapuspersetujuan('$nikpeminta')");

		if($res){
			redirect(base_url('datapersetujuan'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datapersetujuan').'">Kembali</a>';
		}
	}

}