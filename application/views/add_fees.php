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

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <h1>Fees Module</h1>
                                        <form method="POST" action="<?php echo base_url('dashboard/add_fees'); ?>">
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter School fees  </label>
                                                            <input type="number" class="form-control" id="school_fees" name="school_fees" placeholder="School fees ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('school_fees');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Book fees  </label>
                                                            <input type="number" class="form-control" id="bookfees" name="book_fees" placeholder="Book fees ">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('book_fees');?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Discount  </label>
                                                            <input type="text" class="form-control gstamt" name="fk_discount" placeholder="Discount">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('fk_discount');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Course Period  </label>
                                                            <input type="number" class="form-control" name="coursePeriod" placeholder="Enter course Period">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('coursePeriod');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Final Amount</label>
                                                            <input type="number" class="form-control" id="final_fees" name="final_fees" placeholder="Final Amount " readonly="">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('final_fees');?></span>
                                                    </div>
                                                </div>

                                               <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Package Name</label>
                                                            <select type="text" class="form-control" id="" name="packageName">
                                                            <option value="">Select Package Name</option>
                                                            <?php if($getpackage){ 
                                                                foreach($getpackage as $value){
                                                             ?>    
                                                            <option value="<?php echo $value['packageName']; ?>"><?php echo $value['packageName']; ?></option>    
                                                            <?php }} ?>    
                                                            </select>
                                                        </div>
                                                        
                                                        <span style="color:red"><?php echo form_error('final_fees');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                        <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Class Name</label>
                                                            <select type="text" class="form-control js-example-basic-multiple" id="" name="fk_classId[]" multiple="multiple">
                                                                <option value="" >Select Class</option>
                                                                <option value="1" >Nursery</option>
                                                            <option value="2">Jr. Kg</option>
                                                            <option value="3">Sr. Kg</option>
                                                            </select> 
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
                                                <th class="thclass">Package Name</th>
                                                <th class="thclass">School fees</th>
                                                <th class="thclass">Books fees</th>
                                                <th class="thclass">Course Period</th>
                                                <th class="thclass">Monthly fees</th>
                                                <th class="thclass">Discount</th>
                                                <th class="thclass">Final Fees</th>
                                                <th class="thclass">Date</th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($list_Fees){
                                                $i=1;
                                                foreach ($list_Fees as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['packageName']; ?></td>
                                                <td><?php echo $value['school_fees']; ?></td>
                                                <td><?php echo $value['book_fees']; ?></td>
                                                <td><?php echo $value['coursePeriod']; ?></td>
                                                <td><?php echo $value['monthly_fees']; ?></td>
                                                <td><?php echo $value['fk_discount']; ?></td>
                                                <td><?php echo round($value['final_fees']); ?></td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deletefeesId');?>">
                                                     <input type="hidden" value="<?php echo $value['feesId'];?>" name="feesId">
                                                     <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size:25px; position: relative;top:0px; margin-left:5px;color:#626ed4;" class="mdi mdi-delete"></i></button>
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
       
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                    window.location.href = '<?php echo base_url('dashboard/add_fees')?>';
       }, 2000);

  </script>

<?php } ?>

<script>


$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});


    function check() {
        if(confirm("Are You Sure You Want To Delete")==true)
        {
            return true;
        }else{
            return false;
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $(".gstamt").keyup(function(){

            var bookfees = parseInt($("#bookfees").val());
            var school_fees = parseInt($("#school_fees").val());
            var total = parseInt(school_fees); 
            var discount = parseInt($(this).val());
            var final_fees = parseInt(school_fees - (school_fees * discount / 100));
            $("#final_fees").val(final_fees);


        });
    });
</script>