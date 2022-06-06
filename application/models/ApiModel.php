<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class ApiModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	private function response($sql)
    {
    	$data = $this->db->query($sql)->result();

        if($data)
        {   
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    private function response_single($sql)
    {
        $data = $this->db->query($sql)->row_array();

        if($data)
        {   
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

	public function products($q)
    {
        $image = images('products/');
        $sql = "SELECT pp.prod_id, p.eng_name, p.guj_name, CONCAT('$image', p.image) image, pp.min_qty, pp.qty_type, pp.price , p.prod_details
                FROM product_price pp
                JOIN products p ON p.id = pp.prod_id
                WHERE p.is_deleted = 0 AND p.out_stock = 0 AND p.cat_id = '$q->cat_id' AND pp.wholesale_id = '$q->cust_type'
                ORDER BY p.id DESC";
        if ($row = $this->response($sql)) {
            return $row;
        }else{
            return [];
        }
    }

    public function check_cart($api_key, $prod_id)
    {
        $sql = "SELECT qty
                FROM cart c
                WHERE cust_id = '$api_key' AND prod_id = $prod_id";
        $qty = $this->response_single($sql);
        if ($qty) return $qty['qty'];
        else return "0";
    }

    public function list_cart($q)
    {
        $image = images('products/');
        $sql = "SELECT pp.prod_id, p.eng_name, p.guj_name, CONCAT('$image', p.image) image, pp.min_qty, pp.qty_type, (pp.price * c.qty) price, p.prod_details, c.qty
                FROM cart c
                JOIN product_price pp ON pp.prod_id = c.prod_id
                JOIN products p ON p.id = pp.prod_id
                WHERE p.is_deleted = 0 AND c.cust_id = '$q->api_key' AND pp.wholesale_id = '$q->cust_type'
                ORDER BY p.id DESC";

        return $this->response($sql);
    }

    public function final_order($q)
    {
        $sql = "SELECT pp.prod_id, pp.min_qty, pp.qty_type, pp.price, c.qty, p.eng_name, p.guj_name, p.image
                FROM cart c
                JOIN product_price pp ON pp.prod_id = c.prod_id
                JOIN products p ON p.id = pp.prod_id
                WHERE p.is_deleted = 0 AND c.cust_id = '$q->api_key' AND pp.wholesale_id = '$q->cust_type'
                ORDER BY p.id DESC";

        return $this->response($sql);
    }

    public function count_products($q)
    {
        $image = images('products/');
        $sql = "SELECT  order_id, prod_id, eng_name, guj_name, CONCAT('$image', image) image, qty_type, SUM(min_qty * qty) qty
                FROM order_details
                WHERE del_boy = '$q'
                GROUP BY prod_id";

        return $this->response($sql);
    }

    public function orders_list($q)
    {
        $image = images('products/');
        $sql = "SELECT  o.id, CONCAT('AF-', (41254 * o.id)) order_id, total_amount,pending_amount,created_at,status,payment_status,delivery_address, c.fullname cust_name, c.mobile cust_mob, o.del_time, o.del_date
                FROM orders o
                JOIN customers c ON c.id = o.user_id
                WHERE o.del_boy = '$q->del_boy' AND o.status = '$q->status'";

        return $this->response($sql);
    }
}