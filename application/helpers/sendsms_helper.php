<?php


function sendsms($mobileno, $message){
    
    $xml_data ='<?xml version="1.0"?>
    <parent>    
    <child>
    <user>vedics</user>
    <key>ec1f6ed2c3XX</key>
    <mobile>+91'.$mobileno.'</mobile>
    <message>'.$message.'</message>
    <accusage>1</accusage>
    <senderid>EVEDIC</senderid>
    <enityid>1001808495791552683</enityid>
    <tempid>1007272470191460107</tempid>
    </child>
    </parent>';

    $URL = "http://sms.gymduniya.com/submitsms.jsp?"; 
    $ch = curl_init($URL);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $res = explode(",", $output);
    // print_r($res);
    // die;
    $msg = "";
    for ($i=0; $i<count($res);$i++) { 
        if($res[$i]=="fail")
        {
            $msg = "fail";
        }else if($res[$i]=="InsufficientBalance"){
            $msg = "InsufficientBalance";
        }
    }
    return $msg;
    
}

function sendsmsweb($mobileno,$otpNumber,$message){
    
    $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://2factor.in/API/V1/64423750-ccff-11eb-8089-0200cd936042/SMS/".$mobileno."/".$otpNumber."/EVEDIC",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return $msg = "cURL Error #:" . $err;
        } else {

            $response = json_decode($response);
            if($response->Status=="Success"){
                return "Success";
            }else{
                return "fail";
            }
        }
    
}


function get_open_previous_day()
{
    $CI =& get_instance();
    date_default_timezone_set('Asia/Kolkata');
    $currentDate    = date("Y-m-d",strtotime("- 1 day"));

    $CI->db->where('calDate',$currentDate);
    return $tbl_calender_open_day = $CI->db->get('tbl_calender_open_day')->result_array();

}


