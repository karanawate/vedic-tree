<?php
 $this->load->view('header');
 $monthdata =  required_data();

?>
<style type="text/css">
    .thclass{
        width:400px;
    }
</style>
 <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
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
                            <div>
                                 <div class="alert alert-danger" style="display:none">
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                      <div class="card-body">
                                        <h1>Events Module</h1>
                                        <div class="alert alert-primary"  role="alert" id='resultDiv' style="display:none;"></div>
                                        <form method="POST" id="upload_form"  enctype="multipart/form-data">
                                            <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-xl-4 col-md-6">
                                               <div class="form-group" >
                                                    <div class="form-group">
                                                        <label>Enter Title</label>
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
                                                    </div>
                                                    <span style="color:red"><?php echo form_error('title');?></span>
                                                </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                               <div class="form-group" >
                                                    <div class="form-group">
                                                        <label>Enter Image Link</label>
                                                        <input type="url" class="form-control" id="image_input_link" name="image_input_link" placeholder="Enter Image Link" required>
                                                    </div>
                                                    <span style="color:red"><?php echo form_error('image_input_link');?></span>
                                                </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label> Enter youtube link</label>
                                                            <input type="url" class="form-control" id="youtube_input_link" name="youtube_input_link" placeholder="Enter youtube link"  required >
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('youtube_input_link');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                          <textarea name="description"  id="description"  class="form-control" id="exampleFormControlTextarea1" rows="3" required  >
                                                           </textarea>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('description');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Date</label>
                                                            <input type="date" class="form-control" id="date" name="date"  required >
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('date');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>Enter Alt tags</label>
                                                            <input type="text" class="form-control" id="alt_tg" name="alt_tg" placeholder="Enter alt tags" required >
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('date');?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-6">
                                                   <div class="form-group" >
                                                        <div class="form-group">
                                                            <label>File Upload</label>
                                                             <input type="file" name="allocated_file[]" id="allocated_file" class="filepond" data-max-file-size="3MB"/ required>
                                                             <span style="color:red"><?php echo form_error('allocated_file');?></span>
                                                        </div>
                                                        <span style="color:red"><?php echo form_error('date');?></span>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?php echo rand();  ?>" name="event_rand_id" />
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
  <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
  <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
  <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>        
    
<script type="text/javascript">
$(document).ready(function () {
    var inputElement = document.querySelector('#allocated_file');
    const pond = FilePond.create(inputElement, {
        maxFiles: 20,
        maxFileSize: '3MB',
        allowMultiple: true,
        allowProcess: false,
    });
    $("#upload_form").submit(function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        // append files array into the form data
        pondFiles = pond.getFiles();
        for (var i = 0; i < pondFiles.length; i++) {
            fd.append('allocated_file[]', pondFiles[i].file);
        }
        $.ajax({
            url: '<?php echo site_url('adminseo/insert_events'); ?>',
            type: 'POST',
            data: fd,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
            console.log(data)
                  if($.isEmptyObject(data.msg)){
                      $(".alert-primary").css('display','none');
                  }else
                  {
                    $(".alert-primary").css('display','block');
                    $(".alert-primary").html(data.msg);
                  }
                  
                 if($.isEmptyObject(data.error)){
                    $(".alert-danger").css('display','none');
                  }else{
                    $(".alert-danger").css('display','block');
                    $(".alert-danger").html(data.error);
                  }
            },
            error: function (data) {
                //  todo the logic
            }
        });
    });
});
</script>

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