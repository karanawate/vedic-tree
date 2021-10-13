<?php
 $this->load->view('header');
 $monthdata =  required_data_admin();

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

                                        <h3>Class  <?php
                                        
                                        
                                        if(isset($where_to_upload) && $where_to_upload==0){
                                                $where_to_upload_name = "Live";
                                            }else{
                                                if(isset($where_to_upload)){
                                                 $where_to_upload_name = $where_to_upload;
                                                }else{
                                                    $where_to_upload_name = "";
                                                }
                                        }
                                        
                                        
                                        if($fk_upload_key==1){
                                            $whereuploadName = "Demo";
                                        }else if($fk_upload_key==2){
                                            $whereuploadName = "Live";
                                        }else if($fk_upload_key==3){
                                            $whereuploadName = "Recap";
                                        }else{
                                            $whereuploadName = "Common";
                                        }
                                            
                                        
                                        if($fk_classId==1){
                                            $className = "Nursery" ;
                                        }else if($fk_classId==2){
                                            $className = "Junior" ;
                                        }else{
                                            $className = "Senior" ;
                                        }
                                        echo $className;
                                        
                                        ?> | Month  <?php echo $monthId; ?> | Day <?php echo $dayId; ?> | Course <?php echo $where_to_upload_name . " Course / ".$whereuploadName; ?> </h3>
                                        <div class="col-lg-6">
                                            <form class="" enctype="multipart/form-data;charset=utf-8"  method="post" action="<?php echo base_url('dashboard/add_next_to_next_step');?>">
                                                <input type="hidden" value="<?php if(!empty($param)){ echo $param; }else{ echo ''; }?>" name="param">
                                                <input type="hidden" value="<?php if(!empty($fk_classId)){ echo $fk_classId; }else{ echo ''; }?>" name="fk_classId">
                                                <input type="hidden" value="<?php if(!empty($dayId)){ echo $dayId; }else{ echo ''; }?>" name="fk_dayId">
                                                <input type="hidden" value="<?php if(!empty($monthId)){ echo $monthId; }else{ echo ''; }?>" name="fk_monthId">
                                                <input type="hidden" value="<?php if(!empty($where_to_upload)){ echo $where_to_upload; }else{ echo ''; }?>" name="coursePeriod">
                                                <input type="hidden" value="<?php if(!empty($fk_upload_key)){ echo $fk_upload_key; }else{ echo ''; }?>" name="fk_upload_key">
                                                <input type="hidden" value="2" name="fk_contentId">
                                                
                                                <div class="outer">
                                                    <div data-repeater-item class="outer">
                                                        
                                                        <div class="form-group">
                                                            <label>Category title</label>
                                                            <input type="text" class="form-control" name="content_title" placeholder="Enter Category Title">
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
                                                            <div class="form-group">
                                                                <label>Vimeo Video Id </label>
                                                                <input type="number" class="form-control" name="vimeoId" placeholder="Vimeo Video Id">
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
                                                            <label>Enter Squence Number</label>
                                                            <input type="number" class="form-control" name="fk_squenceId" placeholder="Enter Squence Number" >
                                                            <span style="color:red"><?php echo form_error('fk_squenceId');?></span>
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
                        
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo "Month ".$monthId; ?> , <?php echo "Day ".$dayId; ?></h4>
                                        <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                               <th class="thclass">
                                                <!-- <input type="checkbox" id="checkAll">Check All</th> -->
                                                <th class="thclass">Class Name</th>
                                                <th class="thclass">Category Type</th>
                                                <th class="thclass">Sequence Number</th>
                                                <th class="thclass">Session Name</th>
                                                <th class="thclass">vimeoId</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Course Period</th>
                                                <th class="thclass">Video Type</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php 

                                              
                                               if($get_day_sessions){
                                                $i=1;
                                                 $videotype= "";
                                                foreach ($get_day_sessions as $key => $value) { 
                                                    
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                   
                                                   if($value['fk_upload_key']==1){
                                                       $videotype="Demo";
                                                   }else if($value['fk_upload_key']==2){
                                                       $videotype="Live";
                                                   }else if($value['fk_upload_key']==3){
                                                       $videotype="Recap";
                                                   }
                                                ?> 
                                            <tr>
                                                <td>
                                                    <input style="display: none;" type="checkbox" class="selectallchecks" name="getvidId[]" value="<?php echo $value['vidId']; ?>">
                                                    <?php echo $i++;?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['catName']; ?></td>
                                                <td><?php echo $value['fk_squenceId']; ?></td>
                                                <td><?php echo $value['sessionName']; ?></td>
                                                <td><?php if($value['vimeoId']==""){
                                                    echo "No Video Id Found";
                                                }else{
                                                    echo $value['vimeoId']; } ?>
                                                     <a href="https://player.vimeo.com/video/<?php echo $value['vimeoId'];?>"><i style="font-size: 28px;float:right;" class="ion ion-md-videocam"></i></a>   
                                                    </td>
                                                
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td><?php echo $value['coursePeriod']; ?></td>
                                                <td><?php echo $videotype; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('dashboard/edit_video/'.$value['vidId'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i>
                                                    </a>
                                                    <form class="" method="POST" onclick="return check()" action="<?php echo base_url('dashboard/deletevideoId');?>">
                                                        
                                                        <input type="hidden" value="<?php echo $value['vidId'];?>"         name="vidId" >
                                                        <input type="hidden" value="<?php echo $value['fk_monthId'];?>"    name="fk_monthId" >
                                                        <input type="hidden" value="<?php echo $value['fk_upload_key'];?>" name="fk_upload_key" >
                                                        <input type="hidden" value="<?php echo $value['coursePeriod'];?>"  name="coursePeriod" >
                                                        <input type="hidden" value="<?php echo $value['fk_dayId'];?>"      name="fk_dayId" >
                                                        <input type="hidden" value="<?php echo $value['fk_classId'];?>"    name="fk_classId" >
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;position: relative;top: -38px;   margin-left: 19px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                               <?php }} ?> 
                                         
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> 
                        

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
                  message: "<?php echo validation_errors(); ?>"

                },{
                    type: type[color],
                    timer: 8000,
                });

              setTimeout(function() {
                     window.location.href = '<?php echo base_url('dashboard/add_next_to_next_step/'.$fk_classId.'/'.$monthId.'/'.$dayId.'/'.$where_to_upload.'/'.$whereupload)?>';
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



