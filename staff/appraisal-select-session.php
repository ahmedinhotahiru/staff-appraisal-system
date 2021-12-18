<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Staff Appraisal | Select Fiscal Year</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SDD-UBIDS Staff Appraisal" name="description" />
        <meta content="SDD-UBIDS" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/logo.png">

        <!-- choices css -->
        <link href="../assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

        <!-- color picker css -->
        <link rel="stylesheet" href="../assets/libs/%40simonwep/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->
        <link rel="stylesheet" href="../assets/libs/%40simonwep/pickr/themes/monolith.min.css"/> <!-- 'monolith' theme -->
        <link rel="stylesheet" href="../assets/libs/%40simonwep/pickr/themes/nano.min.css"/> <!-- 'nano' theme -->

        <!-- datepicker css -->
        <link rel="stylesheet" href="../assets/libs/flatpickr/flatpickr.min.css">

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


        <?php include "includes/header.inc.php"; ?>





        



        

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Staff Appraisal</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Staff Appraisal</a></li>
                                            <li class="breadcrumb-item active">Select Fiscal Year</li>
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
                                        <h4 class="card-title">Select Fiscal Year</h4>
                                        <p class="card-title-desc">Please select a fiscal year to appraise.</p>
                                    </div>
                                    <!-- end card header -->

                                    <div class="card-body" style="height:400px">
                                        <div>
                                            <!-- <h5 class="font-size-14 mb-3">Single select input Example</h5> -->


                                            <form action="appraisal-select-staff.php" method="post">


                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <label for="staff" class="form-label font-size-13 text-muted">Fiscal Year</label>
                                                            <select class="form-control form-select" name="fiscal_session_id" required>
                                                                <option value="">Select Fiscal Year</option>

                                                                <!-- get all open fiscal sessions and display -->
                                                                <?php

                                                                    $open_fiscal_sessions = select_all_where_desc_id("fiscal_sessions", "status", 1, "fiscal_session_id");

                                                                    if(count($open_fiscal_sessions) > 0) {

                                                                        $select_current_year = 1;

                                                                        foreach ($open_fiscal_sessions as $fiscal_session) {
                                                                            
                                                                            $fiscal_session_id = $fiscal_session['fiscal_session_id'];
                                                                            $fiscal_year = $fiscal_session['fiscal_year'];

                                                                            ?>
                                                                            
                                                                            <option value="<?php echo $fiscal_session_id; ?>" <?php if($select_current_year == 1) {echo 'selected';} ?>><?php echo $fiscal_year; ?></option>
                                                                            
                                                                            
                                                                            <?php
                                                                            $select_current_year++;
                                                                        }
                                                                    }


                                                                ?>

                                                            </select>
                                                        </div>
                                                        
                                                    </div>

                                                </div>
                                                <!-- end row -->


                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <button type="submit" name="appraise_fiscal_year" class="btn btn-success w-md">Proceed <i class="mdi mdi-arrow-right ms-1"></i></button>
                                                    </div>

                                                </div>
                                                <!-- end row -->


                                            </form>


                                        </div>
                                        <!-- Single select input Example -->


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

        <!-- choices js -->
        <script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

        <!-- color picker js -->
        <script src="../assets/libs/%40simonwep/pickr/pickr.min.js"></script>
        <script src="../assets/libs/%40simonwep/pickr/pickr.es5.min.js"></script>

        <!-- datepicker js -->
        <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>

        <!-- init js -->
        <script src="../assets/js/pages/form-advanced.init.js"></script>

        <script src="../assets/js/app.js"></script>

    </body>

</html>
