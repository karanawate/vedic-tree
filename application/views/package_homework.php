<?php
 $this->load->view('header');
?>
<style type="text/css">
    .thclass{
        width:400px;
    }
    
        .package_color {
            width: 275px;
            height: 100px;
            background-color: #626ed4d6;
            border-radius: -6px;
            border-radius: 4px;
            color: white;
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
                                    <h4 class="font-size-18">Course Master</h4>
                                    <ol class="breadcrumb mb-0">
                                    </ol>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-1 col-md-6">
                            </div>
                            <?php 

                            if($getpackage_homework){
                                foreach ($getpackage_homework as $key => $value) {
                                   
                                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                 $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                                ?>

                                <div class="col-xl-3 col-md-6">
                                <a href="" class="gallery-popup" title="Open Imagination">
                                    <div class="project-item">
                                        <a href="<?php echo base_url('dashboard/view_homework/'.$value['feesId'])?>" class="gallery-popup" title="Open Imagination">
                                            <div class="package_color">
                                                <?php echo $value['packageName']  ?>
                                            </div>
                                        </a>    
                                    </div>
                                </a>
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
