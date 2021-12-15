<!doctype html>
<html lang="en">

    

    <head>
        
        <meta charset="utf-8" />
        <title>Staff Appraisal | Search Results</title>
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
        ?>





                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Search Results</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Appraisal</a></li>
                                            <li class="breadcrumb-item active">Search Results</li>
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
                                                    <h4 class="card-title">Search Keywords</h4>
                                                    <p class="card-title-desc">Staff Appraisal Results.</p>

                                                </div>
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="d-flex align-items-center gap-1 mb-4">
                                                    <form action="" method="post">
                                                        <div class="input-group datepicker-range">
                                                            <select name="fiscal_year" required class="form-control form-select">
                                                                <option value="">Select fiscal year</option>
                                                                <option value="2019/2020">2019/2020</option>
                                                                <option value="2020/2021">2020/2021</option>
                                                                <option value="2021/2022">2021/2022</option>
                                                            </select>
                                                            <!-- <input type="text" class="form-control flatpickr-input" data-input aria-describedby="date1"> -->
                                                            <button class="input-group-text" type="submit"><i class="bx bx-search"></i> Search</button>
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
                                                        <th>Date</th>
                                                        <th style="width: 150px;">Staff Name</th>
                                                        <th>Results</th>
                                                        <th>Grand Mean</th>
                                                        <th>Remark</th>
                                                        <th style="width: 90px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
        
                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>
                                                        
                                                        <td><a href="javascript: void(0);" class="text-dark fw-medium">#MN0215</a> </td>
                                                        <td>
                                                            12 Oct, 2020
                                                        </td>
                                                        <td>Dr. Ophelius Yinyeh</td>
                                                        
                                                        <td>
                                                            45
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-soft-success font-size-12">4.2</div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                Very Good
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <a class="" href="appraisal-result-detail.php">View <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>
                                                        
                                                        <td><a href="javascript: void(0);" class="text-dark fw-medium">#MN0216</a> </td>
                                                        <td>
                                                            12 Oct, 2020
                                                        </td>
                                                        <td>Dr. Peter Agbedenab</td>
                                                        
                                                        <td>
                                                            21
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-soft-danger font-size-12">2.7</div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                Poor
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <a class="" href="appraisal-result-detail.php">View <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>
                                                        
                                                        <td><a href="javascript: void(0);" class="text-dark fw-medium">#MN0216</a> </td>
                                                        <td>
                                                            12 Oct, 2020
                                                        </td>
                                                        <td>Prof. Edward Baagyere</td>
                                                        
                                                        <td>
                                                            21
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-soft-secondary font-size-12">3.6</div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                Average
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <a class="" href="appraisal-result-detail.php">View <i class="mdi mdi-arrow-right ms-1"></i></a>
                                                        </td>
                                                    </tr>

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
