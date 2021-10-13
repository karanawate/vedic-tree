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
                  <th class="thclass">Student Mobile</th>
                  <th class="thclass">Student Package</th>
                  <th class="thclass">Batch-Name</th>
                  <th class="thclass">Created at</th>
                </tr>
              </thead>
              <tbody>                  
                <?php foreach($student_list_response as $studentlistvisevise) { ?>
                <tr>
                  <?php if($studentlistvisevise > 1) { ?>
                    <td><?php echo $studentlistvisevise['techid']; ?></td>
                    <td><?php echo $studentlistvisevise['studentName']; ?></td>
                    <td><?php echo $studentlistvisevise['studentMobile']; ?></td>
                    <td>Batch <?php echo $studentlistvisevise['packageName']; ?></td>
                    <td><?php echo $studentlistvisevise['batchName']; ?></td>
                    <td><?php echo $studentlistvisevise['createDT']; ?></td>
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