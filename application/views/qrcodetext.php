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

                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <form method="POST" action="<?php echo base_url('QrController'); ?>">
												<h4>Generate Qr Code For Offers</h4>
											      <div class="col-md-4">
														<?php
														 $qrcode = "VEDICREF-".rand(000000,999999);
														 ?>
															<div class="form-group">
															    <label for="text">Auto Code Generation</label>
															    <input type="text" value="<?php echo $qrcode;?>" class="form-control" name="qrcodeNumber">
															    <span style="color:red"><?php echo form_error('qrcodeNumber');?></span>
														  	</div>
													</div>

													<div class="col-md-4">
														<div class="form-group">
															<label for="text">Enter Start Date </label>
															<input type="date" value="" class="form-control" name="qrcodeStartTime">
															<span style="color:red"><?php echo form_error('qrcodeStartTime');?></span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="text">Enter End Date </label>
															<input type="date" value="" class="form-control" name="qrcodeEndTime">
															<span style="color:red"><?php echo form_error('qrcodeEndTime');?></span>
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
                                        <h4 class="card-title">List of Qr code for offers</h4>
                                        <table id="datatable" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Qrcode</th>
                                                <th class="thclass">Start time</th>
                                                <th class="thclass">End time</th>
                                                <th class="thclass">Create Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($qrcodelist){
                                                $i=1;
                                                foreach ($qrcodelist as $key => $value) { 
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['qrcodeNumber']; ?></td>
                                                <td><?php echo $value['qrcodeStartTime']; ?></td>
                                                <td><?php echo $value['qrcodeEndTime']; ?></td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                   <!-- <a href="#"  style="font-size:25px;" id="<?php //echo $value['qrId'];?>" class="mdi mdi-delete" >
                                                   </a > --> 

                                                   <form class="" method="POST" onclick="return check();" action="<?php echo base_url('QrController/deleteqrId');?>">
                                                        <input type="hidden" value="<?php echo $value['qrId'];?>" name="qrId">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;position: relative;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    
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
                        url:"<?php echo base_url('QrController/deleteqrId')?>",
                        success:function(res){

                            if(res==1){
                                swal({
                                      title: "Qrcode Id is Deleted!",
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