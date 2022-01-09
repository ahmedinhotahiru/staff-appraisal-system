<?php

include "dbh/dbh.php";


if(isset($_POST['reset-password'])) {

  // get values from the form
  $selector = $_POST['selector'];
  $validator = $_POST['validator'];
  $password = $_POST['password'];
  $password2 = $_POST['password-repeat'];

  if(empty($password) || empty($password2)) {
    header("Location: create-new-password.php?password=empty&selector=$selector&validator=$validator");
  }
  else {
    // check if passwords match
    if($password != $password2) {
      header("Location: create-new-password.php?password=match&selector=$selector&validator=$validator");
      exit();
    }
    else {

      $currentTime = date("U");
      // verify user and token from database, if it hasnt expired
      $sql = "SELECT * FROM resetpassword WHERE pwdResetSelector = ? AND pwdResetExpires >= ?;";
      // query using PDOStatement
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$selector, $currentTime]);
      
      $result = $stmt->fetchAll();
      
      if(count($result) < 1) {
        echo "<script>
                  alert('Invalid or expired tokens. Please go to forgot password and request a new reset link');
                  window.location.href = 'index.php';
              </script>";
          exit();
          die("Invalid or expired tokens");
      }
      else {

        foreach($result as $row) {

          // check if the main token matches the validator
          $tokenEmail = $row['pwdResetEmail'];
          $tokenBin = hex2bin($validator);
          $hashedBinToken = $row['pwdResetToken'];

          if(password_verify($tokenBin, $hashedBinToken) == false) {
            die("You need to resend your request");
            exit();
          }
          
          elseif(password_verify($tokenBin, $hashedBinToken) == true) {

              // user has been verified, so update the password in the database
              $sql = "SELECT * FROM staff WHERE email = ?";
              
              // QUERY USING PDOStatement
              $stmt = $pdo->prepare($sql);
              $stmt->execute([$tokenEmail]);
      
              $result = $stmt->fetchAll();
              
              if(count($result) < 1) {
                  die("User not found");
              }
              else {
                
                foreach($result as $user) {

                  // get the STAFF ID
                  $staff_id = $user['staff_id'];

                  // get the user ID
                  // $userId = $user['id'];

                  // hash new password and update db
                  $newPasswordHashed = password_hash($password, PASSWORD_DEFAULT);
                  $sql = "UPDATE users SET password = ? WHERE staff_id = ? LIMIT 1;";

                  // query using PDO
                  try{
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$newPasswordHashed, $staff_id]);
                  }
                  catch (PDOException $e) {
                    echo "An error occured, try again." . $e->getMessage();
                    exit();
                  }
                          
      

                  // New password has been updated, so make sure to delete the tokens from the database

                  $sql = "DELETE FROM resetpassword WHERE pwdResetEmail = ?";

                  try{
                
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$tokenEmail]);
                    
                    header("Location: index.php?newPwd=updateSuccess");
                  }
                  catch (PDOException $e) {
                    echo "There was an SQL error" . $e->getMessage();
                    exit();
                  }
                  
                }
              }
            }
          }

        }

    }
  }

}
else {
  header("Location: auth-recoverpw.php");
}



