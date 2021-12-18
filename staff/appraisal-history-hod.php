<!doctype html>
<html lang="en">

    

    <head>
        
        <meta charset="utf-8" />
        <title>Appraisal History HODs | Results</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SDD-UBIDS Staff Appraisal" name="description" />
        <meta content="SDD-UBIDS" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/logo.png">

        <!-- flatpickr css -->
        <link href="../assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

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

            // Check if signed in user is at the correct dashboard for his role

            if($_SESSION['appraisal_role'] != "Dean") {
                echo "<script>
                        alert('You do no have access to this page. You will be redirected to the HOD dashboard');
                        window.location.href='index_hod.php';
                      </script>";
                exit();
                // header("Location: index_2.php");
            }

            else {


                $search_fiscal_session_id = 0;

                // if there is no search year, get the last fiscal year
                if(!isset($_POST['year']) || empty($_POST['year'])) {
                    $last_fiscal_session = select_all_desc_id_limit("fiscal_sessions", "fiscal_session_id", 1);

                    if(count($last_fiscal_session) > 0) {
                        $search_fiscal_session_id = $last_fiscal_session[0]['fiscal_session_id'];
                        
                    }
                    else {
                        echo "<script>
                                alert('No Fiscal Session found. Please add a fiscal session');
                                
                            </script>";
                    }
                    


                }
                else {
                    $search_fiscal_session_id = trim($_POST['year']);
                }




                // staff APPRAISAL RESULT search
                if(isset($_POST['search_all_fields'])) {
                    if(isset($_POST['staff_id'])  && !empty($_POST['staff_id'])) {

                        $search_staff_id = trim($_POST['staff_id']);
                        
                        // search for appraisal result id using fiscal_session_id and staff_id
                        $search_appraisal_id = select_all_where_and("appraisal", "staff_id", $search_staff_id, "fiscal_session_id", $search_fiscal_session_id)[0]['appraisal_id'];

                        // redirect to appraisal result detail with appraisal id
                        
                        echo "<script>
                                window.location.href='appraisal-result-detail.php?id=$search_appraisal_id';
                            </script>";
                            
                    }
                }
            }
            
        ?>





                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">HODs Appraisal Results - <?php echo fiscal_year($search_fiscal_session_id); ?></h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Appraisal</a></li>
                                            <li class="breadcrumb-item active">History</li>
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
                                        <div class="row">
                                            <div class="col-sm">
                                                <div class="mb-4">
                                                    <h4 class="card-title"><?php echo fiscal_year($search_fiscal_session_id); ?> Fiscal Year</h4>
                                                    <p class="card-title-desc">HODs Appraisal Results.</p>

                                                </div>
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="d-flex align-items-center gap-1 mb-4">
                                                    <form action="appraisal-history-hod.php" method="post">
                                                        <div class="input-group datepicker-range">
                                                            <select name="year" required class="form-control form-select">
                                                                <option value="">Select fiscal year</option>

                                                                <?php

                                                                    $fiscal_sessions = select_all_desc_id("fiscal_sessions", "fiscal_session_id");

                                                                    if(count($fiscal_sessions) > 0) {
                                                                        foreach ($fiscal_sessions as $fiscal_session) {
                                                                            $fiscal_session_id = $fiscal_session['fiscal_session_id'];
                                                                            $fiscal_year = $fiscal_session['fiscal_year'];

                                                                            ?>
                                                                            
                                                                            <option value="<?php echo $fiscal_session_id; ?>"><?php echo $fiscal_year; ?></option>
                                                                                                                                                        
                                                                            <?php
                                                                        }
                                                                    }


                                                                ?>

                                                            </select>
                                                           
                                                            
                                                            <button class="input-group-text" type="submit" name="search"><i class="bx bx-search"></i> Search</button>
                                                        </div>
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="table-responsive">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <th style="width: 30px;">
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" name="check" class="form-check-input" id="checkAll">
                                                                <label class="form-check-label" for="checkAll"></label>
                                                            </div>
                                                        </th>
                                                        <th style="width: 120px;">Staff ID</th>
                                                        <th style="width: 150px;">Staff Name</th>
                                                        <th>Department</th>
                                                        <th>School/Faculty</th>
                                                        <th>Total Score</th>
                                                        <th>Grand Mean</th>
                                                        <th>Remark</th>
                                                        <th style="width: 90px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>



                                                    <!-- get all HOD appraisal results for specified year -->
                                                    <?php

                                                        $appraisal_results = select_all_where("appraisal", "fiscal_session_id", $search_fiscal_session_id);

                                                        if(count($appraisal_results) > 0) {

                                                            foreach ($appraisal_results as $result) {

                                                                // check if result belongs to same school as user logged in

                                                                // first, get the department id
                                                                $staff_department_id = $result['department_id'];

                                                                // use department id to check the school it belongs to
                                                                $staff_school_id = department_school_faculty_id($staff_department_id);

                                                                if($staff_school_id == $_SESSION['appraisal_sch_fac_dept_id']) {

                                                                

                                                                    // identify staff and select
                                                                    $staff_id = $result['staff_id'];
                                                                    $select_staff = select_all_where("staff", "staff_id", $staff_id);

                                                                    // check staff role if its dean
                                                                    $role = $select_staff[0]['role'];

                                                                    if($role == "HOD") {

                                                                        $appraisal_id = $result['appraisal_id'];
                                                                        $staff_id_no = $select_staff[0]['staff_id_no'];
                                                                        $staff_name = $select_staff[0]['staff_name'];
                                                                        $department_id = $result['department_id'];

                                                                        $department_name = select_all_where("departments", "department_id", $department_id)[0]['department_name'];

                                                                        $department_school_faculty_id = department_school_faculty_id($department_id);
        

                                                                        $total_score = $result['total_score'];
                                                                        $grand_mean = $result['grand_mean'];
                                                                        $remarks = $result['remarks'];

                                                                        $grand_mean_color = "";
                                                                        switch ($grand_mean) {
                                                                            case $grand_mean >= 3:
                                                                                $grand_mean_color = "success";
                                                                                break;

                                                                            case $grand_mean < 2:
                                                                                $grand_mean_color = "danger";
                                                                                break;
                                                                            
                                                                            default:
                                                                                $grand_mean_color = "secondary";
                                                                                break;
                                                                        }

                                                                        // display result details
                                                                        ?>


                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-check font-size-16">
                                                                                    <input type="checkbox" class="form-check-input">
                                                                                    <label class="form-check-label"></label>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td><span class="text-dark fw-medium"><?php echo $staff_id_no; ?></span> </td>
                                                                            <td><?php echo $staff_name; ?></td>
                                                                            <td><?php echo $department_name; ?></td>
                                                                            <td><?php echo school_faculty_acronym($department_school_faculty_id); ?></td>
        
                                                                            <td><?php echo $total_score; ?></td>
                                                                            <td>
                                                                                <div class="badge badge-soft-<?php echo $grand_mean_color; ?> font-size-12"><?php echo $grand_mean; ?></div>
                                                                            </td>
                                                                            <td><?php echo $remarks; ?></td>
                                                                            
                                                                            <td>
                                                                                <a class="" href="appraisal-result-detail.php?id=<?php echo $appraisal_id; ?>">View <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        
                                                                        
                                                                        <?php

                                                                        

                                                                    }

                                                                }
                                                                
                                                                

                                                            }
                                                        }

                                                    ?>
        
                                                    

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table responsive -->
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

        <!-- flatpickr js -->
        <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- Required datatable js -->
        <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- init js -->
        <script src="../assets/js/pages/invoices-list.init.js"></script>

        <script src="../assets/js/app.js"></script>
    </body>


</html>
