<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class AppModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

    public function count_all($category)
    {
      $where['is_deleted'] = 0;
      if ($category != '') {
        $where["cat_id"] = $category;
    }
      return $this->db->get_where("products", $where)->num_rows();
    }

     public function fetch_details($limit, $start, $category)
     {
      $output = '';
      $this->db->select("id, CONCAT('".images('products/')."', image) image,CONCAT('₹', price) price,eng_name,guj_name, qty_type,min_qty,");
      $this->db->from("products");
      $this->db->where(["is_deleted" => 0]);
      if ($category != '') {
        $this->db->where(["cat_id" => $category]);
      }

      $this->db->order_by("eng_name", "ASC");
      $this->db->limit($limit, $start);
      $query = $this->db->get();
      $output .= '';
      return $query->result();
     }
}