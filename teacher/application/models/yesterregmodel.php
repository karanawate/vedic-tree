<?php

class regModel extends CI_Model
{

public function getClass()
{
	$this->db->where('status',1);
	$this->db->order_by('classId','ASC');
	$res = $this->db->get('tbl_class')->result_array();
	return $res;

}

public function add_reg($data)
{

	$result = $this->db->insert('studentreg',$data);
	$insert_id = $this->db->insert_id();
	$the_session = array("studentMobile" => $data['studentMobile']);
	$this->session->set_userdata($the_session);

	$data_otp_array = array(
    'fk_user_id'  			=> $insert_id,
    'studentMobile'  		=> $data['studentMobile'],
    'user_OTP_Status'  		=> 1,
	);
	$message = trim("Your OTP for VEDIC TREE KIDS LEARNING APP login is {".$data['OTP']."}\nFor further details please visit our website www.vedictreeschool.online");

	$res = sendsms($data['studentMobile'], $message);
	if($res=="fail" || $res=="InsufficientBalance")
	{
		$data_otp_array = array(
        'fk_stud_id'  			=> $insert_id,
        'studentMobile'  		=> $data['studentMobile'],
        'user_OTP_Status'  		=> 2         //failed sending sms
		);
	}else{
		$data_otp_array = array(
        'fk_stud_id'  			=> $insert_id,
        'studentMobile'  		=> $data['studentMobile'],
        'user_OTP_Status'  		=> 1          //success sending sms
		);

	}
	$user_otp_data = $this->db->insert('student_otp_data',$data_otp_array);

	if($result==1){
		return "1";
	}else{
		return "0";
	}

}


public function checkmobile($studentMobile)
{

	$this->db->where('studentMobile',$studentMobile);
	$res = $this->db->get('studentreg')->result();
	if(!empty($res)){
		$usersession  = array('studentMobile' => $studentMobile );
		$this->session->set_userdata($usersession);
		$Otpno = "VEDIC-".rand(111111,999999);
		$data = array('OTP'=>$Otpno);
		$this->db->where('studentMobile',$studentMobile);
		$this->db->update('studentreg',$data);
		$message = "Your Verification Otp is".$Otpno;
		$res = sendsms($studentMobile, $message);
		if($res=="fail" || $res=="InsufficientBalance")
		{
			$data_otp_array = array(
	        'studentMobile'  		=> $studentMobile,
	        'user_OTP'  			=> $Otpno,
	        'user_OTP_Status'  		=> 2         //failed sending sms
			);
		}else{
			$data_otp_array = array(
	        'studentMobile'  		=> $studentMobile,
	        'user_OTP'  			=> $Otpno,
	        'user_OTP_Status'  		=> 1          //success sending sms
			);

		}

		$user_otp_data = $this->db->insert('student_otp_data',$data_otp_array);
		return "1";
	}else{
		return "0";
	}
	
}


public function verifyOTP($studentMobile,$otpno)
{
	$this->db->where('studentMobile',$studentMobile);
	$this->db->where('OTP',$otpno);
	$res = $this->db->get('studentreg')->result();
	if(!empty($res)){
		$data = array('studentStatus'=>1);
		$this->db->where('studentMobile',$studentMobile);
		$this->db->update('studentreg',$data);
		return "1";
	}else{
		return "0";
	}
}

public function webverifyOTP($studentMobile,$otpno)
{
	$this->db->where('studentMobile',$studentMobile);
	$this->db->where('OTP',$otpno);
	$res = $this->db->get('studentreg')->result();
	if(!empty($res)){
		$data = array('studentStatus'=>1);
		$this->db->where('studentMobile',$studentMobile);
		$this->db->update('studentreg',$data);
		return "1";
	}else{
		return "0";
	}
}


public function check_exist_number($studentMobile)
{
	$this->db->where('studentMobile',$studentMobile);
	$res = $this->db->get('studentreg')->result();
	if(!empty($res)){
		return "1";
	}else{
		return "0";
	}
}


public function check_reg_data($studentEmail,$studentMobile)
{
	$this->db->where('studentMobile', $studentMobile );
	$this->db->where('studentEmail', $studentEmail );
	$res = $this->db->get('studentreg')->result();
	if(!empty($res)){
		return "1";
	}else{
		return "0";
	}
}

public function checkrefferalCode($refferalCode)
{
	$this->db->where('NewrefferalCode', $refferalCode );
	$res = $this->db->get('studentreg')->result();
	if(!empty($res)){
		return "1";
	}else{
		return "0";
	}
}



public function resentotp($studentMobile,$otp)
{
		
	$data = array('OTP'=>$otp);
	$this->db->where('studentMobile',$studentMobile);
	$this->db->update('studentreg',$data);
	$message = "Your register OTP is".$otp;
	$res = sendsms($studentMobile, $message);
	if($res=="fail" || $res=="InsufficientBalance")
	{
		$data_otp_array = array(
        'user_OTP'  			=> $otp,
        'studentMobile'  		=> $studentMobile,
        'user_OTP_Status'  		=> 2         //failed sending sms
		);
	}else{
		$data_otp_array = array(
        'user_OTP'  			=> $otp,
        'studentMobile'  		=> $studentMobile,
        'user_OTP_Status'  		=> 1          //success sending sms
		);

	}
	$user_otp_data = $this->db->insert('student_otp_data',$data_otp_array);

	if($user_otp_data==1){
		return "1";
	}else{
		return "0";
	}

}


public function check_login_data($data)
{

	$this->db->where('studentMobile', $data['studentMobile'] );
	$this->db->where('studentPass', $data['studentPass'] );
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
        $dataarray = array('logstatus'=>1);
        $this->db->where('studentMobile',$data['studentMobile']);
        $this->db->update('studentreg',$dataarray);
		$this->session->set_userdata('usersession',$res);
		return "1";
	}else{
		return "0";
	}

}

