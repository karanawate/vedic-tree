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
	$message = trim("is Your OTP for VEDIC TREE KIDS LEARNING APP login For further details please visit our website www.vedictreeschool.online");

	$res = sendsmsweb($data['studentMobile'],$data['OTP'],$message);
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
	  $this->db->trans_rollback();
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
	$this->db->where('studentStatus',1);
	$res = $this->db->get('studentreg')->result_array();
    $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();  
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{	

			if(!empty($res)){
				
				$Otpno = rand(1111,9999);
				$data = array('OTP'=>$Otpno);
				$this->db->where('studentMobile',$studentMobile);
				$this->db->update('studentreg',$data);
				$message = trim("is Your OTP for VEDIC TREE KIDS LEARNING APP login For further details please visit our website www.vedictreeschool.online");
				$res = sendsmsweb($studentMobile,$Otpno,$message);
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
	  $this->db->trans_rollback();  
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{	
		if(!empty($res)){
			$data = array('studentStatus'=>1);
			$this->db->where('studentMobile',$studentMobile);
			$this->db->update('studentreg',$data);
			return "1";
		} else {
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
	  $this->db->trans_rollback();  
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
	  $this->db->trans_rollback();  
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
	  $this->db->trans_rollback();  
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
	  $this->db->trans_rollback();
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
	$this->db->trans_start();	
	$data = array('OTP'=>$otp);
	$this->db->where('studentMobile',$studentMobile);
	$this->db->update('studentreg',$data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
	    
    	$message = "is Your OTP for VEDIC TREE KIDS LEARNING APP login  For further details please visit our website www.vedictreeschool.online";
    	$res = sendsmsweb($studentMobile,$otp, $message);
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

}


public function check_login_data($data)
{

	$this->db->trans_start();
	$this->db->where('studentMobile', $data['studentMobile'] );
	$this->db->where('studentPass', $data['studentPass'] );
	$this->db->where('studentStatus', 1 );
	$res = $this->db->get('tbl_admin_ved')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();  
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
		if(!empty($res)){
	        $dataarray = array('logstatus'=>1);
	        $this->db->where('studentMobile',$data['studentMobile']);
	        $this->db->update('tbl_admin_ved',$dataarray);
			$this->session->set_userdata('usersession',$res);
			return $res;
		}else{
			return $res;
		}
	}

}





public function updatepass($otp,$newpass,$studentMobile)
{
	$this->db->trans_start();
    $this->db->where('OTP', $otp );
	$result = $this->db->get('studentreg')->result_array();
	if(!empty($result)){
	
        	$dataarray = array('studentPass'=>sha1($newpass));
            $this->db->where('studentMobile',$studentMobile);
            $this->db->where('OTP',$otp);
            $res = $this->db->update('studentreg',$dataarray);
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
        	{
        	  $this->db->trans_rollback();  
        	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
        	}else{
                
                if($res==1){
                    return 1;
                }else{
                    return 0;
                }
            	
            }
	}else{
	    return 0;
	}

}

public function getstudlist()
{
	$this->db->trans_start();
    $this->db->select("*,studentreg.createDT as date");
	$this->db->where('studentStatus',1);
	$this->db->or_where('log_payment_data.paystatusId',1);
	$this->db->or_where('log_payment_data.paystatusId',2);
	$this->db->group_by('studId');
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$this->db->join('tbl_states','tbl_states.stateId = studentreg.usr_state','left');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();  
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
	   $this->db->trans_rollback(); 
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
	   $this->db->trans_rollback(); 
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
	   $this->db->trans_rollback(); 
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
	   $this->db->trans_rollback(); 
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
	   $this->db->trans_rollback(); 
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
	   $this->db->trans_rollback(); 
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
    $this->db->trans_start();
	$this->db->where('notId',$data['notId']);
	$result = $this->db->update('notice',$data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback(); 
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
	    
    	if($result==1){
    		return "1";
    	}else{
    		return "0";
    	}
	}
}

public function notice($data)
{
    $this->db->trans_start();
	$result = $this->db->insert('notice',$data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback(); 
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
	    
    	if($result==1){
    		return "1";
    	}else{
    		return "0";
    	}
	}
}


public function change_status($status,$notId)
{	
    $this->db->trans_start();
	$data = array('status'=>$status);
	$this->db->where('notId',$notId);
	$result = $this->db->update('notice',$data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback(); 
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
	    
    	if($result==1){
    		return "1";
    	}else{
    		return "0";
    	}
	 }
}


public function filter_studlist($data)
{
	$this->db->trans_start();

	if($data['fromDT']!="" &&  $data['toDT']!="" ){
		$this->db->where('log_payment_data.createDT BETWEEN "'. date('Y-m-d h:i:s', strtotime($data['fromDT'])). '" and "'. date('Y-m-d h:i:s', strtotime($data['toDT'])).'"');
	}

	if($data['studentMobile']!="" && $data['studentEmail']!="" && $data['fromDT']!="" &&  $data['toDT']!="" ){
		
		$this->db->where('log_payment_data.createDT BETWEEN "'. date('Y-m-d h:i:s', strtotime($data['fromDT'])). '" and "'. date('Y-m-d h:i:s', strtotime($data['toDT'])).'"');
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
	
	if($data['paystatusId']!="")
	{
		$this->db->or_where('log_payment_data.paystatusId ',$data['paystatusId']);
	}
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();  
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	   
	}else{
		
	$this->db->where('studentStatus',1);
	$this->db->group_by('studId');
	$this->db->join('tbl_states','tbl_states.stateId = studentreg.usr_state','left');
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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if($res==1){
			return 1;
		}else {
			return 0;
		}
	}
}

public function fk_monthId_exist($fk_monthId,$fk_dayId,$fk_sessionId,$fk_classId,$fk_upload_key,$coursePeriod)
{
	$this->db->trans_start();

	$this->db->where('fk_monthId',$fk_monthId);
	$this->db->where('fk_dayId',$fk_dayId);
	$this->db->where('fk_sessionId',$fk_sessionId);
	$this->db->where('fk_classId',$fk_classId);
	$this->db->where('fk_upload_key',$fk_upload_key);
	$this->db->where('coursePeriod',$coursePeriod);
	
	$res = $this->db->get('tbl_videouploadingdata')->result_array();
	
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
    }

}
	

public function get_month_data($monthId,$fk_classId,$coursePeriod)
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
	if(!empty($coursePeriod)){
	 $this->db->where('tbl_videouploadingdata.coursePeriod',$coursePeriod);
	}
	
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','desc');
	$this->db->group_by('fk_dayId');
	$res = $this->db->get()->result_array();
    
    // echo $this->db->last_query();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback(); 
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
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$this->db->order_by('tbl_days.dayName','ASC');
	$this->db->group_by('fk_dayId');
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback(); 
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
    
    $this->db->where('fk_studId',$studId);
    $this->db->where_in('paystatusId',['1','3','4']);
   
    $this->db->where('paymentSatusByadmin',1);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    
    $this->db->where('studId',$studId);
	$result = $this->db->get('studentreg')->result_array();
	
    if(!empty($open_monthdata)){
    	$fk_upload_key = 2;
    	if(!empty($result))
    	{
    	    $result_courseId = $result[0]['fk_coursePeriod'];
    	    if($result_courseId > 0){
    	        $coursePeriod = $result_courseId;
    	    }else{
    	        $coursePeriod = 0;
    	    }
    	}else{
    	    $coursePeriod   = 0;
    	}
    }else{
    	$fk_upload_key  = 1;
    	$coursePeriod   = 0;
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
    $this->db->where('tbl_videouploadingdata.coursePeriod',$coursePeriod);
	$this->db->where('tbl_videouploadingdata.status',1);
	if(!empty($studId)){

		$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
	}

	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
   
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback(); 
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}
}

public function get_day_sessions_recap($dayId,$monthId,$fk_classId,$studId,$recap,$coursePeriod)
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
		$this->db->where('tbl_videouploadingdata.coursePeriod',$coursePeriod);
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
	    $this->db->trans_rollback(); 
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

	$this->db->where('fk_studId',$studId);
	$this->db->where('paymentSatusByadmin',1);
    $this->db->where_in('paystatusId',['1','3','4']);
    
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    
  
    $this->db->where('studId',$studId);
	$result = $this->db->get('studentreg')->result_array();
	
    if(!empty($open_monthdata)){
    	$fk_upload_key = 2;
    	if(!empty($result))
    	{
    	    $result_courseId = $result[0]['fk_coursePeriod'];
    	    if($result_courseId > 0){
    	        $coursePeriod = $result_courseId;
    	    }else{
    	        $coursePeriod = 0;
    	    }
    	}else{
    	    $coursePeriod   = 0;
    	}
    }else{
    	$fk_upload_key  = 1;
    	$coursePeriod   = 0;
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
	$this->db->where('tbl_videouploadingdata.coursePeriod',$coursePeriod);
	if(!empty($vidId)){
	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
	}
	$this->db->where('tbl_videouploadingdata.status',1);

	$this->db->where('tbl_videouploadingdata.fk_upload_key',$fk_upload_key);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
// 	echo $this->db->last_query();
    $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback(); 
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
	$this->db->where('paymentSatusByadmin',1);
    $this->db->where('paystatusId',1);
    $this->db->or_where('paystatusId',3);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    
    $this->db->where('studId',$studId);
	$result = $this->db->get('studentreg')->result_array();
	
    if(!empty($open_monthdata)){
    	$fk_upload_key = 2;
    	if(!empty($result))
    	{
    	    $result_courseId = $result[0]['fk_coursePeriod'];
    	    if($result_courseId > 0){
    	        $coursePeriod = $result_courseId;
    	    }else{
    	        $coursePeriod = 0;
    	    }
    	}else{
    	    $coursePeriod   = 0;
    	}
    }else{
    	$fk_upload_key  = 1;
    	$coursePeriod   = 0;
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
	$this->db->where('tbl_videouploadingdata.coursePeriod',$coursePeriod);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

	 return $res = $this->db->get()->result_array();
    }
	

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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
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



public function get_all_count_male()
{
    $this->db->where('studentGender','Female');
    $this->db->where('studentStatus',1);
    
	return $this->db->from("studentreg")->count_all_results();

}

public function get_all_count_female()
{
    $this->db->where('studentGender','Male');
    $this->db->where('studentStatus',1);
	return $this->db->from("studentreg")->count_all_results();

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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
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
	    $this->db->trans_rollback(); 
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
	$message = trim("is Your OTP for VEDIC TREE KIDS LEARNING APP login For further details please visit our website www.vedictreeschool.online");
	$res = sendsmsweb($arraydata['studentMobile'],$arraydata['OTP'],$message);
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
		
		$stdentAttendancelog = array('logRandomId'=>rand(111111,999999));
		$this->db->where('studId',$res[0]['studId']);
		$this->db->update('studentreg',$stdentAttendancelog);
					

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
    $this->db->trans_start();	
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
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if(!empty($res)){
    		return $res;
    	}else {
    		return $res;
    	}
	}



}


public function get_month_data_of_value_based_eductaion($vidcreateDT,$param,$endvidcreateDT,$fk_classId)
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
	$this->db->where('tbl_videouploadingdata.param',$param);
	$this->db->where('tbl_videouploadingdata.fk_classId',$fk_classId);
	$this->db->where('tbl_videouploadingdata.vidcreateDT>=',$vidcreateDT);
	$this->db->where('tbl_videouploadingdata.vidcreateDT<=',$endvidcreateDT);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_videouploadingdata.fk_dayId','asc');
	$res = $this->db->get()->result_array();
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if(!empty($res)){
    		return $res;
    	}else {
    		return $res;
    	}
	}


}

public function value_based_eductaion_related($param)
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
	$this->db->where('tbl_videouploadingdata.param',$param);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_videouploadingdata.fk_dayId','asc');
	$res = $this->db->get()->result_array();

    $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if(!empty($res)){
    		return $res;
    	}else {
    		return $res;
    	}
    }


}

