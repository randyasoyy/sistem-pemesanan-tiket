<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $CI = &get_instance();
        return (bool) $CI->session->userdata('user_id');
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        $CI = &get_instance();
        return $CI->session->userdata('role') === 'admin';
    }
}

if (!function_exists('is_user')) {
    function is_user()
    {
        $CI = &get_instance();
        return $CI->session->userdata('role') === 'user';
    }
}

if (!function_exists('require_admin')) {
    function require_admin()
    {
        $CI = &get_instance();
        if (!is_logged_in()) {
            $CI->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('login');
        }
        if (!is_admin()) {
            $CI->session->set_flashdata('error', 'Akses ditolak. Halaman khusus admin.');
            redirect('home');
        }
    }
}

if (!function_exists('require_user')) {
    function require_user()
    {
        $CI = &get_instance();
        if (!is_logged_in()) {
            $CI->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('login');
        }
        if (is_admin()) {
            $CI->session->set_flashdata('info', 'Anda login sebagai admin.');
            redirect('admin');
        }
    }
}

if (!function_exists('redirect_by_role')) {
    function redirect_by_role()
    {
        $CI = &get_instance();
        if (is_admin()) {
            redirect('admin');
        } else {
            redirect('home');
        }
    }
}