public function updatepass($otp,$newpass,$studentMobile)
{
		
	$dataarray = array('studentPass'=>sha1($newpass));
    $this->db->where('studentMobile',$studentMobile);
    $this->db->where('OTP',$otp);
    $res = $this->db->update('studentreg',$dataarray);
    return $res;

}

public function getstudlist()
{
	$this->db->where('studentStatus',1);
	$res = $this->db->get('studentreg')->result_array();
    return $res;

}
	
public function deletestudid($studId)
{
	$this->db->where('studId',$studId);
	$res = $this->db->delete('studentreg');
    return $res;
}

public function deletefeesId($feesId){

	$this->db->where('feesId',$feesId);
	$res = $this->db->delete('tab_add_fees_data');
    return $res;

}

public function deletenotid($notId)
{
	$this->db->where('notId',$notId);
	$res = $this->db->delete('notice');
    return $res;
}


public function edit($studId)
{
	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
    return $res;		
}
public function edit_note_id($notId)
{
	$this->db->where('notId',$notId);
	$res = $this->db->get('notice')->result_array();
    return $res;		
}

public function getnoticelist()
{
	// $this->db->where('status',1);
	$res = $this->db->get('notice')->result_array();
    return $res;		
}	

public function edit_reg($data)
{

	$this->db->where('studId',$data['studId']);
	$result = $this->db->update('studentreg',$data);
	if($result==1){
		return "1";
	}else{
		return "0";
	}
		
}

public function edit_note($data)
{
	$this->db->where('notId',$data['notId']);
	$result = $this->db->update('notice',$data);
	if($result==1){
		return "1";
	}else{
		return "0";
	}
}

public function notice($data)
{
	$result = $this->db->insert('notice',$data);
	if($result==1){
		return "1";
	}else{
		return "0";
	}
}


