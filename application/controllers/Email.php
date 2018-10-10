<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  /**
   *
   */
class Email extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('MyPHPMailer'); // load library
    }
 
    function emailSend($reqid=null,$to=null){
        $options['ssl']['verify_peer'] = false;
               $options['ssl']['verify_peer_name'] = false;
               $options['ssl']['allow_self_signed'] = true;
        $fromEmail = "yogi.wewew@gmail.com"; //ganti dg alamat email kamu di sini
        $isiEmail = "New Request by ID Req: X@#$%^&"; //ini isi emailnya
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
        $mail->Subject    = "New Request #19:59"; //ini subjek emailnya
        $mail->Body       = $isiEmail;
        $toEmail = "yogikortisa@gmail.com"; // siapa yg menerima email ini
        $mail->AddAddress($toEmail);
        $mail->Send();
       
        /*if(!$mail->Send()) {
            echo "Eror: ".$mail->ErrorInfo;
        } else {
            echo "Email berhasil dikirim";
        }*/
    }

}
?>