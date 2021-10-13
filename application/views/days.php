<?php
 $this->load->view('header');
?>
<style type="text/css">
    .thclass{
        width:400px;
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
                                    <h4 class="font-size-18">Month Days</h4>
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Month <?php echo $monthId?></a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <?php 

                            if($get_month_data){
                               asort($get_month_data);
                                foreach ($get_month_data as $key => $value) {
                                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                                ?>
                            <div class="col-xl-3 col-md-6">
                                <div>
                                    
                                <form style="width:12px;"  method="POST" onclick="return check()" action="<?php echo base_url('dashboard/deletevideoId');?>">
                                <input type="hidden" value="<?php echo $value['vidId'];?>" name="vidId">
                                <input type="hidden" value="<?php echo $monthId?>" name="monthId">
                                <button  type="submit" name="submit" value="submit" class="btn btn-sm">
                                    <p style="float:right;"><i style="font-size: 27px;position: relative;margin-left:290px;top:32px;" class="mdi mdi-delete-forever"></i></p></button>           
                                </form>
                                </div>
                                <?php if($recap!=""){?>
                                 <a href="<?php echo base_url('dashboard/get_day_sessions_recap/'.$value['dayId'].'/'.$monthId.'/'.$value['fk_classId'].'/'.$recap)?>" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item">
                                        <div class="overlay-container" style="height:100px;background-color:<?php echo $color;?>">
                                            <h1 class="ml-2" style="padding: 9% 22%;color: white;"><?php echo $value['dayName'];?></h1>
                                        </div>
                                    </div>
                                </a>
                                
                                <?php
                                 } else if(isset($coursePeriod) && $coursePeriod > 0 ) {
                                ?>
                                
                                <a href="<?php echo base_url('dashboard/get_day_sessions_coursewise_data/'.$value['dayId'].'/'.$monthId.'/'.$value['fk_classId'].'/'.$coursePeriod)?>" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item">
                                        <div class="overlay-container" style="height:100px;background-color:<?php echo $color;?>">
                                            <h1 class="ml-2" style="padding: 9% 22%;color: white;"><?php echo $value['dayName'];?></h1>
                                        </div>
                                    </div>
                                </a>
                                
                                <?php }else{?>
                                <a href="<?php echo base_url('dashboard/get_day_sessions/'.$value['dayId'].'/'.$monthId.'/'.$value['fk_classId'])?>" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item">
                                        <div class="overlay-container" style="height:100px;background-color:<?php echo $color;?>">
                                            <h1 class="ml-2" style="padding: 9% 22%;color: white;"><?php echo $value['dayName'];?></h1>
                                        </div>
                                    </div>
                                </a>
                                <?php } ?>
                            </div>
                        <?php }} ?>
                    </div> <!-- container-fluid -->
                </div>
            </div>
        </div>
    </div>


     
        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>

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
                    window.location.href = '<?php echo base_url('dashboard/days/'.$monthId)?>';
       }, 2000);


  </script>

<?php } ?>
