<?php
 $this->load->view('header');
?>
<style type="text/css">
    .thclass{
        width:400px;
    }
    .btn.focus, .btn:focus {
        box-shadow: none !important;
    }
</style>
        <!-- Begin page -->
        <div id="layout-wrapper">
            <?php $this->load->view('topbar'); ?>
            <?php $this->load->view('sidebar'); ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-18">Unlock Days Month = <?php echo $fk_monthId; ?></h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                        <?php
                        if($unlocksession_data){
                            $unlocksession_data_dayId = $unlocksession_data[0]['unlockdayId'];
                        }else{
                            $unlocksession_data_dayId = 0;
                        }

                        ?>
                        <div class="row">
                            <?php 

                            if($unlockdays){
                                $fkdayId = 0;
                                foreach ($unlockdays as $key => $value) {

                                    if($unlocksession_data_dayId >= $value['dayId']){
                                        $lockclass = "fas fa-unlock-alt";
                                        $colorlock = "darkgreen";
                                    }else{
                                        $lockclass = "fas fa-lock";
                                        $colorlock = "red";
                                    }

                                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                 $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                                ?>
                            <div class="col-xl-3 col-md-6">
                                <div>
                                    
                                <form class="d-flex justify-content-end"  method="POST" onclick="return check()" action="<?php echo base_url('dashboard/unlockdays');?>">
                                <input type="hidden" value="<?php echo $value['dayId'];?>" name="dayId">
                                <input type="hidden" value="<?php echo $fkdayId = $value['dayId'];?>" name="dayId">
                                <input type="hidden" value="<?php echo $fk_monthId;?>" name="fk_monthId">
                                <input type="hidden" value="<?php echo $studId;?>" name="studId">
                                <button  type="submit" name="submit" value="submit" class="btn btn-sm">
                                    <i style="font-size: 27px;position: relative; color:<?php echo $colorlock;?> " class="<?php echo $lockclass; ?>"></i>
                                </button>           
                                </form>
                                </div>                                
                                <a href="#" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item">
                                        <div class="overlay-container" style="height:100px;border-radius:100px;background-color:<?php echo $color;?>">
                                            <h1 class="m-0" style="padding: 30px 0;text-align: center;color: white;"><?php echo strtoupper($value['dayName']);?></h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php }} ?>
                    </div> <!-- container-fluid -->
                </div>
            </div>
        </div>
    </div>

       <?php $this->load->view('footd');?>

      <script>
    function check() {
        if(confirm("Are You Sure You Want To loack the session")==true)
        {
            return true;
        }else{
            return false;
        }
    }
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
                    window.location.href = '<?php echo base_url('dashboard/unlockdays/'.$fk_monthId.'/'.$fkdayId)?>';
       }, 2000);

  </script>

<?php } ?>
