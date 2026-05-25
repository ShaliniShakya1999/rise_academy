<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class Resume extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('resume_model');
        $this->load->model('template_model');
    }

    public function dashboard()
    {
        $this->require_login();

        $uid       = $this->current_user_id();
        $resumes   = $this->resume_model->for_user($uid);
        $templates = $this->template_model->all_active();

        $avg = null;
        if (!empty($resumes)) {
            $sum = 0;
            foreach ($resumes as $r) {
                $sum += (int) ($r->completion_score ?? 0);
            }
            $avg = (int) round($sum / count($resumes));
        }

        $this->loadview('resume/dashboard', [
            'page_title'           => 'Dashboard',
            'resumes'              => $resumes,
            'templates'            => $templates,
            'full_name'            => $this->session->userdata('full_name'),
            'use_user_shell'       => true,
            'sidebar_active'       => 'dashboard',
            'shell_avg_completion' => $avg,
        ]);
    }

    public function create($template_id = 1)
    {
        $this->require_login();

        $template_id = max(1, (int) $template_id);
        $template    = $this->template_model->find($template_id);
        if (!$template) {
            show_error('Template not found.', 404);
            return;
        }

        $id = $this->resume_model->create(
            $this->current_user_id(),
            $template_id,
            'Untitled Resume'
        );

        // Seed empty sections so the editor has rows to render.
        $order = 0;
        foreach (Resume_model::default_sections() as $key => $payload) {
            $this->resume_model->upsert_section($id, $key, $payload, $order++);
        }

        redirect('resume/edit/' . $id);
    }

    public function edit($id = null)
    {
        $this->require_login();

        if ($id === null) {
            $existing = $this->resume_model->for_user($this->current_user_id());
            if (!empty($existing)) {
                redirect('resume/edit/' . (int) $existing[0]->id);
                return;
            }
            redirect('resume/create/1');
            return;
        }

        $resume = $this->resume_model->find((int) $id, $this->current_user_id());
        if (!$resume) {
            show_error('Resume not found.', 404);
            return;
        }

        $this->loadview('resume/edit', [
            'page_title' => 'Editing  -  ' . $resume->title,
            'resume'     => $resume,
            'sections'   => $this->resume_model->get_sections((int) $resume->id),
            'templates'  => $this->template_model->all_active(),
        ], 'editor_layout');
    }

    /**
     * AJAX endpoint  -  persists title, template and the full sections payload.
     */
    public function save($id)
    {
        $this->require_login();

        $resume = $this->resume_model->find((int) $id, $this->current_user_id());
        if (!$resume) {
            $this->output->set_status_header(404);
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['ok' => false, 'error' => 'Resume not found.']));
        }

        $title       = trim((string) $this->input->post('title'));
        $template_id = (int) $this->input->post('template_id');
        $raw         = (string) $this->input->post('sections');
        $sections    = json_decode($raw, true);

        $meta = [];
        if ($title !== '')         $meta['title']       = $title;
        if ($template_id > 0)      $meta['template_id'] = $template_id;

        if (is_array($sections)) {
            $score = $this->_completion_score($sections);
            $meta['completion_score'] = $score;
        }

        if (!empty($meta)) {
            $this->resume_model->update_meta((int) $resume->id, $this->current_user_id(), $meta);
        }

        if (is_array($sections)) {
            $order = 0;
            foreach (Resume_model::default_sections() as $key => $_default) {
                $payload = isset($sections[$key]) && is_array($sections[$key])
                    ? $sections[$key]
                    : $_default;
                $this->resume_model->upsert_section((int) $resume->id, $key, $payload, $order++);
            }
            foreach ($sections as $key => $payload) {
                if (!array_key_exists($key, Resume_model::default_sections()) && is_array($payload)) {
                    $this->resume_model->upsert_section((int) $resume->id, $key, $payload, $order++);
                }
            }
        }

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'ok'       => true,
                'saved_at' => date('H:i:s'),
                'score'    => isset($meta['completion_score']) ? $meta['completion_score'] : null,
            ]));
    }

    /**
     * Completion score 0 - 100 based on filled sections.
     */
    private function _completion_score(array $sections)
    {
        $h    = isset($sections['header'])     ? $sections['header']     : [];
        $sum  = isset($sections['summary'])    ? $sections['summary']    : [];
        $exp  = isset($sections['experience']['items']) ? $sections['experience']['items'] : [];
        $edu  = isset($sections['education']['items'])  ? $sections['education']['items']  : [];
        $sk   = isset($sections['skills']['items'])     ? $sections['skills']['items']     : [];
        $pj   = isset($sections['projects']['items'])   ? $sections['projects']['items']   : [];
        $ach  = isset($sections['achievements']['items']) ? $sections['achievements']['items'] : [];

        $checks = [
            !empty($h['name']),
            !empty($h['email']),
            !empty($h['phone']),
            !empty($sum['text']),
            count(array_filter($exp, [$this, '_not_empty_item'])) > 0,
            count(array_filter($edu, [$this, '_not_empty_item'])) > 0,
            count($sk) > 0,
            count(array_filter($pj, [$this, '_not_empty_item'])) > 0,
            count(array_filter($ach, [$this, '_not_empty_item'])) > 0,
            !empty($h['linkedin']) || !empty($h['github']) || !empty($h['website']),
        ];
        $filled = count(array_filter($checks));
        return (int) round(($filled / count($checks)) * 100);
    }

    public function _not_empty_item($it)
    {
        if (!is_array($it)) return false;
        foreach ($it as $v) {
            if ($v !== null && trim((string) $v) !== '') return true;
        }
        return false;
    }

    public function delete($id)
    {
        $this->require_login();
        $this->resume_model->soft_delete((int) $id, $this->current_user_id());
        $this->session->set_flashdata('success', 'Resume deleted.');
        redirect('dashboard');
    }
}




