<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

/**
 * Layout — public website pages (landing, about, templates, etc).
 * Auth is in Auth.php controller. Resume CRUD is in Resume.php.
 */
class Layout extends My_Controller
{
    public function index()
    {
        $this->loadview('Website/index', ['page_title' => 'Build resumes that get you hired']);
    }

    public function about()
    {
        $this->loadview('Website/about', ['page_title' => 'About']);
    }

    public function templates()
    {
        $this->load->model('template_model');
        $this->loadview('Website/templates', [
            'page_title' => 'Templates',
            'templates'  => $this->template_model->all_active(),
        ]);
    }

    public function privacy()
    {
        $this->loadview('Website/privacy', ['page_title' => 'Privacy']);
    }

    public function jobs()
    {
        $this->load->model('job_model');
        $filters = [
            'q'               => trim((string) $this->input->get('q', true)),
            'category'        => trim((string) $this->input->get('category', true)),
            'employment_type' => trim((string) $this->input->get('type', true)),
        ];
        $saved_job_ids = [];
        if ($this->session->userdata('logged_in')) {
            $this->load->model('wishlist_model');
            $saved_job_ids = $this->wishlist_model->ids_for_user((int) $this->session->userdata('user_id'), 'job');
        }

        $this->loadview('Website/jobs', [
            'page_title'     => 'Jobs',
            'jobs'           => $this->job_model->active(50, $filters),
            'categories'     => $this->job_model->categories(),
            'filters'        => $filters,
            'total'          => $this->job_model->count_all(),
            'saved_job_ids'  => $saved_job_ids,
        ]);
    }

    public function internship()
    {
        $this->load->model('internship_model');
        $filters = [
            'q'         => trim((string) $this->input->get('q', true)),
            'category'  => trim((string) $this->input->get('category', true)),
            'is_remote' => $this->input->get('remote') === '1' ? 1 : 0,
        ];
        $saved_internship_ids = [];
        if ($this->session->userdata('logged_in')) {
            $this->load->model('wishlist_model');
            $saved_internship_ids = $this->wishlist_model->ids_for_user((int) $this->session->userdata('user_id'), 'internship');
        }

        $this->loadview('Website/internship', [
            'page_title'            => 'Internship',
            'internships'           => $this->internship_model->active(50, $filters),
            'categories'            => $this->internship_model->categories(),
            'filters'               => $filters,
            'total'                 => $this->internship_model->count_all(),
            'saved_internship_ids'  => $saved_internship_ids,
        ]);
    }

    public function resume_checker()
    {
        $this->loadview('Website/resume_checker', ['page_title' => 'Resume Checker']);
    }

    public function project_submission()
    {
        $this->load->library('form_validation');

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('full_name', 'Full name', 'required|min_length[2]|max_length[150]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[190]');
            $this->form_validation->set_rules('project_title', 'Project title', 'required|min_length[3]|max_length[200]');
            $this->form_validation->set_rules('description', 'Description', 'required|min_length[20]');
            $this->form_validation->set_rules('project_url', 'Project URL', 'trim|max_length[500]|callback__optional_url');
            $this->form_validation->set_rules('agree', 'Confirmation', 'required');

            if ($this->form_validation->run()) {
                if ($this->db->table_exists('notifications')) {
                    $this->db->insert('notifications', [
                        'user_id' => $this->session->userdata('user_id') ?: null,
                        'channel' => 'in_app',
                        'title'   => 'Project submission received',
                        'body'    => substr((string) $this->input->post('project_title', true), 0, 250),
                    ]);
                }
                $this->session->set_flashdata('project_ok', 'Thank you! We received your project details. Our team will review and contact you by email within 5–7 business days.');
                redirect('project-submission');
                return;
            }
        }

        $this->loadview('Website/project_submission', [
            'page_title' => 'Project Submission',
        ]);
    }

    /**
     * Form validation callback — empty OK, else must be valid URL.
     */
    public function _optional_url($str)
    {
        $str = trim((string) $str);
        if ($str === '') {
            return true;
        }
        if (filter_var($str, FILTER_VALIDATE_URL)) {
            return true;
        }
        $this->form_validation->set_message('_optional_url', 'The {field} must be a valid URL (include https://).');
        return false;
    }
}
