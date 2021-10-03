<?php

$errorMsg = '';

$success = false;


extract($_POST);

if (isset($btn_save)) {
    $check_alot = $conn->query("SELECT *, SUM(alot_number) AS total FROM allot WHERE room_type_id = '$room_type_id' AND quiz_date = '$quiz_date'") or die(mysqli_error($conn));

    $check_alot_item = mysqli_fetch_assoc($check_alot);

    $current_alot_value = $check_alot_item['total'] - 1;

    $seats_left = $room_capacity - $current_alot_value;

    $condition_met = false;

    if (mysqli_num_rows($check_alot) > 0){

        foreach ($check_alot_item as $item){

            if (($start_time <= $check_alot_item['start_time'] || $start_time >= $check_alot_item['start_time'] && $end_time <= $check_alot_item['end_time'] || $end_time >= $check_alot_item['end_time']) && $seats_left > $class_capacity){

                $condition_met = true;

            }else{

                $condition_met = false;

            }

        }
        if ($condition_met == true){

            $add_allotment = $conn->query("INSERT INTO `allot` (`class_id`,`room_type_id`,`subject_id`,`level`,`quiz_date`,`start_time`,`end_time`, `alot_number`) VALUES ('$class_id','$room_type_id','$subject_id','$level','$quiz_date','$start_time','$end_time', '$class_capacity')");

            $success = true;

            $errorMsg = 'Booking successful';

            $error_html = '<p class="alert alert-success"><span class="fa fa-exclamation-circle"></span> '.$errorMsg.'</p>';

        }else{
            $errorMsg = 'There would not be enough seats available on the set period';

            $error_html = '<p class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> '.$errorMsg.'</p>';

        }
    }

   
   
}


?>
<script type="text/javascript">
    let success = '<?php $success; ?>';
    if(success == true){
        $('.errorMsg').toggleClass('alert alert-success');
    }
</script>