public function change_status($status,$notId)
{	
	$data = array('status'=>$status);
	$this->db->where('notId',$notId);
	$result = $this->db->update('notice',$data);
	if($result==1){
		return "1";
	}else{
		return "0";
	}

}


public function filter_studlist($data)
{
		

	if($data['fromDT']!="" &&  $data['toDT']!="" ){
		$this->db->where('createDT BETWEEN "'. date('Y-m-d h:i:s', strtotime($data['fromDT'])). '" and "'. date('Y-m-d h:i:s', strtotime($data['toDT'])).'"');
	}

	if($data['studentMobile']!="" && $data['studentEmail']!="" && $data['fromDT']!="" &&  $data['toDT']!="" ){
		
		$this->db->where('createDT BETWEEN "'. date('Y-m-d h:i:s', strtotime($data['fromDT'])). '" and "'. date('Y-m-d h:i:s', strtotime($data['toDT'])).'"');
		$this->db->where('studentEmail ',$data['studentEmail']);
		$this->db->where('studentMobile',$data['studentMobile']);
	}

	if($data['studentMobile']!="" ||  $data['studentEmail']!="")
	{
		$this->db->or_where('studentEmail ',$data['studentEmail']);
		$this->db->or_where('studentMobile',$data['studentMobile']);
	}

	$res = $this->db->get('studentreg')->result_array();

	// echo "<pre>";
	// echo $this->db->last_query();
	// print_r($res);
	// die;
    return $res;	


}

function qrcode_data($qrcode_data){

	return $res = $this->db->insert('qrcodelist',$qrcode_data);
}

function qrcodelist(){

	return $res = $this->db->get('qrcodelist')->result_array();
}

public function deleteqrId($qrId)
{
	$this->db->where('qrId',$qrId);
	$res = $this->db->delete('qrcodelist');
	return $res;
}

public function qrcodeNumberExist($qrcodeNumber)
{
	$this->db->where('qrcodeNumber',$qrcodeNumber);
	$res = $this->db->get('qrcodelist')->result_array();
	if(!empty($res)){
		return "1";
	}else
	{
		return "0";
	}
}


public function videouploading($videouploadingdata)
{
	$res = $this->db->insert('tbl_videouploadingdata',$videouploadingdata);
	if($res==1){
		return 1;
	}else {
		return 0;
	}
}

public function fk_monthId_exist($fk_monthId,$fk_dayId,$fk_sessionId,$fk_classId,$param)
{
	$this->db->where('fk_monthId',$fk_monthId);
	$this->db->where('fk_dayId',$fk_dayId);
	$this->db->where('fk_sessionId',$fk_sessionId);
	$this->db->where('fk_classId',$fk_classId);
	$this->db->where('param',$param);
	$res = $this->db->get('tbl_videouploadingdata')->result_array();
	if(!empty($res)){
		return 1;
	}else {
		return 0;
	}


}

public function deletevideoId($vidId)
{
	
	$this->db->where('vidId',$vidId);
	$res = $this->db->delete('tbl_videouploadingdata');
	if($res==1){
		return 1;
	}else {
		return 0;
	}

}

public function listvideouploading($fk_classId)
{

	$this->db->select('*,count(tbl_videouploadingdata.fk_dayId) as fk_count_dayId');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->group_by('fk_monthId');
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$res = $this->db->get()->result_array();

	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}

}
	

public function get_month_data($monthId)
{
	$this->db->select('*');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_days.dayName','ASC');
	$this->db->group_by('fk_dayId');
	$res = $this->db->get()->result_array();
// echo $this->db->last_query();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}
}

public function get_day_sessions($dayId,$monthId,$fk_classId)
{
	$this->db->select('*');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->where('tbl_videouploadingdata.fk_dayId',$dayId);
	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_videouploadingdata.fk_dayId','asc');
	$res = $this->db->get()->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}
}

