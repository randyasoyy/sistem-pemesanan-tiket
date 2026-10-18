<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $table = 'users';

    public function find_by_email($email) {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    public function find($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_all() {
        return $this->db->order_by('id', 'DESC')->get($this->table)->result();
    }

    public function update($id, $data) {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function count() {
        return $this->db->count_all($this->table);
    }

    public function count_by_role($role) {
        return $this->db->where('role', $role)->count_all_results($this->table);
    }
}