<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists('My_Controller')) {
    include_once APPPATH . 'core/My_Controller.php';
}

class User extends My_Controller
{
    public function profile()
    {
        $this->require_login();
        $this->loadview('user/profile', [
            'page_title'     => 'Profile',
            'use_user_shell' => true,
            'sidebar_active' => 'profile',
        ]);
    }

    public function settings()
    {
        $this->require_login();
        $this->loadview('user/settings', [
            'page_title'     => 'Settings',
            'use_user_shell' => true,
            'sidebar_active' => 'settings',
        ]);
    }

    public function cover_letter()
    {
        $this->require_login();
        $this->loadview('user/cover_letter', [
            'page_title'     => 'Cover Letter',
            'use_user_shell' => true,
            'sidebar_active' => 'cover',
        ]);
    }
}




