<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   class Teacher extends CI_Controller
   {
       
       public function index()
       {
           $this->load->view('teacherlogin');
           //echo "Hello";
       }
       
           public function teacher_login()
       {
           
           if (isset($_POST['submit'])) {
               
               $this->form_validation->set_error_delimiters('<span>', '</span>');
               $this->form_validation->set_rules('teacherMobile', 'Teacher Mobile', 'trim|required|numeric|greater_than[0]|max_length[10]');
               $this->form_validation->set_rules('teacherPass', 'Teacher Password', "trim|required");
               $this->form_validation->set_rules('teacherClass', 'Select Class', "trim|required");
               $this->form_validation->set_rules('remember', 'remember', "trim");
               if ($this->form_validation->run() == FALSE) {
                   
                   $this->load->view('login');
               } else {
                   $teacherMobile = $this->input->post('teacherMobile');
                   $teacherPass   = $this->input->post('teacherPass');
                   $teacherClass   = $this->input->post('teacherClass');
                   $data          = array(
                       'teacherMobile' => $teacherMobile,
                       'teacherPass' => sha1($teacherPass),
                       'teacherClass'=>$teacherClass
                   );
                   
                   // remember me
                   if (!empty($this->input->post("remember"))) {
                       setcookie("teacherMobile", $teacherMobile, time() + (10 * 365 * 24 * 60 * 60));
                       setcookie("teacherPass", $teacherPass, time() + (10 * 365 * 24 * 60 * 60));
                   } else {
                       setcookie("teacherMobile", "");
                       setcookie("teacherPass", "");
                   }
                   $result = $this->teacherModel->check_login_data_teacher($data);
                   if ($result == 1) {
                       
                       $data['check_exist_success'] = array(
                           'error' => "Login Successfully !"
                       );
                       $this->load->view('teacherlogin', $data);
                       
                   } else {
                       
                       $data['error'] = array(
                           'error' => "you entered wrong password or mobile number !"
                       );
                       $this->load->view('teacherlogin', $data);
                   }
                   
                   
               }
           } else {
               
               $this->load->view('teacherlogin');
           }
       }
       public function teacher_ragister()
       {
           $data['selectedClass'] = $this->teacherModel->selectedClass();
           return $this->load->view('teacherragister', $data);
       }
       
       public function teacher_dash_view()
       {
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $usersession = $this->session->userdata('usersession');
               $usersession_id        = $usersession['0']['teacherId'];
               $data['count_student'] = $this->teacherModel->allcated_count_student($usersession_id);
               $this->load->view('teacherdash', $data);
           } else {
               redirect('teacher-login');
           }
           
       }
       
       public function logout()
       {
           
           $usersession = $this->session->userdata('usersession');
           
           if ($this->session->userdata('usersession')) {
               $data = array(
                   'logstatus' => 0
               );
               $this->db->where('teacherEmail', $usersession[0]['teacherEmail']);
               $res = $this->db->update('tbl_teacher', $data);
               $this->session->unset_userdata('usersession');
               $this->session->sess_destroy();
               redirect('teacher/index', 'refresh');
           } else {
               redirect('teacher/index', 'refresh');
           }
           
       }
       
       
       //START FROM 
       
       public function viewteacher()
       {
           $usersession = $this->session->userdata('usersession');
           if (!empty($usersession)) {
               if ($usersession[0]['adminRole'] == 1) {
                   if ($this->session->userdata('usersession')) {
                       $teacher_session           = $usersession['0']['teacherId'];
                       $data['view_live_session'] = $this->teacherModel->session_teacher_id($teacher_session);
                    //   echo '<pre>'; print_r($data['view_live_session']);
                       
                       $this->load->view('view_livesession', $data);
                       
                   } else {
                       redirect('teacher-login');
                   }
               }
           } else {
               redirect('teacher-login');
           }
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
                       $live_id = $this->input->post('live_id');
                       //print_r($live_id);
                       $result  = $this->teacherModel->liveiddeleted($live_id);
                       
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
       
       public function liveedit()
       {
           
           $usersession = $this->session->userdata('usersession');
           $fkclassId   = $usersession['0']['teacherClass'];
           if ($this->session->userdata('usersession')) {
               if ($usersession[0]['adminRole'] == 1) {
                   
                   if (isset($_POST['submit'])) {
                       $usersession    = $this->session->userdata('usersession');
                       $usersession_id = $usersession['0']['teacherId'];
                       
                       $fkclassId = $usersession['0']['teacherClass'];
                       
                       $this->form_validation->set_error_delimiters('<span>', '</span>');
                       $this->form_validation->set_rules('fk_batchId', 'Batch name', 'trim|required');
                       $this->form_validation->set_rules('microsoft_link', 'Microsoft link', 'trim|required');
                       $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
                       $this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
                       $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
                       $this->form_validation->set_rules('end_time', 'End date', 'trim|required');
                       $this->form_validation->set_rules('fk_planId', 'Package Name', 'trim|required');
                       $live_id = $this->input->post('live_id');
                       //echo '<pre>'; print_r($live_id);die;
                       
                       if ($this->form_validation->run() == FALSE) {
                           $data['selectedClass']   = $this->teacherModel->selectedClass();
                           $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                           $data['selectedsubject'] = $this->teacherModel->selectedsubject();
                           $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                           $data['updatedata']      = $this->teacherModel->edit_teacher($live_id);
                           
                           $this->load->view('edit_livesession', $data);
                           //  echo "validation error";
                       } else {
                           
                           $fk_batchId     = $this->input->post('fk_batchId');
                           $microsoft_link = $this->input->post('microsoft_link');
                           $start_date     = $this->input->post('start_date');
                           $start_time     = $this->input->post('start_time');
                           $end_date       = $this->input->post('end_date');
                           $end_time       = $this->input->post('end_time');
                           $live_id        = $this->input->post('live_id');
                           $teacher_id     = $this->input->post('teacher_id');
                           $fk_planId      = $this->input->post('fk_planId');
                           $res_teacher    = $this->teacherModel->checkteacher_successful_student_id($usersession_id, $fkclassId, $fk_batchId, $fk_planId);
                           
                           
                           if (empty($res_teacher)) {
                               $data['error']           = array(
                                   'error' => "You have no class assigment !"
                               );
                               $data['selectedClass']   = $this->teacherModel->selectedClass();
                               $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                               $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                               $data['updatedata']      = $this->teacherModel->edit_teacher($live_id);
                               $this->load->view('edit_livesession', $data);
                           } else {
                               $check_class_package = $this->teacherModel->cheackpresentclass($usersession_id, $fkclassId, $fk_batchId, $fk_planId);
                               
                               $data = array(
                                   'fkclassId' => $fkclassId,
                                   'fk_batchId' => $fk_batchId,
                                   'microsoft_link' => $microsoft_link,
                                   'start_date' => $start_date,
                                   'start_time' => $start_time,
                                   'end_date' => $end_date,
                                   'end_time' => $end_time,
                                   'id' => $live_id,
                                   'teacher_id' => $teacher_id,
                                   'fk_planId' => $fk_planId
                               );
                               $res  = $this->teacherModel->update_teacher($data, $live_id);
                               if ($res == 1) {
                                   $data['error']           = array(
                                       'error' => "Live session Updated Successfully !"
                                   );
                                   $data['selectedClass']   = $this->teacherModel->selectedClass();
                                   $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                                   $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                                   $data['updatedata']      = $this->teacherModel->edit_teacher($live_id);
                                   $this->load->view('edit_livesession', $data);
                               } else {
                                   $data['error']           = array(
                                       'error' => "Live session Is not Updated Successfully !"
                                   );
                                   $data['selectedClass']   = $this->teacherModel->selectedClass();
                                   $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                                   $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                                   $data['updatedata']      = $this->teacherModel->edit_teacher($live_id);
                                   $this->load->view('edit_livesession', $data);
                               }
                           }
                           
                       }
                   } else {
                       
                       $live_id                 = $this->uri->segment(3);
                       $data['selectedClass']   = $this->teacherModel->selectedClass();
                       $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                       $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                       $data['selectedsubject'] = $this->teacherModel->selectedsubject();
                       $data['updatedata']      = $this->teacherModel->edit_teacher($live_id);
                       $this->load->view('edit_livesession', $data);
                       
                   }
               }
               
           } else {
               redirect('teacher-login');
           }
           
       }
       
       public function studentlist()
       {
           $usersession = $this->session->userdata('usersession');
           $teacher_session = $usersession['0']['teacherId'];
           if ($this->session->userdata('usersession')) {
               $teacher_session                = $usersession['0']['teacherId'];
               $data['allocated_studentslist'] = $this->teacherModel->view_studentlist($teacher_session);
               
               $this->load->view('studentlist', $data);
           } else {
               redirect('teacher-login');
           }
           
       }
       
       public function livesession()
       {
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               
               $usersession_id          = $usersession['0']['teacherId'];
               $fkclassId               = $usersession['0']['teacherClass'];
               $data['selectedClass']   = $this->teacherModel->selectedClass();
               $data['selectedbatch']   = $this->teacherModel->selectedBatch();
               $data['selectedsubject'] = $this->teacherModel->selectedsubject();
               $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
               $this->load->view('livesession', $data);
               
           } else {
               redirect('teacher-login');
           }
       }
       
       
       
       
       public function insertlive()
       {
           if ($this->session->userdata('usersession')) {
               
               $usersession = $this->session->userdata('usersession');
               
               $usersession_id          = $usersession['0']['teacherId'];
               $fkclassId               = $usersession['0']['teacherClass'];
               $data['selectedClass']   = $this->teacherModel->selectedClass();
               $data['selectedbatch']   = $this->teacherModel->selectedBatch();
               $data['selectedsubject'] = $this->teacherModel->selectedsubject();
               $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
               $fk_batchId              = $this->input->post('fk_batchId');
               $microsoft_link          = $this->input->post('microsoft_link');
               $subjectid               = $this->input->post('subjectid');
               $fk_planId               = $this->input->post('fk_planId');
               
               if (isset($_POST['submit'])) {
                   
                   $this->form_validation->set_error_delimiters('<span>', '</span>');
                   
                   $this->form_validation->set_rules('fk_batchId', 'Batch name', 'trim|required');
                   $this->form_validation->set_rules('microsoft_link', 'Microsoft link', 'trim|prep_url|valid_url|required');
                   $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
                   $this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
                   $this->form_validation->set_rules('end_date', 'End date', 'trim|required');
                   $this->form_validation->set_rules('end_time', 'End date', 'trim|required');
                   $this->form_validation->set_rules('fk_planId', 'Package Name', 'trim|required');
                   
                   if ($this->form_validation->run() == FALSE) {
                       $this->load->view('livesession', $data);
                   } else {
                       
                       $fk_batchId  = $this->input->post('fk_batchId');
                       $fk_planId   = $this->input->post('fk_planId');
                       $res_teacher = $this->teacherModel->checkteacher_successful_student_id($usersession_id, $fkclassId, $fk_batchId, $fk_planId);
                       
                       
                       if (empty($res_teacher)) {
                           $data['error'] = array(
                               'error' => "You have no class assigment !"
                           );
                           $this->load->view('livesession', $data);
                           
                       } else {
                           
                           $check_class_package = $this->teacherModel->cheackpresentclass($usersession_id, $fkclassId, $fk_batchId, $fk_planId);
                           
                           if (!empty($check_class_package)) {
                               $data['error'] = array(
                                   'error' => "already class present !"
                               );
                               $this->load->view('livesession', $data);
                               
                           }
                           
                           else {
                               
                               $fk_batchId     = $this->input->post('fk_batchId');
                               $microsoft_link = $this->input->post('microsoft_link');
                               $start_date     = $this->input->post('start_date');
                               $start_time     = $this->input->post('start_time');
                               $end_date       = $this->input->post('end_date');
                               $end_time       = $this->input->post('end_time');
                               $subjectid      = $this->input->post('subjectid');
                               $fk_planId      = $this->input->post('fk_planId');
                               
                               $data = array(
                                   'fkclassId' => $fkclassId,
                                   'fk_batchId' => $fk_batchId,
                                   'microsoft_link' => $microsoft_link,
                                   'start_date' => $start_date,
                                   'start_time' => $start_time,
                                   'end_date' => $end_date,
                                   'end_time' => $end_time,
                                   'fk_planId' => $fk_planId,
                                   'teacher_id' => $usersession_id,
                                   'subjectid' => $subjectid,
                                   'status' => 1
                                   
                               );
                               $res  = $this->teacherModel->notice($data);
                               
                               if ($res == 1) {
                                   $data['error'] = array(
                                       'error' => "Live Session created Successfully !"
                                   );
                                   $this->load->view('livesession', $data);
                               } else {
                                   $data['error'] = array(
                                       'error' => "Live Session Not created Successfully !"
                                   );
                                   $this->load->view('livesession', $data);
                               }
                               
                               
                           }
                           
                       }
                       
                       
                   }
                   
                   
               }
               
           } else {
               redirect('teacher-login');
           }
           
       }
       
       public function student_homework()
       {
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $teacher_session         = $usersession['0']['studId'];
               $fkclassId               = $usersession['0']['teacherClass'];
               $data['selectedClass']   = $this->teacherModel->selectedClass();
               $data['selectedPackage'] = $this->teacherModel->selectedPackage($fkclassId);
               $this->load->view('student_homework', $data);
               
           } else {
               redirect('teacher-login');
           }
       }
       
       public function teacherfinalform()
       {
           $fktbl_notification_live_class_id = $this->input->post('id');
           $result                           = $this->teacherModel->final_notifications($fktbl_notification_live_class_id);
           $result_live                      = $this->teacherModel->final_notifications_liveteacher_check($fktbl_notification_live_class_id);
           
           
           $fkclassId  = $result['0']['fkclassId'];
           $fk_batchId = $result['0']['fk_batchId'];
           $teacher_id = $result['0']['teacher_id'];
           
           // $data = array(
           //     'fk_notification_live' => $fktbl_notification_live_class_id,
           //     'given_class_status' => 1,
           //     'fkclassId' => $fkclassId,
           //     'fk_batchId' => $fk_batchId,
           //     'teacher_id' => $teacher_id
           
           // );
           
           // $res = $this->teacherModel->teacherform_inserted($data);
           
           
           
           $result = $this->teacherModel->final_notifications($fktbl_notification_live_class_id);
           echo json_encode($result);
           //print_r($result);
           
           // }
           
           
           
       }
       
       public function teacher_attedence()
       {
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $teacher_session         = $usersession['0']['teacherId'];
               $fkclassId               = $usersession['0']['teacherClass'];
               $data['selectedClass']   = $this->teacherModel->selectedClass();
               $data['selectedbatch']   = $this->teacherModel->selectedBatch();
               $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
               $data['selectedmonth']   = $this->teacherModel->selectedmonth();
               $data['selectedday']     = $this->teacherModel->selectedday();
               $this->load->view('teacher_attedence', $data);
           } else {
               redirect('teacher-login');
           }
       }
       
       // public function update_attedence()
       // {
       //     // print_r($_POST);die;
       //     $usersession = $this->session->userdata('usersession');
       //     $teacher_id  = $usersession['0']['teacherId'];
       //     if ($usersession[0]['adminRole'] == 1) {
       
       //         if (isset($_POST['submit'])) {
       
       //             $this->form_validation->set_error_delimiters('<span>', '</span>');
       //             $this->form_validation->set_rules('fkclassId', 'Class name', 'trim|required');
       //             $this->form_validation->set_rules('fk_batchId', 'Batch name', 'trim|required');
       //             $this->form_validation->set_rules('start_date', 'Start date', 'trim|required');
       //             $this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
       
       //             $this->form_validation->set_rules('end_time', 'End date', 'trim|required');
       
       
       //             if ($this->form_validation->run() == FALSE) {
       //                 $data['selectedClass'] = $this->teacherModel->selectedClass();
       //                 $data['selectedbatch'] = $this->teacherModel->selectedBatch();
       //                 $this->load->view('teacher_attedence', $data);
       //             } else {
       //                 // print_r($_POST);die;
       
       //                 $fkclassId  = $this->input->post('fkclassId');
       //                 $fk_batchId = $this->input->post('fk_batchId');
       //                 $start_date = $this->input->post('start_date');
       //                 $start_time = $this->input->post('start_time');
       //                 $end_date   = $this->input->post('end_date');
       
       
       //                 $data = array(
       //                     'start_date' => $start_date,
       //                     'start_time' => $start_time,
       //                     'end_date' => $end_date
       
       //                 );
       //                 $res  = $this->teacherModel->attedence_update($data, $fk_batchId, $fkclassId, $teacher_id);
       
       //                 if ($res == 1) {
       //                     $data['error']         = array(
       //                         'error' => "Live attendance  timing  Updated Successfully !"
       //                     );
       //                     $data['selectedClass'] = $this->teacherModel->selectedClass();
       //                     $data['selectedbatch'] = $this->teacherModel->selectedBatch();
       //                     $this->load->view('teacher_attedence', $data);
       //                 } else {
       //                     $data['error']         = array(
       //                         'error' => "your are abesent plese check  !"
       //                     );
       //                     $data['selectedClass'] = $this->teacherModel->selectedClass();
       //                     $data['selectedbatch'] = $this->teacherModel->selectedBatch();
       //                     $this->load->view('teacher_attedence', $data);
       //                 }
       
       //             }
       
       
       //         }
       //     }
       // }
       
       
       public function update_attedencenotinsert()
       {
           //  echo '<pre>';print_r($_POST);die;
           $usersession = $this->session->userdata('usersession');
           $teacher_id  = $usersession['0']['teacherId'];
           $fkclassId   = $usersession['0']['teacherClass'];
           if ($usersession[0]['adminRole'] == 1) {
               
               if (isset($_POST['submit'])) {
                   
                   $this->form_validation->set_error_delimiters('<span>', '</span>');
                   $this->form_validation->set_rules('fk_batchId', 'Batch name', 'trim|required');
                   $this->form_validation->set_rules('start_time', 'Start time', 'trim|required');
                   $this->form_validation->set_rules('end_time', 'End date', 'trim|required');
                   
                   if ($this->form_validation->run() == FALSE) {
                       $data['selectedClass']   = $this->teacherModel->selectedClass();
                       $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                       $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                       $this->load->view('teacher_attedence', $data);
                   } else {
                       $fk_batchId = $this->input->post('fk_batchId');
                       $start_time = $this->input->post('start_time');
                       $end_time   = $this->input->post('end_time');
                       $fk_planId   = $this->input->post('fk_planId');
                       
                       $dId   = $this->input->post('dId');
                       $mId   = $this->input->post('mId');
                    
                       
                        $get_plan_idwisestudent = $this->teacherModel->plan_idwisestudent($fk_planId,$fkclassId);
                        
                        if($get_plan_idwisestudent)
                        {
                            foreach($get_plan_idwisestudent as $value) {
                                
                               $res = $this->teacherModel->update_student_month($value['fk_studId'],$mId,$dId);
                            }
                            
                       $data = array(
                           'teacher_id' => $teacher_id,
                           'fkclassId' => $fkclassId,
                           'fk_batchId' => $fk_batchId,
                           'start_time' => $start_time,
                           'end_time' => $end_time 
                       );
                       
                       $res = $this->teacherModel->attedence_updatenot_insert($data);
                       if ($res == 1) {
                           $data['error']           = array(
                               'error' => "conducted  live session!"
                           );
                           $data['selectedClass']   = $this->teacherModel->selectedClass();
                           $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                           $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                           $this->load->view('teacher_attedence', $data);
                       } else {
                           $data['error']           = array(
                               'error' => "not conducted such live session !"
                           );
                           $data['selectedClass']   = $this->teacherModel->selectedClass();
                           $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                           $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                           $this->load->view('teacher_attedence', $data);
                       }
                       
                        }
                        else
                        {
                            $data['error']           = array(
                               'error' => "Plese fill the proper Inputs  !"
                           );
                           $data['selectedClass']   = $this->teacherModel->selectedClass();
                           $data['selectedbatch']   = $this->teacherModel->selectedBatch();
                           $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
                           $this->load->view('teacher_attedence', $data);
                        }
                      
   
                   }
                   
                   
               }
           }
       }
       
       
       function attendance()
       {
           $fees_id = $this->uri->segment(3);
           $usersession = $this->session->userdata('usersession');
           if (!empty($usersession)) {
               if ($usersession[0]['adminRole'] == 1) {
                   if ($this->session->userdata('usersession')) {
                       $usersession              = $this->session->userdata('usersession');
                       $teacher_session          = $usersession['0']['teacherId'];
                       $res['student_attedence'] = $this->teacherModel->view_studentlistt($teacher_session, $fees_id);
                       if ($res == 1) {
                           $data['error'] = array(
                               'error' => "Live attendance  timing  Inserted Successfully !"
                           );
                           $this->load->view('student_attendance', $res);
                       } else {
                           $data['error'] = array(
                               'error' => "Live attendance already Exists !"
                           );
                           $this->load->view('student_attendance', $res);
                       }
                       
                       // $this->load->view('student_attendance', $res);
                   } else {
                       redirect('teacher-login');
                   }
               }
           } else {
               redirect('teacher-login');
           }
           
       }
       
       
       
      
       
       public function student_present()
       {
           //echo '<pre>'; print_r($_POST);die;
           
           if ($this->session->userdata('usersession')) {
               
               $usersession     = $this->session->userdata('usersession');
               $teacher_session = $usersession['0']['teacherId'];
               $date            = $this->input->post('date');
               $date_current    = $this->input->post('date_current');
               $batch_id        = $this->input->post('fk_batchId');
               $fk_feesId       = $this->input->post('fk_feesId');
               
               $res = $this->teacherModel->student_present_check($teacher_session, $batch_id, $date_current, $fk_feesId);
               if (empty($res)) {
                   $dataarray = array(
                       array(
                           'student_id' => $_POST['techid'],
                           'student_name' => $_POST['student_name'],
                           'date' => $_POST['date'],
                           'remark' => $_POST['remark'],
                           'fkclass_id' => $_POST['fk_classId'],
                           'teacher_id' => $teacher_session,
                           'date_current' => $_POST['date_current'],
                           'fk_batchId' => $_POST['fk_batchId'],
                           'fk_feesId' => $_POST['fk_feesId']
                           
                           
                       )
                   );
                   foreach ($dataarray as $val) {
                       $ada = array(
                           'student_id' => json_encode($val['student_id']),
                           'student_name' => json_encode($val['student_name']),
                           'remark' => json_encode($val['remark']),
                           'fkclass_id' => json_encode($val['fkclass_id']),
                           'date' => json_encode($val['date']),
                           'date_current' => $val['date_current'],
                           'teacher_id' => $teacher_session,
                           'fk_batchId' => $val['fk_batchId'],
                           'fk_feesId' => $val['fk_feesId']
                       );
                       
                       $result = $this->teacherModel->student_attendance_insert($ada);
                       
                   }
                   if ($result == 1) {
                       $data['error']            = array(
                           'error' => "Student Attendance Crerated Successfully!"
                       );
                       $res['student_attedence'] = $this->teacherModel->view_studentlistt($teacher_session, $fk_feesId);
                       $this->load->view('student_attendance', $res);
                   } else {
                       $data['error'] = array(
                           'error' => "Student Attendance Not Crerated Successfully !"
                       );
                       
                       $res['student_attedence'] = $this->teacherModel->view_studentlistt($teacher_session, $fk_feesId);
                       $this->load->view('student_attendance', $res);
                   }
               } else {
                   $res['student_attedence'] = $this->teacherModel->view_studentlistt($teacher_session, $fk_feesId);
                   $this->load->view('student_attendance', $res);
               }
               
               
           } else {
               redirect('teacher-login');
           }
           
       }
       
       
       public function final_studentlist_attedence()
       {
           $fees_id     = $this->uri->segment(3);
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $teacher_session                   = $usersession['0']['teacherId'];
               $data['final_student_abb_present'] = $this->teacherModel->final_student_abb_present($teacher_session, $fees_id);
               
               $this->load->view('final_studentlist_attedence', $data);
           } else {
               redirect('teacher-login');
           }
       }
       
       public function insert_homework_allocated()
       {
            $usersession = $this->session->userdata('usersession');
            $fkclassId   = $usersession['0']['teacherClass'];
   
           if (isset($_POST['submit']) && ($_FILES['upload_filess'])) {
               $this->form_validation->set_error_delimiters("<span>", "</span>");
               $this->form_validation->set_rules('fk_package_id', 'Package name', 'trim|required');
               $this->form_validation->set_rules('fk_class_id', 'Package name', 'trim|required');
               $this->form_validation->set_rules('start_time', 'Start name', 'trim|required');
               $this->form_validation->set_rules('description', 'Description', 'trim|required');
               if ($this->form_validation->run() == false) {
                   $data['selectedClass']   = $this->teacherModel->selectedClass();
                   $data['selectedPackage'] = $this->teacherModel->selectedPackage($fkclassId);
                   $this->load->view('student_homework', $data);
               }
           } else {
               echo "Bye";
           }
           
           
       }
       
       public function registration_form()
       {
           // echo '<pre>'; print_r($_POST);die;
           if (isset($_POST['submit'])) {
               $this->form_validation->set_error_delimiters("<span>", "</span>");
               $this->form_validation->set_rules("teacherName", "Teacher Name", "trim|required");
               $this->form_validation->set_rules("teacherMobile", "Teacher Mobile", "trim|required");
               $this->form_validation->set_rules("teacherEmail", "Teacher E-email", "trim|required");
               $this->form_validation->set_rules("teacherPass", "Teacher Password", "trim|required");
               $this->form_validation->set_rules("teacherClass", "Teacher Class", "trim|required");
               $this->form_validation->set_rules("teacherGender", "Teacher Gender", "trim|required");
               if ($this->form_validation->run() == false) {
                   return $this->load->view('teacherragister');
               } else {
                   $teacher_name     = $this->input->post('teacherName');
                   $teacher_mobile   = $this->input->post('teacherMobile');
                   $teacher_email    = $this->input->post('teacherEmail');
                   $teacher_password = $this->input->post('teacherPass');
                   $teacherClass     = $this->input->post('teacherClass');
                   $teacherGender    = $this->input->post('teacherGender');
                   $data             = array(
                       'teacherName' => $teacher_name,
                       'teacherMobile' => $teacher_mobile,
                       'teacherEmail' => $teacher_email,
                       'teacherClass' => $teacherClass,
                       'teacherGender' => $teacherGender,
                       'teacherPass' => SHA1($teacher_password),
                       'adminRole' => 1,
                       'teacherStatus' => 1
                   );
                   $res              = $this->teacherModel->registion($data);
                   
                   if ($res == 1) {
                       $data['error'] = array(
                           'error' => 'Registration Successfully:)'
                       );
                       $this->load->view('teacherragister', $data);
                   } else {
                       $data['error'] = array(
                           'error' => 'Registration Not successfully:('
                       );
                       $this->load->view('teacherragister', $data);
                   }
               }
           } else {
               $this->load->view('teacherragister');
           }
       }
       
       
       public function sub_att()
       {
   
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $usersession_id        = $usersession['0']['teacherId'];
               $teacher_session                = $usersession['0']['teacherId'];
               $res['student_attedence_batch'] = $this->teacherModel->view_studentlist_batch($teacher_session);
               $this->load->view('sub_att', $res);
           } else
           {
             redirect('teacher-login');
           }     
       }
       
       
       public function recap()
       {
           $usersession = $this->session->userdata('usersession');
           
           
           if (isset($usersession) || !empty($usersession)) {
               
               $fk_classId                 = $usersession[0]['teacherClass'];
               $data['listvideouploading'] = $this->teacherModel->listvideouploading($fk_classId);
               // $data['fk_classId'] = $fk_classId; 
               // $data['background_color_id'] = $this->uri->segment(3);
               $vidcreateDT                = date("Y-m-d h:i:s");
               $vidcreateDT                = date('Y-m-01 h:i:s', strtotime($vidcreateDT));
               $param                      = 'valubasededucation';
               $fk_classId                 = $usersession[0]['teacherClass'];
               $endvidcreateDT             = date("Y-m-t", strtotime($vidcreateDT));
               $data['gmdovbe']            = $this->teacherModel->get_month_data_of_value_based_eductaion($vidcreateDT, $param, $endvidcreateDT, $fk_classId);
               
               $this->load->view('recap', $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
       }
       
       
       public function vedic_learn_recap()
       {
           
           $usersession = $this->session->userdata('usersession');
           
           if (isset($usersession) || !empty($usersession)) {
               
               $monthId    = $this->uri->segment(3);
               $dayId      = $this->uri->segment(4);
               $fk_classId = $this->uri->segment(5);
               $vidId      = base64_decode($this->uri->segment(6));
               $his        = $this->uri->segment(7);
               $studId     = $usersession[0]['teacherId'];
               
               
               if ($vidId > 0) {
                   
                   $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_recap_vidId($dayId, $monthId, $fk_classId, $vidId, $studId);
               } else {
                   $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_by_default_recap($dayId, $monthId, $fk_classId, $studId);
               }
               
               $data['get_day_sessions'] = $this->teacherModel->get_day_sessions_vid_recap($dayId, $monthId, $fk_classId, $studId);
               
               
               if ($vidId == "" || empty($vidId)) {
                   if (!empty($get_day_sessions_vid)) {
                       $vidId = $get_day_sessions_vid[0]['vidId'];
                   }
               } else {
                   $vidId = $vidId;
               }
               
               $data['monthId']    = $monthId;
               $data['dayId']      = $dayId;
               $data['fk_classId'] = $fk_classId;
               $data['vidId']      = $vidId;
               if ($vidId > 0) {
                   
                   if (!empty($get_day_sessions_vid)) {
                       $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                   } else {
                       
                       $data['youtubelinks'] = "";
                   }
               } else {
                   
                   if (!empty($get_day_sessions_vid)) {
                       
                       $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                       
                   } else {
                       
                       $data['youtubelinks'] = "";
                   }
               }
               
               $data['background_color_id'] = 9;
               
               $data['last_session_running'] = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
               
               $this->load->view('vedic_learn_recap', $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
           
       }
       
       //learning page  start here 
       
       public function vedic_learn()
       {
           $usersession = $this->session->userdata('usersession');
           
           if (isset($usersession) || !empty($usersession)) {
               
               $monthId    = $this->uri->segment(3);
               $dayId      = $this->uri->segment(4);
               $fk_classId = $this->uri->segment(5);
               $vidId      = base64_decode($this->uri->segment(6));
               $his        = $this->uri->segment(7);
               $studId     = $usersession[0]['teacherId'];
               
               
               if ($his != "") {
                   
                   $data['get_day_sessions'] = $this->teacherModel->get_day_sessions($dayId, $monthId, $fk_classId, $studId);
                   
                   $data['background_color_id'] = $this->uri->segment(8);
                   $last_session_running        = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
                   if (!empty($last_session_running)) {
                       $data['youtubelinks'] = $last_session_running[0]['videoId'];
                       $string               = $last_session_running[0]['videoId'];
                   } else {
                       $data['youtubelinks'] = "";
                       $string               = "";
                   }
                   
                   $vidId              = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
                   $data['vidId']      = $vidId;
                   $data['monthId']    = $monthId;
                   $data['dayId']      = $dayId;
                   $data['fk_classId'] = $fk_classId;
                   
               } else {
                   
                  
                   
                   if ($vidId > 0) {
                       // $data['background_color_id'] = $this->uri->segment(8);
                       
                       $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid($dayId, $monthId, $fk_classId, $vidId, $studId);
                   } else {
                        
                       //   $data['background_color_id'] = $this->uri->segment(6);
                       $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_by_default($dayId, $monthId, $fk_classId, $studId);
                   }
                   
                   
                 
                   
                   $data['get_day_sessions'] = $this->teacherModel->get_day_sessions($dayId, $monthId, $fk_classId, $studId);
                   
                     
                   
                   
                   if ($vidId == "" || empty($vidId)) {
                       if (!empty($get_day_sessions_vid)) {
                           $vidId = $get_day_sessions_vid[0]['vidId'];
                       }
                   } else {
                       $vidId = $vidId;
                   }
                   
                   $data['monthId']    = $monthId;
                   $data['dayId']      = $dayId;
                   $data['fk_classId'] = $fk_classId;
                   $data['vidId']      = $vidId;
                   if ($vidId > 0) {
                       // echo "i am here............";
                       if (!empty($get_day_sessions_vid)) {
                           $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                       } else {
                           
                           $data['youtubelinks'] = "";
                       }
                   } else {
                       // echo "i am here..";
                       if (!empty($get_day_sessions_vid)) {
                           
                           $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                           
                       } else {
                           
                           $data['youtubelinks'] = "";
                       }
                   }
               }
               
               
               $data['last_session_running'] = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
               
               $data['background_color_id'] = 2;
               
               
               $this->load->view('vediclearn', $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
           
       }
       // DASHBOARD START HERE
       
       public function vedic_dash()
       {
           $usersession = $this->session->userdata('usersession');
           
           if (isset($usersession) || !empty($usersession)) {
               
               $fk_classId                  = $usersession[0]['teacherClass'];
               $data['listvideouploading']  = $this->teacherModel->listvideouploading($fk_classId);
               $data['fk_classId']          = $fk_classId;
               $data['background_color_id'] = $this->uri->segment(2);
               
               $vidcreateDT     = date("Y-m-d h:i:s");
               $vidcreateDT     = date('Y-m-01 h:i:s', strtotime($vidcreateDT));
               $param           = 'valubasededucation';
               $fk_classId      = $usersession[0]['teacherClass'];
               $endvidcreateDT  = date("Y-m-t", strtotime($vidcreateDT));
               $data['gmdovbe'] = $this->teacherModel->get_month_data_of_value_based_eductaion($vidcreateDT, $param, $endvidcreateDT, $fk_classId);
               
               $data['last_session_running'] = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
               
               $this->load->view('vedicdash', $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
       }
       
       public function substudentlist()
       {
           // $usersession                    = $this->session->userdata('usersession');
           // $teacher_session                = $usersession['0']['teacherId'];
           // $res['student_attedence_batch'] = $this->teacherModel->view_studentlist_batch($teacher_session);
           // $this->load->view('substudentlist', $res);
   
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $teacher_session                = $usersession['0']['teacherId'];
               $teacher_class                 = $usersession[0]['teacherClass'];
               $res['student_attedence_batch'] = $this->teacherModel->view_studentlist_batch($teacher_session,$teacher_class);
               $this->load->view('substudentlist', $res);
           } else
           {
             redirect('teacher-login');
           }    
   
       }
   
       public function studentListsub_attdence()
       {
           
           $fees_id = $this->uri->segment(3);
           
           $usersession = $this->session->userdata('usersession');
           if (!empty($usersession)) {
               if ($usersession[0]['adminRole'] == 1) {
                   if ($this->session->userdata('usersession')) {
                       $usersession              = $this->session->userdata('usersession');
                       $teacher_session          = $usersession['0']['teacherId'];
                       $res['student_list_response'] = $this->teacherModel->view_studentlistt($teacher_session, $fees_id);
                       $this->load->view('studentlist', $res);
                       
                      
                   } else {
                       redirect('teacher-login');
                   }
               }
           } else {
               redirect('teacher-login');
           }
           
       }
   
       public function view_teacher_attedence()
       {
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $usersession_id        = $usersession['0']['teacherId'];
               $data['teacher_attdence_logs'] = $this->teacherModel->teacher_logs($usersession_id);
               $this->load->view('view_teacher_attedence',$data);
           } else
           {
             redirect('teacher-login');
           }      
       }
   
       public function view_locking_days()
       {
           
          $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $teacher_session                = $usersession['0']['teacherId'];
               $teacher_class                 = $usersession[0]['teacherClass'];
               $res['student_locking_batch'] = $this->teacherModel->student_locking_days($teacher_session,$teacher_class);
               $this->load->view('student_locking', $res);
           } else
           {
             redirect('teacher-login');
           }    
           
       }
   
       public function view_locking_days_attedence()
       {
           $fees_id = $this->uri->segment(3);
           
           $usersession = $this->session->userdata('usersession');
           if (!empty($usersession)) {
               if ($usersession[0]['adminRole'] == 1) {
                   if ($this->session->userdata('usersession')) {
                       $usersession              = $this->session->userdata('usersession');
                       $teacher_session          = $usersession['0']['teacherId'];
                       $res['student_list_response_locking'] = $this->teacherModel->student_locking_days_attedence($teacher_session,$fees_id);
                       $this->load->view('student_locking_attedence_show', $res);
                       
                   } else {
                       redirect('teacher-login');
                   }
               }
           } else {
               redirect('teacher-login');
           }
           
       }
   
   
       public function teacher_update()
       {
           // echo '<pre>'; print_r($_POST);die;
           $teacher_id      = $this->input->post('teacher_id');
           $teacherEmail    = $this->input->post('teacherEmail');
           $teacherMobile   = $this->input->post('teacherMobile');
           $teacherPass     = $this->input->post('teacherPass');
           $teacherClass    = $this->input->post('teacherClass');
           $teacherGender   = $this->input->post('teacherGender');
           $teacherName     = $this->input->post('teacherName');
           $usr_landline    = $this->input->post('usr_landline');
           $usr_firstname   = $this->input->post('usr_firstname');
           $usr_add1        = $this->input->post('usr_add1');
           $usr_add1        = $this->input->post('usr_add1');
           $usr_city        = $this->input->post('usr_city');
           $usr_city        = $this->input->post('usr_city');
           $usr_state       = $this->input->post('usr_state');
           $usr_country     = $this->input->post('usr_country');
           $studentAltMobile   = $this->input->post('studentAltMobile');
           $religion           = $this->input->post('religion');
           $caste              = $this->input->post('caste');
           $sub_caste              = $this->input->post('sub_caste');
           $pre_school         = $this->input->post('pre_school');
           $teacherPass   = $this->input->post('teacherPass');
           $teacherClass   = $this->input->post('teacherClass');
           $mother_tounge   = $this->input->post('mother_tounge');
           $teacherGender   = $this->input->post('teacherGender');
           $teacherName   = $this->input->post('teacherName');
           $adhar_name   = $this->input->post('adhar_name');
           $religion   = $this->input->post('religion');
           $usr_lastname   = $this->input->post('usr_lastname');
           $usr_add2   = $this->input->post('usr_add2');
           $usr_state   = $this->input->post('usr_state');
         
   
           $data = array(
               'teacherEmail'         => $teacherEmail,
               'teacherMobile'        => $teacherMobile,
               'teacherPass'          => $teacherPass,
               'teacherClass'         => $teacherClass,
               'teacherGender'        => $teacherGender,
               'teacherName'          => $teacherName,
               'usr_landline'         => $usr_landline,
               'usr_firstname'        => $usr_firstname,
               'usr_lastname'        => $usr_lastname,
               'usr_add1'             => $usr_add1,
               'usr_add1'             => $usr_add1,
               'usr_city'             => $usr_city,
               'usr_state'            => $usr_state,
               'usr_country'          => $usr_country,
               'studentAltMobile'     => $studentAltMobile,
               'religion'             => $religion,
               'sub_caste'                => $sub_caste,
               'caste'                => $caste,
               'pre_school'           => $pre_school,
               'teacherPass'        => $teacherPass,
               'teacherClass'        => $teacherClass,
               'mother_tounge'        => $mother_tounge,
               'teacherGender'        => $teacherGender,
               'teacherName'        => $teacherName,
               'adhar_name'        => $adhar_name,
               'usr_add2'        => $usr_add2,
               'usr_state'        => $usr_state
           );
   
           $res  = $this->teacherModel->teacher_profile_update($teacher_id,$data);
   
           // echo '<pre>'; print_r($res);die;
           if ($res == 1) {
   
               $this->session->set_flashdata('msg', 'profile updated successfully');
               redirect('teacher/teacher_profile');
            
           } else {
                   echo "ERRRO";
               }
       }
       
       public function teacher_profile()
       {
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $teacher_session                = $usersession['0']['teacherId'];
   
               $res['teacher_info'] = $this->teacherModel->teacher_full_info($teacher_session);
               $this->load->view('teacherprofile', $res);
           } else
           {
             redirect('teacher-login');
           }    
   
       }
       
        /// common video
   
       public function common_video()
       {
           // echo "Hello";  
   
           $usersession = $this->session->userdata('usersession');
           
           if (isset($usersession) || !empty($usersession)) {
               
               $monthId    = $this->uri->segment(3);
               $dayId      = $this->uri->segment(4);
               $fk_classId = $this->uri->segment(5);
               $vidId      = base64_decode($this->uri->segment(6));
               $his        = $this->uri->segment(7);
               $studId     = $usersession[0]['teacherId'];
               
               
               if ($his != "") {
                   
                   $data['get_day_sessions'] = $this->teacherModel->get_day_sessions($dayId, $monthId, $fk_classId, $studId);
                   
                   $data['background_color_id'] = $this->uri->segment(8);
                   $last_session_running        = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
                   if (!empty($last_session_running)) {
                       $data['youtubelinks'] = $last_session_running[0]['videoId'];
                       $string               = $last_session_running[0]['videoId'];
                   } else {
                       $data['youtubelinks'] = "";
                       $string               = "";
                   }
                   
                   $vidId              = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
                   $data['vidId']      = $vidId;
                   $data['monthId']    = $monthId;
                   $data['dayId']      = $dayId;
                   $data['fk_classId'] = $fk_classId;
                   
               } else {
                   
                   if ($vidId > 0) {
                       // $data['background_color_id'] = $this->uri->segment(8);
                       $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_com($dayId, $monthId, $fk_classId, $vidId, $studId);
                   } else {
                       //   $data['background_color_id'] = $this->uri->segment(6);
                       $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_by_default_com($dayId, $monthId, $fk_classId, $studId);
                   }
                   
                   $data['get_day_sessions'] = $this->teacherModel->get_day_sessions_com($dayId, $monthId, $fk_classId, $studId);
                   
                   
                   if ($vidId == "" || empty($vidId)) {
                       if (!empty($get_day_sessions_vid)) {
                           $vidId = $get_day_sessions_vid[0]['vidId'];
                       }
                   } else {
                       $vidId = $vidId;
                   }
                   
                   $data['monthId']    = $monthId;
                   $data['dayId']      = $dayId;
                   $data['fk_classId'] = $fk_classId;
                   $data['vidId']      = $vidId;
                   if ($vidId > 0) {
                       // echo "i am here............";
                       if (!empty($get_day_sessions_vid)) {
                           $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                       } else {
                           
                           $data['youtubelinks'] = "";
                       }
                   } else {
                       // echo "i am here..";
                       if (!empty($get_day_sessions_vid)) {
                           
                           $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                           
                       } else {
                           
                           $data['youtubelinks'] = "";
                       }
                   }
               }
               
               
               $data['last_session_running'] = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
               
               // $data['background_color_id'] = 2;
               // $this->load->view('vediclearn');
               $this->load->view('common_video' , $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
           
           
   
   
       }
       
       //teacher chat code start from here//
       
         public function chat_studentlist_package()
       {
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               $teacher_session                = $usersession['0']['teacherId'];
               $teacher_class                 = $usersession[0]['teacherClass'];
               $res['chat_studentlist_package'] = $this->teacherModel->chat_studentlist_package($teacher_session,$teacher_class);
                $this->load->view('chat_substudentlist', $res);
           } else
           {
             redirect('teacher-login');
           }    
    }
   
       public function chat_studentListsub_attdence()
       {
           
           $fees_id = $this->uri->segment(3);
           $usersession = $this->session->userdata('usersession');
           if (!empty($usersession)) {
               if ($usersession[0]['adminRole'] == 1) {
                   if ($this->session->userdata('usersession')) {
                       $usersession              = $this->session->userdata('usersession');
                       $teacher_session          = $usersession['0']['teacherId'];
                       $result['chat_student_list_response'] = $this->teacherModel->chat_studentListsub_attdence($teacher_session, $fees_id);
                       $this->load->view('chat_parent', $result);
                       
                       // return redirect()->to("teacher/get_chat_information_student/".$fees_id/0);
                       // redirect('/teacher/get_chat_information_student/'.$fees_id/0, 'refresh');
                       
                   } else {
                       redirect('teacher-login');
                   }
               }
           } else {
               redirect('teacher-login');
           }
           
       }
   
   
   
   
     // one student infomation return
        public function get_chat_information_student()
       {
            $fees_id                              = $this->uri->segment(3);
            $student_id                           = $this->uri->segment(4);
            $readMsg = 2;
            $usersession                          = $this->session->userdata('usersession');
            $teacher_session                      = $usersession['0']['teacherId'];
            $result['group_chat_get_info']        = $this->teacherModel->group_chat_get_info($fees_id);
            $result['chat_student_list_response'] = $this->teacherModel->chat_studentListsub_attdence($teacher_session, $fees_id);
            $result['chat_full_info_student']     = $this->teacherModel->chat_to_student($student_id,$teacher_session,$fees_id);
            $result['all_chat_data']              = $this->teacherModel->get_chat_Particular_student_allchat($student_id,$teacher_session);
            $this->teacherModel->readMessage($student_id,$readMsg);
            $this->load->view('chat_parent' , $result);
       }
       
     
    public function chat_with_student_msg()
   {
   //  echo '<pre>'; print_r($_POST);die;
     
     $usersession    = $this->session->userdata('usersession');
   
     if(!empty($usersession)){
   
       $studId        = $this->input->post('studId');
       $msg           = $this->input->post('message');
       $fk_teachId    = $this->input->post('fk_teachId');
       $fees_id    = $this->input->post('fees_id');
       date_default_timezone_set('Asia/Kolkata');
       $currentDate   = date('Y-m-d h:i:s');
       $res = $this->teacherModel->start_chat_to_student($fk_teachId,$studId,$msg,$currentDate,$fees_id);
      
       foreach ($res as $key => $value) {
                   $dataArray = $value;
       }
     }
       echo json_encode($dataArray);
   }
       
   public function uploadchatimg_teacher()
   {
       //  echo '<pre>'; print_r($_POST); 
     $usersession    = $this->session->userdata('usersession');
   
     if(!empty($usersession)){
   
          $chatimgup     = $_FILES['chatimgup']['name'];
   
           if(!empty($chatimgup)){
   
           $studId        = $this->input->post('studId');
           $msg           = $this->input->post('message');
           $teacherId    = $this->input->post('teacherId');
           
            $config['upload_path']          = './uploads/chatimgup/';
           $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
            $config['max_size']             = 2084;
   
   
   
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
   
            if ( ! $this->upload->do_upload('chatimgup'))
             {
                     $data['error'] = $this->upload->display_errors();
   
                     echo json_encode($data);
             }
             else
             {
               $data = array('chatimgup' => $this->upload->data());  
               $chatimgup = $data['chatimgup']['file_name'];
                     
                date_default_timezone_set('Asia/Kolkata');
                 $currentDate   = date('Y-m-d h:i:s');
                 $res = $this->teacherModel->start_chat_with_img_student($teacherId,$studId,$msg,$currentDate,$chatimgup);
       
                 foreach ($res as $key => $value) {
                             $dataArray = $value;
                 }
                 echo json_encode($dataArray);
             }
   
      }
   
     }else{
   
       redirect('teacher-login','refresh');
   
     } 
     
   }
   
   
   public function errorpage()
   {
       $this->load->view('errorpage');
   }
   
   //homework controller start
   
public function homework_package_list(){
 $usersession                    = $this->session->userdata('usersession');
 $teacher_session                = $usersession['0']['teacherId'];
 $res['student_attedence_batch'] = $this->teacherModel->view_studentlist_batch_homework($teacher_session);
 $this->load->view('homework_package_list', $res);
}

public function upload_multiple()
 {
      $feesId = $this->uri->segment(3);
    $data['fees_ids']   = array(
                        'feesId' => $feesId             
                   );
    $this->load->view('upload_multiple', $data);
    
//   $this->load->view("upload_multiple");
 }
 
 public function homework_package_list_after_check_view(){
 $usersession                    = $this->session->userdata('usersession');
 $teacher_session                = $usersession['0']['teacherId'];
 $res['student_attedence_batch'] = $this->teacherModel->view_studentlist_batch_homework($teacher_session);
 $this->load->view('after_homeworK_package', $res);
}


public function view_list_homework()
{
    
        $fees_id = $this->uri->segment(3);
        $usersession = $this->session->userdata('usersession');
        if (!empty($usersession)) {
            if ($usersession[0]['adminRole'] == 1) {
                if ($this->session->userdata('usersession')) {
                    $usersession              = $this->session->userdata('usersession');
                    $teacher_session          = $usersession['0']['teacherId'];
                    $res['view_list_homework_all'] = $this->teacherModel->view_studentlistt($teacher_session, $fees_id);
                    $this->load->view('view_homowork_allocated_list_student_list', $res);
                    
                } else {
                    redirect('teacher-login');
                }
            }
        } else {
            redirect('teacher-login');
        }
 
}


public function student_homework_particular()
{
    
  $fk_studId =     $this->uri->segment(3);
  $usersession    = $this->session->userdata('usersession');
  if(!empty($usersession)) {
       $get_course_info = $this->teacherModel->get_course_infomation_t($fk_studId);
       $class_id = $get_course_info[0]['fk_classId'];
       $plan_id  = $get_course_info[0]['fk_feesId'];
       $data['student_homeworks'] = $this->teacherModel->get_student_homeworks_t($class_id,$plan_id,$fk_studId);
       $this->load->view('student_response_homework', $data);
  } else {
    redirect('teacher-login');
 }

}


public function student_backword_repose_homework_checkup()
{
      $start_time  = $this->input->post('start_time');
      
      $res = $this->teacherModel->get_download_homework_t($start_time);
     
      
      $dowloadData = array();
     
        if($res){
              foreach($res as $download_homewok)
              {
                  
                   $filepath1 =  base_url('uploads/homework_allocated_student/').str_replace(' ', '_', $download_homewok['allocated_file']);
            
                //   $res =  $this->zip->read_file($filepath1);
                //   print_r($res);
                
                 $this->zip->add_data($filepath1);
                
              }
            //   $filename = "backup.zip";
               $this->zip->download(''.time().'.zip');
        }
                    
          
    
    
   
   
   
   
}


public function teacher_remark_to_student(){
    
   $student_id   = $this->input->post('student_id');
  
   $remark   = $this->input->post('remark');
  
       $data = array(
            'remark' => $remark
        );
        
        $res  = $this->teacherModel->update_remark_homework_on_student($student_id,$data);
         if($res==1){
             echo json_encode(array('success_msg' => 'Remark Updated successfully'));
          }
          else
          {
             echo json_encode(array('success_msg' => 'Remark not successfully'));
          }

        
   
}
 
 
 //sojwal code
 
 
  public function livesessionFree()
{
    
    if(isset($_POST['submit']))
    {
        
          $this->form_validation->set_error_delimiters('<span>', '</span>');
          $this->form_validation->set_rules('microsoft_link', 'link', 'trim|required');
          $this->form_validation->set_rules('start_date', 'start_date', "trim|required");
          $this->form_validation->set_rules('start_time', 'start_time', "trim|required");
          $this->form_validation->set_rules('end_date', 'end_date', "trim|required");
          $this->form_validation->set_rules('end_time', 'end_time', "trim|required");
          if ($this->form_validation->run() == FALSE)
          {     
              $data['getnoticelist'] = $this->regModel->getnoticelist(); 
              $data['get_live_stream'] = $this->teacherModel->get_live_stream();
              $this->load->view('livesessionFree',$data);
          }
          else
          {
            
              $microsoft_link    = $this->input->post('microsoft_link');
              $start_date        = $this->input->post('start_date');
              $start_time        = $this->input->post('start_time');
              $end_date          = $this->input->post('end_date');
              $end_time          = $this->input->post('end_time');
            
              $data = array(  
                      'microsoft_link'   => $microsoft_link , 
                      'start_date'       => $start_date , 
                      'start_time'       => $start_time , 
                      'end_date'         => $end_date , 
                      'status'           => "1" , 
                      'end_time'         => $end_time  
                  );
              
             $res = $this->teacherModel->add_live_stream($data);
                if($res==1){
                  $data['error']        = array('error' => "Data Inserted Successfully !");
                  $data['getstudlist']  = $res;
                  $data['get_live_stream'] = $this->teacherModel->get_live_stream();
                  $this->load->view('livesessionFree',$data);

                }else{
                    $data['error']         = array('error' => "Data not Inserted Successfully !");
                    $data['getstudlist']   = $res;
                    $data['get_live_stream'] = $this->teacherModel->get_live_stream();
                    $data['getnoticelist'] = $this->regModel->getnoticelist();
                    $this->load->view('livesessionFree',$data);
                }
                
          }        
        
        
    }else{
           $usersession = $this->session->userdata('usersession');
           if ($this->session->userdata('usersession')) {
               
               $usersession_id          = $usersession['0']['teacherId'];
               $fkclassId               = $usersession['0']['teacherClass'];
               $data['selectedClass']   = $this->teacherModel->selectedClass();
               $data['selectedbatch']   = $this->teacherModel->selectedBatch();
               $data['selectedsubject'] = $this->teacherModel->selectedsubject();
               $data['selectedpackage'] = $this->teacherModel->selectedpackage($fkclassId);
               $data['get_live_stream'] = $this->teacherModel->get_live_stream();
               $this->load->view('livesessionFree', $data);
               
           } else {
               redirect('teacher-login');
           }
           
    }
}



public function deleteliveStream()
{
    $usersession = $this->session->userdata('usersession');

      if(isset($_POST['submit']))
        {

              $this->form_validation->set_error_delimiters('<span>', '</span>');
              $this->form_validation->set_rules('id', 'id', "trim|required|numeric|greater_than[0]");
              if ($this->form_validation->run() == FALSE)
              {     
                   $data['get_live_stream'] = $this->teacherModel->get_live_stream(); 
                   $this->load->view('livesessionFree',$data);
              }
              else
              {
                $id         = $this->input->post('id');
                $result     = $this->teacherModel->deleteliveStream($id);
                 if($result==1){
                    $data['error']       = array('error' => "Id Deleted Successfully !");
                    $data['get_live_stream'] = $this->teacherModel->get_live_stream();
                    $this->load->view('livesessionFree',$data);
                 }else{
                    $data['error']       = array('error' => "Id Not Deleted Successfully !");
                    $data['get_live_stream'] = $this->teacherModel->get_live_stream(); 
                    $this->load->view('livesessionFree',$data);
                 }
              }         

        }else{  
                  $data['get_live_stream'] = $this->teacherModel->get_live_stream();
                  $this->load->view('livesessionFree',$data);
        }
      
}


       
 //end sojwal code
 
 
  public function multiple_files(){
      
         $usersession = $this->session->userdata('usersession');
          $this->load->library('upload');
          $image = array();
          $ImageCount = count($_FILES['allocated_file']['name']);
          
         
       if($ImageCount >= 1){
            for($i = 0; $i < $ImageCount; $i++){
                $FILENAMES = $_FILES['file']['name'] = $_FILES['allocated_file']['name'][$i];
                $_FILES['file']['type']       = $_FILES['allocated_file']['type'][$i];
                $_FILES['file']['tmp_name']   = $_FILES['allocated_file']['tmp_name'][$i];
                $_FILES['file']['error']      = $_FILES['allocated_file']['error'][$i];
                $_FILES['file']['size']       = $_FILES['allocated_file']['size'][$i];
                $config['encrypt_name'] = TRUE;
    
    
                // File upload configuration
                 $usersession = $this->session->userdata('usersession');
                 $class_id    = $usersession[0]['teacherClass'];
                $home_title          = $this->input->post('home_title');
                $description         = $this->input->post('description');
                $start_time          = $this->input->post('start_time');
                $end_time            = $this->input->post('end_time');
                $fk_feesId            = $this->input->post('fk_feesId');
               
                $uploadPath = './uploads/multiple_pics_loading/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
    
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                $res = 0;
                  
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    
                    //  $uploadImgData[$i]['allocated_file'] = $imageData['allocated_file'];
    
                  
                   $get_statudents = $this->teacherModel->check_student_package($fk_feesId, $class_id);
              
                      foreach($get_statudents as $studentshomework)
                      {
                         $res = $this->teacherModel->homework_allocated_test($home_title,$description,$start_time,$end_time, $imageData['file_name'], $fk_feesId, $class_id,$studentshomework['fk_studId']);
                        
                      }
                  
                  
                  
                }
                
            }
              
              if($res==1){
                 echo json_encode(array('success' => 'Homework allocated successfully'));
              }
              else
              {
                 echo json_encode(array('success' => 'Homework not  allocated successfully'));
              }
              
          
             if(!empty($uploadImgData)){
                // Insert files data into the database
                // $this->pages_model->multiple_images($uploadImgData);              
            }
        
      }
      else{
          
          //if no image found else
                 $usersession = $this->session->userdata('usersession');
                 $class_id    = $usersession[0]['teacherClass'];
                 $home_title          = $this->input->post('home_title');
                 $description         = $this->input->post('description');
                 $start_time          = $this->input->post('start_time');
                 $end_time            = $this->input->post('end_time');
                 $fk_feesId            = $this->input->post('fk_feesId');
                 $res = $this->teacherModel->homework_allocated_nofile_uploaded($home_title,$description,$start_time,$end_time,$fk_feesId, $class_id);
                 
             if($res==1){
                 echo json_encode(array('success' => 'Homework allocated successfully'));
              }
              else
              {
                 echo json_encode(array('success' => 'Homework not  allocated successfully'));
              }
      }
        
        
  }

   
       
       
public function course_three()
{

  $usersession = $this->session->userdata('usersession');
           
           if (isset($usersession) || !empty($usersession)) {
               
               $fk_classId                  = $usersession[0]['teacherClass'];
               $data['listvideouploading']  = $this->teacherModel->listvideouploading($fk_classId);
               $data['fk_classId']          = $fk_classId;
               $data['background_color_id'] = $this->uri->segment(2);
               
               $vidcreateDT     = date("Y-m-d h:i:s");
               $vidcreateDT     = date('Y-m-01 h:i:s', strtotime($vidcreateDT));
               $param           = 'valubasededucation';
               $fk_classId      = $usersession[0]['teacherClass'];
               $endvidcreateDT  = date("Y-m-t", strtotime($vidcreateDT));
               $data['gmdovbe'] = $this->teacherModel->get_month_data_of_value_based_eductaion($vidcreateDT, $param, $endvidcreateDT, $fk_classId);
               
               $data['last_session_running'] = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
               
               $this->load->view('course_three', $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
           

}


public function course_seven()
{

        $usersession = $this->session->userdata('usersession');
           
           if (isset($usersession) || !empty($usersession)) {
               
               $fk_classId                  = $usersession[0]['teacherClass'];
               $data['listvideouploading']  = $this->teacherModel->listvideouploading($fk_classId);
               $data['fk_classId']          = $fk_classId;
               $data['background_color_id'] = $this->uri->segment(2);
               
               $vidcreateDT     = date("Y-m-d h:i:s");
               $vidcreateDT     = date('Y-m-01 h:i:s', strtotime($vidcreateDT));
               $param           = 'valubasededucation';
               $fk_classId      = $usersession[0]['teacherClass'];
               $endvidcreateDT  = date("Y-m-t", strtotime($vidcreateDT));
               $data['gmdovbe'] = $this->teacherModel->get_month_data_of_value_based_eductaion($vidcreateDT, $param, $endvidcreateDT, $fk_classId);
               
               $data['last_session_running'] = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
               
               $this->load->view('course_seven', $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
           



}


public function vedic_learn_three()
       {
           $usersession = $this->session->userdata('usersession');
           
           if (isset($usersession) || !empty($usersession)) {
               
               $monthId    = $this->uri->segment(3);
               $dayId      = $this->uri->segment(4);
               $fk_classId = $this->uri->segment(5);
               $vidId      = base64_decode($this->uri->segment(6));
               $his        = $this->uri->segment(7);
               $studId     = $usersession[0]['teacherId'];
               
               
               if ($his != "") {
                   
                   $data['get_day_sessions'] = $this->teacherModel->get_day_sessions_three($dayId, $monthId, $fk_classId, $studId);
                   
                   $data['background_color_id'] = $this->uri->segment(8);
                   $last_session_running        = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
                   if (!empty($last_session_running)) {
                       $data['youtubelinks'] = $last_session_running[0]['videoId'];
                       $string               = $last_session_running[0]['videoId'];
                   } else {
                       $data['youtubelinks'] = "";
                       $string               = "";
                   }
                   
                   $vidId              = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
                   $data['vidId']      = $vidId;
                   $data['monthId']    = $monthId;
                   $data['dayId']      = $dayId;
                   $data['fk_classId'] = $fk_classId;
                   
               } else {
                   
                  
                   
                   if ($vidId > 0) {
                       // $data['background_color_id'] = $this->uri->segment(8);
                       
                       $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_three($dayId, $monthId, $fk_classId, $vidId, $studId);
                   } else {
                        
                       //   $data['background_color_id'] = $this->uri->segment(6);
                       $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_by_default_three($dayId, $monthId, $fk_classId, $studId);
                   }
                   
                   
                 
                   
                   $data['get_day_sessions'] = $this->teacherModel->get_day_sessions_three($dayId, $monthId, $fk_classId, $studId);
                   
                     
                   
                   
                   if ($vidId == "" || empty($vidId)) {
                       if (!empty($get_day_sessions_vid)) {
                           $vidId = $get_day_sessions_vid[0]['vidId'];
                       }
                   } else {
                       $vidId = $vidId;
                   }
                   
                   $data['monthId']    = $monthId;
                   $data['dayId']      = $dayId;
                   $data['fk_classId'] = $fk_classId;
                   $data['vidId']      = $vidId;
                   if ($vidId > 0) {
                       // echo "i am here............";
                       if (!empty($get_day_sessions_vid)) {
                           $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                       } else {
                           
                           $data['youtubelinks'] = "";
                       }
                   } else {
                       // echo "i am here..";
                       if (!empty($get_day_sessions_vid)) {
                           
                           $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                           
                       } else {
                           
                           $data['youtubelinks'] = "";
                       }
                   }
               }
               
               
               $data['last_session_running'] = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
               
               $data['background_color_id'] = 2;
               
               
               $this->load->view('vedic_learn_three', $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
           
       }
       
       
       
       public function vedic_learn_seven()
       {
           $usersession = $this->session->userdata('usersession');
           
           if (isset($usersession) || !empty($usersession)) {
               
               $monthId    = $this->uri->segment(3);
               $dayId      = $this->uri->segment(4);
               $fk_classId = $this->uri->segment(5);
               $vidId      = base64_decode($this->uri->segment(6));
               $his        = $this->uri->segment(7);
               $studId     = $usersession[0]['teacherId'];
               
               
               if ($his != "") {
                   
                   $data['get_day_sessions'] = $this->teacherModel->get_day_sessions_seven($dayId, $monthId, $fk_classId, $studId);
                   
                   $data['background_color_id'] = $this->uri->segment(8);
                   $last_session_running        = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
                   if (!empty($last_session_running)) {
                       $data['youtubelinks'] = $last_session_running[0]['videoId'];
                       $string               = $last_session_running[0]['videoId'];
                   } else {
                       $data['youtubelinks'] = "";
                       $string               = "";
                   }
                   
                   $vidId              = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);
                   $data['vidId']      = $vidId;
                   $data['monthId']    = $monthId;
                   $data['dayId']      = $dayId;
                   $data['fk_classId'] = $fk_classId;
                   
               } else {
                   
                   if ($vidId > 0) {
                       
                       $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_seven($dayId, $monthId, $fk_classId, $vidId, $studId);
                   } else {
                        
                       $get_day_sessions_vid = $this->teacherModel->get_day_sessions_vid_by_default_seven($dayId, $monthId, $fk_classId, $studId);
                   }
         
                   $data['get_day_sessions'] = $this->teacherModel->get_day_sessions_seven($dayId, $monthId, $fk_classId, $studId);
                   
            
                   if ($vidId == "" || empty($vidId)) {
                       if (!empty($get_day_sessions_vid)) {
                           $vidId = $get_day_sessions_vid[0]['vidId'];
                       }
                   } else {
                       $vidId = $vidId;
                   }
                   
                   $data['monthId']    = $monthId;
                   $data['dayId']      = $dayId;
                   $data['fk_classId'] = $fk_classId;
                   $data['vidId']      = $vidId;
                   if ($vidId > 0) {
                     
                       if (!empty($get_day_sessions_vid)) {
                           $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                       } else {
                           
                           $data['youtubelinks'] = "";
                       }
                   } else {
                      
                       if (!empty($get_day_sessions_vid)) {
                           
                           $data['youtubelinks'] = "https://player.vimeo.com/video/" . $get_day_sessions_vid[0]['vimeoId'];
                           
                       } else {
                           
                           $data['youtubelinks'] = "";
                       }
                   }
               }
               
               
               $data['last_session_running'] = $this->teacherModel->last_session_running($usersession[0]['teacherId'], $fk_classId);
               
               $data['background_color_id'] = 2;
               
           
               $this->load->view('vedic_learn_seven', $data);
               
           } else {
               
               $this->load->view('teacherlogin');
               
           }
           
       }
       
       
public function student_backword_repose_homework_checkup_downloadoneby()
{
      $start_time  = $this->input->post('start_time');
      $data['homework_one_byone_download'] = $this->teacherModel->get_download_homework_t($start_time);
      $this->load->view('teacher_onebyone_student_homwork', $data);
 
}

// report controller 



public function substudentlist_reportcard()
    {
         $usersession                    = $this->session->userdata('usersession');
         $teacher_session                = $usersession['0']['teacherId'];
         $res['student_attedence_batch'] = $this->teacherModel->view_studentlist_batch_report($teacher_session);
         $this->load->view('substudentlist_reportcard', $res);
    }




        public function studentListsub_attdence_report()
    {
        
        $fees_id = $this->uri->segment(3);
        
        $usersession = $this->session->userdata('usersession');
        if (!empty($usersession)) {
            if ($usersession[0]['adminRole'] == 1) {
                if ($this->session->userdata('usersession')) {
                    $usersession              = $this->session->userdata('usersession');
                    $teacher_session          = $usersession['0']['teacherId'];
                    $res['student_list_response'] = $this->teacherModel->view_studentlistt_report($teacher_session, $fees_id);
                    $this->load->view('studentlist_report', $res);
                    
                    
                   
                } else {
                    redirect('teacher-login');
                }
            }
        } else {
            redirect('teacher-login');
        }
        
    }
   

        public function children_report()
    {
        $studId             = $this->uri->segment(3);
        $data = $this->teacherModel->report_student_data($studId);
        echo '<pre>'; print_r($data);
        print_r($data[0]['first_que']);
        
       
        
    }



    public function children_report_delete()
    {
        $studId             = $this->uri->segment(3);
        $data['check_user'] = $this->teacherModel->report_student_data_delete($studId);
        redirect('teacher/studentListsub_attdence_report/'.$feesId); 
        
    }


     public function create_reportcard()
    {
       $usersession = $this->session->userdata('usersession');
       
         if($usersession[0]['adminRole'] == 1)
         {
                $fk_studId    = $this->input->post('fk_studId');      
                $studentName  = $this->input->post('studentName');      
                $usr_dob      = $this->input->post('usr_dob');      
                $packageName  = $this->input->post('packageName');
                $className    = $this->input->post('className');
                $feesId       = $this->input->post('feesId');
                
                $data['stud_data'] = array(
                    'fk_studId'      =>$fk_studId,
                    'studentName'    =>$studentName,
                    'usr_dob'        =>$usr_dob,
                    'packageName'    =>$packageName,
                    'className'      =>$className,
                    'feesId'         =>$feesId
                    );
                
                $data['cards'] = $this->teacherModel->get_gradecards();
                $this->load->view('create_reportcard', $data);    
                     
         }else{
             redirect('teacher-login');
         }
    }


       public function insert_reportcard()
    {
       
        $usersession = $this->session->userdata('usersession');
        $teacher_session          = $usersession['0']['teacherId'];
        $teacherClass             = $usersession['0']['teacherClass'];
        if($usersession){
            $teacher_id        = $usersession[0]['teacherId'];
            $fk_studId         = $this->input->post('fk_studId');      
            $studentName       = $this->input->post('studentName');      
                $usr_dob       = $this->input->post('usr_dob');      
                $packageName   = $this->input->post('packageName');
                $className     = $this->input->post('className');
                
                $first_que     = $this->input->post('first_que');
                $second_que    = $this->input->post('second_que');
                $third_que     = $this->input->post('third_que');
                $four_que      = $this->input->post('four_que');
                $five_que      = $this->input->post('five_que');
                $six_que       = $this->input->post('six_que');
                $seven_que     = $this->input->post('seven_que');
                $eight_que     = $this->input->post('eight_que');
                $nine_que      = $this->input->post('nine_que');
                $ten_que       = $this->input->post('ten_que');
                $eleven_que    = $this->input->post('eleven_que');
                $tweele_que    = $this->input->post('tweele_que');
                $threen_que    = $this->input->post('threen_que');
                $english       = $this->input->post('english');
                $maths         = $this->input->post('maths');
                $hindi         = $this->input->post('hindi');
                
                $dev_one       = $this->input->post('dev_one');
                $dev_two       = $this->input->post('dev_two');
                $dev_three     = $this->input->post('dev_three');
                $dev_four      = $this->input->post('dev_four');
                $feesId        = $this->input->post('feesId');
                $remark_one    = $this->input->post('remark_one');
                
                
            
                
                 $data= array(
                    'fk_studId'      =>$fk_studId,
                    'studentName'    =>$studentName,
                    'fk_teacherId'   =>$teacher_id,
                    'usr_dob'        =>$usr_dob,
                    'packageName'    =>$packageName,
                    'first_que'      =>$first_que,
                    'second_que'     =>$second_que,
                    'third_que'      =>$third_que,
                    'four_que'       =>$four_que,
                    'five_que'      =>$five_que,
                    'six_que'       =>$six_que,
                    'seven_que'     =>$seven_que,
                    'eight_que'     =>$eight_que,
                    'nine_que'      =>$nine_que,
                    'ten_que'       =>$ten_que,
                    'eleven_que'    =>$eleven_que,
                    'tweele_que'    =>$tweele_que,
                    'threen_que'    =>$threen_que,
                    'english'       =>$english,
                    'maths'         =>$maths,
                    'hindi'         =>$hindi,
                    'dev_one'       =>$dev_one,
                    'dev_two'       =>$dev_two,
                    'dev_three'     =>$dev_three,
                    'dev_four'      =>$dev_four,
                    'reportcard'    =>1, 
                     'status_ch'    =>2,
                     'remark_one'   =>$remark_one,
                     'className'    =>$teacherClass  
                    );
                    
                
                    
                    $result = $this->teacherModel->inserted_reportcard($data);
                    
                
                    if($result == 1)
                    {
                        $data['error']             = array(
                            'error' => "Report Card Created Successfully!"
                        ); 
                       
                        $data['stud_data'] = array(
                        'fk_studId'      =>$fk_studId,
                        'studentName'    =>$studentName,
                        'usr_dob'        =>$usr_dob,
                        'packageName'    =>$packageName,
                        'className'      =>$className
                        );
                
                         $res['student_list_response'] = $this->teacherModel->view_studentlistt_report($teacher_session, $feesId);
                         $this->session->set_flashdata('msg', 'Created report card Successfully !');
                         redirect('teacher/studentListsub_attdence_report/'.$feesId); 
                         
                        
                    }else{
                        
                        $data['error']             = array(
                            'error' => "Report Card Not created Successfully !"
                        ); 
                       
                        $data['stud_data'] = array(
                        'fk_studId'      =>$fk_studId,
                        'studentName'    =>$studentName,
                        'usr_dob'        =>$usr_dob,
                        'packageName'    =>$packageName
                        );
                
                         $data['cards'] = $this->teacherModel->get_gradecards();
                         $this->load->view('create_reportcard', $data);
                    }
                    
        }else{
            redirect('teacher-login');
        }
    }
    
    
    
     public function second_reportcard_inserted()
    {
       
        $usersession = $this->session->userdata('usersession');
        $teacher_session          = $usersession['0']['teacherId'];
        if($usersession){
                $teacher_id        = $usersession[0]['teacherId'];
                $fk_studId         = $this->input->post('fk_studId');      
                $studentName       = $this->input->post('studentName');      
                $usr_dob       = $this->input->post('usr_dob');      
                $packageName   = $this->input->post('packageName');
                $className     = $this->input->post('className');   
     
                
                $sefirst_que     = $this->input->post('sefirst_que');
                $sesecond_que    = $this->input->post('sesecond_que');
                $sethird_que     = $this->input->post('sethird_que');
                $sefour_que      = $this->input->post('sefour_que');
                $sefive_que      = $this->input->post('sefive_que');
                $sesix_que       = $this->input->post('sesix_que');
                $seseven_que     = $this->input->post('seseven_que');
                $seeight_que     = $this->input->post('seeight_que');
                $senine_que      = $this->input->post('senine_que');
                $seten_que       = $this->input->post('seten_que');
                $seeleven_que    = $this->input->post('seeleven_que');
                $setweele_que    = $this->input->post('setweele_que');
                $sethreen_que    = $this->input->post('sethreen_que');
                $seenglish       = $this->input->post('seenglish');
                $semaths         = $this->input->post('semaths');
                $sehindi         = $this->input->post('sehindi');
                
                $sedev_one       = $this->input->post('sedev_one');
                $sedev_two       = $this->input->post('sedev_two');
                $sedev_three     = $this->input->post('sedev_three');
                $sedev_four      = $this->input->post('sedev_four');
                $feesId          = $this->input->post('feesId');
                $remark_two      = $this->input->post('remark_two');
                
            
                
                 $data= array(
                    'fk_student_id'    =>$fk_studId,
                    'sefirst_que'      =>$sefirst_que,
                    'sesecond_que'     =>$sesecond_que,
                    'sethird_que'      =>$sethird_que,
                    'sefour_que'       =>$sefour_que,
                    'sefive_que'       =>$sefive_que,
                    'sesix_que'        =>$sesix_que,
                    'seseven_que'      =>$seseven_que,
                    'seeight_que'      =>$seeight_que,
                    'senine_que'       =>$senine_que,
                    'seten_que'        =>$seten_que,
                    'seeleven_que'     =>$seeleven_que,
                    'setweele_que'     =>$setweele_que,
                    'sethreen_que'     =>$sethreen_que,
                    'seenglish'        =>$seenglish,
                    'semaths'          =>$semaths,
                    'sehindi'          =>$sehindi,
                    'sedev_one'        =>$sedev_one,
                    'sedev_two'        =>$sedev_two,
                    'sedev_three'      =>$sedev_three,
                    'sedev_four'       =>$sedev_four,
                    'reportcard_secod' =>2,
                    'remark_two'       =>$remark_two,
                    
                    );
                    
                
                    
                    $result = $this->teacherModel->inserted_reportcard_second($data);
                
                    if($result == 1)
                    {
                        $data['error']             = array(
                            'error' => "Report Card Created Successfully!"
                        ); 
                       
                        $data['stud_data'] = array(
                        'fk_studId'      =>$fk_studId,
                        'studentName'    =>$studentName,
                        'usr_dob'        =>$usr_dob,
                        'packageName'    =>$packageName,
                        'className'      =>$className
                        );
                
                         $res['student_list_response'] = $this->teacherModel->view_studentlistt_report($teacher_session, $feesId);
                         $this->session->set_flashdata('msg', 'Created report card Successfully !');
                         redirect('teacher/studentListsub_attdence_report/'.$feesId); 
                         
                        
                    }else{
                        
                        $data['error']             = array(
                            'error' => "Report Card Not created Successfully !"
                        ); 
                       
                        $data['stud_data'] = array(
                        'fk_studId'      =>$fk_studId,
                        'studentName'    =>$studentName,
                        'usr_dob'        =>$usr_dob,
                        'packageName'    =>$packageName
                        );
                
                         $data['cards'] = $this->teacherModel->get_gradecards();
                         $this->load->view('create_reportcard', $data);
                    }
                    
        }else{
            redirect('teacher-login');
        }
    }
    
    //teacher sign
    
    
    public function teacher_signature()
    {
         $this->load->view('teacher_signature');
    }
    
    public function teacher_insert_sig()
    {
           
           $usersession = $this->session->userdata('usersession');
            $this->load->library('upload');
            $image = array();
            $FILENAMES =  $_FILES['file']['name']       = $_FILES['sigh_upload']['name'];
            $_FILES['file']['type']       = $_FILES['sigh_upload']['type'];
            $_FILES['file']['tmp_name']   = $_FILES['sigh_upload']['tmp_name'];
            $_FILES['file']['error']      = $_FILES['sigh_upload']['error'];
            $_FILES['file']['size']       = $_FILES['sigh_upload']['size'];
             $config['encrypt_name'] = TRUE;
            // File upload configuration
            $usersession               = $this->session->userdata('usersession');
            $teacheId                  = $usersession[0]['teacherId'];
            $teacherClass              = $usersession[0]['teacherClass'];
            
            $uploadPath = './uploads/teacher_signs/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|PNG|JPEG';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $res = 0;
            if($this->upload->do_upload('file')){
                $imageData = $this->upload->data();
            }
            $arraydata = array( 
                                             'fk_teacher_id'          => $teacheId,
                                             'fk_class_id'            =>$teacherClass,
                                             'sigh_upload'            => $imageData['file_name']
                                          );
                                          
            $res = $this->teacherModel->inserts_teachersign($arraydata);
            if($res == 1) {
                $this->session->set_flashdata('msg', 'Teacher Signature Inserted Successfully');
                redirect('/teacher/teacher_signature/');
            }else{
                   redirect('/teacher/teacher_signature/');
            }
    }
    
// end


public function children_report_profile()
{
    $studId                   = $this->uri->segment(3);
    $feesId                   = $this->uri->segment(4);
    $data['feesIds']          = array(
                                'feesId' =>$feesId
    );
    $data['first_report']     = $this->teacherModel->get_report_first($studId);
    $this->load->view('report_final', $data);
}

public function children_report_view()
{
    $studId  = $this->uri->segment(3);
    $data['userreport_detail']  = $this->teacherModel->get_reportcardDetail($studId);
    $data['signs']              = $this->teacherModel->getPresipalData();
    $this->load->view('grade_card', $data);
   
}

public function children_report_view_second()
{
    $studId  = $this->uri->segment(3);
    $data['userreport_detail_second']  = $this->teacherModel->get_reportcardDetail_second($studId);
    $data['signs']                     = $this->teacherModel->getPresipalData();
    if(!empty($data['userreport_detail_second']))
    {
    $this->load->view('grade_card_second', $data);
    }else{
        $this->load->view('nocard_gen');
    }
}

public function children_report_deletesemone()
{
    $studId  = $this->uri->segment(3);
    $feesId  = $this->uri->segment(4);
    $res     = $this->teacherModel->delete_reportcardDetail_first($studId);
      if($res == 1) {
                $this->session->set_flashdata('msg', 'Deleted Successfully report card sem-1');
                redirect('/teacher/studentListsub_attdence_report/'.$feesId);
                
            }else{
                  redirect('/teacher/studentListsub_attdence_report/'.$feesId);
                  
            }
}

public function children_report_deletesemtwo()
{
    $studId  = $this->uri->segment(3);
     $feesId  = $this->uri->segment(4);
    $res     = $this->teacherModel->delete_reportcardDetail_two($studId);
      if($res == 1) {
                $this->session->set_flashdata('msg', 'Deleted Successfully report card sem-2');
                redirect('/teacher/studentListsub_attdence_report/'.$feesId);
                
            }else{
                  redirect('/teacher/studentListsub_attdence_report/'.$feesId);
                  
            }
}
       
       
       


   
       
   
      
       
       
       
       
       
   }
   
   ?>