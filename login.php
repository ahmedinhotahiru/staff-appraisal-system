<?php
session_start();
include "dbh/dbh.php";

if(isset($_POST['login'])) {
    $staff_id_no = $_POST['staff_id_no'];
    $password = $_POST['password'];

    if(empty($staff_id_no) || empty($password)) {
        header("Location: index.php?error=empty&staff_id=$staff_id_no");
        exit();
    }
    else {
        

            // check if user exists in db
            $sql = "SELECT * FROM users WHERE staff_id_no=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$staff_id_no]);

            $users = $stmt->fetchAll();
            
            if(count($users) < 1) {
                header("Location: index.php?error=user&staff_id_no=$staff_id_no");
                exit();
            }
            else {
                
                // verify password
                foreach ($users as $user) {

                    // GET STAFF ID (FOREIGN)

                    $staff_id = $user["staff_id"];

                    // get staff details
                    $sql = "SELECT * FROM staff WHERE staff_id=?";

                    // pdo query
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$staff_id]);

                    $staff = $stmt->fetchAll();

                    if($staff > 0) {
                        $title = $staff[0]['title'];
                        $staff_name = $staff[0]['staff_name'];
                        $sch_fac_dept_id = $staff[0]['sch_fac_dept_id'];
                        $role = $staff[0]['role'];

                        if($role == "Dean") {
                            $staff_to_appraise = "HOD";
                        }
                        else {
                            $staff_to_appraise = "Lecturer";
                        }
                        
                    }
                    else {
                        header("Location: index.php?error=user&staff_id_no=$staff_id_no");
                        exit();
                    }




                    
                    $hashedPassword = $user['password'];

                    $verify_password = password_verify($password, $hashedPassword);

                    if($verify_password === false) {
                        header("Location: index.php?error=password&staff_id_no=$staff_id_no");
                        exit();
                    }
                    elseif($verify_password === true) {
                        session_start();

                        $_SESSION['appraisal_user_id'] = $user['user_id'];
                        $_SESSION['appraisal_staff_id'] = $user['staff_id'];
                        $_SESSION['appraisal_role'] = $role;
                        $_SESSION['appraisal_title'] = $title;
                        $_SESSION['appraisal_staff_name'] = $staff_name;
                        $_SESSION['appraisal_staff_to_appraise'] = $staff_to_appraise;
                        $_SESSION['appraisal_sch_fac_dept_id'] = $sch_fac_dept_id;

                        // check role and redirect to desired dashboard

                        if($_SESSION['appraisal_role'] == "Dean") {
                            header("Location: staff/index_dean.php");
                            exit();
                        }
                        else {
                            header("Location: staff/index_hod.php");
                            exit();
                        }

                    }
                }
            }
        
    }
}