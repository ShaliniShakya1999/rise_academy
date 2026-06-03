<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class User extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login('projects');
        
        // If Admin tries to access user dashboard, redirect to admin panel
        if ($this->session->userdata('role_id') == 1) {
            redirect('projects/admin');
        }

        $this->load->model('projects/Project_model');
        $this->load->model('projects/Internship_project_model');
        $this->load->model('projects/Internship_user_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $projects = $this->Project_model->get_by_user($user_id);
        
        // Fetch internship specific project submission for certificate
        $internship_project = $this->Internship_project_model->get_by_user($user_id);
        $user_data = $this->Internship_user_model->get_by_id($user_id);

        $this->loadview('projects/user/dashboard', [
            'page_title' => 'My Projects & Certificate',
            'projects'   => $projects,
            'internship_project' => $internship_project,
            'user_data' => $user_data
        ], 'projects/project_layout');
    }

    public function submit_certificate_project()
    {
        if ($this->input->method() === 'post') {
            $user_id = $this->session->userdata('user_id');
            $project_link = $this->input->post('project_link', true);

            if (!empty($project_link)) {
                $this->Internship_project_model->submit([
                    'user_id' => $user_id,
                    'project_link' => $project_link,
                    'status' => 'pending'
                ]);
                $this->session->set_flashdata('project_ok', 'Project submitted! Certificate will unlock after admin approval.');
            } else {
                $this->session->set_flashdata('project_error', 'Please provide a valid project link.');
            }
            redirect('projects/user');
        }
    }

    public function submit()
    {
        if ($this->input->method() === 'post') {
            $data = [
                'user_id'       => $this->session->userdata('user_id'),
                'full_name'     => $this->session->userdata('full_name'),
                'email'         => $this->session->userdata('email'),
                'project_title' => $this->input->post('project_title', true),
                'sub_domain'    => $this->input->post('sub_domain', true),
                'description'   => $this->input->post('description', true),
                'status'        => 'requested'
            ];

                // Handle file upload if any
                if (!empty($_FILES['project_file']['name'])) {
                    $config['upload_path']   = './uploads/projects/';
                    $config['allowed_types'] = 'pdf|zip|rar|doc|docx';
                    $config['max_size']      = 5120; // 5MB

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, true);
                    }

                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('project_file')) {
                        $upload_data = $this->upload->data();
                        $data['file_path'] = 'uploads/projects/' . $upload_data['file_name'];
                    }
                }

                $this->Project_model->insert($data);
                $this->session->set_flashdata('project_ok', 'Project submitted successfully! It is now under review.');
                redirect('projects/user');
                return;
        }

        $user_id = $this->session->userdata('user_id');
        $projects = $this->Project_model->get_by_user($user_id);
        $user_data = $this->Internship_user_model->get_by_id($user_id);

        $this->loadview('projects/user/submit', [
            'page_title' => 'Submit New Project',
            'projects'   => $projects,
            'user_data'  => $user_data
        ], 'projects/project_layout');
    }
    public function chat()
    {
        $this->loadview('projects/user/chat', [
            'page_title' => 'Chat Support',
        ], 'projects/project_layout');
    }

    public function calendar()
    {
        $this->loadview('projects/user/calendar', [
            'page_title' => 'Project Calendar',
        ], 'projects/project_layout');
    }

    public function faq()
    {
        $this->loadview('projects/user/faq', [
            'page_title' => 'Support & FAQs',
        ], 'projects/project_layout');
    }

    public function applications()
    {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('learning/Internship_model');
        $applications = $this->db->select('ia.*, i.title as internship_title')
                                ->from('internship_applications ia')
                                ->join('internships i', 'i.id = ia.internship_id', 'left')
                                ->where('ia.user_id', $user_id)
                                ->order_by('ia.applied_at', 'DESC')
                                ->get()
                                ->result();
        
        $this->loadview('projects/user/applications', [
            'page_title' => 'My Applications',
            'applications' => $applications
        ], 'projects/project_layout');
    }

}




