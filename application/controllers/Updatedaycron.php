<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updatedaycron extends CI_Controller {


public function testcron1(){
   $this->db->select('fk_studId');
   $this->db->where('planId',1);
   $this->db->or_where('planId',6);
   $this->db->or_where('planId',11);
   $res = $this->db->get('log_payment_data')->result_array();
   date_default_timezone_set('Asia/Kolkata');
   $currentDate = date('Y-m-d');
   $this->db->where('calDate',$currentDate);
   $result = $this->db->get('tbl_calender_open_day')->result_array();

   if($result){
       foreach($res as $value){
         $updatearray = array('unlockdayId'=>$result[0]['Days'],'unlock_monthId'=>$result[0]['Months']);
         $this->db->where('studId',$value['fk_studId']);
         $res =  $this->db->update('studentreg',$updatearray); 
         echo $res;
       }
    }
}




public function testcron3(){
   $this->db->select('fk_studId');
   $this->db->where('planId',17);
   $this->db->or_where('planId',18);
   $this->db->or_where('planId',19);
   $res = $this->db->get('log_payment_data')->result_array();
   date_default_timezone_set('Asia/Kolkata');
   $currentDate = date('Y-m-d');
   $this->db->where('calDate',$currentDate);
   $result = $this->db->get('tbl_calender_open_coursewise_day')->result_array();

   if($result){
       foreach($res as $value){
         $updatearray = array('unlockdayId'=>$result[0]['Days'],'unlock_monthId'=>$result[0]['Months']);
         $this->db->where('studId',$value['fk_studId']);
         $res =  $this->db->update('studentreg',$updatearray); 
         echo $res;
       }
    }
}






function testcron2(){

  $this->db->select('fk_studId');
  $this->db->where('planId !=',1);
  $this->db->where('planId !=',6);
  $this->db->where('planId !=',11);
  $res = $this->db->get('log_payment_data')->result_array();

   
  foreach($res as $value){
    $updatearray = array('unlockdayId'=>'20','unlock_monthId'=>'1');
    $this->db->where('studId',$value['fk_studId']);
     $res =  $this->db->update('studentreg',$updatearray); 
     echo $res;
  }
}



public function disableAccount()
{

   date_default_timezone_set('Asia/Kolkata');
   $currentDate = date("Y-m-d",strtotime('yesterday'));
   $disableAccount = $this->regModel->disableAccount($currentDate);
   if($disableAccount==1){
      echo "Account De-Activated";
   }else{
      echo "Account Not De-Activated";
   }

}



public function unlock_account_which_is_blocked()
{
  
  $res = $this->regModel->unlock_account_which_is_blocked();
  if($res==1){
   echo "Account Hacked is reseted !";
  }else if($res==2){

   echo "Account Not Hacked";
  }else {

   echo "Account Hacked is not reseted !";
  }


}



public function check_here_multiple_browser_not_open_trunk_db()
{
    
  $res = $this->regModel->check_here_multiple_browser_not_open_trunk_db();
  if($res==1){
    echo "All Account reseted!";
  }else {

   echo "Account Hacked is not reseted !";
  }
  
}



public function clearIpaddress(){
    
 $res = $this->regModel->ipaddressclinetclear();
 if($res==1){
    echo "All Ipaddress Cleared!";
  }else {
   echo "All Ipaddress  not Cleared !";
  }
  
}


public function updateCourseDay()
{
    
  $res = $this->regModel->updateCourseDay();
  if($res==1){
    echo "Course is Updated Successfully !";
  }else if($res==3){
    echo "Student List is not Found !";
  }else{
   echo "Course is not Updated Successfully !";
  }
  
    
}


function changepromoCodeStatus(){
    
    $res = $this->regModel->changepromoCodeStatus();
     if($res==1){
        echo "Promocode Status changed!";
      }else {
       echo "Promocode Status not changed !";
      }
  
    
}











}

?>