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
                <div class="col-md-12">
                    <div class="card">
                          <div class="card-body">
                               <h1>Add Package Name</h1>
                            <form method="POST" action="<?php echo base_url('dashboard/addpackage'); ?>">
                                <div class="row">
                                    
                                   
                                    <div class="col-xl-4 col-md-6">
                                       <div class="form-group" >
                                            <div class="form-group">
                                                <label>Enter Package Name </label>
                                                <input type="text" class="form-control" name="packageName" placeholder="Package Name ">
                                            </div>
                                            <span style="color:red"><?php echo form_error('packageName');?></span>
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
                                    <th class="thclass">Package Name</th>
                                    <th class="thclass">Date</th>
                                   
                                </tr>
                                </thead>  
                                <tbody>
                                   <?php if($getpackage){
                                    $i=1;
                                    foreach ($getpackage as $key => $value) { 
                                    ?> 
                                <tr>
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $value['packageName']; ?></td>
                                    <td><?php echo $value['createDT']; ?></td>
                                   
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
                    window.location.href = '<?php echo base_url('dashboard/addpackage')?>';
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
