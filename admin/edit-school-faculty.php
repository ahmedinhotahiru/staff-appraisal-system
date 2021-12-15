

<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Admin | Edit School/Faculty</title>
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
        ?>



        <?php

            if(!isset($_GET['id']) || empty($_GET['id'])) {
                header("Location: schools-faculties.php");
                exit();
            }
            else {

                // get details
                $id = trim($_GET['id']);
                $school_faculty = select_all_where("schools_faculties", "school_faculty_id", $id);

                if(count($school_faculty) > 0) {

                    // get details
                    $school_faculty_name = $school_faculty[0]["school_faculty_name"];
                    $acronym = $school_faculty[0]["acronym"];

                }
                else {
                    header("Location: schools-faculties.php");
                    exit();
                }
            }
        ?>







                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Edit School/Faculty</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Schools & Faculties</a></li>
                                            <li class="breadcrumb-item active">Edit</li>
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

                                                    case 'name':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                School/Faculty name must contain only letters (and optional numbers)
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                        break;

                                                    case 'nameExists':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                School/Faculty name already exists
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                        break;

                                                    case 'acronymExists':
                                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                <i class="mdi mdi-block-helper me-2"></i>
                                                                Acronym already exists
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
                                                                Failed to edit school/faculty. Please try again!
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                              </div>';
                                                        break;
                                                    
                                                }
                                            }


                                        ?>









                                            <form action="controls/edit-school-faculty.php"  method="post">
                                                <input type="hidden"/>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group mb-3">
                                                            <label>School/Faculty Name</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter a School/Faculty Name" class="form-control" name="school_faculty_name" value="<?php if(isset($_GET['school_faculty_name'])) {echo $_GET['school_faculty_name'];} else {echo $school_faculty_name;}?>"/>
                                                        </div>
                                                    </div>
                                                   
                                                

                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Acronym</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter the school/faculty acronym" class="form-control" name="acronym" value="<?php if(isset($_GET['acronym'])) {echo $_GET['acronym'];} else {echo $acronym;}?>"/>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- end row -->

                                                <input type="hidden" name="school_faculty_id" value=<?php echo $id; ?>>

                                               
                                                <div class="form-group">
                                                    <button type="submit" name="edit" class="btn btn-primary">Edit School/Faculty</button>
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