public function alreadpackageName($packageName,$fk_classId)
{
    
    $countfk_classId = count($fk_classId);
      $res = "";
      for($i=0 ; $i <  $countfk_classId ;$i++)
      {
            if(isset($i)){      
        	    $this->db->where('packageName',$packageName);
        	    $this->db->where('fk_classId',$fk_classId[$i]);
        	    $res = $this->db->get('tab_add_fees_data')->result_array();
            }
      }
	
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
	$this->db->trans_start();
	$this->db->where('studId',$studId);
	$this->db->join('tbl_states','tbl_states.stateId = studentreg.usr_state','left');
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
   }
	
}

public function userinfo_father($studId)
{
    $this->db->trans_start();
	$this->db->where('studId',$studId);
	$this->db->join('tbl_states','tbl_states.stateId = studentreg_fatherinfo.usr_state','left');
	$res = $this->db->get('studentreg_fatherinfo')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}
	
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



public function userinfo_mother($studId)
{
    $this->db->trans_start();
	$this->db->where('studId',$studId);
	$this->db->join('tbl_states','tbl_states.stateId = studentreg_motherinfo.usr_state','left');
	$res = $this->db->get('studentreg_motherinfo')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
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
	$this->db->trans_start();
	$this->db->where('feesId',$planvalue);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
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
	     $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(empty($alreaypaid)){
		    
		    $this->db->where('feesId',$data['planId']);
	        $res = $this->db->get('tab_add_fees_data')->result_array();
	        
	        // 15 august offer
	        $usersession  					= $this->session->userdata('usersession');
	        if($usersession[0]['promoCode']=="15august"){

	        $final_fees = 15000;
	        }else{

	        $final_fees = $res[0]['final_fees'];
	        }
	        
		    $data = array(
                        'usr_firstname'   => $data['usr_firstname'],
                        'usr_lastname'    => $data['usr_lastname'],
                        'usr_email'       => $data['usr_email'],
                        'usr_mobile_no'   => $data['usr_mobile_no'],
                        'payAmount'       => $final_fees,
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


public function tbl_unlock_days()
{
		$this->db->order_by('tucId','desc');
	   return $result = $this->db->get('tbl_unlock_days')->result_array();
}

public function day_open_for_next_session() {


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
     return $result = $this->db->get('tbl_tracking_watch_video')->result_array();

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

				$data = array('paystatus'=>$paystatus,'razorpay_order_id'=>$razorpay_order_id,'razorpay_payment_id'=>$razorpay_payment_id,'razorpay_signature'=>$razorpay_signature,'paystatusId'=>1,'paymentSatusByadmin'=>1);
				$this->db->where('fk_studId',$studId);	
				$this->db->where('paystatusId',2);	
				$res = $this->db->update('log_payment_data',$data);
				if($res==1){
				    
				    $dataMonth = array('unlockdayId'=>1,'unlock_monthId'=>1);
					$this->db->where('studId',$studId);
					$res = $this->db->update('studentreg',$dataMonth);
					
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
	     $this->db->trans_rollback();
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
	     $this->db->trans_rollback();
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
	     $this->db->trans_rollback();
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
    $this->db->where('paymentSatusByadmin',1);
    $this->db->where_in('paystatusId', ['1','3','4']);
   
	$res = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
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
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	     $this->db->trans_rollback();
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
	$this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
	{
	     $this->db->trans_rollback();
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
	$this->db->trans_start();
	$this->db->where('razorpay_order_id',$data['razorpay_order_id']);
	$this->db->where('razorpay_payment_id',$data['razorpay_payment_id']);
	$res = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		
    	if(!empty($res)){
    		return 1;
    	} else {
    
    		$res = $this->db->insert('log_payment_data',$data);
    		if($res==1){
    		 return 0;    
    		}
    	}
    }


}


public function get_payment_history_with_all_details($fk_studId){
    
    $this->db->trans_start();
	$this->db->select('*,log_payment_data.createDT as paymentDate');
	$this->db->from('log_payment_data');
	$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
	$this->db->where('log_payment_data.fk_studId',$fk_studId);
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	     $this->db->trans_rollback();
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
	$this->db->trans_start();
	$this->db->where('refferalCode',$NewrefferalCode);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		
		
    	if(!empty($res)){
    			return $res;
    		}else {
    			return $res;
    		}
		}
}



public function emiapplicationform($paymentdata)
{
	
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

public function update_applicationStatus($applicationStatus,$studId)
{
    $this->db->trans_start();
	$this->db->where('fk_studId',$studId);
	$res = $this->db->update('emiapplicationform',$applicationStatus);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if($res==1){
    	   return 1;
    	} else {
    	   return 0;
    	}
    }

	
}

public function insert_log_payment_data($insert_log_payment_data)
{
    $this->db->trans_start();
	$res = $this->db->insert('log_payment_data',$insert_log_payment_data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if($res==1){
    	   return 1;
    	} else {
    	   return 0;
    	}
	}

	
}

public function getTeacher()
{
	$this->db->trans_start();
    $this->db->join('tbl_class','tbl_class.classId = tbl_teacher.teacherClass');
    $this->db->where('teacherStatus',1);
	$res = $this->db->get('tbl_teacher')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
	    if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}

}

public function tab_add_fees_data()
{
	
    $this->db->trans_start();
	$res = $this->db->get('tab_add_fees_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if(!empty($res)){
    			return $res;
    		}else {
    			return $res;
    		}
    }

}



public function temp_enquiry($dataarray)
{
	$this->db->trans_start();
	$this->db->where('studentEmail',$dataarray['studentEmail']);
	$this->db->or_where('studentMobile',$dataarray['studentMobile']);
	$result = $this->db->get('tbl_temp_enquiry')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
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
}




public function get_temp_enquiry()
{
    $this->db->trans_start();
	$this->db->join('tbl_class','tbl_class.classId = tbl_temp_enquiry.studentClass');
	$result = $this->db->get('tbl_temp_enquiry')->result_array();
	$alldata = array();
	
	foreach($result as $value){
	 $alldata[] = $this->get_non_present_data_in_payment($value['studentMobile']); 
	}
	
	$result = $alldata;
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
	    return $result;
	}
}


function get_non_present_data_in_payment($studentMobile){
    
    $this->db->where('usr_mobile_no',$studentMobile);
    $this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId','left');
    $this->db->join('tbl_temp_enquiry','tbl_temp_enquiry.studentClass = studentreg.studentClass','left');
    $this->db->join('tbl_class','tbl_class.classId = tbl_temp_enquiry.studentClass','left');
    $this->db->group_by('log_payment_data.usr_mobile_no');
    $this->db->order_by('logId','desc');
    
    $res = $this->db->get('log_payment_data')->result_array();
	if(!empty($res)){
			return $res;
	}else{
	    
	    $this->db->where('studentMobile',$studentMobile);
        $this->db->join('tbl_class','tbl_class.classId = tbl_temp_enquiry.studentClass','left');
        $res = $this->db->get('tbl_temp_enquiry')->result_array();
       
        return $res;
	    
	}
    
}


public function get_temp_enquiry_filter($studentName,$studentMobile,$studentEmail)
{
	$this->db->trans_start();
	if($studentName!=""){
	    $this->db->like('studentName',$studentName);
	}
	if($studentMobile!=""){
	    $this->db->where('studentMobile',$studentMobile);
	}
	if($studentEmail!=""){
	    $this->db->where('studentEmail',$studentEmail);
	}
	$this->db->join('tbl_class','tbl_class.classId = tbl_temp_enquiry.studentClass','right');
	$result = $this->db->get('tbl_temp_enquiry')->result_array();
	
	$alldata = array();
	
	foreach($result as $value){
	 $alldata[] = $this->get_non_present_data_in_payment($value['studentMobile']); 
	}
	
	$result = $alldata;
	
	
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if(empty($result)){
    		return $result;
    	}else{
    		return $result;
    	}
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
     $this->db->trans_start();
	 $this->db->join('tbl_tenure','tbl_tenure.tid = tbl_emi.fk_tid','left');	
	 $this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = tbl_emi.fk_feesId','left');	
	 $res = $this->db->get('tbl_emi')->result_array();
	 $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	 if(!empty($res)){
    	     return $res;
    	 }else{
    	     return $res;
    	 }
	 }
}


public function tbl_tenure()
{
    $this->db->trans_start();
	$res = $this->db->get('tbl_tenure')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if(!empty($res)){
    			return $res;
    		}else {
    			return $res;
    		}
    }

}


public function deleteemifeesId($emi_Id)
{
    $this->db->trans_start();
	$this->db->where('emi_Id',$emi_Id);
	$res = $this->db->delete('tbl_emi');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
	    if($res==1){
			return 1;
		}else {
			return 0;
		}
	}
}




public function getplanvalue_emi($loanemiId)
{
	$this->db->trans_start();
	$this->db->where('emi_Id',$loanemiId);
	$res = $this->db->get('tbl_emi')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}

}

public function check_student_exist($studId)
{
    $this->db->trans_start();
	$this->db->where('studId',$studId);	
    $result = $this->db->get('studentreg')->result_array();
    $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
   	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		  if($result){
		  	return $result;
		  }else{
		  	return $result;
		  }
	  }
  
}


public function student_daily_reports($fk_studId,$Current_datetime,$End_datetime)
{
    $this->db->trans_start();
	$this->db->select_max('trackEndTime');
	$this->db->select_max('trackStartTime');
	$this->db->select_max('trackDuration');
	$this->db->select('sessionName,createDT,content_title,trackId,sessionImages');
	$this->db->where('fk_user_id',$fk_studId);
	$this->db->where('createTrackDT >=',$Current_datetime);
	$this->db->where('createTrackDT <=',$End_datetime);
	$this->db->group_by('tbl_session_type.sessionName');
	$this->db->join('tbl_videouploadingdata','tbl_videouploadingdata.vidId = tbl_tracking_watch_video.fk_sessionId','left');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId','left');
	$res = $this->db->get('tbl_tracking_watch_video')->result_array();
    $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if(!empty($res)){
    		return $res;
    	}else{
    		return $res;
    	}
    }
}


public function student_daily_reports_mob($fk_studId,$Current_datetime,$End_datetime){
    
    $this->db->trans_start();
    $this->db->select_max('trackEndTime');
	$this->db->select_max('trackStartTime');
	$this->db->select_max('trackDuration');
	$this->db->select('sessionName,createDT,sessionImages');
	$this->db->where('fk_user_id',$fk_studId);
	$this->db->where('createTrackDT >=',$Current_datetime);
	$this->db->where('createTrackDT <=',$End_datetime);
	$this->db->group_by('tbl_session_type.sessionName');
    $this->db->join('tbl_videouploadingdata','tbl_videouploadingdata.vidId = tbl_tracking_watch_video.fk_sessionId','left');
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId','left');
	$res = $this->db->get('tbl_tracking_watch_video')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
      // 	echo $this->db->last_query();

    	if(!empty($res)){
    		return $res;
    	}else{
    		return $res;
    	}
	}
	
}





public function student_daily_reports_filter_mob($fk_studId,$Current_datetime,$lastWeek,$weekdata){


	$this->db->trans_start();
	$this->db->select_max('trackEndTime');
	$this->db->select_max('trackStartTime');
	$this->db->select_max('trackDuration');
	$this->db->select('sessionName,sessionImages');
	$this->db->where('fk_user_id',$fk_studId);
	
	if($weekdata=="week" || $weekdata=="month" ){
	
		$this->db->where('createTrackDT <=',$Current_datetime);
		$this->db->where('createTrackDT >=',$lastWeek);
		
	}else{
	    
	
		$this->db->where('createTrackDT >=',$Current_datetime);
		$this->db->where('createTrackDT <=',$lastWeek);
	}
	$this->db->group_by('tbl_session_type.sessionName');

    //$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_tracking_watch_video.fk_sessionId','left');
    
    $this->db->join('tbl_videouploadingdata','tbl_videouploadingdata.vidId = tbl_tracking_watch_video.fk_sessionId','left');
	
	$this->db->join('tbl_session_type','tbl_session_type.sessionId = tbl_videouploadingdata.fk_sessionId','left');
	
	$res = $this->db->get('tbl_tracking_watch_video')->result_array();

    $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if(!empty($res)){
    		return $res;
    	}else{
    		return $res;
    	}
    }

}

