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
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Payment Status</label>
                                                        <select name="paystatus" class="form-control">
                                                            <option>select Payament Status</option>
                                                             <option value="1"  <?php echo set_value('paystatus','1'); ?>>Success</option>
                                                            <option value="2" <?php echo set_value('paystatus','2'); ?>>Pending</option>
                                                        </select>
                                                       
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
                                     
                                        <h4 class="card-title">Student List</h4>
                                        <table id="datatable" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Student Name</th>
                                                <th class="thclass">Student Email</th>
                                                <th class="thclass">Student Mobile</th>
                                                <th class="thclass">Payment Amount</th>
                                                <th class="thclass">Fees Receipt</th>
                                                <th class="thclass">Fees Status</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($onboardinglist){
                                                $i=1;
                                                foreach ($onboardinglist as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['usr_firstname'].' '.$value['usr_lastname']; ?></td>
                                                <td><?php echo $value['usr_email']; ?></td>
                                                <td><?php echo $value['usr_mobile_no']; ?></td>
                                                <td><?php echo $value['payAmount']; ?></td>
                                                <td><a href="<?php echo base_url('uploads/Receiptpic/'.$value['Receiptpic'])?>"  download="w3logo"><img width="100px;" height="100px;" src="<?php echo base_url('uploads/Receiptpic/'.$value['Receiptpic'])?>"></a></td>
                                                <td class="align-middle text-center text-sm">
                                                    <?php

                                                        if($value['paymentSatusByadmin']==1){

                                                            $status = "<span class='badge badge-sm bg-gradient-success'>Active</span>";
                                                            $statusval = 2;
                                                            } else {

                                                            $status = "<span class='badge badge-sm bg-gradient-secondary'>De-Active</span>";
                                                            $statusval = 1;
                                                        }
                                                         echo $status; 
                                                     ?>
                                                         
                                                     </td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                 <form id="getdata" method="POST" action="<?php echo base_url('dashboard/onboardinglist');?>">
                                                     <input type="hidden" class="getselectedval" name="" value="" id="getselectedval"> 
                                                    <div style="margin-bottom: 15px;">            
                                                        <div>  
                                                            <select class="form-control paystatusval" name="paystatus" id="" >
                                                                <option value="">Please Select Payment Type</option>
                                                                <option value="success" <?php echo set_select('paystatus', 'success'); ?>>Full Payment</option>
                                                                <option value="partial" <?php echo set_select('paystatus', 'partial'); ?>>Partially Payment</option>  
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div onclick="return check();" >
                                                        <input type="hidden" value="<?php echo $value['fk_studId'];?>" name="studId">
                                                        <input type="hidden" value="<?php echo $statusval;?>" name="paymentSatusByadmin">
                                                        <button  type="submit" name="submit" value="submit" class="btn btn-sm btn-primary btnsubmit">Onrolled Student</button>
                                                        
                                                    </div>
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

       <?php $this->load->view('footd');?>

       
       

       <script type="text/javascript">
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
                                      title: "Student Id is Deleted!",
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



                })
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
      
      setTimeout(function() {
                    window.location.href = '<?php echo base_url('dashboard/getstudlist')?>';
       }, 2000);

  </script>

<?php } ?>

<script type="text/javascript">


    function check() {
        
        var paystatusval = $("#getselectedval").val();
        
        if(paystatusval=="" || paystatusval=="undefined")
        {
            
          alert("Please Select Payment Type");   
          return false;
        }else{
            if(confirm("Are You Sure You Want To Onrolled Student")==true)
            {
                return true;
            }else{
                return false;
            }
        }
    }



    


    

</script>

<script>
    
$(document).ready(function() {
         
    $(".paystatusval").change(function(){
    
      var data = $(this).val();
    
      $(".getselectedval").val(data);
     
        
        
        
        
      });
});


</script>
