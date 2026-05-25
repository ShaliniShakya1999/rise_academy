<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    protected $table = 'projects';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($limit = 100, $offset = 0) {
        return $this->db->order_by('created_at', 'DESC')
                        ->limit($limit, $offset)
                        ->get($this->table)
                        ->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_by_user($user_id) {
        return $this->db->order_by('created_at', 'DESC')
                        ->get_where($this->table, ['user_id' => $user_id])
                        ->result();
    }

    public function insert($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function count_all() {
        return $this->db->count_all($this->table);
    }

    public function get_stats() {
        return [
            'total'    => $this->db->count_all($this->table),
            'pending'  => $this->db->where('status', 'pending')->count_all_results($this->table),
            'approved' => $this->db->where('status', 'approved')->count_all_results($this->table),
            'rejected' => $this->db->where('status', 'rejected')->count_all_results($this->table),
        ];
    }
}




