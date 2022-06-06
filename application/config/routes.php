<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = TRUE;
$route['admin/logout'] = 'admin/login/logout';
$route['admin/dashboard'] = 'admin/home';
$route['admin/success'] = 'admin/forgotPassword/success';
$route['admin/update-price'] = 'admin/home/update_price';

// category routes
$route['admin/category']['post'] = 'admin/category/get';
$route['admin/category/update/(:num)']['get'] = 'admin/category/edit/$1';
// products routes
$route['admin/products']['post'] = 'admin/products/get';
$route['admin/products/add']['get'] = 'admin/products/create';
$route['admin/products/update/(:num)']['get'] = 'admin/products/edit/$1';
// banner routes
$route['admin/banner']['post'] = 'admin/banner/get';
$route['admin/banner/update/(:num)']['get'] = 'admin/banner/edit/$1';

// orders routes
$route['admin/orders']['post'] = 'admin/orders/get';
// customer type routes
$route['admin/customerType']['post'] = 'admin/customerType/get';
// customers routes
$route['admin/customers']['post'] = 'admin/customers/get';
// subscribers routes
$route['admin/subscribers']['post'] = 'admin/subscribers/get';
// contact routes
$route['admin/contact']['post'] = 'admin/contact/get';
// deliveryBoy routes
$route['admin/deliveryBoy']['post'] = 'admin/deliveryBoy/get';
// deliveryBoy routes
$route['admin/pincode']['post'] = 'admin/pincode/get';

// front routes
$route['subscribe']['post'] = 'home/subscribe';
$route['about']['get'] = 'home/about';
$route['signup'] = 'login/signup';
$route['logout'] = 'home/logout';
$route['contact']['get'] = 'home/contact';
$route['contact']['post'] = 'home/contact_form';
$route['terms']['get'] = 'home/terms';
$route['disclaimer']['get'] = 'home/disclaimer';
$route['privacy-policy']['get'] = 'home/privacy_policy';
$route['cancellation-return-policy']['get'] = 'home/cancellation_return_policy';
$route['single-product/(:any)/(:num)']['get'] = 'shop/single_product';
$route['view-product/(:num)'] = 'shop/view_product/$1';
$route['add-to-wishlist']['post'] = 'addCart/add_to_wishlist';
$route['remove-wishlist']['post'] = 'addCart/remove_wishlist';
$route['add-to-cart']['post'] = 'addCart/add_to_cart';
$route['remove-product']['post'] = 'addCart/remove_product';
$route['wishlist']['get'] = 'dashboard/wishlist';
$route['cart']['get'] = 'addCart/cart';
$route['checkout']['get'] = 'dashboard/checkout';
$route['checkout']['post'] = 'dashboard/checkout_post';
$route['thankYou'] = 'dashboard/thankYou';
$route['total'] = 'dashboard/total';
$route['my-orders'] = 'dashboard/my_orders';
$route['view-order/(:num)'] = 'dashboard/view_order/$1';
$route['shop-cart']['get'] = 'addCart/shop_cart';
$route['search']['get'] = 'shop/search';
$route['send-otp'] = 'home/send_otp';
$route['check-otp'] = 'home/check_otp';
$route['change-password'] = 'home/change_password';

// app routes
/*$route['app/cart']['get'] = 'app/dashboard/cart';
$route['app/wish-list']['get'] = 'app/dashboard/wish_list';
$route['app/contact'] = 'app/home/contact';
$route['app/logout']['get'] = 'app/dashboard/logout';
$route['app/add_cart']['get'] = 'app/dashboard/add_cart';

$route['app/shop/(:num)']['get'] = 'app/home/shop/$1';
$route['app/shop']['get'] = 'app/home/shop';
$route['app/single-product/(:num)']['get'] = 'app/home/single_product/$1';
$route['app/forgot']['get'] = 'app/login/forgot';
$route['app/forgot']['post'] = 'app/login/forgot';
$route['app/check-otp']['get'] = 'app/login/check_otp';
$route['app/check-otp']['post'] = 'app/login/check_otp';
$route['app/change-password']['get'] = 'app/login/change_password';
$route['app/change-password']['post'] = 'app/login/change_password';
$route['app/signup']['get'] = 'app/login/signup';
$route['app/signup']['post'] = 'app/login/signup';*/