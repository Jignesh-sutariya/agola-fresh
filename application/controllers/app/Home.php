<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if (!$this->agent->is_mobile() && ENVIRONMENT == 'production') die();
	}

	private $table = 'products';
	private $api = '';
	
	public function index()
	{
		$data['banners'] = $this->main->getall('banner', "CONCAT('".images('banner/')."', banner) banner,title,sub_title");
		
		$data['products'] = $this->main->getall('products', "id,eng_name,guj_name,min_qty,qty_type,CONCAT('₹ ', price) price,CONCAT('".images('products/')."', image) image",['is_deleted' => 0], '', '', '', 8);
		
        return $this->template->load('app/template','app/home', $data);
	}

	public function shop()
	{
		$this->load->model("AppModel", 'products');
		$this->load->library("pagination");
		
		if (!empty($this->input->get('category'))) {
        	$url = app() . "shop?category=" . $_GET['category'];
       		$category = $_GET['category'];
        }else{
        	$url = app() . "shop";
        	$category = "";
        }
		
		$config =	[
						"base_url"			 => $url,
						"total_rows"		 => $this->products->count_all($category),
						"per_page"			 => 100,
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
						"cur_tag_open"		 => "<li class='active'><a href='javascript:void(0)'>",
						"cur_tag_close"		 => "</a></li>",
						"num_tag_open"		 => "<li>",
						"num_tag_close"		 => "</li>",
						'first_link'		 => "First",
						'last_link'			 => "Last",
						"num_links"			 => 1,
						"enable_query_strings"=>TRUE,
						"page_query_string" => TRUE
					];

		$this->pagination->initialize($config);
		$page = (isset($_GET['per_page'])) ? $_GET['per_page'] : 0;
		$products = array(
			'pagination_link'  => $this->pagination->create_links(),
			'products'   => $this->products->fetch_details($config["per_page"], $page, $category)
		);

		return $this->template->load('app/template','app/shop', $products);
	}

	public function error_404()
	{
		$data['name'] = "404 Not Found";
		$data['title'] = "404 Not Found";
		return $this->template->load('app/template','app/error_404', $data);
	}

	public function contact()
	{
		if ($this->input->method() == "get") {
			return $this->template->load('app/template','app/contact');
		}else{
			$post = [
        		'name' => $this->input->post('name'),
        		'email' => $this->input->post('email'),
        		'subject' => $this->input->post('subject'),
        		'message' => $this->input->post('message')
        	];
        	
        	$id = $this->main->add($post, "contact");

        	if ($id) {
        		$return = [
	        		'error'   => FALSE,
	        		'message' => "Message Saved Successful"
	        	];
	        	echo json_encode($return);
        	}else{
        		$return = [
	        		'error'   => TRUE,
	        		'message' => "Message Not Saved"
	        	];
	        	 echo json_encode($return);
        	}
		}
	}

	public function single_product()
	{
		$id = $this->uri->segment(3);

		$data['product'] = $this->main->get($this->table, "id, prod_details, CONCAT('".images('products/')."', image) image,CONCAT('₹ ', price) price,".ucwords('eng_name')." eng_name,guj_name,min_qty, qty_type", ['id' => $id]);

		$data['qty'] = $this->main->check('cart',['prod_id' => $id, 'cust_id' => $this->api], 'qty');
		
		if ($data['product']) {
			return $this->template->load('app/template','app/single_product', $data);
		}else{
			return $this->template->load('app/template','app/product_not_found', $data);
		}
	}
}