public function student_daily_reports_filter($fk_studId,$Current_datetime,$lastWeek){

	$this->db->trans_start();
	
	$this->db->select_max('trackEndTime');
	$this->db->select_max('trackStartTime');
	$this->db->select_max('trackDuration');
	$this->db->select('sessionName,createDT,content_title,trackId,sessionImages');
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
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

    	if(!empty($res)){
    		return $res;
    	}else{
    		return $res;
    	}
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
	     $this->db->trans_rollback();
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
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	     $this->db->trans_rollback();
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

	$this->db->where('fk_studId',$studId);
	$this->db->where('paystatus',"success");
    $this->db->where('paystatusId',1);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    if(!empty($open_monthdata)){
    	$fk_upload_key = 3;
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
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	     $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}
}


public function get_day_sessions_vid_recap($dayId,$monthId,$fk_classId,$studId)
{
	$this->db->trans_start();

	$this->db->where('fk_studId',$studId);
	$this->db->where('paystatus',"success");
    $this->db->where('paystatusId',1);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    if(!empty($open_monthdata)){
    	$fk_upload_key = 3;
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
// 	$this->db->where('tbl_videouploadingdata.vidId',$vidId);
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

public function get_day_sessions_vid_by_default_recap($dayId,$monthId,$fk_classId,$studId)
{
	$this->db->trans_start();

	$this->db->where('fk_studId',$studId);
	$this->db->where('paystatus',"success");
    $this->db->where('paystatusId',1);
    $open_monthdata = $this->db->get('log_payment_data')->result_array();
    
    if(!empty($open_monthdata)){
    	$fk_upload_key = 3;
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
	    $this->db->trans_rollback();
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
	    $this->db->trans_rollback();
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		if(!empty($res)){
			

			$this->session->set_userdata('forgetmobile',$studentMobile);
			$otpnumber = rand(1111,9999);
			$updatearry = array('OTP'=>$otpnumber);
			$this->db->or_where('studentMobile',$studentMobile);
			$this->db->or_where('studentAltMobile',$studentMobile);
			$result = $this->db->update('studentreg',$updatearry);
			$message = trim("Otp number for forget password");
			$res = sendsmsweb($studentMobile,$otpnumber,$message);
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
	$this->db->or_where('studentAltMobile',$studentMobile);
	$this->db->where('studentStatus',1);
	$res = $this->db->get('studentreg')->result();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{

		if(!empty($res)){			
			$updatearry =  array('studentPass'=>sha1($newpass),'studentStatus'=>1);
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



public function user_state()
{
	$this->db->trans_start();
	
	$this->db->order_by('stateName','asc');
    $res = $this->db->get('tbl_states')->result_array();

    $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
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
	
	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
		$data = array('unlock_monthId'=>$mId);
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


public function unlocksession_data($studId)
{
	
	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
		return $res;
	}else{
		return $res;
	}


}


public function onboarding($fk_monthId,$studId,$usr_firstname,$usr_lastname,$usr_email,$usr_mobile_no,$paymentType,$Receiptpic,$planId,$payAmount,$discount,$remarkReceipt,$reciept_no,$fk_adjustedAmount,$fk_adjustedRemark,$roundOff,$check_number,$bank_name,$check_dated,$branch_name,$paymentMode,$tran_online_date,$transaction_no,$parents_name)
{
	
	
	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){	
		$this->db->where('fk_studId',$studId);
		$this->db->where('usr_email',$usr_email);
		$this->db->where('usr_mobile_no',$usr_mobile_no);
		$log_payment_data = $this->db->get('log_payment_data')->result_array();
		
		$this->db->where('feesId',$planId);
		$planIddata = $this->db->get('tab_add_fees_data')->result_array();


		
		if($payAmount==""){
			$payAmount = $planIddata[0]['final_fees'];
		}else{
			$payAmount = $payAmount;
		}
	    
		$reciept_noincrement = $reciept_no + 1;
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
							'fk_adjustedAmount'		=> $fk_adjustedAmount,
							'fk_adjustedRemark'		=> $fk_adjustedRemark,
							'discount'              => $discount,
							'remarkReceipt'			=> $remarkReceipt,
							'paystatusId'			=> 2,
							'paystatus'				=> "Partial",
							'reciept_no'            => $reciept_noincrement,
							'paymentSatusByadmin'	=> 2,
							'roundOff'	            => $roundOff,
							'check_number'          =>$check_number,
							'bank_name'             =>$bank_name,
							'check_dated'           =>$check_dated,
							'branch_name'           =>$branch_name,
							'paymentMode'           =>$paymentMode,
							'tran_online_date'      =>$tran_online_date,
							'transaction_no'        =>$transaction_no,
							'parents_name'          =>$parents_name
							
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


public function onboardinglistStatus($studId,$paymentSatusByadmin,$paystatus)
{
	if($paystatus =='partial')
	{
		$data = array('paymentSatusByadmin'=>$paymentSatusByadmin,'paystatusId'=>3,'paystatus'=>"Partial");
		$this->db->where('fk_studId',$studId);
	    $res = $this->db->update('log_payment_data',$data);
	}
	else
	{
		$data = array('paymentSatusByadmin'=>$paymentSatusByadmin,'paystatusId'=>$paymentSatusByadmin,'paystatus'=>"success");
		$this->db->where('fk_studId',$studId);
		$res = $this->db->update('log_payment_data',$data);
	}	
	if($res==1){
		return 1;
	}else{
		return 0;
	}		
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



public function temp_enquiry_api($output,$leadfrom)
{
		
	$currentDate = date('Y-m-d');			
    $data  = array('jsonapi'=>json_encode($output),'createDT'=>$currentDate,'leadfrom'=>$leadfrom);
	$res = $this->db->insert('temp_enquiry_api',$data);		
	if($res==1){
      	return "1";
    }else{
      	return "0";
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
	    $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
      return $res;
   }
	
}
	



public function activatestud($studId)
{
	$this->db->trans_start();
    $data = array('studentStatus'=>1);	
	$this->db->where('studId',$studId);
	$res = $this->db->update('studentreg',$data);	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if($res==1){
    		return 1;
    	}else{
    		return 0;
    	}
	}

}


public function updatemobpass($newpass,$studId){
    
    $this->db->trans_start();
    $data = array('studentPass'=>$newpass);	
	$this->db->where('studId',$studId);
	$res = $this->db->update('studentreg',$data);	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if($res==1){
    		return 1;
    	}else{
    		return 0;
    	}
    }
	
}


public function emi_form_by_parents()
{
	  $this->db->trans_start();
	  $result = $this->db->get('emiapplicationform')->result_array();
	  $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
	  {
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	  } else {
    	  if(!empty($result)){
        		return $result;
          }else{
        		return $result;
          }
      }
}



public function setpin($studId,$pinNumber)
{
	
    $this->db->trans_start();
    $data = array('pinNumber'=>$pinNumber);	
	$this->db->where('studId',$studId);
	$this->db->where('studentStatus',1);
	$this->db->trans_complete();
	$res = $this->db->update('studentreg',$data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
		    
		} else {
		    
		if($res==1){
			return 1;
		}else{
			return 0;
		}
	}

}



public function getBatch()
{
	   $this->db->trans_start();	
	   $res = $this->db->get('tbl_batch')->result_array();
	   $this->db->trans_complete();
	    if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {
			
		   if(!empty($res)){
		   	return $res;
		   }else{
		   	return $res;
		   }
	   }
}


public function denied_from_login($studentMobile,$ip)
{
	$this->db->trans_start();
	$this->db->where('ip',$ip);
	$this->db->where('studentMobile',$studentMobile);
	$res = $this->db->get('ipaddressclinet')->result_array();
	$this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

	} else {
	    
    	$ipcount = count($res);
    
    	if($ipcount > 1) {
    		return 2;
    	}else{
    		
    		$data = array('studentMobile'=>$studentMobile,'ip'=>$ip);
    		$result = $this->db->insert('ipaddressclinet',$data);
    		if($result==1){
    			return 1;
    		}else{
    			return 2;
    		}
    	}
	}

}


public function get_two_ip_adrdess($studentMobile,$ip)
{
	$this->db->trans_start();
	$this->db->where('studentMobile',$studentMobile);
	$this->db->group_by('ip');
	$res = $this->db->get('ipaddressclinet')->result_array();	
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

	} else {

		 if(!empty($res)){
		 	return $res;
		 }else{
		 	return $res;
		 }
	}
}


public function onboardedstudent($fk_studId)
{
	
	$this->db->trans_start();
    $this->db->where('fk_studId',$fk_studId);
    $this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
    $this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass');
	$res = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}


}


public function check_payment_done($fk_studId)
{
	$this->db->trans_start();
    $this->db->where('fk_studId',$fk_studId);
	$res = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}

}


public function get_day_sessions_recap_demo($dayId,$monthId,$fk_classId,$studId,$recap)
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
	$this->db->where('tbl_videouploadingdata.fk_upload_key',1);
	}else if(!empty($recap)){
    $this->db->where('tbl_videouploadingdata.fk_upload_key',$recap);
	}
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}
}




public function get_day_sessions_recap_live($dayId,$monthId,$fk_classId,$studId,$recap)
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
	$this->db->where('tbl_videouploadingdata.fk_coursePeriod',0);
	$this->db->where('tbl_videouploadingdata.status',1);
	if(!empty($studId)){
		$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
	}else if(!empty($recap)){
	    $this->db->where('tbl_videouploadingdata.fk_upload_key',$recap);
	}
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}
}


public function tab_add_fees_data_junior()
{
	$this->db->trans_start();

	$this->db->where('fk_classId',2);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}

}


public function tab_add_fees_data_nursery()
{
	$this->db->trans_start();
	$this->db->where('fk_classId',1);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{
		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}

}



public function tab_add_fees_data_senior()
{

	$this->db->trans_start();
	$this->db->where('fk_classId',3);
	$res = $this->db->get('tab_add_fees_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
     }
}


public function checkpromocode($promoCode)
{

	$this->db->trans_start();
	$this->db->where('status',1);
	$this->db->where('promoCode',$promoCode);
	$res = $this->db->get('tbl_promocode')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

		if(!empty($res)){
			return 1;
		}else{
			return 0;
		}
	}
}


public function checkstudentMobile($studentMobile)
{
	$this->db->trans_start();
	$this->db->where('studentMobile',$studentMobile);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{
		if(!empty($res)){
			return 1;
		}else{
			return 0;
		}
  	} 
}


public function checkstudentEmail($studentEmail)
{
	$this->db->trans_start();
	$this->db->where('studentEmail',$studentEmail);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{
		if(!empty($res)){
			return 1;
		}else{
			return 0;
		}
	}
}


public function promocodelist()
{
    $this->db->trans_start();
	$res = $this->db->get('tbl_promocode')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{
	    
    	if(!empty($res)){
    		return $res;
    	} else {
    		return $res;
    	}
	}
}


public function addpromocode($qrcode_data)
{
   
	$this->db->trans_start();
	$res = $this->db->insert('tbl_promocode',$qrcode_data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	} else {
	    
		if(!empty($res))
		{
			return 1;
		}else{
			return 0;
		}
	}
}


public function promocodeExist($promoCode)
{
	$this->db->trans_start();
	$this->db->where('promoCode',$promoCode);
	$res = $this->db->get('tbl_promocode')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	} else {
		if(!empty($res)){
			return 1;
		} else {
			return 0;
		}
	}
}

public function deletepromoId($pmId)
{
	$this->db->trans_start();
	$this->db->where('pmId',$pmId);
	$res = $this->db->delete('tbl_promocode');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	} else {
		if(!empty($res))
		{
			return 1;
		}else{
			return 0;
		}
	}
	
}

//karan's payment model 
public function paiduntil($studId)
{
    $this->db->trans_start();
	$this->db->select("*,log_payment_data.createDT as logpaymentDT");
	$this->db->where('fk_studId', $studId);
	$this->db->join('tbl_month', 'tbl_month.mId  =  log_payment_data.fk_monthId');
	$result = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if($result){
    		return $result;
    	}else{
    		return $result;
    	}
	}
}


