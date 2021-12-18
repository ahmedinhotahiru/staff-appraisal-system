<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['appraisal_user_id']) || empty($_SESSION['appraisal_user_id']) || !isset($_SESSION['appraisal_staff_id']) || empty($_SESSION['appraisal_staff_id'])) {

    header("Location: ../../index.php?error=login");
    exit();
}




// check form submission

if(isset($_POST['update'])) {

    // get form details
    $staff_id = $_SESSION['appraisal_staff_id'];

    $staff_id_no = trim(strtoupper($_POST['staff_id_no']));
    $email = trim(strtolower($_POST['email']));
    $title = trim($_POST['title']);
    $staff_name = trim(ucwords(strtolower($_POST['staff_name'])));
    $position = trim(ucwords(strtolower($_POST['position'])));


    if(empty($staff_id_no) || empty($email) || empty($title) || empty($staff_name) || empty($position)) {
        header("Location: ../profile.php?error=empty&staff_id_no=$staff_id_no&email=$email&title=$title&staff_name=$staff_name&position=$position");
        exit();
    }

    elseif(!preg_match("/^[a-z A-Z \.]+$/", $staff_name)) {
        header("Location: ../profile.php?error=staffName&staff_id_no=$staff_id_no&email=$email&title=$title&staff_name=$staff_name&position=$position");
        exit();
    }

    elseif(!preg_match("/^([a-zA-Z0-9\.-]+)@([a-zA-Z0-9-]+)\.([a-zA-Z]{2,5})(\.[a-zA-Z]{2,5})?$/", $email)) {
        header("Location: ../profile.php?error=email&staff_id_no=$staff_id_no&email=$email&title=$title&staff_name=$staff_name&position=$position");
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
                header("Location: ../profile.php?error=staffExists&staff_id_no=$staff_id_no&email=$email&title=$title&staff_name=$staff_name&position=$position");
                exit();
           }

       }
       if($userEmail != $email) {

           // check if email already exists
           $email_exists = select_all_where("staff", "email", $email);

           if(count($email_exists) > 0) {
                header("Location: ../profile.php?error=emailExists&staff_id_no=$staff_id_no&email=$email&title=$title&staff_name=$staff_name&position=$position");
                exit();
           }
       }








        // update details
        $sql = "UPDATE staff SET staff_id_no=?, title=?, staff_name=?, position=?, email=? WHERE staff_id=?";

        // pdo query
        $stmt = $pdo->prepare($sql);

        if($stmt->execute([$staff_id_no, $title, $staff_name, $position, $email, $staff_id])) {

            header("Location: ../profile.php?edit=success");
            exit();
        }
        else {

            header("Location: ../profile.php?edit=failed&staff_id_no=$staff_id_no&email=$email&title=$title&staff_name=$staff_name&position=$position");

            exit();
        }
    }
    
}
else {
    header("Location: ../profile.php");
    exit();
}

