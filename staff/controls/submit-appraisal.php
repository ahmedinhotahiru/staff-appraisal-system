<?php


// check for forum submission
if(isset($_POST['submit_appraisal'])) {


    // get form details
    if(!isset($_POST['fiscal_session_id']) || empty($_POST['fiscal_session_id']) || !isset($_POST['staff_id']) || empty($_POST['staff_id'])) {
        
        echo "<script>
                alert('Please select a fiscal year and staff to appraise');
                window.location.href = '../appraisal-select-session.php';
            </script>";
        exit();
    }
    elseif(!isset($_POST['department_id']) || empty($_POST['department_id'])) {
        echo "<script>
                alert('Staff department not found, please try again');
                window.location.href = '../appraisal-select-session.php';
            </script>";
        exit();
    }

    else {

        // details
        $fiscal_session_id = $_POST['fiscal_session_id'];
        $staff_id = $_POST['staff_id'];
        $department_id = $_POST['department_id'];

        // appraisal details
        $attendance = (int) trim($_POST['attendance']);
        $deadline = (int) trim($_POST['deadline']);
        $student_service = (int) trim($_POST['student_service']);
        $relates_well = (int) trim($_POST['relates_well']);
        $collaboration = (int) trim($_POST['collaboration']);
        $evaluation_methods = (int) trim($_POST['evaluation_methods']);
        $assignments = (int) trim($_POST['assignments']);
        $sufficient_assignments = (int) trim($_POST['sufficient_assignments']);
        $adheres_to_rules = (int) trim($_POST['adheres_to_rules']);
        $marking_of_scripts = (int) trim($_POST['marking_of_scripts']);
        $general_comments = trim($_POST['general_comments']);


        if( empty($attendance) || empty($deadline) || empty($student_service) || empty($relates_well) || empty($collaboration) || empty($evaluation_methods) || empty($assignments) || empty($sufficient_assignments) || empty($adheres_to_rules) || empty($marking_of_scripts) || empty($general_comments) ) {
       
            echo "<script>
                    alert('Please options were not selected. Please select all your options and try again');
                    window.location.href = '../appraisal-select-session.php';
                </script>";
            exit();
        }

        else {

            // compute for total score
            $total_score = $attendance + $deadline + $student_service + $relates_well + $collaboration + $evaluation_methods + $assignments + $sufficient_assignments + $adheres_to_rules + $marking_of_scripts;


            // compute for grand mean
            $mean_1 = ($attendance + $deadline) / 2;
            $mean_2 = ($student_service + $relates_well + $collaboration) / 3;
            $mean_3 = ($evaluation_methods + $assignments + $sufficient_assignments) / 3;
            $mean_4 = ($adheres_to_rules + $marking_of_scripts) / 2;

            $grand_mean_score = ($mean_1 + $mean_2 + $mean_3 + $mean_4) / 4;

            $grand_mean_score_rounded = round($grand_mean_score, 2);


            // determine remarks

            if($grand_mean_score_rounded < 1) {
                $remarks = "Very Poor";
            }
            elseif($grand_mean_score_rounded >=1 && $grand_mean_score_rounded < 2) {
                $remarks = "Poor";
            }
            elseif($grand_mean_score_rounded >=2 && $grand_mean_score_rounded < 3) {
                $remarks = "Average";
            }
            elseif($grand_mean_score_rounded >= 3 && $grand_mean_score_rounded < 4) {
                $remarks = "Good";
            }
            elseif($grand_mean_score_rounded >= 4) {
                $remarks = "Very Good";
            }


            // now prepare data for insertion

            $data = array('staff_id'=>$staff_id,
                            'department_id'=>$department_id,
                            'fiscal_session_id'=>$fiscal_session_id,
                            'total_score'=>$total_score,
                            'grand_mean'=>$grand_mean_score_rounded,
                            'remarks'=>$remarks,
                            'general_comments'=>$general_comments);

            $table = 'appraisal';


            if(add($data, $table) == true) {
                
            }
            else {
                echo "<script>
                        alert('An error occured, could not submit appraisal. Please try again!');
                        window.location.href = '../appraisal-select-session.php';
                    </script>";
                exit();
            }
        }
    }

}

else {
    header("Location: appraisal-select-session.php");
    exit();
}