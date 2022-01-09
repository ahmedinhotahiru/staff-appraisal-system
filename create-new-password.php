<!doctype html>
<html lang="en">

    
    <head>

        <meta charset="utf-8" />
        <title>Reset Password | Staff Appraisal - SDD UBIDS</title>
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
                    <!-- col-xxl-3 col-lg-4 col-md-5 -->

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
                                            <h5 class="mb-0">Create New Password</h5>
                                            <p class="text-muted mt-2">Staff Appraisal Sytem</p>
                                        </div>



                                        <!-- display error messages here -->
                                        <?php
                                            if(isset($_GET['error'])) {
                                                $error = $_GET['error'];
                                                switch ($error) {
                                                    case 'empty':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                All fields are required!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;


                                                    case 'user':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Username not found!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;

                                                    case 'password':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Invalid Password!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;

                                                    case 'login':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Login required!
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

                                            if(isset($_GET['newPwd']) && $_GET['newPwd']== "updateSuccess") {
                                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <i class="mdi mdi-check-all me-2"></i>
                                                        Password successfully changed. Please login with new password
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                      </div>';
                                            }

                                        ?>







                                        <!-- validate if tokens exist are valid hexadecimal digits -->
                                        <?php

                                            $selector = $_GET['selector'];
                                            $validator = $_GET['validator'];

                                            if(empty($selector) || empty($validator)) {
                                            header("Location: auth-recoverpw.php?error=failed");
                                            }
                                            else {
                                                // check if they are hexadecimal

                                                if(ctype_xdigit($selector) && ctype_xdigit($validator)) {

                                                    // close php in order to type html for form
                                                    ?>



                                                    <!-- display form for new password -->
                                                    <form class="mt-4 pt-2" action="reset-password.php" method="POST">
                                                 

                                                        <?php
                                                            if(isset($_GET['password'])) {

                                                                $status = $_GET['password'];

                                                                switch ($status) {
                                                                        case 'empty':
                                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                                    All fields are required!
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                </div>';
                                                                            break;

                                                                        case 'match':
                                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                                    Passwords do not match!
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                </div>';
                                                                            break;

                                                                        case 'success':
                                                                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                                    Password changed successfully. Please <a href="index.php">Login</a>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                                </div>';
                                                                            break;

                                                                        default:
                                                                            echo "<p class='text-danger'>An error occured, try again.</p>";
                                                                            break;
                                                                }


                                                            }


                                                        ?>
                                                        
                                                        
                                                        
                                                        <br><br>

                                                        

                                                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                                                        <input type="hidden" name="validator" value="<?php echo $validator; ?>">

                                                        

                                                        <div class="mb-3">

                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <label class="form-label">New Password</label>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                            <div class="input-group auth-pass-inputgroup">

                                                                <input type="password" name="password" class="form-control" placeholder="Enter new confirm" required>

                                                            </div>

                                                        </div>

                                                        <div class="mb-3">
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1">
                                                                    <label class="form-label">Confirm New Password</label>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                            <div class="input-group auth-pass-inputgroup">

                                                                <input type="password" name="password-repeat" class="form-control" placeholder="Repeat new confirm" aria-label="Password" aria-describedby="password-addon" required>

                                                                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                            </div>
                                                        </div>

                                                        <div class="text-center">
                                                            <a href="index.php" class="text-muted">Remember old password?</a>
                                                        </div>
                                                    
                                                        <div class="my-3">
                                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" name="reset-password">Reset Password</button>
                                                        </div>

                                                    
                                                    

                                                    </form>


                                                    <?php

                                                }
                                                else {
                                                    header("Location: auth-recoverpw.php?error=failed");
                                                }
                                            }

                                        ?>


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
        <!-- password addon init -->
        <script src="assets/js/pages/pass-addon.init.js"></script>

    </body>


</html>