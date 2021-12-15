<!doctype html>
<html lang="en">

    
    <head>

        <meta charset="utf-8" />
        <title>Admin | Dashboard</title>
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

            // get last/current fiscal session id
            $last_fiscal_session = select_all_desc_id_limit("fiscal_sessions", "fiscal_session_id", 1);

            $last_fiscal_session_id = $last_fiscal_session[0]['fiscal_session_id'];

            // get last fiscal year and its deadline
            $last_fiscal_year = $last_fiscal_session[0]['fiscal_year'];
            $last_deadline = $last_fiscal_session[0]['deadline'];

            // determine deadline arrow color
            if(strtotime($last_deadline) < strtotime(date("Y-m-d"))) {
                $deadline_arrow_color = "danger";
            }
            else {
                $deadline_arrow_color = "success";
            }

            $last_appraisals = select_all_where("appraisal", "fiscal_session_id", $last_fiscal_session_id);

            // $n = count($appraised_staff);
            // echo "<script>alert('$n');</script>";

            if(count($last_appraisals) > 0) {

                $no_of_lecturers_appraised = 0;
                $no_of_hods_appraised = 0;


                // create container to hold hod and lecturer grand means
                $hod_grand_means_array = array();
                $lecturers_grand_means_array = array();

                foreach ($last_appraisals as $appraisal_result) {

                    // get grand mean
                    $grand_mean = $appraisal_result['grand_mean'];

                    
                    // get the staff id and check the staff role

                    $staff_id = $appraisal_result['staff_id'];

                    // get staff role
                    $role = select_all_where("staff", "staff_id", $staff_id)[0]["role"];

                    if($role == "HOD") {
                        $no_of_hods_appraised++;
                        $hod_grand_means_array[] = $grand_mean;

                    }
                    else {
                        $no_of_lecturers_appraised++;
                        $lecturers_grand_means_array[] = $grand_mean;
                    }

                }
            }
            else {
                $no_of_lecturers_appraised = 0;
                $no_of_hods_appraised = 0;

                $hod_grand_means_array = array();
                $lecturers_grand_means_array = array();
            }



            // get numbers of avg, good and poor performances for hods
            $hod_analysis_result = analysis_results($hod_grand_means_array);

            $no_of_hods_average = $hod_analysis_result[0];
            $no_of_hods_good = $hod_analysis_result[1];
            $no_of_hods_poor = $hod_analysis_result[2];


            // calculate percentages for hod
            $hod_analysis_percentages = analysis_percentages($hod_analysis_result);

            $percentage_hod_average = $hod_analysis_percentages[0];
            $percentage_hod_good = $hod_analysis_percentages[1];
            $percentage_hod_poor = $hod_analysis_percentages[2];



            // get numbers of avg, good and poor performances for hods
            $lecturers_analysis_result = analysis_results($lecturers_grand_means_array);

            $no_of_lecturers_average = $lecturers_analysis_result[0];
            $no_of_lecturers_good = $lecturers_analysis_result[1];
            $no_of_lecturers_poor = $lecturers_analysis_result[2];


            // calculate percentages for lecturers
            $lecturers_analysis_percentages = analysis_percentages($lecturers_analysis_result);

            $percentage_lecturers_average = $lecturers_analysis_percentages[0];
            $percentage_lecturers_good = $lecturers_analysis_percentages[1];
            $percentage_lecturers_poor = $lecturers_analysis_percentages[2];

            // array format = (avg, good, poor)



            // calculate percentage progress of HOD appraisal
            $total_no_of_hods = no_of_rows_where("staff", "role", "HOD");
            $percentage_progress_hods = ($no_of_hods_appraised / $total_no_of_hods) * 100;
            $percentage_appraised_hods = round($percentage_progress_hods, 0);


            // calculate percentage progress of lecturer appraisal
            $total_no_of_lecturers = no_of_rows_where("staff", "role", "Lecturer");
            $percentage_progress_lecturers = ($no_of_lecturers_appraised / $total_no_of_lecturers) * 100;
            $percentage_appraised_lecturers = round($percentage_progress_lecturers, 0);
            
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Lecturers Total</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?php echo no_of_rows_where("staff", "role", "Lecturer"); ?>">0</span>
                                                </h4>
                                            </div>
        
                                            <div class="col-6">
                                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">Total</span>
                                            <span class="ms-1 text-muted font-size-13">Registered</span>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Lecturers Appraised</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?php echo $no_of_lecturers_appraised; ?>">0</span>
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">Total</span>
                                            <span class="ms-1 text-muted font-size-13">Completed appraisal</span>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">HODs Total</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?php echo no_of_rows_where("staff", "role", "HOD"); ?>">0</span>
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">Total</span>
                                            <span class="ms-1 text-muted font-size-13">Registered</span>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">HODs Appraised</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="<?php echo $no_of_hods_appraised; ?>">0</span>
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">Total</span>
                                            <span class="ms-1 text-muted font-size-13">Completed appraisal</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->    
                        </div><!-- end row-->





                        <!-- HOD ASSESSMENT REPORT -->
                        <div class="row">

                            <div class="col-xl-5">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center mb-4">
                                            <h5 class="card-title me-2">HODs Assessment Report</h5>
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
                                                        <h6><?php echo $no_of_hods_poor; ?> HODs = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_hod_poor; ?>%</span></h6>
                                                    </div>
    
                                                    <div class="mt-4 pt-2">
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-primary"></i> Good</p>
                                                        <h6><?php echo $no_of_hods_good; ?> HODs = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_hod_good; ?>%</span></h6>
                                                    </div>
    
                                                    <div class="mt-4 pt-2">
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2" style="color:#777aca;"></i> Average</p>
                                                        <h6><?php echo $no_of_hods_average; ?> HODs = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_hod_average; ?>%</span></h6>
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
                                                    <h5 class="card-title me-2">HOD Appraisals Submitted</h5>
                                                    <div class="ms-auto">
                                                        <select class="form-select form-select-sm">
                                                            <option value="" selected="">Progress</option>
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

                                                            <p class="text-muted mb-4"> 
                                                                DEADLINE: <?php echo strtoupper(date("d M Y", strtotime($last_deadline))); ?> 
                                                                <i class="mdi mdi-arrow-up ms-1 text-<?php echo $deadline_arrow_color; ?>"></i>
                                                            </p>

                                                            <div class="row g-0">
                                                                <div class="col-6">
                                                                    <div>
                                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Appraised</p>
                                                                        <h5 class="fw-medium"><?php echo $no_of_hods_appraised; ?></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div>
                                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Remaining</p>
                                                                        <h5 class="fw-medium">
                                                                            <?php echo $total_no_of_hods - $no_of_hods_appraised; ?>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mt-2">
                                                                <a href="appraisal-history-hod.php" class="btn btn-primary btn-sm">Results <i class="mdi mdi-arrow-right ms-1"></i></a>
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
                                                <h4 class="card-title mb-0 flex-grow-1">Search HOD</h4>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="buy-tab" role="tabpanel">
                                                    
                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label>Year :</label>
                                                                <select data-trigger class="form-select">
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
                                                                <select data-trigger class="form-select">
                                                                    <option value="">Select HOD</option>
                                                                    
                                                                    <?php

                                                                        // get all fiscal years
                                                                        $all_hods = select_all_asc_id("staff", "staff_name");

                                                                        if(count($all_hods) > 0) {

                                                                            foreach ($all_hods as $search_hod) {
                                                                                
                                                                                $hod_staff_id = $search_hod['staff_id'];
                                                                                $hod_staff_name = $search_hod['staff_name'];

                                                                                ?>
                                                                                
                                                                                <option value="<?php echo $hod_staff_id; ?>"><?php echo $hod_staff_name; ?></option>
                                                                                            
                                                                                
                                                                                <?php
                                                                            }
                                                                        }

                                                                    ?>

                                                                </select>
                                                            </div>

                                                            
        

                                                            <div class="text-center mb-3">
                                                                <form action="search-results.php" method="post">
                                                                    <button type="submit" class="btn btn-sm btn-success w-md">Search by year only</button>
                                                                </form>
                                                            </div>
                                                            <div class="text-center">
                                                                <form action="search-results.php" method="post">
                                                                    <button type="submit" class="btn btn-sm btn-primary w-md">Search by all fields</button>
                                                                </form>
                                                            </div>
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

                        </div>
                        <!-- HOD ASSESSMENT REPORT END HERE-->







                        <!-- LECTURER ASSESSMENT REPORT -->
                        <div class="row">

                            <div class="col-xl-5">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center mb-4">
                                            <h5 class="card-title me-2">Lecturers Assessment Report</h5>
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
                                                <div id="wallet-balance2" data-colors='["#598131", "#3d700a", "#d4efb5"]' class="apex-charts"></div>
                                            </div>
                                            <div class="col-sm align-self-center">
                                                <div class="mt-4 mt-sm-0">
                                                    <div>
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2" style="color:#d4efb5;"></i> Poor</p>
                                                        <h6><?php echo $no_of_lecturers_poor; ?> Lecturers = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_lecturers_poor; ?>%</span></h6>
                                                    </div>
    
                                                    <div class="mt-4 pt-2">
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2" style="color:#3d700a;"></i> Good</p>
                                                        <h6><?php echo $no_of_lecturers_good; ?> Lecturers = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_lecturers_good; ?>%</span></h6>
                                                    </div>
    
                                                    <div class="mt-4 pt-2">
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2" style="color:#598131;"></i> Average</p>
                                                        <h6><?php echo $no_of_lecturers_average; ?> Lecturers = <span class="text-muted font-size-14 fw-normal"><?php echo $percentage_lecturers_average; ?>%</span></h6>
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
                                                    <h5 class="card-title me-2">Lecturer Appraisals Submitted</h5>
                                                    <div class="ms-auto">
                                                        <select class="form-select form-select-sm">
                                                            <option value="" selected="">Progress</option>
                                                        </select>
                                                    </div>
                                                </div>
            
                                                <div class="row align-items-center">
                                                    <div class="col-sm">
                                                        <div id="invested-overview2" data-colors='["#3d700a", "#fd625e"]' class="apex-charts"></div>
                                                    </div>
                                                    <div class="col-sm align-self-center">
                                                        <div class="mt-4 mt-sm-0">
                                                            <p class="mb-1">Fiscal Year</p>
                                                            <h4><?php echo $last_fiscal_year; ?></h4>

                                                            <p class="text-muted mb-4"> 
                                                                DEADLINE: <?php echo strtoupper(date("d M Y", strtotime($last_deadline))); ?> <i class="mdi mdi-arrow-up ms-1 text-<?php echo $deadline_arrow_color; ?>"></i>
                                                            </p>

                                                            <div class="row g-0">
                                                                <div class="col-6">
                                                                    <div>
                                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Appraised</p>
                                                                        <h5 class="fw-medium"><?php echo $no_of_lecturers_appraised; ?></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div>
                                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Remaining</p>
                                                                        <h5 class="fw-medium">
                                                                            <?php echo $total_no_of_lecturers - $no_of_lecturers_appraised; ?>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mt-2">
                                                                <a href="appraisal-history-lecturer.php" class="btn btn-danger btn-sm" > Results <i class="mdi mdi-arrow-right ms-1"></i></a>
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
                                                <h4 class="card-title mb-0 flex-grow-1">Search Lecturer</h4>
                                            </div><!-- end card header -->

                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="buy-tab" role="tabpanel">
                                                    
                                                        <div>
                                                            <div class="form-group mb-3">
                                                                <label>Year :</label>
                                                                <select class="form-select">
                                                                    <option>2020/2021</option>
                                                                    <option>2021/2022</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group mb-3">
                                                                <label>Lecturer :</label>
                                                                <select class="form-select">
                                                                    <option>Ahmed Issah</option>
                                                                    <option>Jude Apana</option>
                                                                </select>
                                                            </div>

                                                            
        

                                                            <div class="text-center mb-3">
                                                                <form action="search-results.php" method="post">
                                                                    <button type="submit" class="btn btn-sm w-md" style="background: #3d700a; color: white;">Search by year only</button>
                                                                </form>
                                                            </div>
                                                            <div class="text-center">
                                                                <form action="search-results.php" method="post">
                                                                    <button type="submit" class="btn btn-sm btn-danger w-md">Search by all fields</button>
                                                                </form>
                                                            </div>
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
                            
                        </div>
                        <!-- LECTURER ASSESSMENT REPORT END HERE-->






                        
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
                                                                







        <!-- custom script for HOD graphs -->
        <script>
        
            // ASSESSMENT REPORT PIE CHART (avg, good, poor)
            var piechartColors = getChartColorsArray("#wallet-balance"),
                options = {
                    // series: [15, 9, 8],
                    series: [<?php echo $no_of_hods_average . ", " . $no_of_hods_good . ", " . $no_of_hods_poor; ?>],
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
                    // series: [55],
                    series: [<?php echo $percentage_appraised_hods; ?>],
                    labels: ["Series A"],
                };
            (chart = new ApexCharts(document.querySelector("#invested-overview"), options)).render();


        </script>







        <!-- custom script for Lecturer graphs -->
        <script>
        
            // ASSESSMENT REPORT PIE CHART
            var piechartColors2 = getChartColorsArray("#wallet-balance2"),
                options = {
                    // average, good, poor
                    // series: [99, 33, 86],
                    series: [<?php echo $no_of_lecturers_average . ", " . $no_of_lecturers_good . ", " . $no_of_lecturers_poor; ?>],
                    chart: { width: 227, height: 227, type: "pie" },
                    labels: ["Average", "Good", "Poor"],
                    colors: piechartColors2,
                    stroke: { width: 0 },
                    legend: { show: !1 },
                    responsive: [{ breakpoint: 480, options: { chart: { width: 200 } } }],
                };
            (chart = new ApexCharts(document.querySelector("#wallet-balance2"), options)).render();



            // PERCENTAGE BAR
            var radialchartColors2 = getChartColorsArray("#invested-overview2"),
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
                    colors: [radialchartColors2[0]],
                    fill: { type: "gradient", gradient: { shade: "dark", type: "horizontal", gradientToColors: [radialchartColors2[1]], shadeIntensity: 0.15, inverseColors: !1, opacityFrom: 1, opacityTo: 1, stops: [20, 60] } },
                    stroke: { dashArray: 4 },
                    legend: { show: !1 },
                    // series: [93],
                    series: [<?php echo $percentage_appraised_lecturers; ?>],
                    labels: ["Series A"],
                };
            (chart = new ApexCharts(document.querySelector("#invested-overview2"), options)).render();


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