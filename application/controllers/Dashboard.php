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
    		$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[10]', ['required' => 'Enter %s.','numeric' => 'Enter Valid %s.','exact_length' => 'Enter Valid %s.']);
            $this->form_validation->set_rules('fullname', 'Full Name', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric|exact_length[6]', ['required' => 'Enter %s.','exact_length' => 'Enter Valid %s.','numeric' => 'Enter Valid %s.']);
            $this->form_validation->set_rules('address', 'Address', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('payment_type', 'Payment Type', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('payment_id', 'Payment ID', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('delivery_date', 'Delivery Date', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('delivery_time', 'Delivery Time', 'required', ['required' => 'Enter %s.']);

    		if ($this->form_validation->run() === FALSE) {
    			$response = array('message' => str_replace("*", "", strip_tags(validation_errors('','<br>'))), 'status' => false);	
    		}else{
    			$pincode = $this->input->post('pincode');
    			if (!$this->main->check('pincode', ['pincode' => $pincode],'id')) 
    				$response = array('message' => "Delivery not available for given pincode", 'status' => false);
    			else{
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
		                'payment_id'       => ($payment != '') ? json_encode($payment) : $this->input->post('payment_id'),
		                'total_amount'     => $total,
		                'delivery_address' => $this->input->post('address'),
		                'pending_amount'   => ($this->input->post('payment_id') != 'cash') ? 0 : $total,
		                'order_details'    => json_encode($cart),
		                'created_at'       => date('d-m-Y H:i:s'),
		                'status'           => "pending",
		                'del_date'		   => date('Y-m-d', strtotime($this->input->post('delivery_date'))),
		                'del_time'		   => $this->input->post('delivery_time'),
		                'pincode'		   => $this->input->post('pincode'),
		                'payment_status'   => ($this->input->post('payment_id') != 'cash') ? "completed" : "pending"
		            ];
				    
				    $id = $this->main->add($data, "orders");
			      	
			      	if ($id) {
			      		$sms = "Delivery Customer! Thanks for shopping with Agola Freash. We hope you have a lovely day. For today’s deal: https://agolafresh.com";
            			send_sms($sms, $this->main->check("customers", ['id'=>$this->api], 'mobile'));

						$this->main->delete(['cust_id' => $this->api], 'cart');
						$this->session->set_flashdata('order_id', $id);
			      		$response = array('message' => 'Order successfully created.', 'status' => true, 'redirect' => base_url('thankYou'));
			      	}else{
			      		$response = array('message' => 'Order not created. Try Again.', 'status' => false);
			      	}
		      	}
    		}
    	}
		
		echo json_encode($response);
	}

	public function thankYou()
	{
		if (empty($this->session->order_id)) 
			return redirect('/');
		$data['name'] = "order success";
		$data['title'] = "order success";
		
		return $this->template->load('front/template','front/thankYou', $data);
	}

	public function total()
	{
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|exact_length[10]', ['required' => 'Enter %s.','numeric' => 'Enter Valid %s.','exact_length' => 'Enter Valid %s.']);
            $this->form_validation->set_rules('fullname', 'Full Name', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric|exact_length[6]', ['required' => 'Enter %s.','exact_length' => 'Enter Valid %s.','numeric' => 'Enter Valid %s.']);
            $this->form_validation->set_rules('address', 'Address', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('payment_type', 'Payment Type', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('delivery_date', 'Delivery Date', 'required', ['required' => 'Enter %s.']);
            $this->form_validation->set_rules('delivery_time', 'Delivery Time', 'required', ['required' => 'Enter %s.']);

    		if ($this->form_validation->run() === FALSE) {
    			$response = array('message' => str_replace("*", "", strip_tags(validation_errors('','<br>'))), 'error' => true);	
    		}else{
    			$pincode = $this->input->post('pincode');
    			if (!$this->main->check('pincode', ['pincode' => $pincode],'id')) 
    				$response = array('message' => "Delivery not available for given pincode", 'error' => true);
    			elseif ($this->product->total($this->api) < 150) 
    				$response = array('message' => "Min Order ₹ 150", 'error' => true);
    			else
    				$response = array('total' => $this->product->total($this->api), 'status' => false);
			}
		echo json_encode($response);
	}

	public function my_orders()
	{
		$data['name'] = "my orders";
		$data['title'] = "my orders";
		$data['orders'] = $this->product->orders($this->api);
		
		return $this->template->load('front/template','front/my_orders', $data);
	}

	public function view_order($id)
	{
		if (!$this->input->is_ajax_request()) return error_404();

		$order = $this->product->order(d_id($id));
			
		if ($order) {
			$order['created_at'] = date("d-m-Y", strtotime($order['created_at']));
			$order['id'] = "AF-".e_id($order['id']);
			$order['address'] = $order['address'];
			$order['payment_status'] = ucwords($order['payment_status']);
			$order['status'] = ucwords($order['status']);
			$order['order_details'] = json_decode($order['order_details']);
			$order['payment_type'] = ($order['payment_id'] != 'cash') ? 'Online' : "Cash";

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