public function filteredvideouploading($data)
{
		

		$this->db->select('*');
		$this->db->from('tbl_videouploadingdata');
		$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
		$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
		$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
		$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
		$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
		$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
		if($data['fk_classId']!=""){
			$this->db->where('fk_classId',$data['fk_classId']);
		}
		if($data['fk_sessionId']!=""){
			$this->db->where('fk_sessionId',$data['fk_sessionId']);
		}
		if($data['fk_dayId']!=""){
			$this->db->where('fk_dayId',$data['fk_dayId']);
		}
		if($data['fk_monthId']!=""){
			$this->db->where('fk_monthId',$data['fk_monthId']);
		}
		if($data['vimeoId']!=""){
			$this->db->where('vimeoId',$data['vimeoId']);
		}
		if($data['fromDT']!="" && $data['toDT']!=""){
			$this->db->where('vidcreateDT>=',$data['fromDT']);
			$this->db->where('vidcreateDT<=',$data['toDT']);
		}

		$this->db->where('tbl_videouploadingdata.status',1);
		return $res = $this->db->get()->result_array();
		// echo $this->db->last_query();

}




public function update_videouploading($vidId)
{
	$this->db->select('*');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->where('vidId',$vidId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$res = $this->db->get()->result_array();

	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}
}


public function update_filteredvideouploading($data)
{

	$this->db->where('vidId',$data['vidId']);
	$res = $this->db->update('tbl_videouploadingdata',$data);
	return $res;
}


public function check_login_exist($data)
{

	$this->db->where('studentEmail',$data['studentEmail']);
	$result = $this->db->get('studentreg')->result_array();
	if(empty($result)){

	   $res = $this->db->insert('studentreg',$data);
	   if($res==1){
	   	$this->db->where('studentEmail',$data['studentEmail']);
		return $result = $this->db->get('studentreg')->result_array();
	   }
	
	}else{
		$this->db->where('studentEmail',$data['studentEmail']);
	    return $result = $this->db->get('studentreg')->result_array();
	}
	

	
}



public function count_student()
{
	return $this->db->from("studentreg")->count_all_results();

}

public function count_active_student()
{
	$this->db->where('studentStatus',1);
	return $this->db->from("studentreg")->count_all_results();

}

public function count_inactive_student()
{
	$this->db->where('studentStatus',0);
	return $this->db->from("studentreg")->count_all_results();

}

public function count_session()
{
	return $this->db->from("tbl_session_type")->count_all_results();

}

public function count_revenue()
{
	return $this->db->from("studentreg")->count_all_results();

}

public function count_category()
{
	return $this->db->from("tbl_category")->count_all_results();

}

public function count_session_content()
{
	return $this->db->from("tbl_contnet_type")->count_all_results();

}



public function listaddsession()
{
	return $sessionType = $this->db->get('tbl_session_type')->result_array();
}

public function list_category()
{
	return $tbl_category = $this->db->get('tbl_category')->result_array();
}


public function addsession($addsession)
{
	$sessionType = $this->db->insert('tbl_session_type',$addsession);
	if($sessionType==1){
	 	return 1;
	 }else{
	 	return 0;
	 }

}

public function addcategory($data)
{
	 $tbl_category = $this->db->insert('tbl_category',$data);
	 if($tbl_category==1){
	 	return 1;
	 }else{
	 	return 0;
	 }
}

public function deletecatId($catId)
{
	$this->db->where('catId',$catId);
	$res = $this->db->delete('tbl_category');
	if($res==1){
		return 1;
	}else{
		return 0;
	}

}

public function delesessionId($sessionId)
{
	$this->db->where('sessionId',$sessionId);
	$res = $this->db->delete('tbl_session_type');
	if($res==1){
		return 1;
	}else{
		return 0;
	}
}


public function tbl_temp_enquiry($studentEmail,$studentMobile)
{

	$this->db->where('studentEmail',$studentEmail);
	$this->db->where('studentMobile',$studentMobile);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
		return 1;
	}else{
		return 0;
	}
	
}



