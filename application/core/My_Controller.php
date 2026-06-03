<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        // Context switching of active user session variables based on directory path
        $router = &$this->router;
        $directory = $router->directory;

        if ($this->session->userdata('logged_in')) {
            if (strpos((string)$directory, 'projects') !== false || strpos((string)$directory, 'learning') !== false) {
                if ($this->session->userdata('projects_user_id')) {
                    $this->session->set_userdata([
                        'user_id'   => $this->session->userdata('projects_user_id'),
                        'role_id'   => $this->session->userdata('projects_role_id'),
                        'full_name' => $this->session->userdata('projects_full_name'),
                        'email'     => $this->session->userdata('projects_email'),
                    ]);
                }
            } else {
                if ($this->session->userdata('website_user_id')) {
                    $this->session->set_userdata([
                        'user_id'   => $this->session->userdata('website_user_id'),
                        'role_id'   => $this->session->userdata('website_role_id'),
                        'full_name' => $this->session->userdata('website_full_name'),
                        'email'     => $this->session->userdata('website_email'),
                    ]);
                }
            }
        }
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

    protected function require_login($portal = 'website')
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('portal_type') !== $portal) {
            $this->session->set_flashdata('error', 'Please login to continue.');
            if ($portal === 'projects') {
                redirect('projects/login');
            } else {
                redirect('login');
            }
            exit;
        }
    }

    protected function require_admin($portal = 'website')
    {
        $this->require_login($portal);
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
