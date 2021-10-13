<?php

class regModel extends CI_Model
{

public function getClass()
{

	$this->db->trans_start();

	$this->db->where('status',1);
	$this->db->order_by('classId','ASC');
	$res = $this->db->get('tbl_class')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{

	return $res;
	}

}

public function add_reg($data)
{

	$this->db->trans_start();

	$result = $this->db->insert('studentreg',$data);
	$insert_id = $this->db->insert_id();
	$the_session = array("studentMobile" => $data['studentMobile']);
	$this->session->set_userdata($the_session);

	$data_otp_array = array(
    'fk_user_id'  			=> $insert_id,
    'studentMobile'  		=> $data['studentMobile'],
    'user_OTP_Status'  		=> 1,
	);
	$message = trim("Your OTP for VEDIC TREE KIDS LEARNING APP login is ".$data['OTP']." For further details please visit our website www.vedictreeschool.com");

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

	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{	

		if($result==1){
			return "1";
		}else{
			return "0";
		}

	}

}


public function checkmobile($studentMobile)
{
	$this->db->trans_start();

	$this->db->where('studentMobile',$studentMobile);
	$res = $this->db->get('studentreg')->result();

	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{	

			if(!empty($res)){
				$usersession  = array('studentMobile' => $studentMobile );
				$this->session->set_userdata($usersession);
				$Otpno = "VEDIC-".rand(111111,999999);
				$data = array('OTP'=>$Otpno);
				$this->db->where('studentMobile',$studentMobile);
				$this->db->update('studentreg',$data);
				$message = "Your OTP for VEDIC TREE KIDS LEARNING APP login is ".$Otpno;
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
	
}


public function verifyOTP($studentMobile,$otpno)
{

	$this->db->trans_start();

	$this->db->where('studentMobile',$studentMobile);
	$this->db->where('OTP',$otpno);
	$res = $this->db->get('studentreg')->result();

	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{	

		if(!empty($res)){
			$data = array('studentStatus'=>1);
			$this->db->where('studentMobile',$studentMobile);
			$this->db->update('studentreg',$data);
			return "1";
		}else{
			return "0";
		}
	}
}

public function webverifyOTP($studentMobile,$otpno)
{
	$this->db->trans_start();
	$this->db->where('studentMobile',$studentMobile);
	$this->db->where('OTP',$otpno);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{	

		if(!empty($res)){
			$this->session->set_userdata('usersession',$res);
			$data = array('studentStatus'=>1);
			$this->db->where('studentMobile',$studentMobile);
			$this->db->update('studentreg',$data);
			return "1";
		}else{
			return "0";
		}
	}
}


public function check_exist_number($studentMobile)
{
	$this->db->trans_start();
	$this->db->where('studentMobile',$studentMobile);
	$res = $this->db->get('studentreg')->result();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		if(!empty($res)){
			return "1";
		}else{
			return "0";
		}
	}
}


public function check_reg_data($studentEmail,$studentMobile)
{
	$this->db->trans_start();
	$this->db->where('studentMobile', $studentMobile );
	$this->db->where('studentEmail', $studentEmail );
	$res = $this->db->get('studentreg')->result();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		if(!empty($res)){
			return "1";
		}else{
			return "0";
		}
	}
}

public function checkrefferalCode($refferalCode)
{
	$this->db->trans_start();
	$this->db->where('NewrefferalCode', $refferalCode );
	$res = $this->db->get('studentreg')->result();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

	if(!empty($res)){
		return "1";
	}else{
		return "0";
	}
  }
}



public function resentotp($studentMobile,$otp)
{
		
	$data = array('OTP'=>$otp);
	$this->db->where('studentMobile',$studentMobile);
	$this->db->update('studentreg',$data);
		$message = "Your OTP for VEDIC TREE KIDS LEARNING APP login is ".$otp."\nFor further details please visit our website www.vedictreeschool.com";
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

	$this->db->trans_start();
	$this->db->where('studentMobile', $data['studentMobile'] );
	$this->db->where('studentPass', $data['studentPass'] );
	$this->db->where('studentStatus', 1 );
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

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

}

public function updatepass($otp,$newpass,$studentMobile)
{
	$this->db->trans_start();

	$dataarray = array('studentPass'=>sha1($newpass));
    $this->db->where('studentMobile',$studentMobile);
    $this->db->where('OTP',$otp);
    $res = $this->db->update('studentreg',$dataarray);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

    	return $res;
    }

}

public function getstudlist()
{
	$this->db->trans_start();

	$this->db->select("*,studentreg.createDT as date");
	$this->db->where('studentStatus',1);
	$this->db->or_where('log_payment_data.paystatusId',1);
	$this->db->or_where('log_payment_data.paystatusId',2);
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
	$res = $this->db->get('studentreg')->result_array();

	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
      return $res;
   }

}


public function getstudlistina()
{

	$this->db->trans_start();

	$this->db->select("*,studentreg.createDT as date");
	$this->db->where('studentStatus',0);
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
	$res = $this->db->get('studentreg')->result_array();

	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
      return $res;
   }

	
}
	
