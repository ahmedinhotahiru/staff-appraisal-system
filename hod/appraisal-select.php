<!doctype html>
<html lang="en">

    
    <head>
        
        <meta charset="utf-8" />
        <title>Staff Appraisal | Select Staff</title>
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
                                            <li class="breadcrumb-item active">Select Staff</li>
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
                                        <h4 class="card-title">Select Staff</h4>
                                        <p class="card-title-desc">Please select a staff to appraise.</p>
                                    </div>
                                    <!-- end card header -->

                                    <div class="card-body" style="height:400px">
                                        <div>
                                            <!-- <h5 class="font-size-14 mb-3">Single select input Example</h5> -->


                                            <form action="appraisal.php" method="post">


                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <div class="">
                                                            <label for="staff" class="form-label font-size-13 text-muted">Staff</label>
                                                            <select class="form-control" data-trigger name="staff"
                                                                id="choices-single-default"
                                                                placeholder="Search">
                                                                <option value="">Select Staff</option>
                                                                <option value="Choice 1">Choice 1</option>
                                                                <option value="Choice 2">Choice 2</option>
                                                                <option value="Choice 3">Choice 3</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>

                                                </div>
                                                <!-- end row -->


                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-success w-md">Proceed <i class="mdi mdi-arrow-right ms-1"></i></button>
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

<!-- Mirrored from minia.php.themesbrand.com/form-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Nov 2021 12:09:24 GMT -->
</html>