public function add_tbl_temp_enquiry($arraydata)
{
	
	$result = $this->db->insert('studentreg',$arraydata);
	$insert_id = $this->db->insert_id();
	$the_session = array("studentMobile" => $arraydata['studentMobile']);
	$this->session->set_userdata($the_session);

	$data_otp_array = array(
    'fk_user_id'  			=> $insert_id,
    'studentMobile'  		=> $arraydata['studentMobile'],
    'user_OTP_Status'  		=> 1,
	);
	$message = trim("Your OTP for VEDIC TREE KIDS LEARNING APP login is {".$arraydata['OTP']."}\nFor further details please visit our website www.vedictreeschool.online");
	$res = sendsms($arraydata['studentMobile'], $message);
	if($res=="fail" || $res=="InsufficientBalance")
	{
		$data_otp_array = array(
        'fk_stud_id'  			=> $insert_id,
        'studentMobile'  		=> $arraydata['studentMobile'],
        'user_OTP_Status'  		=> 2         //failed sending sms
		);
	}else{
		$data_otp_array = array(
        'fk_stud_id'  			=> $insert_id,
        'studentMobile'  		=> $arraydata['studentMobile'],
        'user_OTP_Status'  		=> 1          //success sending sms
		);

	}
	$user_otp_data = $this->db->insert('student_otp_data',$data_otp_array);

	if($result==1){
		return "1";
	}else{
		return "0";
	}

}


public function get_temp_enquiry_data($studentMobile,$studentPass)
{
	
	$this->db->where('studentMobile',$studentMobile);
	$this->db->where('studentPass',sha1($studentPass));
	$this->db->where('studentStatus','1');
	// $this->db->where('fk_fees_remark','1');
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){

		$this->db->where('fk_user_id',$res[0]['studId']);
		$this->db->order_by('studAId','desc');
		$this->db->limit(1);
		$lastrecord = $this->db->get('stdentAttendance')->result_array();
		if(empty($lastrecord)){
			$stdentAttendance = array('fk_user_id'=>$res[0]['studId'],'remarkAttendace'=>1,'createDT'=>date('Y-m-d'));
			$this->db->insert('stdentAttendance',$stdentAttendance);
		} else {

			if($lastrecord[0]['createDT']==date('Y-m-d')){
					$stdentAttendance = array('remarkAttendace'=>1,'createDT'=>date('Y-m-d'));
					$this->db->where('studAId',$res[0]['studAId']);
					$this->db->update('stdentAttendance',$stdentAttendance);
			}else{
						$stdentAttendance = array('fk_user_id'=>$res[0]['studId'],'remarkAttendace'=>1,'createDT'=>date('Y-m-d'));
					$this->db->insert('stdentAttendance',$stdentAttendance);
			}

		}

		$this->session->set_userdata('usersession',$res);
		return $res;
	}else{
		return $res;
	}

}


public function check_reg_email_data($studentEmail)
{
	$this->db->where('studentEmail',$studentEmail);
	$result = $this->db->get('studentreg')->result_array();
	if(!empty($result)){
		$this->session->set_userdata('usersession',$result);
		return 1;
	}else{
		return 0;
	}
}

public function checkpass($studentEmail)
{
	$this->db->where('studentEmail',$studentEmail);
	$result = $this->db->get('studentreg')->result_array();
	if(!empty($result)){
		return $result;
	}else{
		return $result;
	}
}



public function add_reg_social($data)
{

	$result = $this->db->insert('studentreg',$data);
	$insert_id = $this->db->insert_id();
	$the_session = $this->db->where('studId',$insert_id)->get('studentreg')->result_array();
	$this->session->set_userdata($the_session);
	if($result==1){
		return "1";
	}else{
		return "0";
	}

}

public function updatesudeInfo($data){

	$this->db->where('studId',$data['studId']);	
	$result = $this->db->update('studentreg',$data);

	if($result==1){
		return "1";
	}else{
		return "0";
	}

}

