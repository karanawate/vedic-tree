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

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Notice List</h4>
                                        <table id="datatable" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Notice Desc</th>
                                                <th class="thclass">Status</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($getnoticelist){
                                                $i=1;
                                                foreach ($getnoticelist as $key => $value) { 
                                                ?> 
                                                <?php if($value['status']==1){ ?>
                                                 <input type="hidden" id="status<?php echo $value['notId'];?>" value="2">
                                             <?php }else{ ?>
                                                  <input type="hidden" id="status<?php echo $value['notId'];?>" value="1">
                                             <?php } ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><a class="waves-effect waves-light" data-toggle="modal"  data-target="#myModal<?php echo $value['notId'];?>" href="">View Notice <i class="mdi mdi-eye" style="font-size: x-large;    position: relative;top: 5px;"></i></a></td>
                                                <td>
                                                    <?php

                                                        if($value['status']==1){
                                                            $status = "Active";
                                                            $color = "badge badge-success";
                                                            $class = "mdi mdi-eye";
                                                            
                                                            } else {
                                                             $color="badge badge-warning"; 
                                                             $status = "De-Active";
                                                             $class = "mdi mdi-eye-off";
                                                             
                                                        }
                                                          
                                                     ?>

                                                         <span style="width:73px;font-size:12px;" class="<?php echo $color;?>"><?php echo $status;?></span>
                                                     </td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('dashboard/notedit/'.$value['notId'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i></a>
                                                        <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deletenotid');?>">
                                                        <input type="hidden" value="<?php echo $value['notId'];?>" name="notId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;position: relative;top: -38px;   margin-left: 19px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    
                                                    </form>
                                                    <?php if($value['status']==1){ ?>
                                                         <a href="#"><i class=" mdi-status <?php echo $class;?>" id="<?php echo $value['notId'];?>"  style="font-size:25px;position: relative;top: -78px;margin-left:60px;color:#626ed4;" ></i>
                                                            <input type="hidden" class="status<?php echo $value['notId']?>" value="2">
                                                         </a>
                                                     <?php }else{ ?>
                                                           <a href="#" ><i style="font-size:25px;position: relative;top:-78px;   margin-left:60px;color:#626ed4;" class="  mdi-status <?php echo $class;?>"  id="<?php echo $value['notId'];?>" ></i>
                                                            <input type="hidden" class="status<?php echo $value['notId']?>" value="1">
                                                           </a>
                                                     <?php } ?>

                                                       
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

                
              <?php $this->load->view('footer'); ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->


        <?php if($getnoticelist){
        $i=1;
        foreach ($getnoticelist as $key => $value) { 
        ?> 
            <div id="myModal<?php echo $value['notId'];?>" class="modal fade bs-example-modal-lg" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myLargeModalLabel">Notice Board</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                           <?php echo $value['noticedesc']?>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              
            </div>

        <?php 
        
          }
        
         } 

        ?>

       <?php $this->load->view('footd');?>

       <script type="text/javascript">
           $(document).ready(function() {

                $(".mdi-delete").click(function(){

                    var notId =  $(this).attr('id');

                    $.ajax({
                        type:"POST",
                        data:{notId:notId},
                        url:"<?php echo base_url('dashboard/deletenotid')?>",
                        success:function(res){

                            if(res==1){
                                swal({
                                      title: "Notice is Deleted!",
                                      text: "You clicked the button!",
                                      icon: "success",
                                      button: "ok",
                                    });
                            }
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 5000);

                        },
                        error:function(error){
                            console.log(error);
                        }
                    })



                });



                 $(".mdi-status").click(function(){

                    var notId =  $(this).attr('id');
                     var status =  $(".status"+notId).val();
                     
                    $.ajax({
                        type:"POST",
                        data:{notId:notId,status:status},
                        url:"<?php echo base_url('dashboard/change_status')?>",
                        success:function(res){

                            if(res==1){
                                swal({
                                      title: "Status is Changed!",
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



                });



            } );

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
