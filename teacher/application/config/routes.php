<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'teacher';
$route['about-us'] 				= 'website/aboutus';
$route['vedic-value/(:any)']	= 'website/vedic_value/$1';
// $route['vedic-dash/(:any)'] 	= 'website/vedic_dash/$1';
$route['vedic-homework/(:any)'] = 'website/homework/$1';
$route['vedic-learn/(:any)']	= 'website/vedic_learn/$1';
$route['course-one'] 			= 'website/course_1';
$route['course-two'] 			= 'website/course_2';
$route['course-three'] 			= 'website/course_3';
$route['blog'] 					= 'website/blog';
$route['blog-one'] 				= 'website/blog_1';
$route['blog-two'] 				= 'website/blog_2';
$route['blog-three'] 			= 'website/blog_3';
$route['gallery'] 			    = 'website/gallery';
$route['vedic-timeline'] 		= 'website/timeline';
$route['login'] 		        = 'website/web_login';
$route['register'] 		        = 'website/contact';
$route['vedicprofile/(:any)']   = 'website/vedicprofile/$1';
$route['forget-password'] 		= 'website/forget_password';
$route['otp-verify'] 			= 'website/otp_verify';
$route['vedic-progress-tracker/(:any)'] = 'website/vedic_progress_tracker/$1';
$route['admin'] 		        = 'welcome';

$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;

// teacher admin routes 

$route['teacher-login'] 		= 'teacher/index';
$route['teacher-register']      = 'teacher/teacher_ragister';
$route['teacher-dash']           = 'teacher/teacher_dash_view';
$route['vedic-dash/(:any)'] 	= 'teacher/vedic_dash/$1';

$route['404_override'] 			= 'teacher/errorpage';