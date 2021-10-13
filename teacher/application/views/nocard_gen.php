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
          <div class="">
              <h1 class="my-4" style="font-weight: 800;color:darkorange">Second Report card not generated....</h1>
         
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