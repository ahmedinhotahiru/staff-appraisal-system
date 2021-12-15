<?php
session_start();
include "../dbh/dbh.php";

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        header("Location: index.php?error=empty&username=$username");
        exit();
    }
    else {
        

            // check if user exists in db
            $sql = "SELECT * FROM admin WHERE username=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username]);

            $users = $stmt->fetchAll();
            
            if(count($users) < 1) {
                header("Location: index.php?error=user&username=$username");
                exit();
            }
            else {
                
                // verify password
                foreach ($users as $user) {
                    $verified = $user['verified'];
                    $hashedPassword = $user['password'];

                    $verify_password = password_verify($password, $hashedPassword);

                    if($verify_password === false) {
                        header("Location: index.php?error=password&username=$username");
                        exit();
                    }
                    elseif($verify_password === true) {
                        session_start();
                        $_SESSION['admin_id'] = $user['id'];
                        $_SESSION['admin_email'] = $user['email'];

                        header("Location: dashboard.php");
                    }
                }
            }
        
    }
}