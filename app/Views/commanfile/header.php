<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shipment </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/responsive.jqueryui.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/typography.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- modernizr css -->
    <script src="<?= base_url() ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>

    <div id="loader-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 9999;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 18px;">
            <div class="spinner-border text-white" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <h3 class="text-white">Processing... Please wait</h3>
        </div>
    </div>

    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="<?= base_url() ?>dashboard">
                        <h4>Shipment Company </h4>
                    </a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <?php if (session()->get('userRoleName') == 'Handler') { ?>
                                <li><a href="<?= base_url() ?>job-sheet"><i class="fa fa-sticky-note-o"></i> <span>Manage Jobs</span></a></li>
                                <li><a href="<?= base_url() ?>manage-delivery-notes"><i class="fa fa-cart-plus"></i> <span>Manage Delivery Notes</span></a></li>
                            <?php } else if (session()->get('userRoleName') == 'Management') { ?>
                                <li><a href="<?= base_url() ?>job-sheet"><i class="fa fa-sticky-note-o"></i> <span>Manage Jobs</span></a></li>
                                <li><a href="<?= base_url() ?>manage-delivery-notes"><i class="fa fa-cart-plus"></i> <span>Manage Delivery Notes</span></a></li>
                                <li><a href="<?= base_url() ?>invoices"><i class="ti-receipt"></i> <span>Invoices</span></a></li>
                            <?php } else if (session()->get('userRoleName') == 'Sub-Admin') { ?>
                                <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <li><a href="<?= base_url() ?>job-sheet"><i class="fa fa-sticky-note-o"></i> <span>Manage Jobs</span></a></li>
                                <li><a href="<?= base_url() ?>manage-delivery-notes"><i class="fa fa-cart-plus"></i> <span>Manage Delivery Notes</span></a></li>
                                <li><a href="<?= base_url() ?>invoices"><i class="ti-receipt"></i> <span>Invoices</span></a></li>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="false"><i class="fa fa-upload"></i>
                                        <span>Import Files</span></a>
                                    <ul class="collapse" style="height: 0px;">
                                        <li><a href="<?= base_url() ?>import-job">Jobs</a></li>
                                        <li><a href="<?= base_url() ?>import-deliverynotes">Delivery Notes</a></li>
                                        <li><a href="<?= base_url() ?>import-invoices">Invoices</a></li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                                <li><a href="<?= base_url() ?>user"><i class="fa fa-user"></i> <span>Manage Users</span></a></li>
                                <li><a href="<?= base_url() ?>job-sheet"><i class="fa fa-sticky-note-o"></i> <span>Manage Jobs</span></a></li>
                                <li><a href="<?= base_url() ?>manage-delivery-notes"><i class="fa fa-cart-plus"></i> <span>Manage Delivery Notes</span></a></li>
                                <li><a href="<?= base_url() ?>invoices"><i class="ti-receipt"></i> <span>Invoices</span></a></li>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="false"><i class="fa fa-upload"></i>
                                        <span>Import Files</span></a>
                                    <ul class="collapse" style="height: 0px;">
                                        <li><a href="<?= base_url() ?>import-job">Jobs</a></li>
                                        <li><a href="<?= base_url() ?>import-deliverynotes">Delivery Notes</a></li>
                                        <li><a href="<?= base_url() ?>import-invoices">Invoices</a></li>
                                    </ul>
                                </li>
                            <?php } ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <!-- <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div> -->
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-sm-6 clearfix">

                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo session()->get('userRoleName'); ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <!-- <a class="dropdown-item" href="#">Message</a>
                                <a class="dropdown-item" href="#">Settings</a> -->
                                <a class="dropdown-item" href="<?= base_url() ?>logout">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area p-4">
                <div class="row align-items-center">
                    <div class="col-sm-10">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left"><?= $pageTitle ?></h4>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="breadcrumbs-area clearfix pull-right">
                            <a href="javascript:history.back()" class="btn btn-secondary">
                                <i class="fa fa-backward"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sidebar menu area end -->
            <?= $this->renderSection('content'); ?>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2024. <a href="#">Growapse</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>

    <!-- jquery latest version -->
    <script src="<?= base_url() ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/js/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.slicknav.min.js"></script>

    <script src="<?= base_url() ?>assets/js/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/js/responsive.bootstrap.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

    <!-- all line chart activation -->
    <script src="<?= base_url() ?>assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="<?= base_url() ?>assets/js/pie-chart.js"></script>
    <!-- all bar chart -->
    <script src="<?= base_url() ?>assets/js/bar-chart.js"></script>
    <!-- all map chart -->
    <script src="<?= base_url() ?>assets/js/maps.js"></script>
    <!-- others plugins -->
    <script src="<?= base_url() ?>assets/js/plugins.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <?= $this->renderSection('pagescripts'); ?>
    <script>
        $('.modal').on('hidden.bs.modal', function() {
            // Clear all form fields
            $(this).find('form')[0].reset();
            // Clear all validation error messages
            $(this).find('.text-danger').text('');
        });
    </script>

    <?= $this->renderSection('pagescripts'); ?>

    <!-- <div class="modal fade show" id="jobsheetModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Job Sheet</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Upload Excel Here</label>
                                        <input type="file" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</body>

</html>