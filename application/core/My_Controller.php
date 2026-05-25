<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * Render a view inside the chosen layout.
     *
     * @param string $view    View path (e.g. "resume/dashboard")
     * @param array  $data    View data
     * @param string $layout  Layout file (default = "layout", auth pages use "auth_layout")
     */
    public function loadview($view, $data = [], $layout = 'layout')
    {
        $this->load->view($layout, [
            'view'   => $view,
            'data'   => $data,
            'layout' => $layout,
        ]);
    }

    protected function require_login()
    {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Please login to continue.');
            redirect('login');
            exit;
        }
    }

    protected function require_admin()
    {
        $this->require_login();
        if ((int) $this->session->userdata('role_id') !== 1) {
            show_error('Access denied. Admins only.', 403);
            exit;
        }
    }

    protected function current_user_id()
    {
        return (int) $this->session->userdata('user_id');
    }
}




