<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permintaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('notification_model');
	}

    function index()
	{
		
        $data['kota']=$this->db->query("SELECT * FROM program.ta_destination")->result();

        $data['uang']=$this->db->query("SELECT currency FROM program.ta_destination group by currency")->result();
        
		$this->load->view('permintaan/permintaan',$data);
	}
	
    function ambil_tempat()
    {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);
        
        // cari data yang ada di database
        $data = $this->db->query("select * from program.ta_location where name ilike '%$keyword%'");

        // format keluaran di dalam array
        foreach($data->result() as $row)
        {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' =>$row->name                
                
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    
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

    function konversi_waktu($jam,$menit)
    {
        $i=0;
        while(@$jam[$i] != null)
          {
            
            @$jamkemenit[$i] =  $jam[$i] * 60 ;  
            @$jamkemana[$i]= $jamkemenit[$i] + $menit[$i];
                
            $i++;
          }
        $total = $this->to_pg_array($jamkemana);
        return $total; 
    }

    function biaya($set,$set1,$set2) 
    {
        $i = 0;
        while (@$set1[$i]!= null)
            {
                if($set1[$i]==$set)
                {
                    $result1[] = $set2[$i];
                }
                else
                {
                    $result1[] = 0;
                }
                $i++;
            }

        return $result1;
    }



    function tampil_rekomendasi_pergi()
    {
        $rutenya = $_POST['get_option'];
        $sql = $this->db->query("SELECT rute FROM program.ta_request WHERE loctdept=$rutenya")->result();
        echo '<option value="">Select an option</option>';
        foreach($sql as $row)
        { 
        echo '<option value="'.$row->rute.'">'.$row->namarute.'</option>';
        }
    }

    function tampil_rekomendasi_pulang()
    {
        $rutenya = $_POST['get_option'];
        $sql = $this->db->query("SELECT rute FROM program.ta_request WHERE loctarrive=$rutenya")->result();
        echo '<option value="">Select an option</option>';
        foreach($sql as $row)
        { 
        echo '<option value="'.$row->rute.'">'.$row->namarute.'</option>';
        }
    }

    function tampil_suges_pergi()
    {
        $rutenya = $_POST['get_option'];
        $sql = $this->db->query("SELECT rute FROM program.ta_request WHERE loctdept=$rutenya")->result();

        echo json_encode($sql);
    }

    function tampil_suges_pulang()
    {
        $rutenya = $_POST['get_option'];
        $sql = $this->db->query("SELECT rute FROM program.ta_request WHERE loctarrive=$rutenya")->result();

        echo json_encode($sql);
    }

    function tampil_rute_pergi()
    {
        $rutenya = $_POST['get_option'];
        $lokasi = $_POST['get_1'];
        $result = pg_query("SELECT array_to_json(loctdeptfrom) AS dari, array_to_json(loctdeptto) AS ke, array_to_json(timedeptpertrip) AS waktu, array_to_json(currencydept) AS matauang, array_to_json(transportdept) AS kendaraan, array_to_json(costdept) AS uang from program.ta_request where rute=$rutenya and loctdept=$lokasi");

        while($line = pg_fetch_row($result, null, PGSQL_ASSOC))
        {
          $d[] = json_decode($line['dari']);
          $d[] = json_decode($line['ke']);
          $d[] = json_decode($line['kendaraan']);
          $d[] = json_decode($line['matauang']);
          $d[] = json_decode($line['waktu']);
          $d[] = json_decode($line['uang']);
        }
        
        echo json_encode($d);
    }

    function tampil_rute_pulang()
    {
        $rutenya = $_POST['get_option'];
        $lokasi = $_POST['get_1'];
        $result = pg_query("SELECT array_to_json(loctarrivefrom) AS dari, array_to_json(loctarriveto) AS ke, array_to_json(timearrivepertrip) AS waktu, array_to_json(currencyarrive) AS matauang, array_to_json(transportarrive) AS kendaraan, array_to_json(costarrive) AS uang from program.ta_request where rute=$rutenya and loctarrive=$lokasi");

        while($line = pg_fetch_row($result, null, PGSQL_ASSOC))
        {
          $d[] = json_decode($line['dari']);
          $d[] = json_decode($line['ke']);
          $d[] = json_decode($line['kendaraan']);
          $d[] = json_decode($line['matauang']);
          $d[] = json_decode($line['waktu']);
        }
        
        echo json_encode($d);
    }

    function estimasi()
    {
        /*
        $level = $this->session->userdata('level');
        $nik = $this->session->userdata('nik');
        if($level=='operator' or $level=='manajer' or $level=='odgm')
        {
        */
        $nikpeminta = $_POST['nikpeminta'];
        $namakota = $_POST['lokasipergi'][1];
        $nikpejalan = $this->to_pg_array(array_values(array_filter($_POST['nikpejalan'])));
        $pergitanggal = $_POST['pergitanggal'];
        $pulangtanggal = $_POST['pulangtanggal'];
        $totalwaktupergi = $this->konversi_waktu($_POST['jampergi'],$_POST['menitpergi']);
        $totalwaktupulang = $this->konversi_waktu($_POST['jampulang'],$_POST['menitpulang']);

        $homebase = $_POST['homebase'];

        $lokasidaripergi = $this->to_pg_array(array_values(array_filter($_POST['lokasidaripergi'])));
        $lokasikepergi = $this->to_pg_array(array_values(array_filter($_POST['lokasikepergi'])));

        $totalwaktupergi = $this->konversi_waktu($_POST['jampergi'],$_POST['menitpergi']);

        $namamatauangpergi = $this->to_pg_array(array_values(array_filter($_POST['namamatauangpergi'])));

        $hargapergi = $this->to_pg_array($_POST['hargapergi']);

        $hargapulang = $this->to_pg_array($_POST['hargapulang']);

       
        $pulangtanggal = $_POST['pulangtanggal'];
        $lokasidaripulang = $this->to_pg_array(array_values(array_filter($_POST['lokasidaripulang'])));
        $lokasikepulang = $this->to_pg_array(array_values(array_filter($_POST['lokasikepulang'])));

        $totalwaktupulang = $this->konversi_waktu($_POST['jampulang'],$_POST['menitpulang']);

        $namamatauangpulang = $this->to_pg_array(array_values(array_filter($_POST['namamatauangpulang'])));

        $jmlhari = $this->db->query("SELECT program.fu_totalday('$pergitanggal','$pulangtanggal')")->result();
        foreach ($jmlhari as $row) {
            $jmlharitotal = $row->fu_totalday;
        }

        /*
        }
        else
        {
          redirect(base_url());
        }
        */
       
        $result = pg_query("SELECT array_to_json(basic_rate_bs_pa) as basic_rate_bs_pa, array_to_json(pocket_allowance) as pocket_allowance, array_to_json(basic_rate_bs_as) as basic_rate_bs_as, array_to_json(basic_rate_as) as basic_rate_as, array_to_json(basic_rate_bs_ha_as) as basic_rate_bs_ha_as, array_to_json(basic_rate_bs_ha_as) as basic_rate_bs_ha_as, array_to_json(hotel_allowance_as) as hotel_allowance_as, array_to_json(basic_rate_bs) as basic_rate_bs, array_to_json(basic_rate) as basic_rate, array_to_json(basic_rate_bs_ha) as basic_rate_bs_ha, array_to_json(basic_rate_bs_ha) as basic_rate_bs_ha, array_to_json(hotel_allowance) as hotel_allowance, array_to_json(total_at_cost_system) as total_at_cost_system, array_to_json(total_allowance_system) as total_allowance_system, total_total_at_cost_system, total_total_allowance_system, (select count(*) from program.fu_get_allowance ('$namakota','$nikpejalan','2','$homebase','$jmlharitotal')) as total FROM program.fu_get_allowance ('$namakota','$nikpejalan','2','$homebase','$jmlharitotal')");
        
        while($line = pg_fetch_row($result, null, PGSQL_ASSOC))
        {
          $basic_rate_bs_pa = json_decode($line['basic_rate_bs_pa']);
          $pocket_allowance = json_decode($line['pocket_allowance']);
          $basic_rate_bs_as = json_decode($line['basic_rate_bs_as']);
          $basic_rate_as = json_decode($line['basic_rate_as']);
          $basic_rate_bs_ha_as = json_decode($line['basic_rate_bs_ha_as']);
          $hotel_allowance_as = json_decode($line['hotel_allowance_as']);
          $basic_rate_bs = json_decode($line['basic_rate_bs']);
          $basic_rate = json_decode($line['basic_rate']);
          $basic_rate_bs_ha = json_decode($line['basic_rate_bs_ha']);
          $hotel_allowance = json_decode($line['hotel_allowance']);
          $total_at_cost_system = json_decode($line['total_at_cost_system']);
          $total_allowance_system = json_decode($line['total_allowance_system']);
          $total_total_at_cost_system = $line['total_total_at_cost_system'];
          $total_total_allowance_system = $line['total_total_allowance_system'];
          $total = $line['total'];
        }

        $data['basic_rate_bs_pa'] = $basic_rate_bs_pa;
        $data['pocket_allowance'] = $pocket_allowance;
        $data['basic_rate_bs_as'] = $basic_rate_bs_as;
        $data['basic_rate_as'] = $basic_rate_as;
        $data['basic_rate_bs_ha_as'] = $basic_rate_bs_ha_as;
        $data['hotel_allowance_as'] = $hotel_allowance_as;
        $data['basic_rate_bs'] = $basic_rate_bs;
        $data['basic_rate'] = $basic_rate;
        $data['basic_rate_bs_ha'] = $basic_rate_bs_ha_as;
        $data['hotel_allowance'] = $hotel_allowance;
        $data['total_at_cost_system'] = $total_at_cost_system;
        $data['total_allowance_system'] = $total_allowance_system;
        $data['total_total_at_cost_system'] = $total_total_at_cost_system;
        $data['total_total_allowance_system'] = $total_total_allowance_system;
        $data['total'] = $total;

        $result1 = pg_query("SELECT array_to_json(out_fromdept) as out_fromdept, array_to_json(out_todept) as out_todept, array_to_json(out_fromarive) as out_fromarive, array_to_json(out_toarive) as out_toarive, array_to_json(out_estimasinamedept) as out_estimasinamedept, array_to_json(out_estimasinameto) as out_estimasinamearive, array_to_json(out_estimasivaluedept) as out_estimasivaluedept,  array_to_json(out_estimasivalueto) as out_estimasivaluearive, array_to_json(out_time_estimasidept) as out_time_estimasidept, array_to_json(out_time_estimasito) as out_time_estimasiarive, array_to_json(currencytotal) as currencytotal, array_to_json(total_all_atcost) as total_all_atcost, array_to_json(total_all_allowance) as total_all_allowance FROM program.fu_all_estimation ('$namakota','$nikpejalan','$lokasidaripergi','$lokasikepergi','$lokasidaripulang','$lokasikepulang',$total_total_at_cost_system,$total_total_allowance_system,'$namamatauangpergi','$namamatauangpulang','$hargapergi','$hargapulang','$totalwaktupergi','$totalwaktupulang')");
        
        while($line1 = pg_fetch_row($result1, null, PGSQL_ASSOC))
        {
          $out_fromdept[] = json_decode($line1['out_fromdept']);
          $out_todept[] = json_decode($line1['out_todept']);
          $out_fromarive[] = json_decode($line1['out_fromarive']);
          $out_toarive[] = json_decode($line1['out_toarive']);
          $out_estimasinamedept[] = json_decode($line1['out_estimasinamedept']);
          $out_estimasinamearive[] = json_decode($line1['out_estimasinamearive']);
          $out_estimasivaluedept[] = json_decode($line1['out_estimasivaluedept']);
          $out_estimasivaluearive[] = json_decode($line1['out_estimasivaluearive']);
          $out_time_estimasidept[] = json_decode($line1['out_time_estimasidept']);
          $out_time_estimasiarive[] = json_decode($line1['out_time_estimasiarive']);
          $currencytotal[] = json_decode($line1['currencytotal']);
          $total_all_atcost[] = json_decode($line1['total_all_atcost']);
          $total_all_allowance[] = json_decode($line1['total_all_allowance']);

        }

        $data['out_fromdept'] = $out_fromdept;
        $data['out_todept'] = $out_todept;
        $data['out_fromarive'] = $out_fromarive;
        $data['out_toarive'] = $out_toarive;
        $data['out_estimasinamedept'] = $out_estimasinamedept;
        $data['out_estimasinamearive'] = $out_estimasinamearive;
        $data['out_estimasivaluedept'] = $out_estimasivaluedept;
        $data['out_estimasivaluearive'] = $out_estimasivaluearive;
        $data['out_time_estimasidept'] = $out_time_estimasidept;
        $data['out_time_estimasiarive'] = $out_time_estimasiarive;
        $data['currencytotal'] = $currencytotal;
        $data['total_all_atcost'] = $total_all_atcost;
        $data['total_all_allowance'] = $total_all_allowance;
        $data['nikpejalan'] = $nikpejalan;
        $data['homebase'] = $homebase;
        $data['jmlharitotal'] = $jmlharitotal;
        $data['nikpeminta'] = $nikpeminta;
        $data['out_transportdept'] = $_POST['transportasipergi'];
        $data['out_transportarive'] = $_POST['transportasipulang'];
        $data['lokasipergi'] = $_POST['lokasipergi'];
        $data['lokasipulang'] = $_POST['lokasipulang'];
        $data['pergitanggal'] = $pergitanggal;
        $data['pulangtanggal'] = $pulangtanggal;
        $data['alldata'] = $data;
        //print_r($data);
        
        $this->load->view('permintaan/cetakta',$data);
        

    }

    function tambah()
    {
        $data = unserialize($_POST['data']);
        
        $basic_rate_bs_pa = $this->to_pg_array($data['basic_rate_bs_pa'][0]);
        $pocket_allowance = $this->to_pg_array($data['pocket_allowance'][0]); 
        $basic_rate_bs_as = $this->to_pg_array($data['basic_rate_bs_as'][0]); 
        $basic_rate_as = $this->to_pg_array($data['basic_rate_as'][0]); 
        $basic_rate_bs_ha_as = $this->to_pg_array($data['basic_rate_bs_ha_as'][0]); 
        $hotel_allowance_as = $this->to_pg_array($data['hotel_allowance_as'][0]); 
        $basic_rate_bs = $this->to_pg_array($data['basic_rate_bs'][0]); 
        $basic_rate = $this->to_pg_array($data['basic_rate'][0]); 
        $basic_rate_bs_ha = $this->to_pg_array($data['basic_rate_bs_ha'][0]); 
        $hotel_allowance = $this->to_pg_array($data['hotel_allowance'][0]); 
        $total_at_cost_system = $this->to_pg_array($data['total_at_cost_system'][0]); 
        $total_allowance_system = $this->to_pg_array($data['total_allowance_system'][0]); 
        $total_total_at_cost_system = $data['total_total_at_cost_system']; 
        $total_total_allowance_system = $data['total_total_allowance_system'];
        $out_fromdept = $this->to_pg_array($data['out_fromdept'][0]);
        $out_todept = $this->to_pg_array($data['out_todept'][0]);
        $out_fromarive = $this->to_pg_array($data['out_fromarive'][0]);
        $out_toarive = $this->to_pg_array($data['out_toarive'][0]);
        $out_estimasinamedept = $this->to_pg_array($data['out_estimasinamedept'][0]);
        $out_estimasinamearive = $this->to_pg_array($data['out_estimasinamearive'][0]);
        $out_estimasivaluedept = $this->to_pg_array($data['out_estimasivaluedept'][0]);
        $out_estimasivaluearive = $this->to_pg_array($data['out_estimasivaluearive'][0]);
        $out_time_estimasidept = $this->to_pg_array($data['out_time_estimasidept'][0]);
        $out_time_estimasiarive = $this->to_pg_array($data['out_time_estimasiarive'][0]);
        $out_transportdept = $this->to_pg_array($data['out_transportdept'][0]);
        $out_transportarive = $this->to_pg_array($data['out_transportarive'][0]);
        $currencytotal = $this->to_pg_array($data['currencytotal'][0]);
        $total_all_atcost = $this->to_pg_array($data['total_all_atcost'][0]);
        $total_all_allowance = $this->to_pg_array($data['total_all_allowance'][0]);
        $nikpejalan = $data['nikpejalan'];
        $homebase = $data['homebase'];
        $jmlharitotal = $data['jmlharitotal'];
        $nikpeminta = $data['nikpeminta'];
        $lokasipergi = $this->to_pg_array($data['lokasipergi']);
        $lokasipulang = $this->to_pg_array($data['lokasipulang']);
        $pergitanggal = $data['pergitanggal'];
        $pulangtanggal = $data['pulangtanggal'];
        $reqid = $this->db->query("SELECT program.fu_idreq()")->result();
        foreach ($reqid as $row) {
            $requestid = $row->fu_idreq;
        }
        
        if($_POST['pilih']==1)
        {
            $totalcost = $total_all_allowance;
        }

        if($_POST['pilih']==0){
            $totalcost = $total_all_atcost;
        }

        $res=$this->db->query("SELECT * FROM program.fu_addrequest('$nikpeminta','$nikpejalan','$lokasipergi','$out_fromdept','$out_todept','$out_time_estimasidept','$out_estimasivaluedept','$out_estimasinamedept','$out_transportdept','$pergitanggal','$lokasipulang','$out_fromarive','$out_toarive','$out_time_estimasiarive','$out_estimasivaluearive','$out_estimasinamearive','$out_transportarive','$pulangtanggal','$totalcost','$currencytotal','$requestid')");

        $res1=$this->db->query("SELECT * FROM program.fu_addlivingcost('$requestid','$nikpeminta','$nikpejalan','$basic_rate_bs_pa','$pocket_allowance','$basic_rate_bs','$basic_rate','$basic_rate_bs_ha','$hotel_allowance','$basic_rate_bs_as','$basic_rate_as','$basic_rate_bs_ha_as','$hotel_allowance_as','$total_at_cost_system','$total_allowance_system','$total_total_at_cost_system','$total_total_allowance_system')");

        $nikadmin = $this->db->query("SELECT * FROM program.ta_approval WHERE reqnik='$nikpeminta'")->row();
        $data1 = array(
            'reqnik'  => $nikpeminta,
            'reqid' => $requestid,
            'time'  => time(),
            'approval1' => $nikadmin->approval1,
            'approval2'  => '',
            'approval3'  => '',
            'approval4'  => '',
            'statusreq' => 'Pending'
        );
        $res2 = $this->notification_model->simpan($data1);
        
        if($res and $res1 and $res2){
            redirect(base_url());
        }else{
            echo "Pengubahan Data Gagal <br>";
            echo '<a href="'.base_url('permintaan').'">Kembali</a>';
        }        
        
    }
}