<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * `wishlist_items` â€” id, user_id, item_type ENUM('job','internship'), item_id,
 *                    snapshot_json, created_at
 * Unique key: (user_id, item_type, item_id)
 */
class Wishlist_model extends CI_Model
{
    private $table = 'wishlist_items';

    public function is_saved($user_id, $type, $item_id)
    {
        return (bool) $this->db
            ->where('user_id', (int) $user_id)
            ->where('item_type', $type)
            ->where('item_id', (int) $item_id)
            ->count_all_results($this->table);
    }

    public function ids_for_user($user_id, $type)
    {
        $rows = $this->db
            ->select('item_id')
            ->where('user_id', (int) $user_id)
            ->where('item_type', $type)
            ->get($this->table)->result();
        return array_map(function ($r) { return (int) $r->item_id; }, $rows);
    }

    public function add($user_id, $type, $item_id, $snapshot = [])
    {
        if ($this->is_saved($user_id, $type, $item_id)) {
            return true;
        }
        return $this->db->insert($this->table, [
            'user_id'       => (int) $user_id,
            'item_type'     => $type,
            'item_id'       => (int) $item_id,
            'snapshot_json' => json_encode($snapshot, JSON_UNESCAPED_UNICODE),
            'created_at'    => date('Y-m-d H:i:s'),
        ]);
    }

    public function remove($user_id, $type, $item_id)
    {
        return $this->db
            ->where('user_id', (int) $user_id)
            ->where('item_type', $type)
            ->where('item_id', (int) $item_id)
            ->delete($this->table);
    }

    /**
     * Toggle: if saved â†’ remove; else â†’ add. Returns new saved state (bool).
     */
    public function toggle($user_id, $type, $item_id, $snapshot = [])
    {
        if ($this->is_saved($user_id, $type, $item_id)) {
            $this->remove($user_id, $type, $item_id);
            return false;
        }
        $this->add($user_id, $type, $item_id, $snapshot);
        return true;
    }

    public function for_user($user_id, $type = null)
    {
        $this->db->where('user_id', (int) $user_id);
        if ($type !== null) $this->db->where('item_type', $type);
        return $this->db
            ->order_by('created_at', 'DESC')
            ->get($this->table)->result();
    }

    public function count_for_user($user_id)
    {
        return $this->db->where('user_id', (int) $user_id)->count_all_results($this->table);
    }
}




