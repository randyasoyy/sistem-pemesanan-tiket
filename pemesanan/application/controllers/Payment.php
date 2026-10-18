<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require_user();   
        $this->load->model(['Transaction_model', 'Event_model']);
    }

     public function pay($trx_id) {
        $trx = $this->Transaction_model->find_with_event($trx_id);

        if (!$trx || $trx->user_id != $this->session->userdata('user_id')) {
            show_404();
        }

        if ($trx->status !== 'pending') {
            $this->session->set_flashdata('error', 'Transaksi ini sudah tidak pending.');
            redirect('my-tickets');
        }

        if ($this->input->post()) {
            $metode = $this->input->post('metode', TRUE);
            if (!in_array($metode, ['transfer', 'ewallet', 'qris', 'va'])) {
                $this->session->set_flashdata('error', 'Metode pembayaran tidak valid.');
                redirect('payment/' . $trx_id);
            }

           
            $event = $this->Event_model->find($trx->event_id);
            if (!$event || $event->stok < $trx->jumlah_tiket) {
                $this->Transaction_model->update_status($trx_id, 'cancelled');
                $this->session->set_flashdata('error', 'Stok tiket sudah habis. Transaksi dibatalkan.');
                redirect('my-tickets');
            }

            
            $this->db->trans_start();
            $this->Transaction_model->update_status($trx_id, 'paid', $metode);
            $this->Event_model->reduce_stock($trx->event_id, $trx->jumlah_tiket);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Pembayaran gagal diproses. Coba lagi.');
                redirect('payment/' . $trx_id);
            }

            $this->session->set_flashdata('success', 'Pembayaran berhasil! Tiket Anda sudah aktif.');
            redirect('payment/success/' . $trx_id);
        }

        $data['trx'] = $trx;
        $this->load->view('templates/header');
        $this->load->view('booking/payment', $data);
        $this->load->view('templates/footer');
    }

    
    public function success($trx_id) {
        $trx = $this->Transaction_model->find_with_event($trx_id);
        if (!$trx || $trx->user_id != $this->session->userdata('user_id')) show_404();
        if ($trx->status !== 'paid') redirect('my-tickets');

        $data['trx'] = $trx;
        $this->load->view('templates/header');
        $this->load->view('booking/success', $data);
        $this->load->view('templates/footer');
    }

}