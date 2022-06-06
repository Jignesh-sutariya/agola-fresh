<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {
        var $template_data = array();
        
        public function set($name, $value)
        {
            $this->template_data[$name] = $value;
        }
    
        public function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
        {               
            $this->CI =& get_instance();

            if (strpos( current_url(), "app" )) {
                $view_data['categories'] = $this->CI->main->getall('category', "CONCAT('".images('category/')."', image) image,category,slug,id", ['is_deleted' => 0], '','category ASC');
                $view_data['cart_count'] = $this->CI->main->count('cart', ['cust_id' => $this->CI->session->userdata('cust_id')]);
            }
            
            $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));            
            return $this->CI->load->view($template, $this->template_data, $return);
        }
}