public function check_mobile_exist($studentMobile)
{
	
	$this->db->where('studentMobile',$studentMobile);	
	$result = $this->db->get('studentreg')->result_array();
	if(!empty($result)){
		return "1";
	}else{
		return "0";
	}

}


public function get_studentid($studentEmail){

	$this->db->where('studentEmail',$studentEmail);	
	$this->db->where('studentStatus',1);	
	return $result = $this->db->get('studentreg')->result_array();
}


public function add_fees_data($add_fees_data)
{
	
	$result = $this->db->insert('tab_add_fees_data',$add_fees_data);
	if($result==1){
		return "1";
	}else{
		return "0";
	}


}


public function list_Fees()
{	
	$result = $this->db->get('tab_add_fees_data')->result_array();
	if($result){
		return $result;
	}else{
		return $result;
	}
}

public function tbl_tracking_watch_video($dataarray){

	$result = $this->db->insert('tbl_tracking_watch_video',$dataarray);
	if($result==1){
		return 1;
	}else{
		return 0;
	}

}

public function add_class($data) {
        $this->db->insert('conferences', $data);
        $insert_id = $this->db->insert_id();
 }



 public function getStudentByClassID($class_id)
 {
 	$this->db->where('studentClass',$class_id);
 	$result = $this->db->get('studentreg')->result_array();
	if($result){
		return $result;
	}else{
		return $result;
	}

 }


 public function add_time_line($studId,$timlelinedesc)
 {

 	$data =  array('fk_user_id'=>$studId,'timlelinedesc'=>$timlelinedesc);
 	$this->db->insert('studenttimeline', $data);

 }

 public function studenttimeline($studId)
 {

 	$this->db->where('fk_user_id',$studId);
 	$result = $this->db->get('studenttimeline')->result_array();
	if($result){
		return $result;
	}else{
		return $result;
	}

 }


public function list_of_education($fk_classId,$param)
{
	
	$this->db->select('*');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->where('tbl_videouploadingdata.param',$param);
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_videouploadingdata.fk_dayId','asc');
	$res = $this->db->get()->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}



}


public function get_month_data_of_value_based_eductaion($vidcreateDT,$param,$endvidcreateDT,$fk_classId)
{
	
	$this->db->select('*');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->where('tbl_videouploadingdata.param',$param);
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$this->db->where('tbl_videouploadingdata.vidcreateDT>=',$vidcreateDT);
	$this->db->where('tbl_videouploadingdata.vidcreateDT<=',$endvidcreateDT);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_videouploadingdata.fk_dayId','asc');
	$res = $this->db->get()->result_array();
	// echo $this->db->last_query();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}


}

public function value_based_eductaion_related($param)
{
	
	$this->db->select('*');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->where('tbl_videouploadingdata.param',$param);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_videouploadingdata.fk_dayId','asc');
	$res = $this->db->get()->result_array();

	// echo $this->db->last_query();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}


}

public function alreadpackageName($packageName)
{
	$this->db->where('packageName',$packageName);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	if(!empty($res)){
		return 1;
	}else {
		return 0;
	}

}


public function updateinfo($data,$role)
{

	
	if($role=="student"){

	   		$this->db->where('studId',$data['studId']);
			$res = $this->db->update('studentreg',$data);
			if($res==1){
				return 1;
			}else {
				return 0;
			}
	  }elseif ($role=="father") {


		    $this->db->where('studId',$data['studId']);
	  		$empty_fatherinfo =  $this->db->get('studentreg_fatherinfo')->result_array();
	  		if(empty($empty_fatherinfo))
	  		{

				$res = $this->db->insert('studentreg_fatherinfo',$data);
				if($res==1){
					return 1;
				}else {
					return 0;
				}

	  		}else{

			    $this->db->where('studId',$data['studId']);
				$res = $this->db->update('studentreg_fatherinfo',$data);
				if($res==1){
					return 1;
				}else {
					return 0;
				}
	  		}	


	  }elseif($role=="mother"){

	  		$this->db->where('studId',$data['studId']);
	  		$empty_motherinfo =  $this->db->get('studentreg_motherinfo')->result_array();
	  		if(empty($empty_motherinfo))
	  		{

				$res = $this->db->insert('studentreg_motherinfo',$data);
				if($res==1){
					return 1;
				}else {
					return 0;
				}

	  		}else{

			    $this->db->where('studId',$data['studId']);
				$res = $this->db->update('studentreg_motherinfo',$data);
				if($res==1){
					return 1;
				}else {
					return 0;
				}
	  		}		
	  
	  }

	$this->db->where('studId',$data['studId']);
	$res = $this->db->update('studentreg',$data);
	if($res==1){
		return 1;
	}else {
		return 0;
	}


}

