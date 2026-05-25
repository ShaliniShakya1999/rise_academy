<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * resume_templates  (id, slug, name, description, is_active, created_at)
 *
 * Matches the canonical `jobportal` dump  -  no `sort_order`, `category`,
 * or `preview_image` columns. We order by id.
 */
class Template_model extends CI_Model
{
    private $table = 'resume_templates';

    public function all_active()
    {
        return $this->db
            ->where('is_active', 1)
            ->order_by('id', 'ASC')
            ->get($this->table)->result();
    }

    public function all()
    {
        return $this->db->order_by('id', 'ASC')->get($this->table)->result();
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function find_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->get($this->table)->row();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function set_active($id, $is_active)
    {
        return $this->db->where('id', $id)->update($this->table, ['is_active' => $is_active ? 1 : 0]);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }
}




