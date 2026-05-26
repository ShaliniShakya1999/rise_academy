<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists('My_Controller')) {
    include_once APPPATH . 'core/My_Controller.php';
}

/**
 * Admin workspace controller.
 *
 * Every method requires an admin role. Each page loads real data from
 * the canonical `jobportal` schema and renders an admin view rather
 * than the generic placeholder.
 */
class Admin extends My_Controller
{
    /* ------------------------------------------------------------------
     | Dashboard / Overview
     * -----------------------------------------------------------------*/

    public function dashboard()
    {
        $this->require_admin();

        $stats = [
            'users'     => $this->_count_null('users'),
            'resumes'   => $this->_count_null('resumes'),
            'templates' => $this->_count_table_where('resume_templates', 'is_active', 1),
            'jobs'      => $this->_count_null('jobs'),
        ];

        $this->loadview('admin/dashboard', [
            'page_title'      => 'Admin  -  Overview',
            'use_admin_shell' => true,
            'sidebar_active'  => 'admin',
            'stats'           => $stats,
        ]);
    }

    /* ------------------------------------------------------------------
     | Analytics
     * -----------------------------------------------------------------*/

    public function analytics()
    {
        $this->require_admin();

        $kpis = [
            'users'        => $this->_count_null('users'),
            'resumes'      => $this->_count_null('resumes'),
            'downloads'    => $this->_count_table('resume_downloads'),
            'ats_reports'  => $this->_count_table('ats_reports'),
            'jobs'         => $this->_count_null('jobs'),
            'internships'  => $this->_count_null('internships'),
            'logins_30d'   => $this->_count_recent('login_activity_logs', 'created_at', 30),
            'new_users_30d'=> $this->_count_recent('users', 'created_at', 30, 'deleted_at IS NULL'),
        ];

        $signups_30d   = $this->_daily_series('users', 'created_at', 30, 'deleted_at IS NULL');
        $resumes_30d   = $this->_daily_series('resumes', 'created_at', 30, 'deleted_at IS NULL');
        $downloads_30d = $this->_daily_series('resume_downloads', 'created_at', 30);
        $logins_30d    = $this->_daily_series('login_activity_logs', 'created_at', 30);

        $template_split = $this->_template_resume_split();
        $top_locations  = $this->_top_locations();

        $this->loadview('admin/analytics', [
            'page_title'      => 'Admin  -  Analytics',
            'use_admin_shell' => true,
            'sidebar_active'  => 'analytics',
            'kpis'            => $kpis,
            'series'          => [
                'signups'   => $signups_30d,
                'resumes'   => $resumes_30d,
                'downloads' => $downloads_30d,
                'logins'    => $logins_30d,
            ],
            'template_split' => $template_split,
            'top_locations'  => $top_locations,
        ]);
    }

    /* ------------------------------------------------------------------
     | Users
     * -----------------------------------------------------------------*/

    public function users()
    {
        $this->require_admin();
        $this->load->model('user_model');

        $q       = trim((string) $this->input->get('q'));
        $page    = max(1, (int) $this->input->get('page'));
        $perPage = 15;
        $offset  = ($page - 1) * $perPage;

        $rows  = $this->user_model->paginate($perPage, $offset, $q);
        $total = $this->user_model->count_all($q);

        $resume_counts = $this->_user_resume_counts();

        $this->loadview('admin/users', [
            'page_title'      => 'Admin  -  Users',
            'use_admin_shell' => true,
            'sidebar_active'  => 'users',
            'rows'            => $rows,
            'total'           => $total,
            'page'            => $page,
            'per_page'        => $perPage,
            'q'               => $q,
            'resume_counts'   => $resume_counts,
            'totals'          => [
                'admins'   => $this->_count_table_where('users', 'role_id', 1, 'deleted_at IS NULL'),
                'verified' => $this->_count_users_verified(),
                'new_30d'  => $this->_count_recent('users', 'created_at', 30, 'deleted_at IS NULL'),
            ],
        ]);
    }

