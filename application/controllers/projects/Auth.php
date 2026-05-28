<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class Auth extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Internship_user_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role();
            return;
        }

        $data = [
            'page_title' => 'Project Portal  -  Login',
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
                $user = $this->Internship_user_model->get_by_email($email);

                if (!$user || empty($user->password_hash) || !password_verify($password, $user->password_hash)) {
                    $data['error'] = 'Incorrect email or password.';
                } else {
                    $this->Internship_user_model->update_last_login($user->id);
                    $this->_set_login_session($user);
                    $this->_redirect_by_role();
                    return;
                }
            }
        }

        $this->loadview('projects/auth/login', $data, 'auth_layout');
    }

    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role();
            return;
        }

        $data = [
            'page_title' => 'Project Portal  -  Register',
            'error'      => null,
            'old_data'   => [],
        ];

        if ($this->input->method() === 'post') {
            $full_name   = trim((string) $this->input->post('full_name', true));
            $email       = trim((string) $this->input->post('email', true));
            $mobile      = trim((string) $this->input->post('mobile', true));
            $applied_for = trim((string) $this->input->post('applied_for', true));

            $data['old_data'] = $this->input->post();

            if ($full_name === '' || $email === '') {
                $data['error'] = 'Full name and email are required.';
            } elseif ($this->Internship_user_model->get_by_email($email)) {
                $data['error'] = 'This email is already registered.';
            } else {
                $userId = $this->Internship_user_model->create([
                    'full_name'     => $full_name,
                    'email'         => $email,
                    'password_hash' => '', // Will be set by admin on approval
                    'mobile'        => $mobile,
                    'applied_for'   => $applied_for ?: null,
                    'status'        => 'pending',
                    'role_id'       => 2,
                ]);

                if ($userId) {
                    // Show success message  -  do NOT auto-login
                    $this->session->set_flashdata('reg_success', 'Application submitted! You will receive your login credentials via email once admin approves your account.');
                    redirect('projects/login');
                    return;
                } else {
                    $data['error'] = 'Registration failed. Please try again.';
                }
            }
        }

        $this->loadview('projects/auth/register', $data, 'auth_layout');
    }

    public function forgot_password()
    {
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role();
            return;
        }

        $data = [
            'page_title' => 'Project Portal - Forgot Password',
            'error'      => null,
            'success'    => null,
            'reset_link' => null,
            'old_email'  => '',
        ];

        if ($this->input->method() === 'post') {
            $email = trim((string) $this->input->post('email', true));
            $data['old_email'] = $email;

            if ($email === '') {
                $data['error'] = 'Email address is required.';
            } else {
                $user = $this->Internship_user_model->get_by_email($email);
                if (!$user) {
                    $data['error'] = 'No account found with this email address.';
                } else {
                    // Generate a token
                    $token = bin2hex(random_bytes(16));
                    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                    // Update user's token
                    $this->Internship_user_model->update($user->id, [
                        'reset_token'            => $token,
                        'reset_token_expires_at' => $expiry,
                    ]);

                    $data['success'] = 'Reset request successful!';
                    $data['reset_link'] = site_url('projects/reset_password?token=' . $token);
                }
            }
        }

        $this->loadview('projects/auth/forgot_password', $data, 'auth_layout');
    }

    public function reset_password()
    {
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role();
            return;
        }

        $token = $this->input->get('token', true);
        if (!$token) {
            $token = $this->input->post('token', true);
        }

        if (!$token) {
            $this->session->set_flashdata('project_error', 'Invalid password reset token.');
            redirect('projects/login');
            return;
        }

        // Verify token
        $user = $this->db->get_where('internship_users', [
            'reset_token'            => $token,
            'reset_token_expires_at >=' => date('Y-m-d H:i:s'),
            'deleted_at'             => null
        ])->row();

        if (!$user) {
            $this->session->set_flashdata('project_error', 'Your password reset token has expired or is invalid.');
            redirect('projects/forgot_password');
            return;
        }

        $data = [
            'page_title' => 'Project Portal - Reset Password',
            'error'      => null,
            'token'      => $token
        ];

        if ($this->input->method() === 'post') {
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

            if (empty($password)) {
                $data['error'] = 'Password is required.';
            } elseif (strlen($password) < 6) {
                $data['error'] = 'Password must be at least 6 characters long.';
            } elseif ($password !== $confirm_password) {
                $data['error'] = 'Passwords do not match.';
            } else {
                // Update password hash and clear token
                $this->Internship_user_model->update($user->id, [
                    'password_hash'          => password_hash($password, PASSWORD_DEFAULT),
                    'reset_token'            => null,
                    'reset_token_expires_at' => null,
                ]);

                $this->session->set_flashdata('reg_success', 'Your password has been successfully updated! You can now log in.');
                redirect('projects/login');
                return;
            }
        }

        $this->loadview('projects/auth/reset_password', $data, 'auth_layout');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('projects/login');
    }

    private function _set_login_session($user)
    {
        $this->session->set_userdata([
            'user_id'   => (int) $user->id,
            'role_id'   => (int) $user->role_id,
            'full_name' => $user->full_name,
            'email'     => $user->email,
            'logged_in' => true,
        ]);
    }

    private function _redirect_by_role()
    {
        $role_id = (int) $this->session->userdata('role_id');
        if ($role_id === 1) {
            redirect('projects/admin');
        } else {
            redirect('projects/user');
        }
    }
}




