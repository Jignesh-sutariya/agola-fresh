<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Razorpay\Api\Api;

/**
 * 
 */
class Checkout extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		if (!$this->agent->is_mobile() && ENVIRONMENT == 'production') die();
		$this->api = app_auth();
	}

	public function index()
	{
		$data['total'] = $this->main->total();
		$data['cart'] = $this->main->cart();
		return $this->template->load('app/template','app/checkout', $data);
	}

	public function razorPaySuccess()
    { 
    	$cart = $this->main->cart();
    	
    	if (!$cart) {
    		$response = array('msg' => 'Your Cart is Empty', 'status' => false);
    	}else{
    		foreach ($cart as $k => $v) {
    			$img = explode("/", $v['image']);
    			$cart[$k]['image'] = end($img);
	    	}
	    	
	    	$total = $this->main->total();
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
                'del_date'		   => date('Y-m-d', strtotime($this->input->post('del_date'))),
                'del_time'		   => $this->input->post('del_time'),
                'pending_amount'   => ($this->input->post('payment_id') != 'cash') ? 0 : $total,
                'order_details'    => json_encode($cart),
                'created_at'       => date('d-m-Y H:i:s'),
                'status'           => "pending",
                'payment_status'   => ($this->input->post('payment_id') != 'cash') ? "completed" : "pending"
            ];
		    
		    $id = $this->main->add($data, "orders");
	      	
	      	if ($id) {
				$this->main->delete(['cust_id' => $this->api], 'cart');

	      		$response = array('msg' => 'Order successfully created.', 'status' => true);		
	      	}else{
	      		$response = array('msg' => 'Order not created. Try Again.', 'status' => false);
	      	}
	      }

      	echo json_encode($response);
    }

    public function RazorThankYou()
    {
     return $this->template->load('app/template','app/razorthankyou');
    }
}