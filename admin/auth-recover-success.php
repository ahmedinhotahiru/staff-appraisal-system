<!doctype html>
<html lang="en">

    
    <head>

        <meta charset="utf-8" />
        <title>Recover Password | Staff Appraisal - SDD UBIDS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SDD-UBIDS Staff Appraisal" name="description" />
        <meta content="SDD-UBIDS" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/logo.png">

        <!-- preloader css -->
        <link rel="stylesheet" href="../assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">

                    <div class="col-md-4 offset-md-4">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="index.php" class="d-block auth-logo">
                                            <img src="../assets/images/logo.png" alt="" height="28"> <span class="logo-txt">SDD UBIDS</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <div class="avatar-lg mx-auto">
                                                <div class="avatar-title rounded-circle bg-light">
                                                    <i class="bx bxs-envelope h2 mb-0 text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="p-2 mt-4">
                                                <h4>Check your email</h4>
                                                <p>
                                                    We have sent you password reset link to
                                                    <span class="fw-bold"><?php echo isset($_GET['email']) && !empty($_GET['email']) ? $_GET['email'] : "your email"; ?></span>, Please check it
                                                </p>
                                                <div class="mt-4">
                                                    <!-- <a href="auth-confirm-code.php" class="btn btn-primary w-10">Enter reset code</a> -->
                                                    <form action="reset-password-request.php" method="post">
                                                        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
                                                        <button type="submit" name="reset-password" class="btn btn-primary w-10">Re-send reset link</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Remember your password ? 
                                                <a href="index.php"
                                                    class="text-primary fw-semibold"> Login 
                                                </a> 

                                                </p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    
                    
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->
        <script src="../assets/libs/jquery/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="../assets/libs/pace-js/pace.min.js"></script>

    </body>


<!-- Mirrored from minia.php.themesbrand.com/auth-email-verification.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Nov 2021 12:08:12 GMT -->
</html>