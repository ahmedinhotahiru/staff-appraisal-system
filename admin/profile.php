<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Staff Appraisal | Profile</title>
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

            // get details
            $user = select_all_where("admin", "id", $_SESSION['admin_id']);

            if(count($user) > 0){

                $username = $user[0]["username"];
                $email = $user[0]["email"];
            }
            else {
                header("Location: dashboard.php");
                exit();
            }
        ?>







                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Profile</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Profile</a></li>
                                            <li class="breadcrumb-item active">Edit Profile</li>
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
                                        <h4 class="card-title">Administrator</h4>
                                        <p class="card-title-desc">Staff Appraisal System</p>
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

                                                        case 'email':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Email is invalid
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

                                                if(isset($_GET['edit'])) {
                                                    $edit = $_GET['edit'];
                                                    switch ($edit) {
                                                        case 'failed':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Failed to add school/faculty. Please try again!
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                            break;

                                                        case 'success':
                                                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Profile updated successfully
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                            break;
                                                        
                                                    }
                                                }


                                            ?>









                                            <form action="controls/profile.php"  method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Username</label>
                                                            <input type="text" name="username" required data-pristine-required-message="Please Enter a username" class="form-control" value="<?php echo isset($_GET['username']) ? $_GET['username'] : $username; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Email</label>
                                                            <input type="email" name="email" required data-pristine-required-message="Please Enter a Email" class="form-control" value="<?php echo isset($_GET['username']) ? $_GET['email'] : $email; ?>" validate/>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Role</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter a surname" class="form-control disabled" value="Administrator" disabled/>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                                <!-- end row -->

                                                <div class="form-group mb-3 form-check">
                                                    <input id="term-check01" type="checkbox" class="form-check-input" name="acknowledge" required data-pristine-required-message="You must acknowledge the profile update"/>
                                                    <label class="form-check-label" for="term-check01">I acknowledge the profile update</label><br/>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" name="update" class="btn btn-primary">Update profile</button>
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
