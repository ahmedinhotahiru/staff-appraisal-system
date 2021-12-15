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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Lecturers</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="32">0</span>
                                                </h4>
                                            </div>
        
                                            <div class="col-6">
                                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">DG-DM</span>
                                            <span class="ms-1 text-muted font-size-13">Department</span>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Unappraised Lecturers</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="15">0</span>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Appraised Lecturers</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="17">0</span>
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
                                                    <span class="counter-value" data-target="12.57">0</span>%
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge bg-soft-success text-success">12.57%</span>
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
                                                        <h6>8 Lecturers = <span class="text-muted font-size-14 fw-normal">25.0%</span></h6>
                                                    </div>
    
                                                    <div class="mt-4 pt-2">
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-primary"></i> Good</p>
                                                        <h6>9 Lecturers = <span class="text-muted font-size-14 fw-normal">28.1%</span></h6>
                                                    </div>
    
                                                    <div class="mt-4 pt-2">
                                                        <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2" style="color:#777aca;"></i> Average</p>
                                                        <h6>15 Lecturers = <span class="text-muted font-size-14 fw-normal">46.9%</span></h6>
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
                                                            <h4>2021/2022</h4>

                                                            <p class="text-muted mb-4"> DEADLINE: 25 JAN 2021 <i class="mdi mdi-arrow-up ms-1 text-success"></i></p>

                                                            <div class="row g-0">
                                                                <div class="col-6">
                                                                    <div>
                                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Appraised</p>
                                                                        <h5 class="fw-medium">17</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div>
                                                                        <p class="mb-2 text-muted text-uppercase font-size-11">Remaining</p>
                                                                        <h5 class="fw-medium">15</h5>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mt-2">
                                                                <a href="appraisal-select.php" class="btn btn-primary btn-sm">Appraisal <i class="mdi mdi-arrow-right ms-1"></i></a>
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

        <!-- apexcharts -->
        <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Plugins js-->
        <script src="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="../assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <!-- dashboard init -->
        <script src="../assets/js/pages/dashboard.init.js"></script>




        <!-- custom script for graphs -->
        <script>
        
            // ASSESSMENT REPORT PIE CHART
            var piechartColors = getChartColorsArray("#wallet-balance"),
                options = {
                    series: [15, 9, 8],
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
                    series: [55],
                    labels: ["Series A"],
                };
            (chart = new ApexCharts(document.querySelector("#invested-overview"), options)).render();


        </script>






        <script src="../assets/js/app.js"></script>

        

    </body>


</html>