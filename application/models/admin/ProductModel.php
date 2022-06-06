<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class ProductModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "products p";
	public $select_column = array('p.id', 'c.category','p.image','eng_name', 'guj_name', 'min_qty', 'qty_type', 'price', 'out_stock');
	public $search_column = array('p.id', 'c.category','p.image','eng_name', 'guj_name', 'min_qty', 'qty_type', 'price', 'out_stock');
    public $order_column = array(null, 'eng_name', 'price', 'min_qty', 'c.category', null,null,null,null);
	public $order = array('p.id' => 'DESC');

	public function make_query()  
	{  
        $this->db->select($this->select_column)	
            ->from($this->table)
            ->where(['p.is_deleted'=>0])
            ->join('category c', 'c.id = p.cat_id');
        $i = 0;

        foreach ($this->search_column as $item) 
        {
            if($_POST['search']['value']) 
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->search_column) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}

    public function getAllProductPrice($id)
    {
        $query = $this->db->select("price, cust_type, min_qty, qty_type") 
                    ->from("product_price p")
                    ->where(['prod_id' => $id])
                    ->join('customer_type c', 'c.id = p.wholesale_id')
                    ->get()->result();
       return $query;
    }
}