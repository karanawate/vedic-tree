<?php

class Allocatemodel extends CI_Model
{

	

public function allocate_student($fk_classId,$fk_teachId,$fk_feesId,$fk_date)
{

	$this->db->trans_start();
	$this->db->where('studentStatus',1);
	$this->db->where('studentClass',$fk_classId);
	$check_pay_amount_by = $this->db->get('studentreg')->result_array();


	$payment_successful_student_id = array();
	if($check_pay_amount_by){

		foreach ($check_pay_amount_by as $key => $value) {
			$payment_successful_student_id[] = $value['studId'];			
		}
	}


	$this->db->where('paystatusId',1);
	$this->db->where('planId',$fk_feesId);
	$this->db->where_in('fk_studId',$payment_successful_student_id);
	$get_payment_successful_student_id = $this->db->get('log_payment_data')->result_array();
	$res="";

	$tbl_get_payment_successful_student_id = array();
	if($get_payment_successful_student_id){
		foreach ($get_payment_successful_student_id as $key => $value) 
		{
				$check_already_present_key = $this->check_already_present_key($value['fk_studId'],$fk_classId);
				if($check_already_present_key==0) {
				$tbl_get_payment_successful_student_id = array('fk_studId'=>$value['fk_studId'],'fk_date'=>$fk_date,'fk_classId'=>$fk_classId,'fk_feesId'=>$fk_feesId,'fk_teachId'=>$fk_teachId);
				$res = $this->db->insert('tbl_allocate_teacher_to_student',$tbl_get_payment_successful_student_id);
			}else{
				return 0;
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


public function allocate_student_search($fk_search_classId,$fk_search_teachId,$fk_search_sub_teachId,$fk_date)
{

	$this->db->trans_start();

	$this->db->where('fk_studId',$fk_search_classId);
	$this->db->where('fk_feesId',$fk_search_sub_teachId);
	$this->db->where('fk_teachId',$fk_search_teachId);
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



}

?>