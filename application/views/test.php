<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Vedic Tree</title>
    <link rel="icon" href="img/favicon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/bootstrap.min.css" />
    <!-- animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/animate.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/fontawesome/css/all.min.css" />
    <!-- elegent icon CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/themefy_icon/themify-icons.css" />
    <!-- nice select CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/niceselect/css/nice-select.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/owl_carousel/css/owl.carousel.css" />
    <!-- magnify popup CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/magnify_popup/magnific-popup.css" />
    <!-- style CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
	<script src="https://player.vimeo.com/api/player.js"></script>
</head>

<body>
    
    <?php $this->load->view('web_header'); ?>

<iframe src="https://player.vimeo.com/video/76979871" width="640" height="360" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe>

<div class="col-sm-6">
    <form  method="POST" action="<?php echo base_url('website/tracking_video')?>">
        <input type="text" id="durations" name="duration">
        <input type="text" id="secondss" name="seconds">
        <button type="submit" name="submit" class="btn btn-primary" value="submit">Complete</button>
    </form>
</div>


<?php $this->load->view("footd");?>

<script>
        
    var iframe 		= document.querySelector('iframe');
    console.log(iframe);
    var player 		= new Vimeo.Player(iframe);
    console.log(player);
    var secondss 	= 0;
    var durations 	= 0;
    var paused  	= [];


    player.on('progress', function() {

	    player.getCurrentTime().then(function(seconds) {
            secondss = seconds;
	    });

	    player.getDuration().then(function(duration) {
            durations = duration;
		});

	
        $("#durations").val(durations);
        $("#secondss").val(secondss);

});


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

  </script>

<?php } ?>
