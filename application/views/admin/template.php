<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="<?= images('favicon.png') ?>" type="image/x-icon" />
        <title>Agola Fresh <?= (!empty($name)) ? '| '.ucwords($name) : '' ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= assets('plugins/fontawesome-free/css/all.min.css') ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <?php if (!empty($datatable)): ?>
        <!-- DataTables -->
        <link rel="stylesheet" href="<?= assets('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>" />
        <link rel="stylesheet" href="<?= assets('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>" />
        <!-- tostr -->
        <link rel="stylesheet" href="<?= assets('plugins/toastr/toastr.min.css') ?>">
        <?php endif ?>
        <?php if (!empty($validation)): ?>
        <!-- Select2 -->
        <link rel="stylesheet" href="<?= assets('plugins/select2/css/select2.min.css') ?>">
        <link rel="stylesheet" href="<?= assets('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="<?= assets('plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= assets('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
        <?php endif ?>
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?= assets('dist/css/adminlte.min.css') ?>">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
        <link href="<?= assets('plugins/x-editable/bootstrap-editable.css') ?>" rel="stylesheet">
        
    </head>
    <body class="hold-transition sidebar-mini <?= get_cookie('sidebar') ?>">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a class="dropdown-item">
                                <i class="fa fa-phone mr-2"></i> <?= $this->session->userdata('mobile') ?>
                            </a>
                            <a class="dropdown-item">
                                <i class="far fa-envelope mr-2"></i> <?= $this->session->userdata('email') ?>
                            </a>
                            <a href="<?= admin('profile') ?>" class="dropdown-item">
                                <i class="far fa-user mr-2"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= admin('logout') ?>" class="dropdown-item">
                                <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="<?= admin() ?>" class="brand-link">
                    <img src="<?= images('favicon.png') ?>" alt="Agola Fresh Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                    <span class="brand-text font-weight-light">Agola Fresh</span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?= images('users/'.$this->session->userdata('image')) ?>" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="<?= admin() ?>" class="d-block"><?= ucwords($this->session->userdata('fname')." ".$this->session->userdata('lname')) ?></a>
                        </div>
                    </div>
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="<?= admin('dashboard') ?>" class="nav-link <?= ($name == 'dashboard') ? 'active' : ''?>">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= admin('pincode') ?>" class="nav-link <?= ($name == 'pincode') ? 'active' : ''?>">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Pin Code</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="<?= admin('orders') ?>" class="nav-link <?= ($name == 'orders') ? 'active' : ''?>">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>Orders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= admin('deliveryBoy') ?>" class="nav-link <?= ($name == 'delivery boy') ? 'active' : ''?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Delivery Boy</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= admin('banner') ?>" class="nav-link <?= ($name == 'banner') ? 'active' : ''?>">
                                    <i class="nav-icon fas fa-image"></i>
                                    <p>Banners</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview <?= ($name == 'category' || $name == 'products' || $name == 'price') ? 'menu-open' : ''?>">
                                <a href="#" class="nav-link <?= ($name == 'category' || $name == 'products' || $name == 'price') ? 'active' : ''?>">
                                    <i class="nav-icon fa fa-cube"></i>
                                    <p>
                                        Products
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= admin('products') ?>" class="nav-link <?= ($name == 'products') ? 'active' : ''?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Products</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= admin('category') ?>" class="nav-link <?= ($name == 'category') ? 'active' : ''?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Category</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview <?= ($name == 'customers' || $name == 'customer type') ? 'menu-open' : ''?>">
                                <a href="#" class="nav-link <?= ($name == 'customers' || $name == 'customer type') ? 'active' : ''?>">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        Customers
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= admin('customers') ?>" class="nav-link <?= ($name == 'customers') ? 'active' : ''?>">
                                            <i class="far fa-user nav-icon"></i>
                                            <p>Customers</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= admin('customerType') ?>" class="nav-link <?= ($name == 'customer type') ? 'active' : ''?>">
                                            <i class="fa fa-tasks nav-icon"></i>
                                            <p>Customer Type</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= admin('subscribers') ?>" class="nav-link <?= ($name == 'subscribers') ? 'active' : ''?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Subscribers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= admin('contact') ?>" class="nav-link <?= ($name == 'contact message') ? 'active' : ''?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Contact Messages</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="loading"><div></div><div></div><div></div></div>
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><?= ucwords($name) ?></h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="<?= admin() ?>">Home</a></li>
                                    <li class="breadcrumb-item <?= (!empty($operation)) ? '' : 'active' ?> "><?php if (!empty($operation)): ?><a href="<?= base_url($url) ?>"><?= ucwords($name) ?></a><?php else: ?><?= ucwords($name) ?><?php endif ?></li>
                                    <?php if (!empty($operation)): ?><li class="breadcrumb-item active"><?= ucwords($operation) ?></li><?php endif ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <?= $contents ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- jQuery -->
        <script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= assets('plugins/x-editable/bootstrap-editable.js') ?>"></script>

        <?php if (!empty($datatable)): $this->load->view("admin/include/datatables"); endif ?>
        <?php if (!empty($validation)): validation($url, (!empty($ignore)) ? $ignore : ""); endif;?>
        <!-- AdminLTE App -->
        <script src="<?= assets('dist/js/script.js') ?>"></script>
        <script src="<?= assets('dist/js/adminlte.min.js') ?>"></script>
        <script type="text/javascript">
        $(document).ready(function(){

        
        <?php if (isset($name) && $name == 'dashboard'): ?>
        $('#sample_data').dataTable({});
        $('#sample_data').editable({
            container:'body',
            mode: 'inline',
            selector:'td.price',
            url:"<?= base_url('admin/update-price') ?>",
            type:'POST',
            validate:function(value){
                if($.trim(value) == '')
                {
                    return 'This field is required';
                }
            }
        });

        <?php foreach ($cust_type as $k => $va): ?>
            $('#sample_data').editable({
                container:'body',
                mode: 'inline',
                selector:"td.price_<?= e_id($va['id']) ?>",
                url:"<?= base_url('admin/update-price') ?>",
                type:'POST',
                validate:function(value){
                    if($.trim(value) == '')
                    {
                        return 'This field is required';
                    }
                }
            });
        <?php endforeach ?>
        <?php endif ?>

        $(document).on('click', '.sidebar-mini', function(){
        if ($(this).hasClass("sidebar-collapse") == true) {
        document.cookie = "sidebar=sidebar-collapse; path=/";
        }else{
        document.cookie = "sidebar=; path=/";
        }
        })
        setTimeout(function(){ $(".loading").hide(); }, 300);
        });
        </script>
    </body>
</html>