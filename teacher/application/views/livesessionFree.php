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
                  
                    <h1 class="my-4" style="font-weight: 800;color:darkorange">Create live stream session</h1>
                    <div class="">
 
                    <?php echo validation_errors(); ?>
                        <form method="POST" action="<?php echo base_url('teacher/livesessionFree'); ?>">
                            <div class="row">
                                
                                <div class="form-group col-sm-4">
                                    <label for="username">Enter Live Stream Link </label><span style="color:red">*</span>
                                    <input type="url" name="microsoft_link" class="form-control" value="<?php echo set_value('microsoft_link');  ?>"   id="" placeholder="Enter Live Stream Link" required>
                                    <span style="color:red"><?php echo form_error('microsoft_link');?></span>
                                </div>
                           
                                <div class="form-group col-sm-4">
                                    <label for="username"> Start Date</label><span style="color:red">*</span>
                                    <input type="date" name="start_date" class="form-control" value="<?php echo set_value('start_date');  ?>" name="toDT"  id="toDT" required>
                                    <span style="color:red"><?php echo form_error('start_date');?></span>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="username">Start Time</label><span style="color:red">*</span>
                                    <input type="text" name="start_time" class="form-control bs-timepicker" placeholder="Enter Start time" value="<?php echo set_value('start_time'); ?>" required>
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
                                    <input type="text" name="end_time"  class="form-control bs-timepicker" placeholder="Enter End time" value="<?php echo set_value('end_time')?>">
                                    <span style="color:red"><?php echo form_error('end_time');?></span>
                                </div>
                            </div>
                            <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Submit</button>
                        </form>
                    </div>
                    
                    
                    
                    <div class="">
                        <table id="myTable">
                          <thead>
                            <tr>
                                <th>Live Stream Link</th>
                                <th>Start Date </th>
                                <th>End Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action </th>

                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if($get_live_stream){

                                foreach($get_live_stream as $value) {
                                    
                                    // echo "<pre>";
                                    // print_r($value);
                                   
                             ?>
                            <tr>
                                <td><?php echo $value['microsoft_link'];?></td>
                                <td><?php echo $value['start_date'];?></td>
                                <td><?php echo $value['end_date'];?></td>
                                <td><?php echo $value['start_time'];?></td>
                                <td><?php echo $value['end_time'];?></td>
                                <td>
                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('teacher/deleteliveStream');?>">
                                        <input type="hidden" value="<?php echo $value['id'];?>" name="id">
                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px; color:#626ed4;" class="mdi mdi-delete"></i></button>
                                    </form> 
                                                        
                                </td>
                                
                            </tr>
                            <?php } } ?>
                          </tbody>
                        </table>
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
                    window.location.href = '<?php echo base_url('teacher/livesessionfree')?>';
        }, 2000);
        

    </script>



<?php } ?>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
    stateSave: true
});
</script>
<script>
    function check() {
        if(confirm("Are You Sure You Want To Delete")==true)
        {
            return true;
        }else{
            return false;
        }
    }

     
</script>