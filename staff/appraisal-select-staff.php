
<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Staff Appraisal | Select Staff</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SDD-UBIDS Staff Appraisal" name="description" />
        <meta content="SDD-UBIDS" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/logo.png">

        <!-- choices css -->
        <link href="../assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

        <!-- color picker css -->
        <link rel="stylesheet" href="../assets/libs/%40simonwep/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->
        <link rel="stylesheet" href="../assets/libs/%40simonwep/pickr/themes/monolith.min.css"/> <!-- 'monolith' theme -->
        <link rel="stylesheet" href="../assets/libs/%40simonwep/pickr/themes/nano.min.css"/> <!-- 'nano' theme -->

        <!-- datepicker css -->
        <link rel="stylesheet" href="../assets/libs/flatpickr/flatpickr.min.css">

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


            if(!isset($_POST['appraise_fiscal_year'])) {
                echo "<script>
                        alert('Please select a fiscal year to appraise');
                        window.location.href = 'appraisal-select-session.php';
                      </script>";
                exit();
            }
            else {

                if(!isset($_POST['fiscal_session_id']) || empty($_POST['fiscal_session_id'])) {
                    echo "<script>
                            alert('Please select a fiscal year to appraise');
                            window.location.href = 'appraisal-select-session.php';
                        </script>";
                    exit();
                }
                else {
                    $fiscal_session_id = trim($_POST['fiscal_session_id']);

                    
                    // query for fiscal year
                    $fiscal_session = select_all_where("fiscal_sessions", "fiscal_session_id", $fiscal_session_id);

                    if(count($fiscal_session) > 0) {

                        // get fiscal session details

                        $fiscal_year = $fiscal_session[0]['fiscal_year'];
                        $deadline = $fiscal_session[0]['deadline'];
                        $status = $fiscal_session[0]['status'];

                        // check if deadline is not passed
                        if(strtotime($deadline) < strtotime(date("Y-m-d"))) {
                            echo "<script>
                                    alert('Sorry, appraisal deadline for selected fiscal year is due.');
                                    window.location.href = 'appraisal-select-session.php';
                                </script>";
                            exit();
                        }
                        else {

                            // check if fiscal session is open
                            if($status != 1) {
                                echo "<script>
                                        alert('Sorry, selected fiscal year is closed.');
                                        window.location.href = 'appraisal-select-session.php';
                                    </script>";
                                exit();
                            }
                            else {

                                // if fiscal session is open and deadline is not due, display form to select staff
                                ?>




                                
                                <div class="page-content">
                                    <div class="container-fluid">

                                        <!-- start page title -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                    <h4 class="mb-sm-0 font-size-18">Staff Appraisal</h4>

                                                    <div class="page-title-right">
                                                        <ol class="breadcrumb m-0">
                                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Staff Appraisal</a></li>
                                                            <li class="breadcrumb-item active">Select Staff</li>
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
                                                        <h4 class="card-title">Select Staff</h4>

                                                        <?php

                                                            if($_SESSION['appraisal_role'] == "Dean") {
                                                                $sch_fac_dept_name = school_faculty_name($_SESSION['appraisal_sch_fac_dept_id']);
                                                            }
                                                            else {
                                                                $sch_fac_dept_name = department_name($_SESSION['appraisal_sch_fac_dept_id']);
                                                            }

                                                        ?>
                                                        <!-- <p class="card-title-desc">Please select a staff to appraise.</p> -->
                                                        <p class="card-title-desc"><?php echo $sch_fac_dept_name; ?></p>

                                                    </div>
                                                    <!-- end card header -->

                                                    <div class="card-body" style="height:400px">
                                                        <div>
                                                            <!-- <h5 class="font-size-14 mb-3">Single select input Example</h5> -->


                                                            <form action="appraisal.php" method="post">


                                                                <div class="row mb-5">
                                                                    <div class="col-md-6">
                                                                        <div class="">
                                                                            <label for="staff" class="form-label font-size-13 text-muted">Staff</label>

                                                                            <select class="form-control" data-trigger name="staff_id"
                                                                                id="choices-single-default"
                                                                                placeholder="Search">
                                                                                <option value="">Select Staff</option>
                                   
                                
                                <?php

                                // get all staff in department (for hod role) or faculty/school (for dean role)

                                // for deans, display HODS
                                if($_SESSION['appraisal_role'] == "Dean") {

                                    $all_staff = select_all_where("staff", "role", "HOD");

                                    if(count($all_staff) > 0) {

                                        // get staff details
                                        $unappraised_staff = 0;
                                        foreach ($all_staff as $staff) {
                                            
                                            $staff_id = $staff['staff_id'];
                                            $sch_fac_dept_id = $staff['sch_fac_dept_id'];

                                            // use start department id to determine staff school/faculty id
                                            $staff_school_faculty_id = department_school_faculty_id($sch_fac_dept_id);

                                            // check if staff school id is same as logged in Dean
                                            if($staff_school_faculty_id == $_SESSION['appraisal_sch_fac_dept_id']) {


                                                // check if staff has been appraised already

                                                $staff_appraised = select_all_where_and("appraisal", "staff_id", $staff_id, "fiscal_session_id", $fiscal_session_id);

                                                // count unappraised eligible staff

                                                if(count($staff_appraised) < 1) {


                                                    // get other staff details
                                                    $title = $staff['title'];
                                                    $staff_name = $staff['staff_name'];
                                                    $staff_fullname = $title . " " . $staff_name;

                                                    // display staff as select option

                                                    ?>
                                                    
                                                    <option value="<?php echo $staff_id; ?>"><?php echo $staff_fullname; ?></option>

                                                    
                                                    <?php
                                                    $unappraised_staff++;
                                                }

                                            }
                                        }
                                    }

                                }
                                else {

                                    // for hods, display lecturers
                                    $all_staff = select_all_where_and("staff", "role", "Lecturer", "sch_fac_dept_id", $_SESSION['appraisal_sch_fac_dept_id']);

                                    if(count($all_staff) > 0) {

                                        $unappraised_staff = 0;

                                        foreach ($all_staff as $staff) {
                                            
                                            
                                            // get staff details
                                            $staff_id = $staff['staff_id'];

                                            // check if staff has been appraised already

                                            $staff_appraised = select_all_where_and("appraisal", "staff_id", $staff_id, "fiscal_session_id", $fiscal_session_id);

                                            // count unappraised eligible staff

                                            if(count($staff_appraised) < 1){


                                                $title = $staff['title'];
                                                $staff_name = $staff['staff_name'];
                                                $staff_fullname = $title . " " . $staff_name;

                                                // display staff as select option

                                                ?>
                                                
                                                <option value="<?php echo $staff_id; ?>"><?php echo $staff_fullname; ?></option>
                                                
                                                
                                                <?php
                                                $unappraised_staff++;
                                            }
                                        }
                                    }


                                }

                                ?>
                                
                                
                                


                                                                            </select>
                                                                        </div>
                                                                        
                                                                    </div>

                                                                </div>
                                                                <!-- end row -->


                                                                

                                                                <?php

                                                                    // if all staff have been appraised, display completion success message

                                                                    if($unappraised_staff == 0) {
                                                                        ?>
                                                                        
                                                                        <div class="row">
                                                                            <h5 class="text-success">
                                                                                You have completed all your staff appraisals for <?php echo $fiscal_year; ?> Fiscal Year.
                                                                            </h5>
                                                                        </div>
                                                                        
                                                                        <?php
                                                                    }

                                                                    // else, display submit button

                                                                    else {

                                                                        ?>


                                                                    <div class="row mb-5">
                                                                        <div class="col-md-6">
                                                                            <input type="hidden" name="fiscal_session_id" value="<?php echo $fiscal_session_id; ?>">
                                                                            <button type="submit" name="appraise_staff" class="btn btn-success w-md">Proceed <i class="mdi mdi-arrow-right ms-1"></i></button>
                                                                        </div>

                                                                    </div>
                                                                        
                                                                        
                                                                        
                                                                        <?php

                                                                    }

                                                                ?>




                                                                
                                                                <!-- end row -->


                                                            </form>


                                                        </div>
                                                        <!-- Single select input Example -->


                                                    </div>
                                                    <!-- end card body -->
                                                </div>
                                                <!-- end card -->
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        
                                        



                                        
                                    </div> <!-- container-fluid -->
                                </div>
                                <!-- End Page-content -->
                                
                                
                                

                                
                                
                                
                                <?php
                            }
                        }


                    }
                    else {
                        echo "<script>
                                alert('Please select a fiscal year to appraise');
                                window.location.href = 'appraisal-select-session.php';
                            </script>";
                        exit();
                    }
                }

            }
        
        ?>





        



        

                

                
          
                




                



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

        <!-- color picker js -->
        <script src="../assets/libs/%40simonwep/pickr/pickr.min.js"></script>
        <script src="../assets/libs/%40simonwep/pickr/pickr.es5.min.js"></script>

        <!-- datepicker js -->
        <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- init js -->
        <script src="../assets/js/pages/form-advanced.init.js"></script>

        <script src="../assets/js/app.js"></script>

    </body>

</html>
