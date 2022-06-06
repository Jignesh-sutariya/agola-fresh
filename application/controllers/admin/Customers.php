<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'customers';
	private $access = 'customers';
	private $table = 'customers';
	private $redirect = 'admin/customers';

	public function index()
	{	
		$data['name'] = $this->name;
		$data['datatable'] = TRUE;
		$data['url'] = $this->redirect;
        $data['access'] = $this->access;
        $data['cust_type'] = $this->main->getall('customer_type', 'id, cust_type', ['is_deleted' => 0]);

     	return $this->template->load('admin/template',$this->redirect.'/home', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('admin/CustomerModel');
        $sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)
        {  
            $sub_array = array();  
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->fullname);
            $sub_array[] = $row->mobile;
            if ($row->cust_type) {
                $sub_array[] = ucwords($row->cust_type);
            }else{
                $sub_array[] = "Retailer";
            }
            
            if ($row->is_approved) 
            	$sub_array[] = '<form action="'.base_url($this->redirect.'/approve').'" method="POST" >
                        <input type="hidden" name="id" value="'.e_id($row->id).'">
                        <input type="hidden" name="approve" value="0">
                        <button class="btn btn-outline-danger">Block</button>
                    </form>';
            else
            	$sub_array[] = '<form action="'.base_url($this->redirect.'/approve').'" method="POST" >
                        <input type="hidden" name="id" value="'.e_id($row->id).'">
                        <input type="hidden" name="approve" value="1">
                        <button class="btn btn-outline-success">Approve</button>
                    </form>';

            $sub_array[] = '<div class="ml-0 table-display row">
                    <a class="btn btn-outline-info mr-2" href="'.base_url($this->redirect.'/view/'.e_id($row->id)).'"><i class="text-info fa fa-eye"></i></a>
                    <form action="'.base_url($this->redirect.'/delete').'" method="POST" >
                        <input type="hidden" name="id" value="'.e_id($row->id).'">
                        <button class="delete btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </div>';

            $data[] = $sub_array;
            $sr++;
        }

        if ($_POST['cust_type']) {
            $where = ['is_deleted' => 0, 'cust_type' => $_POST['cust_type']];
        }else{
        	$where = ['is_deleted' => 0];
        }

        $output = array(  
            "draw"              =>     intval($_POST["draw"]),  
            "recordsTotal"      =>     $this->main->count($this->table, $where),  
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/CustomerModel'),  
            "data"              =>     $data
        );
        
        echo json_encode($output);
    }

    public function view($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "view";
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table.' u', 'fullname,mobile, password, address', ['u.id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/view', $data);
    }

    public function approve()
    {
        $id = $this->input->post('id');
        $approve = $this->input->post('approve');
        
        $id = $this->main->update(['id'=>d_id($id)], ['is_approved' => $approve], $this->table);
            
        flashMsg(
            $id, ucwords($this->name).' Status Changed Successfully.', ucwords($this->name).' Not Status Changed, Please Try Again.', $this->redirect
        );
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