    /* ------------------------------------------------------------------
     | Resumes
     * -----------------------------------------------------------------*/

    public function resumes()
    {
        $this->require_admin();

        $rows = [];
        if ($this->db->table_exists('resumes')) {
            $rows = $this->db
                ->select('r.id, r.title, r.completion_score, r.created_at, r.updated_at,
                          u.email, u.full_name,
                          t.name AS template_name, t.slug AS template_slug')
                ->from('resumes r')
                ->join('users u', 'u.id = r.user_id', 'left')
                ->join('resume_templates t', 't.id = r.template_id', 'left')
                ->where('r.deleted_at', null)
                ->order_by('r.updated_at', 'DESC')
                ->limit(100)
                ->get()->result();
        }

        $stats = [
            'total'      => $this->_count_null('resumes'),
            'avg_score'  => $this->_avg_completion(),
            'with_score' => $this->_count_resumes_with_score(),
            'downloads'  => $this->_count_table('resume_downloads'),
        ];

        $this->loadview('admin/resumes', [
            'page_title'      => 'Admin  -  Resumes',
            'use_admin_shell' => true,
            'sidebar_active'  => 'resumes',
            'rows'            => $rows,
            'stats'           => $stats,
        ]);
    }

    /* ------------------------------------------------------------------
     | Templates
     * -----------------------------------------------------------------*/

    public function templates()
    {
        $this->require_admin();
        $this->load->model('template_model');

        $rows  = $this->template_model->all();
        $usage = $this->_template_usage_map();

        $this->loadview('admin/templates', [
            'page_title'      => 'Admin  -  Templates',
            'use_admin_shell' => true,
            'sidebar_active'  => 'templates',
            'rows'            => $rows,
            'usage'           => $usage,
            'stats'           => [
                'total'    => is_array($rows) ? count($rows) : 0,
                'active'   => $this->_count_table_where('resume_templates', 'is_active', 1),
                'inactive' => $this->_count_table_where('resume_templates', 'is_active', 0),
            ],
        ]);
    }

    /* ------------------------------------------------------------------
     | Content  -  Jobs + Internships
     * -----------------------------------------------------------------*/

    public function content()
    {
        $this->require_admin();

        $jobs = $internships = [];

        if ($this->db->table_exists('jobs')) {
            $jobs = $this->db->where('deleted_at', null)
                ->order_by('updated_at', 'DESC')->limit(25)
                ->get('jobs')->result();
        }
        if ($this->db->table_exists('internships')) {
            $internships = $this->db->where('deleted_at', null)
                ->order_by('updated_at', 'DESC')->limit(25)
                ->get('internships')->result();
        }

        $this->loadview('admin/content', [
            'page_title'      => 'Admin  -  Content',
            'use_admin_shell' => true,
            'sidebar_active'  => 'content',
            'jobs'            => $jobs,
            'internships'     => $internships,
            'stats'           => [
                'jobs'        => $this->_count_null('jobs'),
                'internships' => $this->_count_null('internships'),
                'remote_jobs' => $this->_count_table_where('jobs', 'is_remote', 1, 'deleted_at IS NULL'),
                'wishlists'   => $this->_count_table('wishlist_items'),
            ],
        ]);
    }

    /* ------------------------------------------------------------------
     | AI Tools  -  ATS reports + uploads
     * -----------------------------------------------------------------*/

    public function ai()
    {
        $this->require_admin();

        $reports = [];
        if ($this->db->table_exists('ats_reports')) {
            $reports = $this->db
                ->select('a.id, a.user_id, a.score, a.created_at, u.email, u.full_name, up.original_name')
                ->from('ats_reports a')
                ->join('users u', 'u.id = a.user_id', 'left')
                ->join('uploads up', 'up.id = a.upload_id', 'left')
                ->order_by('a.id', 'DESC')->limit(25)
                ->get()->result();
        }

        $score_buckets = $this->_ats_score_buckets();

        $this->loadview('admin/ai', [
            'page_title'      => 'Admin  -  AI Tools',
            'use_admin_shell' => true,
            'sidebar_active'  => 'ai',
            'reports'         => $reports,
            'buckets'         => $score_buckets,
            'stats'           => [
                'reports'       => $this->_count_table('ats_reports'),
                'uploads'       => $this->_count_table('uploads'),
                'avg_score'     => $this->_avg_field('ats_reports', 'score'),
                'reports_30d'   => $this->_count_recent('ats_reports', 'created_at', 30),
            ],
        ]);
    }

    /* ------------------------------------------------------------------
     | Subscriptions / Payments
     * -----------------------------------------------------------------*/

    public function subscriptions()
    {
        $this->require_admin();

        $rows = [];
        if ($this->db->table_exists('payments')) {
            $rows = $this->db
                ->select('p.*, u.email, u.full_name')
                ->from('payments p')
                ->join('users u', 'u.id = p.user_id', 'left')
                ->order_by('p.id', 'DESC')->limit(50)
                ->get()->result();
        }

        $totals = [
            'count'      => $this->_count_table('payments'),
            'paid'       => $this->_count_table_where('payments', 'status', 'paid'),
            'pending'    => $this->_count_table_where('payments', 'status', 'created'),
            'gross_inr'  => $this->_sum_paise_to_inr(),
        ];

        $this->loadview('admin/subscriptions', [
            'page_title'      => 'Admin  -  Subscriptions',
            'use_admin_shell' => true,
            'sidebar_active'  => 'subscriptions',
            'rows'            => $rows,
            'totals'          => $totals,
        ]);
    }

    /* ------------------------------------------------------------------
     | Reports
     * -----------------------------------------------------------------*/

    public function reports()
    {
        $this->require_admin();

        $downloads = [];
        if ($this->db->table_exists('resume_downloads')) {
            $downloads = $this->db
                ->select('d.id, d.format, d.created_at, u.email, u.full_name, r.title')
                ->from('resume_downloads d')
                ->join('users u', 'u.id = d.user_id', 'left')
                ->join('resumes r', 'r.id = d.resume_id', 'left')
                ->order_by('d.id', 'DESC')->limit(25)
                ->get()->result();
        }

        $top_users = [];
        if ($this->db->table_exists('resume_downloads')) {
            $top_users = $this->db
                ->select('u.full_name, u.email, COUNT(*) AS downloads', false)
                ->from('resume_downloads d')
                ->join('users u', 'u.id = d.user_id', 'left')
                ->group_by('d.user_id')
                ->order_by('downloads', 'DESC')->limit(8)
                ->get()->result();
        }

        $this->loadview('admin/reports', [
            'page_title'      => 'Admin  -  Reports',
            'use_admin_shell' => true,
            'sidebar_active'  => 'reports',
            'downloads'       => $downloads,
            'top_users'       => $top_users,
            'stats'           => [
                'total_downloads' => $this->_count_table('resume_downloads'),
                'pdf_downloads'   => $this->_count_table_where('resume_downloads', 'format', 'pdf'),
                'last_30d'        => $this->_count_recent('resume_downloads', 'created_at', 30),
                'unique_users'    => $this->_distinct_count('resume_downloads', 'user_id'),
            ],
        ]);
    }

    /* ------------------------------------------------------------------
     | Settings  -  read-only display of CI config + tables present
     * -----------------------------------------------------------------*/

    public function settings()
    {
        $this->require_admin();

        $tables = $this->db->list_tables();
        sort($tables);

        $info = [
            'base_url'      => base_url(),
            'index_page'    => $this->config->item('index_page'),
            'charset'       => $this->config->item('charset'),
            'language'      => $this->config->item('language'),
            'session'       => $this->config->item('sess_driver') . ' / ' . $this->config->item('sess_save_path'),
            'environment'   => defined('ENVIRONMENT') ? ENVIRONMENT : 'unknown',
            'php_version'   => PHP_VERSION,
            'mysql_version' => @$this->db->version(),
            'db_host'       => $this->db->hostname,
            'db_name'       => $this->db->database,
        ];

        $this->loadview('admin/settings', [
            'page_title'      => 'Admin  -  Settings',
            'use_admin_shell' => true,
            'sidebar_active'  => 'settings',
            'info'            => $info,
            'tables'          => $tables,
        ]);
    }

    /* ------------------------------------------------------------------
     | Security  -  login + admin activity logs
     * -----------------------------------------------------------------*/

    public function security()
    {
        $this->require_admin();

        $logins = [];
        if ($this->db->table_exists('login_activity_logs')) {
            $logins = $this->db
                ->select('l.id, l.email_attempt, l.ip_address, l.user_agent, l.success, l.message, l.created_at, u.full_name')
                ->from('login_activity_logs l')
                ->join('users u', 'u.id = l.user_id', 'left')
                ->order_by('l.id', 'DESC')->limit(30)
                ->get()->result();
        }

        $admin_logs = [];
        if ($this->db->table_exists('admin_activity_logs')) {
            $admin_logs = $this->db
                ->select('a.*, u.full_name, u.email')
                ->from('admin_activity_logs a')
                ->join('users u', 'u.id = a.admin_user_id', 'left')
                ->order_by('a.id', 'DESC')->limit(30)
                ->get()->result();
        }

        $stats = [
            'logins_total'  => $this->_count_table('login_activity_logs'),
            'logins_failed' => $this->_count_table_where('login_activity_logs', 'success', 0),
            'logins_30d'    => $this->_count_recent('login_activity_logs', 'created_at', 30),
            'admin_actions' => $this->_count_table('admin_activity_logs'),
        ];

        $this->loadview('admin/security', [
            'page_title'      => 'Admin  -  Security',
            'use_admin_shell' => true,
            'sidebar_active'  => 'security',
            'logins'          => $logins,
            'admin_logs'      => $admin_logs,
            'stats'           => $stats,
        ]);
    }

    /* ==================================================================
     | Internal helpers
     * =================================================================*/

    private function _count_null($table)
    {
        if (!$this->db->table_exists($table)) return 0;
        return (int) $this->db->where('deleted_at', null)->count_all_results($table);
    }

    private function _count_table($table)
    {
        if (!$this->db->table_exists($table)) return 0;
        return (int) $this->db->count_all_results($table);
    }

    private function _count_table_where($table, $col, $val, $extra_null_safe = null)
    {
        if (!$this->db->table_exists($table)) return 0;
        $this->db->where($col, $val);
        if ($extra_null_safe) $this->db->where($extra_null_safe, null, false);
        return (int) $this->db->count_all_results($table);
    }

    private function _count_recent($table, $col, $days, $extra_null_safe = null)
    {
        if (!$this->db->table_exists($table)) return 0;
        $since = date('Y-m-d H:i:s', strtotime("-{$days} days"));
        $this->db->where("$col >=", $since);
        if ($extra_null_safe) $this->db->where($extra_null_safe, null, false);
        return (int) $this->db->count_all_results($table);
    }

    private function _count_users_verified()
    {
        if (!$this->db->table_exists('users')) return 0;
        return (int) $this->db
            ->where('email_verified_at IS NOT NULL', null, false)
            ->where('deleted_at', null)
            ->count_all_results('users');
    }

    private function _count_resumes_with_score()
    {
        if (!$this->db->table_exists('resumes')) return 0;
        return (int) $this->db
            ->where('completion_score >', 0)
            ->where('deleted_at', null)
            ->count_all_results('resumes');
    }

    private function _avg_completion()
    {
        if (!$this->db->table_exists('resumes')) return 0;
        $row = $this->db->select_avg('completion_score', 'avg_score')
            ->where('deleted_at', null)
            ->get('resumes')->row();
        return (int) round($row && $row->avg_score ? $row->avg_score : 0);
    }

    private function _avg_field($table, $col)
    {
        if (!$this->db->table_exists($table)) return 0;
        $row = $this->db->select_avg($col, 'avg_x')->get($table)->row();
        return (int) round($row && $row->avg_x ? $row->avg_x : 0);
    }

    private function _distinct_count($table, $col)
    {
        if (!$this->db->table_exists($table)) return 0;
        $row = $this->db->select("COUNT(DISTINCT {$col}) AS c", false)->get($table)->row();
        return $row ? (int) $row->c : 0;
    }

    private function _sum_paise_to_inr()
    {
        if (!$this->db->table_exists('payments')) return 0;
        $row = $this->db->select_sum('amount_paise', 'tot')
            ->where('status', 'paid')->get('payments')->row();
        return $row && $row->tot ? round($row->tot / 100, 2) : 0;
    }

    private function _daily_series($table, $col, $days, $extra_null_safe = null)
    {
        $out = [];
        $start = strtotime(date('Y-m-d', strtotime("-" . ($days - 1) . " days")));
        for ($i = 0; $i < $days; $i++) {
            $out[date('Y-m-d', $start + $i * 86400)] = 0;
        }
        if (!$this->db->table_exists($table)) return $out;

        $since = date('Y-m-d 00:00:00', $start);
        $this->db->select("DATE({$col}) AS d, COUNT(*) AS c", false)
            ->where("{$col} >=", $since);
        if ($extra_null_safe) $this->db->where($extra_null_safe, null, false);
        $rows = $this->db->group_by("DATE({$col})")->get($table)->result();

        foreach ($rows as $r) {
            if (isset($out[$r->d])) $out[$r->d] = (int) $r->c;
        }
        return $out;
    }

    private function _template_resume_split()
    {
        if (!$this->db->table_exists('resumes') || !$this->db->table_exists('resume_templates')) {
            return [];
        }
        return $this->db
            ->select('t.id, t.name, t.slug, COUNT(r.id) AS used', false)
            ->from('resume_templates t')
            ->join('resumes r', 'r.template_id = t.id AND r.deleted_at IS NULL', 'left')
            ->group_by('t.id')
            ->order_by('used', 'DESC')
            ->get()->result();
    }

    private function _template_usage_map()
    {
        $map = [];
        if (!$this->db->table_exists('resumes')) return $map;
        $rows = $this->db->select('template_id, COUNT(*) AS c', false)
            ->where('deleted_at', null)
            ->group_by('template_id')->get('resumes')->result();
        foreach ($rows as $r) $map[(int) $r->template_id] = (int) $r->c;
        return $map;
    }

    private function _top_locations()
    {
        if (!$this->db->table_exists('jobs')) return [];
        return $this->db
            ->select('location, COUNT(*) AS c', false)
            ->where('deleted_at', null)
            ->where("location != ''")
            ->group_by('location')
            ->order_by('c', 'DESC')->limit(6)
            ->get('jobs')->result();
    }

    private function _user_resume_counts()
    {
        $map = [];
        if (!$this->db->table_exists('resumes')) return $map;
        $rows = $this->db->select('user_id, COUNT(*) AS c', false)
            ->where('deleted_at', null)
            ->group_by('user_id')->get('resumes')->result();
        foreach ($rows as $r) $map[(int) $r->user_id] = (int) $r->c;
        return $map;
    }

    private function _ats_score_buckets()
    {
        $buckets = ['0-25' => 0, '26-50' => 0, '51-75' => 0, '76-100' => 0];
        if (!$this->db->table_exists('ats_reports')) return $buckets;
        $rows = $this->db->select('score')->get('ats_reports')->result();
        foreach ($rows as $r) {
            $s = (int) $r->score;
            if ($s <= 25)      $buckets['0-25']++;
            elseif ($s <= 50)  $buckets['26-50']++;
            elseif ($s <= 75)  $buckets['51-75']++;
            else               $buckets['76-100']++;
        }
        return $buckets;
    }
}




