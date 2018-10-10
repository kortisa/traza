<?php
class Notification_model extends CI_Model {
 
    var $tabel = 'program.ta_notification';
 
    function __construct() {
        parent::__construct();
    }
    function hitung() {
        /*$this->db->from($this->tabel);
        $query = $this->db->get();*/
        $level = $this->session->userdata('level');
        $nik = $this->session->userdata('nik');

        $query = $this->db->query("SELECT * FROM program.ta_notification WHERE reqnik='$nik' AND statusreq != 'Pending' or approval1='$nik' or approval2='$nik' or approval3='$nik' or approval4='$nik'");

        return $query->num_rows();
    }
 
    function tampil() {
        /*$this->db->from($this->tabel);
        $this->db->order_by('id', 'DESC');
 
        $query = $this->db->get();*/
        $level = $this->session->userdata('level');
        $nik = $this->session->userdata('nik');

        //Cek travel request yang sedang dilakukan berdasarkan nik yang sedang login dengan kondisi tanggal hari ini tidak boleh lebih dari tanggal pergi travel
        /*$query0 = $this->db->query("SELECT idpermintaan FROM ta_permintaanpergipulang WHERE nikpengaju = '$nik' AND CURRENT_DATE < tanggalpergi")->row();

        if($query0){
            //Jika NIK sedang melakukan request, ambil idpermintaan untuk cek statuspermintaan di tabel ta_permintaan
            $query01 = $this->db->query("SELECT * FROM ta_permintaan WHERE idpermintaan = '$query0->idpermintaan' AND statuspermintaan != 'pending'")->row();

            if ($query01) {
                //Jika statuspermintaan != 'pending'
               $query = $this->db->query("SELECT * FROM ta_notifikasi WHERE oleh='$nik' or admin='$level' or app1='$nik' or app2='$nik' or app3='$nik' or app4='$nik'");

            }else{
                //Jika statuspermintaan == 'pending'
                $query = $this->db->query("SELECT * FROM ta_notifikasi WHERE admin='$level' or app1='$nik' or app2='$nik' or app3='$nik' or app4='$nik'");
            }

        }else{
            //Jika NIK tidak melakkan request
            $query = $this->db->query("SELECT * FROM ta_notifikasi WHERE oleh='$nik' or admin='$level' or app1='$nik' or app2='$nik' or app3='$nik' or app4='$nik'");
        }*/

        $query = $this->db->query("SELECT * FROM program.ta_notification WHERE reqnik='$nik' AND statusreq != 'Pending' or approval1='$nik' or approval2='$nik' or approval3='$nik' or approval4='$nik'");

        
 
        if ($query->num_rows() >0) {
            return $query->result();
        }
    }
 
    function simpan($data1){
       $this->db->insert($this->tabel, $data1);
       return TRUE;
    }

    function simpanedit($data){
       //$this->db->insert($this->tabel, $data);
        $this->db->where('reqid', $data['reqid']);
        $this->db->update('program.ta_notification', $data);
       return TRUE;
    }
 
}
?>