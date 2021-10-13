<?php

    $usersession    = $this->session->userdata('usersession');
    
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
   <style>
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
               <h1 class="my-4" style="font-weight: 800;color:darkorange">Student List</h1>
               <form method="POST" action="<?php echo base_url('teacher/liveedit'); ?>">
                  <input type="hidden" value="<?php echo  $updatedata['0']['id']; ?>" name="live_id" />
                  <input type="hidden" value="<?php echo  $updatedata['0']['teacher_id']; ?>" name="teacher_id" />
                  <div class="row">
                     <div class="form-group col-sm-4">
                        <label>Package Name</label><span style="color:red">*</span>
                        <select class="form-control"  value="echo $updatedata['0']['fk_planId']; ?>" id="" name="fk_planId" required>
                           <option value="<?php echo  $updatedata['0']['fk_planId']; ?>"><?php echo $updatedata['0']['packageName']; ?></option>
                           <?php if($selectedpackage){ 
                              foreach ($selectedpackage as $package) { ?>     
                              <option value="<?php echo $package['feesId'] ?>"><?php echo $package['packageName']?></option>
                           <?php }} ?>
                        </select>
                        <span style="color:red"><?php echo form_error('fk_planId');?></span>
                     </div>
                     <div class="form-group col-sm-4">
                        <label>Batch Name</label><span style="color:red">*</span>
                        <select value="echo $updatedata['0']['batchId']; ?>"  class="form-control" id="" name="fk_batchId" required>
                           <option value="<?php echo  $updatedata['0']['batchId']; ?>"><?php echo $updatedata['0']['batchName']; ?></option>
                           <?php  if($selectedbatch){
                              foreach ($selectedbatch as $batch) {?>  
                              <option value="<?php echo  $batch['batchId'] ?>"><?php echo $batch['batchName']; ?></option>
                           <?php }} ?>
                        </select>
                        <span style="color:red"><?php echo form_error('batchId');?></span>
                     </div>
                     <div class="form-group col-sm-4">
                        <label for="username"> Microsoft Link</label><span style="color:red">*</span>
                        <input type="text" name="microsoft_link" class="form-control" value="<?php echo $updatedata['0']['microsoft_link']; ?>"   id="studentMobile" placeholder="Enter  Microsoft Link">
                        <span style="color:red"><?php echo form_error('microsoft_link');?></span>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-sm-4">
                        <label for="username"> Start Date</label><span style="color:red">*</span>
                        <input type="date" name="start_date" class="form-control" value="<?php echo $updatedata['0']['start_date']; ?>"name="toDT"  id="toDT" >
                        <span style="color:red"><?php echo form_error('start_date');?></span>
                     </div>
                     <div class="form-group col-sm-4">
                        <label for="username">Start Time</label><span style="color:red">*</span>
                        <input type="text" name="start_time" value="<?php echo $updatedata['0']['start_time']; ?>" class="form-control bs-timepicker">
                        <span style="color:red"><?php echo form_error('start_time');?></span>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-sm-4">
                        <label for="username"> To Date</label><span style="color:red">*</span>
                        <input type="date" name="end_date" class="form-control" value="<?php echo $updatedata['0']['end_date']; ?>" name="toDT"  id="toDT" >
                        <span style="color:red"><?php echo form_error('end_date');?></span>
                     </div>
                     <div class="form-group col-sm-4">
                        <label for="username">End Time</label><span style="color:red">*</span>
                        <input type="text" name="end_time"  value="<?php echo $updatedata['0']['end_time']; ?>" class="form-control bs-timepicker">
                        <span style="color:red"><?php echo form_error('end_time');?></span>
                     </div>
                  </div>
                  <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <?php $this->load->view('footd');?>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.js" integrity="sha512-17lKwKi7MLRVxOz4ttjSYkwp92tbZNNr2iFyEd22hSZpQr/OnPopmgH8ayN4kkSqHlqMmefHmQU43sjeJDWGKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js" integrity="sha512-WHnaxy6FscGMvbIB5EgmjW71v5BCQyz5kQTcZ5iMxann3HczLlBHH5PQk7030XmmK5siar66qzY+EJxKHZTPEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   $(document).ready(function(){
         $('.bs-timepicker').timepicker();
   });
</script>
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
   window.location.href = '<?php echo base_url('teacher/viewteacher')?>';
}, 2000);
</script>
<?php } ?> 