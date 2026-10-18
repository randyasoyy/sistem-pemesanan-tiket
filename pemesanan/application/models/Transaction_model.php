<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

    private $table = 'transactions';

    

    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function find($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function find_with_event($id) {
        $this->db->select('t.*, e.nama_event, e.kategori, e.lokasi, e.tanggal AS tgl_event, e.harga');
        $this->db->from($this->table . ' t');
        $this->db->join('events e', 'e.id = t.event_id');
        $this->db->where('t.id', $id);
        return $this->db->get()->row();
    }

    public function get_by_user($uid) {
        $this->db->select('t.*, e.nama_event, e.kategori, e.lokasi, e.tanggal AS tgl_event');
        $this->db->from($this->table . ' t');
        $this->db->join('events e', 'e.id = t.event_id');
        $this->db->where('t.user_id', $uid);
        $this->db->order_by('t.created_at', 'DESC');
        return $this->db->get()->result();
    }

    
    public function get_all($status = null) {
        $this->db->select('t.*, u.nama AS user_nama, u.email AS user_email, e.nama_event');
        $this->db->from($this->table . ' t');
        $this->db->join('users u', 'u.id = t.user_id');
        $this->db->join('events e', 'e.id = t.event_id');
        if ($status) $this->db->where('t.status', $status);
        $this->db->order_by('t.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_recent($limit = 5) {
        $this->db->select('t.*, u.nama AS user_nama, e.nama_event');
        $this->db->from($this->table . ' t');
        $this->db->join('users u', 'u.id = t.user_id');
        $this->db->join('events e', 'e.id = t.event_id');
        $this->db->order_by('t.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    
    public function update_status($id, $status, $metode = null) {
        $data = ['status' => $status];
        if ($metode) {
            $data['metode_pembayaran'] = $metode;
            $data['paid_at'] = date('Y-m-d H:i:s');
        }
        return $this->db->update($this->table, $data, ['id' => $id]);
    }


    public function count_paid() {
        return $this->db->where('status', 'paid')->count_all_results($this->table);
    }

    public function count_by_status($status) {
        return $this->db->where('status', $status)->count_all_results($this->table);
    }

    public function total_revenue() {
        $r = $this->db->select_sum('total_harga')
                      ->where('status', 'paid')
                      ->get($this->table)->row();
        return $r->total_harga ?? 0;
    }
}