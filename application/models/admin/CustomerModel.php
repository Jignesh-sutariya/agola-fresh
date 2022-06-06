<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class CustomerModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "customers c";
	public $select_column = array('c.id', 'c.fullname', 'c.mobile','c.is_approved', 'ct.cust_type');
	public $search_column = array('c.id', 'c.fullname', 'c.mobile');
    public $order_column = array(null, 'c.fullname', 'c.mobile',null,null);
	public $order = array('c.id' => 'DESC');

	public function make_query()  
	{  
        if ($_POST['cust_type']) array_push($this->select_column, "ct.cust_type");
        
        $this->db->select($this->select_column)	
            ->from($this->table)
            ->where(['c.is_deleted'=>0])
            ->join('customer_type ct', 'ct.id = c.cust_type', 'LEFT');
            
        $i = 0;

        if ($_POST['cust_type']) {
            $this->db->where(['c.cust_type'=>$_POST['cust_type']]);
        }

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