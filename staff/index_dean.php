<!doctype html>
<html lang="en">

    
    <head>

        <meta charset="utf-8" />
        <title>Staff Appraisal | Dashboard</title>
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


                $last_fiscal_session = select_all_desc_id_limit("fiscal_sessions", "fiscal_session_id", 1);

                if(count($last_fiscal_session) > 0) {

                    
                    // get details
                    $user_role = $_SESSION['appraisal_role'];
                    $user_school_faculty_id = $_SESSION['appraisal_sch_fac_dept_id'];

                    // get school/faculty name
                    $school_faculty_name = school_faculty_name($user_school_faculty_id);

                    // get all staff HODs belonging to this school/faculty
                    // (first, we need to get the hods department ids, and identify their schools with that)

                    // this selects all HODs for us
                    $all_staff = select_all_where("staff", "role", "HOD");

                    $staff_ids_array = array();

                    if(count($all_staff) > 0) {

                        // get department ids staff ids of each staff and store in array
                        foreach ($all_staff as $staff) {

                            // get staff department id
                            $staff_department_id = $staff['sch_fac_dept_id'];

                            // check school id of this department
                            $staff_school_faculty_id = department_school_faculty_id($staff_department_id);

                            // check if staff school id is the same as user school id
                            if($staff_school_faculty_id == $user_school_faculty_id) {

                                // if yes, store staff id in staff ids array

                                $staff_id = $staff['staff_id'];

                                // add staff id to staff ids array
                                $staff_ids_array[] = $staff_id;

                            }
                            


                        }

                    }


                    // get numbers
                    $total_no_of_staff = count($staff_ids_array);


                    // get current/last fiscal session appraisal details
                    $last_fiscal_session_id = $last_fiscal_session[0]['fiscal_session_id'];

                    $last_fiscal_year = $last_fiscal_session[0]['fiscal_year'];
                    $last_deadline = $last_fiscal_session[0]['deadline'];

                    // determine arrow colors
                    if(strtotime($last_deadline) < strtotime(date("Y-m-d"))) {
                        $deadline_arrow_color = "danger";
                    }
                    else {
                        $deadline_arrow_color = "success";
                    }




                    /// get all appraisal for last fiscal session for all staffs here

                    // create container to keep all appraisal grand means of all staff
                    $grand_means_array = array();

                    if(count($staff_ids_array) > 0) {

                        // for each staff, get their appraisal grand means and store in grand means array
                        foreach ($staff_ids_array as $picked_staff_id) {
                            
                            $staff_appraisal_result = select_all_where_and("appraisal", "staff_id", $picked_staff_id, "fiscal_session_id", $last_fiscal_session_id);

                            if(count($staff_appraisal_result) > 0) {

                                $staff_grand_mean = $staff_appraisal_result[0]['grand_mean'];
                                $grand_means_array[] = $staff_grand_mean;
                            }

                        }

                    }

                     // get number of appraised and unappraised staff

                     $no_of_appraised_staff = count($grand_means_array);
                     $no_of_unappraised_staff = $total_no_of_staff - $no_of_appraised_staff;


                    // get appraisal analysis results
                    $analysis_results = analysis_results($grand_means_array);

                    // get numbers of staffs appraised in this array format = (avg, good, poor)
                    $no_of_staff_average = $analysis_results[0];
                    $no_of_staff_good = $analysis_results[1];
                    $no_of_staff_poor = $analysis_results[2];

                    
                    // get percentages of appraisal results
                    $analysis_percentages = analysis_percentages($analysis_results);

                    $percentage_staff_average = $analysis_percentages[0];
                    $percentage_staff_good = $analysis_percentages[1];
                    $percentage_staff_poor = $analysis_percentages[2];



                    // calculate percentage progress of appraisal

                    if($total_no_of_staff > 0) {

                        $percentage_progress_of_appraisal = ($no_of_appraised_staff / $total_no_of_staff) * 100;
                        $percentage_progress = round($percentage_progress_of_appraisal, 2);
                    }
                    else {
                        $percentage_progress = 0;
                    }





                }

                // if there is no last fiscal id, alert and redirect
                else {

                    echo "<script>
                            alert('No Fiscal Sessions have been added/activated yet. Please check back later');
                            window.location.href = '../logout.php';
                        </script>";
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
                                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $user_role; ?></a></li>
                                            <li class="breadcrumb-item active"><?php echo $school_faculty_name; ?></li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">HODs</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?php echo $total_no_of_staff; ?>">0</span>
                                                </h4>
                                            </div>
        
                                            <div class="col-6">
                                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">Total</span>
                                            <span class="ms-1 text-muted font-size-13">In School/Faculty</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
        
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Unappraised HODs</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?php echo $no_of_unappraised_staff; ?>">0</span>
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-danger text-danger">Remaining</span>
                                            <span class="ms-1 text-muted font-size-13">Pending appraisal</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->
        
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Appraised HODs</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?php echo $no_of_appraised_staff; ?>">0</span>
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">Total</span>
                                            <span class="ms-1 text-muted font-size-13">Completed appraisal</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
        
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Progress</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?php echo $percentage_progress; ?>">0</span>%
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success"><?php echo $percentage_progress; ?>%</span>
                                            <span class="ms-1 text-muted font-size-13">Completed</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->    
                        </div><!-- end row-->

                        <div class="row">
                            <div class="col-xl-5">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center mb-4">
                                            <h5 class="card-title me-2">Assessment Report</h5>
                                            <div class="ms-auto">
                                                <div>
                                                    <button type="button" class="btn btn-soft-primary btn-sm active">
                                                        ALL
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        GOOD
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        AVG
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        POOR
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-sm">
                                                <div id="wallet-balance" data-colors='["#777aca", "#5156be", "#a8aada"]' class="apex-charts"></div>
                                            </div>
                                            <div class="col-sm align-self-center">
                                                <div class="mt-4 mt-sm-0">
                                                    <div>
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2" style="color:#a8aada;"></i> Poor</p>
                                                        <h6><?php echo $no_of_staff_poor; ?> HODs = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_staff_poor; ?>%</span></h6>
                                                    </div>
    
                                                    <div class="mt-4 pt-2">
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-primary"></i> Good</p>
                                                        <h6><?php echo $no_of_staff_good; ?> HODs = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_staff_good; ?>%</span></h6>
                                                    </div>
    
                                                    <div class="mt-4 pt-2">
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2" style="color:#777aca;"></i> Average</p>
                                                        <h6><?php echo $no_of_staff_average; ?> HODs = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_staff_average; ?>%</span></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                            <div class="col-xl-7">
                                <div class="row">

                                    <div class="col-xl-8">
                                        <!-- card -->
                                        <div class="card card-h-100">
                                            <!-- card body -->
                                            <div class="card-body">
                                                <div class="d-flex flex-wrap align-items-center mb-4">
                                                    <h5 class="card-title me-2">Appraisals Submitted</h5>
                                                    <div class="ms-auto">
                                                        <select class="form-select form-select-sm">
                                                            <option value="MAY" selected="">December</option>
                                                        </select>
                                                    </div>
                                                </div>
            
                                                <div class="row align-items-center">
                                                    <div class="col-sm">
                                                        <div id="invested-overview" data-colors='["#5156be", "#34c38f"]' class="apex-charts"></div>
                                                    </div>
                                                    <div class="col-sm align-self-center">
                                                        <div class="mt-4 mt-sm-0">
                                                            <p class="mb-1">Fiscal Year</p>
                                                            <h4><?php echo $last_fiscal_year; ?></h4>

                                                            <p class="text-muted mb-4"> DEADLINE: <?php echo strtoupper(date("d M Y", strtotime($last_deadline))); ?> <i class="mdi mdi-arrow-up ms-1 text-<?php echo $deadline_arrow_color; ?>"></i></p>

                                                            <div class="row g-0">
                                                                <div class="col-6">
                                                                    <div>
                                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Appraised</p>
                                                                        <h5 class="fw-medium"><?php echo $no_of_appraised_staff; ?></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div>
                                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Remaining</p>
                                                                        <h5 class="fw-medium"><?php echo $no_of_unappraised_staff; ?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mt-2">
                                                                <a href="appraisal-select-session.php" class="btn btn-primary btn-sm">Appraisal <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
        
                                    <div class="col-xl-4">
                                        <!-- card -->
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Search</h4>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="buy-tab" role="tabpanel">
                                                    
                                                        <div>
                                                            <form action="appraisal-history-hod.php" method="post">

                                                                <div class="form-group mb-3">
                                                                    <label>Year :</label>
                                                                    <select required class="form-select" name="year">
                                                                        <option value="">Select fiscal year</option>

                                                                        <?php

                                                                            // get all fiscal years
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
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label>HOD :</label>
                                                                    <select data-trigger class="form-select" name="staff_id">
                                                                        <option value="">Select HOD</option>
                                                                        
                                                                        <?php

                                                                            // get all hods
                                                                        
                                                                            $all_hods = select_all_where_asc_id("staff", "role", "HOD", "staff_name");

                                                                            if(count($all_hods) > 0) {

                                                                                foreach ($all_hods as $search_hod) {
                                                                                    
                                                                                    $hod_staff_id = $search_hod['staff_id'];
                                                                                    $hod_staff_name = $search_hod['staff_name'];
                                                                                    $hod_department_id = $search_hod['sch_fac_dept_id'];

                                                                                    // use department id to get school_faculty id
                                                                                    $hod_school_faculty_id = department_school_faculty_id($hod_department_id);

                                                                                    if($hod_school_faculty_id == $user_school_faculty_id) {

                                                                                        ?>
                                                                                        
                                                                                        <option value="<?php echo $hod_staff_id; ?>"><?php echo $hod_staff_name; ?></option>
                                                                                                    
                                                                                        
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }

                                                                        ?>

                                                                    </select>
                                                                </div>

                                                                <!-- submit button year only -->
                                                                <div class="text-center mb-3">
                                                                    <button type="submit" name="search_year_only" class="btn btn-sm btn-success w-md">Search by year only</button>
                                                                </div>

                                                                <!-- submit button all fields -->
                                                                <div class="text-center">
                                                                    <button type="submit" name="search_all_fields" class="btn btn-sm btn-primary w-md">Search by all fields</button>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <!-- end tab content -->
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end col -->
                        </div> <!-- end row-->


                        
                    </div>
                    <!-- container-fluid -->
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

        <!-- apexcharts -->
        <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Plugins js-->
        <script src="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <!-- dashboard init -->
        <script src="../assets/js/pages/dashboard.init.js"></script>

        <!-- init js -->
       <script src="../assets/js/pages/form-advanced.init.js"></script>





        <!-- custom script for graphs -->
        <script>
        
            // ASSESSMENT REPORT PIE CHART
            var piechartColors = getChartColorsArray("#wallet-balance"),
                options = {
                    series: [<?php echo $no_of_staff_average . ", " . $no_of_staff_good . ", " . $no_of_staff_poor; ?>],
                    chart: { width: 227, height: 227, type: "pie" },
                    labels: ["Average", "Good", "Poor"],
                    colors: piechartColors,
                    stroke: { width: 0 },
                    legend: { show: !1 },
                    responsive: [{ breakpoint: 480, options: { chart: { width: 200 } } }],
                };
            (chart = new ApexCharts(document.querySelector("#wallet-balance"), options)).render();



            // PERCENTAGE BAR
            var radialchartColors = getChartColorsArray("#invested-overview"),
                options = {
                    chart: { height: 270, type: "radialBar", offsetY: -10 },
                    plotOptions: {
                        radialBar: {
                            startAngle: -130,
                            endAngle: 130,
                            dataLabels: {
                                name: { show: !1 },
                                value: {
                                    offsetY: 10,
                                    fontSize: "18px",
                                    color: void 0,
                                    formatter: function (r) {
                                        return r + "%";
                                    },
                                },
                            },
                        },
                    },
                    colors: [radialchartColors[0]],
                    fill: { type: "gradient", gradient: { shade: "dark", type: "horizontal", gradientToColors: [radialchartColors[1]], shadeIntensity: 0.15, inverseColors: !1, opacityFrom: 1, opacityTo: 1, stops: [20, 60] } },
                    stroke: { dashArray: 4 },
                    legend: { show: !1 },
                    series: [<?php echo $percentage_progress; ?>],
                    labels: ["Series A"],
                };
            (chart = new ApexCharts(document.querySelector("#invested-overview"), options)).render();


        </script>





<style>
    .choices[data-type*=select-one] > .choices__list > .choices__list > .choices__item--selectable
{
	padding-right: 0px;
}
.choices[data-type*=select-one] > .choices__list > .choices__list > .choices__item--selectable::after
{
	display: none;
}
</style>










        <script src="../assets/js/app.js"></script>

        

    </body>


</html>