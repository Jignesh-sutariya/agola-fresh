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
	public $select_column = array('id', 'payment_id','created_at', 'status','payment_status');
	public $search_column = array('payment_id','created_at', 'status','payment_status');
    public $order_column = array(null, 'created_at', 'status','payment_status',null,null);
	public $order = array('id' => 'DESC');

	public function make_query()  
	{  
        $this->db->select($this->select_column)	
            ->from($this->table);
            
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