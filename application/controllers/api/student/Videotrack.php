<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Videotrack extends REST_Controller 
{

public function index_post(){
    
         $duration      = $this->input->post('durations');
         $seconds       = $this->input->post('secondss');
         $videoId       = $this->input->post('videoId');
         $monthId       = $this->input->post('monthId');
         $dayId         = $this->input->post('dayId');
         $fk_classId    = $this->input->post('fk_classId');
         $fk_sessionId  = $this->input->post('fk_sessionId');
         $studId        = $this->input->post('studId');
    
         if($duration==""){
            $data = array('msg' => "duration required ",'code'=>404);
         }else if($seconds==""){
            $data = array('msg' => "seconds required ",'code'=>404);
         }else if($videoId==""){
            $data = array('msg' => "videoId required ",'code'=>404);
         }else if($seconds==""){
            $data = array('msg' => "seconds required ",'code'=>404);
         }else if($monthId==""){
            $data = array('msg' => "monthId required ",'code'=>404);
         }else if($dayId==""){
            $data = array('msg' => "dayId required ",'code'=>404);
         }else if($fk_classId==""){
            $data = array('msg' => "fk_classId required ",'code'=>404);
         }else if($studId==""){
            $data = array('msg' => "studId required ",'code'=>404);
         }else{
               date_default_timezone_set('Asia/Kolkata');
               $createTrackDT = date("Y-m-d h:i:s");
     
           $dataarray     = array(
                              'trackStartTime' => $duration ,
                              'trackEndTime'   => $seconds ,
                              'trackDuration'  => $duration ,
                              'videoId'        => "https://player.vimeo.com/video/".$videoId, 
                              'fk_monthId'     => $monthId, 
                              'fk_dayId'       => $dayId, 
                              'fk_classId'     => $fk_classId, 
                              'createTrackDT'  => $createTrackDT, 
                              'fk_sessionId'   => $fk_sessionId, 
                              'fk_user_id'     => $studId 
                        );
            $res = $this->regModel->tbl_tracking_watch_video($dataarray);
            if($res==1){
               $data['error'] = array('error' => "Tracking Data Stored Successfully !");
             }else{
               $data['error'] = array('error' => "Tracking Data Is not Stored !");
             }
        }
    
    $this->response($data, REST_Controller::HTTP_OK);
}



public function progress_post(){


    $fk_studId  = $this->input->post('studId');
    if($fk_studId==""){
        $data = array('msg' => "studId required ",'code'=>404);
    }else{
        //date_default_timezone_set('Asia/Kolkata');
        $Current_datetime = date("Y-m-d 00:00:00");
        $End_datetime = date("Y-m-d 23:59:59");
        $student_daily_reports = $this->regModel->student_daily_reports_mob($fk_studId,$Current_datetime,$End_datetime);
            $sessionName     = array();
            $trackStartTime  = array();
            $trackDuration   = array();
            $trackEndTime    = array();
            $sessionImages    = array();
            
        if(!empty($student_daily_reports)){
            foreach ($student_daily_reports as $key => $value) {
             $sessionName[]    = $value['sessionName'];
             $trackDuration[]  = $value['trackDuration'];
             $trackEndTime[]   = $value['trackEndTime'];
             $trackStartTime[] = $value['trackStartTime'];
             $sessionImages[]  = $value['sessionImages'];
            }
            
                                        
          $data['error'] = array('error' => "Tracking Data fetched Successfully !",'sessionName'=>$sessionName,'trackDuration'=>$trackDuration,'trackEndTime'=>$trackEndTime,'trackStartTime'=>$trackStartTime,'sessionImages'=>$sessionImages);
         }else{
           $data['error'] = array('error' => "Tracking Data Is not fetched !",'sessionName'=>$sessionName,'trackDuration'=>$trackDuration,'trackEndTime'=>$trackEndTime,'trackStartTime'=>$trackStartTime,'sessionImages'=>$sessionImages);
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
       // date_default_timezone_set('Asia/Kolkata');
        $Current_datetime = date("Y-m-d 00:00:00");
        $lastWeek = "";
        if($weekdata=="week"){
          $lastWeek = date("Y-m-d 00:00:00", strtotime("-7 days"));
        }else if ($weekdata=="month") {
          $lastWeek = date("Y-m-d 00:00:00", strtotime("-30 days"));
        }elseif ($weekdata=="today") {
          $lastWeek = date("Y-m-d 23:59:59");
        }
    
            $sessionName     = array();
            $trackStartTime  = array();
            $trackDuration   = array();
            $trackEndTime    = array();
            $sessionImages    = array();
            
        $student_daily_reports = $this->regModel->student_daily_reports_filter_mob($studId,$Current_datetime,$lastWeek,$weekdata);
        if(!empty($student_daily_reports)){
            
            foreach ($student_daily_reports as $key => $value) {
                
             $sessionName[]    = $value['sessionName'];
             $trackDuration[]  = $value['trackDuration'];
             $trackEndTime[]   = $value['trackEndTime'];
             $trackStartTime[] = $value['trackStartTime'];
             $sessionImages[]  = $value['sessionImages'];
             
            }
            
                                        
          $data['error'] = array('error' => "Tracking Data fetched Successfully !",'sessionName'=>$sessionName,'trackDuration'=>$trackDuration,'trackEndTime'=>$trackEndTime,'trackStartTime'=>$trackStartTime,'sessionImages'=>$sessionImages);
         }else{
           $data['error'] = array('error' => "Tracking Data Is not fetched !",'sessionName'=>$sessionName,'trackDuration'=>$trackDuration,'trackEndTime'=>$trackEndTime,'trackStartTime'=>$trackStartTime,'sessionImages'=>$sessionImages);
        }
    }
             
         $this->response($data, REST_Controller::HTTP_OK);
         
        
}



}


?>