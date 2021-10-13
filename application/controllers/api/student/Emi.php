<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Emi extends REST_Controller 
{


 public function index_post()
  {
      
            $student_name               = $this->input->post('usr_firstname')."".$this->input->post('usr_lastname');
            $fk_studId                  = $this->input->post('fk_studId');
            $planId                     = $this->input->post('planId');
            $paymentType                = $this->input->post('paymentType');
            $payAmount                  = $this->input->post('payAmount');
            $planvalue                  = $this->input->post('planvalue');
            $student_dob                = $this->input->post('student_dob');
            $course_id                  = $this->input->post('course_id');
            $requested_tenure           = $this->input->post('requested_tenure');
            $applicant_name             = $this->input->post('applicant_name');
            $applicant_gender           = $this->input->post('applicant_gender');
            $applicant_dob              = $this->input->post('applicant_dob');
            $mobile                     = $this->input->post('mobile');
            $email                      = $this->input->post('email');
            $aadhar_no                  = $this->input->post('aadhar_no');
            $marital_status             = $this->input->post('marital_status');
            $pan_no                     = $this->input->post('pan_no');
            $profession                 = $this->input->post('profession');
            $employer_name              = $this->input->post('employer_name');
            $annual_income              = $this->input->post('annual_income');
            $relationship_with_student  = $this->input->post('relationship_with_student');
            $fk_classId                 = $this->input->post('fk_classId');
            $redirect_enabled           ="false";
            $redirect_url = base_url('website/emisuccess');
            $data = array();
            if($student_name==""){
               $data['error'] = array('error' => "student_name required",'code'=>404);
            }elseif ($fk_studId==""){
               $data['error'] = array('error' => "fk_studId Required",'code'=>404);
            }elseif ($planId=="") {
               $data['error'] = array('error' => "planId Required ",'code'=>404);
            }elseif ($paymentType=="") {
               $data['error'] = array('error' => "paymentType Required ",'code'=>404);
            }elseif ($payAmount=="") {
               $data['error'] = array('error' => "payAmount Required ",'code'=>404);
            }elseif ($planvalue=="") {
               $data['error'] = array('error' => "planvalue Required ",'code'=>404);
            }elseif ($student_dob=="") {
               $data['error'] = array('error' => "student_dob Required ",'code'=>404);
            }elseif ($course_id=="") {
               $data['error'] = array('error' => "course_id Required ",'code'=>404);
            }elseif ($requested_tenure=="") {
               $data['error'] = array('error' => "requested_tenure Required ",'code'=>404);
            }elseif ($applicant_name=="") {
               $data['error'] = array('error' => "applicant_name Required ",'code'=>404);
            }elseif ($applicant_dob=="") {
               $data['error'] = array('error' => "applicant_dob Required ",'code'=>404);
            }elseif ($mobile=="") {
               $data['error'] = array('error' => "mobile Required ",'code'=>404);
            }elseif ($email=="") {
               $data['error'] = array('error' => "email Required ",'code'=>404);
            }elseif ($aadhar_no=="") {
               $data['error'] = array('error' => "aadhar_no Required ",'code'=>404);
            }elseif ($marital_status=="") {
               $data['error'] = array('error' => "marital_status Required ",'code'=>404);
            }elseif ($profession=="") {
               $data['error'] = array('error' => "profession Required ",'code'=>404);
            }elseif ($employer_name=="") {
               $data['error'] = array('error' => "employer_name Required ",'code'=>404);
            }elseif ($annual_income=="") {
               $data['error'] = array('error' => "annual_income Required ",'code'=>404);
            }elseif ($relationship_with_student=="") {
               $data['error'] = array('error' => "relationship_with_student Required ",'code'=>404);
            }elseif ($fk_classId=="") {
               $data['error'] = array('error' => "fk_classId Required ",'code'=>404);
            }else{
                    $paymentdata = array(
                                            'student_name'              => $student_name,
                                            'student_dob'               => date("d-m-Y", strtotime($student_dob)),
                                            'course_id'                 => $course_id,
                                            'branch_id'                 => 2222,
                                            'requested_amount'          => $payAmount,
                                            'requested_tenure'          => $requested_tenure,
                                            'student_reference_no'      => 1111,
                                            'applicant_name'            => $applicant_name,
                                            'applicant_gender'          => $applicant_gender, 
                                            'applicant_dob'             => date("d-m-Y", strtotime($applicant_dob)),
                                            'mobile'                    => $mobile,
                                            'email'                     => $email,
                                            'aadhar_no'                 => $aadhar_no,
                                            'marital_status'            => $marital_status,
                                            'pan_no'                    => $pan_no,
                                            'profession'                => $profession,
                                            'employer_name'             => $employer_name,
                                            'annual_income'             => $annual_income,
                                            'relationship_with_student' => $relationship_with_student,
                                            'redirect_url'              => $redirect_url,
                                            'instituteId'               => 1111,
                                            'redirect_enabled'          => $redirect_enabled,
                                            'fk_studId'                 => $fk_studId,
                                            'planId'                    => $planId,
                                            'paymentType'               => $paymentType,
                                                        
                      );

                      $res = $this->regModel->emiapplicationform($paymentdata);
                      if($res ==1){
                      $paymentdata = http_build_query($paymentdata);
                      $url = "https://pay.financepeer.co/uat/partner/pay/lead-create/";

                      $ch = curl_init();
                      $getUrl = $url."?".$paymentdata;
                      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                      curl_setopt($ch, CURLOPT_URL, $getUrl);
                      curl_setopt($ch, CURLOPT_TIMEOUT, 80);
                      $output = curl_exec($ch);
                      curl_close($ch);
                      $output  = json_decode($output);
                      if($output){
                      if($output->Status=="SUCCESS"){
                        $applicationStatus = array(
                          'applicationStatus'=>1
                        );
                        $this->regModel->update_applicationStatus($applicationStatus,$studId);

                        $insert_log_payment_data = array(
                          'usr_firstname'   => $this->input->post('usr_firstname'),
                          'usr_lastname'    => $this->input->post('usr_lastname'),
                          'usr_email'       => $this->input->post('email'),
                          'usr_mobile_no'   => $this->input->post('mobile'),
                          'payAmount'       => $this->input->post('payAmount'),
                          'fk_studId'       => $studId,
                          'paystatus'       => "pending",
                          'planId'          => $planId,
                          'paystatusId'     => 2, //success if 1
                          'paymentType'     => $paymentType,
                          'fk_monthId'      => 11
                        );

                        $res = $this->regModel->insert_log_payment_data($insert_log_payment_data);
                        if($res==1) {

                          $redirectUrl = $output->redirectUrl;
                          $data['error'] = array('redirectUrl' => $redirectUrl,'code'=>200);

                        } else {
                                         
                          $data['error'] = array('error' => "redirect_url Failed !",'code'=>404);
                        }
                        
                      }else{

                         $data['error'] = array('error' => "redirect_url Failed !",'code'=>404);
                      }

                  }else{
                      $data['error'] = array('error' => "No response from Api ",'code'=>404);
                  }
              }
           }

           $this->response($data, REST_Controller::HTTP_OK);

       }
  }


?>