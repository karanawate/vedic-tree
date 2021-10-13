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

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                         <h4 class="card-title">Enter Notice</h4>        
                                         <form method="post" action="<?php echo base_url('dashboard/notice');?>">
                                               <div class="form-group">
                                                <label for="exampleFormControlSelect1">select Class</label>
                                                <select class="form-control" name="class_id"  id="exampleFormControlSelect1">
                                                  <option value="1">select option</option>    
                                                  <option value="1">Nursary kg</option>
                                                  <option value="2">Juniar kg</option>
                                                  <option value="3">Senior kg</option>
                                                </select>
                                                  <span style="color:red"><?php echo form_error('class_id');?></span>
                                              </div>
                                            <div class="form-group">
                                                <textarea class="summernote" name="noticedesc">Hello Summernote</textarea>
                                                <span style="color:red"><?php echo form_error('noticedesc');?></span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <button class="btn btn-primary" name="submit" value="submit" type="submit">Submit</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
              <?php $this->load->view('footer'); ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>

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
                            window.location.href = '<?php echo base_url('dashboard/getnoticelist')?>';
               }, 2000);

          </script>



        <?php } ?>