<!-- Adding all the includes -->
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>

<?php
include('connect.php');
date_default_timezone_set('Asia/Kolkata');
$current_date = date('Y-m-d');
include('pages/allot.php');

?>

<div class="page-wrapper">

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <!-- Schedule quiz tab -->
            <h3 class="text-primary">Schedule Quiz</h3> </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Schedule Quiz</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-8" style="margin-left: 10%;">
                    <div class="card">
                        <div class="card-body">
                            <div class="input-states">
                                <form class="form-horizontal add_allotment_form" method="POST" action="" name="userform" enctype="multipart/form-data">
                                    <!-- Including error message -->
                                    <?php if($errorMsg): ?>
                                    <div class="errorMsg mb-4"><?= $error_html; ?></div>
                                <?php endif; ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <!-- Select Programme -->
                                            <label class="col-sm-3 control-label">Programme</label>
                                            <div class="col-sm-9">
                                                <select type="text" name="class_id" id="class_id" class="form-control"   placeholder="Class" required="">
                                                    <option value="">Programme</option>
                                                    <?php  
                                                    $c1 = "SELECT * FROM `tbl_class`";
                                                    $result = $conn->query($c1);
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $s1 = "SELECT count(*) as qty FROM `tbl_student` WHERE classname='".$row["id"]."'";
                                                        $sr = $conn->query($s1);
                                                        if ($sr->num_rows > 0) {
                                                            $sres = mysqli_fetch_array($sr);
                                                            $qty=$sres['qty'];
                                                        }
                                                        else
                                                        {
                                                            $qty=0;
                                                        }
                                                        ?>
                                                        <option value="<?php echo $row["id"];?>" data-capacity="<?php echo $qty; ?>">
                                                            <?php echo $row['classname'];?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Level</label>
                                            <div class="col-sm-9">
                                                <select type="text" name="level" id="level" class="form-control" placeholder="Level" >
                                                    <!-- Select a level -->
                                                    <option>Level</option>
                                                    <option name="level">Level 100</option>
                                                    <option name="level">Level 200</option>
                                                    <option name="level">Level 300</option>
                                                    <option name="level">Level 400</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <!-- Query course title from db with id -->
                                            <label class="col-sm-3 control-label">Course Title</label>
                                            <div class="col-sm-9">
                                                <select type="text" name="subject_id" id="subject_id" class="form-control"   placeholder="Subject" required="">
                                                    <option value="">Course Title</option>
                                                    <?php  
                                                    $c1 = "SELECT * FROM `tbl_subject`";
                                                    $result = $conn->query($c1);
                                                    while ($row = mysqli_fetch_array($result)) {?>
                                                        <option value="<?php echo $row["id"];?>" style="display: none;" data-id="<?php echo $row["class_id"];?>">
                                                            <?php echo $row['subjectname'];?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Quiz date -->
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label" for="date">Quiz Date:</label>
                                            <div class="col-sm-9">
                                                <input required type="date" name="quiz_date" id="date" class="form-control" placeholder=" Date" required="true" title="Choose your desired date" min="<?php echo date('Y-m-d'); ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Start time -->
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Start Time</label>
                                            <div class="col-sm-9">
                                              <input type="time" name="start_time" id="start_time" class="form-control" placeholder=" Start Time" required="">
                                          </div>
                                      </div>
                                  </div>
                                  <!-- End time -->
                                  <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-3 control-label">End Time</label>
                                        <div class="col-sm-9">
                                          <input type="time" name="end_time" id="end_time" class="form-control" placeholder=" End Time" required="">
                                      </div>
                                  </div>
                              </div>

                            <!-- Select the room -->
                              <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Room</label>
                                    <div class="col-sm-9">
                                        <select type="text" name="room_type_id" id="room_type_id" class="form-control"   placeholder="Room" required="">
                                            <option value="">--Select Room--</option>
                                            <?php  
                                            $c1 = "SELECT * FROM `room_type`";
                                            $result = $conn->query($c1);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $s1 = "SELECT SUM(strenght) as qty FROM `room` WHERE type_id='".$row["id"]."'";
                                                $sr = $conn->query($s1);
                                                if ($sr->num_rows > 0) {
                                                    $sres = mysqli_fetch_array($sr);
                                                    $qty=$sres['qty'];
                                                }
                                                else
                                                {
                                                    $qty=0;
                                                }
                                                ?>
                                                <option value="<?php echo $row["id"];?>" data-capacity="<?php echo $qty; ?>">
                                                    <?php echo $row['roomname'];?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Class Capacity</label>
                                    <div class="col-sm-9">
                                      <input type="text" name="class_capacity" id="class_capacity" class="form-control" placeholder="Class Capacity" >
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Room Type Capacity</label>
                                <div class="col-sm-9">
                                  <input type="text" name="room_capacity" id="room_capacity" class="form-control" placeholder="Room Type Capacity" readonly>
                              </div>
                          </div>
                      </div>
                      <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                  </form>
              </div>
          </div>
      </div>
  </div>

</div>


<?php include('footer.php');?>

<script type="text/javascript">
 $('#class_id').change(function(){
    var class_capacity=$('#class_id').find(':selected').attr('data-capacity');
    $('#class_capacity').val(class_capacity);
    $("#subject_id").val('');
    $("#subject_id").children('option').hide();
    var class_id=$(this).val();
    $("#subject_id").children("option[data-id="+class_id+ "]").show();
    
});
</script>
<script type="text/javascript">

 $('#subject_id').change(function(){
    $("#exam_id").val('');
    $("#exam_id").children('option').hide();
    var subject_id=$(this).val();
    $("#exam_id").children("option[data-id="+subject_id+ "]").show();

    $("#teacher_id").val('');
    $("#teacher_id").children('option').hide();
    $("#teacher_id").children("option[data-id="+subject_id+ "]").show();
    
});
 $('#room_type_id').change(function(){
    var room_capacity=$('#room_type_id').find(':selected').attr('data-capacity');
    $('#room_capacity').val(room_capacity);
    
});
//    $('#btn_save').click(function(){
//     var room_capacity=$('#room_capacity').val();
//     var class_capacity=$('#class_capacity').val();
//     if(parseInt(class_capacity) > parseInt(room_capacity))
//     {
//         alert('Students quantity are greater than available room');
//         return false;
//     }
//     else
//     {
//         return true;
//     }
// });


    let room_capacity = $('#room_capacity').val(),
    class_capacity = $('#class_capacity').val(),
    url = $(this).prop('action'),
    errorMsg = $('.errorMsg'), 
    class_id = 'hello'
    data = {
        'class_id': $('#class_id').val(),
        'level': $('#level').val(),
        'subject_id': $('#subject_id').val(),
        'date': $('#date').val(),
        'start_time': $('#start_time').val(),
        'end_time': $('#end_time').val(),
        'room_type_id': $('#room_type_id').val(),
        'class_capacity': $('#class_capacity').val(),
        'room_capacity': $('#room_capacity').val(),
        'btn_save': $('#btn_save')
    };



// $('.add_allotment_form').submit(function (e) {
//     e.preventDefault();

//     if(parseInt(class_capacity) > parseInt(room_capacity)){
//         errorMsg.html('<p class="alert alert-danger"><span class="fa fa-exclamation-circle"></span> Students quantity is greater than available seats </p>');
//         // scrollToTop();
//         return false;
//     }else{
//         console.log(data)
//         $.ajax({
//             url: url,
//             method: 'POST',
//             data: {class_id:class_id}
//         }).done((response)=>{
//             console.log(response)
//         })
//     }
// })

function scrollToTop() {
    window.scroll({
        top: 0,
        behavior:'smooth'
    });
}
</script>