public function checkremaining_amount($studId,$planId)
{
	
     $this->db->trans_start();
	 $this->db->where('fk_studId', $studId);
	 $result = $this->db->get('log_payment_data')->result_array();
	 $this->db->trans_complete();
	 if ($this->db->trans_status() === FALSE)
	 {
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	 } else {
    	 $package_amount = 0;
    	 if(!empty($result)){
    		$this->db->where('feesId', $result[0]['planId']);
    			$results = $this->db->get('tab_add_fees_data')->result_array();
    			if(!empty($results)){
    				return $package_amount =  round($results[0]['final_fees']);
    			} else {
    				return $package_amount = array()  ;
    	        }
    	   }
	 }
}

public function get_student_id($studId)
{
    $this->db->trans_start();
	$this->db->where('studId',$studId);	
	$this->db->where('studentStatus',1);	
	$result = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	  if(!empty($result)){
	     return $result;
    	 }else{
	     return $result;
	  }
	}
}

public function selected_by_packages($studId)
{
    $this->db->trans_start();
	$this->db->where('fk_studId',$studId);
	$this->db->order_by("fk_studId", "asc");
	$this->db->limit(1);
	$this->db->join(' tab_add_fees_data', '  tab_add_fees_data.feesId   = log_payment_data.planId');
	$result = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		if(!empty($result)){
			return $result;
		} else {
			return $result;
	    }
	}
}

public function list_Fees_packagewise($fk_classId)
{
    $this->db->trans_start();
    $this->db->where('fk_classId',$fk_classId);
	$result = $this->db->get('tab_add_fees_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if($result){
    		return $result;
    	}else{
    		return $result;
    	}
	}
}

public function get_reciept_idwise()
{
    $this->db->trans_start();
	$this->db->order_by("logId", "desc");
	$this->db->limit(1);
	$result = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if(!empty($result)){
    		return $result;
    	}else {
    		return $result;
        }
  }
	
}

//end

public function disableAccount($currentDate)
{
    
	$this->db->trans_start();
	$this->db->where('promoCodeExp',1);
	$this->db->where('freemonthDT',$currentDate);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if($res){
    		foreach($res as $value){
    			$get_more_than_one_payment_reciept = $this->get_more_than_one_payment_reciept($value['studId']);
    			if($get_more_than_one_payment_reciept==1){
    				$updatearry = array('studentStatus'=>2);
    				$this->db->where('studId',$value['studId']);
    				$resupdate = $this->db->update('studentreg',$updatearry);
    				if($resupdate==1){
    					return 1;
    				} else {
    					return 0;
    				}
    			}
    		}
    	}
	}

}


public function get_more_than_one_payment_reciept($studId)
{

    $this->db->trans_start();
    $this->db->where('fk_studId',$studId);
    $result = $this->db->get('log_payment_data')->result_array();		
    if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    $countResult = count($result);
	    if($countResult < 2){
	    	return 1;
	    }else{
	    	return 0;
	    }
    }
}

public function apiresult()
{
	$this->db->trans_start();
	$this->db->order_by('tempapId','desc');
	$result = $this->db->get('temp_enquiry_api')->result_array();	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
        if($result){
        	return $result;
        }else{
        	return $result;
        }
    }

}


public function unlock_account_which_is_blocked()
{
    
   $this->db->trans_start();	
   $this->db->where('Hackstatus',3);
   $result = $this->db->get('tbl_check_here_multiple_browser_not_open')->result_array();
   $this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if(!empty($result)){
    	    $this->db->where('Hackstatus',3);
    	    $this->db->or_where('Hackstatus',0);
    		$res = $this->db->delete('tbl_check_here_multiple_browser_not_open');
    		if($res==1){
    			return 1;
    		} else {
    			return 0;
    		}
    	} else {
    		return 2;
    	}
    }
}



public function check_here_multiple_browser_not_open($studentMobile)
{
	
	$session = $this->session->session_id;
	$browser = "";
	if($this->agent->is_browser())
	{
    	$browser = $this->agent->browser().' '.$this->agent->version();
	} else {
		$browser = $browser;
	}
	$this->db->trans_start();
	$this->db->where('studentMobile',$studentMobile);
	$nodatafound = $this->db->get('studentreg')->result_array();
	if(empty($nodatafound)){
		return 4;
	}else{
	    
            $currentDate    = date("Y-m-d");
        	$this->db->where('studentMobile',$studentMobile);
        	$this->db->where('status',1);
        	$this->db->where('createDT',$currentDate);
        	$result = $this->db->get('tbl_check_here_multiple_browser_not_open')->result_array();
        	$this->db->trans_complete();
        	if ($this->db->trans_status() === FALSE)
        	{
        	   $this->db->trans_rollback();
        	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
        
        	}else{
        			if(empty($result)){
        
        				$data = array('studentMobile'=>$studentMobile,'browser'=>htmlentities($browser),'browsersessionId'=>$session,'status'=>1,'createDT'=>$currentDate);
        				$res = $this->db->insert('tbl_check_here_multiple_browser_not_open',$data);
        				if($res==1){
        					return 1;
        				} else {
        					return 0;
        				}
        			} else {
            
            
                            $currentDate    = date("Y-m-d");	
						    $this->db->where('studentMobile',$studentMobile);
							$this->db->where('status',1);
							$this->db->where('browsersessionId',$session);
							$this->db->where('createDT',$currentDate);
							$resultData = $this->db->get('tbl_check_here_multiple_browser_not_open')->result_array();
							if(!empty($resultData)){
								return 5;
							}else{
							    
                				$data = array('studentMobile'=>$studentMobile,'browser'=>htmlentities($browser),'browsersessionId'=>$session,'Hackstatus'=>3,'createDT'=>$currentDate);
                				$res = $this->db->insert('tbl_check_here_multiple_browser_not_open',$data);
                				$currentDate    = date("Y-m-d");
                				$this->db->where('studentMobile',$studentMobile);
                				$this->db->where('status',0);
                				$this->db->where('Hackstatus',3);
                				$this->db->where('createDT',$currentDate);
                				$hackresult = $this->db->get('tbl_check_here_multiple_browser_not_open')->result_array();
                				$hackresultcount = count($hackresult);
                				if($hackresultcount > 3){
                				 return 3;
                				}else{
                				 return 0;
                			}
                     }
       			}
        	}
	  }
}



public function get_calender()
{
    $this->db->trans_start();
    $result = $this->db->get('tbl_calender_open_day')->result_array();
    $this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();	
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{

	     if($result){
	     	return $result;
	     }else{
	     	return $result;
	     }
     }
     
}

public function get_coursewise_calender()
{
    $this->db->trans_start();
    $result = $this->db->get('tbl_calender_open_coursewise_day')->result_array();
    $this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();	
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{

	     if($result){
	     	return $result;
	     }else{
	     	return $result;
	     }
     }
}


public function change_pin($current_pin,$studId)
{

    $this->db->trans_start();
	$this->db->where('studId',$studId);
	$this->db->where('pinNumber',$current_pin);
	$result = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	} else {
		if($result){	
		    $pinNumber = $result[0]['pinNumber'];
		}else{
			$pinNumber = "";
		}
		 if(empty($pinNumber)){
				$updatearry  = array('pinNumber'=>$current_pin,'adminRole'=>1);
				$this->db->where('studId',$studId);
				$res = $this->db->update('studentreg',$updatearry);
				if($res==1){
						return 1;
					}else {
						return 0;
					}
		     }else{

		     	$pinNumber = $result[0]['pinNumber'];
		     	$adminRole = $result[0]['adminRole'];
		     	if(!empty($pinNumber) && $adminRole==0){
		     		$adminRole = 1;
		     	}else{
		     		$adminRole = 0;
		     	}
		     	$updatearry  = array('adminRole'=>$adminRole);

		     	$this->db->where('studId',$studId);
				$res = $this->db->update('studentreg',$updatearry);
			 	if($res==1){
					return 2;
				 }else {
			    	return 0;
				}
		 }
	
    }
}


public function statusChangedPromo($pmId,$status)
{
	$this->db->trans_start();
	$updatearry = array('status'=>$status);
	$this->db->where('pmId',$pmId);
	$res = $this->db->update('tbl_promocode',$updatearry);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if($res==1){
			return 1;
		}else{
			return 0;
		}
	}
}


public function promocode_list_student()
{
	
	$this->db->trans_start();

	$this->db->select("*,studentreg.createDT as date");
	$this->db->where('studentStatus',1);
	$this->db->where('promoCode!=',0);
	$this->db->group_by('studId');
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	$this->db->join('tbl_states','tbl_states.stateId = studentreg.usr_state','left');
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	  return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
      return $res;
   }

}



function updatePromocode($studId,$promoCode){
    
    
    $updatearry = array('promoCode'=>$promoCode);
	$this->db->where('studId',$studId);
	$res = $this->db->update('studentreg',$updatearry);
	if($res==1){
		return 1;
	}else{
		return 0;
	}
	
    
}


public function changePinUser($studId,$new_pin){
    
    
    $updatearry = array('pinNumber'=>$new_pin);
	$this->db->where('studId',$studId);
	$res = $this->db->update('studentreg',$updatearry);
	if($res==1){
		return 1;
	}else{
		return 0;
	}
	
    
}

public function changePasswordUser($studId,$studentPass){
    
    
    $updatearry = array('studentPass'=>sha1($studentPass));
	$this->db->where('studId',$studId);
	$res = $this->db->update('studentreg',$updatearry);
	if($res==1){
		return 1;
	}else{
		return 0;
	}
	
    
}



public function check_password_ex($current_password,$studId)
{
	
	$this->db->where('studId',$studId);
	$this->db->where('studentPass',sha1($current_password));
	$res = $this->db->get('studentreg')->result_array();
	if($res){
		return 1;
	}else{
		return 0;
	}

}

public function check_old_pin($old_pin,$studId)
{
	
	$this->db->where('studId',$studId);
	$this->db->where('pinNumber',$old_pin);
	$res = $this->db->get('studentreg')->result_array();
	if($res){
		return 1;
	}else{
		return 0;
	}

}



public function check_here_multiple_browser_not_open_trunk_db(){
    
    $res = $this->db->truncate('tbl_check_here_multiple_browser_not_open');
    if($res==1){
        return 1;
    }else{
        return 0;
    }
    
}




public function get_daily_live_session_presenty($studentEmail)
{
	

	$this->db->where('user_email',$studentEmail);
	$this->db->where('created_date',date("Y-m-d"));
    $this->db->select('join_time,leave_time,topicName,duration');
	$res = $this->db->get('zoom_occurance_reports')->result_array();
	if($res){
		return $res;
	}else{
		return $res;
	}


}



public function add_web_seo_list_data($arraydata)
{

	$res = $this->db->insert('tbl_add_web_seo_list',$arraydata);
    if($res==1){
        return 1;
    }else{
        return 0;
    }

	
}


public function add_web_seo_list()
{
	

	$res = $this->db->get('tbl_add_web_seo_list')->result_array();
	if($res){
        return $res;
    }else{
        return $res;
    }


}




public function deleteMetaweb($webId)
{
	
	$this->db->where('webId',$webId);
	$res = $this->db->delete('tbl_add_web_seo_list');
	if($res==1){
        return 1;
    }else{
        return 0;
    }
 
}


public function metainfo($segmentId)
{
	
	if($segmentId=="nursery-preschoolapp"){
		$this->db->where('metaPageName',4);
	}else if($segmentId=="educational-app-kids-4-5-year-olds"){
		$this->db->where('metaPageName',5);
	}else if($segmentId=="online-learning-app-kids-5-6-year-olds"){
		$this->db->where('metaPageName',6);
	}else if($segmentId=="admissions"){
		$this->db->where('metaPageName',16);
	}else if($segmentId=="about-us"){
		$this->db->where('metaPageName',2);
	}else if($segmentId=="blog"){
		$this->db->where('metaPageName',7);
	}else if($segmentId=="how-technology-is-effecting-education"){
		$this->db->where('metaPageName',8);
	}else if($segmentId=="healthy-fruits-for-child"){
		$this->db->where('metaPageName',9);
	}else if($segmentId=="preschool-importance-2021"){
		$this->db->where('metaPageName',10);
	}else if($segmentId=="gallery"){
		$this->db->where('metaPageName',3);
	}else if($segmentId=="privacy"){
		$this->db->where('metaPageName',12);
	}else if($segmentId==""){
		$this->db->where('metaPageName',1);
	}else {
		$this->db->where('metaPageName',0);
	}	

	$res = $this->db->get('tbl_add_web_seo_list')->result_array();
	
	if($res){
		return $res;
	}else{
		return $res;
	}

}


