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
                                    <h1>Events Gallery</h1>
                                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('dashboard/videoGallery'); ?>">
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
                                                        <label for="username"> Events Date</label>
                                                         <input type="date" class="form-control" name="eventDate" placeholder="Enter Date ">
                                                        <span style="color:red"><?php echo form_error('eventDate');?></span>
                                                    </div>
                                                </div>


                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Upload Events Video link</label>
                                                            <input type="url" class="form-control" name="videoGalleryVid" placeholder="Upload Events Video link">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('videoGalleryVid');?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label> Event Name</label>
                                                            <input type="text" class="form-control" name="eventName" placeholder="Event Name">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('eventName');?></span>
                                                    </div>
                                                </div>
                                                
                                              
                                              <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Events thumbnail link</label>
                                                            <input type="url" class="form-control" name="eventThumbnail" placeholder="Events thumbnail link">
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('eventThumbnail');?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-12 col-md-6">
                                                    <div class="form-group">
                                                        <label> Event Description</label>
                                                    <textarea rows="10" cols="10" class="form-control" name="eventDesc">Hello Summernote</textarea>
                                                    <span style="color:red"><?php echo form_error('eventDesc');?></span>
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
                                                <th class="thclass">Events Name </th>
                                                <th class="thclass">Events Thumbnail </th>
                                                <th class="thclass">Events Description </th>
                                                <th class="thclass">Events Video  </th>
                                                <th class="thclass">Create Date </th>
                                                <th class="thclass">Action</th>
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($videoGallery_list){
                                                $i=1;
                                                foreach ($videoGallery_list as $key => $value) { 
                                                    // echo "<pre>";
                                                    // print_r($value);
                                                ?> 
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $value['className']; ?></td>
                                                <td><?php echo $value['eventName']; ?></td>
                                                <td><?php echo $value['eventDesc']; ?></td>
                                                <td><img src="<?php echo $value['eventThumbnail']; ?>"></td>
                                                <td> <iframe controls src="<?php echo $value['videoGalleryVid'];?>" width="300px;" height="150px;"></iframe></td>
                                                <td><?php echo $value['eventDate']; ?></td>
                                                <td>
                                                    <form class="" method="POST" onclick="return check();" action="<?php echo base_url('dashboard/deleteGalleryVid');?>">
                                                        <input type="hidden" value="<?php echo $value['vgId'];?>" name="vgId">
                                                    <button  type="submit" name="submit" value="submit" class="btn btn-sm"><i style="font-size: 21px;color:#626ed4;" class="mdi mdi-delete"></i></button>
                                                    
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
                    window.location.href = '<?php echo base_url('dashboard/videoGallery')?>';
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
