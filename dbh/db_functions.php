<?php


date_default_timezone_set('Africa/Accra');
$current_date = date('Y-m-d');




function no_of_rows($table) {

    global $pdo;

    $sql = "SELECT * FROM $table";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $no_of_rows = count($stmt->fetchAll());

    return $no_of_rows;
}



function no_of_rows_where($table, $where_field, $where_keyword) {

    global $pdo;


    $sql = "SELECT * FROM $table WHERE $where_field = ?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $no_of_rows = count($stmt->fetchAll());

    return $no_of_rows;
}



function no_of_rows_where_and($table, $where_field, $where_keyword, $where_field_2, $where_keyword_2) {

    global $pdo;


    $sql = "SELECT * FROM $table WHERE $where_field = ? AND $where_field_2 = ?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword, $where_keyword_2]);
    $no_of_rows = count($stmt->fetchAll());

    return $no_of_rows;
}



function select_all($table) {

    global $pdo;


    $sql = "SELECT * FROM $table";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    return $result;
}



function select_where($table, $where_field, $where_keyword) {

    global $pdo;


    $sql = "SELECT * FROM $table WHERE $where_field = ?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $result = $stmt->fetchAll();

    return $result;
}





function select_by_id($table_name, $key_name, $select_id) {
    global $pdo;
    

    $sql = "SELECT * FROM $table_name WHERE $key_name = ?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$select_id]);
    $result = $stmt->fetchAll();
    

    return $result;
}



function select_all_where($table_name, $where_field, $where_keyword) {
    global $pdo;
    

    $sql = "SELECT * FROM $table_name WHERE $where_field = ?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $result = $stmt->fetchAll();
    

    return $result;
}



function select_all_where_and($table_name, $where_field, $where_keyword, $where_field_2, $where_keyword_2) {
    global $pdo;
    

    $sql = "SELECT * FROM $table_name WHERE $where_field = ? AND $where_field_2 = ?";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword, $where_keyword_2]);
    $result = $stmt->fetchAll();
    

    return $result;
}



function select_all_where_desc_id($table_name, $where_field, $where_keyword, $primary_key) {
    global $pdo;
    

    $sql = "SELECT * FROM $table_name WHERE $where_field = ? ORDER BY $primary_key desc";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $result = $stmt->fetchAll();
    

    return $result;
}



function select_all_where_asc_id($table_name, $where_field, $where_keyword, $primary_key) {
    global $pdo;
    

    $sql = "SELECT * FROM $table_name WHERE $where_field = ? ORDER BY $primary_key asc";

    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$where_keyword]);
    $result = $stmt->fetchAll();
    

    return $result;
}


function select_where_limit($table, $where_field, $where_keyword, $limit) {
    global $pdo;
    $table_name = mysqli_real_escape_string($pdo, $table);
    $where_field = mysqli_real_escape_string($pdo, $where_field);
    $where_keyword = mysqli_real_escape_string($pdo, $where_keyword);
    $limit = mysqli_real_escape_string($pdo, $limit);

    $sql = "SELECT * FROM $table_name WHERE $where_field = '$where_keyword' LIMIT $limit";
    $result = mysqli_query($pdo, $sql);
    

    return $result;
}






function select_all_asc_id($table, $primary_key) {
    global $pdo;
    


    $sql = "SELECT * FROM $table ORDER BY $primary_key asc";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
    

    return $result;
}



function select_all_desc_id($table, $primary_key) {
    global $pdo;
    


    $sql = "SELECT * FROM $table ORDER BY $primary_key desc";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
    

    return $result;
}




function select_all_desc_id_limit($table, $primary_key, $limit) {
    global $pdo;
    


    $sql = "SELECT * FROM $table ORDER BY $primary_key desc LIMIT $limit";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
    

    return $result;
}



function department_name($department_id) {
    global $pdo;
    


    $sql = "SELECT * FROM departments WHERE department_id=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$department_id]);

    $result = $stmt->fetchAll();
    

    return $result[0]['department_name'];
}




function department_school_faculty_id($department_id) {
    global $pdo;
    


    $sql = "SELECT * FROM departments WHERE department_id=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$department_id]);

    $result = $stmt->fetchAll();
    

    return $result[0]['school_faculty_id'];
}



