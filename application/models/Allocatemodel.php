<?php

class Allocatemodel extends CI_Model
{

	

public function allocate_student($fk_classId,$fk_teachId,$fk_feesId,$fk_date,$batchId)
{

	$this->db->trans_start();
	$this->db->where('studentStatus',1);
	$this->db->where('MONTH(createDT)',date('m'));
	$this->db->where('YEAR(createDT)',date('Y'));
	$this->db->where('studentClass',$fk_classId);

	$check_pay_amount_by = $this->db->get('studentreg')->result_array();  //fetch data from table where student is active of current month

	$payment_successful_student_id = array();
	if($check_pay_amount_by){

		foreach ($check_pay_amount_by as $key => $value) {
			$payment_successful_student_id[] = $value['studId'];			
		}
	}

    $this->db->where_in('paystatusId',['1','3']);
	$this->db->where('planId',$fk_feesId);
	$this->db->where_in('fk_studId',$payment_successful_student_id);
	$get_payment_successful_student_id = $this->db->get('log_payment_data')->result_array(); //get successful payment student


	$res = "";

	$tbl_get_payment_successful_student_id = array();
	if($get_payment_successful_student_id){
		foreach ($get_payment_successful_student_id as $key => $value) 
		{
				$check_already_present_key = $this->check_already_present_key($value['fk_studId'],$fk_classId);
				if($check_already_present_key==0) {
					$tbl_get_payment_successful_student_id = array('fk_studId'=>$value['fk_studId'],'fk_date'=>$fk_date,'fk_classId'=>$fk_classId,'fk_feesId'=>$fk_feesId,'fk_teachId'=>$fk_teachId,'fk_batchId'=>$batchId);
					$res = $this->db->insert('tbl_allocate_teacher_to_student',$tbl_get_payment_successful_student_id);
				}
			
		}
	}else{

		return 0;
	}

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{
		if($res==1)
		{
			return 1;
		}else{
			return 0;
		}
	}

}


public function allocate_student_manual($fk_classId,$fk_teachId,$fk_feesId,$fk_date,$batchId,$studId,$studentId)
{
	

	$this->db->trans_start();

	$this->db->where_in('paystatusId',['1','3','4']);
	$this->db->where('paymentSatusByadmin',1);
	$this->db->where('planId',$fk_feesId);
	$this->db->where('fk_studId',$studId);
	$get_payment_successful_student_id = $this->db->get('log_payment_data')->result_array(); //get successful payment student

	$res = "";
	$tbl_get_payment_successful_student_id = array();
	if($get_payment_successful_student_id){
		foreach ($get_payment_successful_student_id as $key => $value) 
		{
				$check_already_present_key = $this->check_already_present_key($value['fk_studId'],$fk_classId);
				if($check_already_present_key==0) {
					$tbl_get_payment_successful_student_id = array('fk_studId'=>$value['fk_studId'],'fk_date'=>$fk_date,'fk_classId'=>$fk_classId,'fk_feesId'=>$fk_feesId,'fk_teachId'=>$fk_teachId,'fk_batchId'=>$batchId);
					$res = $this->db->insert('tbl_allocate_teacher_to_student',$tbl_get_payment_successful_student_id);
				}
			
		}
	}else{

		return 0;
	}

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{
		if($res==1)
		{
			return 1;
		}else{
			return 0;
		}
	}

}

public function check_already_present_key($fk_studId,$fk_classId)
{


	$this->db->where('fk_studId',$fk_studId);
	$this->db->where('fk_classId',$fk_classId);
	$res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
	if(!empty($res)){

		return 1;
	}else{
		return 0;

	}
	

}
public function tbl_allocate_teacher_to_student_count($fk_feesId,$fk_classId,$fk_teachId,$batchId)
{

	$this->db->trans_start();
	$this->db->where('fk_classId',$fk_classId);
	if($fk_feesId==10 || $fk_feesId==15 || $fk_feesId==16){
		$this->db->where('fk_feesId',$fk_feesId);
		
	}else if($fk_feesId==4 || $fk_feesId==9 || $fk_feesId==14 || $fk_feesId==8 || $fk_feesId==3 || $fk_feesId==13 || $fk_feesId==17 || $fk_feesId==18 || $fk_feesId==19  )
	{
		$this->db->where('fk_feesId',$fk_feesId);
		
	}
	$this->db->where('fk_teachId',$fk_teachId);
	$this->db->where('fk_batchId',$batchId);
	$this->db->where('MONTH(createDT)',date('m'));
	$this->db->where('YEAR(createDT)',date('Y'));
	$res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
    
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

		if(!empty($res)){
			 $tbl_allocate_teacher_to_student_count = count($res);
			 
            if($fk_feesId==4 || $fk_feesId==9 || $fk_feesId==14 || $fk_feesId==8 || $fk_feesId==3 || $fk_feesId==13 || $fk_feesId==17 || $fk_feesId==18 || $fk_feesId==19){
           
            if($tbl_allocate_teacher_to_student_count==35){
              return 1;  
            }else{
                return 0;
            }
        }else if($fk_feesId==10 || $fk_feesId==15 || $fk_feesId==16){
                
                
            if($tbl_allocate_teacher_to_student_count==20){
              return 1;  
                }else{
                return 0;
            }
        }

		}else{
			return 0;
		}
	}

}


