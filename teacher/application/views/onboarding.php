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
                                        <h4 class="card-title">On Board Student</h4>
                                        <div class="col-lg-6">
                                            <?php 


                                            if($get_studentid){

                                                $studentEmail   = $get_studentid[0]['studentEmail'];
                                                $usr_firstname  = $get_studentid[0]['usr_firstname'];
                                                $usr_lastname   = $get_studentid[0]['usr_lastname'];
                                                $studentMobile  = $get_studentid[0]['studentMobile'];
                                            }else{

                                                $studentEmail   = "";
                                                $usr_firstname  = "";
                                                $usr_lastname   = "";
                                                $studentMobile  = "";

                                            }
                                            ?>
                                            <form class="" enctype="multipart/form-data" method="post" action="<?php echo base_url('dashboard/onboarding');?>">
                                                <input type="hidden" name="studId" value="<?php echo $studId;?>">
                                                <input type="hidden" name="fk_classId" value="<?php echo $fk_classId;?>">
                                                <div class="outer">
                                                    <div data-repeater-item class="outer">
                                                        
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <input type="text" class="form-control" name="usr_firstname" value="<?php echo $usr_firstname; ?>" placeholder="Enter First Name ">
                                                            <span style="color:red"><?php echo form_error('usr_firstname'); ?></span>
                                                        </div>

                                                         <div class="form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" class="form-control" name="usr_lastname" value="<?php echo $usr_lastname; ?>" placeholder="Enter last Name ">
                                                            <span style="color:red"><?php echo form_error('usr_lastname'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Student Register Email</label>
                                                            <input type="text" class="form-control" name="usr_email" value="<?php echo $studentEmail; ?>" placeholder="Enter Email">
                                                            <span style="color:red"><?php echo form_error('usr_email'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Student Mobile Number</label>
                                                            <input type="text" class="form-control" name="usr_mobile_no"  value="<?php echo $studentMobile; ?>" placeholder="Enter Mobile Number">
                                                            <span style="color:red"><?php echo form_error('usr_mobile_no'); ?></span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Select Package Name</label>
                                                            <select class="form-control fk_catId" name="planId" >
                                                                <option value="">Select Package Name</option>
                                                                <?php
                                                                 if($list_Fees){
                                                                    foreach ($list_Fees as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['feesId']?>"><?php echo $value['packageName']?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('planId'); ?></span>
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
                                                            <label for="formemail">Payment Type </label>
                                                            <select class="form-control fk_contentId" name="paymentType" >
                                                                <option value="">Payment Type</option>
                                                                  <option value="1">Direct Payment</option>
                                                                  <option value="2">Emi </option>
                                                                  <option value="3">Offline </option>
                                                              
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('paymentType'); ?></span>
                                                        </div>

                                                        <div class="form-group showfile" style="display:none">
                                                            <label>Pay Amount</label>
                                                            <input type="text" class="form-control" name="payAmount"  value="<?php echo set_value('payAmount'); ?>" maxlength="5" placeholder="Enter Amount">
                                                            <span style="color:red"><?php echo form_error('payAmount'); ?></span>
                                                        </div>

                                                        <div class="form-group"  >
                                                            <div class="form-group">
                                                                <label>Fee Reciept Image </label>
                                                                <input type="file" name="Receiptpic" class="filestyle">
                                                            </div>
                                                            <span style="color:red"><?php if(isset($Receiptpic['error'])){ echo $Receiptpic['error']; } ?></span>
                                                           <p> <span style="color:red"><?php echo validation_errors(); ?></span></p>
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
                    window.location.href = '<?php echo base_url('dashboard/getstudlist')?>';
       }, 2000);

          </script>



        <?php } ?>


<script type="text/javascript">
           $(document).ready(function() {

            $(".fk_contentId").change(function(){
                var fk_contentId = $(this).val();
                // alert(fk_contentId);
                if(fk_contentId==3){
                    $(".showfile").show();
                }else{
                    $(".showfile").hide();
                   
                }
            });

            });

       </script>
