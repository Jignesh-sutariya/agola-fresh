<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DeliveryBoyApi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('api');
        $this->load->model('ApiModel', 'api');
        // mobile();
    }

    private $table = 'delivery_boy';

    public function login()
    {
        post();
        verifyRequiredParams(['mobile', 'password']);
        
        $post = [
            "mobile"     => $this->input->post('mobile'),
            "password"   => my_crypt($this->input->post('password')),
            "is_deleted" => 0
        ];
        
        if($row = $this->main->get($this->table,'id, fullname, mobile, address', $post))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Login Successfull.";
            echoRespnse(200, $response);
        } 
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Login Not Successfull!";
            echoRespnse(400, $response);
        }
    }

    public function profile()
    {
        get();
        $api_key = authenticate($this->table);
        
        $row = $this->main->get($this->table,'fullname, mobile, address',['id'=>$api_key]);
        if($row)
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Profile Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Profile Not Successfull!";
            echoRespnse(400, $response);
        }  
    }

    public function orders_list()
    {
        get();
        $api = authenticate($this->table);

        verifyRequiredParams(['status']);
        
        $q = ['status' => $this->input->get('status'), 'del_boy' => $api];

        if($row = $this->api->orders_list((object) $q))
        // if($row = $this->main->getall('orders', 'orders.id, CONCAT("AF-", (41254 * orders.id)) order_id, total_amount,pending_amount,created_at,status,payment_status,delivery_address', $q))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Orders List Successfull";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Orders List Not Successfull";
            echoRespnse(400, $response);
        }
    }

    public function order_details()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['order_id']);
        $order_id = $this->input->post('order_id');

        if($row = $this->main->get('orders', 'orders.id, CONCAT("AF-", (41254 * orders.id)) order_id, total_amount,pending_amount,created_at, order_details, status,payment_status,payment_id payment_details, delivery_address, del_date, del_time', ['id' => $order_id]))
        {
            $row['order_details'] = json_decode($row['order_details']);

            foreach ($row['order_details'] as $k => $v) {
                $row['order_details'][$k]->image = images('products/'.$v->image);
            }
            
            $row['payment_details'] = json_decode($row['payment_details']);
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Orders List Successfull";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Orders List Not Successfull";
            echoRespnse(400, $response);
        }
    }

    public function accept_order()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['order_id']);
        $order_id = $this->input->post('order_id');
        
        if($row = $this->main->update(['id' => $order_id], ['status' => "in delivery"], 'orders'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Order Accept Successfull";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Order Accept Not Successfull";
            echoRespnse(400, $response);
        }
    }

    public function complete_order()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['order_id']);
        $order_id = $this->input->post('order_id');
        
        if($row = $this->main->update(['id' => $order_id], ['status' => "completed", 'payment_status' => "completed"], 'orders'))
        {
            $this->main->delete(['order_id' => $order_id], 'order_details');
            $response['error'] = FALSE;
            $response['message'] ="Order Completed Successfull";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Order Completed Not Successfull";
            echoRespnse(400, $response);
        }
    }

    public function count_products()
    {
        get();
        $api = authenticate($this->table);
        
        if($row = $this->api->count_products($api))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Products List Successfull";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Products List Not Successfull";
            echoRespnse(400, $response);
        }
    }
}