function staff_department_id($staff_id) {
    global $pdo;
    


    $sql = "SELECT * FROM staff WHERE staff_id=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$staff_id]);

    $result = $stmt->fetchAll();
    

    return $result[0]['sch_fac_dept_id'];
}



function school_faculty_name($school_faculty_id) {
    global $pdo;
    


    $sql = "SELECT * FROM schools_faculties WHERE school_faculty_id=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$school_faculty_id]);

    $result = $stmt->fetchAll();
    

    return $result[0]['school_faculty_name'];
}



function school_faculty_acronym($school_faculty_id) {
    global $pdo;
    


    $sql = "SELECT * FROM schools_faculties WHERE school_faculty_id=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$school_faculty_id]);

    $result = $stmt->fetchAll();
    

    return $result[0]['acronym'];
}



function fiscal_year($fiscal_session_id) {
    global $pdo;
    


    $sql = "SELECT * FROM fiscal_sessions WHERE fiscal_session_id=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fiscal_session_id]);

    $result = $stmt->fetchAll();
    
    if(count($result) > 0) {
        return $result[0]['fiscal_year'];
    }
    
}






function staff_is_appraised($staff_id, $fiscal_session_id) {
    global $pdo;
    


    $sql = "SELECT * FROM appraisal WHERE staff_id = ? AND fiscal_session_id=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$staff_id, $fiscal_session_id]);

    $result = $stmt->fetchAll();
    
    if(count($result) > 0) {
        return true;
    }
    else {
        return false;
    }
    
}









function analysis_results($grand_means_array) {
    global $pdo;


    // we calculate number of poor, good and average and return assoc array

    $no_of_poor = 0;
    $no_of_good = 0;
    $no_of_avg = 0;

    if(!empty($grand_means_array)) {

        foreach ($grand_means_array as $grand_mean) {
            
            switch ($grand_mean) {
                case $grand_mean >= 3:
                    $no_of_good++;
                    break;

                case $grand_mean < 2:
                    $no_of_poor++;
                    break;
                
                default:
                    $no_of_avg++;
                    break;
            }
        }

        // return array (avg, good, poor) as order
        return array($no_of_avg, $no_of_good, $no_of_poor);
    }
    else {
        return array(0, 0, 0);
    }
    
}



function analysis_percentages($analysis_results) {
    global $pdo;

    // get numbers of each performances
    $average_results = $analysis_results[0];
    $good_results = $analysis_results[1];
    $poor_results = $analysis_results[2];

    $total_results = $average_results + $good_results + $poor_results;

    if($total_results > 0) {

        // compute percentages
        $percentage_average = ($average_results / $total_results) * 100;
        $percentage_good = ($good_results / $total_results) * 100;
        $percentage_poor = ($poor_results / $total_results) * 100;

        $percentage_average_round = round($percentage_average, 1);
        $percentage_good_round = round($percentage_good, 1);
        $percentage_poor_round = round($percentage_poor, 1);

        // return array($percentage_average, $percentage_good, $percentage_poor);
        return array($percentage_average_round, $percentage_good_round, $percentage_poor_round);
    }
    else {
        return array(0, 0, 0);
    }
}








function delete_by_id($table, $key_name, $id) {
    global $pdo;

    $sql = "DELETE FROM $table WHERE $key_name=? LIMIT 1";

    // PDO Query
    $stmt = $pdo->prepare($sql);
    
    
    if($stmt->execute([$id])){
        return true;
    }
    else {
        return false;
    }

}



function delete_by_id_all($table, $key_name, $id) {
    global $pdo;

    $sql = "DELETE FROM $table WHERE $key_name=?";

    // PDO Query
    $stmt = $pdo->prepare($sql);
    
    
    if($stmt->execute([$id])){
        return true;
    }
    else {
        return false;
    }

}



