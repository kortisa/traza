<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$valid = $this->form_validation;
		$nik = $this->input->post('nik');
		$katasandi = $this->input->post('katasandi');
		$valid->set_rules('nik','Username','required');
		$valid->set_rules('katasandi','Password','required');
		if($valid->run())
		{
			$this->otorisasi->login($nik, $katasandi, base_url('dasbor'), base_url('login'));
		}

		$this->load->view('login/login.php');

	}

	public function logout()
	{
		$this->otorisasi->logout();
	}
}
?>