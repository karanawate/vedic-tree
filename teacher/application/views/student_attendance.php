<?php

    $usersession    = $this->session->userdata('usersession');
    
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <style>
    .btn-primary {
      color: #fff;
      background-color: #626ed4;
      border-color: #626ed4;
      height: 33px;
      font-size: 15px;
    }
  </style>
  <!-- Vedic Teacher header files Start -->
  <?php $this->load->view('teacher_header'); ?>
  <!-- Vedic Teacher header files End -->
</head>
<body>
  <!-- Simulate a smartphone / tablet -->
  <?php $this->load->view('mobilemenu'); ?>
  <!-- End smartphone / tablet look -->
  <div class="boxes">
  <?php $this->load->view('teachersidebar'); ?>
  <div class="box11 animated_hero" style="background: #695FFE;">
    <div class="box-inside">
      <div class="desktop-mobile-view">
        <!-- //top header -->
        <?php $this->load->view('teacher_topheader'); ?>
        <!-- //end top header -->
        <button style="background: #695ffe;border-radius: 30px;color: #fff;" onclick="history.back()"><i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Go Back</button>
        <div class="d-flex justify-content-between my-2">
        <h1 style="font-weight: 800;color:darkorange">Student Attendance</h1>
          <div class="create-session-button">
              <a href="<?php echo site_url("teacher/final_studentlist_attedence/".$student_attedence[0]['feesId']); ?>">
              <i class="fa fa-eye mr-2" aria-hidden="true"></i>View Attendance
              </a>
          </div>
        </div>
        
        <form method="POST"  enctype="multipart/form-data"  action="<?php echo base_url('teacher/student_present'); ?>">
          <table id="myTable">
            <thead>
              <tr>
                <th class="thclass">#Id</th>
                <th class="thclass">Student Name</th>
                <th class="thclass">Batch</th>
                <th class="thclass">Status</th>
                <th class="thclass">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($student_attedence as $students){ ?>
                <tr>
                  <input type="hidden" value="<?php echo $students['techid'];  ?>" name="techid[]"/>
                  <input type="hidden" value="<?php echo $students['fk_classId'];  ?>" name="fk_classId[]"/>
                  <input type="hidden" value="<?php echo $students['studentName']; ?>" name="student_name[]"/>
                  <input type="hidden" value="<?php echo $students['fk_batchId']; ?>" name="fk_batchId"/>
                  <input type="hidden" value="<?php echo $students['fk_feesId']; ?>" name="fk_feesId"/>
                  
                  <input type="hidden" value="<?php date_default_timezone_set("Asia/Calcutta");
                  echo date('d-m-Y ');?>"  name="date[]"/>

                  <input type="hidden" value="<?php date_default_timezone_set("Asia/Calcutta");
                  echo date('d-m-Y ');?>"  name="date_current"/>
                  <td><?php echo $students['techid'];  ?></td>
                  <td><?php echo $students['studentName']; ?></td>
                  <td><?php echo $students['batchName']; ?></td>
                  <td>
                  <span class="txt_<?= $students['techid'] ?> attendance text-success">PRESENT</span>
                
                  <input type="hidden" id="remark_id<?= $students['techid'] ?>"  class="txt_<?= $students['techid'] ?>" value="Present" name="remark[]"/>
                  </td>
                  <td>
                      <button class="btn btn-success mdi-present" type="button" id="<?php echo $students['techid']?>" style="height: 33px;width: 88px;font-size: 15px;">PRESENT</button><button style="margin-left:5px;height: 33px;width: 88px;font-size: 15px;"  id="<?php echo $students['techid']?>"   class="btn btn-danger mdi-absent" type="button">ABSENT</button></td> </td>
                </tr>
                <?php }?>
            </tbody>
          </table>
          <button type="submit" class="btn btn-primary" name="submit" value="Update Attendance">Update Attendance</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
 <?php $this->load->view('footd');?>

 <?php if(isset($error)){ ?>
          <script type="text/javascript">
            color = Math.floor((Math.random() * 4) + 1);

              $.notify({
                  icon: "tim-icons icon-bell-55",
                  message: "<?php if(isset($error)){ echo $error['error']; } ?>"

                },{
                    type: type[color],
                    timer: 8000,
                });

                
               setTimeout(function() {
                            window.location.href = '<?php echo base_url('teacher/student_present')?>';
               }, 2000);
             

          </script>



        <?php } ?>


<script>
$(document).ready( function () {
    $('#myTable').DataTable({"pageLength": 25});
    stateSave: true
});
$(".mdi-absent, .mdi-present").click(function(ev){
  let label = 'ABSENT'
  if (ev.target.classList.contains('mdi-present')) {
    label = 'PRESENT'
  }
  $(`.txt_${ev.target.id}`).html(label)
});

$(".mdi-absent, .mdi-present").click(function(ev){
  let label = 'ABSENT'
  if (ev.target.classList.contains('mdi-present')) {
    label = 'PRESENT'
  }
  $(`.txt_${ev.target.id}`).html(label)
});
</script>




<script type="text/javascript">
$(document).ready(function() {
  $(".mdi-absent, .mdi-present").click(function(ev){
    let label = 'ABSENT'
    if (ev.target.classList.contains('mdi-present')) {
      label = 'PRESENT'
    }
    $(`.txt_${ev.target.id}`).html(label)
  })
});
</script>

       
<script type="text/javascript">

var fewSeconds = 5;
$('input[type="submit"]').click(function(){
    debugger;
    // Ajax request
    var btn = $('.mdi-absent');
    btn.prop('disabled', true);
    setTimeout(function(){
        btn.prop('disabled', false);
    }, fewSeconds*1000);
});


$(document).ready(function() {
  $(".mdi-present").click(function(){
    $('.attendance').addClass("text-success");
    $('.attendance').removeClass("text-danger");
    var id  = $(this).attr('id');
    var addlable = $("#remark_id"+id).val("Present");
  })
  $(".mdi-absent").click(function(){
    $('.attendance').addClass("text-danger");
    $('.attendance').removeClass("text-success");
    var id  = $(this).attr('id');
    var addlable = $("#remark_id"+id).val("Absent");
  })
});
</script>