public function deletestudid($studId)
{
	$this->db->trans_start();

	$this->db->where('studId',$studId);
	$res = $this->db->delete('studentreg');
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      return $res;
   }
}

public function deletefeesId($feesId){
	$this->db->trans_start();

	$this->db->where('feesId',$feesId);
	$res = $this->db->delete('tab_add_fees_data');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      return $res;

     }
}

public function deletenotid($notId)
{
	$this->db->trans_start();

	$this->db->where('notId',$notId);
	$res = $this->db->delete('notice');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
       return $res;
	}
}



public function edit($studId)
{
	$this->db->trans_start();

	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

       return $res;		
    }
}
public function edit_note_id($notId)
{
	$this->db->trans_start();

	$this->db->where('notId',$notId);
	$res = $this->db->get('notice')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
       return $res;		
    }
}

public function getnoticelist()
{
	$res = $this->db->get('notice')->result_array();
    return $res;		
}	

public function edit_reg($data)
{
	$this->db->trans_start();

	$this->db->where('studId',$data['studId']);
	$result = $this->db->update('studentreg',$data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		if($result==1){
			return "1";
		}else{
			return "0";
		}
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
	$this->db->trans_start();

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
		$this->db->where('studentEmail ',$data['studentEmail']);
		$this->db->where('studentMobile',$data['studentMobile']);
	}



	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
		
	$this->db->where('studentStatus',1);
	$this->db->or_where('log_payment_data.paystatusId',1);
	$this->db->or_where('log_payment_data.paystatusId',2);
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');

	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
    return $res;	
	}else{	
    return $res;	
	}

    }


}

function qrcode_data($qrcode_data){

	$this->db->trans_start();

	 $res = $this->db->insert('qrcodelist',$qrcode_data);
	 $this->db->trans_complete();
	 if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		return $res;
	}
}

function qrcodelist(){

	 $this->db->trans_start();
	 $res = $this->db->get('qrcodelist')->result_array();
	 $this->db->trans_complete();

	 if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		return $res;
	}

}

public function deleteqrId($qrId)
{
	$this->db->trans_start();

	$this->db->where('qrId',$qrId);
	$res = $this->db->delete('qrcodelist');
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	  return $res;
    }
}

public function qrcodeNumberExist($qrcodeNumber)
{

	$this->db->trans_start();

	$this->db->where('qrcodeNumber',$qrcodeNumber);
	$res = $this->db->get('qrcodelist')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return "1";
		}else
		{
			return "0";
		}
   }
}


public function videouploading($videouploadingdata)
{

	$this->db->trans_start();

	$res = $this->db->insert('tbl_videouploadingdata',$videouploadingdata);

	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if($res==1){
			return 1;
		}else {
			return 0;
		}
	}
}

public function fk_monthId_exist($fk_monthId,$fk_dayId,$fk_sessionId,$fk_classId,$param)
{
	$this->db->trans_start();

	$this->db->where('fk_monthId',$fk_monthId);
	$this->db->where('fk_dayId',$fk_dayId);
	$this->db->where('fk_sessionId',$fk_sessionId);
	$this->db->where('fk_classId',$fk_classId);
	$this->db->where('fk_upload_key',$fk_upload_key);
	$this->db->where('param',$param);
	$res = $this->db->get('tbl_videouploadingdata')->result_array();

	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return 1;
		}else {
			return 0;
		}
	}


}

public function deletevideoId($vidId)
{
	$this->db->trans_start();
	$this->db->where('vidId',$vidId);
	$res = $this->db->delete('tbl_videouploadingdata');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if($res==1){
			return 1;
		}else {
			return 0;
		}
	}

}

