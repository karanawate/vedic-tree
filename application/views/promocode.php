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
                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <form method="POST" action="<?php echo base_url('dashboard/promocode'); ?>">
												<h4>Generate Promo Code For Offers</h4>
											      <div class="col-md-4">
															<div class="form-group">
															    <label for="text">User Name</label>
															    <input type="text" value="" class="form-control" name="UserName" placeholder="Enter User Name">
															    <span style="color:red"><?php echo form_error('UserName');?></span>
														  	</div>
													</div>
													<div class="col-md-4">
															<div class="form-group">
															    <label for="text">Auto Promo Generation</label>
															    <input type="text" value="" class="form-control" name="promoCode" placeholder="Enter Promo Code">
															    <span style="color:red"><?php echo form_error('promoCode');?></span>
														  	</div>
													</div>
													<div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="text">Start Date</label>
                                                                <input type="date" value="" class="form-control" name="startDate" placeholder="Enter Promo Code">
                                                                <span style="color:red"><?php echo form_error('startDate');?></span>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="text">End Date</label>
                                                                <input type="date" value="" class="form-control" name="endDate" placeholder="Enter Promo Code">
                                                                <span style="color:red"><?php echo form_error('endDate');?></span>
                                                            </div>
                                                    </div>
                                                    <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Submit</button>
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
                                        <h4 class="card-title">List of Promo code </h4>
                                        <table id="datatable" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">User Name</th>
                                                <th class="thclass">Promo Code</th>
                                               <th class="thclass">Start Date</th>
                                                <th class="thclass">End Date</th>
                                                <th class="thclass">Status</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($promocodelist){
                                                $i=1;
                                                foreach ($promocodelist as $key => $value) { 
                                                    
                                                    
                                                    if($value['status']==1){
                                                            $status = "Active";
                                                            $color = "badge badge-success";
                                                            $class = "mdi mdi-eye";
                                                            $statusVal = 2;
                                                            } else {
                                                             $color="badge badge-warning"; 
                                                             $status = "De-Active";
                                                             $class = "mdi mdi-eye-off";
                                                             $statusVal = 1;
                                                             
                                                        }
                                                        
                                                        
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['UserName'];?></td>
                                                 <td>
                                                      <input type="text" id="myInput<?php echo $value['pmId'];?>" value="<?php echo $value['promoCode']; ?>" readonly="" class="form-control"> 
                                                      <button class="btn btn-primary" onclick="myFunction('<?php echo $value['pmId'];?>')">Copy text</button>
                                                 </td>
                                                <td><?php echo $value['startDate']; ?></td>
                                                <td><?php echo $value['endDate']; ?></td>
                                                <td> <span style="width:73px;font-size:12px;" class="<?php echo $color;?>"><?php echo $status;?></span> </td>
                                                <td>
                                                   <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deletepromoId');?>">
                                                        <input type="hidden" value="<?php echo $value['pmId'];?>" name="pmId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;position: relative;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    </form>
                                                    <form class="" method="POST" onclick="return checkpromoStatus();" action="<?php echo base_url('dashboard/statusChangedPromo');?>">
                                                        <input type="hidden" value="<?php echo $value['pmId'];?>" name="pmId">
                                                        <input type="hidden" value="<?php echo $statusVal;?>" name="status">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;position: relative;color:#626ed4;" class="<?php echo $class; ?>"></i></button>
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

		  </script>

		<?php } ?>

       <script type="text/javascript">
           $(document).ready(function() {

                $(".mdi-delete").click(function(){
                    var qrId =  $(this).attr('id');
                    $.ajax({
                        type:"POST",
                        data:{qrId:qrId},
                        url:"<?php echo base_url('dashboard/deletepromoId')?>",
                        success:function(res){

                            if(res==1){
                                swal({
                                      title: "Promo Code Id is Deleted!",
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
    
function myFunction(elementval) {
  var copyText = $("#myInput"+elementval).select();
  copyText = copyText.val();
  document.execCommand("copy");
  alert("Copied the text: " + copyText);
}

</script>