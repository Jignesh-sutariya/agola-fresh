<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'banner';
	private $access = 'banner';
	private $table = 'banner';
	private $redirect = 'admin/banner';

	public $validate = [
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'sub_title',
                'label' => 'Sub Title',
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
        $fetch_data = $this->main->make_datatables('admin/BannerModel');
        $sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)
        {  
            $sub_array = array();  
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->title);
            $sub_array[] = ucwords($row->sub_title);
            $sub_array[] = '<img src="'.images('banner/'.$row->banner).'" height="50" width="100">';

            $sub_array[] = '<div class="ml-0 table-display row">
                    <a class="btn btn-outline-info mr-2" href="'.base_url($this->redirect.'/view/'.e_id($row->id)).'"><i class="text-info fa fa-eye"></i></a>
                    <a class="btn btn-outline-primary mr-2" href="'.base_url($this->redirect.'/update/'.e_id($row->id)).'"><i class="text-primary fa fa-edit"></i></a>
                    <form action="'.base_url($this->redirect.'/delete').'" method="POST" >
                        <input type="hidden" name="id" value="'.e_id($row->id).'">
                        <input type="hidden" name="banner" value="'.$row->banner.'">
                        <button class="delete btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </div>';

            $data[] = $sub_array;
            $sr++;
        }

        $output = array(  
            "draw"              =>     intval($_POST["draw"]),  
            "recordsTotal"      =>     $this->main->all($this->table),
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/BannerModel'),  
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
                    "title"     => $this->input->post("title"),
                    "sub_title" => $this->input->post("sub_title"),
                    "banner"     => $image['success']
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
                'upload_path'   => "./assets/images/banner/",
                'allowed_types' => 'jpg|jpeg|png'
            ];

        $this->upload->initialize($config);
        
        $extn = explode("/", strtolower($_FILES['image']['type']));
        $image = rand(1, 999).'.'.$extn[1];
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
                'width'           =>  1349,
                'height'          =>  650,
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
        $data['data'] = $this->main->get($this->table, 'banner,title, sub_title', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/view', $data);
    }

    public function edit($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "update";
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        $data['ignore'] = TRUE;
        $data['data'] = $this->main->get($this->table, 'id,banner,title, sub_title', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/update', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE) {
            return $this->edit($id);
        }else{
            $post = [
                    "title"     => $this->input->post("title"),
                    "sub_title" => $this->input->post("sub_title")
                ];

            if (!empty($_FILES['image']['name'])) {
                $image = $this->image_upload();
                if (!$image['upload']) {
                    return $this->edit($id);
                }else{
                    unlink("./assets/images/banner/".$this->input->post("image"));
                    $post["banner"] = $image['success'];
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
        $banner = $this->input->post('banner');
        
        $id = $this->main->delete(['id'=>d_id($id)], $this->table);
        
        if ($id) unlink("./assets/images/banner/".$banner);
        
        flashMsg(
                $id, ucwords($this->name).' Deleted Successfully.', ucwords($this->name).' Not Deleted, Please Try Again.', $this->redirect
                );
    }
}