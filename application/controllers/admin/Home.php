<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'dashboard';
	private $icon = 'fa-home';
	private $table = 'orders';

	public function index()
	{	
		$data['name'] = $this->name;
		$data['url'] = 'dashboard';
		$data['datatable'] = TRUE;
		$data['cust_type'] = $this->main->getall("customer_type", 'id, cust_type', ['is_deleted' => 0]);
		$data['products'] = $this->main->getall('products', 'id, eng_name, guj_name, price, qty_type,min_qty', ['is_deleted' => 0]);
		
        $this->template->load('admin/template','admin/dashboard', $data);
	}

	public function update_price()
	{	
		$name = $this->input->post('name');
		if ($name === 'price') {
			$this->main->update(['id' => d_id($this->input->post('pk'))], ['price' => $this->input->post('value')], "products");
		}else{
			$prod = explode("_", $name);

			$post = [
	            'prod_id'      => d_id($this->input->post('pk')),
	            'wholesale_id' => d_id($prod[1])
	        ];

	        $check = $this->main->get("product_price", 'prod_id, min_qty, qty_type, wholesale_id', $post);

	        $post['price'] = $this->input->post('value');
	        $post['min_qty'] = ($check['min_qty']) ? $check['min_qty'] : "1";
	        $post['qty_type'] = ($check['qty_type']) ? $check['qty_type'] : "kg";
	        
	        if ($post['price'] > 0) {
		        if ($check)
		           $this->main->update($check, $post, "product_price");
		        else
		            $this->main->add($post, "product_price");
	        }
	        
		}
	}

	public function error_404()
	{	
		$data['name'] = "404 - Page Not Found";
		$this->template->load('admin/template','admin/error_404', $data);
	}
}