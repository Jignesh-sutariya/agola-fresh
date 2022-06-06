<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RetailerApi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('api');
        $this->load->model('RetailerApiModel', 'api');
        // mobile();
    }

    private $table = 'customers';

    public function signup()
    {
        post();
        verifyRequiredParams(['fullname', 'mobile', 'password', 'area', 'city', 'state', 'address', 'pincode']);
        
        $post = [
            'fullname'    => $this->input->post('fullname'),
            'mobile'      => $this->input->post('mobile'),
            'password'    => my_crypt($this->input->post('password')),
            'area'        => $this->input->post('area'),
            'city'        => $this->input->post('city'),
            'state'       => $this->input->post('state'),
            'address'     => $this->input->post('address'),
            'pincode'     => $this->input->post('pincode'),
            'cust_type'   => 0,
            'is_approved' => 1,
        ];

        if ($row = $this->main->get($this->table,'id',['mobile' => $post['mobile']])) {
            $response['row'] = "Mobile Already Exist.";
            $response["error"] = TRUE;
            $response['message'] = "Signup Not Successfull!";
            echoRespnse(400, $response);   
        }else{
            if($row = $this->main->add($post, $this->table))
            {
                $post['id'] = $row;
                unset($post['password']);
                unset($post['cust_type']);
                unset($post['is_approved']);
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
            "cust_type"     => 0,
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
        
        $row = $this->main->get($this->table,'fullname, mobile, area, city, state, address, pincode',['id'=>$api_key]);
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
        verifyRequiredParams(['cat_id']);

        $post = (object) [
            'cat_id'    => $this->input->post('cat_id'),
        ];

        if($row = $this->api->products($post))
        {
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

    public function cats_prods()
    {
        get();

        if($row = $this->main->getall("category", 'id, category, CONCAT("'.images('category/').'", image) image', ['is_deleted'=>0]))
        {
            foreach ($row as $k => $v) {
                $row[$k]['products'] = $this->api->products((object) ['cat_id' => $v['id']]);
            }
            
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

    public function final_order()
    {
        post();
        $api_key = authenticate($this->table);
        
        verifyRequiredParams(['payment_id', 'total_amount', 'delivery_address','del_date','del_time', 'cart', 'pincode']);
        
        if ($this->main->get("pincode", 'id', ['pincode' => $this->input->post('pincode'), 'is_deleted'=>0])) {
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
        }else{
            $response["error"] = TRUE;
            $response['message'] = "Delivery not available for given pincode!";
            echoRespnse(400, $response);
        }
    }

    public function orders_list()
    {
        get();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['status']);
        $status = $this->input->get('status');

        if($row = $this->main->getall('orders', 'orders.id, total_amount, pending_amount,created_at,status,payment_status,delivery_address,pincode', ['user_id' => $api_key, 'status' => $status]))
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

    public function send_otp()
    {
        post();
        verifyRequiredParams(['mobile']);
        
        $post = ['mobile' => $this->input->post('mobile')];
        
        if($row = $this->main->get($this->table, 'id, mobile', $post))
        {
            $row['otp'] = rand(100000, 999999);
            $this->main->update(['id' => $row['id']], ['password' => my_crypt($row['otp'])], "customers");

            $sms = "Your new password is ".$row['otp'];
            send_sms($sms, $post['mobile']);
            // $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="New password generated successfully.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Mobile not registered.";
            echoRespnse(400, $response);
        }
    }

    /*public function change_password()
    {
        post();
        $api = authenticate($this->table);
        verifyRequiredParams(['password']);
        
        $post = ['password' => my_crypt('password')];

        $id = $this->main->update(['id' => $api], $post, "customers");
        
        if($id)
        {
            $response['error'] = FALSE;
            $response['message'] ="Password Changed.";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Password Not Changed. Try Again.";
            echoRespnse(400, $response);
        }
    }*/
}