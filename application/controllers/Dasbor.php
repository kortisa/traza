<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller
{
	public function index()
	{

		$this->load->view('dasbor/head');
		$this->load->view('dasbor/header');
		$this->load->view('dasbor/leftsidebar');
		$this->load->view('dasbor/konten');
		$this->load->view('dasbor/footer');
	}

}