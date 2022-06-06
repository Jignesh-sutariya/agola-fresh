<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'orders';
	private $access = 'orders';
	private $table = 'orders';
	private $redirect = 'admin/orders';

	public function index()
	{	
		$data['name'] = $this->name;
		$data['datatable'] = TRUE;
        $data['validation'] = TRUE;
		$data['url'] = $this->redirect;
        $data['access'] = $this->access;
        $data['del_boy'] = $this->main->getall('delivery_boy', 'id, fullname', ['is_deleted' => 0]);
     	return $this->template->load('admin/template',$this->redirect.'/home', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('admin/OrdersModel');
        $sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)
        {  
            $sub_array = array();  
            $sub_array[] = $sr;
            $sub_array[] = e_id($row->id);
            $sub_array[] = date("d-m-Y h:i A", strtotime($row->created_at));
            $sub_array[] = date("d-m-Y", strtotime($row->del_date));
            $sub_array[] = str_replace("_", " ", $row->del_time);
            $sub_array[] = ucwords($row->fullname);
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->delivery_address;

            if ($row->del_boy) $sub_array[] = ucwords($this->main->check("delivery_boy", ['id' => $row->del_boy], 'fullname'));
            else $sub_array[] = '<button type="button" class="btn btn-outline-primary assignDeliveryBoy" data-id="'.e_id($row->id).'" ><i class="fa fa-user"></i></button>';

            $action = '<div class="ml-0 table-display row">';
            $action .= '<a class="btn btn-outline-info mr-2" href="'.base_url($this->redirect.'/view/'.e_id($row->id)).'"><i class="text-info fa fa-print"></i></a>';
            
            if ($row->status == 'pending') {
                $action .= '<a class="btn btn-outline-danger mr-2" href="'.base_url($this->redirect.'/cancel/'.e_id($row->id)).'"><i class="text-danger fa fa-times"></i></a>';
                
            }
            
            $action .= '</div>';
            
            $sub_array[] = $action;
            
            $data[] = $sub_array;
            $sr++;
        }

        $output = array(  
            "draw"              =>     intval($_POST["draw"]),  
            "recordsTotal"      =>     $this->main->count($this->table, ['status' => $this->input->post('status')]),
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/OrdersModel'),  
            "data"              =>     $data
        );
        
        echo json_encode($output);
    }

    public function view($id)
    {
        $data['name'] = $this->name;
        $data['operation'] = "view";
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table.' u', 'u.*, fullname, mobile', ['u.id'=>d_id($id)], ['user_id' => 'customers']);
        
        return $this->template->load('admin/template',$this->redirect.'/view', $data);
    }

    public function assign()
    {
        $order_id = d_id($this->input->post('order_id'));
        $del_boy  = d_id($this->input->post('del_boy'));
        $order = $this->main->get($this->table, 'order_details', ['id'=>$order_id]);
        
        if ($order) {
            foreach (json_decode($order['order_details']) as $k => $v) {
                $post = [
                    'order_id' => $order_id,
                    'prod_id'  => $v->prod_id,
                    'eng_name' => $v->eng_name,
                    'guj_name' => $v->guj_name,
                    'image'    => $v->image,
                    'qty_type' => $v->qty_type,
                    'min_qty'  => $v->min_qty,
                    'qty'      => $v->qty,
                    'del_boy'  => $del_boy
                ];
              $this->main->add($post, "order_details");
            }
        }
        
        $id = $this->main->update(['id' => $order_id], ['del_boy' => $del_boy], $this->table);

        if ($id) {
            $response = [
                'error'   => false,
                'message' => 'Delivery Boy Assigned'
            ];
        }else{
            $response = [
                'error'   => true,
                'message' => 'Delivery Boy Not Assigned. Try Again.'
            ];
        }
        echo json_encode($response);
    }

    public function cancel($id)
    {
        $id = $this->main->update(['id'=>d_id($id)], ['status' => 'canceled'], $this->table);
            
        flashMsg(
                $id, ucwords($this->name).' Canceled Successfully.', ucwords($this->name).' Not Canceled, Please Try Again.', $this->redirect
                );
    }
}