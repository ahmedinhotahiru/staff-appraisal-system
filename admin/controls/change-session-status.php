<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
    exit();
}




// check form submission

if(isset($_GET['id'])) {

   
    $fiscal_session_id = trim($_GET['id']);

    if(empty($fiscal_session_id)) {
        header("Location: ../fiscal-sessions.php");
        exit();
    }
    
    else {

        // check original status of session
        $session = select_all_where("fiscal_sessions", "fiscal_session_id", $fiscal_session_id);

        if(count($session) > 0){

            $deadline = $session[0]['deadline'];
            
            if(strtotime($deadline) < strtotime(date("Y-m-d"))) {
                echo "<script>
                        alert('Failed... Deadline is gone. Please change deadline and try again');
                        window.location.href = '../fiscal-sessions.php';
                    </script>";
                exit();
            }

            else {

                
                $status = $session[0]['status'];
                $new_status = 0;

                if($status == 1) {
                    $new_status = 2;
                }
                else {
                    $new_status = 1;
                }

                // write update query

                // prepare data to insert into database
                $sql = "UPDATE fiscal_sessions SET status=? WHERE fiscal_session_id=? LIMIT 1";

                $stmt = $pdo->prepare($sql);
            
                
                if($stmt->execute([$new_status, $fiscal_session_id])) {
                    header("Location: ../fiscal-sessions.php?status=success");
                    exit();
                }
                else{
                    header("Location: ../fiscal-sessions.php?status=failed");
                    exit();
                }

            }
            
        }

        else {
            header("Location: ../fiscal-sessions.php");
            exit();
        }


    }
    
}


else {
    header("Location: ../fiscal-sessions.php");
    exit();
}

