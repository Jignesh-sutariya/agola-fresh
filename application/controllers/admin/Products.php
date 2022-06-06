<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'products';
	private $access = 'products';
	private $table = 'products';
	private $redirect = 'admin/products';

	public $validate = [
            [
                'field' => 'eng_name',
                'label' => 'Product Name (English)',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'guj_name',
                'label' => 'Product Name (Gujarati)',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'category_id',
                'label' => 'Category Name',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'qty_type',
                'label' => 'Quantity Type',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'min_qty',
                'label' => 'Minimum Quantity',
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
        $data['validation'] = TRUE;
		$data['url'] = $this->redirect;
        $data['access'] = $this->access;
        $data['cust_type'] = $this->main->getall("customer_type", 'id, cust_type', ['is_deleted' => 0]);
        $data['products'] = $this->main->getall($this->table, 'id, eng_name, guj_name, price, qty_type', ['is_deleted' => 0]);
        
        /*$prods = $this->main->getall("products", 'id, price,min_qty', ['is_deleted' => 0]);
        foreach ($data['cust_type'] as $key => $v) {
            foreach ($prods as $key => $va) {
                $post = [
                    'prod_id'      => $va['id'],
                    'wholesale_id' => $v['id']
                ];

                $post['price'] = $va['price'];
                $post['min_qty'] = $va['min_qty'];
                $post['qty_type'] = "kg";
                
                $this->main->add($post, "product_price");
            }
        }*/
     	return $this->template->load('admin/template',$this->redirect.'/home', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('admin/ProductModel');
        $sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)
        {  
            $sub_array = array();  
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->eng_name)." (".$row->guj_name.")";
            $sub_array[] = "₹ ".$row->price;
            $sub_array[] = $row->min_qty." (".ucfirst($row->qty_type).")";
            $sub_array[] = ucwords($row->category);
            $sub_array[] = '<img src="'.images('products/'.$row->image).'" height="50" width="100">';
            
            $checked = (!$row->out_stock) ? 'checked=""' : '';
            $value = ($row->out_stock) ? 0 : 1;
            
            $sub_array[] = '<div class="icheck-primary">
                        <input type="checkbox" name="prod-status" id="'.e_id($row->id).'" '.$checked.' value="'.$value.'" class="prod-status">
                        <label for="'.e_id($row->id).'">
                        </label>
                      </div>';

            $sub_array[] = '<div class="ml-0 table-display row">
                    <button onclick="resetForm('.e_id($row->id).')" type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"><i class="text-primary fa fa-rupee-sign"></i></button>
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
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/ProductModel'),  
            "data"              =>     $data
        );
        
        echo json_encode($output);
    }

    public function create()
    {
        $data['name'] = $this->name;
        $data['operation'] = "add";
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        $data['category'] = $this->main->getall('category', 'id, category', ['is_deleted' => 0]);

        return $this->template->load('admin/template',$this->redirect.'/add', $data);
    }    

    public function add()
    {
        $data['name'] = $this->name;
        $data['operation'] = "add";
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE || empty($_FILES['image']['name'])) {
            return $this->create();
        }else{
            $image = $this->image_upload();
            if (!$image['upload']) {
                return $this->create();
            }else{

                $post = [
                    'eng_name' => $this->input->post('eng_name'),
                    'guj_name' => $this->input->post('guj_name'),
                    'min_qty'  => $this->input->post('min_qty'),
                    'qty_type' => $this->input->post('qty_type'),
                    'price'    => $this->input->post('price'),
                    'image'    => $image['success'],
                    'cat_id'   => $this->input->post('category_id'),
                    "slug"     => strtolower(str_replace(" ", "-", $this->input->post("eng_name")))
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
                'upload_path'   => "./assets/images/products/",
                'allowed_types' => 'jpg|jpeg|png'
            ];

        $this->upload->initialize($config);
        
        $extn = explode("/", strtolower($_FILES['image']['type']));
        $image = $this->input->post('eng_name').'.'.$extn[1];
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
                'width'           =>  1000,
                'height'          =>  800,
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
        $this->load->model('admin/ProductModel', 'product');
        $data['name'] = $this->name;
        $data['operation'] = "view";
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table.' u', 'eng_name, guj_name, min_qty, qty_type, price, u.image, category', ['u.id'=>d_id($id)], ['cat_id' => 'category']);
        $data['prices'] = $this->product->getAllProductPrice(d_id($id));
        
        return $this->template->load('admin/template',$this->redirect.'/view', $data);
    }

    public function edit($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "update";
        $data['url'] = $this->redirect;
        $data['validation'] = TRUE;
        $data['ignore'] = TRUE;
        $data['category'] = $this->main->getall('category', 'id, category', ['is_deleted' => 0]);
        $data['data'] = $this->main->get($this->table, 'id, eng_name, guj_name, min_qty, qty_type, price, image, cat_id', ['id'=>d_id($id)]);
        
        return $this->template->load('admin/template',$this->redirect.'/update', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE) {
            return $this->edit($id);
        }else{
            $post = [
                    'eng_name' => $this->input->post('eng_name'),
                    'guj_name' => $this->input->post('guj_name'),
                    'min_qty'  => $this->input->post('min_qty'),
                    'qty_type' => $this->input->post('qty_type'),
                    'price'    => $this->input->post('price'),
                    'cat_id'   => $this->input->post('category_id'),
                    "slug"     => strtolower(str_replace(" ", "-", $this->input->post("eng_name")))
                ];

            if (!empty($_FILES['image']['name'])) {
                $image = $this->image_upload();
                if (!$image['upload']) {
                    return $this->edit($id);
                }else{
                    /*unlink("./assets/images/products/".$this->input->post("image"));*/
                    $post['image'] = $image['success'];
                }
            }
            
            $id = $this->main->update(['id'=>d_id($id)], $post,$this->table);
            
            flashMsg(
                $id, ucwords($this->name).' Updated Successfully.', ucwords($this->name).' Not Updated, Please Try Again.', $this->redirect
                );
        }
    }

    public function add_price()
    {
        $id = d_id($this->input->post('id'));
        $post = [
            'prod_id'      => $id,
            'wholesale_id' => d_id($this->input->post('wholesale_id'))
        ];

        $check = $this->main->get("product_price", 'prod_id, min_qty, qty_type, wholesale_id', $post);
        $post['price'] = $this->input->post('price');
        $post['min_qty'] = $this->input->post('min_qty');
        $post['qty_type'] = $this->input->post('qty_type');

        if ($check) {
           $id = $this->main->update($check, $post, "product_price");
        }else{
            $this->main->add($post, "product_price");
            $id = 1;
        }

        if ($id) $return = [ 'error'   => false, 'message' => "Price Added." ];
        else $return = [ 'error'   => true, 'message' => "Price Not Added. Try Again." ];

        echo json_encode($return);
    }

    public function change_price()
    {
        $prod = $this->input->post('price');

        foreach ($prod as $k => $v) {
            $id = $this->main->update(['id' => d_id($k)], ['price' => $v], $this->table);
        }
        
        if ($id) $return = [ 'error'   => false, 'message' => "Price Added." ];
        else $return = [ 'error'   => true, 'message' => "Price Not Added. Try Again." ];

        echo json_encode($return);
    }

    public function change_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $sid = $this->main->update(['id'=>d_id($id)], ['out_stock' => $status], $this->table);
        
        if ($sid) {
            $return = ['error' => false, 'message' => ucwords($this->name).' Status Changed Successfully.'];
        }else{
            $return = ['error' => true, 'message' => ucwords($this->name).' Status Not Changed, Please Try Again.'];
        }

        echo json_encode($return);
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