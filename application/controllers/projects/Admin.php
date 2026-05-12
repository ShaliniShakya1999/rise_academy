<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class Admin extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_admin();
        $this->load->model('Project_model');
        $this->load->model('Internship_model');
    }

    public function index()
    {
        $stats = $this->Project_model->get_stats();
        $internship_stats = $this->Internship_model->get_stats();
        $projects = $this->Project_model->get_all(50);

        $this->loadview('projects/admin/dashboard', [
            'page_title' => 'Project Admin — Dashboard',
            'stats'      => $stats,
            'intern_stats' => $internship_stats,
            'projects'   => $projects,
            'use_admin_shell' => true,
        ], 'projects/project_layout');
    }

    public function internships()
    {
        $internships = $this->Internship_model->get_all();
        $this->loadview('projects/admin/internships', [
            'page_title' => 'Manage Internships',
            'internships' => $internships,
            'use_admin_shell' => true,
        ], 'projects/project_layout');
    }

    public function add_internship()
    {
        if ($this->input->method() === 'post') {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'category' => $this->input->post('category'),
                'duration' => $this->input->post('duration'),
                'location' => $this->input->post('location'),
                'stipend' => $this->input->post('stipend'),
                'status' => 'active'
            ];
            $this->Internship_model->insert($data);
            $this->session->set_flashdata('project_ok', 'Internship added successfully!');
            redirect('projects/admin/internships');
        }
    }

    public function edit_internship($id)
    {
        if ($this->input->method() === 'post') {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'category' => $this->input->post('category'),
                'duration' => $this->input->post('duration'),
                'location' => $this->input->post('location'),
                'stipend' => $this->input->post('stipend'),
            ];
            $this->Internship_model->update($id, $data);
            $this->session->set_flashdata('project_ok', 'Internship updated successfully!');
            redirect('projects/admin/internships');
        }
    }

    public function delete_internship($id)
    {
        $this->Internship_model->delete($id);
        $this->session->set_flashdata('project_ok', 'Internship deleted.');
        redirect('projects/admin/internships');
    }

    public function applications()
    {
        $applications = $this->Internship_model->get_applications();
        $this->loadview('projects/admin/applications', [
            'page_title' => 'Internship Applications',
            'applications' => $applications,
            'use_admin_shell' => true,
        ], 'projects/project_layout');
    }

    public function update_status($id)
    {
        $status = $this->input->post('status');
        if (in_array($status, ['requested', 'pending', 'reviewed', 'approved', 'rejected'])) {
            $this->Project_model->update($id, ['status' => $status]);
            $this->session->set_flashdata('project_ok', 'Project status updated to ' . $status);
        }
        redirect('projects/admin');
    }

    public function delete($id)
    {
        $this->Project_model->delete($id);
        $this->session->set_flashdata('project_ok', 'Project deleted successfully.');
        redirect('projects/admin');
    }
}
