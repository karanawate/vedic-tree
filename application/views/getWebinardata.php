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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Webinar List</h4>
                                         <?php
                                            $message = $this->session->flashdata('msg');
                                            if (isset($message)) {
                                                echo '<div class="alert alert-info successMessage ">' . $message . '</div>';
                                                $this->session->unset_userdata('msg');
                                            }

                                            ?>

                                        <table id="datatables" class="table table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class="thclass">#Id</th>
                                                <th class="thclass">StudentEmail</th>
                                                <th class="thclass">StudentEmail</th>
                                                <th class="thclass">StudentMobile</th>
                                                <th class="thclass">studentParent</th>
                                                <th class="thclass">creaetDT</th>
                                                
                                            </tr>
                                            </thead>  
                                            <tbody>
                                               <?php if($webinars){
                                                $i=1;
                                                foreach ($webinars as $key => $value) { 
                                                ?> 
                                            <tr>
                                                <td>
                                                    <?php echo $i++;?>
                                                </td>
                                                <td>
                                                      <?php echo $value['studentName']; ?>
                                                </td>
                                                <td>
                                                     <?php echo $value['studentEmail']; ?>
                                                </td>
                                                <td>
                                                     <?php echo $value['studentMobile']; ?>
                                                </td>
                                                <td>
                                                      <?php echo $value['studentParent']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $value['creaetDT']; ?>
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
       
         <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
      
<script type="text/javascript">
           
$(document).ready(function(){
    setTimeout(function() {
    $(".successMessage").hide(3000);
}, 3000); 

    $('#datatables').DataTable( {
         "scrollX": true,
        dom: 'Bfrtip',
        buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'
            
         ]
    } );
    
    
    
} );


</script>

