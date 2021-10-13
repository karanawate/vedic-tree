<?php
 $this->load->view('header');
 $monthdata =  required_data();
?>
<style type="text/css">
    .thclass{
        width:400px;
    }
</style>
        <div id="layout-wrapper">
            <?php $this->load->view('topbar'); ?>
            <?php $this->load->view('sidebar'); ?>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Videos</h4>
                                        <div class="col-lg-6">
                                            <?php //echo validation_errors(); ?>
                                            <form class="" enctype="multipart/form-data" method="post" action="<?php echo base_url('dashboard/videouploading');?>">
                                                <div class="outer">
                                                    <div data-repeater-item class="outer">
                                                        <div class="form-group">
                                                            <label for="formemail">Class Name</label>
                                                            <select class="form-control" name="fk_classId" >
                                                                <option value="">Select Class</option>
                                                                <?php
                                                                 if($monthdata['getClass']){
                                                                 foreach ($monthdata['getClass'] as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['classId']?>"><?php echo $value['className']?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_classId'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Category title</label>
                                                            <input type="text" class="form-control" name="content_title" placeholder="Enter Content Title">
                                                            <span style="color:red"><?php echo form_error('content_title'); ?></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Category Type</label>
                                                            <select class="form-control fk_catId" name="fk_catId" >
                                                                <option value="">Select Category</option>
                                                                <?php

                                                                 if($monthdata['catergory']){
                                                                    foreach ($monthdata['catergory'] as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['catId']?>"><?php echo $value['catName']?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_catId'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Content Type</label>
                                                            <select class="form-control fk_contentId" name="fk_contentId" >
                                                                <option value="">Select Type</option>
                                                                <?php

                                                                 if($monthdata['contnet_type']){
                                                                    foreach ($monthdata['contnet_type'] as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['contentId']?>"><?php echo $value['contnetName']?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_contentId'); ?></span>
                                                        </div>

                                                        <div class="form-group" id="showfile" style="display:none;">
                                                            <div class="form-group">
                                                                <label>Upload File </label>
                                                                <input type="file" name="contentfile" class="filestyle">
                                                                <span><?php ?></span>
                                                            </div>
                                                        </div>


                                                        <div class="form-group" id="showvimeo" style="display:none;">
                                                            <div class="form-group">
                                                                <label>Vimeo Video Id </label>
                                                                <input type="text" class="form-control" name="vimeoId" placeholder="Vimeo Video Id">
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="showyoutube" style="display:none;">
                                                            <div class="form-group">
                                                                <label>Youtube Link </label>
                                                               <input type="url" class="form-control" name="youtubelink" placeholder="Youtube Link">
                                                            </div>
                                                        </div>


                                                        
                                                        <div class="form-group">
                                                            <label for="formemail">Session Type</label>
                                                            <select class="form-control" name="fk_sessionId" >
                                                                <option value="">Select Session</option>
                                                                <?php

                                                                 if($monthdata['sessionType']){
                                                               foreach ($monthdata['sessionType'] as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['sessionId']?>"><?php echo $value['sessionName']?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_sessionId'); ?></span>
                                                        </div>

            
                                                        <div class="form-group">
                                                            <label for="formemail">Select Month</label>
                                                            <select class="form-control" name="fk_monthId" >
                                                                <option value="">Select Month</option>
                                                                <?php

                                                                 if($monthdata['monthdata']){
                                                               foreach ($monthdata['monthdata'] as $key => $monthvalue) {
                                                                 ?>
                                                                <option value="<?php echo $monthvalue['mId']?>"><?php echo $monthvalue['monthName']?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_monthId'); ?></span>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="formname">Lecture  Name </label>
                                                            <select class="form-control" name="fk_dayId" >
                                                                <option value="">Select Day</option>
                                                                <?php if($monthdata['daydata']){
                                                               foreach ($monthdata['daydata'] as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['dayId']?>"><?php echo $value['dayName']?></option>
                                                                 <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_dayId');?></span>
                                                        </div>

                                                        

                                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        

                    </div> 
                </div>
              <?php $this->load->view('footer'); ?>
            </div>
        </div>
       <?php $this->load->view('footd');?>
       <script type="text/javascript">
           $(document).ready(function() {

            $(".fk_contentId").change(function(){
                var fk_contentId = $(this).val();
                // alert(fk_contentId);
                if(fk_contentId==1){
                    $("#showfile").show();
                    $("#showyoutube").show();
                }else if(fk_contentId==2){  //for video vimeo
                    $("#showvimeo").show();
                    $("#showfile").hide();
                    $("#showyoutube").hide();
                }else if(fk_contentId==3){
                    $("#showvimeo").hide();
                    $("#showyoutube").show();
                    $("#showfile").show();
                }else{
                    $("#showfile").hide();
                    $("#showvimeo").hide();
                    $("#showyoutube").hide();
                }
            });

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

          </script>



        <?php } ?>
