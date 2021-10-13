<?php

    $usersession    = $this->session->userdata('usersession');
    
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
       .btn-primary {
            color: #fff;
            background-color: #626ed4;
            border-color: #626ed4;
            height: 33px;
            font-size: 15px;
        }
       .btn_view{
          background-color: #626ed4;
            border: none;
            color: white;
            padding: 11px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            border-radius: 10px;
       }
        .myduration
        {
            margin-right: 15px;
        }
    </style>
    <!-- Vedic Teacher header files Start -->
    <?php $this->load->view('teacher_header'); ?>
    <!-- Vedic Teacher header files End -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>

<body>
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenu'); ?>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
      <?php $this->load->view('teachersidebar'); ?>
         <div class="box11 animated_hero" style="background: #695FFE;">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                        <?php $this->load->view('teacher_topheader'); ?>
                    <!-- //end top header -->
                   <button class="btn_view" onclick="history.back()">Go Back</button>
                    <h4 class="my-4" style="font-weight: 800;color:darkorange"><?php  echo  $stud_data['studentName']. "  ||   ".$stud_data['packageName']; ?> </h4>
                    
                    
                    
                        <div>
                          <input type="button" id="btn" class="btn btn-default" value="First Term">
                          <input type="button" id="btnsecond" class="btn btn-default" value="Second Term">
                        </div>
        
                        <div id="Create" style="display:none">
                           <!--first term-->
                           <form method="POST" action="<?php echo base_url('teacher/insert_reportcard'); ?>">
                                  <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I enjoy my work</label><span style="color:red">*</span>
                                        <div>
                                              <input type="hidden" value="<?php  echo  $stud_data['fk_studId'];   ?>"     name="fk_studId" />
                                              <input type="hidden" value="<?php  echo  $stud_data['studentName'];   ?>"  name="studentName" />
                                              <input type="hidden" value="<?php  echo  $stud_data['usr_dob'];   ?>"      name="usr_dob" />
                                              <input type="hidden" value="<?php  echo  $stud_data['packageName'];   ?>"   name="packageName" />
                                              <input type="hidden" value="<?php  echo  $stud_data['className'];   ?>"    name="className" />
                                              <input type="hidden" value="<?php  echo  $stud_data['feesId'];   ?>"      name="feesId" />
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="first_que" id="one" required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="first_que" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I love to play</label><span style="color:red">*</span>
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="second_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="second_que" id="one"  required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I do physical Exercise</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="third_que" id="one" required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="third_que" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I am independent</label><span style="color:red">*</span>
                                      
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="four_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="four_que" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I listen to Instructions</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="five_que" id="one" required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="five_que" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I Know my table Manners</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="six_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="six_que" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I can sing/dance</label><span style="color:red">*</span>
                                       
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seven_que" id="one"  required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seven_que" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I can draw and color</label><span style="color:red">*</span>
                                       
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="eight_que" id="one" required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="eight_que" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                   </div>
                                     <div><h3>COGNITIVE & LANGUAGE DEVLOPMENT</h3></div>
                                  <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Reading</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="nine_que" id="one" required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="nine_que" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I General Awarness</label><span style="color:red">*</span>
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="ten_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="ten_que" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Recitation</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="eleven_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="eleven_que" id="one"  required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Story Narration</label><span style="color:red">*</span>
                                      
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="tweele_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="tweele_que" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Conversation</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="threen_que" id="one"  required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="threen_que" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                  </div>
                                    <div><h3>IN WRITING MY SCORE IS</h3></div>
                                  <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="username"> English</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="english" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="english" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username">Maths</label></label><span style="color:red">*</span>
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="maths" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="maths" id="one"  required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Hindi</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="hindi" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="hindi" id="one"  required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                  </div>
                                     <div><h3>PHYSICAL/ PERSONALITY DEVLOPEMENT</h3></div>
                                      <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Neat and Tidy</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="dev_one" id="one" required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="dev_one" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Active</label><span style="color:red">*</span>
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="dev_two" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="dev_two" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Healthy</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="dev_three" id="one" required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="dev_three" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username">A good co-ordinator</label><span style="color:red">*</span>
                                      
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="dev_four" id="one" required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="dev_four" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="username"> Remarks</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['remark']; ?>"  name="remark_one" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['remark']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['remark']; ?>"  name="remark_one" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['remark']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                  </div>
                                <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Submit</button>
                            </form>
                        </div>
                        <div id="Createsecond" style="display:none">
                          <!--second term-->
                         <p>secoond</p>
                            <form method="POST" action="<?php echo base_url('teacher/second_reportcard_inserted'); ?>">
                                  <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I enjoy my work</label><span style="color:red">*</span>
                                        <div>
                                               <div>
                                              <input type="hidden" value="<?php  echo  $stud_data['fk_studId'];   ?>"     name="fk_studId" />
                                              <input type="hidden" value="<?php  echo  $stud_data['studentName'];   ?>"   name="studentName" />
                                              <input type="hidden" value="<?php  echo  $stud_data['usr_dob'];   ?>"       name="usr_dob" />
                                              <input type="hidden" value="<?php  echo  $stud_data['packageName'];   ?>"   name="packageName" />
                                              <input type="hidden" value="<?php  echo  $stud_data['className'];   ?>"     name="className" />
                                              <input type="hidden" value="<?php  echo  $stud_data['feesId'];   ?>"        name="feesId" />
                                              
                                        </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sefirst_que" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sefirst_que" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I love to play</label><span style="color:red">*</span>
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sesecond_que" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sesecond_que" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I do physical Exercise</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sethird_que" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sethird_que" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I am independent</label><span style="color:red">*</span>
                                      
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sefour_que" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sefour_que" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I listen to Instructions</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sefive_que" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sefive_que" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I Know my table Manners</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sesix_que" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sesix_que" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I can sing/dance</label><span style="color:red">*</span>
                                       
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seseven_que" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seseven_que" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I can draw and color</label><span style="color:red">*</span>
                                       
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seeight_que" id="one" >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seeight_que" id="one" >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                   </div>
                                     <div><h3>COGNITIVE & LANGUAGE DEVLOPMENT</h3></div>
                                  <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Reading</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="senine_que" id="one"  required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="senine_que" id="one" required>
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> I General Awarness</label><span style="color:red">*</span>
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seten_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seten_que" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Recitation</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seeleven_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seeleven_que" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Story Narration</label><span style="color:red">*</span>
                                      
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="setweele_que" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="setweele_que" id="one"required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Conversation</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sethreen_que" id="one" required  >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sethreen_que" id="one" required  >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                  </div>
                                    <div><h3>IN WRITING MY SCORE IS</h3></div>
                                  <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="username"> English</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seenglish" id="one"  required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="seenglish" id="one" required  >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username">Maths</label></label><span style="color:red">*</span>
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="semaths" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="semaths" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Hindi</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sehindi" id="one"  required>
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sehindi" id="one"  required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                  </div>
                                     <div><h3>PHYSICAL/ PERSONALITY DEVLOPEMENT</h3></div>
                                      <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Neat and Tidy</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sedev_one" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sedev_one" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Active</label><span style="color:red">*</span>
                                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sedev_two" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sedev_two" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username"> Healthy</label><span style="color:red">*</span>
                                     
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sedev_three" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sedev_three" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username">A good co-ordinator</label><span style="color:red">*</span>
                                      
                                        
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sedev_four" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['Grade']; ?>"  name="sedev_four" id="one" required >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['Grade']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                      <div class="form-group col-sm-12">
                                        <label for="username"> Remarks</label><span style="color:red">*</span>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php
                                                             foreach($cards as $card) {
                                                                 if($card['report_id'] % 2 == 0) {
                                                                 ?>
                                                                 <span syle="flot:left">
                                                                      <input class="form-check-input"  type="radio" value="<?php echo $card['remark']; ?>"  name="remark_two" id="one" required >
                                                                      <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['remark']; ?></label>
                                                                 </span>
                                                            
                                                                <?php  
                                                          }else{
                                                              ?>
                                                              <span syle="flot:right">
                                                                  <input class="form-check-input"  type="radio" value="<?php echo $card['remark']; ?>"  name="remark_two" id="one" required  >
                                                                  <label class="form-check-label"  style="margin-left: 20px;" for="one" ><?php echo $card['remark']; ?></label>
                                                              </span>
                                                   <?php } }
                                                ?>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                  
                                  </div>
                                <button class="btn btn-primary w-md waves-effect waves-light" name="submit" value="submit" type="submit">Submit</button>
                            </form>
                        </div>
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</body>
</html>
<?php $this->load->view('footd');?>
<script>
    $(document).ready(function(){
       <script type="text/javascript">
    $('.product-list').on('change', function() {
        $('.product-list').not(this).prop('checked', false);  
    });
  </script>
});

    });
</script>

<script>
    $(document).ready(function(){
   $("#btn").click(function () {
    		$("#Createsecond").hide();
        $("#Create").show();
    });
    
    $("#btnsecond").click(function () {
    		 $("#Create").hide();
        $("#Createsecond").show();
    });
    
    });
</script>

<?php if(isset($error)){ ?>
    <script type="text/javascript">
        color = Math.floor((Math.random() * 4) + 1);

        $.notify({
        icon: "tim-icons icon-bell-55",
        message: "<?php if(isset($error)){ echo $error['error']; } ?>"
        },{ type: type[color],
            timer: 8000,
        });
    </script>
<?php } ?>