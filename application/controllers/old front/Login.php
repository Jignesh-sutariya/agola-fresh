<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        front_login();
    }

    private $table = 'customers';

    public function index()
    {
        $data['name'] = "login";
        $data['title'] = "login";

        if ($this->input->server('REQUEST_METHOD') == 'GET'){
            return $this->template->load('front/template','front/login', $data);
        }else{
            $this->form_validation->set_rules('mobile', 'Mobile', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Enter %s.']);

            if ($this->form_validation->run() === FALSE) {
                $return = [
                    'error'   => TRUE,
                    'message' => str_replace("*", "", validation_errors('','<br>'))
                    // 'message' => str_replace("*", "", strip_tags(validation_errors('','<br>')))
                ];
                 echo json_encode($return);
            }else{

                $post = [
                    'mobile'    => $this->input->post('mobile'),
                    'password'  => my_crypt($this->input->post('password')),
                    'cust_type' => 0
                ];
                
                
                $id = $this->main->get($this->table, 'id user_id, fullname,mobile,address,cust_type', $post);
                if ($id) {
                    $cart = (array) json_decode(get_cookie('cart'));

                    if ($cart) {
                        foreach ($cart as $k => $v) {
                            $post = ['cust_id' => $id['user_id'], 'prod_id' => d_id($k)];
                            $prod_id = $this->main->check('cart', $post, 'prod_id');
                            
                            $prod = ['cust_id' => $post['cust_id'], 'prod_id' => $post['prod_id'], 'qty' => $v];
                            if (!$prod_id) {
                                $this->main->add($prod, "cart");
                            }else{
                                $this->main->update($post, $prod, "cart");
                            }
                        }
                        delete_cookie('cart');
                    }

                    $this->session->set_userdata($id);
                    $return = [
                        'error'    => FALSE,
                        'redirect' => base_url(),
                        'message'  => "Login Successful. You can Shop Now."
                    ];
                    echo json_encode($return);
                }else{
                    $return = [
                        'error'   => TRUE,
                        'message' => "Incorrect Mobile Or Password."
                    ];
                     echo json_encode($return);
                }
            }
        }
    }

    public function signup()
    {
        $data['name'] = "signup";
        $data['title'] = "signup";
        if ($this->input->server('REQUEST_METHOD') == 'GET'){
            return $this->template->load('front/template','front/signup', $data);
        }else{
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[customers.mobile]', ['required' => 'Enter %s.','is_unique' => '%s Already Registered.']);
            $this->form_validation->set_rules('fullname', 'Full Name', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('c_password', 'Confirm Password', 'matches[password]', ['matches' => 'Password & %s Must Be Same.']);
            $this->form_validation->set_rules('address', 'Address', 'required', ['required' => 'Enter %s.']);
        
            if ($this->form_validation->run() === FALSE) {
                $return = [
                    'error'   => TRUE,
                    'message' => str_replace("*", "", validation_errors('','<br>'))
                    // 'message' => str_replace("*", "", strip_tags(validation_errors('','<br>')))
                ];
                 echo json_encode($return);
            }else{
                $post = [
                    'fullname'    => $this->input->post('fullname'),
                    'mobile'      => $this->input->post('mobile'),
                    'password'    => my_crypt($this->input->post('password')),
                    'address'     => $this->input->post('address'),
                    'is_approved' => 1,
                    'cust_type'   => 0
                ];
                
                $id = $this->main->add($post, $this->table);

                if ($id) {
                    unset($post['password']);
                    $post['user_id'] = $id;
                    $this->session->set_userdata($post);

                    $return = [
                        'error'    => FALSE,
                        'redirect' => base_url(),
                        'message'  => "Sign Up Successful. You can Shop Now."
                    ];
                    echo json_encode($return);
                }else{
                    $return = [
                        'error'   => TRUE,
                        'message' => "Sign Up Not Successful. Try again."
                    ];
                     echo json_encode($return);
                }
            }
        }
    }
}