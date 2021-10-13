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
                    <h1 class="my-4" style="font-weight: 800;color:darkorange">Teacher Create Signature</h1>
                    <div class="">
 
                    <?php echo validation_errors(); ?>
                        <form method="POST" action="<?php echo base_url('teacher/teacher_insert_sig'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="username">Teacher Signature</label><span style="color:red">*</span>
                                    <input type="file" name="sigh_upload" class="form-control" value="<?php echo set_value('sigh_upload');  ?>"   required>
                                    <span style="color:red"><?php echo form_error('sigh_upload');?></span>
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