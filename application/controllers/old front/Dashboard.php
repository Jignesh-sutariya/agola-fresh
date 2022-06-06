<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private $api;
	
	public function __construct()
	{
		parent::__construct();
		$this->api = front_auth();
		$this->load->model('ProductsModel', 'product');
	}


	public function index()
	{
		$this->my_orders();
	}

	public function wishlist()
	{
		
		$data['name'] = "wish list";
		$data['title'] = "wish list";
		$data['wishlist'] = $this->product->wishlist($this->api);
		
		return $this->template->load('front/template','front/wishlist', $data);
	}

	public function checkout()
	{
		$data['name'] = "checkout";
		$data['title'] = "checkout";
		$data['total'] = $this->product->total($this->api);
		
		return $this->template->load('front/template','front/checkout', $data);
	}

	public function checkout_post()
	{
		$cart = $this->product->cart($this->api);
		if (!$cart) {
    		$response = array('message' => 'Your Cart is Empty', 'status' => false);
    	}else{
    		foreach ($cart as $k => $v) {
    			$img = explode("/", $v->image);
    			$cart[$k]->image = end($img);
    			$cart[$k]->prod_id = $v->id;
	    	}
    		
    		$total = $this->product->total($this->api);

	    	if ($this->input->post('payment_id') != 'cash') {
		    	$payment[] = [
	                'payment_id'  => $this->input->post('payment_id'),
	                'amount'      => $total,
	                'created_at'  => date('d-m-Y H:i:s'),
	            ];
	    	}else{
	    		$payment = "";
	    	}

            $data = [
                'user_id'          => $this->api,
                'payment_id'       => ($payment != '') ? json_encode($payment) : '',
                'total_amount'     => $total,
                'delivery_address' => $this->input->post('address'),
                'pending_amount'   => ($this->input->post('payment_id') != 'cash') ? 0 : $total,
                'order_details'    => json_encode($cart),
                'created_at'       => date('d-m-Y H:i:s'),
                'status'           => "pending",
                'del_date'		   => date('Y-m-d', strtotime($this->input->post('del_date'))),
                'del_time'		   => $this->input->post('del_time'),
                'payment_status'   => ($this->input->post('payment_id') != 'cash') ? "completed" : "pending"
            ];
		    
		    $id = $this->main->add($data, "orders");
	      	
	      	if ($id) {
				$this->main->delete(['cust_id' => $this->api], 'cart');
	      		$response = array('message' => 'Order successfully created.', 'status' => true, 'redirect' => base_url('thankYou'));
	      	}else{
	      		$response = array('message' => 'Order not created. Try Again.', 'status' => false);
	      	}
    	}
		
		echo json_encode($response);
	}

	public function thankYou()
	{
		$data['name'] = "order success";
		$data['title'] = "order success";
		
		return $this->template->load('front/template','front/thankYou', $data);
	}

	public function total()
	{
		$total = $this->product->total($this->api);
		echo json_encode(["total" => $total]);
	}

	public function my_orders()
	{
		$data['name'] = "my orders";
		$data['title'] = "my orders";
		$data['orders'] = $this->product->orders($this->api);
		// re($data);
		return $this->template->load('front/template','front/my_orders', $data);
	}

	public function view_order($id)
	{
		if (!$this->input->is_ajax_request()) return error_404();

		$order = $this->product->order(d_id($id));
			
		if ($order) {
			$order['created_at'] = date("d-m-Y", strtotime($order['created_at']));
			$order['id'] = "AF-".e_id($order['id']);
			$order['payment_status'] = ucwords($order['payment_status']);
			$order['status'] = ucwords($order['status']);
			$order['order_details'] = json_decode($order['order_details']);
			$order['payment_type'] = ($order['payment_id']) ? 'Online' : "Cash";

			foreach ($order['order_details'] as $k => $v) {
				$order['order_details'][$k]->image = images('products/').$v->image;
				$order['order_details'][$k]->qty_type = ucwords($v->qty_type);
			}

			$return = [
				'error' => false,
				'order' => $order
			];
		}else{
			$return = [
				'error'   => true,
				'message' => "Order Not Found"
			];
		}
		echo json_encode($return);
	}
}