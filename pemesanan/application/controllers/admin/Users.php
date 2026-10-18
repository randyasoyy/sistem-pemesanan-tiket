<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') !== 'admin') redirect('login');
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['page_title'] = 'Kelola User';
        $data['users'] = $this->User_model->get_all();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Tidak bisa hapus akun sendiri.');
            redirect('admin/users');
        }
        $this->User_model->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus.');
        redirect('admin/users');
    }

    public function toggle_role($id)
    {
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Tidak bisa ubah role sendiri.');
            redirect('admin/users');
        }
        $user = $this->User_model->find($id);
        if (!$user) show_404();

        $new_role = $user->role === 'admin' ? 'user' : 'admin';
        $this->User_model->update($id, ['role' => $new_role]);

        $this->session->set_flashdata(
            'success',
            'Role ' . $user->nama . ' diubah jadi ' . strtoupper($new_role)
        );
        redirect('admin/users');
    }
}
