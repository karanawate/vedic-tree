<?php


 $CI =& get_instance();
 getcountofvideos1();

function sendsms($mobileno, $message){


$xml = '<?xml version="1.0" encoding="UTF-8"?>
    <Message>
       <key>460B8D6A59F284</key>
       <campaign>0</campaign>
       <routeid>13</routeid>
       <type>text</type>
       <contacts>
         <msisdn>'.$mobileno.'</msisdn>
       </contacts>
       <senderid>DEMO</senderid>
       <msg>'.$message.'</msg>
       <time></time>
    </Message>';
//Submit to server

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://bulksms.nobleconnect.in/app/smsapi/index.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=".$xml);
$response = curl_exec($ch);
curl_close($ch);

$xml_response = simplexml_load_string($response);

echo "<pre>";
print_r($xml_response);
die;
    
}

 function tbl_notification_live_class_teacher()
{
    $CI =& get_instance();
    $usersession    = $CI->session->userdata('usersession');
    $currentDate    = date("Y-m-d");
    $CI->db->where('teacher_id',$usersession[0]['teacherId']);
    $CI->db->where('start_date',$currentDate);
    $CI->db->where('fkclassId',$usersession[0]['teacherClass']);
    return  $num_rows = $CI->db->get('tbl_notification_live_class')->result_array();
    
         
}

function get_learning_page_month_wisefilter()
{
     $CI =& get_instance();
     $currentDatenow    = date("Y-m-d");
    //  $currentDate = date('Y-m-d', strtotime($currentDatenow. ' + 8 days'));
     $currentDate = date('Y-m-d', strtotime($currentDatenow));
     $CI->db->where('calDate',$currentDate);
    return  $num_rows = $CI->db->get('tbl_calender_open_day')->result_array();
         
}



function notification_count()
{
    $CI =& get_instance();
    $CI->db->where('status',1);
    return $num_rows = $CI->db->count_all_results('notice');
}

function notification()
{
    $CI =& get_instance();
    $CI->db->where('status',1);
    return $num_rows = $CI->db->get('notice')->result_array();
}

function tbl_notification_live_class()
{
    $CI =& get_instance();
    $usersession    = $CI->session->userdata('usersession');
    $currentDate  = date("Y-m-d");
    $CI->db->where('status',1);
    $CI->db->where('start_date',$currentDate);
    $CI->db->where('fkclassId',$usersession[0]['teacherClass']);
    return $num_rows = $CI->db->get('tbl_notification_live_class')->result_array();
     
}


function required_data()
{
    $CI =& get_instance();

    $usersession    = $CI->session->userdata('usersession');


    $CI->db->where('fk_studId',$usersession[0]['studId']);
    $CI->db->where('paystatus',"success");
    $CI->db->where('paystatusId',1);
    $open_monthdata = $CI->db->get('log_payment_data')->result_array();
    
    //for emi pending logic
    
    $CI->db->where('status',1);
    $getClass = $CI->db->get('tbl_class')->result_array();

    if(!empty($open_monthdata)){
        
     $CI->db->where('mId <=',$open_monthdata[0]['fk_monthId']);
     $monthdata = $CI->db->get('tbl_month')->result_array();
    }else{
        $CI->db->where('mId <=',1);
      $monthdata = $CI->db->get('tbl_month')->result_array();
    
    }
    

    $daydata = $CI->db->get('tbl_days')->result_array();

    $contnet_type = $CI->db->get('tbl_contnet_type')->result_array();

    $sessionType = $CI->db->get('tbl_session_type')->result_array();

    $catergory = $CI->db->get('tbl_category')->result_array();


    $data  = array('getClass' => $getClass , 'daydata'=>$daydata,'monthdata'=>$monthdata,'contnet_type'=>$contnet_type,'sessionType'=>$sessionType,'catergory'=>$catergory);
    return $data;

}


function check_user_state($studId){
    $CI =& get_instance();
    $CI->db->where('studId',$studId);
    return $num_rows = $CI->db->get('studentreg')->result_array();
}

function required_month(){
    $CI =& get_instance();
    $daydata = $CI->db->get('tbl_days')->result_array();
     $monthdata = $CI->db->get('tbl_month')->result_array();
     return $data  = array('monthdata' => $monthdata,'daydata'=>$daydata);

}

