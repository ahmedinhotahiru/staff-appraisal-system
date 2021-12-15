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
        if(delete_by_id("fiscal_sessions", "fiscal_session_id", $id)) {
            header("Location: ../fiscal-sessions.php?delete=success");
            exit();
        }

        else {
            header("Location: ../fiscal-sessions.php?delete=failed");
            exit();

        }
    
    
}
else {
    header("Location: ../fiscal-sessions.php");
    exit();
}

