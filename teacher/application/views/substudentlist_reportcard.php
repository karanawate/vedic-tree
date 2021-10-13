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
  <!-- End smartphone / tablet look -->
  <div class="boxes">
    <?php $this->load->view('teachersidebar'); ?>
    <div class="box11 animated_hero" style="background: #695FFE;">
      <div class="box-inside">
        <div class="desktop-mobile-view">
          <!-- //top header -->
          <?php $this->load->view('teacher_topheader'); ?>
          <!-- //end top header -->
          <h1 style="font-weight: 800;color:darkorange" class="my-4">Student Listeeee (Batch Names)</h1>
          <div class="batch-name">
            <?php foreach($student_attedence_batch as $batch) {?> 
            <a href="<?php echo site_url("teacher/studentListsub_attdence_report/".$batch['feesId']); ?>">
              <div class="batch-details">Vedic Tree <?php  echo $batch['packageName']; ?></div>
            </a> 
            <?php } ?> 
          </div>
        </div>
        <div class=""></div>
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