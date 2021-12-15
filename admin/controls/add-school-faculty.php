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
    $school_faculty_name = trim(ucwords(strtolower($_POST['school_faculty_name'])));
    $acronym = trim(strtoupper($_POST['acronym']));
    

    if(empty($school_faculty_name) || empty($acronym)) {
        header("Location: ../add-school-faculty.php?error=empty&school_faculty_name=$school_faculty_name&acronym=$acronym");
        exit();
    }
    elseif(!preg_match("/^([a-z A-Z \.]+)([0-9]+)?$/", $school_faculty_name)) {
        header("Location: ../add-school-faculty.php?error=name&school_faculty_name=$school_faculty_name&acronym=$acronym");
        exit();
    }

    else {

        // check if name or already exists
        $name_exists = select_all_where('schools_faculties', 'school_faculty_name', $school_faculty_name);
        $acronym_exists = select_all_where('schools_faculties', 'acronym', $acronym);

        if(count($name_exists) > 0) {
            header("Location: ../add-school-faculty.php?error=nameExists&school_faculty_name=$school_faculty_name&acronym=$acronym");
            exit();
        }

        elseif(count($acronym_exists) > 0) {
            header("Location: ../add-school-faculty.php?error=acronymExists&school_faculty_name=$school_faculty_name&acronym=$acronym");
            exit();
        }

        else {

            // prepare data to insert into database
            $data = array('school_faculty_name'=>$school_faculty_name,
            'acronym'=>$acronym);

            $table = 'schools_faculties';


            if(add($data, $table) == true) {
                header("Location: ../schools-faculties.php?add=success");
                exit();
            }
            else{
                header("Location: ../add-school-faculty.php?add=failed&school_faculty_name=$school_faculty_name&acronym=$acronym");
                exit();
            }

        }

        
    }
    
}
else {
    header("Location: ../add-school-faculty.php");
    exit();
}

