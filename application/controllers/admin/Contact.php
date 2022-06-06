<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'contact message';
	private $access = 'contact';
	private $table = 'contact';
	private $redirect = 'admin/contact';

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
        $fetch_data = $this->main->make_datatables('admin/ContactModel');
        $sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)
        {  
            $sub_array = array();  
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->name);
            $sub_array[] = $row->email;
            $sub_array[] = ucfirst($row->subject);
            $sub_array[] = ucfirst($row->message);

            $sub_array[] = '<div class="ml-0 table-display row">
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
            "recordsTotal"      =>     $this->main->all($this->table),
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/ContactModel'),  
            "data"              =>     $data
        );
        
        echo json_encode($output);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $id = $this->main->delete(['id'=>d_id($id)], $this->table);
            
        flashMsg(
            $id, ucwords($this->name).' Deleted Successfully.', ucwords($this->name).' Not Deleted, Please Try Again.', $this->redirect
        );
    }
}