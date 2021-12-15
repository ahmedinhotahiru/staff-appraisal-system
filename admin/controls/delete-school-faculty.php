<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
}




// check form submission

if(!empty($_GET['id'])) {

    $id = trim($_GET['id']);

   
   

        // delete
        if(delete_by_id("schools_faculties", "school_faculty_id", $id)) {

            // also delete all departments under faculty/school
            if(delete_by_id_all("departments", "school_faculty_id", $id)) {
                header("Location: ../schools-faculties.php?delete=success");
                exit();
            }
            
        }

        else {
            header("Location: ../schools-faculties.php?delete=failed");
            exit();

        }
    
    
}
else {
    header("Location: ../schools-faculties.php");
    exit();
}

