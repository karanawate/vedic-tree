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
                                        <h4 class="card-title">update Videos</h4>
                                        <div class="col-lg-6">
                                            <form class="" enctype="multipart/form-data; charset=utf-8" method="post" action="<?php echo base_url('dashboard/edit_video');?>">
                                                <input type="hidden" value="<?php echo $update_videouploading[0]['vidId']; ?>" name="vidId">
                                                <input type="hidden" value="<?php echo $fk_classId; ?>" name="fkclassId">
                                                
                                                <?php 

                                                    $monthId         = $update_videouploading[0]['fk_monthId'];
                                                    $whereupload     = $update_videouploading[0]['fk_upload_key'];
                                                    $where_to_upload = $update_videouploading[0]['coursePeriod'];
                                                    $dayId           = $update_videouploading[0]['fk_dayId'];
                                                ?>
                                                
                                                <div class="outer">
                                                    <div data-repeater-item class="outer">
                                                        <div class="form-group">
                                                            <label for="formemail">Class Name</label>
                                                            <select class="form-control" value="<?php echo $update_videouploading[0]['fk_classId']?>"  name="fk_classId" >
                                                                <option value="<?php echo $update_videouploading[0]['fk_classId']; ?>"><?php echo $update_videouploading[0]['className']; ?></option>
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
                                                            <input type="text" class="form-control" name="content_title" value="<?php echo $update_videouploading[0]['content_title']; ?>" placeholder="Enter Content Title">
                                                            <span style="color:red"><?php echo form_error('content_title'); ?></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Category Type</label>
                                                            <select class="form-control fk_catId" name="fk_catId" value="<?php echo $update_videouploading[0]['fk_catId']?>" >
                                                                <option value="<?php echo $update_videouploading[0]['fk_catId']; ?>"><?php echo $update_videouploading[0]['catName']; ?></option>
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
                                                            <select class="form-control fk_contentId" name="fk_contentId" value="<?php echo $update_videouploading[0]['fk_contentId']?>">
                                                                <option value="<?php echo $update_videouploading[0]['fk_contentId']; ?>"><?php echo $update_videouploading[0]['contnetName']; ?></option>
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
                                                                
                                                            </div>
                                                            <span style="color:red"><?php if(isset($error['contentfile'])){ echo $error['contentfile']; } ?></span>
                                                        </div>


                                                        <div class="form-group" id="showvimeo" style="display:none;">
                                                            <div class="form-group">
                                                                <label>Vimeo Video Id </label>
                                                                <input type="text" value="<?php echo $update_videouploading[0]['vimeoId']; ?>" class="form-control" name="vimeoId" placeholder="Vimeo Video Id">
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="showyoutube" style="display:none;">
                                                            <div class="form-group">
                                                                <label>Youtube Link </label>
                                                               <input type="url" value="<?php echo $update_videouploading[0]['youtubelink']; ?>" class="form-control" name="youtubelink" placeholder="Youtube Link">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="formemail">Session Type</label>
                                                            <select class="form-control" value="<?php echo $update_videouploading[0]['fk_sessionId']?>" name="fk_sessionId" >
                                                                <option value="<?php echo $update_videouploading[0]['fk_sessionId']; ?>"><?php echo $update_videouploading[0]['sessionName']; ?></option>
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
                                                            <select class="form-control" value="<?php echo $update_videouploading[0]['fk_monthId']?>" name="fk_monthId" >
                                                                <option value="<?php echo $update_videouploading[0]['fk_monthId']; ?>"><?php echo $update_videouploading[0]['monthName']; ?></option>
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
                                                            <select class="form-control" value="<?php echo $update_videouploading[0]['fk_dayId']?>" name="fk_dayId" >
                                                                <option value="<?php echo $update_videouploading[0]['fk_dayId']; ?>"><?php echo $update_videouploading[0]['dayName']; ?></option>
                                                                <?php if($monthdata['daydata']){
                                                               foreach ($monthdata['daydata'] as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['dayId']?>"><?php echo $value['dayName']?></option>
                                                                 <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_dayId');?></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Enter Squence Number</label>
                                                            <input type="number" class="form-control" name="fk_squenceId" value="<?php echo $update_videouploading[0]['fk_squenceId']?>" placeholder="Enter Squence Number" >
                                                            <span style="color:red"><?php echo form_error('fk_squenceId');?></span>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label>Related youtube Link </label>
                                                            <input type="url" class="form-control" name="relatedyoutubelink" value="<?php echo $update_videouploading[0]['relatedyoutubelink']?>" placeholder="Enter youtubelink" >
                                                            <span style="color:red"><?php echo form_error('relatedyoutubelink');?></span>
                                                        </div>
                                                        
                                                         <div class="form-group">
                                                            <label for="formemail">Upload Where </label>
                                                            <select class="form-control" name="fk_upload_key"  value="<?php echo $update_videouploading[0]['fk_upload_key'];?>" >
                                                            <?php
                                                            
                                                            if($update_videouploading[0]['fk_upload_key']==1){
                                                                $namemode = "Demo";
                                                                $namemodekey = "1";
                                                            }elseif($update_videouploading[0]['fk_upload_key']==2){
                                                                $namemode = "Live";
                                                                $namemodekey = "2";
                                                            }elseif($update_videouploading[0]['fk_upload_key']==4){
                                                                $namemode = "Common";
                                                                $namemodekey = "4";
                                                            }else{
                                                                $namemode = "Recap";
                                                                $namemodekey = "3";
                                                            }
                                                            
                                                            ?>
                                                            <option value="<?php echo $namemodekey; ?>"><?php echo $namemode; ?></option>
                                                                                     
                                                              <option value="1">Demo</option>
                                                              <option value="2">Live </option>
                                                              <option value="3">Recap </option>
                                                              <option value="4">Common </option>
                                                              
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_upload_key'); ?></span>
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group">
                                                            <label for="formemail">Course Period </label>
                                                            <select class="form-control" name="coursePeriod"  value="<?php echo $update_videouploading[0]['coursePeriod'];?>" >
                                                            <?php
                                                            
                                                            if($update_videouploading[0]['coursePeriod']==3){
                                                                $coursePeriod = 3;
                                                            }
                                                            else if($update_videouploading[0]['coursePeriod']==7)
                                                            {
                                                                $coursePeriod = 7;
                                                            }else{
                                                                $coursePeriod = "0";
                                                            }
                                                            
                                                            ?>
                                                            <option value="<?php echo $coursePeriod; ?>"><?php echo $coursePeriod; ?></option>
                                                              <option value="0">0</option>
                                                              <option value="3">3</option>
                                                              <option value="7">7</option>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('coursePeriod'); ?></span>
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

                setTimeout(function() {
                    window.location.href = '<?php echo base_url('dashboard/add_next_to_next_step/'.$fk_classId.'/'.$monthId.'/'.$dayId.'/'.$where_to_upload.'/'.$whereupload )?>';
       }, 2000);
          </script>



        <?php } ?>
