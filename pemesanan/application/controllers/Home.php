<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Event_model');
        
    }

    public function index() {
        $kategori = $this->input->get('kategori', TRUE);

        $data['kategori_aktif'] = $kategori;

        if ($kategori && in_array($kategori, ['konser', 'bioskop', 'transportasi'])) {
            $data['events'] = $this->Event_model->get_by_kategori($kategori);
        } else {
            $data['events'] = $this->Event_model->get_all_available();
        }

        $this->load->view('templates/header');
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id) {
        $data['event'] = $this->Event_model->find($id);
        if (!$data['event']) show_404();

        $data['rekomendasi'] = $this->Event_model->get_rekomendasi(
            $data['event']->kategori, $id
        );

        $this->load->view('templates/header');
        $this->load->view('home/detail', $data);
        $this->load->view('templates/footer');
    }
}