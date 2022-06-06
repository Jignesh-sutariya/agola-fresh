<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->api = $this->session->userdata('user_id');
	}

	private $table = "products";

	public function index()
	{
		$data['name'] = "shop";
		$data['title'] = "shop";
		$data['shop'] = TRUE;
		$data['categories'] = $this->main->getall('category', "CONCAT('".images('category/')."', image) image,category, id", ['is_deleted' => 0], '','category ASC');

		$data['products'] = $this->main->getall('products', "eng_name,guj_name,min_qty,qty_type,CONCAT('₹ ', price) price,CONCAT('".images('products/')."', image) image",['is_deleted' => 0], '','eng_name ASC');
		
        return $this->template->load('front/template','front/shop', $data);
	}

	public function products()
	{
		$this->load->model("ProductsModel", 'products');
		$this->load->library("pagination");
		$category = $this->uri->segment(4);		 
		$config =	[
						"base_url"			 => base_url(),
						"total_rows"		 => $this->products->count_all($category),
						"per_page"			 => 20,
						"uri_segment"		 => 3,
						"use_page_numbers"	 => TRUE,
						"full_tag_open"		 => '<ul>',
						"full_tag_close"	 => '</ul>',
						"first_tag_open"	 => '<li>',
						"first_tag_close"	 => '</li>',
						"last_tag_open"		 => '<li>',
						"last_tag_close"	 => '</li>',
						'next_link'			 => '&gt;',
						"next_tag_open"		 => '<li>',
						"next_tag_close"	 => '</li>',
						"prev_link"			 => "&lt;",
						"prev_tag_open"		 => "<li>",
						"prev_tag_close"	 => "</li>",
						"cur_tag_open"		 => "<li class='active'><a href='#'>",
						"cur_tag_close"		 => "</a></li>",
						"num_tag_open"		 => "<li>",
						"num_tag_close"		 => "</li>",
						'first_link'		 => "First",
						'last_link'			 => "Last",
						"num_links"			 => 1,
						'attributes' 		 => ['data-id' => $category]
					];

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		
		$start = ($page - 1) * $config["per_page"];
		$prods = $this->products->fetch_details($config["per_page"], $start, $category);
		foreach ($prods as $k => $v) {
			$prods[$k]->id = e_id($v->id);
		}
		$output = array(
			'pagination_link'  => $this->pagination->create_links(),
			'products'   => $prods
		);

		echo json_encode($output);
	}

	public function single_product()
	{
		$id = d_id($this->uri->segment(3));
		$data['product'] = $this->main->get($this->table, "id, slug, CONCAT('".images('products/')."', image) image,CONCAT('₹ ', price) price,".ucwords('eng_name')." eng_name,guj_name,min_qty, qty_type", ['id' => $id]);
		$data['shop'] = TRUE;
		
		if ($this->api) {
			$post = [
					'prod_id' => $id,
					'cust_id' => $this->api
				];
				
			$data['qty'] = $this->main->check('cart', $post, 'qty');
		}else{
			$cart = (array) json_decode(get_cookie('cart'));
			if (array_key_exists($this->uri->segment(3), $cart)) {
				$data['qty'] = $cart[$this->uri->segment(3)];
			}
		}
		
		if ($data['product']) {
			$data['name'] = $data['product']['eng_name'];
			$data['title'] = $data['product']['eng_name'].' ('.$data['product']['guj_name'].')';
			return $this->template->load('front/template','front/single_product', $data);
		}else{
			$data['name'] = "Product Not Found";
			$data['title'] = "Product Not Found";
			return $this->template->load('front/template','front/product_not_found', $data);
		}
	}

	public function view_product($id)
	{
		$product = $this->main->get($this->table, "slug, CONCAT('".images('products/')."', image) image,CONCAT('₹ ', price) price,".ucwords('eng_name')." eng_name,guj_name,min_qty, qty_type", ['id' => d_id($id)]);

		if ($product) {
			$product['id'] = $id;
			$return = [
				'status' => true,
				'product' => $product
			];
		}else{
			$return = [
				'status' => false,
				'message' => "Product Not Found."
			];
		}

		echo json_encode($return);
	}
}