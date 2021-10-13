<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Preport extends REST_Controller 
{

public function index_post(){


    $fk_studId  = $this->input->post('studId');
    if($fk_studId==""){
        $data = array('msg' => "studId required ",'code'=>404);
    }else{
        date_default_timezone_set('Asia/Kolkata');
        $Current_datetime = date("Y-m-d 00:00:00");
        $End_datetime = date("Y-m-d 23:59:59");
        $student_daily_reports = $this->regModel->student_daily_reports($fk_studId,$Current_datetime,$End_datetime);
        
        if(!empty($student_daily_reports)){
           $data['error'] = array('error' => "Tracking Data fetched Successfully !",'student_daily_reports'=>$student_daily_reports);
         }else{
           $data['error'] = array('error' => "Tracking Data Is not fetched !",'student_daily_reports'=>$student_daily_reports);
        }
    }
             
         $this->response($data, REST_Controller::HTTP_OK);
}


public function filter_post()
{
    
    $weekdata = $this->input->post('weekdata');
    $studId = $this->input->post('studId');
        
    if($weekdata==""){
        $data = array('msg' => "weekdata required ",'code'=>404);
    }else{
        date_default_timezone_set('Asia/Kolkata');
        $Current_datetime = date("Y-m-d 00:00:00");
        $lastWeek = "";
        if($weekdata=="weekdata"){
          $lastWeek = date("Y-m-d", strtotime("-7 days"));
        }else if ($weekdata=="monthdata") {
          $lastWeek = date("Y-m-d", strtotime("-30 days"));
        }elseif ($weekdata=="today") {
          $lastWeek = date("Y-m-d 23:59:59");
        }

        $student_daily_reports = $this->regModel->student_daily_reports_filter($studId,$Current_datetime,$lastWeek);
        if(!empty($student_daily_reports)){
          $data['error'] = array('error' => "Tracking Data fetched Successfully !",'student_daily_reports'=>$student_daily_reports);
         }else{
           $data['error'] = array('error' => "Tracking Data Is not fetched !",'student_daily_reports'=>$student_daily_reports);
        }
    }
             
         $this->response($data, REST_Controller::HTTP_OK);
         
        
}



}

?>
        