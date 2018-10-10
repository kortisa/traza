<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
 
        // this controller can only be called from the command line
        //if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');
    }

	public function index()
	{

		//$taik = "This is cron job!";
		//echo $taik;
		//phpinfo();
		//$waktu = $this->db->query("SELECT time FROM program.ta_notification WHERE reqid=$reqid")->row();
		//$cek24 = $this->db->query("SELECT EXTRACT (EPOCH FROM (now() - (SELECT to_timestamp($waktu->time)) )) / 3600 AS diff_hours")->row();
		//echo $waktu->time;
		//echo $cek24->diff_hours;
		//$this->load->library('../controllers/Notification');
		//$this->Notification->hai();
		//* * * * * while true; do php /opt/lampp/htdocs/traza_app/index.php notification postkanedit > /dev/null 2>&1 & sleep 1; done

		$cron = "crontab -u daemon -l > trazacron.txt; echo '7 20 * * * php /opt/lampp/htdocs/traza_app/index.php cron index > /dev/null 2>&1' >> trazacron.txt; crontab -u daemon trazacron.txt;";
		exec($cron);
		echo exec('crontab -u daemon -l');
		//$cron = "ls;whoami";
		//echo exec("crontab zxz 2>&1");
		//echo exec("echo '7 20 * * * php /opt/lampp/htdocs/traza_app/index.php cron index > /dev/null 2>&1' >> cron.txt; crontab cron.txt 2>&1");
		//echo exec("crontab -u daemon zxz");

	}

}