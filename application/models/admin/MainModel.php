<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class MainModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function add($post, $table)
	{
		$this->db->insert($table, $post);
		return $this->db->insert_id();
	}

	public function update($id, $post, $table)
	{
		return $this->db->where($id)->update($table, $post);
	}

	public function update_where($id, $post, $table)
	{
		return $this->db->where($id)->update($table, $post);
	}

	public function get_where($table, $select, $where, $joins = '')
	{
		$this->db->select($select);
		if (is_array($joins)) {
			foreach ($joins as $k => $join) {
				$this->db->join($join, $join.'.id = '.$table.'.'.$k);
			}
		}
		return $this->db->where($where)->from($table)->get()->row_array();
	}

	public function get($table, $select, $where, $join = '')
	{
		$this->db->select($select);
		
		if (is_array($join)) {
			foreach ($join as $i => $t) {
            	$this->db->join($t, $t.'.id = u.'.$i);
        	}
		}
		
		$return = $this->db->where($where)->from($table)->get()->row_array();
		
		if ($return) {
			return $return; 	
		}else{
			return FALSE;
		}
	}

	public function edit($id, $table, $select, $joins = '')
	{
		$this->db->select($select);
		if (is_array($joins)) {
			foreach ($joins as $key => $join) {
				$this->db->join($join, $join.'.id = '.$table.'.'.$key);
			}
		}

		return $this->db->where($table.'.id',$id)->from($table)->get()->row_array();
	}

	public function delete($id, $table)
	{
		return $this->db->delete($table, $id);
	}

	public function delete_where($where, $table)
	{
		return $this->db->delete($table, $where);
	}

	public function all($table)  
	{  
	   return $this->db->count_all($table);
	}

	public function check($table, $where, $select)  
	{
		$id = $this->db->select($select)->where($where)->from($table)->get()->row_array();
		if ($id) {
			return $id[$select];
		}else{
			return FALSE;
		}
	}

	public function check_like($table, $like, $select)
	{
		$i = 0;
		$this->db->select($select);
        foreach ($like as $item => $value)
        {
            if($value) 
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $value);
                }
                else
                {
                    $this->db->or_like($item, $value);
                }
 
                if(count($like) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
		$select = $this->db->from($table)->get()->row_array();
		return $select;
	}

	public function count($table, $where, $group = "")
	{
		if ($group != '') {
			$this->db->group_by($group);
		}
		return $this->db->get_where($table, $where)->num_rows();
	}

	public function getall($table, $select, $where= '', $joins = '', $order_by = '', $not_in = '', $limit = '')
	{  
		$this->db->select($select);

		if ($where != '') {
			$this->db->where($where);
		}

		if ($not_in != '') {
			$not_in;
		}

		if ($order_by != '') {
			$this->db->order_by($order_by);
		}		
		
		if (is_array($joins)) {
			foreach ($joins as $key => $join) {
				$this->db->join($join, $join.'.id = '.$table.'.'.$key);
			}
		}
		if ($limit != '') {
			$this->db->limit($limit);
		}
	    return $this->db->order_by($table.'.id', 'DESC')->get($table)->result_array();
	}

	public function make_datatables($model)
	{  
	   $this->load->model($model, 'model');			
	   $this->model->make_query();  
	   if($_POST["length"] != -1)  
	   {  
	        $this->db->limit($_POST['length'], $_POST['start']);  
	   }  
	   $query = $this->db->get(); 
	   return $query->result();  
	}  

	public function get_filtered_data($model){  
	   $this->load->model($model, 'model');			
	   $this->model->make_query();  
	   $query = $this->db->get();  

	   return $query->num_rows();  
	}

	public function total()
	{
		$total = $this->db->select("sum(qty * price) as total")
				->where(['cust_id' => $this->session->userdata('cust_id')])
				->join('products p', 'p.id = c.prod_id')
	    		->get('cart c')->row_array();
	    		
	    if ($total) {
	    	return $total['total'];
	    }else{
	    	return false;
	    }
	}

	public function cart()
	{
		$cart = $this->db->select("CONCAT('".images('products/')."', image) image,price,".ucwords('eng_name')." eng_name,guj_name,min_qty, qty_type,qty,prod_id")
				->where(['cust_id' => $this->session->userdata('cust_id')])
				->join('products p', 'p.id = c.prod_id')
	    		->get('cart c')->result_array();
	    if ($cart) {
	    	return $cart;
	    }else{
	    	return false;
	    }
	}

	public function wishlist()
	{
		$wishlist = $this->db->select("CONCAT('".images('products/')."', image) image,CONCAT('₹ ', price) price,".ucwords('eng_name')." eng_name,guj_name,min_qty, qty_type,prod_id")
				->where(['cust_id' => $this->session->userdata('cust_id')])
				->join('products p', 'p.id = wl.prod_id')
	    		->get('wish_list wl')->result_array();
	    if ($wishlist) {
	    	return $wishlist;
	    }else{
	    	return false;
	    }
	}
}