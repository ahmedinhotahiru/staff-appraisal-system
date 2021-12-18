<!doctype html>
<html lang="en">

    

    <head>
        
        <meta charset="utf-8" />
        <title>Admin | Deans</title>
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
                                    <h4 class="mb-sm-0 font-size-18">Deans</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Deans</a></li>
                                            <li class="breadcrumb-item active">Full List</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->






                        <!-- display error messages here -->
                        <?php
                                            
                            if(isset($_GET['add'])) {
                                $add = $_GET['add'];
                                switch ($add) {
                                    case 'success':
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                Dean added successfully.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        break;
                                    
                                }
                            }


                            if(isset($_GET['delete'])) {
                                $add = $_GET['delete'];
                                switch ($add) {
                                    case 'success':
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                Deleted Dean successfully.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        break;

                                    case 'failed':
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-block-helper me-2"></i>
                                                Delete failed. Try again!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        break;
                                    
                                }
                            }

                            if(isset($_GET['edit'])) {
                                $edit = $_GET['edit'];
                                switch ($edit) {
                                    case 'success':
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                Edited Dean successfully.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        break;

                                    case 'failed':
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-block-helper me-2"></i>
                                                Edit failed. Try again!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        break;
                                    
                                }
                            }



                        ?>















                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm">
                                                <div class="mb-4">
                                                    <h4 class="card-title">Full List</h4>
                                                    <p class="card-title-desc">Deans of Schools / Faculties.</p>

                                                </div>
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="d-flex align-items-center gap-1 mb-4">
                                                    <form action="add-staff.php" method="get">
                                                        <button class="input-group-text" type="submit" name="role" value="1"><i class="bx bx-plus"></i> Add New</button>
                                                    
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
                                                        <th>Staff Name</th>
                                                        <th>School/Faculty</th>
                                                        <!-- <th>Department</th> -->
                                                        <th>Position</th>
                                                        <th style="width: 150px;">Email</th>
                                                        <th style="width: 90px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                        // $deans = select_all_where("staff", "role", "Dean");
                                                        $deans = select_all_where_desc_id("staff", "role", "Dean", "staff_id");

                                                        if(count($deans) > 0) {

                                                            // get dean details
                                                            foreach ($deans as $dean) {
                                                                
                                                                $staff_id = $dean['staff_id'];
                                                                $staff_id_no = $dean['staff_id_no'];
                                                                $title = $dean['title'];
                                                                $staff_name = $dean['staff_name'];
                                                                $sch_fac_dept_id = $dean['sch_fac_dept_id'];
                                                                $position = $dean['position'];
                                                                $email = $dean['email'];

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
                                                                    <td><?php echo school_faculty_name($sch_fac_dept_id); ?></td>
                                                                    <td><?php echo $position; ?></td>
                                                                    <td><?php echo $email; ?></td>

                                                                    <td>

                                                                        <a href="edit-staff.php?id=<?php echo $staff_id; ?>">Edit<i class="mdi mdi-arrow-right ms-1"></i></a> |

                                                                        <a class="text-danger" onclick="return confirm('Are you sure you want to delete <?php echo $staff_name; ?>?');" href="controls/delete-staff.php?id=<?php echo $staff_id; ?>&role=1">Delete<i class="mdi mdi-delete ms-1"></i></a>

                                                                    </td>
                                                                </tr>
                                                                
                                                                <?php
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
