<?php

 $usersession    = $this->session->userdata('usersession');
 $adminRole      =$usersession[0]['adminRole'];
 $this->load->view('header');
?>
 <link href="<?php echo base_url()?>assets/css/timepicker.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .thclass{
        width:400px;
    }
    
    * {
  box-sizing: border-box;
}
  /* The actual timeline (the vertical ruler) */
.timeline {
  position: relative;
  max-width: 1200px;
  margin: 0 auto;
}

/* The actual timeline (the vertical ruler) */
.timeline::after {
  content: '';
  position: absolute;
  width: 6px;
  background-color: rgb(8 0 0);
  top: 0;
  bottom: 0;
  left: 50%;
  margin-left: -3px;
}

/* Container around content */
.container {
  padding: 10px 50px;
  position: relative;
  background-color: inherit;
  width: 50%;
}

/* The circles on the timeline */
.container::after {
  content: '';
  position: absolute;
  width: 25px;
  height: 25px;
  right: -61px;
  background-color: #61D4E8;
  border: 4px solid #2DA1E7;
  top: 15px;
  border-radius: 50%;
  z-index: 1;
}

/* Place the container to the left */
.left {
  left: -208px;
}

/* Place the container to the right */
.right {
  left: 26%;
}

/* Add arrows to the left container (pointing right) */
.left::before {
  /*content: " ";*/
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  right: 30px;
  border: medium solid white;
  border-width: 10px 0 10px 10px;
  border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  left: 30px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
  left: -18px;
}

/* The actual content */
.content {
    
  padding: 8px;
    background-color: rgb(2 2 2);
    position: relative;
    border-radius: 6px;
    color: rgb(124 252 0);
}

/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
/* Place the timelime to the left */
  .timeline::after {
    left: 31px;
  }

/* Full-width containers */
  .container {
    width: 100%;
    padding-left: 70px;
    padding-right: 25px;
  }

/* Make sure that all arrows are pointing leftwards */
  .container::before {
    left: 60px;
    border: medium solid white;
    border-width: 10px 10px 10px 0;
    border-color: transparent white transparent transparent;
  }

/* Make sure all circles are at the same spot */
  .left::after, .right::after {
    left: 15px;
  }

