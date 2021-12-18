<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
    exit();
}




// check form submission

if(isset($_POST['edit-staff'])) {

    // get form details
    $staff_id = trim($_POST['staff_id']);
    $title = trim($_POST['title']);
    $staff_name = trim(ucwords(strtolower($_POST['staff_name'])));
    $staff_id_no = trim(strtoupper($_POST['staff_id_no']));
    $position = trim(ucwords(strtolower($_POST['position'])));
    $sch_fac_dept_id = trim($_POST['sch_fac_dept_id']);
    $email = trim($_POST['email']);

    $role = trim($_POST['role']);
    

    if(empty($staff_id)) {
        header("Location: ../dashboard.php");
        exit();
    }
    
    elseif(empty($title) || empty($staff_name) || empty($staff_id_no) || empty($position) || empty($role) || empty($email)) {
        header("Location: ../edit-staff.php?error=empty&id=$staff_id&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
        exit();
    }
    elseif(empty($sch_fac_dept_id)) {
        header("Location: ../edit-staff.php?error=emptySchFacDept&id=$staff_id&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
        exit();
    }
    elseif(!preg_match("/^[a-z A-Z \.]+$/", $staff_name)) {
        header("Location: ../edit-staff.php?error=staffName&id=$staff_id&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
        exit();
    }

    elseif(!preg_match("/^([a-zA-Z0-9\.-]+)@([a-zA-Z0-9-]+)\.([a-zA-Z]{2,5})(\.[a-zA-Z]{2,5})?$/", $email)) {
        header("Location: ../edit-staff.php?error=email&id=$staff_id&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
        exit();
    }
 
    else {

        // check this users original email and staff ID
        $userDetails = select_all_where("staff", "staff_id", $staff_id);
        $userStaffIdNo = $userDetails[0]['staff_id_no'];
        $userEmail = $userDetails[0]['email'];

        if($userStaffIdNo != $staff_id_no) {
             // check if staff id already exists
            $staff_id_exists = select_all_where("staff", "staff_id_no", $staff_id_no);

            if(count($staff_id_exists) > 0) {
                header("Location: ../edit-staff.php?error=staffExists&id=$staff_id&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
                exit();
            }

        }
        if($userEmail != $email) {

            // check if email already exists
            $email_exists = select_all_where("staff", "email", $email);

            if(count($email_exists) > 0) {
                header("Location: ../edit-staff.php?error=emailExists&id=$staff_id&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
                exit();
            }
        }
        



        // update details
        $sql = "UPDATE staff SET staff_id_no=?, title=?, staff_name=?, sch_fac_dept_id=?, position=?, email=? WHERE staff_id=?";

        // pdo query
        $stmt = $pdo->prepare($sql);

        if($stmt->execute([$staff_id_no, $title, $staff_name, $sch_fac_dept_id, $position, $email, $staff_id])) {

            switch ($role) {
                case "Dean":
                    header("Location: ../deans.php?edit=success");
                    exit();
                    break;

                case "HOD":
                    header("Location: ../hods.php?edit=success");
                    exit();
                    break;

                case "Lecturer":
                    header("Location: ../lecturers.php?edit=success");
                    exit();
                    break;
                
                default:
                    # code...
                    break;
            }

        }
        else {

            header("Location: ../edit-staff.php?edit=failed&id=$staff_id&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
            exit();
        }


    }
    
}
else {
    header("Location: ../edit-staff.php");
    exit();
}

