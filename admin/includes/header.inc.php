
<?php
    session_start();

    if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
        header("Location: index.php?error=login");
    }
    else {
        include "../dbh/dbh.php";
        include "../dbh/db_functions.php";

        // check open sessions whose deadlines are expired and close them automatically
        $appraisal_sessions = select_all_where("fiscal_sessions", "status", "1");

        if(count($appraisal_sessions) > 0) {

            foreach ($appraisal_sessions as $appraisal_session) {
                
                $appraisal_fiscal_session_id = $appraisal_session['fiscal_session_id'];
                $appraisal_deadline = $appraisal_session['deadline'];

                // if deadline is passed, close session automatically
                if(strtotime($appraisal_deadline) < strtotime(date("Y-m-d"))) {
                    
                    // prepare data to insert into database
                    $sql = "UPDATE fiscal_sessions SET status=? WHERE fiscal_session_id=? LIMIT 1";

                    $stmt = $pdo->prepare($sql);
                
                    
                    if( !($stmt->execute([2, $appraisal_fiscal_session_id])) ) {
                        echo "<script>
                            alert('Some expired appraisal sessions are still open and could not be closed automatically. Please go to sessions and manually close them');
                            
                        </script>";
                    }
                }

            }
        }
    }

?>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">

                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="dashboard.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../assets/images/logo.png" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/images/logo.png" alt="" height="24"> <span class="logo-txt">Admin</span>
                                </span>
                            </a>

                            <a href="dashboard.php" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="../assets/images/logo.png" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/images/logo.png" alt="" height="24"> <span class="logo-txt">Admin</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>

                        

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell" class="icon-lg"></i>
                                <!-- <span class="badge bg-danger rounded-pill">5</span> -->
                            </button>

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">

                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small text-reset text-decoration-underline"> Unread (0)</a>
                                        </div>
                                    </div>
                                </div>

                                

                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item right-bar-toggle me-2">
                                <i data-feather="settings" class="icon-lg"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="../assets/images/profile.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">Administrator</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="profile.php"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                                <!-- <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>

                            <li>
                                <a href="dashboard.php">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Dashboard</span>
                                </a>
                            </li>


                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="file-text"></i>
                                    <span data-key="t-pages">Appraisal</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="fiscal-sessions.php" data-key="t-session">Sessions</a></li>
                                    <li><a href="appraisal-history-hod.php" data-key="t-starter-page">HODs History</a></li>
                                    <li><a href="appraisal-history-lecturer.php" data-key="t-maintenance">Lecturers History</a></li>
                                </ul>
                            </li>

                            

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>
                                    <span data-key="t-authentication">Staff</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="deans.php" data-key="t-login">Deans</a></li>
                                    <li><a href="hods.php" data-key="t-hods">HODs</a></li>
                                    <li><a href="lecturers.php" data-key="t-lecturers">Lecturers</a></li>
                                </ul>
                            </li>



                            <li>
                                <a href="departments.php">
                                    <i data-feather="layout"></i>
                                    <span data-key="t-departments">Departments</span>
                                </a>
                            </li>


                            <li>
                                <a href="schools-faculties.php">
                                    <i data-feather="pie-chart"></i>
                                    <span data-key="t-hods">Schools & Faculties</span>
                                </a>
                            </li>




                            


                            <!-- <li class="menu-title mt-2" data-key="t-components">Elements</li> -->

                            

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="sliders"></i>
                                    <span data-key="t-tables">Settings</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="profile.php" data-key="t-basic-tables">Profile</a></li>
                                    <li><a href="change-password.php" data-key="t-data-tables">Change Password</a></li>
                                </ul>
                            </li>

                            

                        </ul>

                        
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">