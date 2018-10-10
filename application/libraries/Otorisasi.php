<?php if(!defined('BASEPATH')) exit('Akses langsung tidak diperbolehkan!');

class Otorisasi
{
	var $CI = NULL;
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function login($nik, $katasandi)
	{
		$query = $this->CI->db->get_where('program.ta_user',array('nik'=>$nik,'password'=>$katasandi));
		if($query->num_rows() == 1)
		{
			$row = $this->CI->db->query("SELECT * FROM program.ta_user where nik = '".$nik."'");
			$admin = $row->row();
			$nik = $admin->nik;
			$status = $admin->status;
			$level = $admin->level;

			$this->CI->session->set_userdata('nik', $nik);
			$this->CI->session->set_userdata('status', $status);
			$this->CI->session->set_userdata('level', $level);

			
			if($status == 'block')
				{
					$this->CI->session->set_flashdata('msg1','Your account is not active!');
					redirect(base_url('login'));
				}
			else
			{
				redirect(base_url('dasbor'));
			}
		}
		else
		{
			$this->CI->session->set_flashdata('msg1','Username or Password is not valid!');
			redirect(base_url('login'));
		}
		return false;
	}

	public function cek_login()
	{
		if($this->CI->session->userdata('nik') == '')
		{
			$this->CI->session->set_flashdata('msg2', 'You are not login');
			redirect(base_url('login'));

		}
	}

	public function logout()
	{
		$this->CI->session->sess_destroy();
		$this->CI->session->set_flashdata('msg','You are already logout');
		redirect(base_url('login'));
	}
}