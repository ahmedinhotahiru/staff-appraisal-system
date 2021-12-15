<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Admin | Add Department</title>
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
                                    <h4 class="mb-sm-0 font-size-18">Add Department</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Departments</a></li>
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

                                                    case 'name':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Department name must contain only letters (and optional numbers)
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                        break;

                                                    case 'nameExists':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Department name already exists
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
                                                                Failed to add school/faculty. Please try again!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;
                                                    
                                                }
                                            }


                                        ?>









                                            <form action="controls/add-department.php"  method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Department Name</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter a Department Name" class="form-control" name="department_name" value="<?php if(isset($_GET['department_name'])) {echo $_GET['department_name'];} ?>"/>
                                                        </div>
                                                    </div>
                                                   
                                                

                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="staff" class="form-label font-size-13 text-muted">School / Faculty</label>

                                                            <select class="form-control" data-trigger name="school_faculty_id"
                                                                id="choices-single-default"
                                                                placeholder="Select School/Faculty">
                                                                <option value="">Select School/Faculty</option>

                                                            <!-- get all schools and faculties -->
                                                            <?php

                                                                $schools_faculties = select_all("schools_faculties");
                                                                if(count($schools_faculties) > 0) {

                                                                    foreach ($schools_faculties as $school_faculty) {
                                                                        $school_faculty_id = $school_faculty['school_faculty_id'];
                                                                        $school_faculty_name = $school_faculty['school_faculty_name'];

                                                                        ?>
                                                                        <option value="<?php echo $school_faculty_id; ?>"><?php echo $school_faculty_name; ?></option>
                                                                        
                                                                        <?php
                                                                    }
                                                                }

                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- end row -->

                                               
                                                <div class="form-group">
                                                    <button type="submit" name="add" class="btn btn-primary">Add Department</button>
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
