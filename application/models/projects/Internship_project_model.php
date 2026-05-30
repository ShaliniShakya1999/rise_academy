<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internship_project_model extends CI_Model
{
    private $table = 'internship_projects';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function submit($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_user($user_id) {
        return $this->db->where('user_id', $user_id)
                        ->order_by('id', 'DESC')
                        ->get($this->table)
                        ->row();
    }

    public function get_all_submissions() {
        return $this->db->select('ip.*, iu.full_name, iu.email, iu.applied_for')
                        ->from($this->table . ' ip')
                        ->join('internship_users iu', 'iu.id = ip.user_id', 'left')
                        ->order_by('ip.submitted_at', 'DESC')
                        ->get()
                        ->result();
    }

    public function update_status($id, $status) {
        return $this->db->where('id', $id)->update($this->table, ['status' => $status]);
    }
}




