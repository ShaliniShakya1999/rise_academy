<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class Auth extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('core/User_model', 'user_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('portal_type') === 'website') {
            redirect('dashboard');
            return;
        }

        $data = [
            'page_title' => 'Sign in',
            'error'      => null,
            'old_email'  => '',
        ];

        if ($this->input->method() === 'post') {
            $email    = trim((string) $this->input->post('email', true));
            $password = (string) $this->input->post('password', false);
            $data['old_email'] = $email;

            if ($email === '' || $password === '') {
                $data['error'] = 'Email and password are required.';
            } else {
                $user = $this->user_model->get_by_email($email);

                if (!$user || empty($user->password_hash) || !password_verify($password, $user->password_hash)) {
                    $data['error'] = 'Incorrect email or password.';
                    $this->_log('Invalid credentials', null, $email);
                } else {
                    $this->user_model->update_last_login($user->id);
                    $this->_log('OK', $user->id, $email);
                    $this->_set_login_session($user);

                    $this->_process_pending_wishlist();

                    $redirect_to = $this->session->userdata('redirect_after_login');
                    if ($redirect_to) {
                        $this->session->unset_userdata('redirect_after_login');
                        redirect($redirect_to);
                        return;
                    }

                    $target = ((int) $user->role_id === 1) ? 'admin' : 'dashboard';
                    redirect(site_url($target));
                    return;
                }
            }
        }

        $this->loadview('auth/login', $data, 'auth_layout');
    }

    public function register()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('portal_type') === 'website') {
            redirect('dashboard');
            return;
        }

        $data = [
            'page_title' => 'Create account',
            'errors'     => [],
            'old'        => [],
        ];

        if ($this->input->method() === 'post') {
            $full_name = trim((string) $this->input->post('full_name', true));
            $email     = strtolower(trim((string) $this->input->post('email', true)));
            $mobile    = trim((string) $this->input->post('mobile', true));
            $password  = (string) $this->input->post('password', false);

            $data['old'] = compact('full_name', 'email', 'mobile');

            $errors = [];
            if ($full_name === '' || strlen($full_name) < 2) {
                $errors[] = 'Full name is required (minimum 2 characters).';
            }
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Please enter a valid email address.';
            }
            if (strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 characters long.';
            }

            if (empty($errors) && $this->user_model->get_by_email($email)) {
                $errors[] = 'This email is already registered. Please sign in.';
            }

            if (empty($errors)) {
                $user_id = $this->user_model->create([
                    'role_id'       => 2,
                    'email'         => $email,
                    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    'full_name'     => $full_name,
                    'mobile'        => $mobile !== '' ? $mobile : null,
                ]);

                if ($user_id) {
                    $user = $this->user_model->get_by_id($user_id);
                    $this->user_model->update_last_login($user_id);
                    $this->_log('OK', $user_id, $email);
                    $this->_set_login_session($user);

                    $this->_process_pending_wishlist();

                    $redirect_to = $this->session->userdata('redirect_after_login');
                    if ($redirect_to) {
                        $this->session->unset_userdata('redirect_after_login');
                        redirect($redirect_to);
                        return;
                    }
                    redirect(site_url('dashboard'));
                    return;
                }
                $errors[] = 'Something went wrong while creating your account. Please try again.';
            }
            $data['errors'] = $errors;
        }

        $this->loadview('auth/register', $data, 'auth_layout');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    private function _set_login_session($user)
    {
        $this->session->set_userdata([
            'user_id'           => (int) $user->id,
            'role_id'           => (int) $user->role_id,
            'full_name'         => $user->full_name,
            'email'             => $user->email,
            'website_user_id'   => (int) $user->id,
            'website_role_id'   => (int) $user->role_id,
            'website_full_name' => $user->full_name,
            'website_email'     => $user->email,
            'portal_type'       => 'website',
            'logged_in'         => true,
        ]);
    }

    /**
     * If a guest tried to save a job/internship before logging in, complete
     * that action now that we have an authenticated session.
     */
    private function _process_pending_wishlist()
    {
        $pending = $this->session->userdata('pending_wishlist');
        if (!is_array($pending) || empty($pending['type']) || empty($pending['item_id'])) {
            return;
        }
        $this->session->unset_userdata('pending_wishlist');

        $this->load->model('website/Wishlist_model', 'wishlist_model');

        $type    = $pending['type'];
        $item_id = (int) $pending['item_id'];
        $uid     = (int) $this->session->userdata('user_id');

        $snapshot = [];
        if ($type === 'job') {
            $this->load->model('website/Job_model', 'job_model');
            $row = $this->job_model->find($item_id);
            if ($row) {
                $snapshot = [
                    'type' => 'job', 'item_id' => (int) $row->id,
                    'title' => $row->title, 'company' => $row->company,
                    'location' => $row->location, 'logo' => $row->logo_text,
                    'salary' => $row->salary_label,
                    'employment_type' => $row->employment_type,
                    'savedDate' => date('d M Y'),
                ];
            }
        } else if ($type === 'internship') {
            $this->load->model('learning/Internship_model', 'internship_model');
            $row = $this->internship_model->find($item_id);
            if ($row) {
                $snapshot = [
                    'type' => 'internship', 'item_id' => (int) $row->id,
                    'title' => $row->title, 'company' => $row->company,
                    'location' => $row->location, 'logo' => $row->logo_text,
                    'salary' => $row->stipend_label,
                    'category' => $row->category,
                    'duration_weeks' => $row->duration_weeks,
                    'savedDate' => date('d M Y'),
                ];
            }
        } else {
            return;
        }

        $this->wishlist_model->add($uid, $type, $item_id, $snapshot);
        $this->session->set_flashdata('wish_ok', 'Welcome back! We saved that ' . $type . ' to your wishlist.');
    }

    private function _log($action, $user_id = null, $meta = null)
    {
        // Use canonical `login_activity_logs` from the jobportal schema.
        if (!$this->db->table_exists('login_activity_logs')) return;

        $success = strpos($action, 'success') !== false ? 1 : 0;
        $this->db->insert('login_activity_logs', [
            'user_id'       => $user_id ?: null,
            'email_attempt' => $meta,
            'ip_address'    => $this->input->ip_address(),
            'user_agent'    => substr((string) $this->input->user_agent(), 0, 250),
            'success'       => $success,
            'message'       => $action,
        ]);
    }
}




