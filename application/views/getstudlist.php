<?php
 $this->load->view('header');
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
                        <div class="card">
                              <div class="card-body">
                                  <h2>Search Student Here</h2>
                                  <a href="<?php echo base_url('dashboard/getstudlist');?>" style="float:right;top:-40px;position:relative;" class="btn btn-primary">Refresh</a>
                                  
                                <form method="POST" action="<?php echo base_url('dashboard/getstudlist'); ?>">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6">
                                            <div class="form-group">
                                                <label for="username"> Mobile Number</label>
                                                <input type="number" class="form-control" value="<?php echo set_value('studentMobile');  ?>" name="studentMobile" maxlength="10" id="studentMobile" placeholder="Enter  Mobile">
                                                <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="form-group">
                                                <label for="username"> Email Id</label>
                                                <input type="text" class="form-control" value="<?php echo set_value('studentEmail');  ?>" name="studentEmail"  id="studentEmail" placeholder="Enter  Email">
                                                <span style="color:red"><?php echo form_error('studentEmail');?></span>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="form-group">
                                                <label for="username"> from Date</label>
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
                           
                        <div class="row">
                            <div class="col-12">
                                <div class="card"  style="overflow-x: auto">
                                    <div class="card-body">
                                        <h4 class="card-title">Student List</h4>
                                        <table id="datatables" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Student Name</th>
                                                <th class="thclass">Student Email</th>
                                                <th class="thclass">Student Mobile</th>
                                                <th class="thclass">student Class</th>
                                                <th class="thclass">student Gender</th>
                                                <th class="thclass">Fee Receipt</th>
                                                <th class="thclass">Status</th>
                                               
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($getstudlist){
                                                $i=1;
                                                foreach ($getstudlist as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['studentName']; ?>
                                                <td><?php echo $value['studentEmail']; ?></td>
                                                <td><?php echo $value['studentMobile']; ?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['studentGender']; ?></td>
                                                <td>
                                                    <?php if(empty($value['paystatus'])){ echo "<span  style='font-family: emoji;color: #ef2100;font-size: inherit;font-weight: bolder;padding: 7px;top: 45px;position: relative;'>No Payment </span>"; } elseif($value['paystatus']=="success"){ echo "<span  style='font-family: emoji;color: #87f113;font-size: large;font-weight: bolder;padding: 7px;top: 45px;position: relative;'>".$value['paystatus']."</span>"; }else{ echo "<span style='font-family: emoji;color: #ff652a;font-size: inherit;font-weight: bolder;padding: 7px;top: 45px;position: relative;'>".$value['paystatus']."</span>"; } ?>

                                                     <a target="_blank" href="<?php echo base_url('dashboard/onboardedstudent/'.$value['studId'])?>"><img style="position: relative; width: 32px;height: 26px;top: 42px;" src="<?php echo base_url()?>/assets/images/receipt.gif"></a>
                                                        
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <?php

                                                        if($value['studentStatus']==1){

                                                            $status = "<span class='badge badge-sm bg-gradient-success'>Active</span>";

                                                            } else {

                                                            $status = "<span class='badge badge-sm bg-gradient-secondary'>De-Active</span>";
                                                        }
                                                         echo $status; 
                                                     ?>
                                                         
                                                     </td>
                                                
                                              
                                                <td>
                                                        <a href="<?php echo base_url('dashboard/edit/'.$value['studId'])?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i></a>
                                                        <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deletestudid');?>">
                                                        <input type="hidden" value="<?php echo $value['studId'];?>" name="studId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm p-0"><i style="font-size: 25px;position: relative;top: 0px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                        </form>                                                    
                                                        <a href="<?php echo base_url('dashboard/unlocksession/'.$value['studId'].'/'.$value['studentClass'])?>"><i style="font-size:25px;position:relative;top: -35px;margin-left: 59px;" class="fas fa-unlock-alt"></i></a>
                                                        
                                                        <?php if($value['studentStatus']==0){ ?>
                                                       
                                                        <form class="" method="POST" onclick="return checkstu();" action="<?php echo base_url('dashboard/activatestud');?>">
                                                        <input type="hidden" value="<?php echo $value['studId'];?>" name="studId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 25px;position: relative;top: -70px;   margin-left: 80px;color:#626ed4;" class="far fa-check-circle"></i></button>
                                                        </form>  
                                                        <?php } ?>
                                                        
                                                        <?php
                                                         if(empty($value['paystatus'])){ ?>
                                                            <a href="<?php echo base_url('dashboard/onboarding/'.$value['studId'].'/'.$value['studentClass'])?>" class="btn btn-sm btn-primary">Onbording Student</a> 
                                                        <?php }elseif($value['paystatus']=="success"){
                                                            echo "<span style='font-family: emoji;color: #87f113;font-size: inherit;font-weight: bolder;'> Payment ".$value['paystatus']."</span>"; 
                                                            }else{
                                                            
                                                        ?> <a href="<?php echo base_url('dashboard/onboarding/'.$value['studId'].'/'.$value['studentClass'])?>" class="btn btn-sm btn-primary">Onbording Student</a> 
                                                    <?php  } ?>

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

       <?php $this->load->view('footd');?>

       <script type="text/javascript">
       
        $(document).ready(function() {
         $('#datatables').dataTable( {
            "iDisplayLength": 10,
             "deferRender": true ,
             stateSave: true
         }
             );
         } );



           $(document).ready(function() {

                $(".mdi-delete").click(function(){

                    var studId =  $(this).attr('id');
                    $.ajax({
                        type:"POST",
                        data:{studId:studId},
                        url:"<?php echo base_url('dashboard/deletestudid')?>",
                        success:function(res){

                            if(res==1){
                                swal({
                                      title:"Student Id is Deleted!",
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
                    });
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
      
    //   setTimeout(function() {
    //                 window.location.href = '<?php echo base_url('dashboard/getstudlist')?>';
    //   }, 2000);
       
       
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
    
    function checkstu() {
        if(confirm("Are You Sure You Want Activate Student ? ")==true)
        {
            return true;
        }else{
            return false;
        }
    }
    
    
</script>