<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| ============================================================
| URI ROUTING
| ============================================================
*/

$route['default_controller']  = 'home';
$route['404_override']        = '';
$route['translate_uri_dashes'] = FALSE;

// ----- Public pages (website/home controller) -----
$route['job']                  = 'website/home/jobs';
$route['resume-builder']       = 'website/home/index';
$route['about']                = 'website/home/about';
$route['privacy']              = 'website/home/privacy';
$route['templates']            = 'website/home/templates';
$route['jobs']                 = 'website/home/jobs';
$route['internship']           = 'website/home/internship';
$route['resume-checker']       = 'website/home/resume_checker';
$route['project-submission']   = 'website/home/project_submission';
$route['courses']              = 'website/home/courses';
$route['courses/(:any)']       = 'website/home/courses/$1';
$route['contact']              = 'website/home/contact';

// ----- Auth -----
$route['register']             = 'website/auth/register';
$route['login']                = 'website/auth/login';
$route['logout']               = 'website/auth/logout';

// ----- Wishlist -----
$route['wishlist']                 = 'website/wishlist/index';
$route['wishlist/toggle']          = 'website/wishlist/toggle';
$route['wishlist/remove/(:num)']   = 'website/wishlist/remove/$1';

// ----- User Dashboard / Resume Builder -----
$route['dashboard']            = 'resume/builder/dashboard';
$route['resume/create/(:num)'] = 'resume/builder/create/$1';
$route['resume/edit']          = 'resume/builder/edit';
$route['resume/edit/(:num)']   = 'resume/builder/edit/$1';
$route['resume/save/(:num)']   = 'resume/builder/save/$1';
$route['resume/delete/(:num)'] = 'resume/builder/delete/$1';
$route['resume/upload_logo']   = 'resume/builder/upload_logo';

// ----- User account (dashboard shell) -----
$route['profile']              = 'website/user/profile';
$route['account/settings']     = 'website/user/settings';
$route['cover-letter']         = 'website/user/cover_letter';

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
$route['projects/admin/revenue'] = 'projects/admin/revenue';

// ----- Project Submission Panel -----
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

// ----- Learning Platform Video Management (Admin) -----
$route['projects/admin/internship_videos/(:num)'] = 'learning/admin/internship_videos/$1';
$route['projects/admin/add_internship_video/(:num)'] = 'learning/admin/add_internship_video/$1';
$route['projects/admin/delete_internship_video/(:num)/(:num)'] = 'learning/admin/delete_internship_video/$1/$2';
$route['projects/admin/manage_videos'] = 'learning/admin/manage_videos';

// ----- Project Submission User Routes -----
$route['projects/user']              = 'projects/user/index';
$route['projects/user/submit']       = 'projects/user/submit';
$route['projects/user/submit_certificate_project'] = 'projects/user/submit_certificate_project';
$route['projects/user/chat']         = 'projects/user/chat';
$route['projects/user/calendar']     = 'projects/user/calendar';
$route['projects/user/faq']          = 'projects/user/faq';
$route['projects/user/applications'] = 'projects/user/applications';

// ----- Learning Platform User Routes -----
$route['projects/user/learning']     = 'learning/user/learning';
$route['projects/user/learning/(:num)'] = 'learning/user/learning/$1';
$route['projects/user/webinars']     = 'learning/user/webinars';
$route['projects/user/add_comment']  = 'learning/user/add_comment';

// ----- Setup (one-time, delete after seeding) -----
$route['setup/seed']            = 'setup/seed';
