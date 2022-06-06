<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		login();
	}

	private $table = 'forgot_password';

	public function index()
	{		
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->template->load('admin/log_template','admin/forgot');	
		}
		else
		{	
			$mobile['mobile'] = $this->input->post('mobile');
			$this->session->set_flashdata('mobile', $mobile['mobile']);
			$select = 'email';
			$otp = rand(100000, 999999);
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d h:i:s");
            $email = $this->main->check('users', $mobile, $select);
			if ($email) {
				$msg = "Link to change your accounr password.<br>";
                $msg .= 'Please go to the given link and set your new password.<br>';
                $msg .= admin('forgotPassword/check_otp?email='.$email.'&otp='.$otp).'<br>';
                $msg .= 'This link will be valid for 10 minuts';
                
                $this->email->set_newline("\r\n");
                $this->email->from('info@postoffice.com');
                $this->email->to($email);
                $this->email->subject('Password Reset');
                $this->email->message($msg);
                if ($this->email->send()) {
                	$this->session->set_flashdata('success',"Email Sent! Check Mail");
                	$id = $this->main->check($this->table, ['email' => $email], 'id');
                	if ($id) {
						$this->main->update(['id' => $id], ['email' => $email,'otp' => $otp,'valid' => $date], $this->table);
					}else{
						$this->main->add(['email' => $email,'otp' => $otp,'valid' => $date], $this->table);
					}
                }else{
                	$this->session->set_flashdata('error',"Email Not Sent, Try Again!");
                }
                return redirect('admin/forgotPassword');
			}else{
				$this->session->set_flashdata('error',"Mobile not exist, Check mobile!");
				return redirect('admin/forgotPassword');
			}
		}
	}

	public function check_otp()
	{
		if (isset($_GET['otp'])) {
			date_default_timezone_set('Asia/Kolkata');
			$d=strtotime("-10 minutes");
	        $data['valid'] = $this->main->get_where($this->table, 'email,valid', $_GET);
	        if ($data['valid']) {
	        	if (date("Y-m-d h:i:s", $d) <= $data['valid']['valid']) {
	        		$this->template->load('admin/log_template','admin/generate_password', $data);
		        }else{
		        	$this->session->set_flashdata('heading',"OTP Expired");
					$this->session->set_flashdata('message',"Your OTP Has Been Expired! Request For New OTP");
					return redirect('admin/success');
		        }
	        }else{
	        	error_404();
	        }
		}else{
			error_404();
		}
	}

	public function change()
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			error_404();
		}else{
			$this->form_validation->set_rules('password', 'Password', 'required');
	        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			if ($this->form_validation->run() == FALSE)
			{	
				$data['valid'] = $this->input->post();
				$this->template->load('admin/log_template','admin/generate_password', $data);
			}
			else
			{
				$password = my_crypt($this->input->post('password'));
				$email = $this->input->post('email');
				$id = $this->main->check('users', ['email' => $email], 'id');

				if ($id) {
					$this->main->update(['id' => $id], ['password' => $password], 'users');
					$this->session->set_flashdata('heading',"Password Changed");
					$this->session->set_flashdata('message',"Your Password Changed Successfully. Ligin With your new Password.");
					$this->main->delete(['email' => $email], $this->table);
					return redirect('admin/success');
					
				}else{
					$data['valid'] = $this->input->post();
					$this->session->set_flashdata('error',"Something going wrong.. Try again.");
					$this->load->library('user_agent');
        			return redirect($this->agent->referrer());
				}
			}
		}
	}

	public function success()
	{
		if (empty($this->session->userdata('heading')) || empty($this->session->userdata('message'))) {
			return redirect('admin/login');
		}else{
			$data['heading'] = $this->session->userdata('heading');
			$data['message'] = $this->session->userdata('message');
			return $this->load->view('admin/success', $data);
		}
	}
}