public function add_tbl_pdfcourse($arraydata)
{

	$res = $this->db->insert('tbl_pdfcourse',$arraydata);
    if($res==1){
        return 1;
    }else{
        return 0;
    }

	
}


public function add_tbl_pdfcourse_list()
{
	
    $this->db->join('tbl_class','tbl_class.classId = tbl_pdfcourse.fk_classId','left');
	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = tbl_pdfcourse.fk_planid','left');
	$res = $this->db->get('tbl_pdfcourse')->result_array();
	if($res){
        return $res;
    }else{
        return $res;
    }

}


public function deletepdfcourse($pdfId)
{

	$this->db->where('pdfId',$pdfId);
	$res = $this->db->delete('tbl_pdfcourse');
	if($res==1){
        return 1;
    }else{
        return 0;
    }
 
}


public function get_tbl_pdfcourse_list($fk_classId,$fk_planid)
{
	
	$this->db->where('fk_classId',$fk_classId);
	$this->db->where('fk_planid',$fk_planid);
	$res = $this->db->get('tbl_pdfcourse')->result_array();
	if($res){
        return $res;
    }else{
        return $res;
    }

}


public function ipaddressclinetclear(){
    
    $res = $this->db->truncate('ipaddressclinet');
    if($res==1){
        return 1;
    }else{
        return 0;
    }
    
}

public function update_gallery_list()
{
	
	$res = $this->db->get('tbl_update_gallery_list')->result_array();
	if($res){
        return $res;
    }else{
        return $res;
    }

}


public function update_gallery($data)
{

    $res = $this->db->insert('tbl_update_gallery_list',$data);
	if($res==1){
        return 1;
    }else{
        return 0;
    }

}


public function deleteGalleryImage($gId)
{
	$this->db->where('gId',$gId);	
	$res = $this->db->delete('tbl_update_gallery_list');
	if($res==1){
        return 1;
    }else{
        return 0;
    }

}


public function edit_gallery_image($arraydata,$gId)
{
	
	$this->db->where('gId',$gId);
	$res = $this->db->update('tbl_update_gallery_list',$arraydata);
	if($res==1){
		return 1;
	}else{
		return 0;
	}


}


public function update_gallery_list_edit($gId)
{
	$this->db->where('gId',$gId);
	$res = $this->db->get('tbl_update_gallery_list')->result_array();
	if($res){
        return $res;
    }else{
        return $res;
    }
    
	
}

public function check_day_calender_wise($dayId,$currentDate,$monthId,$studId)
{
    
    
    $this->db->where('studId',$studId);
    $resultdata = $this->db->get('studentreg')->result_array();
    $fk_coursePeriod = "";
    if($resultdata){
        $fk_coursePeriod = $resultdata[0]['fk_coursePeriod'];
    }
    
    if($fk_coursePeriod==7 || $fk_coursePeriod==3){
        
        $this->db->where('Days =',$dayId);
        $this->db->where('Months',$monthId);
    	$this->db->where('calDate <=',$currentDate); 
    	$this->db->limit(1);
        $result = $this->db->get('tbl_calender_open_coursewise_day')->result_array();
     
        if($result){
            
            if($result[0]['Days']<=$dayId){
            	$this->db->where('Days <=',$dayId);
            	$this->db->where('Months',$monthId);
            	$this->db->where('calDate <=',$currentDate);
            	$this->db->order_by('calDate','desc');
            	$this->db->limit(1);
            	$res = $this->db->get('tbl_calender_open_coursewise_day')->result_array();
            
            	if($res){
                    return $res;
                }else{
                    return $res;
                }
            }
    
        
        }else{
          return $result = array();
        }
        
    }else{
    
        
        $this->db->where('Days =',$dayId);
        $this->db->where('Months',$monthId);
    	$this->db->where('calDate <=',$currentDate); 
    	$this->db->limit(1);
        $result = $this->db->get('tbl_calender_open_day')->result_array();
     
        if($result){
            
            if($result[0]['Days']<=$dayId){
            	$this->db->where('Days <=',$dayId);
            	$this->db->where('Months',$monthId);
            	$this->db->where('calDate <=',$currentDate);
            	$this->db->order_by('calDate','desc');
            	$this->db->limit(1);
            	$res = $this->db->get('tbl_calender_open_day')->result_array();
            
            	if($res){
                    return $res;
                }else{
                    return $res;
                }
            }
    
        
        }else{
          return $result = array();
        }
    }

}


public function tbl_calender_open_coursewise_day($dayId,$currentDate,$monthId)
{
    $this->db->where('Days =',$dayId);
    $this->db->where('Months',$monthId);
	$this->db->where('calDate <=',$currentDate); 
	$this->db->limit(1);
    $result = $this->db->get('tbl_calender_open_coursewise_day')->result_array();
//   echo $this->db->last_query();
    if($result){
        
        if($result[0]['Days']<=$dayId){
        	$this->db->where('Days <=',$dayId);
        	$this->db->where('Months',$monthId);
        	$this->db->where('calDate <=',$currentDate);
        	$this->db->order_by('calDate','desc');
        	$this->db->limit(1);
        	$res = $this->db->get('tbl_calender_open_coursewise_day')->result_array();
        
        	if($res){
                return $res;
            }else{
                return $res;
            }
        }

    
    }else{
      return $result = array();
    }

}



public function check_month_exist_or_not($fk_monthId)
{
	$this->db->where('unlock_monthId',$fk_monthId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res))
	{
        return 1;
    }else{
        return 0;
    }

}

public function get_updated_month_data($studId)
{
	$this->db->where('studId',$studId);
	$res = $this->db->get('studentreg')->result_array();
	if(!empty($res))
	{
        return $res;
    }else{
        return $res;
    }

}



public function parents_review_update_list()
{
	$this->db->join('tbl_class','tbl_class.classId = tbl_parents_review_update_list.fk_classId','left');
	$res = $this->db->get('tbl_parents_review_update_list')->result_array();
	if($res){
        return $res;
    }else{
        return $res;
    }

}


public function parents_review_update($arraydata)
{
    $res = $this->db->insert('tbl_parents_review_update_list',$arraydata);
	if($res==1){
        return 1;
    }else{
        return 0;
    }

}


public function deleteParentsreview($reviwId)
{
    $this->db->where('reviwId',$reviwId);	
	$res = $this->db->delete('tbl_parents_review_update_list');
	if($res==1){
        return 1;
    }else{
        return 0;
    }

}



public function update_web_seo_list($webId)
{

		$this->db->where('webId',$webId);
		$res = $this->db->get('tbl_add_web_seo_list')->result_array();
		if(!empty($res))
		{
	        return $res;
	    }else{
	        return $res;
	    }
	
}

function update_seo_list_data($arraydata,$webId){

    $this->db->where('webId',$webId);
	$res = $this->db->update('tbl_add_web_seo_list',$arraydata);
		if($res==1)
		{
	        return 1;
	    }else{
	        return 0;
	    }
}





public function check_payement_status($studId)
{

	$this->db->where('fk_studId',$studId);
	$this->db->where('paystatusId',2);
	$res = $this->db->get('log_payment_data')->result_array();
	if(!empty($res))
	{
	    return 1;
	}else{
	    return 0;
	}

	
}


public function getstudlist_filter_studlist_not_covert_to_admission()
{
    $this->db->select("*, studentreg.createDT as studregDate ");
     $this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
     $result = $this->db->get('studentreg')->result_array();
      $get_not_payment_parent_data = array();
	    if($result){
	    	foreach($result as $value){
	    		$result_array_data = $this->get_paid_student($value['studId']);
	    		if($result_array_data==0){
	             $get_not_payment_parent_data[] = $value;
	    		}
	    	}
	    }

    if(!empty($get_not_payment_parent_data))
	{
	    return $get_not_payment_parent_data;
	}else{
	    return $get_not_payment_parent_data;
	}

}


public function filter_studlist_not_covert_to_admission($data)
{

       $get_not_payment_parent_data = array();

		    $this->db->trans_start();
		    
		    
		    $this->db->select("*, studentreg.createDT as studregDate ");

			if($data['fromDT']!="" &&  $data['toDT']!="" ){
				$this->db->where('studentreg.createDT BETWEEN "'. date('Y-m-d h:i:s', strtotime($data['fromDT'])). '" and "'. date('Y-m-d h:i:s', strtotime($data['toDT'])).'"');
			}

			if($data['studentMobile']!="" && $data['studentEmail']!="" && $data['fromDT']!="" &&  $data['toDT']!="" ){
				
				$this->db->where('studentreg.createDT BETWEEN "'. date('Y-m-d h:i:s', strtotime($data['fromDT'])). '" and "'. date('Y-m-d h:i:s', strtotime($data['toDT'])).'"');
				$this->db->where('studentEmail ',$data['studentEmail']);
				$this->db->where('studentMobile',$data['studentMobile']);
			}

			if($data['studentMobile']!="" ||  $data['studentEmail']!="")
			{
				$this->db->or_where('studentEmail ',$data['studentEmail']);
				$this->db->or_where('studentMobile',$data['studentMobile']);
			}

			
			
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
			   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
			   
			}else{
				
			$this->db->where('studentStatus',1);
			$this->db->group_by('studId');
			$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
			$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
			$result = $this->db->get('studentreg')->result_array();
			
			
		      $get_not_payment_parent_data = array();
			    if($result){
			    	foreach($result as $value){
			    		$result_array_data = $this->get_paid_student($value['studId']);
			    		if($result_array_data==0){
			             $get_not_payment_parent_data[] = $value;
			    		}
			    	}
			    }

		    if(!empty($get_not_payment_parent_data))
			{
			    return $get_not_payment_parent_data;
			}else{
			    return $get_not_payment_parent_data;
			}

		

	    }

}


public function get_paid_student($studId)
{
	$this->db->where('fk_studId',$studId);
	$this->db->where('paystatusId',1);
	$res = $this->db->get('log_payment_data')->result_array();
	if(!empty($res)){
		return 1;
	}else{
		return 0;
	}

}

public function checkpromocode_admin($promoCode)
{
    $this->db->where('promoCode',$promoCode);
	$this->db->where('status',1);
	$res = $this->db->get('tbl_promocode')->result_array();
	if(!empty($res)){
			return 1;
	}else{
		return 0;
	}
}



function promocodeUpdate($promoCode,$studId,$fk_coursePeriod)
{
    $effectiveDate = date("Y-m-d");
     $checkherepromocode = $this->checkherepromocode($promoCode);
     if($checkherepromocode==1){
       $freemonthDT = date('Y-m-d', strtotime("+10 months", strtotime($effectiveDate)));  
     }else{
      $freemonthDT = date('Y-m-d', strtotime("+1 months", strtotime($effectiveDate)));
     }
    $this->db->where('studId',$studId);
    $updatearray = array('promoCode'=>$promoCode,'freemonthDT'=>$freemonthDT,'promoCodeExp'=>1,'fk_coursePeriod'=>$fk_coursePeriod);
    $result  =  $this->db->update('studentreg',$updatearray);
    if($result==1){
        return 1;
     }else{
       return 0;
   }
   
   
}



function checkherepromocode($promoCode){
 
    $this->db->where('promoCode',$promoCode);
	$this->db->where('status',1);
	$res = $this->db->get('tbl_promocode')->result_array();
	if(!empty($res)){
	    if($res[0]['promoCode'] == "15august" ){
     	     return 1;    
	    }else{
	        return 0;
	    }
		
	}else{
		return 0;
	}
	
}


public function count_paid_student()
{
	$this->db->where('log_payment_data.paystatusId',1);
	$this->db->where('log_payment_data.paymentSatusByadmin',1);
	return $this->db->from("log_payment_data")->count_all_results();

}


public function count_partial_paid_student()
{

	$this->db->where('log_payment_data.paystatusId',3);
	$this->db->where('log_payment_data.paymentSatusByadmin',1);
	return $this->db->from("log_payment_data")->count_all_results();

}


public function get_all_count_closeAmount()
{
    $this->db->select_sum('payAmount');
	$this->db->where('log_payment_data.paystatusId',4);
	$this->db->where('log_payment_data.paymentSatusByadmin',1);
	return $this->db->get("log_payment_data")->result_array();

}




