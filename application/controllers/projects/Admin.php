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
        $this->load->model('Internship_user_model');
        $this->load->model('Internship_project_model');
    }

    public function index()
    {
        $stats = $this->Project_model->get_stats();
        $internship_stats = $this->Internship_model->get_stats();
        $projects = $this->Project_model->get_all(50);

        $this->loadview('projects/admin/dashboard', [
            'page_title' => 'Project Admin  -  Dashboard',
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

    public function users()
    {
        $users = $this->db->order_by('id', 'DESC')->get('internship_users')->result();
        $this->loadview('projects/admin/users', [
            'page_title' => 'Manage Internship Users',
            'users'      => $users,
            'use_admin_shell' => true,
        ], 'projects/project_layout');
    }

    public function approve_user($id)
    {
        $user = $this->Internship_user_model->get_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('project_error', 'User not found.');
            redirect('projects/admin/users');
        }

        // Generate a random password
        $new_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

        // Update user status and password
        $this->Internship_user_model->update($id, [
            'status' => 'approved',
            'password_hash' => $password_hash
        ]);

        // Send Credentials (Joining Letter)
        $this->_send_joining_letter($user, $new_password);

        $this->session->set_flashdata('project_ok', 'User approved and Joining Letter (Credentials) sent to ' . $user->email);
        redirect('projects/admin/users');
    }

    public function send_offer_letter_action($id)
    {
        $user = $this->Internship_user_model->get_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('project_error', 'User not found.');
            redirect('projects/admin/users');
        }

        $this->_send_offer_letter($user);

        $this->session->set_flashdata('project_ok', 'Professional Offer Letter sent to ' . $user->email);
        redirect('projects/admin/users');
    }

    /* ------------------------------------------------------------------
     | Project Submissions & Certificates
     * -----------------------------------------------------------------*/
    
    public function project_submissions()
    {
        $submissions = $this->Internship_project_model->get_all_submissions();
        $this->loadview('projects/admin/project_submissions', [
            'page_title' => 'Review Project Submissions',
            'submissions' => $submissions,
            'use_admin_shell' => true,
        ], 'projects/project_layout');
    }

    public function approve_certificate_project($id)
    {
        $this->Internship_project_model->update_status($id, 'approved');
        $this->session->set_flashdata('project_ok', 'Project approved. Certificate unlocked for the student.');
        redirect('projects/admin/project_submissions');
    }

    public function reject_certificate_project($id)
    {
        $this->Internship_project_model->update_status($id, 'rejected');
        $this->session->set_flashdata('project_ok', 'Project rejected. Student can resubmit.');
        redirect('projects/admin/project_submissions');
    }

    private function _send_offer_letter($user)
    {
        $this->load->library('email');

        $unid = 'RMID' . date('Y') . str_pad($user->id, 4, '0', STR_PAD_LEFT);
        $duration = 6; // Default 6 months
        $start_date = date('d/m/Y');
        $end_date = date('d/m/Y', strtotime("+$duration months"));

        $data = [
            'name'       => $user->full_name,
            'role'       => $user->applied_for ?: 'Fullstack Web Development',
            'unid'       => $unid,
            'duration'   => $duration,
            'start_date' => $start_date,
            'end_date'   => $end_date
        ];

        $message = $this->load->view('emails/offer_letter', $data, TRUE);

        $this->email->from('shalini.shakya@paymanent.com', 'Internmo');
        $this->email->reply_to('info@internmo.com', 'Internmo');
        $this->email->to($user->email);
        $this->email->subject('Internship Offer Letter - Internmo');
        $this->email->set_mailtype('html');
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata('last_letter', [
                'type' => 'Offer Letter',
                'name' => $user->full_name,
                'to' => $user->email,
                'role' => $data['role'],
                'unid' => $unid
            ]);
            return true;
        } else {
            $error = $this->email->print_debugger();
            $this->session->set_flashdata('project_error', 'Email failed to send. Error: ' . strip_tags($error));
            return false;
        }
    }

    private function _send_joining_letter($user, $password)
    {
        $this->load->library('email');

        $data = [
            'name'     => $user->full_name,
            'course'   => $user->applied_for ?: 'Internship Program',
            'email'    => $user->email,
            'password' => $password
        ];

        $message = $this->load->view('emails/joining_letter', $data, TRUE);

        $this->email->from('shalini.shakya@paymanent.com', 'Internmo');
        $this->email->reply_to('info@internmo.com', 'Internmo');
        $this->email->to($user->email);
        $this->email->subject('Your Joining Letter & Credentials - Internmo');
        $this->email->set_mailtype('html');
        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata('last_letter', [
                'type' => 'Joining Letter',
                'name' => $user->full_name,
                'to' => $user->email,
                'pass' => $password
            ]);
            return true;
        } else {
            $error = $this->email->print_debugger();
            $this->session->set_flashdata('project_error', 'Email failed to send. Error: ' . strip_tags($error));
            return false;
        }
    }

    /* ------------------------------------------------------------------
     | Revenue Analytics
     * -----------------------------------------------------------------*/

    public function revenue()
    {
        $this->require_admin();

        $daily = $this->_get_daily_revenue(30);
        $hourly = $this->_get_hourly_revenue_today();
        $recent = $this->_get_recent_payments(10);
        $kpis = $this->_get_revenue_kpis();

        $this->loadview('projects/admin/revenue', [
            'page_title' => 'Revenue Analytics',
            'daily'      => $daily,
            'hourly'     => $hourly,
            'recent'     => $recent,
            'kpis'       => $kpis,
            'use_admin_shell' => true,
        ], 'projects/project_layout');
    }

    private function _get_daily_revenue($days = 30)
    {
        $out = [];
        $start = strtotime(date('Y-m-d', strtotime("-" . ($days - 1) . " days")));
        for ($i = 0; $i < $days; $i++) {
            $out[date('Y-m-d', $start + $i * 86400)] = 0;
        }

        if (!$this->db->table_exists('payments')) return $out;

        $since = date('Y-m-d 00:00:00', $start);
        $rows = $this->db->select("DATE(created_at) as d, SUM(amount_paise) as total", false)
            ->where('status', 'paid')
            ->where('created_at >=', $since)
            ->group_by("DATE(created_at)")
            ->get('payments')->result();

        foreach ($rows as $r) {
            if (isset($out[$r->d])) $out[$r->d] = round($r->total / 100, 2);
        }
        return $out;
    }

    private function _get_hourly_revenue_today()
    {
        $out = [];
        for ($i = 0; $i < 24; $i++) {
            $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
            $out[$hour . ":00"] = 0;
        }

        if (!$this->db->table_exists('payments')) return $out;

        $today = date('Y-m-d 00:00:00');
        $rows = $this->db->select("HOUR(created_at) as h, SUM(amount_paise) as total", false)
            ->where('status', 'paid')
            ->where('created_at >=', $today)
            ->group_by("HOUR(created_at)")
            ->get('payments')->result();

        foreach ($rows as $r) {
            $hour = str_pad($r->h, 2, '0', STR_PAD_LEFT) . ":00";
            if (isset($out[$hour])) $out[$hour] = round($r->total / 100, 2);
        }
        return $out;
    }

    private function _get_recent_payments($limit = 10)
    {
        if (!$this->db->table_exists('payments')) return [];
        return $this->db->select('p.*, u.full_name, u.email')
            ->from('payments p')
            ->join('users u', 'u.id = p.user_id', 'left')
            ->order_by('p.id', 'DESC')
            ->limit($limit)
            ->get()->result();
    }

    private function _get_revenue_kpis()
    {
        $stats = ['today' => 0, 'month' => 0, 'total' => 0, 'count' => 0];
        if (!$this->db->table_exists('payments')) return $stats;

        $today = date('Y-m-d 00:00:00');
        $month = date('Y-m-01 00:00:00');

        $row_today = $this->db->select_sum('amount_paise', 'sum')->where('status', 'paid')->where('created_at >=', $today)->get('payments')->row();
        $row_month = $this->db->select_sum('amount_paise', 'sum')->where('status', 'paid')->where('created_at >=', $month)->get('payments')->row();
        $row_total = $this->db->select_sum('amount_paise', 'sum')->where('status', 'paid')->get('payments')->row();
        $row_count = $this->db->where('status', 'paid')->count_all_results('payments');

        $stats['today'] = round(($row_today->sum ?? 0) / 100, 2);
        $stats['month'] = round(($row_month->sum ?? 0) / 100, 2);
        $stats['total'] = round(($row_total->sum ?? 0) / 100, 2);
        $stats['count'] = $row_count;
        $stats['avg']   = $row_count > 0 ? round($stats['total'] / $row_count, 2) : 0;

        return $stats;
    }
}




