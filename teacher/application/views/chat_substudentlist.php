<?php $usersession = $this->session->userdata('usersession'); ?>

<!DOCTYPE html>
<html lang="zxx">
<head>
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
                    <h1 style="font-weight: 800;color:darkorange" class="my-4">Student List (Batch Names) chat wise</h1>
                    <div class="batch-name">
                        <?php foreach($chat_studentlist_package as $batch) { ?> 
                        <div class="list-chat-box">
                            <a href="<?php echo site_url("teacher/chat_studentListsub_attdence/".$batch['feesId']); ?>">
                                <div class="batch-details">Vedic Tree <?php  echo $batch['packageName']; ?></div>
                                <div class="count">
                                    <span class="badge badge-danger badge-pill">
                                    <?php 
                                        $countmsg =  getChatData_today_count_of_student_msg($batch['fk_feesId']);
                                        echo $countmsg = count($countmsg);
                                    ?>
                                    </span>
                                </div>
                            </a> 
                        </div>
                        <?php } ?> 
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