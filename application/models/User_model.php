<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'users';

    public function get_by_email($email)
    {
        return $this->db
            ->where('email', $email)
            ->where('deleted_at', null)
            ->get($this->table)
            ->row();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->where('deleted_at', null)
            ->get($this->table)
            ->row();
    }

    public function update_last_login($id)
    {
        $now = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update($this->table, [
            'last_login_at' => $now,
            'updated_at'    => $now,
        ]);
    }

    public function create($data)
    {
        $now = date('Y-m-d H:i:s');
        $row = array_merge([
            'created_at' => $now,
            'updated_at' => $now,
        ], $data);
        $this->db->insert($this->table, $row);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function paginate($limit = 20, $offset = 0, $search = '')
    {
        $this->db->where('deleted_at', null);
        if ($search !== '') {
            $this->db->group_start()
                ->like('email', $search)
                ->or_like('full_name', $search)
                ->or_like('mobile', $search)
                ->group_end();
        }
        return $this->db->order_by('id', 'DESC')->limit($limit, $offset)->get($this->table)->result();
    }

    public function count_all($search = '')
    {
        $this->db->where('deleted_at', null);
        if ($search !== '') {
            $this->db->group_start()
                ->like('email', $search)
                ->or_like('full_name', $search)
                ->or_like('mobile', $search)
                ->group_end();
        }
        return $this->db->count_all_results($this->table);
    }

    public function soft_delete($id)
    {
        return $this->db->where('id', $id)->update($this->table, [
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
