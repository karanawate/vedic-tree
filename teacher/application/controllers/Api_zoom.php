<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/php-jwt-master/src/config.php");
require_once(APPPATH."libraries/php-jwt-master/src/SignatureInvalidException.php");
require_once(APPPATH."libraries/php-jwt-master/src/JWT.php");
use \Firebase\JWT\JWT;

class Api_zoom extends CI_Controller {

 public function  index()
 {
     
    $start_time1     = $this->input->post('start_time');
    $end_time       = $this->input->post('end_time');

     $datetime1  = new DateTime($start_time1);
     $datetime2  = new DateTime($end_time);
     $interval   =  $datetime1->diff($datetime2);
     //for hour
     $diffInhour = $interval->h;
     $multiplcation = $diffInhour * 60;
    //for second 
    $diffInSecond = $interval->i;
    $duration = $multiplcation + $diffInSecond;
    
    if ($this->session->userdata('usersession')) {
                $usersession             = $this->session->userdata('usersession');
                $usersession_id          = $usersession['0']['teacherId'];
                $fkclassId               = $usersession['0']['teacherClass'];
                $teacherEmail               = $usersession['0']['teacherEmail'];
                $data['selectedClass']   = $this->teacherModel->selectedClass();
                $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                $data['selectedsubject'] = $this->teacherModel->selectedsubject();
                $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                $topic_name              = $this->input->post('topic_name');
                $start_date1             = $this->input->post('start_date');
                $start_time1             = $this->input->post('start_time');
                $end_date                = $this->input->post('end_date');
                $agenda                  = $this->input->post('description');
                $fk_batchId              = $this->input->post('fk_batchId');
                $subjectid               = $this->input->post('subjectid');
                $fk_planId               = $this->input->post('fk_planId');
                
               
                $alternative_hosts         = $this->input->post('alternative_hosts');

                $arr['topic']             = $topic_name;
                $arr['teacherEmail']      = $teacherEmail;
                $arr['agenda']            = $agenda;
                $joinDate                 = $start_date1."T".date("H:i:s",strtotime($start_time1));
                $arr['start_date']        = $joinDate;
                $arr['duration']          = $duration;
                $arr['end_date_time']     = $end_date;
                $arr['password']='123456';
                $arr['type']='8';
                $arr['alternative_hosts']   = $alternative_hosts;
                

                           
                                if (isset($_POST['submit'])) {
                                   
                                    $this->form_validation->set_error_delimiters('<span>', '</span>');
                                    $this->form_validation->set_rules('fk_batchId', 'Batch Name', 'trim|required');
                                    $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
                                    $this->form_validation->set_rules('start_time', 'Start Time', 'trim|required');
                                    $this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
                                    $this->form_validation->set_rules('end_time', 'End Time', 'trim|required');
                                   
                                    
                                    if ($this->form_validation->run() == FALSE) {
                                         $this->load->view('livesession', $data);
                                        
                                    } else {
                                         
                                                $result=$this->createMeeting($arr);
                                                if(isset($result->id)){
                                                
                                                    $link_microsoft = $result->join_url;    
                                                    $meeting_id = $result->id;
                                                    $uuid = $result->uuid;
                                                    $host_id = $result->host_id;
    
                                                    // echo "Password: ".$result->password."<br/>";
                                                          $arr['type']='8';
                                                        foreach($result->occurrences as $meet) {
                                                            
                                                            // echo "Start Time: ".$meet->start_time."<br/>";
                                                            // echo "Duration: ".$meet->duration."<br/>";
                                                            foreach($fk_planId as $planId)
                                                           {
                                                            $data = array(
                                                                'occurrence_id'   =>$meet->occurrence_id,
                                                                'duration'        =>$meet->duration,
                                                                'start_time'      =>$meet->start_time,
                                                                'status'          =>$meet->status,
                                                                'fk_teacher_id'  =>$usersession_id,
                                                                'topic_name'      =>$topic_name,
                                                                'meeting_id'      =>$meeting_id,
                                                                'host_id'         =>$host_id,
                                                                'uuid'            =>$uuid,
                                                                'status'          => 1,
                                                                'fk_plan_id'      =>$planId
                                                               
                                                            );
                                                            $result = $this->db->insert('zoom_occurance_records',$data);
                                                            
                                                           }
                                                            
                                                        }
                                                    
                                            
                                                }else{
                                                    //  echo '<pre>';
                                                     
                                                
                                                
                                                } 
                                                    //   echo json_encode($result, JSON_PRETTY_PRINT);
                                                
                                                
                                                $fk_batchId     = $this->input->post('fk_batchId');
                                                $microsoft_link = $this->input->post('microsoft_link');
                                                $start_date1     = $this->input->post('start_date');
                                                $start_time1     = $this->input->post('start_time');
                                                $end_date       = $this->input->post('end_date');
                                                $end_time       = $this->input->post('end_time');
                                                $subjectid      = $this->input->post('subjectid');
                                                $fk_planId      = $this->input->post('fk_planId');

                                                $arr['topic']             = $topic_name;
                                                $arr['agenda']            = $agenda;
                                                $joinDate                 = $start_date1."T".date("H:m:s",strtotime($start_time1));
                                                $arr['start_date']        = $joinDate;
                                                $arr['duration']          = $duration;
                                                $arr['end_date_time']     = $end_date;
                                                $arr['password']='';
                                                $arr['type']='8';
                                            foreach($fk_planId as $planId)
                                            {
                                                $data = array(
                                                    'fkclassId'       => $fkclassId,
                                                    'fk_batchId'      => $fk_batchId,
                                                    'microsoft_link'  => $link_microsoft,
                                                    'start_date'      => $start_date1,
                                                    'start_time'      => $start_time1,
                                                    'end_date'        => $end_date,
                                                    'end_time'        => $end_time,
                                                    'fk_planId'       => $planId,
                                                    'teacher_id'      => $usersession_id,
                                                    'subjectid'       => $subjectid,
                                                    'description'     =>$agenda,
                                                    'topic_name'      =>$topic_name,
                                                    'duration'        =>$duration,
                                                    'meeting_id'      =>$meeting_id,
                                                    'host_id'         =>$host_id,
                                                    'uuid'            =>$uuid,
                                                    'status'          => 1
                                                    
                                                 );
                                                
                                                 $res  = $this->teacherModel->notice($data);
    
                                                
                                            }
                                                
                                                                                
                                                if ($res == 1) {
                                                    $data['error'] = array(
                                                        'error' => "Live Session Crerated Successfully !"
                                                    );
                                                    $this->load->view('livesession', $data);
                                                } else {
                                                    $data['error'] = array(
                                                        'error' => "Live Session Not Crerated Successfully !"
                                                    );
                                                    $this->load->view('livesession', $data);
                                                }
                                                
                                                
                                            }
                                            
                                        
                                        
                                        
                                    
                                    
                                    
                                }
    } else {
        redirect('teacher-login');
    }


 }


