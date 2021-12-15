<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
    exit();
}




// check form submission

if(isset($_POST['change_password'])) {

    // get form details
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $new_password_confirm = $_POST['new_password_confirm'];

    if(empty($old_password) || empty($new_password) || empty($new_password_confirm)) {
        header("Location: ../change-password.php?error=empty");
        exit();
    }
    elseif($new_password != $new_password_confirm) {
        header("Location: ../change-password.php?error=pwdMatch");
        exit();
    }

    elseif(strlen($new_password) < 8) {
        header("Location: ../change-password.php?error=pwdLength");
        exit();
    }

    else {

        // check if old password is correct

        $user = select_all_where("admin", "id", $_SESSION['admin_id']);

        if(count($user) > 0) {

            $user_password = $user[0]['password'];

            if(password_verify($old_password, $user_password) == false) {
                header("Location: ../change-password.php?error=oldPwd");
                exit();
            }

            elseif(password_verify($old_password, $user_password) == true) {

                // hash new password
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

                // UPDATE PASSWORD
                $sql = "UPDATE admin SET password = ? WHERE id = ? LIMIT 1";

                // pdo query
                $stmt = $pdo->prepare($sql);
                
                if($stmt->execute([$hashedPassword, $_SESSION['admin_id']])) {
                    header("Location: ../change-password.php?update=success");
                    exit();
                }

                else {
                    header("Location: ../change-password.php?update=failed");
                    exit();
                }

            }

        }

        else {
            header("Location: ../change-password.php?error=user");
            exit();
        }

    }
    
}
else {
    header("Location: ../change-password.php");
    exit();
}

