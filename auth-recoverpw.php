<!doctype html>
<html lang="en">

    
    <head>

        <meta charset="utf-8" />
        <title>Recover Password | Staff Appraisal - SDD UBIDS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SDD-UBIDS Staff Appraisal" name="description" />
        <meta content="SDD-UBIDS" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo.png">

        <!-- preloader css -->
        <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

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
                                            <img src="assets/images/logo.png" alt="" height="28"> <span class="logo-txt">SDD UBIDS</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Reset Password</h5>
                                            <p class="text-muted mt-2">Staff Appraisal System.</p>
                                        </div>
                                        <div class="alert alert-success text-center my-4" role="alert">
                                            Enter your Email and instructions will be sent to you!
                                        </div>




                                        <!-- display error messages here -->
                                        <?php
                                            if(isset($_GET['error'])) {
                                                $error = $_GET['error'];
                                                switch ($error) {
                                                    case 'empty':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Email is required!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;


                                                    case 'userNotFound':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Email not found for any user!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;

                                                    case 'failed':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Request failed! Please try again
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                        break;

                                                   
                                                    
                                                    default:
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                An error occured, try again!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;
                                                }
                                            }

                                            

                                        ?>








                                        <form class="mt-4" action="reset-password-request.php" method="post">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php if(isset($_GET['email'])) {echo $_GET['email'];} ?>">
                                            </div>
                                            <div class="mb-3 mt-4">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" name="reset-password">Reset</button>
                                            </div>
                                        </form>

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Remember It ?  <a href="index.php"
                                                    class="text-primary fw-semibold"> Sign In </a> </p>
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
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="assets/libs/pace-js/pace.min.js"></script>

    </body>


</html>