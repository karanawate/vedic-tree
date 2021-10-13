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
                         
                                <div class="card">
                                      <div class="card-body">
                                        <h1>Fees Module</h1>
                                        <form method="POST" action="<?php echo base_url('dashboard/setemi'); ?>">
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter final fees  </label>
                                                            <input type="number" class="form-control" id="final_fees" name="final_fees" placeholder="Final fees ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('final_fees');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Percentage  </label>
                                                            <input type="number" class="form-control"  name="emipercentage" placeholder="Enter Percentage % ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('emipercentage');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Monthly Fees  </label>
                                                            <input type="number" class="form-control " name="monthlyFess" placeholder="Enter Monthly Fees ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('monthlyFess');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter EMI Charges  </label>
                                                            <input type="number" class="form-control " name="emicharges" placeholder="Enter EMI Charges ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('emicharges');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Month</label>
                                                            <select type="text" class="form-control" id="" name="fk_tid">
                                                                <option value="" >Select Month</option>
                                                               <?php 
                                                                if($tbl_tenure){
                                                                    foreach ($tbl_tenure as $key => $value) {
                                                                ?>
                                                                <option value="<?php echo $value['tid'];?>"><?php echo $value['tenureName'] ?></option>
                                                                <?php } } ?>
                                                            </select> 
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('fk_tid');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Package Name</label>
                                                            <select type="text" class="form-control" id="" name="fk_feesId">
                                                                <option value="">Select Package Name</option>
                                                                <?php 
                                                                if($tab_add_fees_data){
                                                                    foreach ($tab_add_fees_data as $key => $value) {
                                                                ?>
                                                                <option value="<?php echo $value['feesId'];?>"><?php echo $value['packageName'] ?></option>
                                                                <?php } } ?>
                                                            
                                                            </select>
                                                        </div>
                                                        
                                                        <span style="color:red"><?php echo form_error('final_fees');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                        <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Class Name</label>
                                                            <select type="text" class="form-control" id="" name="fk_classId">
                                                                <option value="" >Select Class</option>
                                                                <option value="1" >Nursery</option>
                                                                <option value="2">Jr. Kg</option>
                                                                <option value="3">Sr. Kg</option>
                                                            </select> 
                                                            <span style="color:red"><?php echo form_error('fk_classId');?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </form>
                                      </div>
                                </div>
                          
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">EMI List</h4>
                                        <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Package Name</th>
                                                <th class="thclass">Monthly fees</th>
                                                <th class="thclass">Emi Charges</th>
                                                <th class="thclass">Emi Percentage</th>
                                                <th class="thclass">Final Fees</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($getemi){
                                                $i=1;
                                                foreach ($getemi as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['packageName']; ?></td>
                                                <td><?php echo round($value['monthlyFess']); ?></td>
                                                <td><?php echo round($value['emicharges']); ?></td>
                                                <td><?php echo round($value['emipercentage']); ?></td>
                                                <td><?php echo round($value['final_fees_emi']); ?></td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                   
                                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deleteemifeesId');?>">
                                                    <input type="hidden" value="<?php echo $value['emi_Id'];?>" name="emi_Id">
                                                    <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 31px;position: relative;top:0px;   margin-left:5px;color:#626ed4;" class="mdi mdi-delete"></i></button>
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
      
      setTimeout(function() {
                    window.location.href = '<?php echo base_url('dashboard/setemi')?>';
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

