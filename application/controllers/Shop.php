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
		$data['cat'] = $this->input->get('category');
		$data['categories'] = $this->main->getall('category', "slug, category, id", ['is_deleted' => 0], '','category ASC');
		
        return $this->template->load('front/template','front/shop', $data);
	}

	public function products()
	{
		$this->load->model("ProductsModel", 'products');
		$this->load->library("pagination");
		$per_page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 20;
		$category = $this->uri->segment(5);
		$config =	[
						"base_url"			 => base_url(),
						"total_rows"		 => $this->products->count_all($category),
						"per_page"			 => $per_page,
						"uri_segment"		 => 3,
						"use_page_numbers"	 => TRUE,
						"full_tag_open"		 => '<ul class="pagination">',
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
						'attributes' 		 => ['data-id' => $category, 'data-page' => $per_page]
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
			'showing'   => "",
			'products'   => $prods
		);

		echo json_encode($output);
	}

	public function single_product()
	{
		$id = d_id($this->uri->segment(3));
		$data['product'] = $this->main->get($this->table, "id, slug, CONCAT('".images('products/')."', image) image,CONCAT('₹ ', price) price,".ucwords('eng_name')." eng_name,guj_name,min_qty, qty_type", ['id' => $id, 'out_stock' => 0]);
		$data['shop'] = TRUE;
		
		/*if ($this->api) {
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
		}*/
		
		if ($data['product']) {
			$data['name'] = $data['product']['eng_name'];
			$data['title'] = $data['product']['eng_name'];
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

	public function search()
	{
		$this->load->model('ProductsModel', 'products');
		$return = $this->products->search($this->input->get('search'));
		foreach ($return as $k => $v) {
			$return[$k]->slug = base_url('/single-product/').$v->slug.'/'.e_id($v->id);
			$return[$k]->id = e_id($v->id);
		}
		echo json_encode($return);
	}
}