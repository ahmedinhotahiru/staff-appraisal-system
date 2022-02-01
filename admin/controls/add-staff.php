<?php

session_start();

include "../../dbh/dbh.php";
include "../../dbh/db_functions.php";


if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: ../index.php?error=login");
    exit();
}




// check form submission

if(isset($_POST['add-staff'])) {

    // get form details
    $title = trim($_POST['title']);
    $staff_name = trim(ucwords(strtolower($_POST['staff_name'])));
    $staff_id_no = trim(strtoupper($_POST['staff_id_no']));
    $position = trim(ucwords(strtolower($_POST['position'])));
    $sch_fac_dept_id = trim($_POST['sch_fac_dept_id']);
    $email = trim($_POST['email']);

    $roleVal = trim($_POST['role']);
    switch ($roleVal) {
        case 'Dean':
            $role = 1;
            break;

        case 'HOD':
            $role = 2;
            break;

        case 'Lecturer':
            $role = 3;
            break;
        
        default:
            echo "<script>
                        alert('Invalid role/staff type... Please select a staff type at the staff menu');
                        window.location.href = '../dashboard.php';
                </script>";
            exit();
            break;
    }

    if(empty($title) || empty($staff_name) || empty($staff_id_no) || empty($position) || empty($role) || empty($email)) {
        header("Location: ../add-staff.php?error=empty&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
        exit();
    }
    if(empty($sch_fac_dept_id)) {
        header("Location: ../add-staff.php?error=emptySchFacDept&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
        exit();
    }
    elseif(!preg_match("/^[a-z A-Z \. -]+$/", $staff_name)) {
        header("Location: ../add-staff.php?error=staffName&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
        exit();
    }

    elseif(!preg_match("/^([a-zA-Z0-9\.-]+)@([a-zA-Z0-9-]+)\.([a-zA-Z]{2,5})(\.[a-zA-Z]{2,5})?$/", $email)) {
        header("Location: ../add-staff.php?error=email&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
        exit();
    }

    else {

        // check if staff id already exists
        $staff_id_exists = select_all_where("staff", "staff_id_no", $staff_id_no);
        
        // check if email already exists
        $email_exists = select_all_where("staff", "email", $email);

        if(count($staff_id_exists) > 0) {
            header("Location: ../add-staff.php?error=staffExists&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
            exit();
        }

        elseif(count($email_exists) > 0) {
            header("Location: ../add-staff.php?error=emailExists&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
            exit();
        }

        else {

            // prepare data to insert into database
            $data = array('staff_id_no'=>$staff_id_no,
                            'title'=>$title,
                            'staff_name'=>$staff_name,
                            'sch_fac_dept_id'=>$sch_fac_dept_id,
                            'role'=>$roleVal,
                            'position'=>$position,
                            'email'=>$email);

            $table = 'staff';


            if(add($data, $table) == true) {

                // check if staff is dean or HOD and create user accounts for them

                if( ($roleVal == 'Dean') || ($roleVal == 'HOD')) {

                    // get staff_id foreign key
                    $staff_ids = select_all_where("staff", "staff_id_no", $staff_id_no);

                    if(count($staff_ids) > 0) {
                        $staff_id = $staff_ids[0]['staff_id'];

                        // generate a unique password
                        $passwordGen = substr(md5(microtime()),rand(0,26),8);
                        $hashedPassword = password_hash($passwordGen, PASSWORD_DEFAULT);

                        // prepare data to insert into database
                        $data = array('staff_id'=>$staff_id,
                                    'staff_id_no'=>$staff_id_no,
                                    'password'=>$hashedPassword);

                        $table = 'users';

                        if(add($data, $table) == true) {

                            // send email
                            // email subject
                            $subject = "Login Credentials for SDD-UBIDS Staff Appraisal System";
                            $body = "<p>A new account has been created for you on the SDD-UBIDS Staff Appraisal System. Below are your login credentials</p><br>";

                            $body .= "Staff ID: $staff_id_no <br>";
                            $body .= "Password: $passwordGen <br><br>";

                            $body .= "Use the link below to login:<br>";
                            $body .= "http://". $_SERVER['HTTP_HOST'] . "/appraisal";



                            if(send_mail($email, $subject, $body)) {

                                // check role and redirect to required page with success message

                                switch ($role) {
                                    case 1:
                                        header("Location: ../deans.php?add=success");
                                        exit();
                                        break;

                                    case 2:
                                        header("Location: ../hods.php?add=success");
                                        exit();
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }

                            }
                            else {
                                switch ($role) {
                                    case 1:
                                        echo "<script>
                                                alert('Dean added successfully, but could not send the email of login credentials. Please note down the login credentials below and manually send to the staff. Staff ID: $staff_id_no, Password: $passwordGen');
                                                window.location.href = '../deans.php?add=success';
                                            </script>";
                                        exit();
                                        break;

                                    case 2:
                                        echo "<script>
                                                alert('HOD added successfully, but could not send the email of login credentials. Please note down the login credentials below and manually send to the staff. Staff ID: $staff_id_no, Password: $passwordGen');
                                                window.location.href = '../hods.php?add=success';
                                            </script>";
                                        exit();
                                        break;
                                    
                                    default:
                                        # code...
                                        break;
                                }
                            }

                            
                            
                        }

                    }
  
                }

                else {
                    header("Location: ../lecturers.php?add=success");
                    exit();
                }
                
            }
            else{
                header("Location: ../add-staff.php?add=failed&role=$role&title=$title&staff_name=$staff_name&staff_id_no=$staff_id_no&position=$position&sch_fac_dept_id=$sch_fac_dept_id&email=$email");
                exit();
            }

        }

    }
    
}
else {
    header("Location: ../add-staff.php");
    exit();
}

