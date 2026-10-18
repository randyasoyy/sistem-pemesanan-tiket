<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        require_user();   
        $this->load->model(['Event_model', 'Transaction_model']);
        $this->load->library('form_validation');
    }

    public function checkout($event_id)
    {
        $event = $this->Event_model->find($event_id);
        if (!$event) show_404();


        if ($event->stok <= 0) {
            $this->session->set_flashdata('error', 'Maaf, tiket sudah habis.');
            redirect('detail/' . $event_id);
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('jumlah_tiket', 'Jumlah Tiket', 'required|integer|greater_than[0]');
            $this->form_validation->set_rules('nama_pemesan', 'Nama Pemesan', 'required|min_length[3]');
            $this->form_validation->set_rules('no_hp', 'No. HP', 'required|numeric|min_length[10]|max_length[15]');

            if ($this->form_validation->run() === TRUE) {
                $jumlah = (int) $this->input->post('jumlah_tiket');

                if ($jumlah > $event->stok) {
                    $this->session->set_flashdata('error', 'Jumlah tiket melebihi stok tersedia (maks ' . $event->stok . ').');
                    redirect('booking/' . $event_id);
                }


                $this->session->set_userdata('booking_data', [
                    'event_id'      => $event_id,
                    'jumlah_tiket'  => $jumlah,
                    'nama_pemesan'  => $this->input->post('nama_pemesan', TRUE),
                    'no_hp'         => $this->input->post('no_hp', TRUE),
                    'catatan'       => $this->input->post('catatan', TRUE),
                ]);


                $kode = 'TRX' . date('YmdHis') . rand(10, 99);
                $trx_id = $this->Transaction_model->create([
                    'kode_booking'  => $kode,
                    'user_id'       => $this->session->userdata('user_id'),
                    'event_id'      => $event_id,
                    'jumlah_tiket'  => $jumlah,
                    'total_harga'   => $jumlah * $event->harga,
                    'nama_pemesan'  => $this->input->post('nama_pemesan', TRUE),
                    'no_hp'         => $this->input->post('no_hp', TRUE),
                    'catatan'       => $this->input->post('catatan', TRUE),
                    'status'        => 'pending',
                ]);

                redirect('payment/' . $trx_id);
            }
        }

        $data['event'] = $event;
        $this->load->view('templates/header');
        $this->load->view('booking/checkout', $data);
        $this->load->view('templates/footer');
    }

    public function my_tickets()
    {
        $uid = $this->session->userdata('user_id');
        $data['transactions'] = $this->Transaction_model->get_by_user($uid);
        $this->load->view('templates/header');
        $this->load->view('booking/my_tickets', $data);
        $this->load->view('templates/footer');
    }

    public function cancel($trx_id)
    {
        $trx = $this->Transaction_model->find($trx_id);
        if (!$trx || $trx->user_id != $this->session->userdata('user_id')) show_404();
        if ($trx->status !== 'pending') {
            $this->session->set_flashdata('error', 'Transaksi tidak bisa dibatalkan.');
            redirect('my-tickets');
        }

        $this->Transaction_model->update_status($trx_id, 'cancelled');
        $this->session->set_flashdata('success', 'Pemesanan berhasil dibatalkan.');
        redirect('my-tickets');
    }
}