function send_mail($to, $subject, $body) {

    // send using PHP mailer
                
    require "../../PHPMailer/PHPMailerAutoload.php";
               


   
    
    $from = 'info@thylies.com';
    $from_name = 'Thylies, Inc';
    

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
                            
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.thylies.com';
    $mail->Port = 465;  
    $mail->Username = 'info@thylies.com';
    $mail->Password = 'Un0549f7d';
                            
    $mail->IsHTML(true);
    $mail->WordWrap = 50;
    $mail->From = "info@thylies.com";
    $mail->FromName = $from_name;
    $mail->Sender = $from;
    $mail->AddReplyTo($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    $resultMail = $mail->Send();

    if (!$resultMail) {
        echo "<script>alert('Please try sending email Later, Error Occured while Processing...');</script>";
    } else {
        return true;
    }
}






function add($data, $table) {

    global $pdo;
    $data_len = count($data);
    $placeholders = array();

    for ($i=0; $i < $data_len; $i++) { 
        $placeholders[$i] = "?";
    }


    $sql = 'INSERT INTO ' .$table. '('. implode(", ", array_keys($data)) .') VALUES (' . implode(", ", array_values($placeholders)) .')';

    
    

    // pdo query     

    try {
        $stmt = $pdo->prepare($sql);
        // $stmt->execute(array_values($data));

        if($stmt->execute(array_values($data))) {
            return true;
        }
        else {
            return false;
        }
        
        
        // return true;
        
    } catch (PDOException $e) {
        return false;
    }

}



function upload_file($file, $file_folder) {

    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    // Specify allowed file types
    $allowed_type = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt');

    // Get file type of uploaded file
    $file_ext_extract = explode('.', $file_name);
    $file_new_name = $file_ext_extract[0];
    $file_ext = strtolower(end($file_ext_extract));


    $error = 0;

    // Check if file extension is allowed
    if(!in_array($file_ext, $allowed_type)){
        $error = 1;
    }
    // Check if file size is allowed (not more than 50mb)
    elseif($file_size > 50000000){
        $error = 2;  
    }
    // Check if there was an error
    elseif($file_error > 0){
        $error = 3;              
    }
    // Give unique new name to file (prefix with file extension)
    else{
        
        unset($file_ext_extract[count($file_ext_extract) - 1]);
        $file_name_only = implode("", $file_ext_extract);
        $file_new_name = $file_name_only . '_'. uniqid('', true) .'.' .$file_ext;
        
        // Specify new location to store file in
        $file_dir = "../$file_folder/$file_new_name";

        // move_uploaded_file($file_tmp_name, $file_dir)

        // Move file to upload folder
        if(move_uploaded_file($file_tmp_name, $file_dir)) {
            unset($_SESSION['doc_filename']);
            $_SESSION['doc_filename'] = $file_new_name;
        }
    }

    return $error;

}



function upload_img($file, $file_folder) {

    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    // Specify allowed file types
    $allowed_type = array('jpg', 'jpeg', 'png');

    // Get file type of uploaded file
    $file_ext_extract = explode('.', $file_name);
    $file_new_name = $file_ext_extract[0];
    $file_ext = strtolower(end($file_ext_extract));


    $error = 0;

    // Check if file extension is allowed
    if(!in_array($file_ext, $allowed_type)){
        $error = 1;
    }
    // Check if file size is allowed (not more than 50mb)
    elseif($file_size > 50000000){
        $error = 2;  
    }
    // Check if there was an error
    elseif($file_error > 0){
        $error = 3;              
    }
    // Give unique new name to file (prefix with file extension)
    else{
        
        unset($file_ext_extract[count($file_ext_extract) - 1]);
        $file_name_only = implode("", $file_ext_extract);
        $file_new_name = $file_name_only . '_'. uniqid('', true) .'.' .$file_ext;
        
        // Specify new location to store file in
        $file_dir = "../$file_folder/$file_new_name";

        // move_uploaded_file($file_tmp_name, $file_dir)

        // Move file to upload folder
        if(move_uploaded_file($file_tmp_name, $file_dir)) {
            unset($_SESSION['doc_filename']);
            $_SESSION['doc_filename'] = $file_new_name;
        }
    }

    return $error;

}





function generate_booking_id() {

    global $pdo;

    $generated_id = strtoupper(date("Md") . "-" . substr(md5(microtime()),rand(0,26),5));

    $generated_id_search = $generated_id;


    $sql = "SELECT * FROM bookings WHERE booking_ref_id=?";
    
    // pdo query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$generated_id_search]);

    $result = count($stmt->fetchAll());

    while($result > 0) {
        $generated_id = strtoupper(date("Md") . "-" . substr(md5(microtime()),rand(0,26),5));
        $generated_id_search = $generated_id;

        $sql = "SELECT * FROM bookings WHERE booking_ref_id=?";
        
        // pdo query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$generated_id_search]);

        $result = count($stmt->fetchAll());
    }

    // generate unique booking id
    return $generated_id;
}













