<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Telegramnotif extends CI_Controller {
		
	//public $botToken = "336125372:AAFgGIRGG6dpoLu-BTqjIB9kQcScyLlhhK0";
	//public $website = "https://api.telegram.org/bot".$this->botToken;
	public $website = "https://api.telegram.org/bot336125372:AAFgGIRGG6dpoLu-BTqjIB9kQcScyLlhhK0";
    
    public function __construct() {
        parent::__construct();
        //$this->load->model('notification_model');  
    }
 
    public function index()
    {
		$this->load->view('telegram/notif');  
    }

    function submissionprocessed($chatid)
    {
		//$botToken = "336125372:AAFgGIRGG6dpoLu-BTqjIB9kQcScyLlhhK0";
		//$website = "https://api.telegram.org/bot".$botToken;
		global $website;
		$text = "Your travel submission is being processed.";
		file_get_contents($this->website."/sendMessage?chat_id=".$chatid."&text=".$text);

		echo "Message has been sent!";
	}

	function submissionrejected($chatid)
	{
		global $website;
		$text = "Your travel submission is rejected.";
		file_get_contents($this->website."/sendMessage?chat_id=".$chatid."&text=".$text);

		echo "Message has been sent!";
	}

	function submissionaccepted($chatid)
	{
		global $website;
		$text = "The travel request has been approved.\nPlease complete the required documents and contact the finance department";
		file_get_contents($this->website."/sendMessage?chat_id=".$chatid."&text=".$text);

		echo "Message has been sent!";
	}

	function requesttoapprover($chatid, $chatid2 = null)
	{
		global $website;
		$text = 'You have a travel request that needs to be approved. Please open this <a href="https://batamschool.id/">LINK</a> to open TraZa website.';
		file_get_contents($this->website."/sendMessage?chat_id=".$chatid."&text=".$text."&parse_mode=html");

		echo "Message has been sent!";
		if($chatid2 != null)
		{
			$this->submissionprocessed($chatid2);
		}

	}

}

?>