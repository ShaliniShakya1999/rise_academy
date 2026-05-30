<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| ============================================================
| URI ROUTING
| ============================================================
*/

$route['default_controller']  = 'Layout';
$route['404_override']        = '';
$route['translate_uri_dashes'] = FALSE;

// ----- Public pages -----
$route['job']            = 'layout/jobs';
$route['resume-builder'] = 'layout/home';
$route['about']     = 'layout/about';
$route['privacy']   = 'layout/privacy';
$route['templates'] = 'layout/templates';
$route['jobs']                 = 'layout/jobs';
$route['internship']           = 'layout/internship';
$route['resume-checker']      = 'layout/resume_checker';
$route['project-submission']   = 'layout/project_submission';
$route['courses']              = 'layout/courses';
$route['courses/(:any)']       = 'layout/courses/$1';
$route['contact']              = 'layout/contact';

// ----- Auth -----
$route['register'] = 'auth/register';
$route['login']    = 'auth/login';
$route['logout']   = 'auth/logout';

// ----- Wishlist -----
$route['wishlist']                 = 'wishlist/index';
$route['wishlist/toggle']          = 'wishlist/toggle';
$route['wishlist/remove/(:num)']   = 'wishlist/remove/$1';

// ----- User Dashboard / Resume -----
$route['dashboard']            = 'resume/dashboard';
$route['resume/create/(:num)'] = 'resume/create/$1';
$route['resume/edit']          = 'resume/edit';
$route['resume/edit/(:num)']   = 'resume/edit/$1';
$route['resume/save/(:num)']   = 'resume/save/$1';
$route['resume/delete/(:num)'] = 'resume/delete/$1';
$route['resume/upload_logo']   = 'resume/upload_logo';


// ----- User account (dashboard shell) -----
$route['profile']          = 'user/profile';
$route['account/settings'] = 'user/settings';
$route['cover-letter']     = 'user/cover_letter';

// ----- Admin (Phase 4) -----
$route['admin']                 = 'admin/dashboard';
$route['admin/analytics']       = 'admin/analytics';
$route['admin/users']           = 'admin/users';
$route['admin/resumes']         = 'admin/resumes';
$route['admin/templates']       = 'admin/templates';
$route['admin/content']         = 'admin/content';
$route['admin/ai']              = 'admin/ai';
$route['admin/subscriptions']   = 'admin/subscriptions';
$route['admin/reports']         = 'admin/reports';
$route['admin/settings']        = 'admin/settings';
$route['admin/security']        = 'admin/security';
$route['projects/admin/revenue']     = 'projects/admin/revenue';

// ----- Project Submission Panel (New) -----
$route['projects/login']             = 'projects/auth/login';
$route['projects/register']          = 'projects/auth/register';
$route['projects/logout']            = 'projects/auth/logout';
$route['projects/forgot_password']   = 'projects/auth/forgot_password';
$route['projects/reset_password']    = 'projects/auth/reset_password';
$route['projects/admin']             = 'projects/admin/index';
$route['projects/admin/internships'] = 'projects/admin/internships';
$route['projects/admin/add_internship'] = 'projects/admin/add_internship';
$route['projects/admin/delete_internship/(:num)'] = 'projects/admin/delete_internship/$1';
$route['projects/admin/applications'] = 'projects/admin/applications';
$route['projects/admin/users']        = 'projects/admin/users';
$route['projects/admin/change_password'] = 'projects/admin/admin_change_password';
$route['projects/admin/project_submissions'] = 'projects/admin/project_submissions';
$route['projects/admin/approve_certificate_project/(:num)'] = 'projects/admin/approve_certificate_project/$1';
$route['projects/admin/reject_certificate_project/(:num)'] = 'projects/admin/reject_certificate_project/$1';
$route['projects/admin/approve_user/(:num)'] = 'projects/admin/approve_user/$1';
$route['projects/admin/update_status/(:num)'] = 'projects/admin/update_status/$1';
$route['projects/admin/delete/(:num)']        = 'projects/admin/delete/$1';
$route['projects/admin/internship_videos/(:num)'] = 'projects/admin/internship_videos/$1';
$route['projects/admin/add_internship_video/(:num)'] = 'projects/admin/add_internship_video/$1';
$route['projects/admin/delete_internship_video/(:num)/(:num)'] = 'projects/admin/delete_internship_video/$1/$2';
$route['projects/admin/manage_videos'] = 'projects/admin/manage_videos';
$route['projects/user']              = 'projects/user/index';
$route['projects/user/submit']       = 'projects/user/submit';
$route['projects/user/submit_certificate_project'] = 'projects/user/submit_certificate_project';
$route['projects/user/chat']         = 'projects/user/chat';
$route['projects/user/calendar']     = 'projects/user/calendar';
$route['projects/user/faq']          = 'projects/user/faq';
$route['projects/user/applications'] = 'projects/user/applications';
$route['projects/user/learning']     = 'projects/user/learning';
$route['projects/user/learning/(:num)'] = 'projects/user/learning/$1';
$route['projects/user/webinars']     = 'projects/user/webinars';
$route['projects/user/add_comment']  = 'projects/user/add_comment';

// ----- Setup (one-time, delete after seeding) -----
$route['setup/seed']            = 'setup/seed';




