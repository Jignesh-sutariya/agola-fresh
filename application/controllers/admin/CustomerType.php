<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerType extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'customer type';
	private $access = 'customerType';
	private $table = 'customer_type';
	private $redirect = 'admin/customerType';

	public $validate = [
            [
                'field' => 'cust_type',
                'label' => 'Customer Type',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ]
    ];

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
        $fetch_data = $this->main->make_datatables('admin/CustomerTypeModel');
        $sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)
        {  
            $sub_array = array();  
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->cust_type);

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
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/CustomerTypeModel'),  
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
            return $this->template->load('admin/template',$this->redirect.'/add', $data);
        }else{
            $post = [
                "cust_type" => $this->input->post("cust_type")
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
        $data['data'] = $this->main->get($this->table, 'cust_type', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/view', $data);
    }

    public function edit($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "update";
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        
        $data['data'] = $this->main->get($this->table, 'id,cust_type', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/update', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE) {
            return $this->edit($id);
        }else{
            
            $post = [
                "cust_type" => $this->input->post("cust_type")
            ];
            
            $id = $this->main->update(['id'=>d_id($id)], $post, $this->table);
            
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