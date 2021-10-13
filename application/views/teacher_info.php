<?php
 $this->load->view('header');

?>
<style type="text/css">
    .thclass{
        width:400px;
    }
    .badge-success {
    color: #fff;
    background-color: #02a499;
    height: 25px;
    width: 113px;
    margin-top: 8px;
    border-radius: 26px;
    top-padding: 75px;
    padding-top: 8px;
}
    .badge-warning {
    color: #fff;
    background-color: #f8ad25;
    height: 25px;
    width: 113px;
    margin-top: 8px;
    border-radius: 26px;
    top-padding: 75px;
    padding-top: 8px;
}
.href_tag {

    color: #007FFF;
}
.red-color {
color:red;
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Teacher  List</h4>
                                        <?php if ($this->session->flashdata('msg')) { ?>
                                            <div id="success_msg" class="alert alert-success"> <?= $this->session->flashdata('msg') ?> </div>
                                        <?php } ?>
                                        <a href="<?php echo base_url('dashboard/teacher_inserted_info'); ?>" class="btn btn-primary">Teacher create</a>
                                        <table id="datatable" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <!-- <th class="thclass">#Id</th> -->
                                                <th class="thclass"> Name</th>
                                                <th class="thclass"> Email</th>
                                                <th class="thclass"> Mobile</th>
                                                <th class="thclass"> Class</th>
                                                <th class="thclass"> Created at</th>
                                            </tr>
                                            </thead>  
                                        <tbody>
                                            <?php  if($teacher_information){
                                                    $i=1;
                                                    foreach ($teacher_information as $key => $value) { ?> 
                                                <tr>
                                                   <!--  <td><?php echo $i++;?></td> -->

                                                    <td>
                                                      <img style="width: 40px;border-radius:5px;" class="h-15 w-18"
                                                       src="https://ui-avatars.com/api/?bold=true&background=random&name=<?php echo $value['teacherName'] ?>" />
                                                        <?php echo $value['teacherName']; ?>
                                                    </td>
                                                    <td><?php echo $value['teacherEmail']; ?></td>
                                                    <td><?php echo "+91 ".$value['teacherMobile']; ?></td>
                                                    <td>
                                                        <?php
                                                         if($value['teacherClass']== 1)
                                                         {
                                                            echo  "Nursary";
                                                         }elseif ($value['teacherClass'] == 2) {
                                                            echo "Junior";
                                                         }elseif ($value['teacherClass'] ==3){
                                                              echo  "Senior";
                                                         }
                                                        ?>   
                                                    </td>
                                                    <td><?php  echo $value['createDT']; ?></td>
                                                           
                                                <td>
                                                     <form method="POST" action="<?php echo base_url('dashboard/deleteteach_id'); ?>">
                                                         <input type="hidden" value="<?php echo  $value['teacherId']; ?>" name="teacherId" />        
                                                         <button  type="submit" name="submit"  class="btn btn-sm"><i style="font-size: 21px;position:  margin-left: 19px;color:#626ed4;" class="mdi mdi-delete"></i></button>
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
                $(".teacher-delete").click(function(){
                    var teach_id = $(this).val();
                    $.ajax({
                        type:"POST",
                        data:{teach_id:teach_id},
                        url:"<?php echo base_url('dashboard/deleteteach_id')?>",
                        success:function(res){
                            alert("teacher is deleted successfully");
                            if(res==1){
                                alert("teacher is deleted successfully");
                            }
                            setTimeout(function(){
                               window.location.reload(1);
                            }, 2000);
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
      
      // setTimeout(function() {
      //                window.location.href = '<?php echo base_url('dashboard/teacher_get_information')?>';
      //  }, 1000);

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
