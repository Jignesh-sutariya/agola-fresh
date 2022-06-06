<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('api');
        $this->load->model('ApiModel', 'api');
        // mobile();
    }

    private $table = 'customers';

    public function customer_type()
    {
        get();
        
        if($row = $this->main->getall("customer_type", 'id, cust_type', ['is_deleted' => 0]))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Customer Type Successfull.";
            echoRespnse(200, $response);
        } 
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Customer Type Not Successfull!";
            echoRespnse(400, $response);
        }
    }

    public function signup()
    {
        post();
        verifyRequiredParams(['fullname', 'mobile', 'password', 'area', 'city', 'state', 'address', 'cust_type', 'pincode']);

        $post = [
            'fullname'    => $this->input->post('fullname'),
            'mobile'      => $this->input->post('mobile'),
            'password'    => my_crypt($this->input->post('password')),
            'area'        => $this->input->post('area'),
            'city'        => $this->input->post('city'),
            'state'       => $this->input->post('state'),
            'address'     => $this->input->post('address'),
            'pincode'     => $this->input->post('pincode'),
            'cust_type'   => $this->input->post('cust_type'),
            'is_approved' => 0,
        ];

        if ($row = $this->main->get($this->table, 'id', ['mobile' => $post['mobile']])) {
            $response['row'] = "Mobile Already Exist.";
            $response["error"] = TRUE;
            $response['message'] = "Signup Not Successfull!";
            echoRespnse(400, $response);   
        }else{
            if($row = $this->main->add($post, $this->table))
            {
                $post['id'] = $row;
                unset($post['password']);
                $response['row'] = $post;
                $response['error'] = FALSE;
                $response['message'] ="Signup Successfull.";
                echoRespnse(200, $response);
            } 
            else 
            {
                $response["error"] = TRUE;
                $response['message'] = "Signup Not Successfull!";
                echoRespnse(400, $response);
            }
        }
    }

    public function login()
    {
        post();
        verifyRequiredParams(['mobile', 'password']);
        
        $post = [
            "mobile"        => $this->input->post('mobile'),
            "password"      => my_crypt($this->input->post('password')),
            "cust_type != " => 0,
        ];
        
        if($row = $this->main->get($this->table,'id, fullname, mobile, area, city, state, address, cust_type, is_approved, pincode', $post))
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
        
        $row = $this->main->get($this->table,'fullname, mobile, area, city, state, address, pincode, cust_type',['id'=>$api_key]);
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

    public function banner()
    {
        get();
        $api_key = authenticate($this->table);
        
        if($row = $this->main->getall("banner", 'CONCAT("'.images('banner/').'", banner) image'))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Banner Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Banner Not Successfull!";
            echoRespnse(400, $response);
        }  
    }

    public function category()
    {
        get();
        $api_key = authenticate($this->table);
        
        if($row = $this->main->getall("category", 'id, category, CONCAT("'.images('category/').'", image) image', ['is_deleted'=>0]))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Category List Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Category List Not Successfull!";
            echoRespnse(400, $response);
        }  
    }

    public function products()
    {
        post();
        $api = authenticate($this->table);
        
        verifyRequiredParams(['cat_id', 'customer_type']);

        $post = (object) [
            'cat_id'    => $this->input->post('cat_id'),
            'cust_type' => $this->input->post('customer_type'),
            'api_key'   => $api
        ];

        if($row = $this->api->products($post))
        {
            /*foreach ($row as $k => $v) {
                $row[$k]->qty = $this->api->check_cart($api, $v->prod_id);
            }*/

            $response['row'] = $row;
            $response['approved'] = $this->main->check($this->table, ['id' => $api], 'is_approved');
            $response['error'] = FALSE;
            $response['message'] ="Products List Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Products List Not Successfull!";
            echoRespnse(400, $response);
        }
    }

    public function cats_prods()
    {
        post();
        $api = authenticate($this->table);
        
        verifyRequiredParams(['customer_type']);

        if($row = $this->main->getall("category", 'id, category', ['is_deleted'=>0]))
        {
            foreach ($row as $k => $v) {
                $post = (object) [
                    'cat_id'    => $v['id'],
                    'cust_type' => $this->input->post('customer_type'),
                    'api_key'   => $api
                ];
                
                $row[$k]['products'] = $this->api->products($post);
            }
            
            $response['approved'] = $this->main->check($this->table, ['id' => $api], 'is_approved');
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Products List Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Products List Not Successfull!";
            echoRespnse(400, $response);
        }  
    }

    /*public function add_cart()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['prod_id', 'qty']);
        $prod_id = $this->input->post('prod_id');
        $qty = $this->input->post('qty');

        $check = $this->main->get('cart', 'prod_id, cust_id', ['prod_id' => $prod_id, 'cust_id' => $api_key]);

        $post = ['prod_id' => $prod_id, 'cust_id' => $api_key, 'qty' => $qty];

        if ($check) {
            $row = $this->main->update($check, $post, 'cart');
        }else{
            $this->main->add($post, 'cart');
            $row = true;
        }

        if($row)
        {
            $response['row'] = $post;
            $response['error'] = FALSE;
            $response['message'] ="Product Added to cart.";
            echoRespnse(200, $response);
        } 
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Product not Added to cart";
            echoRespnse(400, $response);
        } 
    }

    public function delete_cart()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['prod_id']);
        $prod_id = $this->input->post('prod_id');
        
        $check = $this->main->get('cart', 'prod_id, cust_id', ['prod_id' => $prod_id, 'cust_id' => $api_key]);
        
        if (!$check) {
            $response['error'] = TRUE;
            $response['message'] ="Product Not in cart.";
            echoRespnse(200, $response);
        }else{
            $row = $this->main->delete($check, 'cart');
        }
        
        if($row)
        {
            $response['error'] = FALSE;
            $response['message'] ="Product Deleted";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Product Not Deleted";
            echoRespnse(400, $response);
        }
    }

    public function list_cart()
    {
        get();
        $api_key = authenticate($this->table);
        
        verifyRequiredParams(['customer_type']);

        $post = (object) [
            'api_key'   => $api_key,
            'cust_type' => $this->input->get('customer_type')
        ];

        if($row = $this->api->list_cart($post))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Cart List Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Cart List Not Successfull!";
            echoRespnse(400, $response);
        }  
    }*/

    /*public function final_order()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['customer_type']);

        $post = (object) [
            'api_key'   => $api_key,
            'cust_type' => $this->input->post('customer_type')
        ];

        $cart = $this->api->final_order($post);
        
        if (!$cart) {
            $response["error"] = TRUE;
            $response['message'] = "Empty Cart. Order Not Successfull.";
            echoRespnse(400, $response);
        }else{
            verifyRequiredParams(['payment_id', 'total_amount', 'delivery_address','del_date','del_time']);

            $total = $this->input->post('total_amount');
            if ($this->input->post('payment_id') != 'cash') {
                $payment[] = [
                    'payment_id'  => $this->input->post('payment_id'),
                    'amount'      => $total,
                    'created_at'  => date('d-m-Y H:i:s'),
                ];
            }else{
                $payment = "";
            }

            $post = [
                'user_id'          => $api_key,
                'payment_id'       => ($payment != '') ? json_encode($payment) : '',
                'total_amount'     => $total,
                'delivery_address' => $this->input->post('delivery_address'),
                'pending_amount'   => ($this->input->post('payment_id') != 'cash') ? 0 : $total,
                'order_details'    => json_encode($cart),
                'created_at'       => date('d-m-Y H:i:s'),
                'del_date'         => date('Y-m-d', strtotime($this->input->post('del_date'))),
                'del_time'         => $this->input->post('del_time'),
                'status'           => "pending",
                'payment_status'   => ($this->input->post('payment_id') != 'cash') ? "completed" : "pending"
            ];
            
            if($row = $this->main->add($post, 'orders') && $this->main->delete(['cust_id' => $api_key], 'cart'))
            {   
                $response['error'] = FALSE;
                $response['message'] ="Order Successfull.";
                echoRespnse(200, $response);
            } 
            else 
            {
                $response["error"] = TRUE;
                $response['message'] = "Order Not Successfull.";
                echoRespnse(400, $response);
            }
        }
    }*/

    public function final_order()
    {
        post();
        $api_key = authenticate($this->table);
        
        verifyRequiredParams(['payment_id', 'total_amount', 'delivery_address','del_date','del_time', 'cart', 'pincode']);
        
        $total = $this->input->post('total_amount');
        if ($this->input->post('payment_id') != 'cash') {
            $payment[] = [
                'payment_id'  => $this->input->post('payment_id'),
                'amount'      => $total,
                'created_at'  => date('d-m-Y H:i:s'),
            ];
        }else{
            $payment = "";
        }
        
        $cart = json_decode($this->input->post('cart'));
        
        foreach ($cart as $k => $v) {
            $img = explode("/", $v->image);
            $save[] = [
                'image' => end($img),
                'id' => $v->pro_id,
                'eng_name' => $v->pro_name,
                'guj_name' => $v->guj_name,
                'price' => ($v->pro_price / $v->pro_qty),
                'min_qty' => $v->pro_min_qty,
                'qty_type' => $v->pro_unit,
                'qty' => $v->pro_qty,
                'slug' => strtolower($v->pro_name),
                'prod_id' => $v->pro_id
            ];
        }

        $data = [
            'user_id'          => $api_key,
            'payment_id'       => ($payment != '') ? json_encode($payment) : $this->input->post('payment_id'),
            'total_amount'     => $total,
            'delivery_address' => $this->input->post('delivery_address'),
            'pending_amount'   => ($this->input->post('payment_id') != 'cash') ? 0 : $total,
            'order_details'    => json_encode($save),
            'created_at'       => date('d-m-Y H:i:s'),
            'status'           => "pending",
            'del_date'         => date('Y-m-d', strtotime($this->input->post('del_date'))),
            'del_time'         => $this->input->post('del_time'),
            'pincode'          => $this->input->post('pincode'),
            'payment_status'   => ($this->input->post('payment_id') != 'cash') ? "completed" : "pending"
        ];
        
        if($row = $this->main->add($data, 'orders'))
        {   
            $sms = "Delivery Customer! Thanks for shopping with Agola Freash. We hope you have a lovely day. For today’s deal: https://agolafresh.com";
            send_sms($sms, $this->main->check($this->table, ['id'=>$api_key], 'mobile'));
            
            $response['error'] = FALSE;
            $response['message'] ="Order Successfull.";
            echoRespnse(200, $response);
        } 
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Order Not Successfull.";
            echoRespnse(400, $response);
        }
    }

    public function orders_list()
    {
        get();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['status']);
        $status = $this->input->get('status');

        if($row = $this->main->getall('orders', 'orders.id, total_amount, pending_amount,created_at,status,payment_status,delivery_address', ['user_id' => $api_key, 'status' => $status]))
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

        if($row = $this->main->get('orders', 'orders.id, total_amount,pending_amount,created_at, order_details, status,payment_status,payment_id payment_details, delivery_address', ['id' => $order_id]))
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
}