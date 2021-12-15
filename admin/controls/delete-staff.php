<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
}




// check form submission

if(!empty($_GET['id']) || !empty($_GET['role'])) {

    $id = trim($_GET['id']);
    $role = trim($_GET['role']);

    if( (!preg_match("/^[0-9]+$/", $role)) || ($role < 1) || ($role > 2)) {
        header("Location: ../dashboard.php");
        exit();
    }

    else {

        // delete
        if(delete_by_id("staff", "staff_id", $id)) {

            // check if staff is an HOD OR DEAN and delete user account
            if($role == 1) {
                delete_by_id("users", "staff_id", $id);
                header("Location: ../deans.php?delete=success");
                exit();
            }
            elseif($role == 2) {
                delete_by_id("users", "staff_id", $id);
                header("Location: ../hods.php?delete=success");
                exit();
            }
            else {
                header("Location: ../lecturers.php?delete=success");
                exit();
            }
            
        }

        else {

            if($role == 1) {
                header("Location: ../deans.php?delete=failed");
                exit();
            }
            elseif($role == 2) {
                header("Location: ../hods.php?delete=failed");
                exit();
            }
            else {
                header("Location: ../lecturers.php?delete=failed");
                exit();
            }
            
        }
    }
    

    
}
else {
    echo "<script>
            alert('Invalid Staff ID');
            window.location.href = '../dashboard.php';
        </script>";
    exit();
}

