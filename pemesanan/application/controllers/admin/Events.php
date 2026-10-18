<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') redirect('login');
        $this->load->model('Event_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kategori = $this->input->get('kategori', TRUE);

        $data['page_title']     = 'Kelola Event';
        $data['kategori_aktif'] = $kategori;

        if ($kategori && in_array($kategori, ['konser', 'bioskop', 'transportasi'])) {
            $data['events'] = $this->db->where('kategori', $kategori)
                ->order_by('tanggal', 'DESC')
                ->get('events')->result();
        } else {
            $data['events'] = $this->Event_model->get_all();
        }

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/events/index', $data);
        $this->load->view('admin/templates/footer');
    }


    public function create()
    {
        $data['page_title'] = 'Tambah Event';

        if ($this->input->post()) {
            $this->form_validation->set_rules('nama_event', 'Nama Event', 'required|min_length[3]');
            $this->form_validation->set_rules('kategori', 'Kategori', 'required|in_list[konser,bioskop,transportasi]');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('stok', 'Stok', 'required|integer|greater_than[0]');

            if ($this->form_validation->run() === TRUE) {
                $this->Event_model->create($this->build_data());
                $this->session->set_flashdata('success', 'Event berhasil ditambahkan!');
                redirect('admin/events');
            }
        }

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/events/form', $data);
        $this->load->view('admin/templates/footer');
    }


    public function edit($id)
    {
        $event = $this->Event_model->find($id);
        if (!$event) show_404();

        $data['page_title'] = 'Edit Event';
        $data['event'] = $event;

        if ($this->input->post()) {
            $this->form_validation->set_rules('nama_event', 'Nama Event', 'required|min_length[3]');
            $this->form_validation->set_rules('kategori', 'Kategori', 'required|in_list[konser,bioskop,transportasi]');
            $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('harga', 'Harga', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('stok', 'Stok', 'required|integer|greater_than[0]');

            if ($this->form_validation->run() === TRUE) {
                $this->Event_model->update($id, $this->build_data());
                $this->session->set_flashdata('success', 'Event berhasil diupdate!');
                redirect('admin/events');
            }
        }

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/events/form', $data);
        $this->load->view('admin/templates/footer');
    }


    public function delete($id)
    {
        $event = $this->Event_model->find($id);
        if (!$event) show_404();

        $this->Event_model->delete($id);
        $this->session->set_flashdata('success', 'Event "' . $event->nama_event . '" berhasil dihapus.');
        redirect('admin/events');
    }


    // application/controllers/admin/Events.php

    private function build_data()
    {
        $kategori = $this->input->post('kategori', TRUE);

        // ========== FIX TANGGAL ==========
        $tanggal_input = $this->input->post('tanggal');
        if (empty($tanggal_input) || $tanggal_input === '0000-00-00') {
            $tanggal_input = date('Y-m-d');
        }

        $jam_mulai = $this->input->post('jam_mulai');
        if (empty($jam_mulai)) {
            $jam_mulai = '00:00';
        }
        
        $jam_mulai = substr($jam_mulai, 0, 5);

        
        $tanggal_full = $tanggal_input . ' ' . $jam_mulai . ':00';

       
        $data = [
            'nama_event' => $this->input->post('nama_event', TRUE),
            'kategori'   => $kategori,
            'deskripsi'  => $this->input->post('deskripsi', TRUE),
            'lokasi'     => $this->input->post('lokasi', TRUE),
            'tanggal'    => $tanggal_full,
            'harga'      => $this->input->post('harga', TRUE),
            'stok'       => $this->input->post('stok', TRUE),
        ];

        // Reset field spesifik
        $data['artis']           = NULL;
        $data['jam_mulai']       = NULL;
        $data['kelas_tiket']     = NULL;
        $data['studio']          = NULL;
        $data['durasi_menit']    = NULL;
        $data['asal']            = NULL;
        $data['tujuan']          = NULL;
        $data['jenis_kendaraan'] = NULL;
        $data['jam_tiba']        = NULL;

        // ========== FIELD PER KATEGORI ==========
        if ($kategori === 'konser') {
            $data['artis']       = $this->input->post('artis', TRUE);
            $data['jam_mulai']   = $jam_mulai;
            $data['kelas_tiket'] = $this->input->post('kelas_tiket', TRUE);
        } elseif ($kategori === 'bioskop') {
            $data['studio']       = $this->input->post('studio', TRUE);
            $data['durasi_menit'] = $this->input->post('durasi_menit', TRUE);
            $data['jam_mulai']    = $jam_mulai;
        } elseif ($kategori === 'transportasi') {
            $data['asal']            = $this->input->post('asal', TRUE);
            $data['tujuan']          = $this->input->post('tujuan', TRUE);
            $data['jenis_kendaraan'] = $this->input->post('jenis_kendaraan', TRUE);
            $data['jam_mulai']       = $jam_mulai;
            $data['jam_tiba']        = $this->input->post('jam_tiba', TRUE);
        }

        return $data;
    }
}
