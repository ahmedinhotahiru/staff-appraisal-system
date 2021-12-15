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
    $fiscal_session_id = trim($_POST['fiscal_session_id']);
    $fiscal_year = trim($_POST['fiscal_year']);
    $deadline = trim($_POST['deadline']);

    if(empty($fiscal_year) || empty($deadline)) {
        header("Location: ../edit-fiscal-session.php?error=empty&id=$fiscal_session_id&fiscal_year=$fiscal_year&deadline=$deadline");
        exit();
    }

    else {

        // check this sessions original fiscal year
        $sessionDetails = select_all_where("fiscal_sessions", "fiscal_session_id", $fiscal_session_id);
        $session_fiscal_year = $sessionDetails[0]['fiscal_year'];

        if($session_fiscal_year != $fiscal_year) {
             // check if fiscal year already exists
            $fiscal_year_exists = select_all_where("fiscal_sessions", "fiscal_year", $fiscal_year);

            if(count($fiscal_year_exists) > 0) {
                header("Location: ../edit-fiscal-session.php?error=yearExists&id=$fiscal_session_id&fiscal_year=$fiscal_year&deadline=$deadline");
                exit();
            }

        }
        

        // prepare data to insert into database
        $sql = "UPDATE fiscal_sessions SET fiscal_year=?, deadline=? WHERE fiscal_session_id=? LIMIT 1";

        $stmt = $pdo->prepare($sql);
    
        
        if($stmt->execute([$fiscal_year, $deadline, $fiscal_session_id])) {
            header("Location: ../fiscal-sessions.php?edit=success");
            exit();
        }
        else{
            header("Location: ../edit-fiscal-session.php?edit=failed&id=$fiscal_session_id&fiscal_year=$fiscal_year&deadline=$deadline");
            exit();
        }
    }
    
}
else {
    header("Location: ../edit-fiscal-session.php");
    exit();
}

