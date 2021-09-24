<?php

$errorMsg = '';

$success = false;


extract($_POST);

if (isset($btn_save)) {
    $init = "SELECT SUM(alot_number) AS total from allot WHERE room_type_id = '$room_type_id' AND quiz_date = '$quiz_date'  AND start_time = '$start_time' AND end_time = '$end_time'";
    // $check_alot = $conn->query("SELECT SUM(alot_number) AS total FROM allot WHERE room_type_id = '$room_type_id' AND quiz_date = '$quiz_date' AND start_time = '$start_time' ") or die(mysqli_error($conn));

    //check times

//     "SELECT * FROM logs WHERE date BETWEEN '" . $from_date . "' AND  '" . $to_date . "'
// ORDER by id DESC"
// new update
// new
// new

    // $check_time = $init." AND start_time BETWEEN '$start_time' AND  '$end_time' AND end_time BETWEEN '$start_time' AND  '$end_time'";

    $check_time = $init . " AND start_time = '$start_time' AND end_time = '$end_time'";
    
    $query_string = $conn->query($init);

    $check_alot_item = mysqli_fetch_assoc($query_string);

    $current_alot_value = $check_alot_item['total'];
    die(var_dump($check_alot_item));
    $seats_left = $room_capacity - $current_alot_value;
    
       if ($seats_left > $class_capacity) {
           $success = false;

           $errorMsg = $seats_left;

           $error_html = '<p class="alert alert-success"><span class="fa fa-exclamation-circle"></span> '.$errorMsg.'</p>';

       }else{
        $success = false;

        $errorMsg = $seats_left;

        $error_html = '<p class="alert alert-success"><span class="fa fa-exclamation-circle"></span> '.$errorMsg.'</p>';

       }
//    $check_alot_item = mysqli_fetch_assoc($check_alot);

//    $current_alot_value = $check_alot_item['total'];

//    $seats_left = $room_capacity - $current_alot_value;

//    if ($seats_left > $class_capacity) {

//        $add_allotment = $conn->query("INSERT INTO `allot` (`class_id`,`room_type_id`,`subject_id`,`level`,`quiz_date`,`start_time`,`end_time`, `alot_number`) VALUES ('$class_id','$room_type_id','$subject_id','$level','$quiz_date','$start_time','$end_time', '$class_capacity')");



//        // $conn->query("INSERT INTO 'allot_student' ('allot_id', 'exam_id', 'exam_date', 'start_time', 'end_time', 'room_id', 'student_id', 'stud_id') VALUES ('$last_id', '$exam_id', '$quiz_date', '$start_time', '$end_time', '$room_type_id', '')");

//        $success = true;

//        $errorMsg = 'Booking successful';

//        $error_html = '<p class="alert alert-success"><span class="fa fa-exclamation-circle"></span> '.$errorMsg.'</p>';


//    }else{
//         $errorMsg = 'There would not be enough seats available on the set period';

//         $error_html = '<p class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> '.$errorMsg.'</p>';
//    }
   
   
}


?>
<script type="text/javascript">
    let success = '<?= $success; ?>';
    if(success == true){
        $('.errorMsg').toggleClass('alert alert-success');
    }
</script>