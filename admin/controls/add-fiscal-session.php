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
    $fiscal_year = trim($_POST['fiscal_year']);
    $deadline = trim($_POST['deadline']);
    $status = trim($_POST['status']);

    if(empty($fiscal_year) || empty($deadline) || empty($status)) {
        header("Location: ../add-fiscal-session.php?error=empty&fiscal_year=$fiscal_year&deadline=$deadline&status=$status");
        exit();
    }

    else {

        // check if fiscal year already exists
        $fiscal_year_exists = select_all_where("fiscal_sessions", "fiscal_year", $fiscal_year);

        if(count($fiscal_year_exists) > 0) {
            header("Location: ../add-fiscal-session.php?error=yearExists&fiscal_year=$fiscal_year&deadline=$deadline&status=$status");
            exit();
        }
        else {

            // prepare data to insert into database
            $data = array('fiscal_year'=>$fiscal_year,
                            'deadline'=>$deadline,
                            'status'=>$status);

            $table = 'fiscal_sessions';


            if(add($data, $table) == true) {
                header("Location: ../fiscal-sessions.php?add=success");
                exit();
            }
            else{
                header("Location: ../add-fiscal-session.php?add=failed&fiscal_year=$fiscal_year&deadline=$deadline&status=$status");
                exit();
            }

        }

    }
    
}
else {
    header("Location: ../add-fiscal-session.php");
    exit();
}

