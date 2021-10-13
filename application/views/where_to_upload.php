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
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-18">Course Master</h4>
                                    <ol class="breadcrumb mb-0">
                                    </ol>
                                </div>
                            </div>
                        </div>     
                        <div class="row">
                            <div class="col-xl-1 col-md-6">
                            </div>
                            <?php 

                            if($where_to_upload){
                                foreach ($where_to_upload as $key => $value) {   
                                    
                                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                                ?>

                                <div class="col-xl-3 col-md-6">
                                <a href="<?php echo base_url('dashboard/uploadwhere/'.$classId.'/'.$value['coursePeriodId'])?>" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item">
                                        <div class="overlay-container">
                                            <img src="<?php echo base_url()?>assets/images/gallery/live-<?php echo $value['wId'];?>.png" alt="img" class="gallery-thumb-img">
                                        </div>
                                        <h1 style="text-align:center;"><?php echo $value['courseperiod'];?></h1>
                                    </div>
                                </a>
                            </div>
                        <?php }} ?>
                    </div> <!-- container-fluid -->
                </div>
            </div>
        </div>
    </div>

      