 public function createMeeting($data = array())
{
    $post_time = $data['start_date'];
//  $start_time = gmdate("Y-m-d\TH:i:s", strtotime($post_time));

    

    $createMeetingArr = array();
    if (!empty($data['alternative_host_ids']))
    {
        if (count($data['alternative_host_ids']) > 1)
        {
            $alternative_host_ids = implode(",", $data['alternative_host_ids']);
        }
        else
        {
            $alternative_host_ids = $data['alternative_host_ids'][0];
        }
    }

    $createMeetingArr['topic']         = $data['topic'];
    $createMeetingArr['teacherEmail']  = $data['teacherEmail'];
    $end_date_time                   =  $data['end_date_time'];
    $createMeetingArr['agenda']      = !empty($data['agenda']) ? $data['agenda'] : "";
    $createMeetingArr['type']        = !empty($data['type']) ? $data['type'] : 8; //Scheduled
    $createMeetingArr['start_time']  = $data['start_date'];
    $createMeetingArr['timezone']    = 'Asia/Kolkata';
    $createMeetingArr['password']    = "";
    $createMeetingArr['duration']    = !empty($data['duration']) ? $data['duration'] : 120;
    

    $createMeetingArr['settings'] = array(
        'join_before_host'        => !empty($data['join_before_host']) ? true : true,
        'host_video'              => !empty($data['option_host_video']) ? true : true,
        'participant_video'       => !empty($data['option_participants_video']) ? true : true,
        'mute_upon_entry'         => !empty($data['option_mute_participants']) ? true : true,
        'enforce_login'           => !empty($data['option_enforce_login']) ? true : false,
        'meeting_authentication'  => !empty($data['meeting_authentication']) ? true : true,
        'auto_recording'          => !empty($data['option_auto_recording']) ? $data['option_auto_recording'] : "none",
        'alternative_hosts'      => !empty($data['alternative_hosts']) ? $data['alternative_hosts'] : "Live.vedictree@gmail.com"

    );
 
    $createMeetingArr["recurrence"] = array(
            "type"            => 1,
            "repeat_interval" =>1,
            "end_date_time"   =>$end_date_time."T12:00:00Z"
    );
   
    $request_url = "https://api.zoom.us/v2/users/" .$createMeetingArr['teacherEmail']. "/meetings";
    $token = array(
        "iss" => API_KEY,
        "exp" => time() + 3600 //60 seconds as suggested
        
    );
    $getJWTKey = JWT::encode($token, API_SECRET);
    $headers = array(
        "authorization: Bearer " . $getJWTKey,
        "content-type: application/json",
        "Accept: application/json",
    );
    
    $fieldsArr = json_encode($createMeetingArr);
    

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $request_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $fieldsArr,
        CURLOPT_HTTPHEADER => $headers,
    ));

    $result = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if (!$result)
    {
        return $err;
    }
    return json_decode($result);
}


