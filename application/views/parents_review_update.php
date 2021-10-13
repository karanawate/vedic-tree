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
                                        <h2>Add Reviews Here</h2>
                                        <a href="<?php echo base_url('dashboard/parents_review_update');?>"  style="float: right;top: -40px;position: relative;" class="btn btn-primary">Refresh</a>
                                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('dashboard/parents_review_update'); ?>">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Select Class Name</label>
                                                            <select class="form-control" name="fk_classId">
                                                                <option value="">Select Class Name</option>
                                                                <option value="1">Nursery</option>
                                                                <option value="2">Junior</option>
                                                                <option value="3">Senior</option>
                                                            </select>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('fk_classId');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Parents Name</label>
                                                         <input type="text" class="form-control" name="parentName" placeholder="Enter parent Name ">
                                                        <span style="color:red"><?php echo form_error('parentName');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                    <div class="form-group">
                                                        <label for="username"> Parents Review</label>
                                                         <textarea type="text" class="form-control" name="reviewDec" placeholder="Enter parent Review "></textarea>
                                                        <span style="color:red"><?php echo form_error('reviewDec');?></span>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Upload Parent Image </label>
                                                            <input type="file" class="filestyle" name="parents_review_image" placeholder="Meta Keywords ">
                                                        </div>
                                                        <span style="color:red"><?php if(isset($error['parents_review_image'])){ echo $error['parents_review_image']; } ?></span>
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
                                        <h4 class="card-title">Session List</h4>
                                        <table id="datatable" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">Class Name</th>
                                                <th class="thclass">Parents Review  </th>
                                                <th class="thclass">Parents Image  </th>
                                                <th class="thclass">Parents Name  </th>
                                                <th class="thclass">Create Date </th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($parents_review_update_list){
                                                $i=1;
                                                foreach ($parents_review_update_list as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['reviewDec']; ?></td>
                                                <td> <img width="100px" height="100px"  src="<?php echo base_url('uploads/parents_review_image/'.$value['parents_review_image']);?>"> </img> </td>
                                                <td><?php echo $value['parentName']; ?></td>
                                                <td><?php echo $value['createDT']; ?></td>
                                                <td>
                                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deleteParentsreview');?>">
                                                        <input type="hidden" value="<?php echo $value['reviwId'];?>" name="reviwId">
                                                    <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    </form>
                                                    <a href="<?php echo base_url('dashboard/parents_review_update_edit/'.$value['reviwId']);?>"><i style="font-size:25px;" class="mdi mdi-account-edit-outline"></i></a>
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
                    window.location.href = '<?php echo base_url('dashboard/parents_review_update')?>';
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