public function listvideouploading($fk_classId)
{
	$this->db->trans_start();

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

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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
	

public function get_month_data($monthId,$fk_classId)
{
	$this->db->trans_start();
	$this->db->select('*');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->where('tbl_videouploadingdata.fk_monthId',$monthId);
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','desc');
	$this->db->order_by('tbl_days.dayName','ASC');
	$this->db->group_by('fk_dayId');
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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

public function get_month_data_for_admin($fk_classId)
{
	$this->db->trans_start();
	$this->db->select('*');
	$this->db->from('tbl_videouploadingdata');
	$this->db->join('tbl_category','tbl_category.catId = tbl_videouploadingdata.fk_catId');
	$this->db->join('tbl_class','tbl_class.classId = tbl_videouploadingdata.fk_classId');
	$this->db->join('tbl_contnet_type','tbl_contnet_type.contentId = tbl_videouploadingdata.fk_contentId');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId');
	$this->db->join('tbl_month','tbl_month.mId = tbl_videouploadingdata.fk_monthId');
	$this->db->join('tbl_days','tbl_days.dayId = tbl_videouploadingdata.fk_dayId');
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_days.dayName','ASC');
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$this->db->group_by('fk_dayId');
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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


public function get_day_sessions($dayId,$monthId,$fk_classId,$studId)
{

	$this->db->trans_start();

    
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
	
	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	//  echo $this->db->last_query();
	// die;
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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
public function get_day_sessions_recap($dayId,$monthId,$fk_classId,$studId,$recap)
{

	$this->db->trans_start();

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
	if(!empty($studId)){

		$this->db->where('tbl_videouploadingdata.fk_upload_key',3);
	}else if(!empty($recap)){
	    $this->db->where('tbl_videouploadingdata.fk_upload_key',$recap);
	}
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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

public function get_day_sessions_vid($dayId,$monthId,$fk_classId,$vidId,$studId)
{
	$this->db->trans_start();

	// $this->db->where('fk_studId',$studId);
	// $this->db->where('paystatus',"success");
    // $this->db->where('paystatusId',1);
    // $open_monthdata = $this->db->get('log_payment_data')->result_array();
    // if(!empty($open_monthdata)){
    // 	$fk_upload_key = 2;
    // }else{
    // 	$fk_upload_key = 1;
    // }

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
	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
// echo $this->db->last_query();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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

public function get_day_sessions_vid_by_default($dayId,$monthId,$fk_classId,$studId)
{
	$this->db->trans_start();

	$this->db->where('fk_studId',$studId);
	$this->db->where('paystatus',"success");
    $this->db->where('paystatusId',1);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    if(!empty($open_monthdata)){
    	$fk_upload_key = 2;
    }else{
    	$fk_upload_key = 1;
    }


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
	$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	// echo $this->db->last_query();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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




public function filteredvideouploading($data)
{
		
	$this->db->trans_start();

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

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

	 return $res = $this->db->get()->result_array();
    }
		// echo $this->db->last_query();

}


public function update_videouploading($vidId)
{
	$this->db->trans_start();
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

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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


public function update_filteredvideouploading($data)
{

	$this->db->trans_start();

	$this->db->where('vidId',$data['vidId']);
	$res = $this->db->update('tbl_videouploadingdata',$data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else { 
	 return $res;
   }
}


public function check_login_exist($data)
{
	$this->db->trans_start();

	$this->db->where('studentEmail',$data['studentEmail']);
	$result = $this->db->get('studentreg')->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

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
	$this->db->trans_start();
	$sessionType = $this->db->insert('tbl_session_type',$addsession);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if($sessionType==1){
		 	return 1;
		 }else{
		 	return 0;
		 }
	 }

}

public function addcategory($data)
{
	 $this->db->trans_start();
	 $tbl_category = $this->db->insert('tbl_category',$data);
	 $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

	 if($tbl_category==1){
	 	return 1;
	 }else{
	 	return 0;
	 }
  }
}

public function deletecatId($catId)
{
	$this->db->trans_start();

	$this->db->where('catId',$catId);
	$res = $this->db->delete('tbl_category');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if($res==1){
			return 1;
		}else{
			return 0;
		}
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
	$this->db->or_where('studentMobile',$studentMobile);
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
	$message = trim("Your OTP for VEDIC TREE KIDS LEARNING APP login is ".$arraydata['OTP']." \nFor further details please visit our website www.vedictreeschool.com");
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
					$this->db->where('studAId',$res[0]['studId']);
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
	if(!empty($the_session)){
		$this->session->set_userdata('usersession',$the_session);
	}else{
		$the_session = array(); 
		$this->session->set_userdata('usersession',$the_session);
	}
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
	$this->db->join('tbl_states','tbl_states.stateId = studentreg.usr_state','left');
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
	$this->db->join('tbl_states','tbl_states.stateId = studentreg_fatherinfo.usr_state','left');
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
	$this->db->join('tbl_states','tbl_states.stateId = studentreg_motherinfo.usr_state','left');
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


public function getplanvalue_emi($loanemiId)
{
	
	$this->db->where('emi_Id',$loanemiId);
	$res = $this->db->get('tbl_emi')->result_array();
	if(!empty($res)){
		return $res;
	}else {
		return $res;
	}

}



public function log_payment_data($data)
{
	$this->db->trans_start();
	$this->db->where('paymentType',3);	
	
	$this->db->where('fk_studId',$data['fk_studId']);	
	$alreaypaid = $this->db->get('log_payment_data')->result_array();
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(empty($alreaypaid)){

			$this->db->where('feesId',$data['planId']);
	        $res = $this->db->get('tab_add_fees_data')->result_array();

		    $data = array(
                        'usr_firstname'   => $data['usr_firstname'],
                        'usr_lastname'    => $data['usr_lastname'],
                        'usr_email'       => $data['usr_email'],
                        'usr_mobile_no'   => $data['usr_mobile_no'],
                        'payAmount'       => $res[0]['final_fees'],
                        'fk_studId'       => $data['fk_studId'],
                        'paystatusId'     => 2,
                        'planId'          => $data['planId'],
                        'paymentType'     => $data['paymentType'],
                        'fk_monthId'      => $data['fk_monthId'],
                        'Receiptpic'      => $data['Receiptpic'],
                        'paystatus'       => "Pending"
                      ); 

			$res = $this->db->insert('log_payment_data',$data);
			if($res==1){
				return $res;
			}else {
				return $res;
			}
		}else{
			return 0;
		}	
	}	

}


public function update_log_payment($studId,$paystatus,$razorpay_order_id,$razorpay_payment_id,$razorpay_signature)
{	
		$this->db->trans_start();
		$this->db->where('fk_studId',$studId);	
		$this->db->or_where('razorpay_order_id',$razorpay_order_id);	
		$log_payment_data = $this->db->get('log_payment_data')->result_array();
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
		} else {

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
	
}



public function last_session_running($studId,$fk_classId)
{

	$this->db->trans_start();

	$this->db->where('fk_user_id',$studId);
	$this->db->where('fk_classId',$fk_classId);
	$this->db->order_by('trackId','desc');
	$this->db->limit(1);
	$res = $this->db->get('tbl_tracking_watch_video')->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

			if(!empty($res)){
				return $res;
			} else {
				return $res;
			}
		}

}


public function check_social_login_exist($studentEmail){
    
    $this->db->trans_start();

    $this->db->where('studentEmail',$studentEmail);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

			if(!empty($res)){
				return $res;
			} else {
				return $res;
			}
		}
	
}

public function getfees($classId){
	$this->db->trans_start();

    $this->db->where('fk_classId',$classId);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

			if(!empty($res)){
				return $res;
			} else {
				return $res;
			}
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

public function payment_his_data($studId)
{

    $this->db->trans_start();
    $this->db->where('fk_studId',$studId);
	$res = $this->db->get('log_payment_data')->result_array();
	if ($this->db->trans_status() === FALSE)
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

public function payment_his_data_showpdf($studId,$logId)
{
	$this->db->trans_start();
    $this->db->where('fk_studId',$studId);
    $this->db->where('logId',$logId);
	$res = $this->db->get('log_payment_data')->result_array();
	if ($this->db->trans_status() === FALSE)
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
public function get_payment_data($studId)
{
    $this->db->trans_start();
    $this->db->where('fk_studId',$studId);
    $this->db->order_by('logId','desc');
    $this->db->limit(1);
	$res = $this->db->get('log_payment_data')->result_array();
    if ($this->db->trans_status() === FALSE)
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

public function check_razorpay_payment_id_exist($data)
{
	
	$this->db->where('razorpay_order_id',$data['razorpay_order_id']);
	$this->db->where('razorpay_payment_id',$data['razorpay_payment_id']);
	$res = $this->db->get('log_payment_data')->result_array();
	if(!empty($res)){
		return 1;
	} else {

		$res = $this->db->insert('log_payment_data',$data);
		if($res==1){
		 return 0;    
		}
	}


}


public function get_payment_history_with_all_details($fk_studId){
    
    $this->db->trans_start();
	$this->db->select('*');
	$this->db->from('log_payment_data');
	$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
	$this->db->where('log_payment_data.fk_studId',$fk_studId);
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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


public function myrefferals($NewrefferalCode)
{
	
	$this->db->where('refferalCode',$NewrefferalCode);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
}



public function emiapplicationform($paymentdata)
{
	
			$this->db->where('fk_studId',$paymentdata['fk_studId']);
			$this->db->where('planId',$paymentdata['planId']);
	$result = $this->db->get('emiapplicationform')->result_array();

	if(!empty($result)){
		
		return 0;

	}else{

	$paymentdata1 = array(
		'student_dob'  =>date("Y-m-d",strtotime($paymentdata['student_dob'])),
		'applicant_dob'=>date("Y-m-d",strtotime($paymentdata['applicant_dob']))
	);

	$paymentdata = array_merge($paymentdata,$paymentdata1);

	$res = $this->db->insert('emiapplicationform',$paymentdata);
	if($res==1){
	   return 1;
	} else {
	   return 0;
	}
	}

}

public function update_applicationStatus($applicationStatus,$studId)
{
	$this->db->where('fk_studId',$studId);
	$res = $this->db->update('emiapplicationform',$applicationStatus);
	if($res==1){
	   return 1;
	} else {
	   return 0;
	}

	
}

public function insert_log_payment_data($insert_log_payment_data)
{
	$res = $this->db->insert('log_payment_data',$insert_log_payment_data);
	if($res==1){
	   return 1;
	} else {
	   return 0;
	}

	
}

public function getTeacher()
{
	
    $this->db->join('tbl_class','tbl_class.classId = tbl_teacher.teacherClass');
    $this->db->where('teacherStatus',1);
	$res = $this->db->get('tbl_teacher')->result_array();
	if(!empty($res)){
			return $res;
		}else {
			return $res;
		}

}
public function tab_add_fees_data()
{

	$res = $this->db->get('tab_add_fees_data')->result_array();
	if(!empty($res)){
			return $res;
		}else {
			return $res;
		}

}




public function temp_enquiry($dataarray)
{
	
	$this->db->where('studentEmail',$dataarray['studentEmail']);
	$this->db->or_where('studentMobile',$dataarray['studentMobile']);
	$result = $this->db->get('tbl_temp_enquiry')->result_array();
	if(empty($result)){
	  $res = $this->db->insert('tbl_temp_enquiry',$dataarray);
		if(!empty($res)){
			return 1;
		}else {
			return 0;
		}
	}else{
		return 0;

	}
}



public function get_temp_enquiry()
{
	$this->db->join('tbl_class','tbl_class.classId = tbl_temp_enquiry.studentClass');
	$result = $this->db->get('tbl_temp_enquiry')->result_array();
	return $result;
}


public function get_temp_enquiry_filter($studentName,$studentMobile,$studentEmail)
{
	
	$this->db->like('studentName',$studentName);
	$this->db->or_where('studentMobile',$studentMobile);
	$this->db->or_where('studentEmail',$studentEmail);
	$this->db->join('tbl_class','tbl_class.classId = tbl_temp_enquiry.studentClass');
	$result = $this->db->get('tbl_temp_enquiry')->result_array();
	if(empty($result)){
		return $result;
	}else{
		return $result;
	}
}


public function getstudlist_final()
{
	$this->db->trans_start();

	$this->db->where('studentStatus',1);
	$this->db->where('log_payment_data.paystatusId',1);
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
	$res = $this->db->get('studentreg')->result_array();

	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
      return $res;
   }

}


public function filter_studlist_final($data)
{
	$this->db->trans_start();

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



	if($data['paystatus']!="")
	{
		$this->db->or_where('log_payment_data.paystatus ',$data['paystatus']);
	}


	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
		
	$this->db->where('studentStatus',1);
	$this->db->where('log_payment_data.paystatusId',1);
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');

	$res = $this->db->get('studentreg')->result_array();

	// echo "<pre>";
	// echo $this->db->last_query();
	// print_r($res);
	// die;
    return $res;	

    }


	
}



public function websitedown()
{
	return $res = $this->db->get('websitedown')->result_array();
}


public function updatestatuswebdown($webstatus)
{
		  $data = array('webstatus'=>$webstatus);
	return $res = $this->db->update('websitedown',$data);

}

public function get_real_data_from_database($studId)
{
	
	$this->db->where('studentStatus',1);
	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
    return $res;

}

public function get_real_data_from_database_planId($planId)
{
	
	$this->db->where('feesId',$planId);
	$res = $this->db->get('tab_add_fees_data')->result_array();
    return $res;


}



public function setemi($arraydata)
{
	
	$this->db->trans_start();
	$this->db->where('fk_feesId',$arraydata['fk_feesId']);
	$this->db->where('fk_classId',$arraydata['fk_classId']);
	$this->db->where('fk_feesId',$arraydata['fk_feesId']);
	$this->db->where('fk_tid',$arraydata['fk_tid']);
	$result = $this->db->get('tbl_emi')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

      	if(empty($result))
      	{
      		$res = $this->db->insert('tbl_emi',$arraydata);
      		if($res==1){
      			return 1;
      		}else{	
      			return 0;
      		}

      	} else {
      	return 0;
      }
   }

}


public function getemi()
{

	$this->db->join('tbl_tenure','tbl_tenure.tid = tbl_emi.fk_tid','left');	
	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = tbl_emi.fk_feesId','left');	
	return $res = $this->db->get('tbl_emi')->result_array();
}


public function tbl_tenure()
{

	$res = $this->db->get('tbl_tenure')->result_array();
	if(!empty($res)){
			return $res;
		}else {
			return $res;
		}

}


public function deleteemifeesId($emi_Id)
{
	$this->db->where('emi_Id',$emi_Id);
	$res = $this->db->delete('tbl_emi');
	if($res==1){
			return 1;
		}else {
			return 0;
		}
}





function day_open_for_next_session() {


    $getcountofvideos 				= array();
    $get_count_of_videos_history 	= 0;
    $get_count_of_videos_historys 	= array();
    $usersession  					= $this->session->userdata('usersession');
    $fk_classId   					= $usersession[0]['studentClass'];
    $fk_studId   					= $usersession[0]['studId'];
    $date 							= date("Y-m-d 00:00:00");
    $enddate 						= date("Y-m-d 23:59:59");
    $unlock_days 					= 1;
    $count_of_video_uploaded 		= 0;
    $this->db->where('createTrackDT >=',$date);
    $this->db->where('createTrackDT <=',$enddate);
    $this->db->order_by('trackId','desc');
    $this->db->limit(1);
    $res = $this->db->get('tbl_tracking_watch_video')->result_array();

    if(!empty($res)){

    	foreach ($res as $key => $value) {
            $this->db->where('vidId',$value['fk_sessionId']);
            $result = $this->db->get('tbl_videouploadingdata')->result_array();
            if($result){
                foreach ($result as $key => $resvalue) {
                    $getcountofvideos = $this->getcountofvideos($resvalue['fk_monthId'],$resvalue['fk_dayId'],$fk_classId);
                    $unlock_days = $resvalue['fk_dayId'];
                }
            }
        }

     if($getcountofvideos){

     	$count_of_video_uploaded = count($getcountofvideos);
     	
     	foreach ($getcountofvideos as $key => $resvalue)
     	{
     		$get_count_of_videos_historys = $this->get_count_of_videos_history($resvalue['vidId'],$resvalue['vimeoId'],$resvalue['fk_classId']);
     	}
     }
     $get_count_of_videos_history = count($get_count_of_videos_historys);
     
     if($get_count_of_videos_history==$count_of_video_uploaded){
     		$this->db->where('unlock_days',$unlock_days);
     		$res_tbl_unlock_days = $this->db->get('tbl_unlock_days')->result_array();
     		if(empty($res_tbl_unlock_days)){
     			$tbl_unlock_days = array('fk_studId'=>$fk_studId,'fk_classId'=>$fk_classId,'unlock_days'=>$unlock_days+1,'status'=>1);
     			$this->db->insert('tbl_unlock_days',$tbl_unlock_days);
     		}else{
     			$tbl_unlock_days = array('unlock_days'=>$unlock_days);
     			$this->db->where('fk_studId',$fk_studId);
     			$this->db->update('tbl_unlock_days',$tbl_unlock_days);
     		}
     	return  $get_count_of_videos_historys;
     } else {
        return $get_count_of_videos_historys;
     }
    }else {
        return $res;
    }

}


public function getcountofvideos($fk_monthId,$fk_dayId,$fk_classId)
{
	

			$this->db->where('fk_monthId',$fk_monthId);
			$this->db->where('fk_dayId',$fk_dayId);
			$this->db->where('fk_classId',$fk_classId);
             return $result = $this->db->get('tbl_videouploadingdata')->result_array();


}
public function get_count_of_videos_history($vidId,$vimeoId,$fk_classId)
{
	

			$this->db->where('fk_sessionId',$vidId);
			$this->db->or_where('fk_sessionId',$vimeoId);
			$this->db->or_where('fk_classId',$fk_classId);
			$this->db->group_by('fk_sessionId');
			$this->db->order_by('trackId','desc');
			// $this->db->limit(1);
             return $result = $this->db->get('tbl_tracking_watch_video')->result_array();
            //  echo "<pre>";
            // echo $this->db->last_query();


}




public function tbl_unlock_days()
{
		$this->db->order_by('tucId','desc');
	   return $result = $this->db->get('tbl_unlock_days')->result_array();
}



public function emi_form_by_parents()
{
	
	   return $result = $this->db->get('emiapplicationform')->result_array();

}


public function get_emi_form_by_parents($studentMobile,$studentEmail)
{
	
	  $this->db->where('mobile',$studentMobile);	
	  $this->db->or_where('email',$studentEmail);	
	  $result = $this->db->get('emiapplicationform')->result_array();
	  if($result){
	  	return $result;
	  }else{
	  	return $result;
	  }
}



public function check_student_exist($studId)
{
  
	$this->db->or_where('studId',$studId);	
	  $result = $this->db->get('studentreg')->result_array();
	  if($result){
	  	return $result;
	  }else{
	  	return $result;
	  }
  
}


public function student_daily_reports($fk_studId,$Current_datetime,$End_datetime)
{
	$this->db->select_max('trackEndTime');
	$this->db->select_max('trackStartTime');
	$this->db->select_max('trackDuration');
	$this->db->select('sessionName,createDT,content_title,trackId');
	$this->db->where('fk_user_id',$fk_studId);
	$this->db->where('createTrackDT >=',$Current_datetime);
	$this->db->where('createTrackDT <=',$End_datetime);
	$this->db->group_by('tbl_session_type.sessionName');
	$this->db->join('tbl_videouploadingdata','tbl_videouploadingdata.vidId = tbl_tracking_watch_video.fk_sessionId','left');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId','left');
	$res = $this->db->get('tbl_tracking_watch_video')->result_array();
	if(!empty($res)){
		return $res;
	}else{
		return $res;
	}
}




public function student_daily_reports_filter($fk_studId,$Current_datetime,$lastWeek){


	
	$this->db->select_max('trackEndTime');
	$this->db->select_max('trackStartTime');
	$this->db->select_max('trackDuration');
	$this->db->select('sessionName,createDT,content_title,trackId');
	$this->db->where('fk_user_id',$fk_studId);
	if($lastWeek =="today"){
		$this->db->where('createTrackDT >=',$Current_datetime);
		$this->db->where('createTrackDT <=',$lastWeek);
	}else{
		$this->db->where('createTrackDT <=',$Current_datetime);
		$this->db->where('createTrackDT >=',$lastWeek);
	}
	$this->db->group_by('tbl_session_type.sessionName');
	$this->db->join('tbl_videouploadingdata','tbl_videouploadingdata.vidId = tbl_tracking_watch_video.fk_sessionId','left');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId','left');
	$res = $this->db->get('tbl_tracking_watch_video')->result_array();

	if(!empty($res)){
		return $res;
	}else{
		return $res;
	}

}



public function listvideouploading_demo($fk_classId)
{
	$this->db->trans_start();

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
	$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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



public function listvideouploading_recap($fk_classId)
{
	$this->db->trans_start();

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
	$this->db->where('tbl_videouploadingdata.fk_upload_key',3);
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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




public function get_day_sessions_vid_recap_vidId($dayId,$monthId,$fk_classId,$vidId,$studId)
{
	$this->db->trans_start();

	

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
	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->where('tbl_videouploadingdata.fk_upload_key',3);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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


//teacher model
public function get_day_sessions_vid_recap($dayId,$monthId,$fk_classId,$studId)
{
	$this->db->trans_start();

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
	$this->db->where('tbl_videouploadingdata.fk_upload_key',3);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
// echo $this->db->last_query();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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

public function get_day_sessions_vid_by_default_recap($dayId,$monthId,$fk_classId,$studId)
{
	$this->db->trans_start();

	

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
	$this->db->where('tbl_videouploadingdata.fk_upload_key',3);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	// echo $this->db->last_query();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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


public function user_state()
{
	$this->db->trans_start();
    $res = $this->db->get('tbl_states')->result_array();

    $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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


public function check_mobile_exist_web($studentMobile)
{
	

	$this->db->trans_start();
	$this->db->where('studentMobile',$studentMobile);
	$this->db->or_where('studentAltMobile',$studentMobile);
	$res = $this->db->get('studentreg')->result();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		if(!empty($res)){
			

			$this->session->set_userdata('forgetmobile',$studentMobile);
			$otpnumber = rand(000000,999999);
			$updatearry = array('OTP'=>$otpnumber);
			$this->db->or_where('studentMobile',$studentMobile);
			$this->db->or_where('studentAltMobile',$studentMobile);
			$result = $this->db->update('studentreg',$updatearry);
			$message = trim("Otp number for forget password is ".$otpnumber."");
			$res = sendsms($studentMobile, $message);
			if($res=="fail" || $res=="InsufficientBalance")
			{
				$data_otp_array = array(
		        'studentMobile'  		=> $studentMobile,
		        'user_OTP_Status'  		=> 2         //failed sending sms
				);
			}else{
				$data_otp_array = array(
		        'studentMobile'  		=> $studentMobile,
		        'user_OTP_Status'  		=> 1          //success sending sms
				);

			}
			$user_otp_data = $this->db->insert('student_otp_data',$data_otp_array);

			if($result==1){
				return "1";
			}else{
				return "0";
			}

		}else{
			return "0";
		}
	}

}



public function updateforgetpass($otp,$newpass,$studentMobile)
{


	$this->db->trans_start();
	$this->db->where('studentMobile',$studentMobile);
	$this->db->where('studentStatus',1);
	$this->db->or_where('studentAltMobile',$studentMobile);
	$res = $this->db->get('studentreg')->result_array();
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		if(!empty($res)){			
			$updatearry =  array('studentPass'=>sha1($newpass));
			$this->db->or_where('studentMobile',$studentMobile);
			$this->db->or_where('studentAltMobile',$studentMobile);
			$result = $this->db->update('studentreg',$updatearry);
			if($result==1){
				return "1";
			}else{
				return "0";
			}

		}else{
			return "0";
		}
	}

}




public function get_day_sessions_value_based($dayId,$monthId,$fk_classId,$studId)
{

	$this->db->trans_start();

    $this->db->where('fk_studId',$studId);
	$this->db->where('paystatus',"success");
    $this->db->where('paystatusId',1);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    if(!empty($open_monthdata)){
    	$fk_upload_key = 2;
    }else{
    	$fk_upload_key = 1;
    }
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
	$this->db->where('tbl_videouploadingdata.param','valubasededucation');
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$this->db->where('tbl_videouploadingdata.status',1);
	if(!empty($studId)){

		$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
	}
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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


public function last_session_running_value_based($studId,$fk_classId)
{

	$this->db->trans_start();

	$this->db->where('fk_user_id',$studId);
	$this->db->where('fk_classId',$fk_classId);
	$this->db->order_by('trackId','desc');
	$this->db->limit(1);
	$res = $this->db->get('tbl_tracking_watch_video')->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

			if(!empty($res)){
				return $res;
			} else {
				return $res;
			}
		}

}



public function get_day_sessions_vid_value_based($dayId,$monthId,$fk_classId,$vidId,$studId)
{
	$this->db->trans_start();

	$this->db->where('fk_studId',$studId);
	$this->db->where('paystatus',"success");
    $this->db->where('paystatusId',1);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    if(!empty($open_monthdata)){
    	$fk_upload_key = 2;
    }else{
    	$fk_upload_key = 1;
    }

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
	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
	$this->db->where('tbl_videouploadingdata.param','valubasededucation');
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
// echo $this->db->last_query();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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


public function get_day_sessions_vid_by_default_value_based($dayId,$monthId,$fk_classId,$studId)
{
	$this->db->trans_start();

	$this->db->where('fk_studId',$studId);
	$this->db->where('paystatus',"success");
    $this->db->where('paystatusId',1);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    if(!empty($open_monthdata)){
    	$fk_upload_key = 2;
    }else{
    	$fk_upload_key = 1;
    }


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
	$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
	$this->db->where('tbl_videouploadingdata.param','valubasededucation');
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	// echo $this->db->last_query();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
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





public function get_month_data_admin()
{
	

	$res = $this->db->get('tbl_month')->result_array();
	if(!empty($res)){
			return $res;
		}else {
			return $res;
		}

}


public function unlocksession($mId,$studId,$fk_classId)
{
	
	$this->db->where('fk_studId',$studId);
	$res = $this->db->get('log_payment_data')->result_array();
	if(!empty($res)){
		$data = array('fk_monthId'=>$mId);
		$this->db->where('fk_studId',$studId);
		$res = $this->db->update('log_payment_data',$data);	
	if($res==1){
		return 1;
	}else{
		return 0;
	}		
	}else{
		return 0;
	}


}


public function unlocksession_data($studId)
{
	
	$this->db->where('fk_studId',$studId);
	$res = $this->db->get('log_payment_data')->result_array();
	if(!empty($res)){
		return $res;
	}else{
		return $res;
	}


}


public function onboarding($fk_monthId,$studId,$usr_firstname,$usr_lastname,$usr_email,$usr_mobile_no,$paymentType,$Receiptpic,$planId,$payAmount)
{
	

	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){	
		$this->db->where('fk_studId',$studId);
		$this->db->where('usr_email',$usr_email);
		$this->db->where('usr_mobile_no',$usr_mobile_no);
		$log_payment_data = $this->db->get('log_payment_data')->result_array();
		if(empty($log_payment_data)){

		$this->db->where('feesId',$planId);
		$planIddata = $this->db->get('tab_add_fees_data')->result_array();
		if($payAmount==""){
			$payAmount = $planIddata[0]['final_fees'];
		}else{
			$payAmount = $payAmount;
		}
			$updatearry = array( 
							'fk_monthId'			=> $fk_monthId,
							'usr_firstname'			=> $usr_firstname,
							'usr_lastname'			=> $usr_lastname,
							'usr_email'				=> $usr_email,
							'usr_mobile_no'			=> $usr_mobile_no,
							'paymentType'			=> $paymentType,
							'fk_studId'				=> $studId,
							'Receiptpic'			=> $Receiptpic,
							'planId'				=> $planId,
							'payAmount'				=> $payAmount,
							'paystatusId'			=> 2,
							'paystatus'				=> "Pending",
							'paymentSatusByadmin'	=> 2,
			);
			$res = $this->db->insert('log_payment_data',$updatearry);
			if($res==1){
				return 1;
			}else{
				return 0;
			}
		}else{

			return 0;
		}
	}else{
		return 0;
	}

}




public function onboardinglist()
{
	
		$this->db->where('paystatusId',2);
		$this->db->where('paymentSatusByadmin',2);
		$log_payment_data = $this->db->get('log_payment_data')->result_array();
		if(!empty($log_payment_data)){
			return $log_payment_data;
		}else{
			return $log_payment_data;
		}



}


public function onboardinglistStatus($studId,$paymentSatusByadmin)
{
	
	$data = array('paymentSatusByadmin'=>$paymentSatusByadmin,'paystatusId'=>$paymentSatusByadmin,'paystatus'=>"success");
	$this->db->where('fk_studId',$studId);
	$res = $this->db->update('log_payment_data',$data);	
	if($res==1){
		return 1;
	}else{
		return 0;
	}		
}


public function get_student_id($studId){

	$this->db->where('studId',$studId);	
	$this->db->where('studentStatus',1);	
	return $result = $this->db->get('studentreg')->result_array();
}


public function unlockdays()
{


	return $daydata = $this->db->get('tbl_days')->result_array();

}


public function unlocksession_day($studId)
{
	
	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
		return $res;
	}else{
		return $res;
	}


}

public function unlocksession_day_student($dayId,$studId,$fk_monthId)
{

	$this->db->where('fk_studId',$studId);
	$res = $this->db->get('log_payment_data')->result_array();
	if(!empty($res)){

	   $data = array('unlockdayId'=>$dayId,'unlock_monthId'=>$fk_monthId);	
		$this->db->where('studId',$studId);
		$res = $this->db->update('studentreg',$data);	
		if($res==1){
			return 1;
		}else{
			return 0;
		}
	}else{
		return 0;
	}	


}


	public function temp_enquiry_api($output)
	{
		
		$data  = array('jsonapi'=>json_encode($output));
	  return $res = $this->db->insert('temp_enquiry_api',$data);		

	}


public function activatestud($studId)
{
	
	    $data = array('studentStatus'=>1);	
		$this->db->where('studId',$studId);
		$res = $this->db->update('studentreg',$data);	
		if($res==1){
			return 1;
		}else{
			return 0;
		}



}

















}
?>