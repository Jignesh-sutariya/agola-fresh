<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class OrdersModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "orders o";
	public $select_column = array('o.id', 'o.payment_id','o.total_amount','o.created_at', 'o.payment_status','c.mobile','c.cust_type','c.fullname', 'o.del_boy','o.delivery_address','o.del_date','o.del_time', 'o.status');
	public $search_column = array('o.payment_id','o.total_amount','o.created_at', 'o.payment_status','c.mobile','c.fullname','o.delivery_address');
    public $order_column = array(null, 'o.id', 'o.created_at', 'o.del_date','o.del_time', 'c.fullname', 'c.mobile','o.delivery_address', null);
	public $order = array('o.id' => 'DESC');

	public function make_query()  
	{  
        $this->db->select($this->select_column)	
                ->from($this->table)
                ->where(['status' => $this->input->post('status')])
                ->join('customers c','c.id = o.user_id');
            
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
}