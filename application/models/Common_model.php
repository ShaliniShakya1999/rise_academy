<?php


class Common_Model extends CI_Model
{

    function getdata($tbl = NUll, $col = Null, $cond = Null, $limit = null, $order_col = null, $order_by = null, $group_by = NULL)
    {

        $res = [];
        if (!empty($tbl)) {
            if (!empty($col)) {
                $this->db->select($col);
            }
            if (!empty($cond)) {
                $this->db->where($cond);
            }
            if (!empty($limit)) {
                $this->db->limit($limit);
            }
            if (!empty($order_col) && !empty($order_by)) {
                $this->db->order_by($order_col, $order_by);
            }
            if (!empty($group_by)) {
                $this->db->group_by($group_by);
            }
            $query = $this->db->get($tbl);
            if ($query !== false) {
                $res = $query->result_array();
            }
        }

        return $res;
    }
    function get($tbl = NUll, $col = Null, $cond = Null)
    {

        $res = [];
        if (!empty($tbl)) {
            if (!empty($col)) {
                $this->db->select($col);
            }
            if (!empty($cond)) {
                $this->db->where($cond);
            }
            $res = $this->db->get($tbl)->row_array();
        }

        return $res;
    }
    function adddata($tbl = Null, $record = Null)
    {
        if (!empty($tbl) && !empty($record)) {
            $this->db->insert($tbl, $record);
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    function editdata($tbl, $cond, $record = Null)
    {
        if (!empty($tbl)) {
            if (!empty($cond)) {
                $this->db->where($cond);
            }
            $res = $this->db->update($tbl, $record);
        }
        return $res;
    }
    public function getRecordCount($tbl = NULL, $cond = NULL)
    {
        if (!empty($cond)) {
            $this->db->where($cond);
        }
        $res = $this->db->count_all_results($tbl);
        return $res;
    }
    function loadSql($file, $data = [])
    {
        $file = APPPATH . "sql/" . $file . ".sql";
        $sql = file_get_contents($file);

        foreach ($data as $key => $value) {
            $sql = str_replace("##" . $key . "##", $value, $sql);
        }
        return $sql;
    }
    public function query($sql)
    {
        $res = $this->db->query($sql);
        return $res->result_array();
    }
}