function required_data_admin()
{
    $CI =& get_instance();

    $CI->db->where('status',1);
    $getClass = $CI->db->get('tbl_class')->result_array();

    $monthdata = $CI->db->get('tbl_month')->result_array();
    // echo $CI->db->last_query();
    // print_r($monthdata);

    $daydata = $CI->db->get('tbl_days')->result_array();

    $contnet_type = $CI->db->get('tbl_contnet_type')->result_array();

    $sessionType = $CI->db->get('tbl_session_type')->result_array();

    $catergory = $CI->db->get('tbl_category')->result_array();


    $data  = array('getClass' => $getClass , 'daydata'=>$daydata,'monthdata'=>$monthdata,'contnet_type'=>$contnet_type,'sessionType'=>$sessionType,'catergory'=>$catergory);
    return $data;

}


function listvideouploadings($fk_monthId){
    $CI =& get_instance();
    
    $CI->db->select('*');
    $CI->db->from('tbl_videouploadingdata');
    $CI->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
    $CI->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
    $CI->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
    $CI->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
    $CI->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
    $CI->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
    $CI->db->where_in('tbl_videouploadingdata.fk_monthId',$fk_monthId);
    $CI->db->where('tbl_videouploadingdata.status',1);
    $res = $CI->db->get()->result_array();

    if(!empty($res)){
        return $res;
    }else {
        return $res;
    }
}


function getclass($studId)
{

    $CI =& get_instance();

    $CI->db->where('studId',$studId);
    $CI->db->join('tbl_class','tbl_class.classId = studentreg.studentClass');
    $getClass = $CI->db->get('studentreg')->result_array();
    if($getClass){
     return $getClass[0]['className'];
    }
}

 function feesstructre($planId)
{

    $CI =& get_instance();
    $CI->db->where('feesId',$planId);
    $res = $CI->db->get('tab_add_fees_data')->result_array();
    if(!empty($res)){
        return $res;
    }else {
        return $res;
    }
}

function getcountofvideos1(){

}

function day_open_for_next_session() {

    $CI =& get_instance();

    $usersession    = $CI->session->userdata('usersession');
    $fk_classId = $usersession[0]['studentClass'];
    $date = date("Y-m-d 00:00:00");
    $enddate = date("Y-m-d 23:59:59");

    $CI->db->where('createTrackDT >=',$date);
    $CI->db->where('createTrackDT <=',$enddate);
    $CI->db->order_by('trackId','desc');
    $CI->db->limit(1);
    $res = $CI->db->get('tbl_tracking_watch_video')->result_array();
    if(!empty($res)){

        return $res;
    }else {
        return $res;
    }

}


//chat code start from here //

function getChatData_today_count_of_one_to_onemsgcount($stud_id)
{
   
    $start_date = date('Y-m-d 00:00:00');
    $end_date = date('Y-m-d 23:59:59');
    $CI =& get_instance();
    $CI->db->where('readMsg',1);
    $CI->db->where('fk_studId',$stud_id);
    $CI->db->where('currentDate BETWEEN "'. $start_date. '" and "'. $end_date.'"');
    $results = $CI->db->get('teacher_chat_window')->result_array();
    // echo $CI->db->last_query();
    return $results;

}


function getChatData_today_count_of_one_to_onemsg_last_seen($stud_id)
{
   
    $start_date = date('Y-m-d 00:00:00');
    $end_date = date('Y-m-d 23:59:59');
    $CI =& get_instance();
    $CI->db->where('fk_studId',$stud_id);
    $CI->db->where('currentDate BETWEEN "'. $start_date. '" and "'. $end_date.'"');
    $CI->db->order_by('techcId','desc');
	$CI->db->limit(1);
    $results = $CI->db->get('teacher_chat_window')->result_array();
    //  echo $CI->db->last_query();
    return $results;

}

function getChatData_today_count_of_student_msg($stud_planid)
{
   
    $start_date = date('Y-m-d 00:00:00');
    $end_date = date('Y-m-d 23:59:59');
    $CI =& get_instance();
    $CI->db->where('readMsg',1);
    $CI->db->where('stud_planid',$stud_planid);
    $CI->db->where('currentDate BETWEEN "'. $start_date. '" and "'. $end_date.'"');
    $results = $CI->db->get('teacher_chat_window')->result_array();
    return $results;

}




        

?>