<?php
 $this->load->view('header');
 $monthdata =  required_data();

?>
<style type="text/css">
    .thclass{
        width:400px;
    }
</style>
 <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
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
                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <h1>Web Banner</h1>
                                       <?php if ($this->session->flashdata('msg')) { ?>
                                            <div id="success_msg" class="alert alert-success"> <?= $this->session->flashdata('msg') ?> </div>
                                        <?php } ?>
                                        <form method="POST"  action="<?php echo  base_url("adminseo/insert_web_banner")?>" enctype="multipart/form-data">
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-xl-4 col-md-6">
                                               <div class="form-group" >
                                                    <div class="form-group">
                                                        <label>Enter Title</label>
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Image Link" >
                                                    </div>
                                                    <span style="color:red"><?php echo form_error('title');?></span>
                                                </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label> Enter Banner</label>
                                                            <input type="file" class="form-control" id="banner" name="banner" placeholder="Enter Banner "  >
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('banner');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                </div>
                            </div>
                       

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>
  

  <script>
$(document).ready(function(){
    setTimeout(function() {
    $("#success_msg").hide(3000);
}, 3000); 
});
</script>

    