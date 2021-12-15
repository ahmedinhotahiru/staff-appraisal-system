<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
    exit();
}




// check form submission

if(isset($_POST['add'])) {

    // get form details
    $department_name = trim(ucwords(strtolower($_POST['department_name'])));
    $school_faculty_id = trim($_POST['school_faculty_id']);

    if(empty($department_name) || empty($school_faculty_id)) {
        header("Location: ../add-department.php?error=empty&department_name=$department_name&school_faculty_id=$school_faculty_id");
        exit();
    }
    elseif(!preg_match("/^([a-z A-Z \.]+)([0-9]+)?$/", $department_name)) {
        header("Location: ../add-department.php?error=name&department_name=$department_name&school_faculty_id=$school_faculty_id");
        exit();
    }

    else {

        // check if name already exists
        $name_exists = select_all_where("departments", "department_name", $department_name);

        if(count($name_exists) > 0) {
            header("Location: ../add-department.php?error=nameExists&department_name=$department_name&school_faculty_id=$school_faculty_id");
            exit();
        }
        else {

            // prepare data to insert into database
            $data = array('department_name'=>$department_name,
            'school_faculty_id'=>$school_faculty_id);

            $table = 'departments';


            if(add($data, $table) == true) {
                header("Location: ../departments.php?add=success");
                exit();
            }
            else{
                header("Location: ../add-department.php?add=failed&department_name=$department_name&school_faculty_id=$school_faculty_id");
                exit();
            }

        }

    }
    
}
else {
    header("Location: ../add-department.php");
    exit();
}

