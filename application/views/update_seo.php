<?php
 $this->load->view('header');
 $monthdata =  required_data();

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
                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('dashboard/update_seo'); ?>">
                                                <input type="hidden" name="webId" value="<?php echo $update_web_seo_list[0]['webId']; ?>">
                                                <input type="hidden" name="oldweboggpic" value="<?php echo $update_web_seo_list[0]['weboggpic']; ?>">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Website Title </label>
                                                            <input type="text" class="form-control" value="<?php echo $update_web_seo_list[0]['web_Title']; ?>" name="web_Title" placeholder="Website Title ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_Title');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Meta Title </label>
                                                            <input type="text" class="form-control" value="<?php echo $update_web_seo_list[0]['web_metaTitle']; ?>" name="web_metaTitle" placeholder="website meta Title ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_metaTitle');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter website page Keyword </label>
                                                            <input type="text" class="form-control" value="<?php echo $update_web_seo_list[0]['web_pageKeyword']; ?>" name="web_pageKeyword" placeholder="Enter website page Keyword ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_pageKeyword');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Meta  Description </label>
                                                            <textarea type="text" class="form-control" name="web_metaDesc"><?php echo $update_web_seo_list[0]['web_metaDesc'];?></textarea>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_metaDesc');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Meta Image </label>
                                                            <input type="file" class="filestyle" value="<?php echo $update_web_seo_list[0]['weboggpic']; ?>" name="weboggpic" placeholder="Meta Keywords ">
                                                        </div>
                                                        <span style="color:red"><?php if(isset($error['weboggpic'])){ echo $error['weboggpic']; } ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Category Name </label>
                                                            <input type="url" class="form-control" value="<?php echo $update_web_seo_list[0]['web_metaUrl']; ?>" name="web_metaUrl" placeholder="Meta Url ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('web_metaUrl');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Select Page For add Meta Tags</label>
                                                            <select class="form-control" name="metaPageName">

                                                                <?php
                                                                $metaPageName = ""; 
                                                                if($update_web_seo_list[0]['metaPageName']==1){
                                                                    $metaPageName = "Home";
                                                                }else if($update_web_seo_list[0]['metaPageName']==2){
                                                                    $metaPageName = "About us";

                                                                }else if($update_web_seo_list[0]['metaPageName']==3){
                                                                    $metaPageName = "Gallery Page";
                                                                    
                                                                }else if($update_web_seo_list[0]['metaPageName']==4){
                                                                    
                                                                    $metaPageName = "Course 1";
                                                                }else if($update_web_seo_list[0]['metaPageName']==5){
                                                                    $metaPageName = "Course 2";
                                                                    
                                                                }else if($update_web_seo_list[0]['metaPageName']==6){
                                                                    $metaPageName = "Course 3";
                                                                    
                                                                }else if($update_web_seo_list[0]['metaPageName']==7){
                                                                    $metaPageName = "Blog";
                                                                }else if($update_web_seo_list[0]['metaPageName']==8){
                                                                 $metaPageName = "";    
                                                                }else if($update_web_seo_list[0]['metaPageName']==9){
                                                                    
                                                                $metaPageName = "";
                                                                }
                                                                 ?>
                                                                <option value="<?php echo $update_web_seo_list[0]['metaPageName']; ?>"><?php echo $metaPageName; ?></option>
                                                                <option value="1">Home</option>
                                                                <option value="2">About us</option>
                                                                <option value="3">Gallery Page</option>
                                                                <option value="4">Course 1</option>
                                                                <option value="5">Course 2</option>
                                                                <option value="6">Course 3</option>
                                                                <option value="7">Blog</option>
                                                            </select>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('metaPageName');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">update</button>
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
                    window.location.href = '<?php echo base_url('dashboard/add_web_seo')?>';
       }, 2000);

  </script>

<?php } ?>

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
