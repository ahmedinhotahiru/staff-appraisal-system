<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Staff Appraisal | Appraisal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SDD-UBIDS Staff Appraisal" name="description" />
        <meta content="SDD-UBIDS" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/logo.png">

        <!-- Sweet Alert-->
        <link href="../assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

        <!-- twitter-bootstrap-wizard css -->
        <link rel="stylesheet" href="../assets/libs/twitter-bootstrap-wizard/prettify.css">

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

            // check for form submission and identify staff
            if(!isset($_POST['appraise_staff'])) {

                echo "<script>
                        alert('Please select a fiscal year and staff to appraise');
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

                                // identify staff and get details

                                $staff_id = trim($_POST['staff_id']);

                                $staff = select_all_where("staff", "staff_id", $staff_id);

                                if(count($staff) > 0) {

                                    // get staff details
                                    $title = $staff[0]['title'];
                                    $staff_name = $staff[0]['staff_name'];

                                    $staff_fullname = $title . " " . $staff_name;

                                    $department_id = $staff[0]['sch_fac_dept_id'];




                                    // check if staff is appraised already
                                    $staff_appraised = select_all_where_and("appraisal", "staff_id", $staff_id, "fiscal_session_id", $fiscal_session_id);

                                    if(count($staff_appraised) > 0) {
                                        echo "<script>
                                                    alert('Staff has been appraised already.');
                                                    window.location.href = 'appraisal-select-session.php';
                                                </script>";
                                            exit();
                                    }


                                }
                                else {
                                    echo "<script>
                                            alert('Staff not found. Please try again');
                                            window.location.href = 'appraisal-select-session.php';
                                        </script>";
                                    exit();
                                }
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


        






        <form action="submit-appraisal.php" method="post">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Staff Appraisal</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Appraisal</a></li>
                                            <li class="breadcrumb-item active"><?php echo $fiscal_year; ?> Fiscal Year</li>
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
                                        <h4 class="card-title mb-0"><?php echo $staff_fullname; ?></h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="text-center mb-4">
                                            <p class="card-title-desc">Please select a scale for all the options below. Scales range between (1, 2, 3, 4, 5)</p>
                                            <p class="card-title-desc">[ 1 = Very Poor, 2 = Poor, 3 = Average, 4 = Good, 5 = Very Good ]</p>
                                        </div>
                                            
                                        <!-- attitude to work -->
                                        <div class="card mt-5">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Attitude to work</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <div class="table table-responsive">
                                                            <table class="table table-hover">
                                                                <tbody>

                                                                    <!-- input class="form-check-input" -->

                                                                    <tr id="attendance_row">
                                                                        <td>Attendance and Punctuality to work</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="attendance" id="attendance1" value="1">
                                                                                <label class="form-check-label" for="attendance1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="attendance" id="attendance2" value="2">
                                                                                <label class="form-check-label" for="attendance2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="attendance" id="attendance3" value="3">
                                                                                <label class="form-check-label" for="attendance3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="attendance" id="attendance4" value="4">
                                                                                <label class="form-check-label" for="attendance4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="attendance" id="attendance5" value="5">
                                                                                <label class="form-check-label" for="attendance5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="deadline_row">
                                                                        <td>Meets work deadline in a timely and efficient manner</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="deadline" id="deadline_1" value="1">
                                                                                <label class="form-check-label" for="deadline_1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="deadline" id="deadline_2" value="2">
                                                                                <label class="form-check-label" for="deadline_2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="deadline" id="deadline_3" value="3">
                                                                                <label class="form-check-label" for="deadline_3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="deadline" id="deadline_4" value="4">
                                                                                <label class="form-check-label" for="deadline_4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="deadline" id="deadline_5" value="5">
                                                                                <label class="form-check-label" for="deadline_5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- interpersonal skills -->
                                        <div class="card mt-5">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Interpersonal Skills, Cooperation, Collaboration</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <div class="table table-responsive">
                                                            <table class="table table-hover">
                                                                <tbody>

                                                                    <tr id="student_service_row">
                                                                        <td>Demonstrate effective positive customer/student service</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="student_service" id="student_service1" value="1">
                                                                                <label class="form-check-label" for="student_service1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="student_service" id="student_service2" value="2">
                                                                                <label class="form-check-label" for="student_service2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="student_service" id="student_service3" value="3">
                                                                                <label class="form-check-label" for="student_service3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="student_service" id="student_service4" value="4">
                                                                                <label class="form-check-label" for="student_service4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="student_service" id="student_service5" value="5">
                                                                                <label class="form-check-label" for="student_service5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="relates_well_row">
                                                                        <td>Relates well with colleagues and superiors</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="relates_well" id="relates_well1" value="1">
                                                                                <label class="form-check-label" for="relates_well1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="relates_well" id="relates_well2" value="2">
                                                                                <label class="form-check-label" for="relates_well2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="relates_well" id="relates_well3" value="3">
                                                                                <label class="form-check-label" for="relates_well3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="relates_well" id="relates_well4" value="4">
                                                                                <label class="form-check-label" for="relates_well4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="relates_well" id="relates_well5" value="5">
                                                                                <label class="form-check-label" for="relates_well5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="collaboration_row">
                                                                        <td>Encourages collaboration and sharing of information</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="collaboration" id="collaboration1" value="1">
                                                                                <label class="form-check-label" for="collaboration1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="collaboration" id="collaboration2" value="2">
                                                                                <label class="form-check-label" for="collaboration2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="collaboration" id="collaboration3" value="3">
                                                                                <label class="form-check-label" for="collaboration3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="collaboration" id="collaboration4" value="4">
                                                                                <label class="form-check-label" for="collaboration4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="collaboration" id="collaboration5" value="5">
                                                                                <label class="form-check-label" for="collaboration5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- testing and evaluation -->
                                        <div class="card mt-5">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Testing and Evaluation</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <div class="table table-responsive">
                                                            <table class="table table-hover">
                                                                <tbody>

                                                                    <tr id="evaluation_methods_row">
                                                                        <td>Fair and appropriate evaluation methods</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="evaluation_methods" id="evaluation_methods1" value="1">
                                                                                <label class="form-check-label" for="evaluation_methods1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="evaluation_methods" id="evaluation_methods2" value="2">
                                                                                <label class="form-check-label" for="evaluation_methods2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="evaluation_methods" id="evaluation_methods3" value="3">
                                                                                <label class="form-check-label" for="evaluation_methods3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="evaluation_methods" id="evaluation_methods4" value="4">
                                                                                <label class="form-check-label" for="evaluation_methods4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="evaluation_methods" id="evaluation_methods5" value="5">
                                                                                <label class="form-check-label" for="evaluation_methods5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="assignments_row">
                                                                        <td>Assignments contribute to learning</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="assignments" id="assignments1" value="1">
                                                                                <label class="form-check-label" for="assignments1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="assignments" id="assignments2" value="2">
                                                                                <label class="form-check-label" for="assignments2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="assignments" id="assignments3" value="3">
                                                                                <label class="form-check-label" for="assignments3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="assignments" id="assignments4" value="4">
                                                                                <label class="form-check-label" for="assignments4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="assignments" id="assignments5" value="5">
                                                                                <label class="form-check-label" for="assignments5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="sufficient_assignments_row">
                                                                        <td>Sufficient number of assignments</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="sufficient_assignments" id="sufficient_assignments1" value="1">
                                                                                <label class="form-check-label" for="sufficient_assignments1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="sufficient_assignments" id="sufficient_assignments2" value="2">
                                                                                <label class="form-check-label" for="sufficient_assignments2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="sufficient_assignments" id="sufficient_assignments3" value="3">
                                                                                <label class="form-check-label" for="sufficient_assignments3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="sufficient_assignments" id="sufficient_assignments4" value="4">
                                                                                <label class="form-check-label" for="sufficient_assignments4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="sufficient_assignments" id="sufficient_assignments5" value="5">
                                                                                <label class="form-check-label" for="sufficient_assignments5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- administration -->
                                        <div class="card mt-5">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">Administration</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <div class="table table-responsive">
                                                            <table class="table table-hover">
                                                                <tbody>

                                                                    <tr id="adheres_to_rules_row">
                                                                        <td>Adheres to University policy and rules of conduct</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="adheres_to_rules" id="adheres_to_rules1" value="1">
                                                                                <label class="form-check-label" for="adheres_to_rules1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="adheres_to_rules" id="adheres_to_rules2" value="2">
                                                                                <label class="form-check-label" for="adheres_to_rules2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="adheres_to_rules" id="adheres_to_rules3" value="3">
                                                                                <label class="form-check-label" for="adheres_to_rules3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="adheres_to_rules" id="adheres_to_rules4" value="4">
                                                                                <label class="form-check-label" for="adheres_to_rules4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="adheres_to_rules" id="adheres_to_rules5" value="5">
                                                                                <label class="form-check-label" for="adheres_to_rules5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr id="marking_of_scripts_row">
                                                                        <td>Adheres to Departmental procedures and regulations for marking of examination scripts</td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="marking_of_scripts" id="marking_of_scripts1" value="1">
                                                                                <label class="form-check-label" for="marking_of_scripts1"> 1</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="marking_of_scripts" id="marking_of_scripts2" value="2">
                                                                                <label class="form-check-label" for="marking_of_scripts2"> 2</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="marking_of_scripts" id="marking_of_scripts3" value="3">
                                                                                <label class="form-check-label" for="marking_of_scripts3"> 3</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="marking_of_scripts" id="marking_of_scripts4" value="4">
                                                                                <label class="form-check-label" for="marking_of_scripts4"> 4</label>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="">
                                                                                <input required class="" type="radio" name="marking_of_scripts" id="marking_of_scripts5" value="5">
                                                                                <label class="form-check-label" for="marking_of_scripts5"> 5</label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        



                                        <!-- General Comments -->
                                        <div class="card mt-5">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">General Comments</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <textarea name="general_comments" class="form-control" required id="general_comments" cols="30" rows="10" required></textarea>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        


                                        <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header border-bottom-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <div class="mb-3">
                                                                <i class="bx display-4" id="circle_color"></i>
                                                            </div>
                                                            <h5 id="display_grand"></h5>
                                                            <p class="" id="display_results"></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-primary w-md" data-bs-dismiss="modal"
                                                        >Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="d-print-none mt-5">
                                            <div class="float-end">
                                                <a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".confirmModal" onclick="result();"><i class="mdi mdi-eye"></i> Check Result
                                                </a>


                                                <!-- hidden inputs -->
                                                <input type="hidden" name="fiscal_session_id" value="<?php echo $fiscal_session_id; ?>">
                                                <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                                                <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                                                <input type="hidden" name="submit_appraisal" value="<?php echo $department_id; ?>">

                                                <button type="submit"  id="appraisal_sub_button" onclick="form_val_sub(); myConfirmApp();" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-check"></i> Submit Appraisal</button>

                                                <!-- <button type="button" class="btn btn-primary" id="sa-warning2"><i class="mdi mdi-check"></i> Submit Appraisal</button> -->

                                                
                                            </div>
                                        </div>


                                        
                                        



                                        <script>

                                            function form_validation() {
                                                var attendance = document.querySelector('input[name="attendance"]:checked');
                                                var deadline = document.querySelector('input[name="deadline"]:checked');
                                                var student_service = document.querySelector('input[name="student_service"]:checked');
                                                var relates_well = document.querySelector('input[name="relates_well"]:checked');
                                                var collaboration = document.querySelector('input[name="collaboration"]:checked');
                                                var evaluation_methods = document.querySelector('input[name="evaluation_methods"]:checked');
                                                var assignments = document.querySelector('input[name="assignments"]:checked');
                                                var sufficient_assignments = document.querySelector('input[name="sufficient_assignments"]:checked');
                                                var adheres_to_rules = document.querySelector('input[name="adheres_to_rules"]:checked');
                                                var marking_of_scripts = document.querySelector('input[name="marking_of_scripts"]:checked');


                                                if(!attendance || !deadline || !student_service || !relates_well || !collaboration || !evaluation_methods || !assignments || !sufficient_assignments || !adheres_to_rules || !marking_of_scripts) {

                                                    // row validation colors

                                                    if(!attendance) {
                                                        document.getElementById('attendance_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('attendance_row').classList.remove('table-danger');
                                                    }

                                                    if(!deadline) {
                                                        document.getElementById('deadline_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('deadline_row').classList.remove('table-danger');
                                                    }

                                                    if(!student_service) {
                                                        document.getElementById('student_service_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('student_service_row').classList.remove('table-danger');
                                                    }

                                                    if(!relates_well) {
                                                        document.getElementById('relates_well_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('relates_well_row').classList.remove('table-danger');
                                                    }

                                                    if(!collaboration) {
                                                        document.getElementById('collaboration_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('collaboration_row').classList.remove('table-danger');
                                                    }

                                                    
                                                    if(!evaluation_methods) {
                                                        document.getElementById('evaluation_methods_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('evaluation_methods_row').classList.remove('table-danger');
                                                    }

                                                    if(!assignments) {
                                                        document.getElementById('assignments_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('assignments_row').classList.remove('table-danger');
                                                    }

                                                    if(!sufficient_assignments) {
                                                        document.getElementById('sufficient_assignments_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('sufficient_assignments_row').classList.remove('table-danger');
                                                    }

                                                    if(!adheres_to_rules) {
                                                        document.getElementById('adheres_to_rules_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('adheres_to_rules_row').classList.remove('table-danger');
                                                    }

                                                    if(!marking_of_scripts) {
                                                        document.getElementById('marking_of_scripts_row').classList.add('table-danger');
                                                    }
                                                    else {
                                                        document.getElementById('marking_of_scripts_row').classList.remove('table-danger');
                                                    }

                                                    

                                                    
                                                    return false;
                                                }
                                                else {

                                                    document.getElementById('attendance_row').classList.remove('table-danger');
                                                    document.getElementById('deadline_row').classList.remove('table-danger');
                                                    document.getElementById('student_service_row').classList.remove('table-danger');
                                                    document.getElementById('relates_well_row').classList.remove('table-danger');
                                                    document.getElementById('collaboration_row').classList.remove('table-danger');
                                                    document.getElementById('evaluation_methods_row').classList.remove('table-danger');
                                                    document.getElementById('assignments_row').classList.remove('table-danger');
                                                    document.getElementById('sufficient_assignments_row').classList.remove('table-danger');
                                                    document.getElementById('adheres_to_rules_row').classList.remove('table-danger');
                                                    document.getElementById('marking_of_scripts_row').classList.remove('table-danger');
                                                    
                                                    
                                                    return true;
                                                }

                                            }

                                            

                                            function result() {

                                                var display_grand = document.getElementById('display_grand');
                                                var display_result = document.getElementById('display_results');
                                                var circle_color = document.getElementById('circle_color');

                                                
                                                if(form_validation() == false) {

                                                    display_result.innerHTML = "Some options have not been selected. <br>Please select all options and try to calculate result again";
                                                    
                                                    circle_color.classList.remove("bx-check-circle", "text-success");
                                                    circle_color.classList.add("bx-error-alt", "text-danger");

                                                    display_grand.innerHTML = "Please select all options";
                                                    
                                                }
                                                else {
                                                    // get details
                                                    const attendance = document.querySelector('input[name="attendance"]:checked');
                                                    const deadline = document.querySelector('input[name="deadline"]:checked');
                                                    const student_service = document.querySelector('input[name="student_service"]:checked');
                                                    const relates_well = document.querySelector('input[name="relates_well"]:checked');
                                                    const collaboration = document.querySelector('input[name="collaboration"]:checked');
                                                    const evaluation_methods = document.querySelector('input[name="evaluation_methods"]:checked');
                                                    const assignments = document.querySelector('input[name="assignments"]:checked');
                                                    const sufficient_assignments = document.querySelector('input[name="sufficient_assignments"]:checked');
                                                    const adheres_to_rules = document.querySelector('input[name="adheres_to_rules"]:checked');
                                                    const marking_of_scripts = document.querySelector('input[name="marking_of_scripts"]:checked');
                                                    // compute for the grand mean result

                                                    display_result.innerHTML = "";
                                                    display_grand.innerHTML = "";

                                                    circle_color.classList.remove("bx-error-alt", "text-danger");
                                                    circle_color.classList.add("bx-check-circle", "text-success");

                                                    const mean_1 = (parseInt(attendance.value) + parseInt(deadline.value)) / 2;

                                                    const mean_2 = (parseInt(student_service.value) + parseInt(relates_well.value) + parseInt(collaboration.value)) / 3;

                                                    const mean_3 = (parseInt(evaluation_methods.value) + parseInt(assignments.value) + parseInt(sufficient_assignments.value)) / 3;

                                                    const mean_4 = (parseInt(adheres_to_rules.value) + parseInt(marking_of_scripts.value)) / 2;

                                                    const grand_mean_score = (mean_1 + mean_2 + mean_3 + mean_4) / 4;

                                                    const grand_mean_score_rounded = Math.round((grand_mean_score + Number.EPSILON) * 100) / 100;


                                                    display_grand.innerHTML = "Grand Mean: " + grand_mean_score_rounded;

                                                    if(grand_mean_score_rounded < 1) {
                                                        display_result.innerHTML = "Performance Remarks: Very Poor";
                                                    }
                                                    else if(grand_mean_score_rounded >= 1 && grand_mean_score_rounded < 2) {
                                                        display_result.innerHTML = "Performance Remarks: Poor";
                                                    }
                                                    else if(grand_mean_score_rounded >= 2 && grand_mean_score_rounded < 3) {
                                                        display_result.innerHTML = "Performance Remarks: Average";
                                                    }
                                                    else if(grand_mean_score_rounded >= 3 && grand_mean_score_rounded < 4) {
                                                        display_result.innerHTML = "Performance Remarks: Good";
                                                    }
                                                    else if(grand_mean_score_rounded >= 4) {
                                                        display_result.innerHTML = "Performance Remarks: Very Good";
                                                    }

                                                    
                                                }

                                                
                                                
                                            }


                                            function form_val_sub() {
                                                
                                                // document.getElementById('appraisal_sub_button').addEventListener("click", function(event) {
                                                //         event.preventDefault()
                                                //     });
                                                
                                                if(form_validation() == false) {

                                                    return false;
                                                    
                                                }
                                                else {
                                                    
                                                    // document.getElementById('appraisal_sub_button').addEventListener("submit")

                                                    
                                                }
                                            }
                                        </script>


                                        
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












                <!-- Modal -->
                <!-- <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <i class="bx bx-check-circle display-4 text-success"></i>
                                    </div>
                                    <h5 id="resultH"></h5>
                                    <p class="text-danger" id="resultError"></p>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="submit" class="btn btn-primary w-md" data-bs-dismiss="modal"
                                >Save changes</button>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- end modal -->

                

        </form>







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

        <!-- Sweet Alerts js -->
        <script src="../assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="../assets/js/pages/sweetalert.init.js"></script>

        <script>
            function myConfirmApp() {
                event.preventDefault();
                
                var form = event.target.form;
                Swal.fire({ title: "Are you sure?", text: "You won't be able to revert this!", icon: "warning", showCancelButton: !0, confirmButtonColor: "#2ab57d", cancelButtonColor: "#fd625e", confirmButtonText: "Yes, submit!", closeOnConfirm: false, closeOnCancel: true }).then(function (
                    e
                ) {
                    if(e.value==true) {
                        if(form_validation()==true) {
                            if(document.getElementById('general_comments').value=="") {
                                alert('General Comments field is required');
                            }
                            else {
                                form.submit();
                            }
                        }
                        else {
                            Swal.fire("Please select all options!", "Some options have not been selected.", "error");
                        }
                        
                        
                    }
                    else {
                        Swal.fire("Cancelled!", "Your appraisal was not submitted.", "error");
                    }
                });
            }
        </script>

        <!-- twitter-bootstrap-wizard js -->
        <script src="../assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="../assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

        <!-- form wizard init -->
        <script src="../assets/js/pages/form-wizard.init.js"></script>

        <script src="../assets/js/app.js"></script>

    </body>

</html>