public function count_paid_budget()
{
	$this->db->select_sum('payAmount');
	return $this->db->get("log_payment_data")->result_array();

}


public function get_all_count_discount()
{
	$this->db->select_sum('discount');
	return $this->db->get("log_payment_data")->result_array();

}

public function adjustedAmount()
{
	$this->db->select_sum('fk_adjustedAmount');
	return $this->db->get("log_payment_data")->result_array();

}


function autologout($logstatus,$studId){
    
    $data = array('logstatus'=>$logstatus);
	$this->db->where('studId',$studId);
	return $res = $this->db->update('studentreg',$data);
				
}


function autologoutStatus($studId){
    
	$this->db->where('studId',$studId);
	$this->db->where('logstatus',2);
	 $res = $this->db->get('studentreg')->result_array();
	if(!empty($res)){
	    return $res;
	}else{
	    return $res;
	}			
				
}



public function get_all_month_revenue()
{
    $this->db->trans_start();
	$this->db->select("*,sum(payAmount) as count");
	$this->db->group_by('createDT');
	$res = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if(!empty($res)){
    		return $res;
    	   } else {
    		return $res;
    	}
	}
}


public function checkcoursestudent($fk_studId){

	$this->db->trans_start();
	$this->db->where('studId',$fk_studId);
	$this->db->where('studentStatus',1);
	$this->db->where_in('fk_coursePeriod',['7','3','4']);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		if(!empty($res)){
	    	return 1;
		}else{
		    return 0;
		}
	}	
}

public function updateCourseDay()
{
	$this->db->trans_start();
	$date_of_take_admission_in_oct = '2021-09-01 00:00:00';
	$this->db->where('createDT >=',$date_of_take_admission_in_oct);
	$this->db->where('studentStatus',1);
	$this->db->where_in('fk_coursePeriod',['7','3']);
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
		if($res){
			foreach ($res as $key => $value) 
			{
			   $check_payment_done_course_student = $this->check_payment_done_course_student($value['studId']);
			   if($check_payment_done_course_student==1)
			   {
			 	 $updateMonthId = 1;
			 	 $updateDayId   = 1;
			 	 $result = $this->updateDayMonthId($updateMonthId,$updateDayId,$value['studId']);
			 	 if($result==1) {
			 		return 1;
			 	 } else {
			 		return 0;
			 	 }
			   }
			}
		}else{
			return 3;
		}
	}
}

function check_payment_done_course_student($studId)
{
    $this->db->trans_start();
	$this->db->where('fk_studId',$studId);
	$this->db->where('paymentSatusByadmin',1);
	$this->db->where('paystatusId',1);
	$this->db->or_where('paystatusId',3);
	$res = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if(!empty($res)){
    		return 1;
    	   } else {
    		return 0;
    	}
	}
}

function updateDayMonthId($updateMonthId,$updateDayId,$studId)
{

	$this->db->where('studId',$studId);
	$this->db->where('studentStatus',1);
	$result = $this->db->get('studentreg')->result_array();
	
	if(!empty($result)){

		$last_update_Day_Id   = $result[0]['unlockdayId']; 
		$last_update_month_Id = $result[0]['unlock_monthId'];
		$createDT             = $result[0]['createDT'];
		if($last_update_Day_Id < 20){	
				
				$last_update_Day_Ids    = $last_update_Day_Id + 1;
				if($last_update_month_Id > 1){
				    $last_update_month_Ids = $last_update_month_Id;
				}else{
					$last_update_month_Ids = $updateMonthId;
				}
		
				$this->db->where('studId',$studId);
				$updatearry = array('unlockdayId' => $last_update_Day_Ids,'unlock_monthId'=> $last_update_month_Ids,'createDT'=>$createDT);
				$res = $this->db->update('studentreg',$updatearry);
				if($res==1){
					return 1;
				   } else {
					return 0;
				}
			
			} else {

				$last_update_Day_Id   = $updateDayId;
				$last_update_month_Id = $last_update_month_Id + 1;
				if($last_update_Day_Id==20){
					$last_update_Day_Id = 1;
				}
				$this->db->where('studId',$studId);
				$updatearry = array('unlockdayId' => $last_update_Day_Id,'unlock_monthId'=> $last_update_month_Id,'createDT'=>$createDT );
				$res = $this->db->update('studentreg',$updatearry);
				if($res==1){
					return 1;
			   } else {
					return 0;
			}
		}
	}
}



public function parentpin_retrive($studId)
{
    $this->db->trans_start();
    $this->db->where('studId',$studId);
	$result = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if(!empty($result)){
    		return $result;
    	}else {
    		return $result;
        }
   }
}


public function videoGallery_list()
{
    $this->db->trans_start();
    $this->db->join('tbl_class','tbl_class.classId = videogallery_list.fk_classId','left');
	$result = $this->db->get('videogallery_list')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
	    
    	if(!empty($result)){
    		return $result;
    	}else {
    		return $result;
        }
    }
}


public function videoGallery($arraydata)
{
    $this->db->trans_start();
	$result = $this->db->insert('videogallery_list',$arraydata);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {
    	if($result==1){
    		return 1;
    	}else {
    		return 0;
        }
    }
}


public function deleteGalleryVid($vgId)
{
	$this->db->trans_start();
	$this->db->where('vgId',$vgId);
	$res = $this->db->delete('videogallery_list');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
      return $res;
   }
}

// KARAN HOMEWORK CODE

public function get_course_infomation($studId){
        $this->db->where('fk_studId', $studId);
        $res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
        return $res;
    }

    public function get_student_homeworks($class_id,$plan_id)
    {
        $this->db->where('class_id',$class_id);
        $this->db->where('fk_feesId',$plan_id);
        $this->db->where('admin_approv_status',2);
        $this->db->group_by('start_time'); 
        $this->db->order_by('start_time', 'desc'); 
        $res = $this->db->get('homework_allocated')->result_array();
        if(!empty($res)){
            return $res;
        }else{
         return $res;
        }
    }



    public function back_reposense_homework($start_time,$homework_id,$fk_feesId,$class_id,$FILENAMES,$home_title,$studId)
    {
        
         $data  = array(	
                        'fk_studentId'      =>$studId,
						'start_time' 	    => $start_time,
						'fk_homework_id'    => $homework_id,
						'fk_feesId'		    => $fk_feesId,
						'fk_class_id'		=> $class_id,
						'allocated_file'    => $FILENAMES,
						'home_title'        =>$home_title
						);
						
					
					
						
		$res  = $this->db->insert('student_back_response_homework',$data);
	
		if($res ==1){
		    return 1;
		}
		else
		{
		    return 0;
		}
        
        
    }
    
     public function get_download_homework($start_time,$fk_feesId)
    {
         $this->db->where('start_time',$start_time);
         $this->db->where('fk_feesId',$fk_feesId);
         $res = $this->db->get('homework_allocated')->result_array();
          return $res;
        
    }
    
    public function response_remark_studentt()
{
        $homework_id  = $this->input->post('homework_id');
        $result = $this->regModel->student_homeworks_remarks_reponsetbl($homework_id);
        echo json_encode(!empty($result[0]['description']) ? $result[0]['description']:'');
}

  public function student_homeworks_remarks_reponsetbl($homework_id)
    {
        $this->db->where('fk_homework_id', $homework_id);
        $this->db->group_by('fk_studentId'); 
        $res = $this->db->get('student_back_response_homework')->result_array();
        return $res;
    }




function attendace($studId,$currentDate){
    
    
    $this->db->trans_start();
	$this->db->where('fk_userId',$studId);
	$this->db->where('dateToday',$currentDate);
	$res = $this->db->get('tbl_attendance_free_student')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{
        
        if(empty($res)){
            $data = array('fk_userId'=>$studId,'dateToday'=>$currentDate,'remark'=>1);
            $result = $this->db->insert('tbl_attendance_free_student',$data);
            if($result==1){
                return 1;
            }else{
                return 2;
            }
        }else{
            return 0;    
        }
     	
	}
	
}


function get_live_attendace()
{
    
    
    $this->db->trans_start();
    
    $this->db->group_by('dateToday');
    $this->db->join('studentreg','studentreg.studId = tbl_attendance_free_student.fk_userId','left');
     $this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$res = $this->db->get('tbl_attendance_free_student')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	  return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{
        return $res;
	}
    
}


public function get_listvideo_uploading_coursePeriod($fk_classId,$coursePeriod)
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
	$this->db->where('tbl_videouploadingdata.coursePeriod',$coursePeriod);
	$this->db->where('tbl_videouploadingdata.status',1);
	$this->db->order_by('tbl_days.dayName','ASC');
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$this->db->group_by('fk_dayId');
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}

}

public function listvideo_uploading_coursePeriod($fk_classId,$coursePeriod){

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
	$this->db->where('tbl_videouploadingdata.coursePeriod',$coursePeriod);
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
    }

}


public function get_day_sessions_coursewise_data($dayId,$monthId,$fk_classId,$studId,$coursePeriod)
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
		$this->db->where('tbl_videouploadingdata.fk_upload_key',2);
	}else if(!empty($coursePeriod)){
	    $this->db->where('tbl_videouploadingdata.coursePeriod',$coursePeriod);
	}
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','asc');
	$res = $this->db->get()->result_array();

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}
}




public function countupdate($val)
{
		$this->db->order_by('tbl_fake_data.fkId','desc');
		$this->db->limit(1);
		$res = $this->db->get('tbl_fake_data')->result_array();
		if(!empty($res)){
			$data = array('fk_count'=>$res[0]['fk_count'] + $val);
			$res = $this->db->insert('tbl_fake_data',$data);
			if($res==1){
				return 1;
			}else{
				return 0;
			}
		}


}


public function fakecount()
{
    $this->db->order_by('tbl_fake_data.fkId','desc');
    $this->db->limit(1);
	 $res = $this->db->get("tbl_fake_data")->result_array();
	 if($res){
	     return $res[0]['fk_count'];
	 }else{
	     return $res;
	 }
    
}



/////////////////////////////////////////////



public function get_month_data_copy()
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
	$this->db->where('tbl_videouploadingdata.fk_monthId',3);
	$this->db->where('tbl_videouploadingdata.fk_classId',1);
	$this->db->where('tbl_videouploadingdata.fk_dayId',1);
	$this->db->where('tbl_videouploadingdata.coursePeriod',0);
	$this->db->where('tbl_videouploadingdata.status',1);
    $this->db->having('COUNT("tbl_videouploadingdata.vimeoId")>1');
	$this->db->order_by('tbl_videouploadingdata.fk_squenceId','desc');
	$this->db->group_by('fk_dayId');
	$res = $this->db->get()->result_array();
    
    echo $this->db->last_query();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback(); 
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if(!empty($res)){
			return $res;
		}else {
			return $res;
		}
	}
}



/////////////////////////////////////////////


//admin approvel admin

public function homework_list($fees_id)
    { 
        $this->db->where('fk_feesId', $fees_id);
        $this->db->group_by('home_title'); 
        $this->db->order_by('home_title', 'asc');
        $this->db->join('tab_add_fees_data', 'tab_add_fees_data.feesId  =  homework_allocated.fk_feesId');
        $res = $this->db->get('homework_allocated')->result_array();
        return $res;
        
    }
    
      public function get_update_homework_status($home_id)
    {
         $this->db->where('homework_id',$home_id);
         $res = $this->db->get('homework_allocated')->result_array();
          return $res;
    }
        public function get_update_work_date_wise_data($start_date)
    {
         $this->db->where('start_time',$start_date);
         $res = $this->db->get('homework_allocated')->result_array();
          return $res;
    }
        public function update_statusBy_admin($get_datewise_data)
    {
         $updatearray = array('admin_approv_status'=>2);
         $this->db->where('start_time',$get_datewise_data);
         $result = $this->db->update('homework_allocated',$updatearray);
         
         if($result ==1){
		    return 1;
		}
		else
		{
		    return 0;
		}
		
    }


public function add_value_based_video($dataarray)
{
	
        $this->db->where('fromDT',$dataarray['fromDT']);
        $this->db->where('toDT',$dataarray['toDT']);
		$res = $this->db->get('add_value_based_video')->result_array();
		if(empty($res)){
			$res = $this->db->insert('add_value_based_video',$dataarray);
			if($res==1){
				return 1;
			  	 }else{
				return 0;
		      }
    	}else{
    		return 0;
    	}

}


