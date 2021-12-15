<?php
    if(!isset($_GET['id']) || empty($_GET['id'])) {

        // header("Location: dashboard.php");
        // exit();
        
        echo "<script>
                    alert('Error... Please select a staff');
                    window.location.href = 'dashboard.php';
              </script>";
        exit();
    }
    else {

        // check staff id
        $id = trim($_GET['id']);

        if(!preg_match("/^[0-9]+$/", $id)) {
            echo "<script>
                    alert('Error... Invalid staff id');
                    window.location.href = 'dashboard.php';
                </script>";
            exit();

        }
        
    }

    
?>

<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Admin | Edit Staff</title>
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

            // get staff details
            $staff = select_all_where("staff", "staff_id", $id);

            if(count($staff) > 0) {

                $staff_id = $staff[0]['staff_id'];
                $staff_id_no = $staff[0]['staff_id_no'];
                $title = $staff[0]['title'];
                $staff_name = $staff[0]['staff_name'];
                $sch_fac_dept_id = $staff[0]['sch_fac_dept_id'];
                $role = $staff[0]['role'];
                $position = $staff[0]['position'];
                $email = $staff[0]['email'];

            }
            else {
                echo "<script>
                    alert('Error... Invalid staff id');
                    window.location.href = 'dashboard.php';
                    </script>";
                exit();
            }
        ?>







                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Edit Staff</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Staff</a></li>
                                            <li class="breadcrumb-item active">Edit Staff</li>
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

                                                if(isset($_GET['edit'])) {
                                                    $edit = $_GET['edit'];
                                                    switch ($edit) {
                                                        case 'failed':
                                                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <i class="mdi mdi-block-helper me-2"></i>
                                                                    Failed to edit staff. Please try again!
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>';
                                                            break;
                                                        
                                                    }
                                                }


                                            ?>











                                            <form action="controls/edit-staff.php"  method="post">
                                                
                                                <div class="row">
                                                    
                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Title</label>
                                                            <select name="title" required class="form-control form-select">
                                                                <option value="">Select title</option>

                                                                <option value="Dr." <?php if(isset($_GET['title']) && $_GET['title']=='Dr.') {echo 'selected';} else { if($title == 'Dr.') {echo 'selected';}} ?>>Dr.</option>

                                                                <option value="Mr." <?php if(isset($_GET['title']) && $_GET['title']=='Mr.') {echo 'selected';} else { if($title == 'Mr.') {echo 'selected';}}?>>Mr.</option>

                                                                <option value="Ms." <?php if(isset($_GET['title']) && $_GET['title']=='Ms.') {echo 'selected';} else { if($title == 'Ms.') {echo 'selected';}}?>>Ms.</option>

                                                                <option value="Mrs." <?php if(isset($_GET['title']) && $_GET['title']=='Mrs.') {echo 'selected';} else { if($title == 'Mrs.') {echo 'selected';}}?>>Mrs.</option>

                                                                <option value="Prof." <?php if(isset($_GET['title']) && $_GET['title']=='Prof.') {echo 'selected';} else { if($title == 'Prof.') {echo 'selected';}}?>>Prof.</option>

                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Fullname</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter a surname" class="form-control" name="staff_name" value="<?php if(isset($_GET['staff_name'])) {echo $_GET['staff_name'];} else {echo $staff_name;} ?>"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4 col-md-6">


                                                        <div class="form-group mb-3">
                                                            <label>Staff ID</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter Staff ID" class="form-control" name="staff_id_no" value="<?php if(isset($_GET['staff_id_no'])) {echo $_GET['staff_id_no'];} else {echo $staff_id_no;} ?>"/>
                                                        </div>


                                                    </div>


                                                    <div class="col-xl-4 col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>Position</label>
                                                            <input type="text" required data-pristine-required-message="Please Enter Position"  class="form-control" name="position" value="<?php if(isset($_GET['position'])) {echo $_GET['position'];} else {echo $position;} ?>"/>
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
                                                                                <option value="<?php echo $school_faculty_id; ?>" <?php if(isset($_GET['sch_fac_dept_id']) && $_GET['sch_fac_dept_id'] == $school_faculty_id) {echo 'selected';} else {if($sch_fac_dept_id == $school_faculty_id) {echo 'selected';}} ?>><?php echo $school_faculty_name; ?></option>
                                                                                
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
                                                                                <option value="<?php echo $department_id; ?>" <?php if(isset($_GET['sch_fac_dept_id']) && $_GET['sch_fac_dept_id'] == $department_id) {echo 'selected';} else {if($sch_fac_dept_id == $department_id) {echo 'selected';}} ?>><?php echo $department_name; ?></option>
                                                                                
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
                                                            <input type="email" required data-pristine-required-message="Please Enter an Email" class="form-control" name="email" value="<?php if(isset($_GET['email'])) {echo $_GET['email'];} else {echo $email;}?>" validate/>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                                <!-- end row -->

                                                <br>
                                                <div class="form-group">
                                                    <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                                                    <button type="submit" name="edit-staff" class="btn btn-primary"><i class="bx bx-check"></i>Save Changes</button>
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
