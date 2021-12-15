<?php
    if(!isset($_GET['role']) || empty($_GET['role'])) {
        // die("Please select a staff type at the staff menu");
        echo "<script>
                    alert('Error... Please select a staff type at the staff menu');
                    window.location.href = 'dashboard.php';
              </script>";
        // header("Location: dashboard.php");
        exit();
    }

    else {
        $roleVal = $_GET['role'];

        switch ($roleVal) {
            case 1:
                $role = "Dean";
                break;

            case 2:
                $role = "HOD";
                break;

            case 3:
                $role = "Lecturer";
                break;
            
            default:
            echo "<script>
                            alert('Invalid role/staff type... Please select a staff type at the staff menu');
                            window.location.href = 'dashboard.php';
                    </script>";
                exit();
                break;
        }
    }
?>

<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Admin | Add <?php echo $role; ?></title>
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
                                    <h4 class="mb-sm-0 font-size-18">Add <?php echo $role; ?></h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Staff</a></li>
                                            <li class="breadcrumb-item active">Add Staff</li>
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

                                                        case 'emptySchFacDept':
                                                            if($role == 'Dean') {
                                                                $sch_fac = "School/Faculty";
                                                            }
                                                            else {
                                                                $sch_fac = "Department";
                                                            }
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Please select a '.$sch_fac.'
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                            break;

                                                        case 'staffName':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Staff name must contain only letters
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                    </div>';
                                                            break;

                                                        case 'email':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Please enter a valid email address
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                    </div>';
                                                            break;

                                                        case 'staffExists':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Staff ID already exists for a registered staff
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                    </div>';
                                                            break;

                                                        case 'emailExists':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Email is already taken by a registered staff
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
                                                                    Failed to add staff. Please try again!
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                            break;
                                                        
                                                    }
                                                }


                                            ?>











                                            <form action="controls/add-staff.php"  method="post">
                                                
                                                <div class="row">
                                                    
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Title</label>
                                                            <select name="title" required class="form-control form-select">
                                                                <option value="">Select title</option>
                                                                <option value="Dr." <?php if(isset($_GET['title']) && $_GET['title']=='Dr.') {echo 'selected';} ?>>Dr.</option>
                                                                <option value="Mr." <?php if(isset($_GET['title']) && $_GET['title']=='Mr.') {echo 'selected';} ?>>Mr.</option>
                                                                <option value="Ms." <?php if(isset($_GET['title']) && $_GET['title']=='Ms.') {echo 'selected';} ?>>Ms.</option>
                                                                <option value="Mrs." <?php if(isset($_GET['title']) && $_GET['title']=='Mrs.') {echo 'selected';} ?>>Mrs.</option>
                                                                <option value="Prof." <?php if(isset($_GET['title']) && $_GET['title']=='Prof.') {echo 'selected';} ?>>Prof.</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Fullname</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter a surname" class="form-control" name="staff_name" value="<?php if(isset($_GET['staff_name'])) {echo $_GET['staff_name'];} ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-md-6">

                                                        <?php

                                                            // if()

                                                        ?>


                                                        <div class="form-group mb-3">
                                                            <label>Staff ID</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter Staff ID" class="form-control" name="staff_id_no" value="<?php if(isset($_GET['staff_id_no'])) {echo $_GET['staff_id_no'];} ?>"/>
                                                        </div>


                                                    </div>


                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Position</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter Position"  class="form-control" name="position" value="<?php if(isset($_GET['position'])) {echo $_GET['position'];} ?>"/>
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Role</label>
                                                            <input type="text" class="form-control disabled" value="<?php echo $role; ?>" disabled/>
                                                            <input type="hidden" class="form-control" name="role" value="<?php echo $role; ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">

                                                        <?php
                                                            if($role == "Dean") {
                                                                ?>
                                                                <label>School/Faculty</label>

                                                                <select class="form-control" data-trigger name="sch_fac_dept_id"
                                                                id="choices-single-default" placeholder="Select School/Faculty">

                                                                    <option value="">Select School/Faculty</option>

                                                                    <!-- get all schools and faculties -->
                                                                    <?php

                                                                        $schools_faculties = select_all("schools_faculties");
                                                                        if(count($schools_faculties) > 0) {

                                                                            foreach ($schools_faculties as $school_faculty) {
                                                                                $school_faculty_id = $school_faculty['school_faculty_id'];
                                                                                $school_faculty_name = $school_faculty['school_faculty_name'];

                                                                                ?>
                                                                                <option value="<?php echo $school_faculty_id; ?>" <?php if(isset($_GET['sch_fac_dept_id']) && $_GET['sch_fac_dept_id'] == $school_faculty_id) {echo 'selected';} ?>><?php echo $school_faculty_name; ?></option>
                                                                                
                                                                                <?php
                                                                            }
                                                                        }

                                                                    ?>
                                                                </select>

                                                                <?php
                                                            }

                                                            else {
                                                                ?>
                                                                <label>Department</label>

                                                                <select class="form-control" data-trigger name="sch_fac_dept_id"
                                                                id="choices-single-default" placeholder="Select School/Faculty">

                                                                    <option value="">Select Department</option>

                                                                    <!-- get all departments -->
                                                                    <?php

                                                                        $departments = select_all("departments");
                                                                        if(count($departments) > 0) {

                                                                            foreach ($departments as $department) {
                                                                                $department_id = $department['department_id'];
                                                                                $department_name = $department['department_name'];

                                                                                ?>
                                                                                <option value="<?php echo $department_id; ?>" <?php if(isset($_GET['sch_fac_dept_id']) && $_GET['sch_fac_dept_id'] == $department_id) {echo 'selected';} ?>><?php echo $department_name; ?></option>
                                                                                
                                                                                <?php
                                                                            }
                                                                        }

                                                                    ?>
                                                                </select>

                                                                <?php
                                                            }
                                                        ?>

                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Email</label>
                                                            <input type="email" required data-pristine-required-message="Please Enter an Email" class="form-control" name="email" value="<?php if(isset($_GET['email'])) {echo $_GET['email'];} ?>" validate/>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                                <!-- end row -->

                                                <br>
                                                <div class="form-group">
                                                    <button type="submit" name="add-staff" class="btn btn-primary"><i class="bx bx-plus"></i>Add <?php echo $role; ?></button>
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
