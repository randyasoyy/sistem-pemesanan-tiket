<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') redirect('login');
        $this->load->model('Transaction_model');
    }

    public function index()
    {
        $status = $this->input->get('status', TRUE);

        $data['page_title']   = 'Transaksi';
        $data['status_aktif'] = $status;
        $data['transactions'] = $this->Transaction_model->get_all($status);

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/transactions/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function cancel($id)
    {
        $this->Transaction_model->update_status($id, 'cancelled');
        $this->session->set_flashdata('success', 'Transaksi dibatalkan.');
        redirect('admin/transactions');
    }
}
