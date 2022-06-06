<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if (!$this->agent->is_mobile() && ENVIRONMENT == 'production') die();
		$this->api = $this->session->userdata('cust_id');
	}

	private $table = 'products';
	private $api = '';

	public function index()
	{
		$this->api = app_auth();
		$data['orders'] = $this->main->getall("orders", 'payment_id,created_at,status,id',['user_id' => $this->api]);
        return $this->template->load('app/template','app/dashboard', $data);
	}

	public function view($id)
	{
		$this->api = app_auth();
        $order = $this->main->get("orders", 'payment_id,id,total_amount,created_at,status,payment_status, order_details', ['id' => $id]);
        foreach (json_decode($order['order_details']) as $k => $v) {
        	$order['prods'][$k] = $v;
        	$order['prods'][$k]->image = images('products/') . $v->image;
        }
        $data['order'] = $order;
        
        return $this->template->load('app/template','app/order', $data);
	}

	public function add_cart()
	{
		if (empty($this->session->userdata('cust_id'))) {
		    echo json_encode(['message' => 'Please Login First']);
			die();
		}else{
			$get = [
				'prod_id' => $this->input->get('prod_id'),
				'qty'     => (!empty($this->input->get('qty'))) ? $this->input->get('qty') : 1,
				'cust_id' => $this->api
			];

			$id = $this->main->get('cart', 'prod_id,cust_id', ['prod_id' => $get['prod_id'], 'cust_id' => $this->api]);
			if (!$id) {
				$this->main->add($get, "cart");
				$count = $this->main->count('cart', ['cust_id' => $this->api]);
				$total = $this->main->total();
				$return = [
					'count'   => $count,
					'total'   => '₹ '.$total,
				    'message' => 'Product Added To Cart.'
				];
				echo json_encode($return);
			}else{
				$id = $this->main->update($id, $get, "cart");
				$count = $this->main->count('cart', ['cust_id' => $this->api]);
				$total = $this->main->total();
				$return = [
					'count'   => $count,
					'total'   => '₹ '.$total,
				    'message' => 'Cart Updated'
				];
				echo json_encode($return);
			}
		}
	}

	public function add_wishlist($id)
	{if (empty($this->session->userdata('cust_id'))) {
		    echo json_encode(['message' => 'Please Login First']);
			die();
			}else{
			$get = [
				'prod_id' => $id,
				'cust_id' => $this->api
			];

			$id = $this->main->check('wish_list', $get, 'prod_id');
			
			if (!$id) {
				$this->main->add($get, "wish_list");
				$return = [
				    'message' => 'Product Added To Wishlist.'
				];
			}else{
				$this->main->delete($get, "wish_list");
				$return = [
				    'message' => 'Product Removed From Wishlist'
				];
			}
			echo json_encode($return);
		}
	}

	public function cart()
	{
		$this->api = app_auth();
		$data['cart'] = $this->main->cart();
		$data['total'] = $this->main->total();

		return $this->template->load('app/template','app/cart', $data);
	}

	public function delete_product($id)
	{
		if (empty($this->session->userdata('cust_id'))) {
		    echo json_encode(['message' => 'Please Login First']);
			die();
			}else{
			$get = [
				'prod_id' => $id,
				'cust_id' => $this->api
			];

			$id = $this->main->delete($get, 'cart');

			if ($id) {
				$count = $this->main->count('cart', ['cust_id' => $this->api]);
				$total = $this->main->total();

				$return = [
					'count'   => $count,
					'total'   => '₹ '.$total,
				    'message' => 'Product Deleted From Cart.'
				];
				echo json_encode($return);
			}else{
				$count = $this->main->count('cart', ['cust_id' => $this->api]);
				$total = $this->main->total();
				$return = [
					'count'   => $count,
					'total'   => '₹ '.$total,
				    'message' => 'Product Not Deleted.'
				];
				echo json_encode($return);
			}
		}
	}

	public function remove_wishlist($id)
	{
		$this->api = app_auth();
		$get = [
			'prod_id' => $id,
			'cust_id' => $this->api
		];

		$id = $this->main->delete($get, 'wish_list');

		$alert['alert'][] = "Product Removed From Wish List";
		$this->session->set_flashdata($alert);
		return redirect('app/wish-list');
	}

	public function wish_list()
	{
		$this->api = app_auth();
		$data['wishlist'] = $this->main->wishlist();

		return $this->template->load('app/template','app/wishlist', $data);
	}

	public function logout()
	{
		$this->api = app_auth();
		$this->session->sess_destroy();
		return redirect('app/login');
	}
}