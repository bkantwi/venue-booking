<?php

$errorMsg = '';

$success = false;


extract($_POST);

if (isset($btn_save)) {
    $check_alot = $conn->query("SELECT SUM(alot_number) AS total FROM allot WHERE room_type_id = '$room_type_id' AND quiz_date = '$quiz_date' AND start_time = '$start_time' ") or die(mysqli_error($conn));

    $check_alot_item = mysqli_fetch_assoc($check_alot);

    $current_alot_value = $check_alot_item['total'];

    $seats_left = $room_capacity - $current_alot_value;

    if ($seats_left > $class_capacity AND $start_time == $start_time) {

        $add_allotment = $conn->query("INSERT INTO `allot` (`class_id`,`room_type_id`,`subject_id`,`level`,`quiz_date`,`start_time`,`end_time`, `alot_number`) VALUES ('$class_id','$room_type_id','$subject_id','$level','$quiz_date','$start_time','$end_time', '$class_capacity')");

        $success = true;

        $errorMsg = 'Booking successful';

        $error_html = '<p class="alert alert-success"><span class="fa fa-exclamation-circle"></span> '.$errorMsg.'</p>';
    }
    else{
        $errorMsg = 'There would not be enough seats available on the set period';

        $error_html = '<p class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> '.$errorMsg.'</p>';
    }
   
   
}


?>
<script type="text/javascript">
    let success = '<?php $success; ?>';
    if(success == true){
        $('.errorMsg').toggleClass('alert alert-success');
    }
</script>