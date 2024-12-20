<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - Shipment Management</title>
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
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/typography.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="<?= base_url() ?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        .has-error-msg {
            color: red;
        }
    </style>
</head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form id="loginform" method="POST">
                    <div class="login-form-head">
                        <h4>Login Here</h4>
                    </div>
                    <div class="alert-container m-2"></div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="email">Username</label>
                            <input type="email" name="email" id="email">
                            <i class="ti-email"></i>
                            <div class="error-text"></div>
                        </div>
                        <div class="form-gp">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                            <i class="ti-lock"></i>
                            <div class="error-text"></div>
                        </div>
                        <!-- <div class="row mb-4 rmber-area">
                            <div class="col-6 text-left">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div> -->
                        <div class="submit-btn-area">
                            <a id="form_submit" href="javascript:void(0)" onclick="login()" type="submit">Sign In <i class="ti-arrow-right"></i></a>
                        </div>
                        <!-- <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="register.php">Sign up</a></p>
                        </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    </form>

    <!-- jquery latest version -->
    <script src="<?= base_url() ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/js/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="<?= base_url() ?>assets/js/plugins.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>

    <script>
        $(document).ready(function() {
            // For input fields
            $("input").on("change", function() {
                $(this).closest('.form-gp').find('.error-text').text('');
            });

            // For select elements
            $("select").on("change", function() {
                $(this).closest('.form-gp').find('.error-text').text('');
            });
        })

        function login() {
            var formData = $('#loginform').serialize();
            $.ajax({
                url: '<?= base_url() ?>login',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status) {
                        // Redirect if login is successful
                        window.location.href = response.redirect;
                    } else if (response.errors) {
                        for (const field in response.errors) {
                            if (response.errors.hasOwnProperty(field)) {
                                const inputField = $('[name="' + field + '"]');
                                if (inputField.length) {
                                    inputField.closest('.form-gp').addClass('has-error-msg');
                                    inputField.closest('.form-gp').find('div.error-text').text(response.errors[field]);
                                } else {
                                    console.error('Input field not found for:', field);
                                }
                            }
                        }
                    } else {
                        $('.alert-container').html("<div class='alert alert-danger'>" + response.message + "</div>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    $('.alert-container').html("<div class='alert alert-danger'>AJAX error occurred: " + error + "</div>");
                }
            });
        }
    </script>
</body>

</html>