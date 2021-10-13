<?php

    $usersession    = $this->session->userdata('usersession');
    
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
        .form-control {
            width:300px;
        }
        .btn-primary {
            color: #fff;
            background-color: #626ed4;
            border-color: #626ed4;
            height: 35px;
            font-size: 16px;
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
                    <div class="d-flex justify-content-between my-4">
                        <h1 style="font-weight: 800;color:darkorange">Teacher Attendance</h1>
                        <div class="create-session-button">
                            <a href=""><i class="fa fa-eye mr-2" aria-hidden="true"></i>View Attendance</a>
                        </div>
                    </div>
                    <form method="POST" action="<?php echo base_url('teacher/update_attedencenotinsert'); ?>">
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Package Name</label><span style="color:red">*</span>
                                <select type="text" class="form-control" id="" name="fk_planId" required>
                                    <option value="">Select Class</option>
                                    <?php  foreach ($selectedpackage as $package) { ?>     
                                    <option value="<?php echo $package['feesId']; ?>"><?php echo $package['packageName']?></option>
                                    <?php } ?>
                                </select> 
                                <span style="color:red"><?php echo form_error('fk_planId');?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Batch Name</label><span style="color:red">*</span>
                                <select type="text" class="form-control" id="" name="fk_batchId" required>
                                    <option value="">Select Batch</option>
                                    <?php  foreach ($selectedbatch as $batch) { ?>  
                                    <option value="<?php echo $batch['batchId']?>" ><?php echo $batch['batchName']?></option>
                                    <?php } ?> 
                                </select>
                                <span style="color:red"><?php echo form_error('fkpackage_id');?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="username">Class Start Time</label><span style="color:red">*</span>
                                <input type="text" name="start_time" class="form-control bs-timepicker" required>
                                <span style="color:red"><?php echo form_error('start_time');?></span>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="username">Class End Time</label><span style="color:red">*</span>
                                <input type="text" name="end_time" class="form-control bs-timepicker" required >
                                <span style="color:red"><?php echo form_error('end_time');?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="username">Month Name</label><span style="color:red">*</span>
                                <select type="text" class="form-control" id="" name="mId">
                                    <option value="">Select Month</option>
                                    <?php  foreach ($selectedmonth as $month) { ?>  
                                    <option value="<?php echo $month['mId'] ?>" ><?php echo $month['monthName']?></option>
                                    <?php } ?> 
                                </select>       
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="username">Day Name</label><span style="color:red">*</span>
                                <select type="text" class="form-control" id="" name="dId">
                                    <option value="">Select Day</option>
                                    <?php  foreach ($selectedday as $day) { ?>  
                                    <option value="<?php echo $day['dId'] ?>" ><?php echo $day['dayName']?></option>
                                    <?php } ?> 
                                </select>

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
                window.location.href = '<?php echo base_url('teacher/teacher_attedence')?>';
    }, 2000);
    </script>
<?php } ?>