<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	private $table = 'users';

	public function index()
	{	
		login();
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
         
		if ($this->form_validation->run() == FALSE)
		{
			return $this->template->load('admin/log_template','admin/login');
		}
		else
		{
			$post = [
				'mobile' => $this->input->post('mobile'),
				'password' => my_crypt($this->input->post('password'))
			];

			$select = 'id, fname, lname, mobile, email, image';
			$user = $this->main->get($this->table, $select, $post);
			
			if ($user) {
				$user['id'] = e_id($user['id']);
				$this->session->set_userdata($user);
	        	return redirect('admin');
			}else{
				$this->session->set_flashdata('error', "Mobile or Passsword not match");
				return redirect('admin/login');
			}
		}
	}

	public function logout()
	{
		auth();
		$this->session->sess_destroy();
		return redirect('admin/login');
	}
}