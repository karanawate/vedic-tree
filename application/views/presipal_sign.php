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
                                        <h1>signature-upload</h1>
                                        
                                            <?php
                                            $message = $this->session->flashdata('msg');
                                            if (isset($message)) {
                                                echo '<div class="alert alert-info successMessage ">' . $message . '</div>';
                                                $this->session->unset_userdata('msg');
                                            }

                                            ?>
                                        <form method="POST" action="<?php echo base_url('adminseo/insert_presipal_sign'); ?>"  enctype="multipart/form-data">
                                            <div class="row">
                                            <div class="col-md-12">
                                              
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter File upload</label>
                                                            <input type="file" class="form-control" id="signature_file" name="signature_file" placeholder="Enter file Upload "  required>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('signature_file');?></span>
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
                       

                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

        <!-- END layout-wrapper -->

       <?php $this->load->view('footd');?>
  <script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
    
  <script>
$(document).ready(function(){
    setTimeout(function() {
    $(".successMessage").hide(3000);
}, 3000); 
});
</script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
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
                    window.location.href = '<?php echo base_url('dashboard/add_fees')?>';
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

<script type="text/javascript">
    $(document).ready(function(){

        $(".gstamt").keyup(function(){

            var bookfees = parseInt($("#bookfees").val());
            var school_fees = parseInt($("#school_fees").val());
            var total = parseInt(bookfees + school_fees); 
            var gstamt = parseInt($(this).val());
            var final_fees = parseInt(total/100 * gstamt);
            $("#final_fees").val(total+final_fees);


        });
    });
</script>