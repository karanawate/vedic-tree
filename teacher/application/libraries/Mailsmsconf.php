<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mailsmsconf
{

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->config->load("mailsms");
        $this->CI->load->library('smsgateway');
        $this->CI->load->library('mailgateway');
        $this->config_mailsms = $this->CI->config->item('mailsms');
    }

    public function mailsms($send_for, $sender_details, $date = null, $exam_schedule_array = null)
    {

        $send_for = $this->config_mailsms[$send_for];

        $chk_mail_sms =  array("online_classes"=>"online classes",'sms'=>'1','template'=>'1','mail'=>'1' );
        
        if ($send_for == "online_classes") {

                $this->sendOnlineClass($chk_mail_sms, $sender_details, $chk_mail_sms['template']);
            } 

    }

    public function mailsmsalumnistudent($sender_details)
    {
        if ($sender_details['email_value'] == 'yes') {
            $this->CI->mailgateway->sentMailToAlumni($sender_details);
        }
        if ($sender_details['sms_value'] == 'yes') {
            $this->CI->smsgateway->sentSMSToAlumni($sender_details);
        }
    }

    public function sendResult($chk_mail_sms, $exam_result, $template)
    {
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {

            if (!empty($exam_result['exam_result'])) {
                foreach ($exam_result['exam_result'] as $res_key => $res_value) {

                    $detail = array(
                        'student_name'   => $res_value->studentName,
                        'exam_roll_no'   => $res_value->exam_roll_no,
                        'email'          => $res_value->email,
                        'exam'           => $exam_result['exam']->exam,
                        'guardian_phone' => $res_value->guardian_phone,
                        'guardian_email' => $res_value->guardian_email,
                        'app_key'        => $res_value->app_key,
                        'parent_app_key' => $res_value->parent_app_key,
                    );

                    if ($chk_mail_sms['mail'] && $detail['guardian_email'] != "") {

                        $this->CI->mailgateway->sentExamResultMail($detail, $template);
                    }
                    if ($chk_mail_sms['mail'] && $detail['email'] != "") {

                        $this->CI->mailgateway->sentExamResultMailStudent($detail, $template);
                    }
                    if ($chk_mail_sms['sms'] && $detail['guardian_phone'] != "") {
                        $this->CI->smsgateway->sentExamResultSMS($detail, $template);
                    }
                    if ($chk_mail_sms['notification'] && ($detail['parent_app_key'] != "" || $detail['app_key'] != "")) {
                        $this->CI->smsgateway->sentExamResultNotification($detail, $template);
                    }
                }
            }
        }
    }

    public function sendAbsentAttendance($chk_mail_sms, $student_session_array, $date, $template, $subject_attendence)
    {

        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
            $student_result = $this->getAbsentStudentlist($student_session_array);
            if (!empty($student_result)) {

                foreach ($student_result as $student_result_k => $student_result_v) {
                    $detail = array(
                        'date'                => $date,
                        'parent_app_key'      => $student_result_v->parent_app_key,
                        'firstname'           => $student_result_v->firstname,
                        'lastname'            => $student_result_v->lastname,
                        'mobileno'            => $student_result_v->mobileno,
                        'email'               => $student_result_v->email,
                        'father_name'         => $student_result_v->father_name,
                        'father_phone'        => $student_result_v->father_phone,
                        'father_occupation'   => $student_result_v->father_occupation,
                        'mother_name'         => $student_result_v->mother_name,
                        'mother_phone'        => $student_result_v->mother_phone,
                        'guardian_name'       => $student_result_v->guardian_name,
                        'guardian_phone'      => $student_result_v->guardian_phone,
                        'guardian_occupation' => $student_result_v->guardian_occupation,
                        'guardian_email'      => $student_result_v->guardian_email,
                    );
                    if (isset($subject_attendence) && !empty($subject_attendence)) {
                        $detail['time_from']    = $subject_attendence->time_from;
                        $detail['time_to']      = $subject_attendence->time_to;
                        $detail['subject_name'] = $subject_attendence->name;
                        $detail['subject_code'] = $subject_attendence->code;
                        $detail['subject_type'] = $subject_attendence->type;
                    }

                    if ($chk_mail_sms['mail']) {
                        $this->CI->mailgateway->sentAbsentStudentMail($detail, $template);
                    }
                    if ($chk_mail_sms['sms']) {

                        $this->CI->smsgateway->sentAbsentStudentSMS($detail, $template);
                    }
                    if ($chk_mail_sms['notification']) {

                        $this->CI->smsgateway->sentAbsentStudentNotification($detail, $template);
                    }
                }
            }
        }
    }

    public function getAbsentStudentlist($student_session_array)
    {

        $result = $this->CI->regModel->getStudentListBYStudentsessionID($student_session_array);
        if (!empty($result)) {
            return $result;
        }
        return false;
    }

    public function sendHomework($chk_mail_sms, $student_details, $template)
    {

        $student_sms_list          = array();
        $student_email_list        = array();
        $student_notification_list = array();
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
            $class_id      = ($student_details['class_id']);
            $section_id    = ($student_details['section_id']);
            $homework_date = $student_details['homework_date'];
            $submit_date   = $student_details['submit_date'];
            $subject       = $student_details['subject'];
            $student_list  = $this->CI->regModel->getStudentByClassID($class_id);

            if (!empty($student_list)) {
                foreach ($student_list as $student_key => $student_value) {

                    if ($student_value['app_key'] != "") {
                        $student_notification_list[] = array(
                            'app_key'       => $student_value['app_key'],
                            'class'         => $student_value['class'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['studentName'],
                        );
                    }
                    if ($student_value['parent_app_key'] != "") {
                        $student_notification_list[] = array(
                            'app_key'       => $student_value['parent_app_key'],
                            'class'         => $student_value['class'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['studentName'],
                        );
                    }

                    if ($student_value['email'] != "") {
                        $student_email_list[$student_value['email']] = array(
                            'class'         => $student_value['class'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['studentName'],
                        );
                    }
                    if ($student_value['guardian_email'] != "") {
                        $student_email_list[$student_value['guardian_email']] = array(
                            'class'         => $student_value['class'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['studentName'],
                        );
                    }
                    if ($student_value['mobileno'] != "") {
                        $student_sms_list[$student_value['mobileno']] = array(
                            'class'         => $student_value['class'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['studentName'],
                        );
                    }
                    if ($student_value['guardian_phone'] != "") {
                        $student_sms_list[$student_value['guardian_phone']] = array(
                            'class'         => $student_value['class'],
                            'homework_date' => $homework_date,
                            'submit_date'   => $submit_date,
                            'subject'       => $subject,
                            'admission_no'  => $student_value['admission_no'],
                            'student_name'  => $student_value['firstname'] . " " . $student_value['lastname'],
                        );
                    }
                }

                if ($chk_mail_sms['mail']) {

                    if ($student_email_list) {
                        $this->CI->mailgateway->sentHomeworkStudentMail($student_email_list, $template);
                    }
                }

                if ($chk_mail_sms['sms']) {

                    if ($student_sms_list) {
                        $this->CI->smsgateway->sentHomeworkStudentSMS($student_sms_list, $template);
                    }
                }

                if ($chk_mail_sms['notification']) {

                    if (!empty($student_notification_list)) {
                        $this->CI->smsgateway->sentHomeworkStudentNotification($student_notification_list, $template);
                    }
                }
            }
        }
    }

    public function sendOnlineClass($chk_mail_sms, $student_details, $template)
    {

        $student_guardian_sms_list          = array();
        $student_sms_list                   = array();
        $student_email_list                 = array();
        $student_guardian_email_list        = array();
        $student_notification_list          = array();
        $student_guardian_notification_list = array();
        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms'] or $chk_mail_sms['notification']) {
            $class_id     = ($student_details['class_id']);
            $title        = $student_details['title'];
            $date         = $student_details['date'];
            $duration     = $student_details['duration'];
            $student_list = $this->CI->regModel->getStudentByClassID($class_id);
            
            if (!empty($student_list)) {
                foreach ($student_list as $student_key => $student_value) {

                    if ($student_value['studentName'] != "") {
                        $student_guardian_notification_list[] = array(
                            'class'        => $student_value['studentClass'],
                            'title'        => $title,
                            'date'         => $date,
                            'duration'     => $duration,
                            'student_name' => $student_value['studentName'],
                        );
                    }


                    if ($student_value['studentEmail'] != "") {
                        $student_email_list[$student_value['studentEmail']] = array(
                            'title'        => $title,
                            'date'         => $date,
                            'duration'     => $duration,
                            'student_name' => $student_value['studentName'],
                        );
                    }
                    
                    if ($student_value['studentMobile'] != "") {
                        $student_sms_list[$student_value['studentMobile']] = array(
                            'title'        => $title,
                            'date'         => $date,
                            'duration'     => $duration,
                            'student_name' => $student_value['studentName'],
                        );
                    }
                    
                }
// print_r($chk_mail_sms['mail']);
                // die;
                if ($chk_mail_sms['mail']) {
                    if ($student_email_list) {
                        $this->CI->mailgateway->sentOnlineClassStudentMail($student_email_list, $template);
                    }
                    if ($student_guardian_email_list) {
                        $this->CI->mailgateway->sentOnlineClassStudentMail($student_guardian_email_list, $template);
                    }
                }
                if ($chk_mail_sms['sms']) {

                    if ($student_sms_list) {
                        $this->CI->smsgateway->sentOnlineClassStudentSMS($student_sms_list, $template);
                    }
                    if ($student_guardian_sms_list) {
                        $this->CI->smsgateway->sentOnlineClassStudentSMS($student_guardian_sms_list, $template);
                    }
                }
                if ($chk_mail_sms['notification']) {
                    if (!empty($student_notification_list)) {
                        $this->CI->smsgateway->sentOnlineClassStudentNotification($student_notification_list, $template);
                    }

                    if (!empty($student_guardian_notification_list)) {
                        $this->CI->smsgateway->sentOnlineClassStudentNotification($student_guardian_notification_list, $template);
                    }
                }
            }
        }
    }

    public function sendMeeting($chk_mail_sms, $staff_details, $template)
    {

        $staff_sms_list   = array();
        $staff_email_list = array();

        if ($chk_mail_sms['mail'] or $chk_mail_sms['sms']) {

            if (!empty($staff_details)) {
                foreach ($staff_details as $staff_key => $staff_value) {

                    if ($staff_value['email'] != "") {
                        $staff_email_list[$staff_value['email']] = array(
                            'title'       => $staff_value['title'],
                            'date'        => $staff_value['date'],
                            'duration'    => $staff_value['duration'],
                            'employee_id' => $staff_value['employee_id'],
                            'department'  => $staff_value['department'],
                            'designation' => $staff_value['designation'],
                            'name'        => $staff_value['name'],
                            'contact_no'  => $staff_value['contact_no'],
                            'email'       => $staff_value['email'],
                        );
                    }

                    if ($staff_value['contact_no'] != "") {
                        $staff_sms_list[$staff_value['contact_no']] = array(
                            'title'       => $staff_value['title'],
                            'date'        => $staff_value['date'],
                            'duration'    => $staff_value['duration'],
                            'employee_id' => $staff_value['employee_id'],
                            'department'  => $staff_value['department'],
                            'designation' => $staff_value['designation'],
                            'name'        => $staff_value['name'],
                            'contact_no'  => $staff_value['contact_no'],
                            'email'       => $staff_value['email'],
                        );
                    }
                }
                if ($chk_mail_sms['mail']) {
                    if ($staff_email_list) {
                        $this->CI->mailgateway->sentOnlineMeetingStaffMail($staff_email_list, $template);
                    }
                }
                if ($chk_mail_sms['sms']) {
                    if ($staff_sms_list) {
                        $this->CI->smsgateway->sentOnlineMeetingStaffSMS($staff_sms_list, $template);
                    }
                }
            }
        }
    }

}
