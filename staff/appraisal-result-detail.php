<?php
    if(!isset($_GET['id']) || empty($_GET['id'])) {

        
        echo "<script>
                    alert('No appraisal result found for your selection');
                    history.back();
              </script>";
        exit();
    }
    else {

        // check staff id
        $id = trim($_GET['id']);

        if(!preg_match("/^[0-9]+$/", $id)) {
            echo "<script>
                    alert('Error... Invalid appraisal result id');
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
        <title>Result | Appraisal Result Detail</title>
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

            // get appraisal details
            $appraisal = select_all_where("appraisal", "appraisal_id", $id);

            if(count($appraisal) > 0) {

                // get appraisal result details

                $appraisal_id = $appraisal[0]['appraisal_id'];
                $staff_id = $appraisal[0]['staff_id'];
                $department_id = $appraisal[0]['department_id'];
                $fiscal_session_id = $appraisal[0]['fiscal_session_id'];
                $total_score = $appraisal[0]['total_score'];
                $grand_mean = $appraisal[0]['grand_mean'];
                $remarks = $appraisal[0]['remarks'];
                $general_comments = $appraisal[0]['general_comments'];





               

                // check if department of staff belongs to the same school as logged in user

                if($_SESSION['appraisal_role'] == "Dean") {

                     // use department id to check the school  it belongs to
                    $staff_school_id = department_school_faculty_id($department_id);


                    if($staff_school_id != $_SESSION['appraisal_sch_fac_dept_id']) {
                        echo "<script>
                                alert('You do no have access to this appraisal result. You will be redirected to the Dean dashboard');
                                window.location.href='index_dean.php';
                            </script>";
                        exit();
                    }
                }

                elseif($_SESSION['appraisal_role'] == "HOD") {

                    

                    if($department_id != $_SESSION['appraisal_sch_fac_dept_id']) {
                        echo "<script>
                                alert('You do no have access to this appraisal result. You will be redirected to the HOD dashboard');
                                window.location.href='index_hod.php';
                            </script>";
                        exit();
                    }

                }
                







                
                // identify staff and get staff details
                $select_staff = select_all_where("staff", "staff_id", $staff_id)[0];
                
                $staff_id_no = $select_staff['staff_id_no'];
                $staff_name = $select_staff['title'] . " " . $select_staff['staff_name'];
                $position = $select_staff['position'];
                $role = $select_staff['role'];

                // identify appraiser role
                $appraiser = "";
                if($role == "HOD") {
                    $appraiser = "Dean";
                }
                else {
                    $appraiser = "HOD";
                }

                
                // identify department and get department name
                $select_department = select_all_where("departments", "department_id", $department_id)[0];

                $department_name = $select_department['department_name'];
                
                
                // identify school/faculty and get school/faculty name
                $school_faculty_id = $select_department['school_faculty_id'];

                $school_faculty_name = select_all_where("schools_faculties", "school_faculty_id", $school_faculty_id)[0]['school_faculty_name'];


                // identify fiscal year and get details
                $fiscal_year = fiscal_year($fiscal_session_id);


                
                
                
                // get appraisal evaluation summary details
                $appraisal_details = select_all_where("appraisal_details", "appraisal_id", $appraisal_id);

                if(count($appraisal_details) > 0) {

                    // get appraisal details
                    $appraisal_detail_id = $appraisal_details[0]['appraisal_detail_id'];
                    $attendance = $appraisal_details[0]['attendance'];
                    $deadline = $appraisal_details[0]['deadline'];
                    $student_service = $appraisal_details[0]['student_service'];
                    $relates_well = $appraisal_details[0]['relates_well'];
                    $collaboration = $appraisal_details[0]['collaboration'];
                    $evaluation_methods = $appraisal_details[0]['evaluation_methods'];
                    $assignments = $appraisal_details[0]['assignments'];
                    $sufficient_assignments = $appraisal_details[0]['sufficient_assignments'];
                    $adheres_to_rules = $appraisal_details[0]['adheres_to_rules'];
                    $marking_of_scripts = $appraisal_details[0]['marking_of_scripts'];



                }

                else {
                    echo "<script>
                        alert('No details found for this appraisal');
                        history.back();
                        </script>";
                    exit();
                }

                

            }
            else {
                echo "<script>
                    alert('Error... Invalid appraisal result id');
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
                                    <h4 class="mb-sm-0 font-size-18">Appraisal Result Detail</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Appraisal</a></li>
                                            <li class="breadcrumb-item active">Appraisal Result Detail</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="mb-4">
                                                        <img src="../assets/images/logo.png" alt="" height="24"><span class="logo-txt">SDD UBIDS</span>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="mb-4">
                                                        <h4 class="float-end font-size-16">Staff ID # <?php echo $staff_id_no; ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <p class="mb-1">Staff Appraisal Result, by <?php echo $appraiser; ?></p>
                                            <p class="mb-1"><?php echo ($appraiser == 'Dean') ? $school_faculty_name : $department_name; ?></p>

                                            <p>S. D. Dombo UBIDS</p>

                                        </div>
                                        <hr class="my-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <h5 class="font-size-15 mb-3">Staff:</h5>
                                                    <h5 class="font-size-14 mb-2"><?php echo $staff_name . " ($role)"; ?></h5>
                                                    <p class="mb-1"><?php echo $department_name; ?></p>
                                                    <p class="mb-1"><?php echo $school_faculty_name; ?></p>
                                                    <p><?php echo $position; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                    <div>
                                                        <h5 class="font-size-15">Fiscal Year:</h5>
                                                        <p><?php echo $fiscal_year; ?></p>
                                                    </div>
                                                    
                                                    <div class="mt-4">
                                                        <h5 class="font-size-15">Appraisal Results:</h5>
                                                        <p class="mb-1">Total Score: <?php echo $total_score; ?> out of 50</p>
                                                        <p>Grand Mean: <?php echo $grand_mean . ", " . $remarks; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="py-2 mt-3">
                                            <h5 class="font-size-15">Evaluation summary</h5>
                                        </div>
                                        <div class="p-4 border rounded">
                                            <div class="table-responsive">

                                                <!-- attitude to work -->
                                                <table class="table table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 70px;">A.</th>
                                                            <th>Attitude to Work</th>
                                                            <th class="text-end" style="width: 120px;">Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <th scope="row">i)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Attendance and Punctuality to work </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $attendance; ?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th scope="row">ii)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Meets work deadline in a timely and efficient manner </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $deadline; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" colspan="2" class="text-end">Sub Total</th>
                                                            <td class="text-end"><?php echo $attendance + $deadline; ?></td>
                                                        </tr>
                                                        

                                                    </tbody>
                                                </table>



                                                <!-- Interpersonal Skills, Cooperation, Collaboration -->
                                                <table class="table table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 70px;">B.</th>
                                                            <th>Interpersonal Skills, Cooperation, Collaboration</th>
                                                            <th class="text-end" style="width: 120px;">Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <th scope="row">i)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Demonstrate effective positive customer/student service </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $student_service; ?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th scope="row">ii)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Relates well with colleagues and superiors </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $relates_well; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">iii)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Encourages collaboration and sharing of information </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $collaboration; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" colspan="2" class="text-end">Sub Total</th>
                                                            <td class="text-end"><?php echo $student_service + $relates_well + $collaboration; ?></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>


                                                <!-- Testing and Evaluation -->
                                                <table class="table table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 70px;">C.</th>
                                                            <th>Testing and Evaluation</th>
                                                            <th class="text-end" style="width: 120px;">Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <th scope="row">i)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Fair and appropriate evaluation methods </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $evaluation_methods; ?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th scope="row">ii)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Assignments contribute to learning </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $assignments; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">iii)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Sufficient number of assignments </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $sufficient_assignments; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row" colspan="2" class="text-end">Sub Total</th>
                                                            <td class="text-end"><?php echo $evaluation_methods + $assignments + $sufficient_assignments; ?></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>


                                                <!-- Administration -->
                                                <table class="table table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 70px;">D.</th>
                                                            <th>Administration</th>
                                                            <th class="text-end" style="width: 120px;">Score</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <th scope="row">i)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0">Adheres to University policy and rules of conduct </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $adheres_to_rules; ?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th scope="row">ii)</th>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0 text-wrap" >Adheres to Departmental procedures and regulations for marking of examination scripts </p>
                                                            </td>
                                                            <td class="text-end"><?php echo $marking_of_scripts; ?></td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row" colspan="2" class="text-end">Sub Total</th>
                                                            <td class="text-end"><?php echo $adheres_to_rules + $marking_of_scripts; ?></td>
                                                        </tr>


                                                        <!-- assessment report -->
                                                        <tr>
                                                            <th scope="row" colspan="2" class="border-0 text-end">
                                                                Grand Total</th>
                                                            <td class="border-0 text-end"><?php echo $total_score; ?> out of 50</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row" colspan="2" class="border-0 text-end">Grand Mean</th>
                                                            <td class="border-0 text-end"><h4 class="m-0"><?php echo $grand_mean . ", " . $remarks; ?></h4></td>
                                                        </tr>

                                                        
                                                    </tbody>
                                                </table>



                                                <!-- General comments -->
                                                <table class="table table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>General Comments</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <td>
                                                                <p class="font-size-13 text-muted mb-0 text-wrap"><?php echo $general_comments; ?> </p>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>


                                               
                                            </div>
                                        </div>

                                        
                                        <div class="d-print-none mt-3">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i> Print Result</a>
                                            </div>
                                        </div>

                                        <div class="d-none d-print-block mt-5">
                                            <br>
                                            <div class="row">
                                                    <p class="d-inline mt-5">Signature (<?php echo $_SESSION['appraisal_role']; ?>) <span class="float-end">Date: 25/Dec/2021</span></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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

        <script src="../assets/js/app.js"></script>

    </body>


</html>
