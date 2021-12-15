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
    $school_faculty_name = trim(ucwords(strtolower($_POST['school_faculty_name'])));
    $acronym = trim(strtoupper($_POST['acronym']));
    $school_faculty_id = trim($_POST['school_faculty_id']);

    if(empty($school_faculty_id)) {
        header("Location: ../edit-school-faculty.php?error=empty&school_faculty_name=$school_faculty_name&acronym=$acronym&id=$school_faculty_id");
        exit();
    }

    if(empty($school_faculty_name) || empty($acronym)) {
        header("Location: ../edit-school-faculty.php?error=empty&school_faculty_name=$school_faculty_name&acronym=$acronym&id=$school_faculty_id");
        exit();
    }
    elseif(!preg_match("/^([a-z A-Z \.]+)([0-9]+)?$/", $school_faculty_name)) {
        header("Location: ../edit-school-faculty.php?error=name&school_faculty_name=$school_faculty_name&acronym=$acronym&id=$school_faculty_id");
        exit();
    }

    else {



        // check this schoo/faculty original name and acronym
        $sch_fac_Details = select_all_where("schools_faculties", "school_faculty_id", $school_faculty_id);
        $sch_fac_originalName = $sch_fac_Details[0]['school_faculty_name'];
        $originalAcronym = $sch_fac_Details[0]['acronym'];

        if($sch_fac_originalName != $school_faculty_name) {
             // check if school/faculty name already exists
            $sch_facName_exists = select_all_where("schools_faculties", "school_faculty_name", $school_faculty_name);

            if(count($sch_facName_exists) > 0) {
                header("Location: ../edit-school-faculty.php?error=nameExists&school_faculty_name=$school_faculty_name&acronym=$acronym&id=$school_faculty_id");

                exit();
            }

        }
        if($originalAcronym != $acronym) {

            // check if acronym already exists
            $acronym_exists = select_all_where("schools_faculties", "acronym", $acronym);

            if(count($acronym_exists) > 0) {
                header("Location: ../edit-school-faculty.php?error=acronymExists&school_faculty_name=$school_faculty_name&acronym=$acronym&id=$school_faculty_id");
                exit();
            }
        }





        // prepare data to insert into database
        $sql = "UPDATE schools_faculties SET school_faculty_name=?, acronym=? WHERE school_faculty_id=? LIMIT 1";

        $stmt = $pdo->prepare($sql);
            
        
        if($stmt->execute([$school_faculty_name, $acronym, $school_faculty_id])) {
            header("Location: ../schools-faculties.php?edit=success");
            exit();
        }
        else{
            header("Location: ../edit-school-faculty.php?edit=failed&school_faculty_name=$school_faculty_name&acronym=$acronym&id=$school_faculty_id");
            exit();
        }
    }
    
}
else {
    header("Location: ../edit-school-faculty.php");
    exit();
}

