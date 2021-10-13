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
                               <h1>Add Admins </h1>
                            <form method="POST" action="<?php echo base_url('dashboard/addAdmin'); ?>">
                                <div class="row">
                                    
                                    <div class="col-xl-4 col-md-6">
                                       <div class="form-group" >
                                            <div class="form-group">
                                                <label>Enter Admin Name </label>
                                                <input type="text" class="form-control" name="studentName" placeholder="Enter Admin Name ">
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentName');?></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                       <div class="form-group" >
                                            <div class="form-group">
                                                <label>Enter Email Id </label>
                                                <input type="text" class="form-control" name="studentEmail" placeholder="Enter Email Id ">
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentEmail');?></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                       <div class="form-group" >
                                            <div class="form-group">
                                                <label>Enter Mobile Number </label>
                                                <input type="text" class="form-control" maxlength="10" name="studentMobile" placeholder="Enter Mobile Number ">
                                            </div>
                                            <span style="color:red"><?php echo form_error('studentMobile');?></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                       <div class="form-group" >
                                            <div class="form-group">
                                                <label>Select Admin Name </label>
                                                <select type="text" class="form-control" id="" name="adminRole">
                                                <option value="">Select Admin Role</option>
                                                <?php if($adminlist){ 
                                                    foreach($adminlist as $value){
                                                 ?>    
                                                <option value="<?php echo $value['adminRoleId']; ?>"><?php echo $value['adminName']; ?></option>    
                                                <?php }} ?>    
                                                </select>
                                            </div>
                                            <span style="color:red"><?php echo form_error('adminRole');?></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-6" style="top:12px;">
                                        <div class="form-group" >
                                           <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">submit</button>
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
                            <h4 class="card-title">Package List</h4>
                            <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th class="thclass">#Id</th>
                                    <th class="thclass">Admin Role</th>
                                    <th class="thclass">Admin Name</th>
                                    <th class="thclass">Admin Email</th>
                                    <th class="thclass">Admin Mobile</th>
                                    <th class="thclass">Action</th>
                                </tr>
                                </thead>  
                                <tbody>
                                   <?php if($adminlistRole){
                                    $i=1;
                                    foreach ($adminlistRole as $key => $value) { 
                                    ?> 
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $value['adminName']; ?></td>
                                    <td><?php echo $value['studentName']; ?></td>
                                    <td><?php echo $value['studentEmail']; ?></td>
                                    <td><?php echo $value['studentMobile']; ?></td>
                                    <td>
                                        <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deleteroleId');?>">
                                         <input type="hidden" value="<?php echo $value['studId'];?>" name="studId">
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
                    window.location.href = '<?php echo base_url('dashboard/addAdmin')?>';
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