public function allocate_student_search($studentMobile,$studentEmail,$studentId)
{

	$this->db->trans_start();
	if($studentEmail!=""){

		$this->db->where('studentreg.studentEmail',$studentEmail);
	}else if($studentMobile!=""){

		$this->db->where('studentreg.studentMobile',$studentMobile);
	}else if($studentId!=""){

		$this->db->where('studentreg.studentId',$studentId);
	}
	
	$this->db->join('studentreg','studentreg.studId = tbl_allocate_teacher_to_student.fk_studId','left');
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{
	   return $res;
	}

}

public function allocate_student_search_without_filter()
{
	
	$this->db->trans_start();
	$this->db->join('studentreg','studentreg.studId = tbl_allocate_teacher_to_student.fk_studId','left');
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$res = $this->db->get('tbl_allocate_teacher_to_student')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

	return $res;
	}

}




public function allocate_student_search_without_filter_nursery()
{
	
	$this->db->trans_start();
	$this->db->where('studentClass',1);
	$this->db->where_in('paystatusId',['1','3','4']);
	$this->db->where('paymentSatusByadmin',1);
	$this->db->group_by('log_payment_data.fk_studId');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	$this->db->join('tbl_allocate_teacher_to_student','tbl_allocate_teacher_to_student.fk_studId = studentreg.studId','left');
	$this->db->join('tbl_teacher','tbl_teacher.teacherId = tbl_allocate_teacher_to_student.fk_teachId','left');
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

	return $res;
	}

}

public function allocate_student_search_without_filter_junior()
{
	
	$this->db->trans_start();
	$this->db->where('studentClass',2);
	$this->db->where_in('paystatusId',['1','3','4']);
	$this->db->where('paymentSatusByadmin',1);
	$this->db->group_by('log_payment_data.fk_studId');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
    $this->db->join('tbl_allocate_teacher_to_student','tbl_allocate_teacher_to_student.fk_studId = studentreg.studId','left');
    $this->db->join('tbl_teacher','tbl_teacher.teacherId = tbl_allocate_teacher_to_student.fk_teachId','left');
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$res = $this->db->get('studentreg')->result_array();
	
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

	return $res;
	}

}


