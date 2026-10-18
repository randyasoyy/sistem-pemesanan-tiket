<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends CI_Model
{

    private $table = 'events';

    public function get_all()
    {
        return $this->db->order_by('tanggal', 'DESC')->get($this->table)->result();
    }

    public function get_all_available() {
    return $this->db->where('stok >', 0)
                    ->where('tanggal >', '2000-01-01 00:00:00')  
                    ->order_by('tanggal', 'ASC')
                    ->get($this->table)->result();
}

    public function get_by_kategori($kategori)
    {
        return $this->db->where('kategori', $kategori)
            ->where('stok >', 0)
            ->where('tanggal >= NOW()', NULL, FALSE)
            ->order_by('tanggal', 'ASC')
            ->get($this->table)->result();
    }

    public function get_rekomendasi($kategori, $exclude_id)
    {
        return $this->db->where('kategori', $kategori)
            ->where('id !=', $exclude_id)
            ->where('stok >', 0)
            ->where('tanggal >= NOW()', NULL, FALSE)
            ->order_by('tanggal', 'ASC')
            ->limit(3)
            ->get($this->table)->result();
    }

    public function find($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function count()
    {
        return $this->db->count_all($this->table);
    }

    public function count_by_kategori($kategori)
    {
        return $this->db->where('kategori', $kategori)->count_all_results($this->table);
    }

    public function reduce_stock($id, $qty)
    {
        $this->db->set('stok', 'stok - ' . (int)$qty, FALSE)
            ->where('id', $id)
            ->where('stok >=', (int)$qty)
            ->update($this->table);
        return $this->db->affected_rows() > 0;
    }
}
