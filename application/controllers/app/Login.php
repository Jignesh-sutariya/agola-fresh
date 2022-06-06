<?php 
/**
 * 
 */
class Login extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if (!$this->agent->is_mobile() && ENVIRONMENT == 'production') die();
		app_login();
	}

	private $table = "customers";

	public function index()
	{
		$this->form_validation->set_rules('mobile', 'Mobile No', 'required', ['required' => 'Enter %s.']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Enter %s.']);

        if ($this->form_validation->run() == FALSE)
		{
			(!empty(str_replace('* ', "", strip_tags(form_error('password'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('password'))) : '';
			(!empty(str_replace('* ', "", strip_tags(form_error('mobile'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('mobile'))) : '';
			(isset($alert)) ? $this->session->set_flashdata($alert) : '';
			return $this->template->load('app/template','app/login');
		}
		else
		{
			$post = [
				'mobile'   => $this->input->post('mobile'),
				'password' => my_crypt($this->input->post('password')),
				'cust_type' => 0
			];
			
			$user = $this->main->get($this->table, "fullname,id cust_id, cust_type, address, mobile", $post);

			if ($user) {
				$this->session->set_userdata($user);
				$alert['alert'][] = "Welcome ".ucwords($user['fullname']);
				$this->session->set_flashdata($alert);
	        	return redirect('app');
			}else{
				$alert['alert'][] = "Invalid Mobile or Password";
				$this->session->set_flashdata($alert);
				return redirect('app/login');
			}
		}
	}

	public function forgot()
	{
		$this->form_validation->set_rules('mobile', 'Mobile No', 'required', ['required' => 'Enter %s.']);

        if ($this->form_validation->run() == FALSE)
		{
			(!empty(str_replace('* ', "", strip_tags(form_error('mobile'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('mobile'))) : '';
			(isset($alert)) ? $this->session->set_flashdata($alert) : '';
			return $this->template->load('app/template','app/forgot');
		}
		else
		{
			$post = [
				'mobile'   => $this->input->post('mobile')
			];

			$user = $this->main->check($this->table, $post, "mobile");

			if ($user) {
				$otp = $this->main->check("otp_check", $post, "mobile");
				$post['otp'] = rand(100000, 999999);
				
				if (!$otp) {
					$this->main->add($post, "otp_check");
				}else{
					$this->main->update(['mobile' => $user], $post, "otp_check");
				}

				$alert['alert'][] = "OTP Sent to ".$user;
				$this->session->set_userdata('mobile', $user);
				$this->session->set_flashdata($alert);
	        	
	        	return redirect('app/check-otp');
			}else{
				$alert['alert'][] = "Mobile Not Registered.";
				$this->session->set_flashdata($alert);
				return redirect('app/forgot');
			}
		}
	}

	public function check_otp()
	{
		$this->form_validation->set_rules('otp', 'OTP', 'required', ['required' => 'Enter %s.']);

        if ($this->form_validation->run() == FALSE)
		{
			(!empty(str_replace('* ', "", strip_tags(form_error('otp'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('otp'))) : '';
			(isset($alert)) ? $this->session->set_flashdata($alert) : '';
			return $this->template->load('app/template','app/check_otp');
		}
		else
		{
			$post = [
				'mobile' => $this->session->userdata('mobile'),
				'otp'    => $this->input->post('otp')
			];

			$d=strtotime("-10 minutes");
			$user = $this->main->check("otp_check", $post, "created_at");
			$this->main->delete($post, "otp_check");
			if ($user && date("Y-m-d h:i:s", $d) <= $user) {
				$alert['alert'][] = "OTP Validated Successfully.";
				$this->session->set_flashdata($alert);
	        	return redirect('app/change-password');
			}else{
				$alert['alert'][] = "Invalid OTP.";
				$this->session->set_flashdata($alert);
				return redirect('app/check-otp');
			}
		}
	}

	public function change_password()
	{
		$this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Enter %s.']);
        $this->form_validation->set_rules('repassword', 'Confirm Password', 'matches[password]', ['matches' => 'Password & %s Must Be Same.']);

        if ($this->form_validation->run() == FALSE)
		{
			(!empty(str_replace('* ', "", strip_tags(form_error('password'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('password'))) : '';
			(!empty(str_replace('* ', "", strip_tags(form_error('repassword'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('repassword'))) : '';
			(isset($alert)) ? $this->session->set_flashdata($alert) : '';
			return $this->template->load('app/template','app/change_password');
		}
		else
		{
			$post = [
				'password' => my_crypt($this->input->post('password'))
			];
			$where = ['mobile' => $this->session->userdata('mobile')];
			$user = $this->main->update($where, $post, $this->table);
			
			if ($user) {
				$alert['alert'][] = "Password Changed. Login With New Password.";
				$this->session->set_flashdata($alert);
	        	return redirect('app/login');
			}else{
				$alert['alert'][] = "Password Not Changed. Try Again.";
				$this->session->set_flashdata($alert);
				return redirect('app/change-password');
			}
		}
	}

	public function signup()
	{
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[customers.mobile]', ['required' => 'Enter %s.','is_unique' => '%s Already Registered.']);
        $this->form_validation->set_rules('fullname', 'Full Name', 'required', ['required' => 'Enter %s.']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Enter %s.']);
        $this->form_validation->set_rules('repassword', 'Confirm Password', 'matches[password]', ['matches' => 'Password & %s Must Be Same.']);
        $this->form_validation->set_rules('address', 'Address', 'required', ['required' => 'Enter %s.']);
         
		if ($this->form_validation->run() == FALSE)
		{
			(!empty(str_replace('* ', "", strip_tags(form_error('address'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('address'))) : '';
			(!empty(str_replace('* ', "", strip_tags(form_error('repassword'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('repassword'))) : '';
			(!empty(str_replace('* ', "", strip_tags(form_error('password'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('password'))) : '';
			(!empty(str_replace('* ', "", strip_tags(form_error('mobile'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('mobile'))) : '';
			(!empty(str_replace('* ', "", strip_tags(form_error('fullname'))))) ? $alert['alert'][] = str_replace('* ', "", strip_tags(form_error('fullname'))) : '';
			(isset($alert)) ? $this->session->set_flashdata($alert) : '';
			return $this->template->load('app/template','app/signup');
		}
		else
		{
			$post = [
				'fullname'   => $this->input->post('fullname'),
				'mobile'     => $this->input->post('mobile'),
				'address'    => $this->input->post('address'),
				'password'   => my_crypt($this->input->post('password')),
				'is_approved'=> 1,
				'cust_type'  => 0
			];
			
			$user = $this->main->add($post, $this->table);
			
			if ($user) {
				$session['cust_id'] = $user;
				$session['fullname'] = $post['fullname'];
				$session['mobile'] = $post['mobile'];
				$session['cust_type'] = $post['cust_type'];
				$alert['alert'][] = "Welcome ".ucwords($post['fullname']);
				$this->session->set_userdata($session);
				$this->session->set_flashdata($alert);
	        	return redirect('app');
			}else{
				$alert['alert'][] = "Sign Up not successfull. Try again.";
				$this->session->set_flashdata($alert);
				return redirect('app/signup');
			}
		}
	}
}
?>