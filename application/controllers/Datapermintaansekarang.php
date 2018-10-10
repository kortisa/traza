<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataPermintaanSekarang extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('permintaansekarang_model','permintaannya');
    }

    function index()
    {
        $this->load->view('datapermintaansekarang/permintaansekarang');
    }

    public function ajax_list()
    {
        $list = $this->permintaannya->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $permintaannya) {
            $row = array();
            $row[] = $permintaannya->reqid;
            $row[] = $permintaannya->name;
            $row[] = $permintaannya->reqtime;
            $row[] = '<center><a href="'.base_url("datapermintaansekarang/ubah?id=$permintaannya->reqid").'" class="btn btn-info" role="button" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><center>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->permintaannya->count_all(),
                        "recordsFiltered" => $this->permintaannya->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    
    function ubah()
    {
        $id=$_GET['id'];

        $data['uang']=$this->db->query("SELECT currency FROM program.ta_destination group by currency")->result();
        
        $data['kota']=$this->db->query("SELECT * FROM program.ta_destination")->result();
        $data['permintaansekarang']=$this->db->query("SELECT * FROM program.fu_viewrequestid('$id')")->row();
        
        
        $this->load->view('datapermintaansekarang/ubahpermintaansekarang',$data);
    }
    
    function proses_ubah()
    {
        
        $idjabatan=$_POST['idjabatan'];
        $namajabatan=$_POST['namajabatan'];


        $res=$this->db->query("SELECT * FROM program.fu_updateposition('$idjabatan','$namajabatan')");
        
        if($res){
            redirect(base_url('datajabatan'));
        }else{
            echo "Pengubahan Data Gagal <br>";
            echo '<a href="'.base_url('datajabatan/ubah').'">Kembali</a>';
        }
    }
    
}