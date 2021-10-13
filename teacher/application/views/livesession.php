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
       .btn_view{
          background-color: #626ed4;
            border: none;
            color: white;
            padding: 11px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            border-radius: 10px;
       }
        .myduration
        {
            margin-right: 15px;
        }
    </style>
    <!-- Vedic Teacher header files Start -->
    <?php $this->load->view('teacher_header'); ?>
    <!-- Vedic Teacher header files End -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
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
                   <a class="btn_view" href="<?php echo site_url('teacher/viewteacher') ?>">View-Livession</a>
                    <h1 class="my-4" style="font-weight: 800;color:darkorange">Create live session</h1>
                    <div class="">
 
                    <?php echo validation_errors(); ?>
                        <form method="POST" action="<?php echo base_url('api_zoom/index'); ?>">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>Package Name</label><span style="color:red">*</span>
                                    <select  class="selectpicker form-control" multiple data-live-search="true"name="fk_planId[]"  required>
                                    <option value="">Select Class</option>
                                    <?php  foreach ($selectedpackage as $package) { ?>     
                                    <option value="<?php echo $package['feesId']; ?>"><?php echo $package['packageName']?></option>
                                    <?php } ?>
                                    </select> 
                                    <span style="color:red"><?php echo form_error('fk_planId');?></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Batch Name</label><span style="color:red">*</span>
                                    <select type="text"  class="form-control" id="" name="fk_batchId" required>
                                    <option value="">Select Batch</option>
                                    <?php  foreach ($selectedbatch as $batch) { ?>  
                                    <option  value="<?php echo $batch['batchId'] ?>"><?php echo $batch['batchName']?></option>
                                    <?php } ?> 
                                    </select>
                                    <span style="color:red"><?php echo form_error('fk_batchId');?></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="username">Topic Name</label><span style="color:red">*</span>
                                    <input type="text" name="topic_name" class="form-control" value="<?php echo set_value('topic_name');  ?>"   id="studentMobile" placeholder="Enter  Topic Name" required>
                                    <span style="color:red"><?php echo form_error('topic_name');?></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="username">Description</label>
                                    <textarea class="form-control" rows="2" id="comment" name="description" placeholder="Enter Description"></textarea>
                                    <span style="color:red"><?php echo form_error('description');?></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Subject</label>
                                    <select type="text"  class="form-control" name="subjectid" required>    
                                    <option value="">Select subject</option>
                                    <?php  foreach ($selectedsubject as $subjects_name) { ?>  
                                    <option value="<?php echo $subjects_name['sessionId']; ?>" ><?php echo $subjects_name['sessionName']?></option>
                                    <?php } ?> 
                                    </select>
                                    <span style="color:red"><?php echo form_error('subjectid');?></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="username">Alternative Host</label>
                                    <input type="text" name="alternative_hosts" class="form-control"  value="Live.vedictree@gmail.com"  id="studentMobile" placeholder="Enter Alternative Host Gmail Id" >
                                    <span style="color:red"><?php echo form_error('host_gmail');?></span>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="username"> Start Date</label><span style="color:red">*</span>
                                    <input type="date" name="start_date" class="form-control" value="<?php echo set_value('start_date');  ?>" name="toDT"  id="toDT" required>
                                    <span style="color:red"><?php echo form_error('start_date');?></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="username">Start Time</label><span style="color:red">*</span>
                                    <input type="text" name="start_time" class="form-control bs-timepicker" value="<?php echo set_value('start_time'); ?>" required>
                                    <span style="color:red"><?php echo form_error('start_time');?></span>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="username">To Date</label><span style="color:red">*</span>
                                    <input type="date" name="end_date" class="form-control" value="<?php echo set_value('end_date');  ?>" name="toDT"  id="toDT" >
                                    <span style="color:red"><?php echo form_error('end_date');?></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="username">End Time</label><span style="color:red">*</span>
                                    <input type="text" name="end_time"  class="form-control bs-timepicker" value="<?php echo set_value('end_time')?>">
                                    <span style="color:red"><?php echo form_error('end_time');?></span>
                                </div>
                            </div>
                            <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>
</html>
<?php $this->load->view('footd');?>
<script>
    $(document).ready(function(){
     $('select').selectpicker();

    });
</script>

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