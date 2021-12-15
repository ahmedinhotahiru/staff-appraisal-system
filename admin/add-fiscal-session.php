<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Admin | Add Session</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SDD-UBIDS Staff Appraisal" name="description" />
        <meta content="SDD-UBIDS" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/logo.png">

        <!-- choices css -->
        <link href="../assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

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
        ?>







                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Add Session</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sessions</a></li>
                                            <li class="breadcrumb-item active">Add New</li>
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
                                        <h4 class="card-title">Fill the form below</h4>
                                        <p class="card-title-desc">All fields are required</p>
                                    </div>
                                    <!-- end card header -->

                                    <div class="card-body"  style="height:400px">

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

                                                    

                                                    case 'yearExists':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Fiscal year already exists
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

                                            if(isset($_GET['add'])) {
                                                $add = $_GET['add'];
                                                switch ($add) {
                                                    case 'failed':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Failed to add session. Please try again!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;
                                                    
                                                }
                                            }


                                        ?>









                                            <form action="controls/add-fiscal-session.php"  method="post">
                                                
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Fiscal Year</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter a Fiscal Year" class="form-control" name="fiscal_year" value="<?php if(isset($_GET['fiscal_year'])) {echo $_GET['fiscal_year'];} ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Deadline</label>
                                                            <input type="date" required data-pristine-required-message="Please select a Deadline" class="form-control" name="deadline" value="<?php if(isset($_GET['deadline'])) {echo $_GET['deadline'];} ?>"/>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Status</label>
                                                            <select name="status" required class="form-control form-select">
                                                                <option value="">Select status</option>

                                                                <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=="1") {echo 'selected';} ?>>Open</option>

                                                                <option value="2" <?php if(isset($_GET['status']) && $_GET['status']=="2") {echo 'selected';} ?>>Closed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                   
                                                

                                                    

                                                </div>
                                                <!-- end row -->

                                               
                                                <div class="form-group">
                                                    <button type="submit" name="add" class="btn btn-primary">Add Session</button>
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

        <!-- choices js -->
        <script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

       <!-- pristine js -->
       <script src="../assets/libs/pristinejs/pristine.min.js"></script>
        <!-- form validation -->
       <script src="../assets/js/pages/form-validation.init.js"></script>

       <!-- init js -->
       <script src="../assets/js/pages/form-advanced.init.js"></script>

        <script src="../assets/js/app.js"></script>

    </body>

</html>
