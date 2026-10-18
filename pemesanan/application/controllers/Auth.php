<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

       const ADMIN_REGISTER_CODE = 'ADMIN2026';

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation', 'session']);
    }

   
    public function login() {
        if (is_logged_in()) {
            redirect_by_role();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() === TRUE) {
                $email    = $this->input->post('email', TRUE);
                $password = $this->input->post('password', TRUE);
                $user     = $this->User_model->find_by_email($email);

                if ($user && password_verify($password, $user->password)) {
                    
                    $this->session->set_userdata([
                        'user_id'  => $user->id,
                        'nama'     => $user->nama,
                        'email'    => $user->email,
                        'role'     => $user->role,
                        'login_at' => date('Y-m-d H:i:s'),
                    ]);

                   
                    if ($user->role === 'admin') {
                        $this->session->set_flashdata('success',
                            'Selamat datang Admin ' . $user->nama . '!');
                        redirect('admin');
                    } else {
                        $this->session->set_flashdata('success',
                            'Selamat datang, ' . $user->nama . '!');
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Email atau password salah.');
                    redirect('login');
                }
            }
        }

        $this->load->view('auth/login');
    }

    
    public function register() {
        if (is_logged_in()) redirect_by_role();

        if ($this->input->post()) {
           
            $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');
            $this->form_validation->set_rules('role', 'Role', 'required|in_list[user,admin]');

            
            if ($this->input->post('role') === 'admin') {
                $this->form_validation->set_rules('admin_code', 'Kode Admin', 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $role = $this->input->post('role', TRUE);

                
                if ($role === 'admin') {
                    $kode = $this->input->post('admin_code', TRUE);
                    if ($kode !== self::ADMIN_REGISTER_CODE) {
                        $this->session->set_flashdata('error',
                            'Kode admin salah. Hubungi administrator sistem.');
                        redirect('register');
                    }
                }

                
                $this->User_model->create([
                    'nama'     => $this->input->post('nama', TRUE),
                    'email'    => $this->input->post('email', TRUE),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role'     => $role,
                ]);

                $this->session->set_flashdata('success',
                    'Registrasi berhasil sebagai ' . strtoupper($role) .
                    '! Silakan login.');

                redirect('login');
            }
        }
        
        $this->load->view('auth/register');
    }

    
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}