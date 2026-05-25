<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model
{
    private $table = 'jobs';

    public function active($limit = 50, $filters = [])
    {
        $this->db->where('deleted_at', null);
        if (!empty($filters['category'])) {
            $this->db->where('category', $filters['category']);
        }
        if (!empty($filters['employment_type'])) {
            $this->db->where('employment_type', $filters['employment_type']);
        }
        if (!empty($filters['q'])) {
            $q = $filters['q'];
            $this->db->group_start()
                ->like('title', $q)
                ->or_like('company', $q)
                ->or_like('location', $q)
                ->or_like('search_blob', $q)
                ->group_end();
        }
        return $this->db
            ->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get($this->table)->result();
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->where('deleted_at', null)->get($this->table)->row();
    }

    public function categories()
    {
        $rows = $this->db->distinct()->select('category')->where('deleted_at', null)->get($this->table)->result();
        return array_map(function ($r) { return $r->category; }, $rows);
    }

    public function count_all()
    {
        return $this->db->where('deleted_at', null)->count_all_results($this->table);
    }
}