/* Make all right containers behave like the left ones */
  .right {
    left: 0%;
  }
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
                                        <h2>Search Enquiry Here</h2>
                                        <span style="float:right;top: -45px;position: relative;"><a class="btn btn-primary" href="<?php echo base_url('dashboard/get_temp_enquiry');?>">Refresh</a></span>
                                        <form method="POST" action="<?php echo base_url('dashboard/get_temp_enquiry'); ?>">
                                            <input type="hidden" name="allocate" value="search">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Student Name</label>
                                                       <input type="text" name="studentName" placeholder="Enter Name" value="<?php echo set_value('studentName'); ?>" class="form-control">
                                                        <span style="color:red"><?php echo form_error('studentName');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Student Email</label>
                                                        <input type="email" name="studentEmail" placeholder="Enter Email" value="<?php echo set_value('studentEmail'); ?>" class="form-control">
                                                        <span style="color:red"><?php echo form_error('studentEmail');?></span>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Student Mobile </label>
                                                       <input type="text" name="studentMobile" placeholder="Enter Mobile" value="<?php echo set_value('studentMobile'); ?>" class="form-control">
                                                        <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-6" style="top:12px;">
                                                    <div class="form-group" >
                                                       <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Search</button>
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
                                        <h4 class="card-title">Student List</h4>
                                        <table id="datatables" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Student Name</th>
                                                <th class="thclass">Student Email</th>
                                                <th class="thclass">Student Mobile</th>
                                                <th class="thclass">student Class</th>
                                                <th class="thclass">Register Date</th>
                                                <?php if($adminRole==10){ ?>
                                                <th class="thclass">Action </th>
                                                <?php } ?>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($get_temp_enquiry){
                                                   
                                                 
                                                $i=1;
                                                foreach ($get_temp_enquiry as $key => $value) { 
                                                foreach ($value as $key => $value1) { 
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value1['studentName']; ?></td>
                                                <td><?php echo $value1['studentEmail']; ?></td>
                                                <td><?php echo $value1['studentMobile']; ?></td>
                                                <td><?php echo $value1['className']; ?></td>
                                                <td><?php echo $value1['createtempDT']; ?></td>
                                                <?php if($adminRole==10){ ?>
                                                <td>
                                                    <a href="#" class="waves-effect waves-light" data-toggle="modal" data-target="#exampleModal<?php echo $value1['studId'];?>"><i class="mdi mdi-eye" style="font-size:18px;"> </i>Follow up </a>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                               <?php }}} ?> 
                                         
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
        
        
        
        <?php if($get_temp_enquiry){
                $i=1;
                    foreach ($get_temp_enquiry as $key => $value) { 
                         foreach ($value as $key => $value1) {
            ?> 
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $value1['studId'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Follow Up </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form method="POST" action="<?php echo base_url('dashboard/followupenquiry'); ?>">
                          <input type="hidden" name="fk_studId" value="<?php echo $value1['studId'];?>">
                        <div class="row">
                            <div class="col-xl-12 col-md-6">
                                <div class="form-group">
                                    <label for="username"> Enter Message </label>
                                    <textarea type="text" class="form-control"  name="remark" placeholder="Enter Message" required></textarea>
                                    <span style="color:red"><?php echo form_error('remark');?></span>
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-md-6">
                                <div class="form-group">
                                    <label for="username"> Select Admission Status</label>
                                    <select class="form-control" name="admissionStatus">
                                        <option value="0">Select Admission Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Hold">Hold</option>
                                        <option value="cancel">cancel</option>
                                    </select>
                                    <span style="color:red"><?php echo form_error('paystatusId');?></span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="form-group">
                                    <label for="username"> Select Demo Class Status</label>
                                    <select class="form-control" name="democlassStatus">
                                        <option value="">select Demo Class Status</option>
                                       <?php if($selectdemochoice){ 
                                       foreach($selectdemochoice as $value){
                                       ?>
                                       <option value="<?php echo $value; ?>"><?php echo $value;  ?></option>
                                       <?php }} ?>
                                    </select>
                                    <span style="color:red"><?php echo form_error('democlassStatus');?></span>
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-md-6">
                                <div class="form-group">
                                    <label for="username"> Select Next Follow Up Date</label>
                                   <input type="date" name="nextflwDT" class="form-control">
                                    <span style="color:red"><?php echo form_error('nextflwDT');?></span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="md-form">
                                     <label for="username"> Select Time </label>
                                  <input placeholder="Selected time" type="text" id="input_starttime" name="demolcassTime" class="form-control bs-timepicker">
                                  <label for="input_starttime">Twelve hour clock</label>
                                </div>
                            </div>
                            

                            <div class="col-xl-12 col-md-6" style="top:12px;">
                                <div class="form-group" >
                                   <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Submit</button>
                                </div>
                            </div>
                            
                            

                            
                            
                            <div class="modal-body wrapper">
                                <?php $result = getfollowupenquiry($value1['studId']); ?> 
                                        <h1> Details Followup </h1>
                                        <div class="timeline">
                                        <?php if($result){ 
                                        foreach($result as $key => $valuesdata){ 
                                            if($key % 2 == 0){
                                        ?>
                                              <div class="container left">
                                            <div class="content" style="width:280px;">
                                                <div class="time">Date : <?php echo $valuesdata['followupDT']?></div>
                                                
                                                <div style="width: 300px;"> Message : <?php echo $valuesdata['remark']?></div>
                                                <div style="width: 300px;">Admission Status : <?php echo $valuesdata['admissionStatus']?></div>
                                                <div style="width: 300px;">Next followup Date : <?php if(isset($valuesdata['nextflwDT'])){ echo $valuesdata['nextflwDT']; }else{ echo "No Date Schedule"; } ?></div>
                                                <div style="width: 300px;">Demo Class Status : <?php if(isset($valuesdata['democlassStatus'])){ echo $valuesdata['democlassStatus']; }else { echo "No Data Found"; } ?></div>
                                                <div style="width: 300px;">Demo Class Time : <?php if(isset($valuesdata['demolcassTime'])){ echo $valuesdata['demolcassTime']; }else { echo "No Data Found"; } ?></div>
                                            </div>
                                          </div>
                                          <?php }else{ ?>
                                          
                                          <div class="container right">
                                                <div class="content" style="width:280px;">
                                                  <div class="time">Date : <?php echo $valuesdata['followupDT']?></div>
                                                    
                                                    <div> Message : <?php echo $valuesdata['remark']?></div>
                                                    <div>Admission Status : <?php echo $valuesdata['admissionStatus']?></div>
                                                    <div>Next followup Date : <?php if(isset($valuesdata['nextflwDT'])){ echo $valuesdata['nextflwDT']; }else{ echo "No Date Schedule"; } ?></div>
                                                    <div>Demo Class Status : <?php if(isset($valuesdata['democlassStatus'])){ echo $valuesdata['democlassStatus']; }else { echo "No Data Found"; } ?></div>
                                                    <div>Demo Class Time : <?php if(isset($valuesdata['demolcassTime'])){ echo $valuesdata['demolcassTime']; }else { echo "No Data Found"; } ?></div>
                                                </div>
                                              </div>
                                              
                                      <?php }} }   else{ echo "No Data Found"; } ?>
                                </div>
                                  
                            </div>
                        </div>
                    </form>
                   </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>
    
        <?php } } } ?>
        
        
        
            
            
            

       <?php $this->load->view('footd');?>
       
       <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
       <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
       <script type="text/javascript" src="<?php echo base_url('assets/js/timepicker.js') ?>"> </script>
  

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



                });
                
                
                
                 $('#datatables').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [ {
                        extend: 'excelHtml5',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
             
                            $('row c[r^="C"]', sheet).attr( 's', '2' );
                        }
                    } ]
                } );
    
    
    
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
                    window.location.href = '<?php echo base_url('dashboard/get_temp_enquiry')?>';
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
    
    
    
    var items = document.querySelectorAll(".timeline li");

function isElementInViewport(el) {
  var rect = el.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

function callbackFunc() {
  for (var i = 0; i < items.length; i++) {
    if (isElementInViewport(items[i])) {
      if(!items[i].classList.contains("in-view")){
        items[i].classList.add("in-view");
      }
    } else if(items[i].classList.contains("in-view")) {
        items[i].classList.remove("in-view");
    }
  }
}
 
window.addEventListener("load", callbackFunc);
window.addEventListener("scroll", callbackFunc);





</script>

<script>
  $(function () {
    $('.bs-timepicker').timepicker();
  });
</script>