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

// ----- Project Submission Panel (New) -----
$route['projects/login']             = 'projects/auth/login';
$route['projects/logout']            = 'projects/auth/logout';
$route['projects/admin']             = 'projects/admin/index';
$route['projects/admin/internships'] = 'projects/admin/internships';
$route['projects/admin/add_internship'] = 'projects/admin/add_internship';
$route['projects/admin/delete_internship/(:num)'] = 'projects/admin/delete_internship/$1';
$route['projects/admin/applications'] = 'projects/admin/applications';
$route['projects/admin/update_status/(:num)'] = 'projects/admin/update_status/$1';
$route['projects/admin/delete/(:num)']        = 'projects/admin/delete/$1';
$route['projects/user']              = 'projects/user/index';
$route['projects/user/submit']       = 'projects/user/submit';
$route['projects/user/chat']         = 'projects/user/chat';
$route['projects/user/calendar']     = 'projects/user/calendar';
$route['projects/user/faq']          = 'projects/user/faq';
$route['projects/user/applications'] = 'projects/user/applications';

// ----- Setup (one-time, delete after seeding) -----
$route['setup/seed']            = 'setup/seed';
