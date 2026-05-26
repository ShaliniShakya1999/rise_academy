<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class Wishlist extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('wishlist_model');
    }

    /**
     * Wishlist page (saved jobs + internships).
     */
    public function index()
    {
        $this->require_login();

        $uid   = $this->current_user_id();
        $items = $this->wishlist_model->for_user($uid);

        $jobs = [];
        $intern = [];
        foreach ($items as $row) {
            $snap = json_decode($row->snapshot_json, true) ?: [];
            $snap['_row_id'] = (int) $row->id;
            $snap['_item_id'] = (int) $row->item_id;
            $snap['_created_at'] = $row->created_at;
            if ($row->item_type === 'job') $jobs[] = $snap;
            else if ($row->item_type === 'internship') $intern[] = $snap;
        }

        $this->loadview('wishlist/index', [
            'page_title'     => 'My Wishlist',
            'jobs'           => $jobs,
            'internships'    => $intern,
            'total'          => count($items),
            'use_user_shell' => true,
            'sidebar_active' => 'wishlist',
        ]);
    }

    /**
     * Toggle save / unsave. Works as both:
     *   - AJAX (X-Requested-With: XMLHttpRequest)  → returns JSON
     *   - Plain POST                                → redirects back
     *
     * If user is NOT logged in: stash the intent in session and redirect to /login.
     * After successful login, Auth controller processes the pending intent.
     */
    public function toggle()
    {
        $type    = $this->input->post('item_type', true);
        $item_id = (int) $this->input->post('item_id');
        $back    = (string) $this->input->post('back');
        $is_ajax = strtolower((string) $this->input->get_request_header('X-Requested-With')) === 'xmlhttprequest';

        if (!in_array($type, ['job', 'internship'], true) || $item_id <= 0) {
            if ($is_ajax) {
                $this->output->set_status_header(400);
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['ok' => false, 'error' => 'Invalid item.']));
            }
            show_error('Invalid item.', 400);
            return;
        }

        if (!$this->session->userdata('logged_in')) {
            $this->session->set_userdata('pending_wishlist', [
                'type'    => $type,
                'item_id' => $item_id,
            ]);
            $this->session->set_userdata('redirect_after_login', $back ?: ($type === 'job' ? site_url('jobs') : site_url('internship')));
            $this->session->set_flashdata('info', 'Please sign in to save this ' . $type . ' to your wishlist.');

            if ($is_ajax) {
                $this->output->set_status_header(401);
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode([
                        'ok' => false,
                        'auth_required' => true,
                        'login_url' => site_url('login'),
                    ]));
            }
            redirect('login');
            return;
        }

        $snapshot = $this->_build_snapshot($type, $item_id);
        $saved    = $this->wishlist_model->toggle($this->current_user_id(), $type, $item_id, $snapshot);

        if ($is_ajax) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'ok'    => true,
                'saved' => (bool) $saved,
                'count' => $this->wishlist_model->count_for_user($this->current_user_id()),
            ]));
        }

        $this->session->set_flashdata('wish_ok', $saved
            ? 'Added to your wishlist.'
            : 'Removed from your wishlist.');
        redirect($back ?: site_url($type === 'job' ? 'jobs' : 'internship'));
    }

    /**
     * Remove a single wishlist row (used from the wishlist page).
     */
    public function remove($id)
    {
        $this->require_login();
        $id  = (int) $id;
        $uid = $this->current_user_id();

        $row = $this->db->where('id', $id)->where('user_id', $uid)->get('wishlist_items')->row();
        if ($row) {
            $this->wishlist_model->remove($uid, $row->item_type, (int) $row->item_id);
            $this->session->set_flashdata('wish_ok', 'Removed from your wishlist.');
        }
        redirect('wishlist');
    }

    /**
     * Build a denormalised snapshot we can show on the wishlist page even if
     * the original row is deleted/edited later.
     */
    private function _build_snapshot($type, $item_id)
    {
        if ($type === 'job') {
            $this->load->model('job_model');
            $row = $this->job_model->find($item_id);
            if (!$row) return ['type' => 'job', 'item_id' => $item_id];
            return [
                'type'      => 'job',
                'id'        => 'job-' . (int) $row->id,
                'item_id'   => (int) $row->id,
                'title'     => $row->title,
                'company'   => $row->company,
                'location'  => $row->location,
                'logo'      => $row->logo_text,
                'salary'    => $row->salary_label,
                'employment_type' => $row->employment_type,
                'savedDate' => date('d M Y'),
            ];
        }

        $this->load->model('internship_model');
        $row = $this->internship_model->find($item_id);
        if (!$row) return ['type' => 'internship', 'item_id' => $item_id];
        return [
            'type'      => 'internship',
            'id'        => 'internship-' . (int) $row->id,
            'item_id'   => (int) $row->id,
            'title'     => $row->title,
            'company'   => $row->company,
            'location'  => $row->location,
            'logo'      => $row->logo_text,
            'salary'    => $row->stipend_label,
            'category'  => $row->category,
            'duration_weeks' => $row->duration_weeks,
            'savedDate' => date('d M Y'),
        ];
    }
}




