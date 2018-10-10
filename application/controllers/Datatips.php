<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataTips extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('tips_model','tipsnya');
		$this->load->model('dropdown_demo_model');
	}

    function index()
	{
		//$data['tips']=$this->db->query("SELECT * FROM vi_tips")->result();
		
		$this->load->view('datatips/tips');
	}

	public function ajax_list()
	{
		$list = $this->tipsnya->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $tipsnya) {
			$no++;
			$row = array();
			//$row[] = $no;
			$row[] = $tipsnya->id;
			$row[] = $tipsnya->category;
			$row[] = $tipsnya->country;
			$row[] = $tipsnya->city;
			$row[] = $tipsnya->title;
			$row[] = $tipsnya->article;
			$row[] = '<center><a href="'.base_url("datatips/ubah?idtips=$tipsnya->id").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->tipsnya->count_all(),
						"recordsFiltered" => $this->tipsnya->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function tambah()
	{
		//$data['country']=$this->db->query("SELECT * FROM vi_kodelokasi")->result();
		$data['country'] = $this->dropdown_demo_model->get_country();
        $data['city'] = $this->dropdown_demo_model->get_city();
		$this->load->view('datatips/tambahtips', $data);
	}
	
	function ubah()
	{
		$idtips=$_GET['idtips'];
		
		$data['tips']=$this->db->query("SELECT * FROM program.fu_viewtipsid('$idtips')")->row();

		$this->load->view('datatips/ubahtips',$data);
	}
	
	function proses_tambah()
	{
		$category=$_POST['category'];
		$country=$_POST['country'];
		$city=$_POST['city'];
		$title=$_POST['title'];
		$article=$_POST['article'];

		$countryname=$this->db->query("SELECT * FROM program.ta_country WHERE code='$country'")->row();
		$cityname=$this->db->query("SELECT * FROM program.ta_city WHERE id='$city'")->row();
		
		$res=$this->db->query("SELECT * FROM program.fu_addtips('$category','$countryname->name','$cityname->name','$title','$article')");
		
		if($res){
			redirect(base_url('datatips'));
		}else{
			echo "Penambahan Data Gagal <br>";
			echo '<a href="'.base_url('datatips/tambah').'">Kembali</a>';
		}
	}
	function proses_ubah()
	{
		$idtips=$_POST['idtips'];
		$category=$_POST['category'];
		$country=$_POST['country'];
		$city=$_POST['city'];
		$title=$_POST['title'];
		$article=$_POST['article'];

		$countryname1=$this->db->query("SELECT * FROM program.ta_country WHERE code='$country'")->row();
		$cityname1=$this->db->query("SELECT * FROM program.ta_city WHERE id='$city'")->row();

		if($category == "country")
		{
			$res=$this->db->query("SELECT * FROM program.fu_updatetips('$idtips','$category','$countryname1->name','$cityname1->name','$title','$article')");
		}
		else
		{
			$res=$this->db->query("SELECT * FROM program.fu_updatetips('$idtips','$category','-','-','$title','$article')");
		}
		
		if($res){
			redirect(base_url('datatips'));
		}else{
			echo "Pengubahan Data Gagal <br>";
			echo '<a href="'.base_url('datatips/ubah').'">Kembali</a>';
		}
	}
	
	function hapus()
	{
		$idtips=$_GET['idtips'];

		$res=$this->db->query("SELECT * FROM program.fu_deletetips('$idtips')");

		if($res){
			redirect(base_url('datatips'));
		}else{
			echo "Hapus Data Gagal <br>";
			echo '<a href="'.base_url('datatips').'">Kembali</a>';
		}
	}

    function populate_city()
    {
        $id = $this->input->post('id');
        echo(json_encode($this->dropdown_demo_model->get_city($id)));
    }

    function populate_city_ubah()
    {
        $id = $this->input->post('id');
        echo(json_encode($this->dropdown_demo_model->get_city($id)));
    }
}