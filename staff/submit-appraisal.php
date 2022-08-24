<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Staff Appraisal | Select Fiscal Year</title>
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



            // check for forum submission
            if(isset($_POST['submit_appraisal'])) {


                // get form details
                if(!isset($_POST['fiscal_session_id']) || empty($_POST['fiscal_session_id']) || !isset($_POST['staff_id']) || empty($_POST['staff_id'])) {
                    
                    echo "<script>
                            alert('Please select a fiscal year and staff to appraise');
                            window.location.href = 'appraisal-select-session.php';
                        </script>";
                    exit();
                }
                elseif(!isset($_POST['department_id']) || empty($_POST['department_id'])) {
                    echo "<script>
                            alert('Staff department not found, please try again');
                            window.location.href = 'appraisal-select-session.php';
                        </script>";
                    exit();
                }

                else {

                    // details
                    $fiscal_session_id = $_POST['fiscal_session_id'];
                    $staff_id = $_POST['staff_id'];
                    $department_id = $_POST['department_id'];

                    // appraisal details
                    $attendance = (int) trim($_POST['attendance']);
                    $deadline = (int) trim($_POST['deadline']);
                    $student_service = (int) trim($_POST['student_service']);
                    $relates_well = (int) trim($_POST['relates_well']);
                    $collaboration = (int) trim($_POST['collaboration']);
                    $evaluation_methods = (int) trim($_POST['evaluation_methods']);
                    $assignments = (int) trim($_POST['assignments']);
                    $sufficient_assignments = (int) trim($_POST['sufficient_assignments']);
                    $adheres_to_rules = (int) trim($_POST['adheres_to_rules']);
                    $marking_of_scripts = (int) trim($_POST['marking_of_scripts']);
                    $general_comments = trim($_POST['general_comments']);


                    if( empty($attendance) || empty($deadline) || empty($student_service) || empty($relates_well) || empty($collaboration) || empty($evaluation_methods) || empty($assignments) || empty($sufficient_assignments) || empty($adheres_to_rules) || empty($marking_of_scripts) || empty($general_comments) ) {
                
                        echo "<script>
                                alert('Please options were not selected. Please select all your options and try again');
                                window.location.href = 'appraisal-select-session.php';
                            </script>";
                        exit();
                    }

                    else {

                        // check if staff is appraised already
                        $staff_appraised = select_all_where_and("appraisal", "staff_id", $staff_id, "fiscal_session_id", $fiscal_session_id);

                        if(count($staff_appraised) > 0) {
                            echo "<script>
                                        alert('Staff has been appraised already.');
                                        window.location.href = 'appraisal-select-session.php';
                                    </script>";
                                exit();
                        }
                        else {

                            // compute for total score
                            $total_score = $attendance + $deadline + $student_service + $relates_well + $collaboration + $evaluation_methods + $assignments + $sufficient_assignments + $adheres_to_rules + $marking_of_scripts;


                            // compute for grand mean
                            $mean_1 = ($attendance + $deadline) / 2;
                            $mean_2 = ($student_service + $relates_well + $collaboration) / 3;
                            $mean_3 = ($evaluation_methods + $assignments + $sufficient_assignments) / 3;
                            $mean_4 = ($adheres_to_rules + $marking_of_scripts) / 2;

                            $grand_mean_score = ($mean_1 + $mean_2 + $mean_3 + $mean_4) / 4;

                            $grand_mean_score_rounded = round($grand_mean_score, 2);


                            // determine remarks

                            if($grand_mean_score_rounded < 1) {
                                $remarks = "Very Poor";
                            }
                            elseif($grand_mean_score_rounded >=1 && $grand_mean_score_rounded < 2) {
                                $remarks = "Poor";
                            }
                            elseif($grand_mean_score_rounded >=2 && $grand_mean_score_rounded < 3) {
                                $remarks = "Average";
                            }
                            elseif($grand_mean_score_rounded >= 3 && $grand_mean_score_rounded < 4) {
                                $remarks = "Good";
                            }
                            elseif($grand_mean_score_rounded >= 4) {
                                $remarks = "Very Good";
                            }


                            // now prepare data for insertion

                            $data = array('staff_id'=>$staff_id,
                                            'department_id'=>$department_id,
                                            'fiscal_session_id'=>$fiscal_session_id,
                                            'total_score'=>$total_score,
                                            'grand_mean'=>$grand_mean_score_rounded,
                                            'remarks'=>$remarks,
                                            'general_comments'=>$general_comments);

                            $table = 'appraisal';


                            if(add($data, $table) == true) {

                                // get appraisal id just inserted
                                $inserted_appraisal = select_all_where_and("appraisal", "staff_id", $staff_id, "fiscal_session_id", $fiscal_session_id);

                                if(count($inserted_appraisal) > 0){

                                    // get the appraisal id
                                    $appraisal_id = $inserted_appraisal[0]['appraisal_id'];

                                    // insert
                                    // insert appraisal details
                                    $data = array('appraisal_id'=>$appraisal_id,
                                                    'attendance'=>$attendance,
                                                    'deadline'=>$deadline,
                                                    'student_service'=>$student_service,
                                                    'relates_well'=>$relates_well,
                                                    'collaboration'=>$collaboration,
                                                    'evaluation_methods'=>$evaluation_methods,
                                                    'assignments'=>$assignments,
                                                    'sufficient_assignments'=>$sufficient_assignments,
                                                    'adheres_to_rules'=>$adheres_to_rules,
                                                    'marking_of_scripts'=>$marking_of_scripts);

                                    $table = 'appraisal_details';

                                    if(add($data, $table) == false) {
                                        echo "<script>
                                                alert('An error occured, could not submit appraisal. Please try again!');
                                                window.location.href = 'appraisal-select-session.php';
                                            </script>";
                                        exit();
                                    }
                                }
                                else {
                                    echo "<script>
                                                alert('An error occured, could not submit appraisal. Please try again!');
                                                window.location.href = 'appraisal-select-session.php';
                                            </script>";
                                        exit();
                                }

                                
                                
                                
                            }
                            else {
                                echo "<script>
                                        alert('An error occured, could not submit appraisal. Please try again!');
                                        window.location.href = 'appraisal-select-session.php';
                                    </script>";
                                exit();
                            }
                        }
                    }
                }

            }

            else {
                echo "<script>
                        
                        window.location.href = 'appraisal-select-session.php';
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
                                    <h4 class="mb-sm-0 font-size-18">Staff Appraisal</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Staff Appraisal</a></li>
                                            <li class="breadcrumb-item active">Submitted</li>
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
                                        <h4 class="card-title">Successfully submitted</h4>
                                        <p class="card-title-desc">Appraisal result is displayed below.</p>
                                    </div>
                                    <!-- end card header -->

                                    <div class="card-body" style="height:400px">
                                        <div>
                                            <!-- <h5 class="font-size-14 mb-3">Single select input Example</h5> -->


                                            <form action="appraisal-select-staff.php" method="post">


                                                <div class="row mb-5">
                                                    <h5 class="text-success mb-5">
                                                        You have submitted your appraisal for <?php echo staff_fullname($staff_id); ?> for the <?php echo fiscal_year($fiscal_session_id); ?> Fiscal Year.
                                                    </h5>
                                                    <h5>Grand Mean: <?php echo $grand_mean_score_rounded . ", " . $remarks; ?></h5>
                                                    <p>Total Score: <?php echo $total_score . " out of 50"; ?></p>
                                                </div>
                                                <!-- end row -->


                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="fiscal_session_id" value="<?php echo $fiscal_session_id; ?>">
                                                        <button type="submit" name="appraise_fiscal_year" class="btn btn-success w-md">Appraise next staff <i class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </div>

                                                </div>
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
