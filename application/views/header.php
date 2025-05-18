<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sisfo Kominfo</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('vendor') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('vendor') ?>/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url() ?>assets/toast-master/css/jquery.toast.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/summernote/dist/summernote.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/styles.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('vendor') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('vendor') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
       <!-- Font Awesome CSS -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-success">
            <!-- Left navbar links -->
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">SISFO</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/kominfo.jpg') ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <!-- HMPS -->
                        <?php if ($this->session->userdata('session_login')['level'] == 'hmps') : ?>
                            <li class="nav-item has-treeview">
                                <a href="<?= site_url('controllerHome') ?>" class="nav-link">
                                    <i class="fas fa-fw fa-home"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('hmps/ControllerDaftar') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Kegiatan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('hmps/ControllerDaftar/riwayat') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Riwayat Kegiatan
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- END HMPS -->

                        <!-- PEMBINA -->
                        <?php if ($this->session->userdata('session_login')['level'] == 'pembina') : ?>
                            <li class="nav-item has-treeview">
                                <a href="<?= site_url('controllerHome') ?>" class="nav-link">
                                    <i class="fas fa-fw fa-home"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('pembina/ControllerPembina/') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Pendaftaran Kegiatan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('pembina/ControllerPembina/riwayat') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Riwayat Kegiatan
                                    </p>
                                </a>
                            </li>                 
                             <li class="nav-item">
                                <a href="<?= site_url('pembina/ControllerPembina/register') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Buat Akun Hmps
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('pembina/ControllerPembina/user') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        User Hmps
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <!-- END PEMBINA -->

                        <!-- PPKN -->
                        <?php if ($this->session->userdata('session_login')['level'] === 'ppkn') : ?>

                            <li class="nav-item has-treeview">
                                <a href="<?= site_url('controllerHome') ?>" class="nav-link">
                                    <i class="fas fa-fw fa-home"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('ppkn/ControllerPpkn/') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Pendaftaran Kegiatan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('ppkn/ControllerPpkn/riwayat') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Riwayat Kegiatan
                                    </p>
                                </a>
                            </li>                 
                             <li class="nav-item">
                                <a href="<?= site_url('ppkn/ControllerPpkn/user') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        User (Prodi)
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('ppkn/ControllerPpkn/register') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Buat Akun Pembina (Prodi)
                                    </p>
                                </a>
                            </li>
         
                            <?php endif; ?>

                            <!-- END PPKN -->

                        <!-- BP -->
                        <?php if ($this->session->userdata('session_login')['level'] === 'bp') : ?>

                            <li class="nav-item has-treeview">
                                <a href="<?= site_url('controllerHome') ?>" class="nav-link">
                                    <i class="fas fa-fw fa-home"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('bendahara/ControllerBendahara/') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Pendaftaran Kegiatan
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('bendahara/ControllerBendahara/riwayat') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Riwayat Kegiatan
                                    </p>
                                </a>
                            </li> 
                            <li class="nav-item">
                                <a href="<?= site_url('bendahara/fakultas/') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        Data Fakultas & Jurusan
                                    </p>
                                </a>
                            </li>   
                            <li class="nav-item">
                                <a href="<?= site_url('bendahara/ControllerBendahara/user') ?>" class="nav-link">
                                <i class="fas fa-fw fa-address-book"></i>
                                    <p>
                                        User PKA
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>

                            <!-- END BP -->

                     
                        <li class="nav-item">
                            <a href="<?= site_url('controllerLogin/logout') ?>" class="nav-link">
                                <i class="fas fa-fw fa-sign"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-content">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">