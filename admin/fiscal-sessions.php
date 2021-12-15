<!doctype html>
<html lang="en">

    

    <head>
        
        <meta charset="utf-8" />
        <title>Admin | Fiscal Sessions</title>
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
                                    <h4 class="mb-sm-0 font-size-18">Sessions</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sessions</a></li>
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
                                                Added Session successfully.
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
                                                Deleted Session successfully.
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
                                $add = $_GET['edit'];
                                switch ($add) {
                                    case 'success':
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                Edited Session successfully.
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
                                                    <p class="card-title-desc">Sessions.</p>

                                                </div>
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="d-flex align-items-center gap-1 mb-4">
                                                    <a href="add-fiscal-session.php" class="input-group-text" type="submit"><i class="bx bx-plus"></i> Add New</a>
                                                    
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
                                                        <th>Fiscal Year</th>
                                                        <th>Deadline</th>
                                                        <th>Status</th>
                                                        <th style="width: 90px;">Action</th>
                                                    </tr>
                                                </thead>

                                                <?php

                                                    $sessions = select_all_desc_id("fiscal_sessions", "fiscal_session_id");

                                                    if(count($sessions) > 0) {

                                                        foreach ($sessions as $session) {
                                                            // get details
                                                            $fiscal_session_id = $session['fiscal_session_id'];
                                                            $fiscal_year = $session['fiscal_year'];
                                                            $deadline = $session['deadline'];
                                                            $status = $session['status'];

                                                            // check deadline and give color
                                                            $deadline_text = "";
                                                            if(strtotime($deadline) < strtotime(date("Y-m-d"))) {
                                                                $deadline_text = "text-danger";
                                                            }

                                                            // check status and indicate swicth type and text 
                                                            $session_status = "";
                                                            $status_color = "";

                                                            if($status == 1) {
                                                                $session_status = "Open";
                                                                $status_color = "checked";
                                                            }
                                                            else {
                                                                $session_status = "Closed";
                                                            }


                                                            ?>



                                                            <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16">
                                                                        <input type="checkbox" class="form-check-input">
                                                                        <label class="form-check-label"></label>
                                                                    </div>
                                                                </td>
                                                                
                                                                <td><?php echo $fiscal_year; ?></td>

                                                                <td>
                                                                    <span class="<?php echo $deadline_text; ?>">
                                                                        <?php echo date("d M Y", strtotime($deadline)); ?>
                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <!-- <div class="badge badge-soft-<?php echo $status_color; ?> font-size-12"><?php echo $session_status; ?></div> -->

                                                                    <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                                        <input type="checkbox" onclick="redirect(<?php echo $fiscal_session_id; ?>);" class="form-check-input" id="switch<?php echo $fiscal_session_id; ?>" <?php echo $status_color; ?>>

                                                                        <label class="form-check-label" for="switch<?php echo $fiscal_session_id; ?>"><?php echo $session_status; ?></label>
                                                                    </div>

                                                                    <script>
                                                                        function redirect(fiscal_session_id) {
                                                                            window.location.href="controls/change-session-status.php?id=" + fiscal_session_id;
                                                                        }
                                                                    </script>

                                                                </td>

                                                                <td>

                                                                    <a href="edit-fiscal-session.php?id=<?php echo $fiscal_session_id; ?>">Edit<i class="mdi mdi-arrow-right ms-1"></i></a> |

                                                                    <a class="text-danger" onclick="return confirm('Are you sure you want to delete <?php echo $fiscal_year; ?>?');" href="controls/delete-fiscal-session.php?id=<?php echo $fiscal_session_id; ?>">Delete<i class="mdi mdi-delete ms-1"></i></a>

                                                                </td>
                                                            </tr>

                                                            
                                                            
                                                            <?php
                                                        }
                                                    }





                                                ?>

                                                <tbody>
        
                                                    

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
