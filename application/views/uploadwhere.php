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
                            <div class="col-xl-12 col-md-4">
                            </div>
                            <?php 

                            if($uploadwhere){
                                foreach ($uploadwhere as $key => $value) {   
                                    
                                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                                ?>

                                <div class="col-xl-4 col-md-6">
                                <a href="<?php echo base_url('dashboard/add_video/'.$classId.'/'.$coursePeriodId.'/'.$value['fkuploadkey'])?>" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item"  style="border: 1px solid;padding: 20px;">
                                        <h1 style="text-align:center;"><?php echo $value['upName'];?></h1>
                                    </div>
                                </a>
                            </div>
                        <?php }} ?>
                    </div> <!-- container-fluid -->
                </div>
            </div>
        </div>
    </div>

      