public function allocate_student_search_without_filter_senior()
{
	
	$this->db->trans_start();
	$this->db->where('studentClass',3);
	$this->db->where_in('paystatusId',['1','3','4']);
	$this->db->where('paymentSatusByadmin',1);
	$this->db->group_by('log_payment_data.fk_studId');
	$this->db->join('log_payment_data','log_payment_data.fk_studId = studentreg.studId','left');
	$this->db->join('tab_add_fees_data','tab_add_fees_data.feesId = log_payment_data.planId','left');
	$this->db->join('tbl_allocate_teacher_to_student','tbl_allocate_teacher_to_student.fk_studId = studentreg.studId','left');
	$this->db->join('tbl_teacher','tbl_teacher.teacherId = tbl_allocate_teacher_to_student.fk_teachId','left');
	$this->db->join('tbl_class','tbl_class.classId = studentreg.studentClass','left');
	$res = $this->db->get('studentreg')->result_array();
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

	return $res;
	}

}


public function updateStudentId($studId,$studentId)
{
		$updateArray  = array('studentId'=>$studentId);
		$this->db->where('studId',$studId);
		$res = $this->db->update('studentreg',$updateArray);
		if($res==1){
			return 1;
		}else{
			return 0;
		}
		
}



public function tbl_allocate_teacher_to_student_count_free($fk_feesId,$fk_classId,$fk_teachId,$batchId,$studId)
{

	$this->db->trans_start();
	$this->db->where('fk_classId',$fk_classId);
	if($fk_feesId==10 || $fk_feesId==15 || $fk_feesId==16 || $fk_feesId==4 || $fk_feesId==9 || $fk_feesId==14 || $fk_feesId==8 || $fk_feesId==3 || $fk_feesId==13 || $fk_feesId==1||$fk_feesId==6 || $fk_feesId==11){
		$this->db->where('fk_feesId',$fk_feesId);
		
	}
	$this->db->where('fk_teachId',$fk_teachId);
	$this->db->where('fk_batchId',$batchId);
	$this->db->where('fk_studId',$studId);
	$this->db->where('MONTH(createDT)',date('m'));
	$this->db->where('YEAR(createDT)',date('Y'));
	$res = $this->db->get('tbl_allocate_teacher_to_free_student')->result_array(); 
	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');
	}else{

		if(!empty($res)){
			 $tbl_allocate_teacher_to_student_count = count($res);
            if($tbl_allocate_teacher_to_student_count >= 1){
               return 1;  
            }else{
                return 0;
            }
		}else{
			return 0;
		}
	}

}



public function promocode_list_student_allocate($fk_classId,$fk_teachId,$fk_feesId,$fk_date,$batchId,$studId,$studentId)
{
	

	$this->db->trans_start();
	$this->db->where('studentStatus',1);
	$this->db->where('MONTH(createDT)',date('m'));
	$this->db->where('YEAR(createDT)',date('Y'));
	$this->db->where('studentClass',$fk_classId);
	$this->db->where('studId',$studId);

	$check_pay_amount_by = $this->db->get('studentreg')->result_array();  //fetch data from table where student is active of current month

	$this->db->where_in('paystatusId',['1','3']);
	$this->db->where('paymentSatusByadmin',1);
	$this->db->where('planId',$fk_feesId);
	$this->db->where('fk_studId',$studId);
	$get_payment_successful_student_id = $this->db->get('log_payment_data')->result_array(); //get successful payment student
	
	$res = "";
	$tbl_get_payment_successful_student_id = array();
	if($get_payment_successful_student_id){
		foreach ($get_payment_successful_student_id as $key => $value) 
		{
				$check_already_present_key = $this->check_already_present_key($value['fk_studId'],$fk_classId);
				if($check_already_present_key==0) {
					$tbl_get_payment_successful_student_id = array('fk_studId'=>$value['fk_studId'],'fk_date'=>$fk_date,'fk_classId'=>$fk_classId,'fk_feesId'=>$fk_feesId,'fk_teachId'=>$fk_teachId,'fk_batchId'=>$batchId);
					$res = $this->db->insert('tbl_allocate_teacher_to_free_student',$tbl_get_payment_successful_student_id);
				}
			
		}
	}else{

		return 0;
	}

	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
		
	   return $res = array('error'=>'Transaction Failed Because you try to hacking system');

	}else{
		if($res==1)
		{
			return 1;
		}else{
			return 0;
		}
	}

}















































































}

?>