<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internship_model extends CI_Model
{
    private $table = 'internships';
    private $app_table = 'internship_applications';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($limit = 100) {
        return $this->db->order_by('created_at', 'DESC')
                        ->limit($limit)
                        ->get($this->table)
                        ->result();
    }

    public function active($limit = 50, $filters = []) {
        $this->db->where('status', 'active');
        if (!empty($filters['category'])) {
            $this->db->where('category', $filters['category']);
        }
        if (!empty($filters['q'])) {
            $this->db->group_start()
                ->like('title', $filters['q'])
                ->or_like('description', $filters['q'])
                ->group_end();
        }
        return $this->db->order_by('created_at', 'DESC')
                        ->limit($limit)
                        ->get($this->table)
                        ->result();
    }

    public function categories() {
        $rows = $this->db->distinct()->select('category')->get($this->table)->result();
        return array_map(function ($r) { return $r->category; }, $rows);
    }

    public function count_all() {
        return $this->db->where('status', 'active')->count_all_results($this->table);
    }

    public function find($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    // Applications
    public function get_applications($limit = 100) {
        return $this->db->select('ia.*, i.title as internship_title')
                        ->from($this->app_table . ' ia')
                        ->join($this->table . ' i', 'i.id = ia.internship_id', 'left')
                        ->order_by('ia.applied_at', 'DESC')
                        ->limit($limit)
                        ->get()
                        ->result();
    }

    public function get_stats() {
        return [
            'total_internships' => $this->db->count_all($this->table),
            'total_applications' => $this->db->count_all($this->app_table),
            'recent_apps' => $this->db->where('status', 'pending')->count_all_results($this->app_table)
        ];
    }
}




