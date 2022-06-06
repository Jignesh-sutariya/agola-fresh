<?php
class ProductsModel extends CI_Model
{
 public function count_all($category)
 {
  $where['is_deleted'] = 0;
  if ($category != '') {
    $where["cat_id"] = d_id($category);
  }
  return $this->db->get_where("products", $where)->num_rows();
 }

 public function fetch_details($limit, $start, $category)
 {
  $this->db->select("slug, CONCAT('".images('products/')."', image) image, id,CONCAT('₹', price) price,eng_name,guj_name, qty_type,min_qty,");
  $this->db->from("products");
  $this->db->where(["is_deleted" => 0]);
  if ($category != '') {
    $this->db->where(["cat_id" => d_id($category)]);
  }

  $this->db->order_by("eng_name", "ASC");
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  return $query->result();
 }

 public function wishlist($id)
 {
  $query = $this->db->select("CONCAT('".images('products/')."', image) image, id, eng_name,guj_name")
          ->from("wish_list w")
          ->where(["is_deleted" => 0])
          ->join("products p", 'p.id = w.prod_id')
          ->where(["cust_id" => $id])
          ->order_by("eng_name", "ASC")
          ->get();

  return $query->result();
 }

 public function cart($id)
 {
    if ($id) {
      $query = $this->db->select("CONCAT('".images('products/')."', image) image, id, eng_name,guj_name, price, min_qty, qty_type, qty")
            ->from("cart c")
            ->where(["is_deleted" => 0])
            ->join("products p", 'p.id = c.prod_id')
            ->where(["cust_id" => $id])
            ->order_by("eng_name", "ASC")
            ->get();
            return $query->result();
    }elseif ($cart = json_decode(get_cookie('cart'))){
      
      foreach ($cart as $k => $v) {
        $get[] = d_id($k);
      }
      
      $query = $this->db->select("CONCAT('".images('products/')."', image) image, id, eng_name,guj_name, price, min_qty, qty_type")
            ->from("products p")
            ->where(["is_deleted" => 0])
            ->where_in('id', $get)
            ->order_by("eng_name", "ASC")
            ->get();
      return $query->result();
    }else{
      return [];
    }
 }

 public function total($id)
  {
    $total = $this->db->select("sum(qty * price) as total")
        ->where(['cust_id' => $id])
        ->join('products p', 'p.id = c.prod_id')
          ->get('cart c')->row_array();
          
      if ($total) {
        return $total['total'];
      }else{
        return false;
      }
  }

  public function orders($id)
  {
    $orders = $this->db->select("id, payment_id, total_amount, pending_amount, order_details, created_at, updated_at, status, payment_status, delivery_address")
        ->where(['user_id' => $id])
        ->get('orders o')->result_array();
          
      if ($orders) {
        return $orders;
      }else{
        return false;
      }
  }

  public function order($id)
  {
    $orders = $this->db->select("id, total_amount, order_details, created_at, status, payment_status, payment_id")
                    ->where(['id' => $id])
                    ->get('orders o')->row_array();
      if ($orders) {
        return $orders;
      }else{
        return false;
      }
  }
}