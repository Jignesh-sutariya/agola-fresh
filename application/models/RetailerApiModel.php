<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class RetailerApiModel extends CI_Model 
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
        $sql = "SELECT p.id prod_id, p.eng_name, p.guj_name, CONCAT('$image', p.image) image, p.min_qty, p.qty_type, p.price, p.prod_details
                FROM products p
                WHERE p.is_deleted = 0 AND p.out_stock = 0 AND p.cat_id = '$q->cat_id'
                ORDER BY p.eng_name ASC";
        if ($row = $this->response($sql)) {
            return $row;
        }else{
            return [];
        }
    }
    
    public function orders_list($q)
    {
        $image = images('products/');
        $sql = "SELECT  o.id, CONCAT('AF-', (41254 * o.id)) order_id, total_amount,pending_amount,created_at,status,payment_status,delivery_address, c.fullname cust_name, c.mobile cust_mob
                FROM orders o
                JOIN customers c ON c.id = o.user_id
                WHERE o.del_boy = '$q->del_boy' AND o.status = '$q->status'";

        return $this->response($sql);
    }
}