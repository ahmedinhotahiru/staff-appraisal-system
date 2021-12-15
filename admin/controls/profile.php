<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
    exit();
}




// check form submission

if(isset($_POST['update'])) {

    // get form details
    $username = trim(strtolower($_POST['username']));
    $email = trim(strtolower($_POST['email']));

    if(empty($username) || empty($email)) {
        header("Location: ../profile.php?error=empty&username=$username&email=$email");
        exit();
    }
    elseif(!preg_match("/^([a-zA-Z0-9\.-]+)@([a-zA-Z0-9-]+)\.([a-zA-Z]{2,5})(\.[a-zA-Z]{2,5})?$/", $email)) {
        header("Location: ../profile.php?error=email&username=$username&email=$email");
        exit();
    }

    else {

        // prepare data to insert into database
        $sql = "UPDATE admin SET username=?, email=? WHERE id=? LIMIT 1";

        $stmt = $pdo->prepare($sql);
    
        
        if($stmt->execute([$username, $email, $_SESSION['admin_id']])) {
            header("Location: ../profile.php?edit=success");
            exit();
        }
        else{
            header("Location: ../profile.php?edit=failed&username=$username&email=$email");
            exit();
        }
    }
    
}
else {
    header("Location: ../profile.php");
    exit();
}

