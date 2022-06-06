<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AddCart extends CI_Controller {

	private $api;

	public function __construct()
	{
		parent::__construct();
		$this->api = $this->session->userdata('user_id');
		$this->load->model('ProductsModel', 'product');
	}

	public function cart()
	{
		$data['name'] = "cart list";
		$data['title'] = "cart list";

		/*$data['cart'] = $this->product->cart($this->api);
		
		if (!$this->api) {
			$cart = (array) json_decode(get_cookie('cart'));
			foreach ($data['cart'] as $k => $v) {

				if (array_key_exists(e_id($v->id), $cart)) {
					$data['cart'][$k]->qty = $cart[e_id($v->id)];
				}
			}
		}*/

		return $this->template->load('front/template','front/cart', $data);
	}

	public function add_to_cart()
	{
		if (!$this->input->is_ajax_request()) {
		   return error_404();
		}else{
			$prod_id = $this->input->post('id');
			$qty = (int) $this->input->post('qty');
			$qty = ($qty) ? $qty : 1;
			
			$product = $this->main->get("products", "slug, CONCAT('".images('products/')."', image) image,CONCAT('₹ ', price) price,".ucwords('eng_name')." eng_name,guj_name,min_qty, qty_type", ['id' => d_id($prod_id)]);
			if (empty($this->api)){
				$cart = (array) json_decode(get_cookie('cart'));
				$cart[$prod_id] = $qty;

				set_cookie('cart', json_encode($cart), (10 * 365 * 24 * 60 * 60), $_SERVER['HTTP_HOST'], '/', FALSE);
				
				$return = [
					'error'   => FALSE,
					'count'   => count($cart),
				    'message' => '<div class="notification"><h3 class="notification-title"><a href="'.base_url('cart').'">Added to cart</a></h3><div class="media-object margin-0"><div class="media-object-section"><div class="img-thumbnail"><a href="'.base_url('single-product/'.$product['slug'].'/'.$prod_id).'" class="product-image"> <img src="'.$product['image'].'" alt="'.$product['eng_name'].'" class="notification-image"></a></div></div><div class="media-object-section"><h4 class="notification-product-title"><a href="'.base_url('cart').'">'.$product['eng_name'].'<br><br> '.$product['guj_name'].'</a></h4><div class="notification-product-price">'.$product['price'].'</div><div class="notification-link"><a href="'.base_url('cart').'">My shopping Cart</a></div></div></div></div>'
				];
	        	echo json_encode($return);
			}else{
				$post = [
					'prod_id' => d_id($prod_id),
					'cust_id' => $this->api
				];

				$id = $this->main->check('cart', $post, 'prod_id');
				$post['qty'] = $qty;
				
				if (!$id) {
					$this->main->add($post, "cart");
					$count = $this->main->count('cart', $post = ['cust_id' => $this->api]);
					$return = [
						'error'   => FALSE,
						'count'   => $count,
					    'message' => '<div class="notification"><h3 class="notification-title"><a href="'.base_url('cart').'">Added to cart</a></h3><div class="media-object margin-0"><div class="media-object-section"><div class="img-thumbnail"><a href="'.base_url('single-product/'.$product['slug'].'/'.$prod_id).'" class="product-image"> <img src="'.$product['image'].'" alt="'.$product['eng_name'].'" class="notification-image"></a></div></div><div class="media-object-section"><h4 class="notification-product-title"><a href="'.base_url('cart').'">'.$product['eng_name'].'<br><br> '.$product['guj_name'].'</a></h4><div class="notification-product-price">'.$product['price'].'</div><div class="notification-link"><a href="'.base_url('cart').'">My shopping Cart</a></div></div></div></div>'
					];
				}else{
					$this->main->update(['prod_id' => d_id($this->input->post('id')), 'cust_id' => $this->api], $post, "cart");
					$count = $this->main->count('cart', $post = ['cust_id' => $this->api]);
					$return = [
						'error'   => FALSE,
						'count'   => $count,
					    'message' => 'Product Cart Updated.'
					];
				}

	        	echo json_encode($return);
			}
		}
	}

	public function shop_cart()
	{
		if (!$this->input->is_ajax_request()) 
		   return error_404();
		else{
			if (empty($this->api)){
				$response = $this->product->cart($this->api);
			}else{
				$response = $this->product->cart($this->api);
			}
			
			foreach ($response as $k => $v) {
				$response[$k]->id = e_id($v->id);
				$response[$k]->slug = base_url('single-product/').$v->slug.'/'.$v->id;
			}
			
			echo json_encode($response);
		}
	}

	public function remove_product()
	{
		if (!$this->input->is_ajax_request()) {
		   return error_404();
		}else{
			if (empty($this->api)){
				$prod_id = $this->input->post('id');

				$cart = (array) json_decode(get_cookie('cart'));
				unset($cart[$prod_id]);
				
				set_cookie('cart', json_encode($cart), (10 * 365 * 24 * 60 * 60), $_SERVER['HTTP_HOST'], '/', FALSE);
				
				$return = [
					'error'   => FALSE,
				    'redirect' => base_url('cart'),
				    'message' => 'Product Removed From Cart'
				];
	        	
			}else{

				$post = [
					'prod_id' => d_id($this->input->post('id')),
					'cust_id' => $this->api
				];
				
				$this->main->delete($post, "cart");
				$return = [
					'error'   => FALSE,
					'redirect' => base_url('cart'),
				    'message' => 'Product Removed From Cart'
				];
			}
	        echo json_encode($return);
		}
	}

	public function add_to_wishlist()
	{
		if (!$this->input->is_ajax_request()) {
		   return error_404();
		}else{
			if (empty($this->api)){
				$return = [
	        		'error'   => TRUE,
	        		'message' => "Please Login First."
	        	];
	        	 echo json_encode($return);
			}else{
				$post = [
					'prod_id' => d_id($this->input->post('id')),
					'cust_id' => $this->api
				];

				$id = $this->main->check('wish_list', $post, 'prod_id');
				
				if (!$id) {
					$this->main->add($post, "wish_list");
					$return = [
						'error'   => FALSE,
					    'message' => 'Product Added To Wishlist.'
					];
				}else{
					$this->main->delete($post, "wish_list");
					$return = [
						'error'   => FALSE,
					    'message' => 'Product Removed From Wishlist'
					];
				}

	        	echo json_encode($return);
			}
		}
	}

	public function remove_wishlist()
	{
		if (!$this->input->is_ajax_request()) {
		   return error_404();
		}else{
			if (empty($this->api)){
				$return = [
	        		'error'   => TRUE,
	        		'message' => "Please Login First."
	        	];
	        	 echo json_encode($return);
			}else{
				$post = [
					'prod_id' => d_id($this->input->post('id')),
					'cust_id' => $this->api
				];
				
				$this->main->delete($post, "wish_list");
				$return = [
					'error'   => FALSE,
					'redirect' => base_url('wishlist'),
				    'message' => 'Product Removed From Wishlist'
				];

	        	echo json_encode($return);
			}
		}
	}
}