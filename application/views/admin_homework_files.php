<?php
 $this->load->view('header');
?>
<style type="text/css">
    .thclass{
        width:400px;
    }
    
    .btn_download{
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 30px;
  cursor: pointer;
  font-size: 20px;
  border-radius:5px;
}

  .download-each { 
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(20rem, 1fr));
        grid-gap: 20px;
     }
    .download-each .download-file img {
        width: 200px;
        height: 140px;
      border: 1px solid #ccc;
      box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.3);
      max-width: 100%;
    }
    .uploadfilebox{
        width: 1336px;
        height: 200px;
        background-color: #dee2e6;
        margin-top: 27px;
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
                                <div class="card"  style="overflow-x: auto">
                                    <div class="card-body">
                                        <h4 class="card-title">Allocated Homework List-Images</h4>
                                        
                                            <div class="boxes">
                                            <div class="box11">
                                                <div class="box-inside">
                                                    <div class="desktop-mobile-view">
                                                        <!-- //top header -->
                                                     
                                                        <!-- //end top header -->      
                                                        <h2>Homework</h2>
                                                        <button class="btn btn-primary" onclick="goBack()">Go Back</button>
                                                        <div class="download-each">
                                                            <?php foreach($admin_view_files as $view_file) { ?>
                                                            <div class="download-file">
                                                                <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                                                            <?php 
                                                              $info = new SplFileInfo($view_file['allocated_file']);
                                                              $pdfextension = $info->getExtension();
                                                                ?>
                                                                <?php if($pdfextension =='pdf'){ ?>
                                                                <a download href="<?php echo base_url('teacher/uploads/multiple_pics_loading/'.str_replace(' ', '_', $view_file['allocated_file'])); ?>" title="ImageName">
                                                                    <img class="img-rounded" src="<?php echo  base_url('uploads/homework_allocated_student/pdf-common-file.png');?>" />
                                                                </a>
                                                                <?php } else { ?> 
                                                                <a download href="<?php echo  base_url('teacher/uploads/multiple_pics_loading/'.str_replace(' ', '_', $view_file['allocated_file'])); ?>" title="ImageName">
                                                                    <img class="img-rounded" src="<?php echo  base_url('teacher/uploads/multiple_pics_loading/'.str_replace(' ', '_', $view_file['allocated_file'])); ?>" />
                                                                </a>
                                                                <?php }?>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                            <div class="uploadfilebox"></div>
                                        
                                     
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
        
        
        
        
            
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>        
              <?php $this->load->view('footer'); ?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>
       
       <script>
            function goBack() {
              window.history.back();
            }
      </script>
       
            <script type="text/javascript">
           $(document).ready(function() {
                $(".homework_allocated_btn").click(function(){
                    let home_id = this.id;
                    $.ajax({
                        type:"POST",
                        data:{home_id:home_id},
                        url:"<?php echo base_url('dashboard/update_homework_status')?>",
                        success:function(res){
                            swal("Homework Approved Successfully!");
                        },
                        error:function(error){
                            console.log(error);
                        }
                    })

                })
            } );

       </script>

       <script type="text/javascript">
       
        $(document).ready(function() {
         $('#datatables').dataTable( {
            "iDisplayLength": 10,
             "deferRender": true ,
             stateSave: true
         }
             );
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

<script>
    
</script>



