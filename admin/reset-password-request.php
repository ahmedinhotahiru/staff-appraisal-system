<?php

include "../dbh/dbh.php";



if(isset($_POST['reset-password'])) {

  // get email entered
  $userEmail = $_POST['email'];  

  if(empty($userEmail)) {
    header("Location: auth-recoverpw.php?error=empty&email=$userEmail");
    exit();
  }

  // user has been verified, so update the password in the database
  $sql = "SELECT * FROM admin WHERE email = ?";
              
  // QUERY USING PDOStatement
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$userEmail]);

  $result = $stmt->fetchAll();
  
  if(count($result) < 1) {
      // die("User not found");
      header("Location: auth-recoverpw.php?error=userNotFound&email=$userEmail");
      exit();
      
  }
  else {







    // create tokens to be sent to email entered
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    // create expiry date of tokens
    $expires = date("U") + 1800;

    // create url to send to the email
    $url = "http://$_SERVER[HTTP_HOST]/admin/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);


    // clear all existing token from the same user before inserting new tokens
    $sql = "DELETE FROM resetpassword WHERE pwdResetEmail = ?; LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userEmail]);

    // hash the main token before inserting into db
    $hashedToken = password_hash($token, PASSWORD_DEFAULT);

    // insert tokens created, url created and user email into the db
    $sql = "INSERT INTO resetpassword (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES(?,?,?,?);";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userEmail, $selector, $hashedToken, $expires]);
  

    // inserted successfully, so now send the email to reset url to the user's email



    // send using PHP mailer
                  
    require "../PHPMailer/PHPMailerAutoload.php";


      
    $to   = $userEmail;
    $from = 'ahmedmailer00@gmail.com';
    $from_name = 'SDD UBIDS STAFF APPRAISAL';
    $subject = 'Reset your password';
    // $base_url = "https://www.thylies.com/";
    $base_url = "http://$_SERVER[HTTP_HOST]";
    $body = "<p>We received a password reset request. The link to reset your password is below. If you did not initiate this request you can ignore this email.</p>";
    $body .= "<p>Here is the link to reset your password: </p>";
    $body .= "<a href='" .$url . "'>" .$url. "</a>";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
                            
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.thylies.com';
    $mail->Port = 465;  
    $mail->Username = 'ahmedmailer00@gmail.com';
    $mail->Password = 'F123456789f';
                            
    $mail->IsHTML(true);
    $mail->WordWrap = 50;
    $mail->From = "ahmedmailer00@gmail.com";
    $mail->FromName = $from_name;
    $mail->Sender = $from;
    $mail->AddReplyTo($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    $resultMail = $mail->Send();

    if (!$resultMail) {
        echo "<script>
                alert('Error... Could not send reset link, please try again');
                window.location.href = 'auth-recoverpw.php';
              </script>"
        ;
        exit();
    } else {
        header("Location: auth-recover-success.php?email=$userEmail");
        exit();
    }


  }














}
else {
  header("Location: auth-recoverpw.php?error=failed&email=$userEmail");
  exit();

}
