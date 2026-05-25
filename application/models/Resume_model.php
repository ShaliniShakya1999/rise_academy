<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * `resumes`         â€” id, user_id, template_id, title, completion_score, ...
 * `resume_sections` â€” id, resume_id, section_key, section_json, sort_order
 *
 * Sections keys used by the official dump:
 *   header, summary, education, experience, skills, clubs, projects,
 *   achievements, volunteering, extra_curricular
 */
class Resume_model extends CI_Model
{
    private $table          = 'resumes';
    private $sections_table = 'resume_sections';

    /**
     * Canonical section order + default empty payload.
     */
    public static function default_sections()
    {
        return [
            'header'           => ['name' => '', 'email' => '', 'phone' => ''],
            'summary'          => ['text' => ''],
            'education'        => ['items' => []],
            'experience'       => ['items' => []],
            'skills'           => ['items' => [], 'language_tags' => []],
            'clubs'            => ['items' => []],
            'projects'         => ['items' => []],
            'achievements'     => ['items' => []],
            'volunteering'     => ['items' => []],
            'extra_curricular' => ['items' => []],
        ];
    }

    public function for_user($user_id)
    {
        return $this->db
            ->select('r.*, t.slug AS template_slug, t.name AS template_name')
            ->from($this->table . ' r')
            ->join('resume_templates t', 't.id = r.template_id', 'left')
            ->where('r.user_id', $user_id)
            ->where('r.deleted_at', null)
            ->order_by('r.updated_at', 'DESC')
            ->get()->result();
    }

    public function find($id, $user_id = null)
    {
        $this->db->where('id', $id)->where('deleted_at', null);
        if ($user_id !== null) $this->db->where('user_id', $user_id);
        return $this->db->get($this->table)->row();
    }

    /**
     * Returns resume sections as ['header' => [...], 'summary' => [...], ...]
     * Missing sections fall back to default empty payload.
     */
    public function get_sections($resume_id)
    {
        $rows = $this->db
            ->where('resume_id', $resume_id)
            ->order_by('sort_order', 'ASC')
            ->get($this->sections_table)->result();

        $sections = self::default_sections();
        foreach ($rows as $r) {
            $decoded = json_decode($r->section_json, true);
            if (is_array($decoded)) {
                $sections[$r->section_key] = $decoded;
            }
        }
        return $sections;
    }

    public function create($user_id, $template_id = null, $title = 'My Resume')
    {
        $now = date('Y-m-d H:i:s');
        $this->db->insert($this->table, [
            'user_id'          => $user_id,
            'template_id'      => $template_id ?: null,
            'title'            => $title,
            'completion_score' => 0,
            'created_at'       => $now,
            'updated_at'       => $now,
        ]);
        return $this->db->insert_id();
    }

    /**
     * Upsert a single section's JSON payload.
     */
    public function upsert_section($resume_id, $section_key, array $payload, $sort_order = 0)
    {
        $exists = $this->db
            ->where('resume_id', $resume_id)
            ->where('section_key', $section_key)
            ->get($this->sections_table)->row();

        $json = json_encode($payload, JSON_UNESCAPED_UNICODE);

        if ($exists) {
            $this->db->where('id', $exists->id)->update($this->sections_table, [
                'section_json' => $json,
                'sort_order'   => $sort_order,
            ]);
            return (int) $exists->id;
        }

        $this->db->insert($this->sections_table, [
            'resume_id'    => $resume_id,
            'section_key'  => $section_key,
            'section_json' => $json,
            'sort_order'   => $sort_order,
        ]);
        return (int) $this->db->insert_id();
    }

    public function update_meta($id, $user_id, $meta)
    {
        $meta['updated_at'] = date('Y-m-d H:i:s');
        return $this->db
            ->where('id', $id)->where('user_id', $user_id)
            ->update($this->table, $meta);
    }

    public function soft_delete($id, $user_id)
    {
        return $this->db
            ->where('id', $id)->where('user_id', $user_id)
            ->update($this->table, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function count_for_user($user_id)
    {
        return $this->db->where('user_id', $user_id)->where('deleted_at', null)->count_all_results($this->table);
    }

    public function total_count()
    {
        return $this->db->where('deleted_at', null)->count_all_results($this->table);
    }
}




