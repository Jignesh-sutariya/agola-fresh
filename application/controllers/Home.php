<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['name'] = "home";
		$data['banners'] = $this->main->getall('banner', "CONCAT('".images('banner/')."', banner) banner,title,sub_title");
		$products = $this->main->getall('category', "id,category,slug", ['is_deleted' => 0], '','category ASC');
		foreach ($products as $k => $v) {
			$products[$k]['products'] = $this->main->getall('products', "id, slug, eng_name,guj_name,min_qty,qty_type,CONCAT('₹ ', price) price,CONCAT('".images('products/')."', image) image",['is_deleted' => 0, 'out_stock' => 0, 'cat_id' => $v['id']], '','eng_name ASC');
		}
		$data['products'] = $products;
		
        return $this->template->load('front/template','front/home', $data);
	}

	public function about()
	{
		$data['name'] = "about";
		$data['title'] = "About Us";
		return $this->template->load('front/template','front/about', $data);
	}

	public function subscribe()
	{
		if (!$this->input->is_ajax_request()) {
		   return error_404();
		}
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[subscribers.email]', ['required' => 'Enter %s.','valid_email' => 'Enter valid %s.','is_unique' => '%s Already Registered.']);
		
        if ($this->form_validation->run() === FALSE) {
        	$return = [
        		'error'   => TRUE,
        		'message' => str_replace("*", "", strip_tags(form_error('email')))
        	];
        	 echo json_encode($return);
        }else{
        	$post = [
        		'email' => $this->input->post('email')
        	];
        	
        	$id = $this->main->add($post, "subscribers");

        	if ($id) {
        		$return = [
	        		'error'   => FALSE,
	        		'message' => "Email Subscription Successful"
	        	];
	        	echo json_encode($return);
        	}else{
        		$return = [
	        		'error'   => TRUE,
	        		'message' => "Email Subscription Not Successful"
	        	];
	        	 echo json_encode($return);
        	}
        }
	}

	public function contact_form()
	{
		if (!$this->input->is_ajax_request()) {
		   return error_404();
		}
		$this->form_validation->set_rules('name', 'Contact Name', 'required', ['required' => 'Enter %s.']);
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email', ['required' => 'Enter %s.','valid_email' => 'Enter valid %s.']);
		$this->form_validation->set_rules('subject', 'Subject', 'required', ['required' => 'Enter %s.']);
		$this->form_validation->set_rules('message', 'Message', 'required', ['required' => 'Enter %s.']);
		
        if ($this->form_validation->run() === FALSE) {
        	$return = [
        		'error'   => TRUE,
        		'message' => str_replace("*", "", validation_errors('','<br>'))
        		// 'message' => str_replace("*", "", strip_tags(validation_errors()))
        	];
        	 echo json_encode($return);
        }else{
        	$post = [
        		'name' => $this->input->post('name'),
        		'email' => $this->input->post('email'),
        		'subject' => $this->input->post('subject'),
        		'message' => $this->input->post('message')
        	];
        	
        	$id = $this->main->add($post, "contact");

        	if ($id) {
        		$return = [
	        		'error'   => FALSE,
	        		'message' => "Message Saved Successful"
	        	];
	        	echo json_encode($return);
        	}else{
        		$return = [
	        		'error'   => TRUE,
	        		'message' => "Message Not Saved"
	        	];
	        	 echo json_encode($return);
        	}
        }
	}
	
	public function contact()
	{
		$data['name'] = "contact";
		$data['title'] = "Contact Us";
		$data['map'] = TRUE;
		return $this->template->load('front/template','front/contact', $data);
	}

	public function terms()
	{
		$data['name'] = "Terms & Conditions";
		$data['title'] = "Terms & Conditions";
		return $this->template->load('front/template','front/terms', $data);
	}

	public function disclaimer()
	{
		$data['name'] = "disclaimer";
		$data['title'] = "Disclaimer";
		return $this->template->load('front/template','front/disclaimer', $data);
	}

	public function privacy_policy()
	{
		$data['name'] = "privacy policy";
		$data['title'] = "Privacy Policy";
		return $this->template->load('front/template','front/privacy_policy', $data);
	}

	public function cancellation_return_policy()
	{
		$data['name'] = "cancellation return policy";
		$data['title'] = "Cancellation Return Policy";
		return $this->template->load('front/template','front/cancellation_return_policy', $data);
	}

	public function logout()
    {
    	$this->session->sess_destroy();
		return redirect('login');
    }

    public function send_otp()
    {
    	if (!$this->input->is_ajax_request()) {
			$data['name'] = "send OTP";
			$data['title'] = "send OTP";
			return $this->template->load('front/template','front/send_otp', $data);		
		}else{
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[10]', ['required' => 'Enter %s.', 'numeric' => 'Enter Valid %s.','exact_length' => 'Enter Valid %s.']);

            if ($this->form_validation->run() === FALSE) {
                $return = [
                    'error'   => TRUE,
                    'message' => str_replace("*", "", strip_tags(validation_errors('','<br>')))
                ];
            }else{
            	
                $post = [
                    'mobile' 	  => $this->input->post('mobile'),
                    'is_approved' => 1,
                    'is_deleted'  => 0,
                    'cust_type'   => 0
                ];
                
                $mobile = $this->main->get('customers', 'mobile', $post);
                if (!$mobile) {
                	$return = [
	                        'message' => "Mobile not registered."
	                    ];
                }else{
                	$mobile = $this->main->get('otp', 'mobile', $mobile);
                	$set = [
                		'mobile'     => $this->input->post('mobile'),
                		'otp'        => rand(100000, 999999),
                        'created_at' => date("Y-m-d H:i:s")
                	];

	                if ($mobile) {
						$id = $this->main->update($mobile, $set,'otp');
	                }else{
	                	$this->main->add($set, 'otp');
	                	$id = 1;
	                }

	                if ($id) {
	                	$sms = "Your OTP is ".$set['otp'];
	                	send_sms($sms, $set['mobile']);
	                	$this->session->set_userdata('mobile', $set['mobile']);
	                    $return = [
	                        'redirect' => base_url('check-otp'),
	                        'message'  => "OTP Sent Successful."
	                    ];
	                }else{
	                    $return = [
	                        'message' => "OTP not Sent. Try again."
	                    ];
	                }
                }
            }
            echo json_encode($return);
		}
    }

    public function check_otp()
    {
    	if (empty($this->session->mobile)) return redirect('');
    	if (!$this->input->is_ajax_request()) {
			$data['name'] = "check OTP";
			$data['title'] = "check OTP";
			return $this->template->load('front/template','front/check_otp', $data);		
		}else{
			$this->form_validation->set_rules('otp', 'OTP', 'required|numeric|exact_length[6]', ['required' => 'Enter %s.', 'numeric' => 'Enter Valid %s.','exact_length' => 'Enter Valid %s.']);

            if ($this->form_validation->run() === FALSE) {
                $return = [
                    'error'   => TRUE,
                    'message' => str_replace("*", "", strip_tags(validation_errors('','<br>')))
                ];
            }else{
                $post = [
                    'mobile'    => $this->session->mobile,
                    'otp'	    => $this->input->post('otp'),
                    'created_at >= ' => date("Y-m-d H:i:s", strtotime("-5 minute"))
                ];

                $otp = $this->main->get('otp', 'mobile, created_at', $post);
                
                if ($otp) {
                	$this->main->delete($otp, 'otp');
                    $return = [
                        'redirect' => base_url('change-password'),
                        'message'  => "OTP check Successful."
                    ];
                }else{
                    $return = [
                        'message' => "OTP expired. Try again."
                    ];
                }
            }
            echo json_encode($return);
		}
    }

    public function change_password()
    {
    	if (empty($this->session->mobile)) return redirect('');
    	if (!$this->input->is_ajax_request()) {
			$data['name'] = "change password";
			$data['title'] = "change password";
			return $this->template->load('front/template','front/change_password', $data);		
		}else{
			$this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('c_password', 'Confirm Password', 'matches[password]', ['matches' => 'Password & %s Must Be Same.']);

            if ($this->form_validation->run() === FALSE) {
                $return = [
                    'error'   => TRUE,
                    'message' => str_replace("*", "", strip_tags(validation_errors('','<br>')))
                ];
            }else{
            	$post = [
                    'mobile' 	  => $this->session->mobile,
                    'is_approved' => 1,
                    'is_deleted'  => 0,
                    'cust_type'   => 0
                ];
                
                $user = $this->main->get('customers', 'id user_id, fullname,mobile,address,pincode', $post);
                $set = [
                    'password' => my_crypt($this->input->post('password'))
                ];
                
                $id = $this->main->update($post, $set, "customers");
                
                if ($id) {
                	$this->session->set_userdata($user);
                	
                    $return = [
                        'redirect' => base_url(),
                        'message'  => "Password Change Successful."
                    ];
                }else{
                    $return = [
                        'message' => "Password Not Change. Try again."
                    ];
                }
            }
            echo json_encode($return);
		}
    }

	public function error_404()
	{
		$data['name'] = "404 Not Found";
		$data['title'] = "404 not found";
		return $this->template->load('front/template','error_404', $data);
	}
}