public function list_of_valuebased_class($fk_classId)
{
        $this->db->where('fk_classId',$fk_classId);
    	$this->db->join('tbl_class','tbl_class.classId = add_value_based_video.fk_classId');
	    $res = $this->db->get('add_value_based_video')->result_array();
	  //  echo $this->db->last_query();
		if(!empty($res)){
			return $res;
		}else{
			return $res;
		}


}

public function list_of_valuebased()
{
    
    	$this->db->join('tbl_class','tbl_class.classId = add_value_based_video.fk_classId');
	    $res = $this->db->get('add_value_based_video')->result_array();
		if(!empty($res)){
			return $res;
		}else{
			return $res;
		}


}

public function deletevaluebasedId($vbId)
{
		$this->db->where('vbId',$vbId);
	    $res = $this->db->delete('add_value_based_video');
		if($res==1){
			return 1;
		}else{
			return 0;
		}

}


public function parents_review_update_list_edit($reviwId)
{
	
        $this->db->trans_start();
		$this->db->where('reviwId',$reviwId);
    	$this->db->join('tbl_class','tbl_class.classId = tbl_parents_review_update_list.fk_classId','left');
	    $res = $this->db->get('tbl_parents_review_update_list')->result_array();
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}

}


public function parents_review_update_edit($arraydata,$reviwId)
{


	$this->db->where('reviwId',$reviwId);
	$res = $this->db->update('tbl_parents_review_update_list',$arraydata);
	if($res==1){
		return 1;
	  }else{
		return 0;
	}
	

}

   public function get_download_homework_admin($start_time,$end_time,$feesId)
    {
         $this->db->where('start_time',$start_time);
         $this->db->where('end_time',$end_time);
         $this->db->where('fk_feesId',$feesId);
         $res = $this->db->get('homework_allocated')->result_array();
         return $res;
        
    }



public function getstudlist_filter_studlist_partial_payment_students()
{
	
        $this->db->trans_start();
		$this->db->where('log_payment_data.paystatusId',3);
		$this->db->where('log_payment_data.paymentSatusByadmin',1);
		$this->db->where('studentreg.studentStatus',1);
		$this->db->group_by('log_payment_data.usr_email');
        $this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
    	$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId','left');
    	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}

}


public function getstudlist_filter_studlist_full_payment_students()
{
	
        $this->db->trans_start();
		$this->db->where('log_payment_data.paystatusId',1);
		$this->db->where('log_payment_data.paymentSatusByadmin',1);
		$this->db->where('studentreg.studentStatus',1);
		$this->db->group_by('log_payment_data.usr_email');
    	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId');
    	$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
    	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass');
	    $res = $this->db->get('log_payment_data')->result_array();
	    
	   // echo $this->db->last_query();
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}

}


function updatePayment($fk_studId)
{
    
       $this->db->trans_start();
        $this->db->where('fk_studId',$fk_studId);
		$this->db->where('log_payment_data.paystatusId',3);
		$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
    	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}
    
}


//karan model

public function delete_homework_admin_m($start_time,$end_time,$feesId,$home_title){
        $this->db->trans_start(); 
    	$this->db->where('start_time',$start_time);
    	$this->db->where('end_time',$end_time);
    	$this->db->where('fk_feesId',$feesId);
    	$this->db->where('home_title',$home_title);
     	$res = $this->db->delete('homework_allocated');
     	
        $this->db->trans_complete();
    
    	if ($this->db->trans_status() === FALSE)
    	{
    	    $this->db->trans_rollback(); 
    	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    	} else {
    	  return $res;
        }
}

public function updatee_homework_admin_m($start_time,$end_time,$feesId,$home_title){
        $this->db->trans_start(); 
        $updatearray = array('admin_approv_status'=>2);
        $this->db->where('start_time',$start_time);
    	$this->db->where('end_time',$end_time);
    	$this->db->where('fk_feesId',$feesId);
    	$this->db->where('home_title',$home_title);
         $res = $this->db->update('homework_allocated',$updatearray);
         $this->db->trans_complete();
         $this->db->trans_complete();
    
    	if ($this->db->trans_status() === FALSE)
    	{
    	    $this->db->trans_rollback(); 
    	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    	} else {
    	  return $res;
        }
          
}

function updatePaymentpartial($data,$rowId)
{
    
	    $this->db->where('logId',$rowId);
		$res = 	$this->db->update('log_payment_data',$data);
        if($res==1)
        {
			return "1";
		}else{
			return "0";
		}
    
}


function updatefullpayment($studId)
{
    
       $this->db->trans_start();
         
        $this->db->where('fk_studId',$studId);
		$this->db->where_in('log_payment_data.paystatusId',['1','3','4']);
		$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
		$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass');
		$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	   
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}
    
}

public function getpackage_homework($class_id)
{
         $this->db->trans_start();
         $this->db->where('fk_classId',$class_id);
         $res = $this->db->get('tab_add_fees_data')->result_array();

        $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}
    
}




public function discountlist()
{

	    $this->db->trans_start();
	    $this->db->where('discount > ',0);
    	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}

}

public function adjustamountlist()
{

	    $this->db->trans_start();
	    $this->db->where('fk_adjustedAmount > ',0);
    	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}

}



public function getstudlist_filter_studlist_close_student_payment_status()
{
	
        $this->db->trans_start();
		$this->db->where('log_payment_data.paystatusId',3);
		$this->db->where('studentreg.studentStatus',1);
    	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
    	$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId','left');
    	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}

}




