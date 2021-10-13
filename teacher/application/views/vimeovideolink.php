<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['teacherName'];
    $studentEmail   = $usersession[0]['teacherEmail'];
    $studentMobile  = $usersession[0]['teacherMobile'];
    $fk_classId     = $usersession[0]['teacherClass'];
    $timestamp      = strtotime(date("Y-m-d"));
    $newDate        = date('l jS  F-Y', $timestamp);  
    // $youtubelink    = "";



    if(!empty($usersession) && !empty($studentEmail) &&  !empty($studentMobile)){

?>


<iframe  class="responsive-iframe-2x" style="border:0-moz-border-radius: 10px;border-radius: 10px;"
   src="<?php echo $youtubelinks; ?>" frameborder="0" allowfullscreen allow="autoplay; encrypted-media" >
</iframe>

<?php
   }else{ 
 ?>

<iframe class="responsive-iframe-2x" style="border:0-moz-border-radius: 10px;border-radius: 10px;"
   src="#" frameborder="0" allowfullscreen allow="autoplay; encrypted-media" >
</iframe>


<?php

  }
?>
