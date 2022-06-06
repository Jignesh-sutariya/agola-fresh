<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'category';
	private $access = 'category';
	private $table = 'category';
	private $redirect = 'admin/category';

	public $validate = [
            [
                'field' => 'category',
                'label' => 'Category Name',
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
        $fetch_data = $this->main->make_datatables('admin/CategoryModel');
        $sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)
        {  
            $sub_array = array();  
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->category);
            $sub_array[] = '<img src="'.images('category/'.$row->image).'" height="50" width="100">';

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
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/CategoryModel'),  
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
        if ($this->form_validation->run() == FALSE || empty($_FILES['image']['name'])) {
            return $this->template->load('admin/template',$this->redirect.'/add', $data);
        }else{
            $image = $this->image_upload();
            if (!$image['upload']) {
                return $this->template->load('admin/template',$this->redirect.'/add', $data);
            }else{
                $post = [
                    "category" => $this->input->post("category"),
                    "slug"     => strtolower($this->input->post("category")),
                    "image"    => $image['success']
                ];
                $id = $this->main->add($post, $this->table);

                flashMsg(
                    $id, ucwords($this->name).' Added Successfully.', ucwords($this->name).' Not Added, Please Try Again.', $this->redirect
                );
            }
        }
    }

    protected function image_upload()
    {
        $config = [
                'upload_path'   => "./assets/images/category/",
                'allowed_types' => 'jpg|jpeg|png'
            ];

        $this->upload->initialize($config);
        
        $extn = explode("/", strtolower($_FILES['image']['type']));
        $image = $this->input->post('category').'.'.$extn[1];
        $_FILES['image']['name'] = $image;

        if (!$this->upload->do_upload("image")) { 
            
            $return = [
                'upload'=> false
            ];

            return $return;
        }else{
            $data = $this->upload->data();

            $configer =  [
                'image_library'   => 'gd2',
                'source_image'    =>  $data['full_path'],
                'maintain_ratio'  =>  TRUE,
                'width'           =>  350,
                'height'          =>  250,
            ];

            $this->load->library('image_lib');
            $this->image_lib->clear();
            $this->image_lib->initialize($configer);
            $this->image_lib->resize();

            $return = [
                'upload'  => true,
                'success' => $data["file_name"]
            ];

            return $return;
        }
    }

    public function view($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "view";
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table, 'category,image', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/view', $data);
    }

    public function edit($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "update";
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        $data['ignore'] = TRUE;
        $data['data'] = $this->main->get($this->table, 'id,category,image', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/update', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE) {
            return $this->edit($id);
        }else{
            if (empty($_FILES['image']['name'])) {
                $post = [
                    "category" => $this->input->post("category"),
                    "slug"     => strtolower($this->input->post("category"))
                ];
            }else{
                $image = $this->image_upload();
                if (!$image['upload']) {
                    return $this->edit($id);
                }else{
                    unlink("./assets/images/category/".$this->input->post("image"));
                    $post = [
                        "category" => $this->input->post("category"),
                        "image"    => $image['success']
                    ];
                }
            }
            
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