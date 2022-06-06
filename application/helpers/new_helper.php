<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function my_crypt($string, $action = 'e' )
{
    $secret_key = 'agola_fresh_key';
    $secret_iv = 'agola_fresh_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}

function auth()
{
    $CI =& get_instance();
    if (empty($CI->session->userdata('id'))) {
	    return redirect('admin/login');
	}
}

function cust_type()
{
    return get_instance()->session->userdata('cust_type');
}

function front_auth()
{
    $CI =& get_instance();
    if (empty($CI->session->userdata('user_id'))) {
        return redirect('login');
    }else{
        return $CI->session->userdata('user_id');
    }
}

function front_login()
{
    $CI =& get_instance();
    if (!empty($CI->session->userdata('user_id'))) {
        return redirect('');
    }
}

function validation($url, $ignore)
{
    $CI =& get_instance();

    $CI->load->view("admin/include/validation_header");
    $CI->load->view($url."/validation");
    $CI->load->view("admin/include/validation_footer");
    if ($ignore) {
        $CI->load->view($url."/validation_ignore");
    }
}

function login()
{
    $CI =& get_instance();
    if (!empty($CI->session->userdata('id'))) {
	    return redirect('admin');
	}
}

function app_login()
{
    $CI =& get_instance();
    if (!empty($CI->session->userdata('cust_id'))) {
        return redirect('app');
    }
}

function app_auth()
{
    $CI =& get_instance();
    if (empty($CI->session->userdata('cust_id'))) {
        return redirect('app/login');
    }else{
        return $CI->session->userdata('cust_id');
    }
}

function re($array='')
{
    $CI =& get_instance();
    echo "<pre>";
    print_r($array);
    exit;
}

function flashMsg($success,$succmsg,$failmsg,$redirect)
{
    $CI =& get_instance();
    if ( $success ){
        $CI->session->set_flashdata('success',$succmsg);
    }else{
        $CI->session->set_flashdata('error', $failmsg);
    }
    return redirect($redirect);
}

function error_404()
{
    $CI =& get_instance();
    $data['name'] = "404 Not Found";
    $data['title'] = "404 Not Found";
    return $CI->template->load('front/template','error_404', $data);
    die();
}

function images($uri='')
{
    return base_url('assets/images/').$uri;
}

function assets($uri='')
{
    return base_url('assets/').$uri;
}

function front_assets($uri='')
{
    return base_url('assets/front/').$uri;
}

function admin($uri='')
{
    return base_url('admin/').$uri;
}

function app($uri='')
{
    return base_url('app/').$uri;
}

function e_id($id)
{
    return 41254 * $id;
}

function d_id($id)
{
    return $id / 41254;
}

function send_sms($sms, $mobile)
{
    if (ENVIRONMENT === 'production') {
        $url = 'key=35F6302ED228F8&routeid=415&type=text&contacts='.$mobile.'&senderid=DENSTK&msg='.urlencode($sms);
        $base_URL ='http://kutility.in/app/smsapi/index.php?'.$url;

        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$base_URL);
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($curl_handle);
        curl_close($curl_handle);
    }
}