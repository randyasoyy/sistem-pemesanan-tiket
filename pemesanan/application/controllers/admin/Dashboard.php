<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require_admin();   
        $this->load->model(['Event_model', 'User_model', 'Transaction_model']);
    }

    public function index() {
        $data['page_title'] = 'Dashboard';
        $data['total_event']     = $this->Event_model->count();
        $data['total_konser']    = $this->Event_model->count_by_kategori('konser');
        $data['total_bioskop']   = $this->Event_model->count_by_kategori('bioskop');
        $data['total_transport'] = $this->Event_model->count_by_kategori('transportasi');
        $data['total_user']      = $this->User_model->count();
        $data['total_trx']       = $this->Transaction_model->count_paid();
        $data['total_pending']   = $this->Transaction_model->count_by_status('pending');
        $data['pendapatan']      = $this->Transaction_model->total_revenue();
        $data['recent_trx']      = $this->Transaction_model->get_recent(5);

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }
}