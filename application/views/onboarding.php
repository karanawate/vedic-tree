<?php
 $this->load->view('header');
 $monthdata =  required_data_admin();

?>
<style type="text/css">
    .thclass{
        width:400px;
    }
    table {
        border: 1px solid #777;
        border-collapse: collapse;
    } 

    table tr th,
    table tr td {
        border: 1px solid #777;
        width: 212px;
    }
    .disabled {
    pointer-events:none; /* No cursor */
    background-color: #eee; /* Gray background */
   }
    </style>
</style>

        <div id="layout-wrapper">
            <?php $this->load->view('topbar'); ?>
            <?php $this->load->view('sidebar'); ?>
            <div class="main-content mdi-onbording">
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body ">
                                        <h4 class="card-title">On Board Student</h4>
                                        <div class="col-lg-6">
                                            <?php 
                                           
                                            if($get_studentid){

                                                $studentEmail   = $get_studentid[0]['studentEmail'];
                                                $usr_firstname  = $get_studentid[0]['usr_firstname'];
                                                $usr_lastname   = $get_studentid[0]['usr_lastname'];
                                                $studentMobile  = $get_studentid[0]['studentMobile'];
                                                $studentName    = $get_studentid[0]['studentName'];
                                            }else{

                                                $studentEmail   = "";
                                                $usr_firstname  = "";
                                                $usr_lastname   = "";
                                                $studentMobile  = "";
                                                $studentName  = "";

                                            }
                                              $total_paid = 0;
                                              if($paiduntil)
                                              {
                                                $totals = array();
                                                foreach ($paiduntil as $key => $value) {
                                                    $totals[] = $value['payAmount'];

                                                }
                                                $total_paid = round(array_sum($totals));
                                              }
                                            ?>
                                              
                                        <?php
                                       
                                            if(empty($paiduntil)){
                                              
                                        ?>      
                                            <form class="" enctype="multipart/form-data" method="post" action="<?php echo base_url('dashboard/onboarding');?>">
                                                <input type="hidden" name="studId" id="student_id" value="<?php echo $studId;?>">
                                                <input type="hidden" name="fk_classId" value="<?php echo $fk_classId;?>">
                                              
                                                <?php if($get_reciept_idwise > 0) {?>
                                                <input type="hidden" name="reciept_no" value="<?php echo $get_reciept_idwise[0]['logId'] ?>">
                                                <?php }else {  ?>
                                                    <input type="hidden" name="reciept_no" value="<?php echo 0; ?>">
                                                <?php } ?>
                                                
                                                <div class="outer">
                                                    <div data-repeater-item class="outer">
                                                    <?php 
                                                  
                                                         $firstName     = substr($studentName, 0, strpos($studentName, ' ')); 
                                                         $lastName      = substr($studentName, strpos($studentName, " ") + 0);
                                                     ?>
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <input type="text" class="form-control" name="usr_firstname"  value="<?php echo $firstName; ?>" placeholder="Enter First Name ">
                                                            <span style="color:red"><?php echo form_error('usr_firstname'); ?></span>
                                                        </div>

                                                         <div class="form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" class="form-control" name="usr_lastname" value="<?php echo $lastName?>"  placeholder="Enter last Name ">
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

                                                        <?php if($selected_by_package) { ?>        
                                                                <div class="form-group">
                                                                <label>Select Package Name</label>
                                                                <select  class="form-control fk_catId disabled"  value="echo $selected_by_package['0']['feesId'];"  name="planId" id = select_option >
                                                                        <?php  if($selected_by_package)
                                                                         
                                                                            {?>
                                                                            <option  value="<?php echo  $selected_by_package['0']['feesId']; ?>"><?php echo $selected_by_package['0']['packageName']; ?></option>

                                                                        <?php   }  ?>          
                                                                    <option value="">Select Package Name</option>
                                                                    <?php
                                                                        
                                                                        if($list_Fees_packagewise){
                                                                        foreach ($list_Fees_packagewise as $key => $value) {
                                                                        ?>
                                                                    <option value="<?php echo $value['feesId']?>"><?php echo $value['packageName']?></option>
                                                                    <?php }} ?>
                                                                </select>
                                                                <span style="color:red"><?php echo form_error('planId'); ?></span>
                                                            </div>
                                                       <?php  } 
                                                        else
                                                        {?>
                                                          
                                                                <div class="form-group">
                                                                <label>Select Package Namee</label>
                                                                <select class="form-control fk_catId"  value="echo $selected_by_package['0']['feesId'];"  name="planId" id = select_option >
                                                                <?php  ?>
                                                                        <?php  if($selected_by_package)
                                                                        {?>
                                                                            <option  value="<?php echo  $selected_by_package['0']['feesId']; ?>"><?php echo $selected_by_package['0']['packageName']; ?></option>

                                                                        <?php   }  ?>
                                                                        
                                                                    <option value="">Select Package Name</option>
                                                                    <?php
                                                                  
                                                                    if($list_Fees_packagewise){
                                                                        foreach ($list_Fees_packagewise as $key => $value) {
                                                                    ?>
                                                                    <option value="<?php echo $value['feesId']?>"><?php echo $value['packageName']?></option>
                                                                    <?php }} ?>
                                                                </select>
                                                                <span style="color:red"><?php echo form_error('planId'); ?></span>
                                                            </div>
                                                     <?php } ?>
                                                       

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
                                                            <label>Parent's Name</label>
                                                            <input type="text" class="form-control" name="parents_name"   placeholder="Enter Parents name">
                                                        </div>
                                                      
                                                        <!-- payment Mode-->
                                                        <div class="form-group">
                                                            <label for="formemail">Payment Mode </label>
                                                            <select class="form-control fk_contentId" name="paymentMode" id="paymentselector" >
                                                                <option value="">Payment Mode</option>
                                                                   <option value="4">Cheque</option>
                                                                   <option value="5">online-payment</option>
                                                                   <option value="6">Cash</option>
                                                                   <option value="7">Cash/onlinePayment</option>
                                                                   
                                                                  
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('paymentMode'); ?></span>
                                                        </div>
                                                        
                                                        <!--check start-->
                                                        <div id="4" class="colors" style="display:none">
                                                            <div class="form-group">
                                                              <label>Cheque No</label>
                                                              <input type="text" class="form-control" name="check_number" Placeholder="Enter Cheque No" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Bank Name</label>
                                                              <input type="text" class="form-control" name="bank_name" Placeholder="Enter Bank Name" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Cheque Dated</label>
                                                              <input type="date" class="form-control" name="check_dated"  Placeholder="Enter Cheque Date" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Branch Name</label>
                                                              <input type="text" class="form-control" name="branch_name"  Placeholder="Enter Branch Name" />
                                                           </div>
                                                            
                                                       </div>
                                                       <!--check end-->
                                                       
                                                        <!--online  payment-->
                                                        <div id="5" class="colors" style="display:none">
                                                            <div class="form-group">
                                                              <label>Date</label>
                                                              <input type="date" class="form-control" name="tran_online_date" Placeholder="Enter Date" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Transaction no</label>
                                                              <input type="text" class="form-control" name="transaction_no"  Placeholder="Enter Transaction No" />
                                                           </div>
                                                       </div>
                                                       
                                                       <!--online  payment-->
                                                       
                                                       
                                                       <!--online  payment-->
                                                        <div id="7" class="colors" style="display:none">
                                                            <div class="form-group">
                                                              <label>Date</label>
                                                              <input type="date" class="form-control" name="tran_online_date" Placeholder="Enter Date" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Transaction no</label>
                                                              <input type="text" class="form-control" name="transaction_no"  Placeholder="Enter Transaction No" />
                                                           </div>
                                                       </div>
                                                       
                                                       <!--online  payment-->
                                                       
                                                       
                                                        


                                                        <table id="datatables" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th class="thclass">#Id</th>
                                                    <th class="thclass">First Name</th>
                                                    <th class="thclass">Last Name</th>
                                                    <th class="thclass">Student Mobile</th>
                                                    <th class="thclass">Amount</th>
                                                    <th class="thclass">Date</th>
                                                </tr>
                                                </thead>  
                                                <tbody>
                                                <?php 
                                                
                                                $total = array();
                                                $discount = array();
                                                if($paiduntil){
                                                    $i=1;
                                                    foreach ($paiduntil as $key => $value) { 
                                                        // echo "<pre>";
                                                        // print_r($value);
                                                        $total[] = $value['payAmount'];
                                                        $discount[] = $value['discount'];
                                                    ?> 
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo $value['usr_firstname']; ?></td>
                                                    <td><?php echo $value['usr_lastname']; ?></td>
                                                    <td><?php echo $value['usr_mobile_no']; ?></td>
                                                    <td><?php echo $value['payAmount']; ?></td>
                                                    <td><?php echo $value['createDT']; ?></td>
                                                    
                                                    
                                                </tr>
                                                <?php }} ?> 
                                                        <tr>
                                                        <td>Paid Untill Now</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php echo $res  = array_sum($total); ?></td>

                                                        </tr>

                                                        <tr>
                                                        <td>Remaining</td>
                                                     
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php if($checkremaining_amount=="")
                                                        {
                                                            echo "0";

                                                        }else{

                                                            $discountAmt = round(array_sum($discount));
                                                            echo $checkremaining_amount - $discountAmt ;  } ?>
                                                        </td>
                                                        <tr>
                                                        <td>Discount</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        
                                                        <td>
                                                        <?php if($discount)  { ?>
                                                        <?php echo round(array_sum($discount)); 
                                                            }else{ echo "0"; }
                                                        ?>
                                                        </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                                
                                                  <div class="form-group">
                                                            <label for="formemail">Payment Type </label>
                                                            <select class="form-control fk_contentId" name="paymentType">
                                                                <option value="">Payment Type</option>
                                                                  <option id="offline_btn" value="3">Offline </option>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('paymentType'); ?></span>
                                                </div>
 
                                                <div class="form-group showfile">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                
                                                            </div>
                                                            <div id="datalist"></div>
                                                            <label>Pay Amount</label>
                                                            <input type="text" class="form-control" name="payAmount"  value="<?php echo set_value('payAmount'); ?>"  placeholder="Enter Amount">
                                                            <span style="color:red"><?php echo form_error('payAmount'); ?></span>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label>Discount</label>
                                                            <input type="text" class="form-control" name="discount"  value="<?php echo set_value('discount'); ?>" placeholder="Enter discount">
                                                            <span style="color:red"><?php echo form_error('discount'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Remark </label>
                                                            <input type="text" class="form-control" name="remarkReceipt"  value="<?php echo set_value('payAmount'); ?>" placeholder="Enter Remark">
                                                            <span style="color:red"><?php echo form_error('remarkReceipt'); ?></span>
                                                        </div>
                                                        <!-- promo code -->
                                                            <div class="form-group">
                                                                <label>Enter Promo Code </label>
                                                                <input type="text" id="promoCode" value="" class="form-control" name="promoCode" placeholder="Enter Promo Code">
                                                                <span style="color:red"><?php echo form_error('promoCode');?></span>
                                                                <span  id="promoCodeErr"></span>
                                                            </div>
                                                       
                                                        <div class="form-group"  >
                                                            <div class="form-group">
                                                                <label>Fee Reciept Image </label>
                                                                <input type="file" name="Receiptpic" class="filestyle" >
                                                            </div>
                                                            <span style="color:red"><?php if(isset($Receiptpic['error'])){ echo $Receiptpic['error']; } ?></span>
                                                           <p> <span style="color:red"><?php echo validation_errors(); ?></span></p>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                                <label>Enter Adjust Amount </label>
                                                                <input type="text" id="fk_adjustedAmount" value="" class="form-control" name="fk_adjustedAmount" placeholder="Enter Adjust Amount">
                                                                <span style="color:red"><?php echo form_error('fk_adjustedAmount');?></span>
                                                                <span  id="fk_adjustedAmount"></span>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                                <label>Enter Adjust Remark </label>
                                                                <input type="text" id="fk_adjustedRemark" value="" class="form-control" name="fk_adjustedRemark" placeholder="Enter Adjust Remark">
                                                                <span style="color:red"><?php echo form_error('fk_adjustedRemark');?></span>
                                                                <span  id="fk_adjustedRemark"></span>
                                                        </div>
                                                         <div class="form-group">
                                                            <label for="formemail">Select Course Period ( Optional )</label>
                                                            <select class="form-control " name="fk_coursePeriod" >
                                                                <option value="">Select Course</option>
                                                                  <option value="3">3</option>
                                                                  <option value="7">7</option>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_coursePeriod'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                                <label>Enter Roundof Amount </label>
                                                                <input type="text" id="roundOff" value="" class="form-control" name="roundOff" placeholder="Enter RoundOff Amount">
                                                                <span style="color:red"><?php echo form_error('roundOff');?></span>
                                                                <span  id="roundOff"></span>
                                                        </div>
                                                        
                                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php }else{  ?>

                                            <form class="" enctype="multipart/form-data" method="post" action="<?php echo base_url('dashboard/onboarding');?>">
                                                <input type="hidden" name="studId" id="student_id" value="<?php echo $studId;?>">
                                                <input type="hidden" name="fk_classId" value="<?php echo $fk_classId;?>">
                                                <?php if($get_reciept_idwise > 0) {?>
                                                <input type="hidden" name="reciept_no" value="<?php echo $get_reciept_idwise[0]['logId'] ?>">
                                                <?php }else {  ?>
                                                    <input type="hidden" name="reciept_no" value="<?php echo 0; ?>">
                                                <?php } ?>
                                                <div class="outer">
                                                    <div data-repeater-item class="outer">
                                                        

                                                    <?php  if($selected_by_package)
                                                    {?>
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <input type="text" class="form-control disabled" name="usr_firstname"  value="<?php echo $selected_by_package['0']['usr_firstname']; ?>" placeholder="Enter First Name ">
                                                            <span style="color:red"><?php echo form_error('usr_firstname'); ?></span>
                                                        </div>
                                                        <?php } else { ?>
                                                            <div class="form-group">
                                                            <label>Full Name</label>
                                                            <input type="text" class="form-control" name="usr_firstname" value="<?php echo isset($value_payment_log_data['0']->usr_firstname) ?  $value_payment_log_data['0']->usr_firstname: '' ;  ?>" placeholder="Enter First Name ">
                                                            <span style="color:red"><?php echo form_error('usr_firstname'); ?></span>
                                                        </div>
                                                        <?php } ?>

                                                        <?php  if($selected_by_package)
                                                       {?>
                                                       
                                                         <div class="form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" class="form-control disabled" name="usr_lastname" value="<?php echo $selected_by_package['0']['usr_lastname']; ?>" placeholder="Enter last Name ">
                                                            <span style="color:red"><?php echo form_error('usr_lastname'); ?></span>
                                                        </div>
                                                        <?php } else { ?>
                                                            <label>Last Name</label>
                                                            <input type="text" class="form-control" name="usr_lastname" value="<?php echo isset($value_payment_log_data['0']->usr_lastname) ?  $value_payment_log_data['0']->usr_lastname: '' ;  ?>" placeholder="Enter last Name ">
                                                            <span style="color:red"><?php echo form_error('usr_lastname'); ?></span>
                                                            <?php } ?> 

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
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <?php if($paiduntil){ ?>
                                                        
                                                        <!-- payment Mode-->
                                                        <div class="form-group">
                                                            <label for="formemail">Payment Mode </label>
                                                            <select class="form-control fk_contentId" name="paymentMode" id="paymentselector" >
                                                                <option value="">Payment Mode</option>
                                                                   <option value="4">Cheque</option>
                                                                   <option value="5">online-payment</option>
                                                                   <option value="6">Cash</option>
                                                                   <option value="7">Cash/onlinePayment</option>
                                                                  
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('paymentMode'); ?></span>
                                                        </div>
                                                        
                                                        <!--check start-->
                                                        <div id="4" class="colors" style="display:none">
                                                            <div class="form-group">
                                                              <label>Cheque No</label>
                                                              <input type="text" class="form-control" name="check_number" Placeholder="Enter Cheque No" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Bank Name</label>
                                                              <input type="text" class="form-control" name="bank_name" Placeholder="Enter Bank Name" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Cheque Dated</label>
                                                              <input type="date" class="form-control" name="check_dated"  Placeholder="Enter Cheque Date" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Branch Name</label>
                                                              <input type="text" class="form-control" name="branch_name"  Placeholder="Enter Branch Name" />
                                                           </div>
                                                            
                                                       </div>
                                                       <!--check end-->
                                                       
                                                        <!--online  payment-->
                                                        <div id="5" class="colors" style="display:none">
                                                            <div class="form-group">
                                                              <label>Date</label>
                                                              <input type="date" class="form-control" name="tran_online_date" Placeholder="Enter Date" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Transaction no</label>
                                                              <input type="text" class="form-control" name="transaction_no"  Placeholder="Enter Transaction No" />
                                                           </div>
                                                       </div>
                                                       
                                                       <!--online  payment-->
                                                       
                                                       
                                                       <!--online  payment-->
                                                        <div id="7" class="colors" style="display:none">
                                                            <div class="form-group">
                                                              <label>Date</label>
                                                              <input type="date" class="form-control" name="tran_online_date" Placeholder="Enter Date" />
                                                           </div>
                                                           
                                                            <div class="form-group">
                                                              <label>Transaction no</label>
                                                              <input type="text" class="form-control" name="transaction_no"  Placeholder="Enter Transaction No" />
                                                           </div>
                                                       </div>
                                                       
                                                       <!--online  payment-->
                                                       <?php  } ?>
                                                       
                                                       
                                                          <div class="form-group">
                                                            <label>Parent's Name</label>
                                                            <input type="text" class="form-control" name="parents_name"   placeholder="Enter Parents name">
                                                          </div>
                                                       
                                                       
                                                       
                                                        <!-- <div class="form-group">
                                                            <label>Select Package Name</label>
                                                            <select class="form-control fk_catId" name="planId" id = select_option >
                                                                <option value="">Select Package Name</option>
                                                                <?php
                                                                 if($list_Fees){
                                                                    foreach ($list_Fees as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value['feesId']?>"><?php echo $value['packageName']?></option>
                                                                <?php }} ?>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('planId'); ?></span>
                                                        </div> -->
                                                                      
                                                        <?php if($selected_by_package) { ?>        
                                                                <div class="form-group">
                                                                <label>Select Package Name</label>
                                                                <select  class="form-control fk_catId disabled"  value="echo $selected_by_package['0']['feesId'];"  name="planId" id = select_option>
                                                                        <?php  if($selected_by_package)
                                                                            {?>
                                                                            <option  value="<?php echo  $selected_by_package['0']['feesId']; ?>"><?php echo $selected_by_package['0']['packageName']; ?></option>

                                                                        <?php   }  ?>          
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
                                                       <?php  } 
                                                        else
                                                        {?>
                                                            
                                                                <div class="form-group">
                                                                <label>Select Package Name</label>
                                                                <select class="form-control fk_catId"  value="echo $selected_by_package['0']['feesId'];"  name="planId" id = select_option >
                                                                        <?php  if($selected_by_package)
                                                                        {?>
                                                                            <option  value="<?php echo  $selected_by_package['0']['feesId']; ?>"><?php echo $selected_by_package['0']['packageName']; ?></option>

                                                                        <?php   }  ?>
                                                                        
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
                                                     <?php } ?>
                                                       

                                                        <div class="form-group">
                                                            <label for="formemail">Select Monthttt</label>
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

                                                        <table id="datatables" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th class="thclass">#Reciept_no</th>
                                                    <th class="thclass">Full Name</th>
                                                    <th class="thclass">Remark</th>
                                                    <th class="thclass">Selected Month</th>
                                                    <th class="thclass">Student Mobile</th>
                                                    <th class="thclass">Amount</th>
                                                    <th class="thclass">Payment Status</th>
                                                    <th class="thclass">Fees Status</th>
                                                    <th class="thclass">Date</th>
                                                </tr>
                                                </thead>  
                                                <tbody>
                                                <?php 
                                                
                                                $total = array();
                                                $discount = array();
                                                $discountAmt = 0;
                                                 //India time (GMT+5:30)               
                                                date_default_timezone_set("Asia/Calcutta");   
                                                 $dateformat = date('Y-');
                                                 $dateformat_increment = date('y') + 1;
                                                if($paiduntil){
                                                    $i=1;
                                                    foreach ($paiduntil as $key => $value) { 
                                                        // echo "<pre>";
                                                        // print_r($value);
                                                        $total[] = $value['payAmount'];
                                                        $discount[] = $value['discount'];
                                                    ?> 
                                                <tr>
                                                    <td><?php echo "VT".$dateformat.$dateformat_increment."/"."00".$value['reciept_no'];?></td>
                                                    <td><?php echo $value['usr_firstname']; ?></td>
                                                    
                                                    <td><?php echo $value['remarkReceipt']; ?></td>   
                                                    <td><?php echo $value['monthName']; ?></td>   
                                                    <td><?php echo $value['usr_mobile_no']; ?></td>
                                                    <td><?php echo $value['payAmount']; ?></td>
                                                    <td>
                                                    <?php

                                                    if($value['paystatusId']==3)
                                                    {
                                                        echo "<span style='color:green'>Approved</span>";
                                                      }else{
                                                        echo "<span style='color:red'>Not Approved";
                                                    }
                                                    ?>
                                                    </td>
                                                    <td>
                                                    <?php 
                                                        if($value['paymentType']==3) 
                                                         {

                                                        ?>    
                                                            <a target="_blank" href="<?php echo base_url('uploads/Receiptpic/'.$value['Receiptpic']);?>"><img style="position: relative; width: 50px;height: 50px;" src="<?php echo base_url()?>/assets/images/receipt.gif"></a>
                                                        <?php } else { ?>

                                                           <a target="_blank" href="<?php echo base_url('uploads/Receiptpic/'.$value['Receiptpic']);?>"><img style="position: relative;width: 50px;height: 50px;" src="<?php echo base_url()?>/assets/images/receipt.gif"></a>
                                                            
                                                         <?php
                                                                }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $value['logpaymentDT']; ?></td>
                                                    
                                                    
                                                    
                                                    
                                                </tr>
                                                <?php }} ?> 
                                                        <tr>
                                                        <td>Paid Untill Now</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php echo $res  = array_sum($total); ?></td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        </tr>

                                                        <tr>
                                                        <td>Package Amount</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><?php 
                                                       
                                                            echo $checkremaining_amount;
                                                          
                                                            
                                                            ?>
                                                        </td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <tr>
                                                        <td>Discount</td>
                                                        <td></td>
                                                        <td></td>
                                                        
                                                        <td></td>
                                                        
                                                        <td>
                                                        <?php if($discount)  { ?>
                                                        <?php echo round(array_sum($discount)); 
                                                            }else{ echo "0"; }
                                                        ?>
                                                        </td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        </tr>

                                                        <tr>
                                                        <td>Total Paid</td>
                                                        <td></td>
                                                        <td></td>
                                                        
                                                        <td></td>
                                                        
                                                        <td>
                                                       
                                                        <?php 
                                                        
                                                        $discountss = round(array_sum($discount));
                                                        
                                                        $totalamt = $res + $discountss;
                                                        echo  $totalamt;
                                                        
                                                
                                                          
                                                        ?>
                                                        </td>
                                                        <td>Remaining</td>
                                                        <input type="hidden" class="remainamt" value="<?php echo $checkremaining_amount - $totalamt;?>">
                                                        <td><?php echo $value_total = $checkremaining_amount - $totalamt; ?>
                                                            
                                                        </td>
                                                        </tr>

                                        

                                                    </tbody>
                                                </table>
                                                
                                                <div class="form-group">
                                                            <label for="formemail">Payment Type </label>
                                                            <select class="form-control fk_contentId" name="paymentType" >
                                                                <option value="">Payment Typee</option>
                                                                  
                                                                  <option id="offline_btn" value="3">Offline </option>
                                                                  
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('paymentType'); ?></span>
                                                        </div>
                                                        
                                                        
                                                        

                                                       

                                                <div class="form-group showfile">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                
                                                            </div>
                                                            <div id="datalist"></div>
                                                            <label>Pay Amount</label>
                                                            <input type="text" id="payAmount" class="form-control" name="payAmount"  value="<?php echo set_value('payAmount'); ?>"  placeholder="Enter Amount">
                                                            <span style="color:red"><?php echo form_error('payAmount'); ?></span>
                                                            <span id="error" style="color:red"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Discount</label>
                                                            <input type="text" class="form-control" name="discount"  value="<?php echo set_value('discount'); ?>" placeholder="Enter discount">
                                                            <span style="color:red"><?php echo form_error('discount'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Remark </label>
                                                            <input type="text" class="form-control" name="remarkReceipt"  value="<?php echo set_value('payAmount'); ?>" placeholder="Enter Remark">
                                                            <span style="color:red"><?php echo form_error('remarkReceipt'); ?></span>
                                                        </div>
                                                         <div class="form-group">
                                                                <label>Enter Promo Code </label>
                                                                <input type="text" id="promoCode" value="" class="form-control" name="promoCode" placeholder="Enter Promo Code">
                                                                <span style="color:red"><?php echo form_error('promoCode');?></span>
                                                                <span  id="promoCodeErr"></span>
                                                        </div>
                                                        <div class="form-group">
                                                                <label>Enter Adjust Amount </label>
                                                                <input type="text" id="fk_adjustedAmount" value="" class="form-control" name="fk_adjustedAmount" placeholder="Enter Adjust Amount">
                                                                <span style="color:red"><?php echo form_error('fk_adjustedAmount');?></span>
                                                                <span  id="fk_adjustedAmount"></span>
                                                        </div>
                                                        <div class="form-group">
                                                                <label>Enter RoundOff amount </label>
                                                                <input type="text" id="roundOff" value="<?php echo $selected_by_package[0]['roundOff'] ?>" class="form-control"   name="roundOff" >
                                                                <span style="color:red"><?php echo form_error('roundOff');?></span>
                                                                <span  id="fk_adjustedAmount"></span>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                                <label>Enter Adjust Remark </label>
                                                                <input type="text" id="fk_adjustedRemark" value="" class="form-control" name="fk_adjustedRemark" placeholder="Enter Adjust Remark">
                                                                <span style="color:red"><?php echo form_error('fk_adjustedRemark');?></span>
                                                                <span  id="fk_adjustedRemark"></span>
                                                        </div>
                                                        
                                                        <?php if($selected_by_package['0']['feesId'] == 17 || $selected_by_package['0']['feesId'] == 18 || $selected_by_package['0']['feesId'] == 19 ){ ?>
                                                         <div class="form-group">
                                                            <label for="formemail">Select Course Period ( Optional )</label>
                                                            <select class="form-control " name="fk_coursePeriod" >
                                                                <option value="">Select Course</option>
                                                                  <option value="3">3</option>
                                                                  <option value="7">7</option>
                                                            </select>
                                                            <span style="color:red"><?php echo form_error('fk_coursePeriod'); ?></span>
                                                        </div>
                                                        <?php }else{ ?>
                                                            
                                                        <?php }?>

                                                        <div class="form-group"  >
                                                            <div class="form-group">
                                                                <label>Fee Reciept Image </label>
                                                                <input type="file" name="Receiptpic" class="filestyle">
                                                            </div>
                                                            <span style="color:red"><?php if(isset($Receiptpic['error'])){ echo $Receiptpic['error']; } ?></span>
                                                           <p> <span style="color:red"><?php echo validation_errors(); ?></span></p>
                                                        </div>
                                                        <?PHP
                                                        if ($totalamt ==  $checkremaining_amount || $totalamt >$checkremaining_amount){ ?>
                                                          <button type="submit" name="submit" value="submit" class="btn btn-primary" disabled>Submit</button>
                                                        <?php }else{ ?>
                                                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                                                           <?php } ?>
                                                    </div>
                                                </div>
                                            </form>

                                         <?php  } ?>                    
                                         
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
               
               $("#promoCode").blur(function(){
                    var promoCode = $(this).val();
                    $.ajax({
                        type:"POST",
                        data:{promoCode:promoCode},
                        url:"<?php echo base_url('dashboard/checkpromocode_admin'); ?>",
                        success:function(res){
                            if(res==0){
                                $("#promoCodeErr").html('Promo Code Does Not Exist !').css('color', 'red');
                                // $(".elementor-button-text").prop('disabled', false);
                            }else if(res==2){
                                $("#promoCodeErr").html('Promo Code Expired !').css('color', 'red');
                            }else{
                                $("#promoCodeErr").html('Promo Code Exist !').css('color', 'green');
                            }
                        },
                        error:function(error){
                            console.log(error);
                        }
                    });
              });
            

            $("#payAmount").keyup(function(){

                var payAmount = parseInt($("#payAmount").val());
                var remainamt  = parseInt($(".remainamt").val());
                console.log(payAmount);
                console.log(remainamt);
                if(payAmount > 0 ){

                    if(payAmount > remainamt ){
                        $(':input[type="submit"]').prop('disabled', true);
                        $("#error").html("amount is exceed");
                    }else{
                        $(':input[type="submit"]').prop('disabled', false);
                        $("#error").html("");
                    }

                    
                }else{
                    alert("Enter Correct Amount");
                }
            });


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
       <script>
           $(document).ready(function(){
                $('#paymentselector').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
           });
       </script>


       