<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DeliveryBoy extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'delivery boy';
	private $access = 'deliveryBoy';
	private $table = 'delivery_boy';
	private $redirect = 'admin/deliveryBoy';

	public $validate = [
            [
                'field' => 'fullname',
                'label' => 'Full Name',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'mobile',
                'label' => 'Mobile No.',
                'rules' => 'required|callback_mobile_check',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'callback_password_check'
            ],
            [
                'field' => 'c_password',
                'label' => 'Confirm Password',
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => "%s should be same as Password",
                ],
            ]
    ];

    public function mobile_check($str)
    {   

        $id = $this->uri->segment(4);
        $mob = $this->main->check($this->table, array('mobile' => $str), 'id');
        if ((!empty($id) && $mob != d_id($id)) || ($mob && empty($id)))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else{
            return TRUE;
        }
    }

    public function password_check($str)
    {   
        $id = $this->uri->segment(4);
        
        if (empty($id) && $str == '')
        {
            $this->form_validation->set_message('password_check', '%s is required');
            return FALSE;
        } else{
            return TRUE;
        }
    }

	public function index()
	{	
		$data['name'] = $this->name;
		$data['datatable'] = TRUE;
		$data['url'] = $this->redirect;
        $data['access'] = $this->access;
     	return $this->template->load('admin/template',$this->redirect.'/home', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('admin/DeliveryBoyModel');
        $sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)
        {  
            $sub_array = array();  
            $sub_array[] = $sr;
            $sub_array[] = ucfirst($row->fullname);
            $sub_array[] = $row->mobile;
            $sub_array[] = ucfirst($row->address);

            $sub_array[] = '<div class="ml-0 table-display row">
                    <a class="btn btn-outline-info mr-2" href="'.base_url($this->redirect.'/view/'.e_id($row->id)).'"><i class="text-info fa fa-eye"></i></a>
                    <a class="btn btn-outline-primary mr-2" href="'.base_url($this->redirect.'/update/'.e_id($row->id)).'"><i class="text-primary fa fa-edit"></i></a>
                    <form action="'.base_url($this->redirect.'/delete').'" method="POST" >
                        <input type="hidden" name="id" value="'.e_id($row->id).'">
                        <button class="delete btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </div>';

            $data[] = $sub_array;
            $sr++;
        }

        $output = array(  
            "draw"              =>     intval($_POST["draw"]),  
            "recordsTotal"      =>     $this->main->count($this->table, ['is_deleted'=>0]),  
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/DeliveryBoyModel'),  
            "data"              =>     $data
        );
        
        echo json_encode($output);
    }

    public function add()
    {
        $data['name'] = $this->name;
        $data['operation'] = "add";
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        
        $this->form_validation->set_rules($this->validate);
        
        if ($this->form_validation->run() == FALSE) {
            return $this->template->load('admin/template', $this->redirect.'/add', $data);
        }else{
            $post = [
                    "fullname" => $this->input->post("fullname"),
                    "mobile"   => $this->input->post("mobile"),
                    "address"  => $this->input->post("address"),
                    "password" => my_crypt($this->input->post("password"))
                ];

            $id = $this->main->add($post, $this->table);

            flashMsg(
                $id, ucwords($this->name).' Added Successfully.', ucwords($this->name).' Not Added, Please Try Again.', $this->redirect
            );
        }
    }

    public function view($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "view";
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table, 'fullname, mobile, address', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/view', $data);
    }

    public function edit($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "update";
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        $data['ignore'] = TRUE;
        $data['data'] = $this->main->get($this->table, 'id,fullname,mobile,address', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/update', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE) {
            return $this->edit($id);
        }else{
            
            $post = [
                "fullname" => $this->input->post("fullname"),
                "mobile"   => $this->input->post("mobile"),
                "address"  => $this->input->post("address")
            ];
            if (!empty($this->input->post("password"))) $post['password'] = my_crypt($this->input->post("password"));
        	
        	
	        $id = $this->main->update(['id'=>d_id($id)], $post,$this->table);
	        
	        flashMsg(
	            $id, ucwords($this->name).' Updated Successfully.', ucwords($this->name).' Not Updated, Please Try Again.', $this->redirect
	            );
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $id = $this->main->update(['id'=>d_id($id)], ['is_deleted' => 1], $this->table);
            
        flashMsg(
                $id, ucwords($this->name).' Deleted Successfully.', ucwords($this->name).' Not Deleted, Please Try Again.', $this->redirect
                );
    }
}