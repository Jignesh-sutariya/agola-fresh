<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        auth();
    }

    private $name = "profile";
    private $table = "users";
    private $icon = 'fa-user';
    private $redirect = 'admin/profile';

    public $validate = [
            [
                'field' => 'fname',
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'lname',
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'matches[password]|required',
                'errors' => [
                    'matches' => "%s should be same as Password",
                ],
            ],
    ];
    
    public function index()
    {
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        
        $id = $this->session->userdata('id');
        $select = "fname,lname,image,mobile,email";
        
        $data['data'] = $this->main->get($this->table, $select, ['id'=>d_id($id)]);

        $this->template->load('admin/template','admin/profile/profile', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $post = [
                "fname" => $this->input->post("fname"),
                "lname" => $this->input->post("lname"),
                "password" => my_crypt($this->input->post("password"))
            ];

            if(empty($_FILES["image"]["name"]))
            {   
                $id = $this->session->userdata('id');
                $id = $this->main->update(['id'=>d_id($id)], $post,$this->table);
                
                if($id > 0){
                    $this->session->set_userdata("fname", $post["fname"]);
                    $this->session->set_userdata("lname", $post["lname"]);
                }
                
                flashMsg(
                    $id, ucwords($this->name).' Updated Successfully.', ucwords($this->name).' Not Updated, Please Try Again.', $this->redirect
                );
            }else{
                $config['upload_path']= "./assets/images/users/";
                $config['allowed_types']='jpg|png|jpeg';

                $this->upload->initialize($config);
                
                $extn = explode(".", strtolower($_FILES['image']['name']));
                $image = $this->session->userdata("mobile").'.'.$extn[1];
                $_FILES['image']['name'] = $image;
                
                if (!$this->upload->do_upload("image")) {

                    $this->index();
                }else{
                    $data = $this->upload->data();

                    $configer =  [
                      'image_library'   => 'gd2',
                      'source_image'    =>  $data['full_path'],
                      'maintain_ratio'  =>  TRUE,
                      'width'           =>  200,
                      'height'          =>  200,
                    ];
                    $this->load->library('image_lib');

                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();

                    unlink("./assets/images/users/".$this->input->post("image"));
                    $post = [
                        "fname"     => $this->input->post("fname"),
                        "lname"     => $this->input->post("lname"),
                        "password"  => my_crypt($this->input->post("password")),
                        "image"     => $data["file_name"]
                    ];
                    
                    $id = $this->session->userdata('id');
                    $id = $this->main->update(['id'=>d_id($id)], $post,$this->table);
                    
                    if($id > 0){
                        $this->session->set_userdata("fname", $post["fname"]);
                        $this->session->set_userdata("lname", $post["lname"]);
                        $this->session->set_userdata("image", $post["image"]);
                    }
                    
                    flashMsg(
                        $id, ucwords($this->name).' Updated Successfully.', ucwords($this->name).' Not Updated, Please Try Again.', $this->redirect
                    );
                }
            }
        }
    }
}