function updatefullpaymentStud($data)
{
    
    $res = "";
    for ($i = 0; $i < count($data['fk_adjustedAmount']); $i++) 
    {
        $datas = array('fk_adjustedAmount'=>$data['fk_adjustedAmount'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
     for ($i = 0; $i < count($data['fk_adjustedRemark']); $i++) 
    {
       $datas = array('fk_adjustedRemark'=>$data['fk_adjustedRemark'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
     for ($i = 0; $i < count($data['payAmount']); $i++) 
    {
       $datas = array('payAmount'=>$data['payAmount'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    for ($i = 0; $i < count($data['discount']); $i++) 
    {
       $datas = array('discount'=>$data['discount'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    for ($i = 0; $i < count($data['remarkReceipt']); $i++) 
    {
       $datas = array('remarkReceipt'=>$data['remarkReceipt'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    for ($i = 0; $i < count($data['dueDate']); $i++) 
    {
       $datas = array('dueDate'=>$data['dueDate'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    for ($i = 0; $i < count($data['dueRemark']); $i++) 
    {
       $datas = array('dueRemark'=>$data['dueRemark'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    
     for ($i = 0; $i < count($data['planId']); $i++) 
    {
        $datas = array('planId'=>$data['planId'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    
    for ($i = 0; $i < count($data['roundOff']); $i++) 
    {
        $datas = array('roundOff'=>$data['roundOff'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    for ($i = 0; $i < count($data['augustoffer']); $i++) 
    {
        $datas = array('augustoffer'=>$data['augustoffer'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    
    for ($i = 0; $i < count($data['paystatusId']); $i++) 
    {
        if($data['paystatusId'][$i]=="1")
        {
            $paystatus = "success";
        }else{
            $paystatus = "partial";
        }
        $datas = array('paystatusId'=>$data['paystatusId'][$i],'paystatus'=>$paystatus);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
    
    for ($i = 0; $i < count($data['fk_adjustedAmount']); $i++) 
    {
        $datas = array('fk_adjustedAmount'=>$data['fk_adjustedAmount'][$i]);
        $where = array('logId'=>$data['logId'][$i]);
        $res =  $this->update_data($datas,$where);
    }
    
   if($res==1){
       return 1;
   }else{
       return 0;
   }


}


public function update_data($data,$where){
    
    foreach($where as $key => $val){
        $this->db->where($key,$val);
    }
    
    return  $this->db->update('log_payment_data',$data);
   		
}


function updatefinalpayment($studId){
    
    $data = array('paystatus'=>'Close Account','paystatusId'=>4);
    $this->db->where('fk_studId',$studId);
     $res = $this->db->update('log_payment_data',$data);
     if($res==1){
         return 1;
     }else{
         return 0;
     }
    
}


function closeaccountlist()
{
    
        $this->db->trans_start();
        $this->db->select("*");
		$this->db->where('log_payment_data.paystatusId',4);
		$this->db->where('log_payment_data.paymentSatusByadmin',1);
		$this->db->where('studentreg.studentStatus',1);
		$this->db->group_by('log_payment_data.usr_email');
        $this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
    	$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId','left');
    	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}


}


function updateFinalPaymentStatus($studId){
    
        $this->db->trans_start();
        $this->db->where('fk_studId',$studId);
		$this->db->where('log_payment_data.paystatusId',4);
		$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
		$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass');
		$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	   
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}
		
		
}


function closeaccountlistfilter($studentMobile,$studentEmail,$fromDT,$toDT){
    
        $this->db->trans_start();
        
        if(!empty($studentMobile)){
             $this->db->where('studentreg.usr_mobile',$studentMobile);
        }
        
        if(!empty($studentEmail)){
             $this->db->where('studentreg.usr_email',$studentEmail);
        }
        
        if(!empty($fromDT) && !empty($toDT))
        {
            $this->db->where('log_payment_data.createDT BETWEEN "'. date('Y-m-d h:i:s', strtotime($fromDT)). '" and "'. date('Y-m-d h:i:s', strtotime($toDT)).'"');
        }
        
        $this->db->where('log_payment_data.paystatusId',4);
		$this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId');
		$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass');
		$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	    $res = $this->db->get('log_payment_data')->result_array();
	    
	   
	   
	    $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback(); 
		    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');

		} else {

			if(!empty($res)){
				return $res;
			}else{
				return $res;
			}
		}
		
    
}


function promocode_list_student_filter($studentMobile,$studentEmail,$promoCode){
    
    
    $this->db->trans_start();

	if($promoCode!=""){
	    $this->db->where('studentreg.promoCode!=',$promoCode);
	}
	
	if($studentEmail!=""){
	    $this->db->where('studentreg.studentEmail',$studentEmail);
	}
	
	if($studentMobile!=""){
	    $this->db->where('studentreg.studentMobile',$studentMobile);
	}
	
    $this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass');
	$res = $this->db->get('studentreg')->result_array();
		
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
	    return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
       return $res;
   }
   
   
   
    
}


public function where_to_upload()
{

	$this->db->trans_start();
	$this->db->where('status',1);
	$this->db->order_by('wId','ASC');
	$res = $this->db->get('where_to_upload')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  $this->db->trans_rollback();
		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{

	   return $res;
	}

}



public function readMessage($studId,$readMsg)
{
    
	$this->db->trans_start();
	$dataarray = array('readMsg'=>$readMsg);
	$this->db->where('fk_studId',$studId);
	$this->db->or_where('fk_teachId',$studId);
	$res = $this->db->update('teacher_chat_window',$dataarray);
	$this->db->trans_complete();
	if($this->db->trans_status() == FALSE)
    {   
        $this->db->trans_rollback();
        return $res = array('error' =>'Transaction Failed Because you try to hacking system');
    }else
    {
        
    	if($res==1){
    		return 1;
    	}else{
    		return 0;
    	}
    }

}


public function readNoticeMessage()
{
	$this->db->trans_start();
	$dataarray = array('readMsg'=>1);
	$res = $this->db->update('notice',$dataarray);
	$this->db->trans_complete();
	if($this->db->trans_status() == FALSE)
    {   
        $this->db->trans_rollback();
        return $res = array('error' =>'Transaction Failed Because you try to hacking system');
    }else
    {
        
    	if($res==1){
    		return 1;
    	}else{
    		return 0;
    	}
	}

}



public function edit_session_update($sessiondata,$sessionId)
{
    
	$this->db->trans_start();
	$this->db->where('sessionId',$sessionId);
	$res = $this->db->update('tbl_session_type',$sessiondata);
	$this->db->trans_complete();
    if($this->db->trans_status() == FALSE)
    {   
        $this->db->trans_rollback();
        return $res = array('error' =>'Transaction Failed Because you try to hacking system');
    }else
    {
        
    	if($res==1){
    		return 1;
    	}else{
    		return 0;
    	}
    }

}



public function edit_session($sessionId)
{
    $this->db->trans_start();
	$this->db->where('sessionId',$sessionId);
	$res = $this->db->get('tbl_session_type')->result_array();
	$this->db->trans_complete();
    if($this->db->trans_status() == FALSE)
    {   
        $this->db->trans_rollback();
        return $res = array('error' =>'Transaction Failed Because you try to hacking system');
    }else
    {
        
    	if(!empty($res)){
    		return $res;
    	}else{
    		return $res;
    	}
	}

	
}

public function getEvents()
{
    $this->db->trans_start();
    $this->db->group_by('event_rand_id');
    $res = $this->db->get('event_content')->result_array();
    $this->db->trans_complete();
    if($this->db->trans_status() == FALSE)
    {   
        $this->db->trans_rollback();
        return $res = array('error' =>'Transaction Failed Because you try to hacking system');
    }else
    {
       return $res;
    }
    
}

 public function get_events_info($event_generated_id)
    {
        $this->db->trans_start();
    	$this->db->where('event_rand_id',$event_generated_id);
    	$res = $this->db->get('event_content')->result_array();
    	$this->db->trans_complete();
    
    	if ($this->db->trans_status() === FALSE)
    	{
    	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    	}else{
    
          return $res;
       }
   
    }
    
    
public function getReviews()
    {
        $this->db->trans_start();
        $res = $this->db->get('insert_youtube_review')->result_array();
        $this->db->trans_complete();
        if($this->db->trans_status() == FALSE){
            $this->db->trans_rollback();
            return $res = array('error' => 'Transaction Failed Because you try to hacking System');
        }else
        {
            return $res;
        }
    }




public function sendPaymentreminder($studId)
{


	$this->db->trans_start();
	$this->db->where('fk_studId',$studId);
	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	$res = $this->db->get('log_payment_data')->result_array();
	$this->db->trans_complete();
	
	if($this->db->trans_status() == FALSE)
    {   
        $this->db->trans_rollback();
         return $res = array('error' =>'Transaction Failed Because you try to hacking system');
    }
    else
    {

	
	
    	if(!empty($res))
    	{
    		$paidAmount    = array();
    		$packageAmount = 0;
    		$studentMobile = "";
    		$dueDate       = "";
    		foreach ($res as $value) {
    		    $paidAmount[] = $value['payAmount'];
    		    $packageAmount = $value['final_fees'];
    		    $studentMobile = $value['usr_mobile_no'];
    		    $dueDate       = $value['dueDate'];
    		    $fk_studId     = $value['fk_studId'];
    		}
    	
            	$totalPaidAmount = array_sum($paidAmount);
            	$remainingAmount = round($packageAmount - $totalPaidAmount);
            
            	$data = array('dueRemark'=>json_encode($res),'dueStatus'=>1,'studentMobile'=>$studentMobile,'dueDate'=>date('Y-m-d', strtotime($dueDate)),'fk_studId'=>$fk_studId );
            	$result = $this->db->insert('tbl_log_dueReminder',$data);
            	
            	$message = trim("Dear Parent your child school fees is pending");
            	$res = sendsmsweb($studentMobile,$remainingAmount,$message);
            	if($res=="fail" || $res=="InsufficientBalance")
            	{
            		$data_otp_array = array(
                    'studentMobile'  		=> $studentMobile,
                    'user_OTP_Status'  		=> 2  
            		);
            	}else{
            		$data_otp_array = array(
                    'studentMobile'  		=> $studentMobile,
                    'user_OTP_Status'  		=> 1  
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



public function uploadwhere()
{

	$this->db->trans_start();
	$this->db->where('status',1);
	$this->db->order_by('wupId','ASC');
	$res = $this->db->get('uploadwhere')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{

		return $res;
	}

}

// api karan upload homework //

public function back_reposense_homeworkapi($start_time,$homework_id,$fk_feesId,$class_id,$FILENAMES,$home_title,$studId)
    {
        
         $data  = array(	
                        'fk_studentId'      =>$studId,
						'start_time' 	    => $start_time,
						'fk_homework_id'    => $homework_id,
						'fk_feesId'		    => $fk_feesId,
						'fk_class_id'		=> $class_id,
						'allocated_file'    => $FILENAMES,
						'home_title'        =>$home_title
						);
						
					
					
						
		$res  = $this->db->insert('student_back_response_homework',$data);
	
		if($res ==1){
		    return 1;
		}
		else
		{
		    return 0;
		}
        
        
    }





public function addpackage($data)
{
	$this->db->trans_start();
    $res = 	$this->db->insert('addpackage',$data);
  	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{
	    
      if($res==1){
    		return 1;
    	}else{
    	    return 0;
    	}
	}

}


public function getpackage()
{
		$this->db->trans_start();
        $res  =  $this->db->get('addpackage')->result_array();
      	$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE)
    	{
    	   $this->db->trans_rollback();
    	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
    
    	}else{
    	    
          if(!empty($res)){
        		return $res;
        	} else {
        	    return $res;
            }
        }
}


public function changepromoCodeStatus()
{
    $endDate = date("Y-m-d");
    $this->db->trans_start();
	$updatearry = array('status'=>2);
	$this->db->where('endDate',$endDate);
	$res = $this->db->update('tbl_promocode',$updatearry);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	    $this->db->trans_rollback();
		return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	} else {

		if($res==1){
			return 1;
		}else{
			return 0;
		}
	}
}



public function add_tbl_admin_role($data)
{

	 $daydata = $this->db->insert('tbl_admin_ved',$data);
	 if(!empty($daydata))
	 {
	 	return 1;
	 }else{
	 	return 0;
	 }
}

public function get_tbl_admin_role()
{

	 $daydata = $this->db->get('tbl_admin_role')->result_array();
	 if(!empty($daydata))
	 {
	 	return $daydata;
	 }else{
	 	return $daydata;
	 }
}

public function get_tbl_admin_ved()
{
     $this->db->trans_start();
     $this->db->join('tbl_admin_role','tbl_admin_role.adminRoleId = tbl_admin_ved.adminRole');
	 $daydata = $this->db->get('tbl_admin_ved')->result_array();
	 $this->db->trans_complete();
	 if ($this->db->trans_status() === FALSE)
	 {
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	 }else{
	    
    	 if(!empty($daydata))
    	 {
    	 	return $daydata;
    	 }else{
    	 	return $daydata;
    	 }
	 }
}


public function deleteroleId($studId)
{
	$this->db->trans_start();
	$this->db->where('studId',$studId);
	$res = $this->db->delete('tbl_admin_ved');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback();
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

		if(!empty($res)){
			return 1;
		}else{
			return 0;
		}
	}
	
}

// webinar banner show 

public function show_webinar_banners()
{

	 $result = $this->db->get('webinar_banners')->result_array();
	 if(!empty($result))
	 {
	 	return $result;
	 }else{
	 	return $result;
	 }
}




function get_all_count_nursery()
{
    $this->db->where('studentreg.studentClass',1);
    $this->db->group_by('log_payment_data.usr_mobile_no');
    $this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId','left');
    $result = $this->db->get('log_payment_data')->result_array();
     if(!empty($result))
	 {
	 	return count($result);
	 }else{
	 	return $result;
	 }
}

function ChecklogId($logRandomId)
{
    $this->db->where('logRandomId',$logRandomId);
    $result = $this->db->get('studentreg')->result_array();
     if(!empty($result))
	 {
	 	return "1";
	 }else{
	 	return "0";
	 }
}

function get_all_count_junior()
{
    $this->db->where('studentreg.studentClass',2);
    $this->db->group_by('log_payment_data.usr_mobile_no');
    $this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId','left');
    $result = $this->db->get('log_payment_data')->result_array();
     if(!empty($result))
	 {
	 	return count($result);
	 }else{
	 	return $result;
	 }
}

function get_all_count_senior()
{
    $this->db->where('studentreg.studentClass',3);
    $this->db->group_by('log_payment_data.usr_mobile_no');
    $this->db->join('studentreg','studentreg.studId = log_payment_data.fk_studId','left');
    $result = $this->db->get('log_payment_data')->result_array();
     if(!empty($result))
	 {
	 	return count($result);
	 }else{
	 	return $result;
	 }
    
}


public function deleteAllocation($studId)
{
	$this->db->trans_start();
	$this->db->where('fk_studId',$studId);
	$res = $this->db->delete('tbl_allocate_teacher_to_student');
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback(); 
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
      return $res;
   }
}

public function teacher_detail()
{
    $this->db->trans_start();
    $res = $this->db->get('tbl_teacher')->result_array();
    $this->db->trans_complete();
    
      if($this->db->trans_status() == FALSE)
      {
          $this->db->trans_rollback();
          return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
      }else{
          return $res;
      }
}

public function teacher_registion($data)
{
    $this->db->trans_start();
    $res = $this->db->insert('tbl_teacher', $data);
    $this->db->trans_complete();
    
      if($this->db->trans_status() == FALSE)
      {
          $this->db->trans_rollback();
          return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
      }else{
          return $res;
      }
}

public function  teacher_delete($teach_id)
{
    $this->db->trans_start();
    $this->db->where('teacherId', $teach_id);
	$res = $this->db->delete('tbl_teacher');	
	$this->db->trans_complete();
	
	  if($this->db->trans_status() == FALSE)
	  {
	      $this->db->trans_rollback();
	      return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	  }else{
	      return $res;
	  }
}


// read homework api

public function readMessage_homework($studId,$readMsg,$startDate)
{
    $this->db->where('fk_studentId', $studId);
    $this->db->where('start_time', $startDate);
    
    $update_readmsg = array(
        'notification_status' =>$readMsg
        );
    
    $res = $this->db->update('homework_allocated',$update_readmsg);
    return $res;
    
}

public function get_reportcardDetail($studId)
{
         $this->db->where('fk_studId', $studId);
          $this->db->join('sign_uploads', 'sign_uploads.fk_teacher_id = report_first_term.fk_teacherId');
          $res = $this->db->get('report_first_term')->result_array();
         return $res;
}

public function get_reportcardDetail_second($studId)
{
          $this->db->where('fk_studId', $studId);
          $this->db->join('sign_uploads', 'sign_uploads.fk_teacher_id = report_first_term.fk_teacherId');
          $this->db->join('report_second_term', 'report_second_term.fk_student_id = report_first_term.fk_studId');
          $res = $this->db->get('report_first_term')->result_array();
          return $res; 
}


public function followupenquiry($data)
{
    $this->db->trans_start();
	$result = $this->db->insert('tbl_followupenquiry',$data);
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback(); 
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
	    
    	if($result==1){
    		return "1";
    	}else{
    		return "0";
    	}
	}
}


public function leadfollowup()
{
    $this->db->trans_start();
    $this->db->join('tbl_admin_ved','tbl_admin_ved.studId = tbl_followupenquiry.fk_loginId');
	$result = $this->db->get('tbl_followupenquiry')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback(); 
	   return $result = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
	    
    	if(!empty($result)){
    		return $result;
    	}else{
    		return $result;
    	}
	}
}

public function search_leadfollowup($studentName,$studentEmail,$studentMobile)
{
    $this->db->trans_start();
    $this->db->where('tbl_admin_ved.studentName',$studentName);
    $this->db->or_where('tbl_admin_ved.studentEmail',$studentEmail);
    $this->db->or_where('tbl_admin_ved.studentMobile',$studentMobile);
    $this->db->join('tbl_admin_ved','tbl_admin_ved.studId = tbl_followupenquiry.fk_loginId');
	$result = $this->db->get('tbl_followupenquiry')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   $this->db->trans_rollback(); 
	   return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
	}else{
	    
    	if(!empty($result)){
    		return $result;
    	}else{
    		return $result;
    	}
	}
}

public function getPresipalData(){
    
    $this->db->trans_start();
    $res = $this->db->get('principal_sig')->result_array();
    $this->db->trans_complete();
    if($this->db->trans_status() == FALSE)
    {
        return $res = array('error'=>'Transaction Failed Because you try to hacking systeam');
    }else{
        return $res;
    }
}




















































}
?>