public function userinfo($studId)
{

	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}
	
}

public function userinfo_father($studId)
{

	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg_fatherinfo')->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}
	
}
public function userinfo_mother($studId)
{

	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg_motherinfo')->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}
	
}

public function fess_structure($fk_classId)
{
	
	$this->db->where('fk_classId',$fk_classId);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}

}


public function bank_info($studId)
{
	$this->db->where('studId',$studId);
	$res = $this->db->get('bank_info')->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}

	
}

public function bank_info_update($data)
{
	
	$this->db->where('studId',$data['studId']);
	$res = $this->db->update('bank_info',$data);
	if($res==1){
		return 1;
	}else {
		return 0;
	}


}

public function bank_info_insert($data)
{
	
	$this->db->where('studId',$data['studId']);
	 $bank_info =  $this->db->get('bank_info')->result_array();
	 if(empty($bank_info))
	{

		$res = $this->db->insert('bank_info',$data);
		if($res==1){
			return 1;
		}else {
			return 0;
		}

	}else{

		$this->db->where('studId',$data['studId']);
		$res = $this->db->update('bank_info',$data);
		if($res==1){
			return 1;
		}else {
			return 0;
		}


	}


}


public function getplanvalue($planvalue)
{
	
	$this->db->where('feesId',$planvalue);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}

}


public function log_payment_data($data)
{
	
	$res = $this->db->insert('log_payment_data',$data);
	if($res==1){
		return $res;
	}else {
		return $res;
	}

}


public function update_log_payment($studId,$paystatus,$razorpay_order_id,$razorpay_payment_id,$razorpay_signature)
{	
		$this->db->where('fk_studId',$studId);	
		$this->db->or_where('razorpay_order_id',$razorpay_order_id);	
		$log_payment_data = $this->db->get('log_payment_data')->result_array();
		if($log_payment_data){

			$data = array('paystatus'=>$paystatus,'razorpay_order_id'=>$razorpay_order_id,'razorpay_payment_id'=>$razorpay_payment_id,'razorpay_signature'=>$razorpay_signature,'paystatusId'=>1);
			$this->db->where('fk_studId',$studId);	
			$this->db->where('paystatusId',2);	
			$res = $this->db->update('log_payment_data',$data);
			if($res==1){
				return 1;
			}else {
				return 0;
			}
		}
	
}



public function last_session_running($studId)
{

	$this->db->where('fk_user_id',$studId);
	$this->db->order_by('trackId','desc');
	$this->db->limit(1);
	$res = $this->db->get('tbl_tracking_watch_video')->result_array();
	if(!empty($res)){
		return $res;
	} else {
		return $res;
	}

}


public function check_social_login_exist($studentEmail){
    
    $this->db->where('studentEmail',$studentEmail);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
		return $res;
	} else {
		return $res;
	}
	
}

public function getfees($classId){
    $this->db->where('fk_classId',$classId);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	if(!empty($res)){
		return $res;
	} else {
		return $res;
	}
    
}


public function get_stud_data($studId)
{
	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
		return $res;
	} else {
		return $res;
	}

}


}
?>