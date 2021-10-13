<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 	    = 'website';
$route['about-us'] 				    = 'website/aboutus';
$route['vedic-value/(:any)']	    = 'website/vedic_value/$1';
$route['vedic-dash/(:any)'] 	    = 'website/vedic_dash/$1';
$route['vedic-learn/(:any)']	    = 'website/vedic_learn/$1';
$route['vedic-homework/(:any)']	    = 'website/homework/$1';
$route['chat-with-teacher/(:any)']	= 'website/chat_with_teacher/$1';
$route['nursery-preschoolapp'] 		= 'website/course_1';
$route['educational-app-kids-4-5-year-olds'] = 'website/course_2';
$route['online-learning-app-kids-5-6-year-olds'] = 'website/course_3';
$route['admissions'] 			    = 'website/admissions';
$route['webinar-admissions'] 		= 'website/webinar_admissions';
$route['blog'] 					    = 'website/blog';
$route['how-technology-is-effecting-education'] = 'website/blog_1';
$route['healthy-fruits-for-child'] 	= 'website/blog_2';
$route['preschool-importance-2021'] = 'website/blog_3';
$route['best-online-preschool-classes-for-children-in-pune'] = 'website/blog_4';
$route['gallery'] 			        = 'website/gallery';
$route['vedic-timeline'] 		    = 'website/timeline';
$route['privacy'] 		            = 'website/privacy';
$route['shipment'] 		            = 'website/shipment';
$route['frequently-asked-questions']= 'website/faq';
$route['payment-refund'] 	        = 'website/payment_refund';
$route['terms-conditions'] 	        = 'website/terms_conditions';
$route['login'] 		            = 'website/web_login';
$route['register'] 		            = 'website/contact';
$route['forget-password'] 		    = 'website/forget_password';
$route['otp-verify'] 			    = 'website/otp_verify';
$route['vedicprofile/(:any)']       = 'website/vedicprofile/$1';
$route['admin'] 		            = 'welcome';
$route['vedic-progress-tracker/(:any)'] = 'website/vedic_progress_tracker/$1';
$route['events/(:any)'] 				= 'website/event_details/$1';

$route['report'] 		            = 'website/report_card';
$route['finalreport'] 		        = 'website/finalreport_card';

$route['404_override'] 			= 'website/errorpage';
$route['translate_uri_dashes'] 	= FALSE;
