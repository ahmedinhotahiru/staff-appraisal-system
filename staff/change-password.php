<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Staff Appraisal | Change Password</title>
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


        
    

    
        <?php
            include "includes/header.inc.php";

            if($_SESSION['appraisal_role'] == "Dean") {
                $sch_fac_dept_name = school_faculty_name($_SESSION['appraisal_sch_fac_dept_id']);
            }
            else {
                $sch_fac_dept_name = department_name($_SESSION['appraisal_sch_fac_dept_id']);
            }
        ?>







                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Change Password</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Account</a></li>
                                            <li class="breadcrumb-item active">Change Password</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                      
                        

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title"><?php echo $_SESSION['appraisal_role']; ?></h4>
                                        <p class="card-title-desc"><?php echo $sch_fac_dept_name; ?></p>
                                    </div>
                                    <!-- end card header -->

                                    <div class="card-body">

                                        <div>




                                            <!-- display error/SUCCESS messages here -->
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

                                                        case 'pwdMatch':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    New passwords do not match
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                    </div>';
                                                            break;

                                                        case 'pwdLength':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    New password should contain at least 8 characters
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                    </div>';
                                                            break;

                                                        case 'oldPwd':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Old Password is invalid!
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

                                                if(isset($_GET['update'])) {
                                                    $update = $_GET['update'];
                                                    switch ($update) {
                                                        case 'failed':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Failed to change password. Please try again!
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                            break;

                                                        case 'success':
                                                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-check-all me-2"></i>
                                                                    Password changed successfully
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                            break;
                                                        
                                                    }
                                                }


                                            ?>






                                            <form action="controls/change-password.php" validate method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Old Password</label>
                                                            <input type="password" name="old_password" required data-pristine-required-message="Please Enter Old Password" class="form-control"/>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>New Password</label>
                                                            <input type="password" id="pwd" name="new_password" required data-pristine-required-message="Please Enter a password" minlength="8" class="form-control" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Retype New Password</label>
                                                            <input type="password" data-pristine-equals="#pwd" name="new_password_confirm" data-pristine-equals-message="Passwords don't match" minlength="8" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="form-group mb-3 form-check">
                                                    <input id="term-check01" type="checkbox" class="form-check-input" name="future" required data-pristine-required-message="You must acknowledge the profile update"/>
                                                    <label class="form-check-label" for="term-check01">I acknowledge the password change</label><br/>
                                                </div>
                                                <div class="form-group">
                                                    <button  type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                                                </div>
                                            </form>
                                        </div>

                                        
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->






        <?php include "includes/footer.inc.php"; ?>
        



                
        <!-- JAVASCRIPT -->
        <script src="../assets/libs/jquery/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="../assets/libs/pace-js/pace.min.js"></script>

       <!-- pristine js -->
       <script src="../assets/libs/pristinejs/pristine.min.js"></script>
        <!-- form validation -->
       <script src="../assets/js/pages/form-validation.init.js"></script>

        <script src="../assets/js/app.js"></script>

    </body>

</html>
