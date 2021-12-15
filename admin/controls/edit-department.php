<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
    exit();
}




// check form submission

if(isset($_POST['edit'])) {

    // get form details
    $department_name = trim(ucwords(strtolower($_POST['department_name'])));
    $school_faculty_id = trim($_POST['school_faculty_id']);
    $department_id = trim($_POST['department_id']);

    if(empty($department_name) || empty($school_faculty_id) || empty($department_id)) {
        header("Location: ../edit-department.php?error=empty&department_name=$department_name&school_faculty_id=$school_faculty_id&id=$department_id");
        exit();
    }
    elseif(!preg_match("/^([a-z A-Z \.]+)([0-9]+)?$/", $department_name)) {
        header("Location: ../edit-department.php?error=name&department_name=$department_name&school_faculty_id=$school_faculty_id&id=$department_id");
        exit();
    }

    else {

        // prepare data to insert into database
        $sql = "UPDATE departments SET department_name=?, school_faculty_id=? WHERE department_id=? LIMIT 1";

        $stmt = $pdo->prepare($sql);
    
        
        if($stmt->execute([$department_name, $school_faculty_id, $department_id])) {
            header("Location: ../departments.php?edit=success");
            exit();
        }
        else{
            header("Location: ../edit-department.php?edit=failed&department_name=$department_name&school_faculty_id=$school_faculty_id&id=$department_id");
            exit();
        }
    }
    
}
else {
    header("Location: ../edit-department.php");
    exit();
}

