<?php
  $usersession    = $this->session->userdata('usersession');
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <style>
  </style>
  <!-- Vedic Main header files Start -->
  <?php $this->load->view('teacher_header'); ?>
  <!-- Vedic Main header files End -->
</head>
<body>
  <!-- Simulate a smartphone / tablet -->
  <?php $this->load->view('mobilemenu'); ?>
  <!-- Top Navigation Menu -->
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
          <h1 class="my-4" style="font-weight: 800;color:darkorange">Package Name Attendance</h1>
          <div class="">
            <table id="myTable">
              <thead>
                <tr>
                  <th class="thclass">#Id</th>
                  <th class="thclass">Student Name</th>
                  <th class="thclass">E-email</th>
                  <th class="thclass">Operation</th>
                  <th class="thclass"></th>
                </tr>
              </thead>
              <tbody>                  
                <?php  foreach($first_report as $studentlistvisevise) { ?>
                <tr>
                  <?php if($studentlistvisevise > 1) { ?>
                    <td><?php echo $studentlistvisevise['studId']; ?></td>
                    <td><?php echo $studentlistvisevise['studentName']; ?></td>
                    <td><?php echo $studentlistvisevise['studentEmail']; ?></td>
                   <td>
                     
                       <a class="btn btn-primary btn-sm"  href="<?php echo site_url("teacher/children_report_view/".$studentlistvisevise['studId']); ?>" />      Sem-1</a>
                       <a class="btn btn-primary btn-sm"  href="<?php echo site_url("teacher/children_report_view_second/".$studentlistvisevise['studId']); ?>" />Sem-2</a>
                       <!--<input type="submit" value="Final Sem" class="btn btn-primary btn-sm " />-->
                    </td>
                   <td>
                        <a class="btn btn-danger btn-sm"  href="<?php echo site_url("teacher/children_report_deletesemone/".$studentlistvisevise['studId']."/".$feesIds['feesId']); ?>" />Delete-Sem-1</a>
                        <a class="btn btn-danger btn-sm"  href="<?php echo site_url("teacher/children_report_deletesemtwo/".$studentlistvisevise['studId']."/".$feesIds['feesId']); ?>" />Delete-Sem-2</a>
                    </td>
                  <?php } else {
                    echo "No data"; 
                  } ?>
                </tr>
                <?php } ?>
              </tbody>
            </table>
         
          </div>
        </div>
      </div>
    </div>
   
  </div>
</body>
</html>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
    stateSave: true
});
</script>