function get_open_previous_course_day()
{
    $CI =& get_instance();
    date_default_timezone_set('Asia/Kolkata');
    $currentDate    = date("Y-m-d",strtotime("- 1 day"));

    $CI->db->where('calDate',$currentDate);
    return $tbl_calender_open_day = $CI->db->get('tbl_calender_open_coursewise_day')->result_array();

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

function check_user_state($studId){
    $CI =& get_instance();
    $CI->db->where('studId',$studId);
    return $num_rows = $CI->db->get('studentreg')->result_array();
}


function tbl_notification_live_class()
{
    $CI =& get_instance();
    $usersession    = $CI->session->userdata('usersession');
    
    $promoCode       = $usersession[0]['promoCode'];


    if($promoCode=="freeEducation")
    {
        $currentDate    = date("Y-m-d");
        $CI->db->where('status',1);
        $CI->db->where('start_date',$currentDate);
        return $num_rows = $CI->db->get('tbl_notification_live_class')->result_array();

    } else {

        $CI->db->where('fk_studId',$usersession[0]['studId']);
        $results = $CI->db->get('tbl_allocate_teacher_to_student')->result_array();
        if(!empty($results)){
        $currentDate    = date("Y-m-d");
        $CI->db->where('status',1);
        $CI->db->where('fk_planId',$results[0]['fk_feesId']);
        $CI->db->where('start_date',$currentDate);
        $CI->db->where('fkclassId',$usersession[0]['studentClass']);
            return $num_rows = $CI->db->get('tbl_notification_live_class')->result_array();
        }else{
          return  $results;
        }    
    }
    
     
}



function required_data()
{
    $CI =& get_instance();

    $usersession    = $CI->session->userdata('usersession');
  
    $CI->db->where('studId',$usersession[0]['studId']);
    $open_monthdata = $CI->db->get('studentreg')->result_array();

    //for emi pending logic
    
    $CI->db->where('status',1);
    $getClass = $CI->db->get('tbl_class')->result_array();

    if(!empty($open_monthdata)){
        
     $CI->db->where('mId <=',$open_monthdata[0]['unlock_monthId']);
     $monthdata = $CI->db->get('tbl_month')->result_array();
    }else{
        $CI->db->where('mId <=',1);
      $monthdata = $CI->db->get('tbl_month')->result_array();
    
    }

    $daydata = $CI->db->get('tbl_days')->result_array();
    
    $tbl_calender_open_day = $CI->db->get('tbl_calender_open_day')->result_array();
    

    $contnet_type = $CI->db->get('tbl_contnet_type')->result_array();

    $sessionType = $CI->db->get('tbl_session_type')->result_array();

    $catergory = $CI->db->get('tbl_category')->result_array();
    
    $CI->db->where('fk_studId',$usersession[0]['studId']);
    $paymentMonth = $CI->db->get('log_payment_data')->result_array();
    

    $data  = array('getClass' => $getClass , 'daydata'=>$daydata,'monthdata'=>$monthdata,'contnet_type'=>$contnet_type,'sessionType'=>$sessionType,'catergory'=>$catergory,'paymentMonth'=>$paymentMonth,'tbl_calender_open_day'=>$tbl_calender_open_day,'open_monthdata'=>$open_monthdata);
    return $data;

}

function required_course_data()
{
    $CI =& get_instance();

    $usersession    = $CI->session->userdata('usersession');
  
    $CI->db->where('studId',$usersession[0]['studId']);
    $open_monthdata = $CI->db->get('studentreg')->result_array();

    //for emi pending logic
    
    $CI->db->where('status',1);
    $getClass = $CI->db->get('tbl_class')->result_array();

    if(!empty($open_monthdata)){
        
     $CI->db->where('mId <=',$open_monthdata[0]['unlock_monthId']);
     $monthdata = $CI->db->get('tbl_month')->result_array();
    }else{
        $CI->db->where('mId <=',1);
      $monthdata = $CI->db->get('tbl_month')->result_array();
    
    }

    $daydata = $CI->db->get('tbl_days')->result_array();
    
    $tbl_calender_open_day = $CI->db->get('tbl_calender_open_coursewise_day')->result_array();
    

    $contnet_type = $CI->db->get('tbl_contnet_type')->result_array();

    $sessionType = $CI->db->get('tbl_session_type')->result_array();

    $catergory = $CI->db->get('tbl_category')->result_array();
    
    $CI->db->where('fk_studId',$usersession[0]['studId']);
    $paymentMonth = $CI->db->get('log_payment_data')->result_array();
    

    $data  = array('getClass' => $getClass , 'daydata'=>$daydata,'monthdata'=>$monthdata,'contnet_type'=>$contnet_type,'sessionType'=>$sessionType,'catergory'=>$catergory,'paymentMonth'=>$paymentMonth,'tbl_calender_open_day'=>$tbl_calender_open_day,'open_monthdata'=>$open_monthdata);
    return $data;

}

function tbl_calender_open_day()
{
    $CI =& get_instance();
    $CI->db->where('calDate <=',date("Y-m-d"));
    $CI->db->limit(1);
    $CI->db->order_by('calDate','desc');
    $tbl_calender_open_day = $CI->db->get('tbl_calender_open_day')->result_array();
   
    return $data = array('tbl_calender_open_day'=>$tbl_calender_open_day);
}

function tbl_batch_month($paymentDate)
{
    $CI =& get_instance();
    $CI->db->where('tbl_batchDT <=',date("Y-m-d"));
    $CI->db->where('tbl_batchDT >=',$paymentDate);
    $tbl_batch_month = $CI->db->get('tbl_batch_month')->result_array();
    return $data = array('tbl_batch_month'=>$tbl_batch_month);
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

function updateFinalPaymentStatus($studId)
{

    $CI =& get_instance();
    $CI->db->where('fk_studId',$studId);
	$CI->db->where('log_payment_data.paystatusId',4);
	$CI->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
	$CI->db->join('tbl_class','tbl_class.classId = studentreg.studentClass');
	$CI->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
    $res = $CI->db->get('log_payment_data')->result_array();
    if(!empty($res)){
        return $res;
    }else {
        return $res;
    }
}


function payment_his_data($studId)
{
    $CI =& get_instance();

    $CI->db->trans_start();
    $CI->db->where('fk_studId',$studId);
    $CI->db->where('paymentSatusByadmin',1);
    $CI->db->where('paystatusId',1);
    $CI->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId');
    $res = $CI->db->get('log_payment_data')->result_array();
    $CI->db->trans_complete();
    if ($CI->db->trans_status() === FALSE)
    {
        return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    } else {

        if(!empty($res)){
            return $res;
        }else {
            return $res;
        }
    }
    
}


function getChatData()
{
    
    $CI =& get_instance();
    
    
    $usersession    = $CI->session->userdata('usersession');
    $CI->db->where('fk_studId',$usersession[0]['studId']);
    $results = $CI->db->get('tbl_allocate_teacher_to_student')->result_array();
    if($results){
    $currentDate    =  date('Y-m-d H:i:s');
    $usersession    = $CI->session->userdata('usersession');
    $CI->db->or_where('fk_studId',$usersession[0]['studId']);
    $CI->db->or_where('fk_studId',$results[0]['fk_teachId']);
    $CI->db->or_where('fk_studId',$results[0]['fk_teachId']);
	$CI->db->or_where('fk_teachId',$usersession[0]['studId']);
	$CI->db->where('currentDate',$currentDate);
	
     
    $results = $CI->db->get('teacher_chat_window')->result_array();
    return $results;
    
    }else{
        
        return $results =  array();
    }
}

function getChatData_today_count()
{
   
    $start_date = date('Y-m-d 00:00:00');
    $end_date = date('Y-m-d 23:59:59');
    $CI =& get_instance();
    $usersession    = $CI->session->userdata('usersession');
    $CI->db->where('fk_teachId',$usersession[0]['studId']);
    $CI->db->where('readMsg',0);
    $CI->db->where('currentDate BETWEEN "'. $start_date. '" and "'. $end_date.'"');
    $results = $CI->db->get('teacher_chat_window')->result_array();
   
    return $results;

}

function check_authrization()
{
    
    $CI =& get_instance();

    $usersession    = $CI->session->userdata('usersession');
    $CI->db->where('fk_studId',$usersession[0]['studId']);
    $results = $CI->db->get('tbl_allocate_teacher_to_student')->result_array();
    return $results;
}


 function tbl_teacher_data($studentClass)
{
       $CI =& get_instance();
     $usersession    = $CI->session->userdata('usersession');
    
    $CI->db->where('fk_studId',$usersession[0]['studId']);
     $CI->db->join('studentreg','studentreg.studId = tbl_allocate_teacher_to_student.fk_studId');
     $CI->db->join('tbl_teacher','tbl_teacher.teacherId = tbl_allocate_teacher_to_student.fk_teachId');
     $res = $CI->db->get('tbl_allocate_teacher_to_student')->result_array();
        if(!empty($res)){
            return $res;
        }else {
            return $res;
        }
}


function getcountuploadvideo($classId,$mId)
{

    $CI =& get_instance();
    $CI->db->where('fk_monthId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_upload_key',2);
    $live = $CI->db->get('tbl_videouploadingdata')->result_array();
    

    $CI->db->where('fk_monthId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_upload_key',1);
    $demo = $CI->db->get('tbl_videouploadingdata')->result_array();
    
    $CI->db->where('fk_monthId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_upload_key',2);
    $CI->db->where('coursePeriod',3);
    $three = $CI->db->get('tbl_videouploadingdata')->result_array();
    
    $CI->db->where('fk_monthId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_upload_key',2);
    $CI->db->where('coursePeriod',7);
    $seven = $CI->db->get('tbl_videouploadingdata')->result_array();
    
    return  $res = array('seven'=>count($seven),'three'=>count($three),'demo'=>count($demo),'live'=>count($live));

}

 function getfollowupenquiry($fk_studId)
{
    
    
    $CI =& get_instance();
    
    $usersession    = $CI->session->userdata('usersession');
     
    $CI->db->trans_start();
    $CI->db->where('fk_studId',$fk_studId);
    $CI->db->where('fk_loginId',$usersession[0]['studId']);
    $CI->db->join('tbl_admin_ved','tbl_admin_ved.studId = tbl_followupenquiry.fk_loginId');
	$result = $CI->db->get('tbl_followupenquiry')->result_array();
	$CI->db->trans_complete();
	if ($CI->db->trans_status() === FALSE)
	{
	   $CI->db->trans_rollback(); 
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
	    
    	if(!empty($result)){
    		return $result;
    	}else{
    		return $result;
    	}
	}
}


function getcountuploadvideo1($classId,$mId,$monthId)
{

    $CI =& get_instance();
    $CI->db->where('fk_dayId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_upload_key',2);
    $CI->db->where('coursePeriod',0);
    $CI->db->group_by('fk_sessionId');
    $live = $CI->db->get('tbl_videouploadingdata')->result_array();
    

    $CI->db->where('fk_dayId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_upload_key',1);
    $CI->db->where('coursePeriod',0);
    $CI->db->group_by('fk_sessionId');
    $demo = $CI->db->get('tbl_videouploadingdata')->result_array();
    
    $CI->db->where('fk_dayId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_upload_key',2);
    $CI->db->where('coursePeriod',3);
    $CI->db->where('coursePeriod',0);
    $CI->db->group_by('fk_sessionId');
    $three = $CI->db->get('tbl_videouploadingdata')->result_array();
    
    $CI->db->where('fk_dayId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_upload_key',2);
    $CI->db->where('coursePeriod',7);
    $CI->db->group_by('fk_sessionId');
    $seven = $CI->db->get('tbl_videouploadingdata')->result_array();
    
    $CI->db->select('*,count(fk_upload_key) as sessioncount',$mId);
    $CI->db->where('fk_dayId',$mId);
    $CI->db->where('fk_classId',$classId);
    $CI->db->where('fk_monthId',$monthId);
    $CI->db->where('fk_upload_key',2);
    $CI->db->where('coursePeriod',0);
    $CI->db->group_by('fk_sessionId');
    $CI->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
    $allcourse = $CI->db->get('tbl_videouploadingdata')->result_array();
    
    
    return  $res = array('seven'=>count($seven),'three'=>count($three),'demo'=>count($demo),'live'=>count($live),'allcourse'=>$allcourse);

}




?>