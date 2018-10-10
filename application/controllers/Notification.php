<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Notification extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Bangkok');
        $this->load->model('notification_model');
        $this->load->library('MyPHPMailer');  
    }
 
    public function index()
    {
        $data['title'] = 'Notifikasi Approval'; //judul title
        $data['jlhnotif'] =$this->notification_model->hitung();  //menghitung jumlah post
        $data['notifikasi'] =$this->notification_model->tampil(); //menampilkan isi postingan
 
        $this->load->view('notification/vnotifikasi',$data); //load view vnotifikasi

    }
 
 /*   public function postkan(){
        //ambil variabel yang dikirim jquery post
        $reqnik   = addslashes($this->input->post('reqnik'));
        $reqid  = addslashes($this->input->post('reqid'));
 
        $data = array(
            'reqnik'  => $reqnik,
            'reqid' => $reqid,
            'time'  => time(),
            'approval1' => 'admin',
            'approval2'  => '',
            'approval3'  => '',
            'approval4'  => '',
            'statusreq' => 'Pending'
        );
        $this->notification_model->simpan($data);

        $query = $this->db->query("INSERT INTO ta_permintaan (idpermintaan,statuspermintaan) values ('$idnya','pending')");    
    }*/

    /*public function cronta($reqid=null, $hour=null, $minute=null, $day=null)
    {
        $waktu = $this->db->query("SELECT time FROM program.ta_notification WHERE reqid=$reqid")->row();
        $hourawal =  date('H', $waktu->time);
        $minuteawal =  date('i', $waktu->time);
        $dayawal = date('N', $waktu->time)+1;
        //$cek24 = $this->db->query("SELECT EXTRACT (EPOCH FROM (now() - (SELECT to_timestamp($waktu->time)) )) / 3600 AS diff_hours")->row();
        if($hour == $hourawal && $minuteawal == $minute && $dayawal == $day)
        {
            return true;
        }
        return false;

    }*/

    public function postkanedit(){
        //ambil variabel yang dikirim jquery post
        $reqid  = addslashes($this->input->post('reqid'));
        $reqnik   = addslashes($this->input->post('reqnik'));
           
        $data = array(
            'reqid'     => $reqid,
            'reqnik'     => $reqnik,
            'time'      => time()
        );
        $this->notification_model->simpanedit($data);

        $niknya = $this->db->query("SELECT reqnik FROM program.ta_notification WHERE reqid='".$data['reqid']."'")->row();

        $cek = $this->db->query("SELECT * FROM program.ta_approval WHERE reqnik='$niknya->reqnik'")->row();


        if($cek->requeststatus == 'active')
        {
            $title = $cek->approval4;
            $data2 = array('approval1' => '',
                           'statusreq' => 'Approv');
            $this->db->where('reqid', $data['reqid']);
            $this->db->update('program.ta_notification',$data2);

            $datareq = array('statusreq' => 'Approv');
            $this->db->where('reqid', $data['reqid']);
            $this->db->update('program.ta_request',$datareq);

            $mailto = $this->db->query("SELECT email FROM program.ta_employee WHERE nik='$reqnik'")->row();
            $content = "Your Request with ID: ".$reqid." has been approved by Traza system. You can check your request in Traza App http://traza.citratubindo.com";
            $sendto = $this->emailsend($reqid, $mailto->email, $content);

//Cron Job
            /*$hour =  date('H', $data['time']);
            $minute =  date('i', $data['time']);
            $day = date('N', $data['time'])+1;

            // $waktu = $this->db->query("SELECT time FROM program.ta_notification WHERE reqid=$reqid")->row();
            //$cek24 = $this->db->query("SELECT EXTRACT (EPOCH FROM (now() - (SELECT to_timestamp($waktu->time)) )) / 3600 AS diff_hours")->row();

            //$cron = "echo '$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron reqid > /dev/null 2>&1' > cron.txt; crontab cron.txt";
            $cron = "crontab -u daemon -l > tacron.txt; echo '$minute $hour * * $day mkdir tacron > /dev/null 2>&1' >> tacron.txt; crontab -u daemon tacron.txt";
            exec($cron);*/
//Cron Job

             //Cari telegram id Approver 2, 3, atau 4
            $telegram = $this->db->query("SELECT * FROM program.ta_employee WHERE nik='$title'")->row();

            //Cari telegram id Requestor
            $telegramreq = $this->db->query("SELECT * FROM program.ta_employee WHERE nik='$niknya->reqnik'")->row();

            if($telegram->telegramid != '' && $telegramreq->telegramid != '')
            {//Jika ID Telegram approver dan requestor terdaftar
                redirect(base_url('telegramnotif/requesttoapprover/'.$telegram->telegramid.'/'.$telegramreq->telegramid));

            }
            else if ($telegram->telegramid != '' && $telegramreq->telegramid == '')
            {//Jika ID Telegram Approver yang terdaftar
                    redirect(base_url('telegramnotif/requesttoapprover/'.$telegram->telegramid));
                    
            }
            else if ($telegram->telegramid == '' && $telegramreq->telegramid != '')
            {//Jika ID Telegram requestor yang terdaftar
                redirect(base_url('telegramnotif/submissionprocessed/'.$telegramreq->telegramid));
            }
            
        }
        else
        {
            $notceknik = $cek->approval2;
            $data2 = array('approval2' => $notceknik, 'approval1' => '');
            $this->db->where('reqid', $data['reqid']);
            $this->db->update('program.ta_notification',$data2);

//Cron Job
            $hour =  date('H', time());
            $minute =  date('i', time());
            $day = date('N', time())+1;
            $notcekapp = "approval2";
            if($day==7)
            {
                $day = 0;
            }
            elseif($day>7)
            {
                $day = 1;
            }

            // $waktu = $this->db->query("SELECT time FROM program.ta_notification WHERE reqid=$reqid")->row();
            //$cek24 = $this->db->query("SELECT EXTRACT (EPOCH FROM (now() - (SELECT to_timestamp($waktu->time)) )) / 3600 AS diff_hours")->row();

            //$cron = "echo '$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron reqid > /dev/null 2>&1' > cron.txt; crontab cron.txt";
            //$cron = "crontab -u daemon -l > tacron.txt; echo '$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron $reqid $title > /dev/null 2>&1' >> tacron.txt; crontab -u daemon tacron.txt;";
            $delcron = exec("crontab -u daemon -l | grep -v '$reqid'  | crontab -u daemon -;");
            $cron = exec("(crontab -u daemon -l; echo \"$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron $reqid $notceknik $notcekapp > /dev/null 2>&1\") | crontab -u daemon -;");
//Cron Job

            //Cari telegram id Approver 2, 3, atau 4
            /*$telegram = $this->db->query("SELECT * FROM program.ta_employee WHERE nik='$title'")->row();

            //Cari telegram id Requestor
            $telegramreq = $this->db->query("SELECT * FROM program.ta_employee WHERE nik='$niknya->reqnik'")->row();

            if($telegram->telegramid != '' && $telegramreq->telegramid != '')
            {//Jika ID Telegram approver dan requestor terdaftar
                redirect(base_url('telegramnotif/requesttoapprover/'.$telegram->telegramid.'/'.$telegramreq->telegramid));

            }
            else if ($telegram->telegramid != '' && $telegramreq->telegramid == '')
            {//Jika ID Telegram Approver yang terdaftar
                    redirect(base_url('telegramnotif/requesttoapprover/'.$telegram->telegramid));

            }
            else if ($telegram->telegramid == '' && $telegramreq->telegramid != '')
            {//Jika ID Telegram requestor yang terdaftar
                redirect(base_url('telegramnotif/submissionprocessed/'.$telegramreq->telegramid));
            }*/


        }    
    }

    public function cron($reqid=null, $nik=null, $app=null)
    {
        /*$waktu = $this->db->query("SELECT time FROM program.ta_notification WHERE reqid=$reqid")->row();
        $hourawal =  date('H', $waktu->time);
        $minuteawal =  date('i', $waktu->time);
        $dayawal = date('N', $waktu->time)+1;
        //$cek24 = $this->db->query("SELECT EXTRACT (EPOCH FROM (now() - (SELECT to_timestamp($waktu->time)) )) / 3600 AS diff_hours")->row();
        if($hour == $hourawal && $minuteawal == $minute && $dayawal == $day)
        {
            return true;
        }
        return false;*/
        if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
        $approvalcek = $this->db->query("SELECT * FROM program.ta_notification WHERE approval1='$nik' or approval2='$nik' or approval3='$nik' or approval4='$nik' AND reqid='$reqid'")->row();
        $niknya = $this->db->query("SELECT reqnik FROM program.ta_notification WHERE reqid='$reqid'")->row();
        if($approvalcek)
        {
            $cek = $this->db->query("SELECT * FROM program.ta_approval WHERE reqnik='$niknya->reqnik'")->row();
            $data2 = array('approval1' => $cek->approval1,
                           'approval2' => '',
                           'approval3' => '',
                           'approval4' => '',
                           'notceknik' => $nik,
                           'notcekapp' => $app);
            $this->db->where('reqid', $reqid);
            $this->db->update('program.ta_notification',$data2);
        }
        $delcron = exec("crontab -u daemon -l | grep -v '$reqid'  | crontab -u daemon -;");

    }

    public function Approval()
    {
        //ambil variabel yang dikirim jquery post
        $reqid  = addslashes($this->input->post('reqid'));
        $reqnik   = addslashes($this->input->post('reqnik'));
           
        $data = array(
            'reqid'     => $reqid,
            'reqnik'     => $reqnik,
            'time'      => time()
        );

        $level = $this->session->userdata('level');
        $nik = $this->session->userdata('nik');
        $query = $this->db->query("SELECT * FROM program.ta_notification WHERE approval1='$level' or approval2='$nik' or approval3='$nik' or approval4='$nik' AND reqid='$reqid'")->row();
        //print_r($query);
        $cek = $this->db->query("SELECT * FROM program.ta_approval WHERE reqnik='$query->reqnik'")->row();

        //$time = $this->db->query("SELECT * FROM program.ta_notification WHERE reqid='$reqid'")->row();

        /*if(timeAgo($time->time) < 24)
        {
            $datanya = array(
            'approval3'     => $cek->approval3,
            'approval2'     => ''
            );
            $this->db->where('reqid', $data['reqid']);
            $this->db->update('program.ta_notification', $data2);
        }*/
        
        if($query->approval2 == $nik)
        {
            $data2 = array(
            'approval3'     => $cek->approval3,
            'approval2'     => '',
            'time'          => time()
            );
            $this->db->where('reqid', $data['reqid']);
            $this->db->update('program.ta_notification', $data2);

            //Cron Job
            $hour =  date('H', time());
            $minute =  date('i', time());
            $day = date('N', time())+1;
            $notceknik = $cek->approval3;
            $notcekapp = "approval3";
            if($day==7)
            {
                $day = 0;
            }
            elseif($day>7)
            {
                $day = 1;
            }

            // $waktu = $this->db->query("SELECT time FROM program.ta_notification WHERE reqid=$reqid")->row();
            //$cek24 = $this->db->query("SELECT EXTRACT (EPOCH FROM (now() - (SELECT to_timestamp($waktu->time)) )) / 3600 AS diff_hours")->row();

            //$cron = "echo '$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron reqid > /dev/null 2>&1' > cron.txt; crontab cron.txt";
            //$delcron = exec('crontab -u daemon -r');
            //$cron = "crontab -u daemon -l > tacron.txt; echo '$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron $reqid $nikapp > /dev/null 2>&1' >> tacron.txt; crontab -u daemon tacron.txt";
            $delcron = exec("crontab -u daemon -l | grep -v '$reqid'  | crontab -u daemon -;");
            $cron = exec("(crontab -u daemon -l; echo \"$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron $reqid $notceknik $notcekapp > /dev/null 2>&1\") | crontab -u daemon -;");
            //Cron Job

        }
        elseif($query->approval3 == $nik)
        {
            $data2 = array(
            'approval4'     => $cek->approval4,
            'approval3'     => ''
            );
            $this->db->where('reqid', $data['reqid']);
            $this->db->update('program.ta_notification', $data2);

            //Cron Job
            $hour =  date('H', time());
            $minute =  date('i', time());
            $day = date('N', time())+1;
            $notceknik = $cek->approval4;
            $notcekapp = "approval4";
            if($day==7)
            {
                $day = 0;
            }
            elseif($day>7)
            {
                $day = 1;
            }

            // $waktu = $this->db->query("SELECT time FROM program.ta_notification WHERE reqid=$reqid")->row();
            //$cek24 = $this->db->query("SELECT EXTRACT (EPOCH FROM (now() - (SELECT to_timestamp($waktu->time)) )) / 3600 AS diff_hours")->row();

            //$cron = "echo '$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron reqid > /dev/null 2>&1' > cron.txt; crontab cron.txt";
            //$delcron = exec('crontab -u daemon -r');
            $delcron = exec("crontab -u daemon -l | grep -v '$reqid'  | crontab -u daemon -;");
            $cron = exec("(crontab -u daemon -l; echo \"$minute $hour * * $day php /opt/lampp/htdocs/traza_app/index.php notification cron $reqid $notceknik $notcekapp > /dev/null 2>&1\") | crontab -u daemon -;");
            //Cron Job
        }
        elseif($query->approval4 == $nik)
        {
            $data2 = array(
            'approval4'     => '',
            'statusreq' => 'Approv'
            );
            $this->db->where('reqid', $data['reqid']);
            $this->db->update('program.ta_notification', $data2);

            $data3 = array(
            'statusreq'     => 'Approv'
            );
            $this->db->where('reqid', $data['reqid']);
            $this->db->update('program.ta_request', $data3);
            $this->db->query("SELECT program.fu_copytable('".$data['reqid']."')");

            $mailto = $this->db->query("SELECT email FROM program.ta_employee WHERE nik='$reqnik'")->row();
            $content = "Your Request with ID: ".$reqid." has been Approved by Traza system. You can check your request in Traza App http://traza.citratubindo.com";
            $sendto = $this->emailsend($reqid, $mailto->email, $content);
        }
        redirect(base_url('dasbor'));
    }
 
    public function load_row(){     //fungsi load_row untuk menampilkan jlh data pada navbar secara realtime
        $totalnotif = $this->notification_model->hitung(); //jumlah data akan langsung di tampilkan
        if($totalnotif != 0)
            echo $totalnotif;
    }
 
    public function load_data(){    //fungsi load_data untuk menampilkan isi data pada navbar secara realtime
 
        $data=$this->notification_model->tampil();
        $no=0;foreach($data as $rdata){ $no++;
            if($no % 2==0){$strip='strip1';}
                    else{$strip='strip2';}
            echo"<li><a href=\"#\" class=\"".$strip."\">".$rdata->pesan."<br>
            <small>".$rdata->oleh." ".timeAgo($rdata->tgl)."</small>
            </a><li>";
        }
    }

    public function load_data_admin(){    //fungsi load_data untuk menampilkan isi data pada navbar secara realtime
 
        @$data=$this->notification_model->tampil();
        if(!$data)
        {
            echo("<li><a href=\"".base_url('dasbor')."\" class=\"strip1\">No Request.
            </a><li>");
        }
        error_reporting(E_ALL & ~E_WARNING);

        $no=0;
        foreach($data as $rdata)
        { 
            $no++;
            if($no % 2==0)
            {
                $strip='strip1';
            }
            else
            {
                $strip='strip2';
            }
            $level = $this->session->userdata('level');
            $nik = $this->session->userdata('nik');
            $notif = "New Request by $rdata->reqnik";
            $notcek = "Not Checked > 24 Hours!";
            //$cekstat = $this->db->query("SELECT * FROM program.ta_request WHERE reqid='".$rdata->reqid."'")->row();
            $nikadmin = $this->db->query("SELECT * FROM program.ta_approval WHERE reqnik='$rdata->reqnik'")->row();
            if($rdata->notceknik && $rdata->notcekapp != null)
            {
                echo "<li><a href=\"".base_url("notification/notcek?id=$rdata->reqid")."\" class=\"".$strip."\">".$notcek."<br><small><b>(".ucfirst($rdata->notcekapp).": ".$rdata->notceknik.")</b> - ".timeAgo($rdata->time)."</small></a><li>";
            }
            elseif($nik == $nikadmin->approval1)
            {
            
            //echo "<li><a href=\"".base_url("datapermintaansekarang/ubah?id=$rdata->reqid")."\" class=\"".$strip."\">".$notif."<br><small><b>(".$rdata->reqid.")</b> - ".timeAgo($rdata->time)."</small></a><li>";
            
            echo "<li><a href=\"".base_url("notification/admincek?id=$rdata->reqid")."\" class=\"".$strip."\">".$notif."<br><small><b>(".$rdata->reqid.")</b> - ".timeAgo($rdata->time)."</small></a><li>";
            }
            elseif($rdata->reqnik == $nik && $level != 'admin')
            {
                echo "<li onclick=\"clickmeh('$rdata->reqid')\"><a href=\"".base_url("notification/requestorcek?id=$rdata->reqid")."\" class=\"".$strip."\">".$notif."<br><small>(".$rdata->reqid.") - ".timeAgo($rdata->time)."</small></a><li>";
            }
            else
            {
                /*$time = $this->db->query("SELECT * FROM program.ta_notification WHERE reqid='$rdata->reqid'")->row();

                if(timeAgo($time->time) < 3)
                {
                    /*$datanya = array(
                    'approval3'     => $cek->approval3,
                    'approval2'     => ''
                    );
                    $this->db->where('reqid', $data['reqid']);
                    $this->db->update('program.ta_notification', $data2);*/

                   /* $data = array(
                        'reqid'     => $rdata->reqid,
                        'reqnik'     => $rdata->reqnik
                    );

                    $level = $this->session->userdata('level');
                    $nik = $this->session->userdata('nik');
                    $query = $this->db->query("SELECT * FROM program.ta_notification WHERE approval1='$level' or approval2='$nik' or approval3='$nik' or approval4='$nik' AND reqid='$rdata->reqid'")->row();

                    if($query->approval2 == $nik)
                    {
                        $data2 = array(
                        'approval1'     => 'admin',
                        'approval2'     => ''
                        );
                        $this->db->where('reqid', $data['reqid']);
                        $this->db->update('program.ta_notification', $data2); 
                    }
                    elseif($query->approval3 == $nik)
                    {
                        $data2 = array(
                        'approval1'     => 'admin',
                        'approval3'     => ''
                        );
                        $this->db->where('reqid', $data['reqid']);
                        $this->db->update('program.ta_notification', $data2);
                    }
                    elseif($query->approval4 == $nik)
                    {
                        $data2 = array(
                        'approval1'     => 'admin',
                        'approval4' => ''
                        );
                        $this->db->where('reqid', $data['reqid']);
                        $this->db->update('program.ta_notification', $data2);        
                    }
                }*/

                echo "<li><a href=\"".base_url("notification/odgmcek?id=$rdata->reqid")."\" class=\"".$strip."\">".$notif."<br><small><b>(".$rdata->reqid.")</b> - ".timeAgo($rdata->time)."</small></a><li>";
            }
        }
    }

    public function admincek()
    {
        $requestor=$_GET['id'];
        $data['requestor']=$this->db->query("SELECT * FROM program.ta_notification WHERE reqid='$requestor'")->row();
        $this->load->view('notification/admincek',$data);
    }

    public function odgmcek()
    {
        $requestor=$_GET['id'];
        //$data['requestor']=$this->db->query("SELECT * FROM program.ta_notification WHERE reqid='$requestor'")->row();
        $data['req'] = $this->db->query("SELECT * FROM program.ta_request WHERE reqid='$requestor'")->row();
        $data['uang']=$this->db->query("SELECT currency FROM program.ta_destination group by currency")->result();
        $data['kota']=$this->db->query("SELECT * FROM program.ta_destination")->result();
        $data['permintaansekarang']=$this->db->query("SELECT * FROM program.fu_viewrequestid('$requestor')")->row();
        $this->load->view('notification/test',$data);
    }

    public function requestorcek()
    {
        $requestor=$_GET['id'];
        $data['requestor']=$this->db->query("SELECT * FROM program.ta_request WHERE reqid='$requestor'")->row();
        //$data['reqnya']=$this->db->query("SELECT * FROM program.ta_request WHERE reqid='$requestor'")->row();
        //print_r($data['status']);
        $this->load->view('notification/requestorcek',$data);
    }

    public function reject()
    {
        $reqid  = addslashes($this->input->post('reqid'));
        $reqnik   = addslashes($this->input->post('reqnik'));

        $data3 = array(
            'statusreq'     => 'Canceled'
            );
            $this->db->where('reqid', $reqid);
            $this->db->update('program.ta_request', $data3); 

        $data4 = array( 
                    'approval1' => '',
                    'approval2' => '',
                    'approval3' => '',
                    'approval4' => '',
                    'statusreq' => 'Canceled');

        $this->db->where('reqid', $reqid);
        $this->db->update('program.ta_notification', $data4); 

        $telegramreq = $this->db->query("SELECT * FROM program.ta_employee WHERE nik='$reqnik'")->row();

        if($telegramreq->telegramid != '')
        {//Jika ID Telegram approver dan requestor terdaftar
            redirect(base_url('telegramnotif/submissionrejected/'.$telegramreq->telegramid));

        }

        $mailto = $this->db->query("SELECT email FROM program.ta_employee WHERE nik='$reqnik'")->row();
        $content = "Your Request with ID: ".$reqid." has been Canceled by Traza system. You can check your request in Traza App http://traza.citratubindo.com";
        $sendto = $this->emailsend($reqid, $mailto->email, $content);
    }

    public function notcek()
    {
        $requestor=$_GET['id'];

        $data['req'] = $this->db->query("SELECT * FROM program.ta_request WHERE reqid='$requestor'")->row();
        $data['karyawan']=$this->db->query("SELECT * FROM program.vi_employee")->result();
        $nikpeminta = $this->db->query("SELECT reqnik FROM program.ta_request WHERE reqid='$requestor'")->row();
        $data['persetujuan']=$this->db->query("SELECT * FROM program.fu_viewapprovalnik('$nikpeminta->reqnik')")->row();

        $this->load->view('notification/notcek',$data);
    }

    public function deletenotif()
    {
        $nama   = addslashes($this->input->post('nama'));
        $query = $this->db->query("DELETE FROM program.ta_notification WHERE reqid='$nama'")->row();
    }

    function emailsend($reqid=null, $mailto=null, $content=null){
        $options['ssl']['verify_peer'] = false;
               $options['ssl']['verify_peer_name'] = false;
               $options['ssl']['allow_self_signed'] = true;
        $fromEmail = "yogi.wewew@gmail.com"; //ganti dg alamat email kamu di sini
        $isiEmail = $content; //ini isi emailnya
        $mail = new PHPMailer();
        $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
            )
        );
        $mail->IsHTML(true);    //ini agar email bisa mengirim dalam format HTML
        $mail->IsSMTP();   //kita akan menggunakan SMTP
        $mail->SMTPAuth   = true; //Autentikasi SMTP: enabled
        $mail->SMTPSecure = "ssl";  //jenis keamanan SMTP
        $mail->SMTPAutoTLS = false;
        $mail->Host       = "smtp.gmail.com"; //setting GMail sebagai SMTP server
        $mail->Port       = 465; // SMTP port to connect to GMail
        $mail->Username   = $fromEmail;  
        $mail->Password   = "w3w3w007"; //ganti dg password GMail kamu
        $mail->SetFrom('admin@citratubindo.com', 'Traza App');  //Siapa yg mengirim email
        $mail->Subject    = "New Request #".$reqid; //ini subjek emailnya
        $mail->Body       = $isiEmail;
        //$toEmail = $to; // siapa yg menerima email ini
        $mail->AddAddress($mailto);
        $mail->Send();
       
        /*if(!$mail->Send()) {
            echo "Eror: ".$mail->ErrorInfo;
        } else {
            echo "Email berhasil dikirim";
        }*/
    }
}
 