public function deleteliveid()
{
    $usersession = $this->session->userdata('usersession');
    
    if ($usersession[0]['adminRole'] == 1) {
        
        if (isset($_POST['submit'])) {
            
            $this->form_validation->set_error_delimiters('<span>', '</span>');
            $this->form_validation->set_rules('live_id', 'id', "trim|required|numeric|greater_than[0]");
            if ($this->form_validation->run() == FALSE) {
                $teacher_session           = $usersession['0']['teacherId'];
                $data['view_live_session'] = $this->teacherModel->session_teacher_id($teacher_session);
                $this->load->view('view_livesession', $data);
            } else {
                  $live_id    = $this->input->post('live_id');
                  $result     = $this->teacherModel->get_liveiddeleted($live_id);
                  $meetingId = $result['0']['meeting_id'];
                 
                
                $request_url = 'https://api.zoom.us/v2/meetings/' . $meetingId;
               
                $token = array(
                    "iss" => API_KEY,
                    "exp" => time() + 3600 //60 seconds as suggested
                    
                );

                $getJWTKey = JWT::encode($token, API_SECRET);

                $headers = array(
                    "authorization: Bearer " . $getJWTKey,
                    "content-type: application/json",
                    "Accept: application/json",
                );
                $get_param = array('meetingId' => $meetingId);
                $ch        = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $request_url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response    = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $err         = curl_error($ch);
                curl_close($ch);
                // if (!$response) {
                //     return true;
                // }
                // return json_decode($response);

                $result  = $this->teacherModel->liveiddeleted($meetingId);
                
                if ($result == 1) {
                    $data['error']             = array(
                        'error' => "Live session Deleted Successfully !"
                    );
                    $teacher_session           = $usersession['0']['teacherId'];
                    $data['view_live_session'] = $this->teacherModel->session_teacher_id($teacher_session);
                    $this->load->view('view_livesession', $data);
                } else {
                    $data['error']       = array(
                        'error' => "Live session not Deleted Successfully !"
                    );
                    $teacher_session     = $usersession['0']['teacherId'];
                    $data['getstudlist'] = $this->teacherModel->getstudlist();
                    $this->load->view('view_livesession', $data);
                }
            }
            
        } else {
            
            $teacher_session     = $usersession['0']['teacherId'];
            $data['getstudlist'] = $this->teacherModel->getstudlist();
            $this->load->view('view_livesession', $data);
        }
    }
}

