<html>
    <head>
    <style>
        .bgimg {
        height: 80%;
        background-position: center;
        background-size: cover;
        position: relative;
        font-size: 25px;
        }
        
        .topleft {
        position: absolute;
        top: 0;
        left: 16px;
        }
        
        .bottomleft {
        position: absolute;
        bottom: 0;
        left: 16px;
        }
        
        .middle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        }
        
        hr {
        margin: auto;
        width: 40%;
        }
    </style>
</head>
<body>
  <div class="bgimg">
  <div class="topleft">
    <img src="<?php echo base_url()?>assets/website/img/logo.png"alt="Vedic Tree">
  </div>
  <div class="middle">
    <h1>We Will Be Back Soon</h1>
    <p>Site Under Maintenance</p>
    <hr>
    <p id="demo"></p>
    <!--<div>For reference Visit <a href="http://vedictreeschool.vtgi.in/" target="_blank">http://vedictreeschool.vtgi.in/</a></div>-->
  </div>
  </div>  
</body>
</html>
<script>
// Set the date we're counting down to
var countDownDate = new Date("July 03, 2021 15:15:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
//   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

<?php die; ?>