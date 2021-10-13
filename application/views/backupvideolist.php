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
                                        <form method="POST" action="<?php echo base_url('dashboard/listvideouploading'); ?>">
                                            <h3>Filter Data
                                                <a style="float:right"  class="btn btn-primary w-md waves-effect waves-light" href="<?php echo base_url('dashboard/videouploading'); ?>">Add Session</a>
                                                </h3>
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                            <label for="formemail">Class Name</label>
                                                            <select class="form-control"  name="fk_classId" >
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
                                                </div>
                                                <div class="col-xl-4 col-md-6">
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
                                                </div>

                                                <div class="col-xl-4 col-md-6">
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
                                                </div>


                                                <div class="col-xl-4 col-md-6">
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
                                                        
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Vimeo Video Id </label>
                                                            <input type="text" class="form-control" name="vimeoId" placeholder="Vimeo Video Id">
                                                        </div>
                                                </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> from Day</label>
                                                        <input type="date" class="form-control" value="<?php echo set_value('fromDT');  ?>" name="fromDT"  id="fromDT" >
                                                        <span style="color:red"><?php echo form_error('fromDT');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> To Date</label>
                                                        <input type="date" class="form-control" value="<?php echo set_value('toDT');  ?>" name="toDT"  id="toDT" >
                                                        <span style="color:red"><?php echo form_error('toDT');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                      </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Session List</h4>
                                        <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Class Name</th>
                                                <th class="thclass">Category Type</th>
                                                <th class="thclass">Month</th>
                                                <th class="thclass">vimeoId</th>
                                                <th class="thclass">Youtube Link</th>
                                                <th class="thclass">Assignment</th>
                                                <th class="thclass">View</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($listvideouploading){
                                                $i=1;
                                                foreach ($listvideouploading as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['catName']; ?></td>
                                                <td><?php echo $value['monthName']; ?></td>
                                                <td><?php if($value['vimeoId']==""){
                                                    echo "No Video Id Found";
                                                }else{
                                                    echo $value['vimeoId']; } ?></td>
                                                <td><a href="<?php echo $value['youtubelink']; ?>" target=_blank ><i style="font-size: 28px;" class="fab fa-youtube"></i></a></td>
                                                <td>
                                                    <a href="<?php echo base_url('uploads/contentfile/'.$value['contentfile']);?>" download=""><i style="font-size: 28px;" class="fas fa-file-archive"></i>  
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <?php

                                                        if($value['status']==1){ ?>
                                                            <a class="waves-effect waves-light" data-toggle="modal"  data-target="#myModal<?php echo $value['vidId'];?>" href="">View Days(<?php echo $value['fk_count_dayId']?>) <i class="mdi mdi-eye" style="font-size: x-large;    position: relative;top: 5px;"></i></a>
                                                            <?php } else { ?>
                                                         <a class="waves-effect waves-light" data-toggle="modal"  data-target="#myModal<?php echo $value['vidId'];?>" href="">View Days(<?php echo $value['fk_count_dayId']?>) <i class="mdi mdi-eye" style="font-size: x-large;    position: relative;top: 5px;"></i></a>
                                                            
                                                        <?php
                                                            } 

                                                     ?>
                                                         
                                                </td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('dashboard/edit_video/'.$value['vidId'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i>
                                                    </a>
                                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deletevideoId');?>">
                                                        <input type="hidden" value="<?php echo $value['vidId'];?>" name="vidId">
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
                        </div> <!-- end row -->

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->



     <?php if($listvideouploading){
            $i=1;
            foreach ($listvideouploading as $key => $values) { 
            ?> 
                <div id="myModal<?php echo $values['vidId'];?>" class="modal fade bs-example-modal-lg" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="width:126%;margin-left:-10%;">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myLargeModalLabel">All Sessions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                               <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Class Name</th>
                                                <th class="thclass">Category Type</th>
                                                <th class="thclass">Month</th>
                                                <th class="thclass">Lecture Name</th>
                                                <th class="thclass">Content Type</th>
                                                <th class="thclass">Session Name</th>
                                                <th class="thclass">vimeoId</th>
                                                <th class="thclass">Youtube Link</th>
                                                <th class="thclass">Assignment</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php 

                                               $listvideouploadings = listvideouploadings($values['fk_monthId']);
                                               if($listvideouploadings){
                                                $i=1;
                                                foreach ($listvideouploadings as $key => $value) { 
                                                   
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['catName']; ?></td>
                                                <td><?php echo $value['monthName']; ?></td>
                                                <td><?php echo $value['dayName']; ?></td>
                                                <td><?php echo $value['contnetName']; ?></td>
                                                <td><?php echo $value['sessionName']; ?></td>
                                                <td><?php if($value['vimeoId']==""){
                                                    echo "No Video Id Found";
                                                }else{
                                                    echo $value['vimeoId']; } ?></td>
                                                <td><a href="<?php echo $value['youtubelink']; ?>" target=_blank ><i style="font-size: 28px;" class="fab fa-youtube"></i></a></td>
                                                <td>
                                                    <a href="<?php echo base_url('uploads/contentfile/'.$value['contentfile']);?>" download=""><i style="font-size: 28px;" class="fas fa-file-archive"></i>
                                                    </a>
                                                </td>
                                                
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('dashboard/edit_video/'.$value['vidId'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i>
                                                    </a>
                                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deletevideoId');?>">
                                                        <input type="hidden" value="<?php echo $value['vidId'];?>" name="vidId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;position: relative;top: -38px;   margin-left: 19px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                               <?php }} ?> 
                                         
                                            </tbody>
                                        </table>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  
                </div>

            <?php 
            
              }
            
             } 

            ?>



                
              <?php $this->load->view('footer'); ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>

       <script type="text/javascript">
           $(document).ready(function() {


                $(".mdi-delete").click(function(){

                    var vidId =  $(this).attr('id');
                    $.ajax({
                        type:"POST",
                        data:{vidId:vidId},
                        url:"<?php echo base_url('dashboard/deletevideoId')?>",
                        success:function(res){

                            if(res==1){
                                swal({
                                      title: "Session Id is Deleted!",
                                      text: "You clicked the button!",
                                      icon: "success",
                                      button: "ok",
                                    });
                            }
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 2000);

                        },
                        error:function(error){
                            console.log(error);
                        }
                    })



                })
            } );

       </script>
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