public function  zoom_meetings()
{
    // echo "Hello";
    
    $usersession = $this->session->userdata('usersession');
    if (!empty($usersession)) {
        if ($usersession[0]['adminRole'] == 1) {
            if ($this->session->userdata('usersession')) {
                $usersession              = $this->session->userdata('usersession');
                $teacher_session          = $usersession['0']['teacherId'];
               
                $res['list_zoom_meeting'] = $this->teacherModel->list_zoom_meeting();
                $this->load->view('zoom_meetings', $res);
                
                
               
            } else {
                redirect('teacher-login');
            }
        }
    } else {
        redirect('teacher-login');
    }
}

public function report_parti()
{
    
    
     $result  = $this->teacherModel->list_zoom_meeting();
     $zoom_id    = $result[0]['meeting_id'];
    //  $zoom_id    = $this->uri->segment(3);
     $result = $this->teacherModel->get_zoom_details($zoom_id);
     $meetingId  = $result['0']['meeting_id'];
     
     $start_time = $result['0']['start_time'];
     $end_time  =  $result['0']['end_time'];
     $topic_name  =  $result['0']['topic_name'];
   
     $arr['meetingId'] = $meetingId;
       
        $results_report = $this->teacherModel->check_report_dateandstatuswise($start_time,$end_time);
        
        if(empty($results_report))
        {
        $result=$this->viewMeeting($arr);
        date_default_timezone_set("Asia/Kolkata");
        $date =  Date('Y-m-d');
        $time =  Date('H:i:s');
        foreach($result->participants as $meet) {
                $data = array(
                    'user_id'         =>$meet->user_id,
                    'name'            =>$meet->name,
                    'user_email'      =>$meet->user_email,
                    'join_time'       =>$meet->join_time,
                    'leave_time'      =>$meet->leave_time,
                    'duration'        =>$meet->duration,
                    'meetingId'       =>$meetingId,
                    'status'          =>1,
                    'report_status'   =>1,
                    'created_date'    =>$date,
                    'created_time'    =>$time,
                    'fk_start_time'   =>$start_time,
                    'fk_end_time'      =>$end_time,
                    'topicName'      =>$topic_name
                );
                
                $result = $this->teacherModel->occurance_report($data);
            }
            
            $this->session->set_flashdata('msg', 'Generate Report');
            redirect('api_zoom/zoom_meetings');
        }
        else
        {

            $this->session->set_flashdata('msg', 'Already Generated Report');
            redirect('api_zoom/zoom_meetings');
           
        }
       
   
}

public function viewMeeting($data = array())
{
    $view_MeetingArr = array();
    $view_MeetingArr["recurrence"] = array(
            "type"      =>'past',
            "page_size" =>30,
    );
    $meetingIdmy = $data['meetingId'];
   
    $request_url = "https://api.zoom.us/v2/report/meetings/" .$meetingIdmy. "/participants";
    $token = array(
        "iss" => API_KEY,
        "exp" => time() + 3600 //60 seconds as suggested
        
    );
    $getJWTKey = JWT::encode($token, API_SECRET);
    $headers = array(
        "authorization: Bearer " . $getJWTKey,
        "content-type: application/json",
        "Accept: application/json",
    );
    
    $fieldsArr = json_encode($view_MeetingArr);
    

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $request_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => $meetingIdmy,
        CURLOPT_HTTPHEADER => $headers,
    ));

    $result = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if (!$result)
    {
        return $err;
    }
    return json_decode($result);
}

public function get_particular_meeting_wise()
{
    $meeting_id    = $this->uri->segment(3);
    $result['unique_zoom_meeting'] = $this->teacherModel->get_particular_report($meeting_id);
    
  
    return $this->load->view('unique_zoom_meeting_report', $result);
}



 
}
?>