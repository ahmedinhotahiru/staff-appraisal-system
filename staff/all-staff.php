<!doctype html>
<html lang="en">

    

    <head>
        
        <meta charset="utf-8" />
        <title>All Staff | Staff Appraisal System</title>
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

            // get department/faculty/school name

            if($_SESSION['appraisal_role'] == "Dean") {
                $sch_fac_dept_name = school_faculty_name($_SESSION['appraisal_sch_fac_dept_id']);
            }
            else {
                $sch_fac_dept_name = department_name($_SESSION['appraisal_sch_fac_dept_id']);
            }
        ?>





                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"><?php echo $_SESSION['appraisal_staff_to_appraise']; ?>s</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $_SESSION['appraisal_staff_to_appraise']; ?>s</a></li>
                                            <li class="breadcrumb-item active">Full List</li>
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
                                                    <h4 class="card-title"><?php echo $_SESSION['appraisal_staff_to_appraise']; ?>s | Full List</h4>
                                                    <p class="card-title-desc"><?php echo $sch_fac_dept_name; ?>.</p>

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
                                                        <th>Staff Name</th>
                                                        <th>Position</th>
                                                        <th style="width: 150px;">Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                        $search_role = $_SESSION['appraisal_staff_to_appraise'];

                                                        $all_staff = select_all_where_desc_id("staff", "role", "$search_role", "staff_id");

                                                        if(count($all_staff) > 0) {

                                                            // get lecturer details
                                                            foreach ($all_staff as $staff) {
                                                                
                                                                $staff_id = $staff['staff_id'];
                                                                $staff_id_no = $staff['staff_id_no'];
                                                                $title = $staff['title'];
                                                                $staff_name = $staff['staff_name'];
                                                                $sch_fac_dept_id = $staff['sch_fac_dept_id'];
                                                                $position = $staff['position'];
                                                                $email = $staff['email'];

                                                                // $department_school_faculty_id = department_school_faculty_id($sch_fac_dept_id);

                                                                if($_SESSION['appraisal_role'] == "Dean") {

                                                                    // check department school/fauclty id
                                                                    $staff_school_id = department_school_faculty_id($sch_fac_dept_id);

                                                                    if($staff_school_id == $_SESSION['appraisal_sch_fac_dept_id']) {

                                                                        ?>
                                                                
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-check font-size-16">
                                                                                    <input type="checkbox" class="form-check-input">
                                                                                    <label class="form-check-label"></label>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td><span class="text-dark fw-medium"><?php echo $staff_id_no; ?></span> </td>

                                                                            <td><?php echo $title . " " . $staff_name; ?></td>
                                                                            <td><?php echo $position; ?></td>
                                                                            <td><?php echo $email; ?></td>

                                                                            
                                                                        </tr>
                                                                        
                                                                        <?php

                                                                    }
                                                                }

                                                                else {

                                                                    if($sch_fac_dept_id == $_SESSION['appraisal_sch_fac_dept_id']) {

                                                                        ?>
                                                                
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-check font-size-16">
                                                                                    <input type="checkbox" class="form-check-input">
                                                                                    <label class="form-check-label"></label>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td><span class="text-dark fw-medium"><?php echo $staff_id_no; ?></span> </td>

                                                                            <td><?php echo $title . " " . $staff_name; ?></td>
                                                                            <td><?php echo $position; ?></td>
                                                                            <td><?php echo $email; ?></td>

                                                                            
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
