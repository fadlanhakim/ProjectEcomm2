<?php

class Users extends CI_Controller
{
    public function index()
    {
        $data['users']  = $this->model_user->tampil_data()->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/vuser', $data);
        $this->load->view('templates_admin/footer');
    }
    public function tambah_aksi()
    {
        $nama       = $this->input->post('nama');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $role_id    = $this->input->post('role_id');

        $data = array(
            'nama'      => $nama,
            'username'  => $username,
            'password'  => $password,
            'role_id'   => $role_id,
        );

        $this->model_user->tambah_user($data, 'tb_user');
        redirect('admin/users/index');
    }
    public function edit($id)
    {
        $where = array('id' => $id);
        $data['users'] = $this->model_user->edit_user(
            $where,
            'tb_user'
        )->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/edit_user', $data);
        $this->load->view('templates_admin/footer');
    }
    public function update()
    {
        $id                 = $this->input->post('id');
        $nama               = $this->input->post('nama');
        $username           = $this->input->post('username');
        $password           = $this->input->post('password');
        $role_id            = $this->input->post('role_id');

        $data = array(

            'nama'           => $nama,
            'username'       => $username,
            'password'       => $password,
            'role_id'        => $role_id,
        );

        $where = array(
            'id'    => $id
        );

        $this->model_user->update_data($where, $data, 'tb_user');
        redirect('admin/users/index');
    }

    public function hapus($id)
    {
        $where = array('id' => $id);
        $this->model_user->hapus_data($where, 'tb_user');
        redirect('admin/users/index');
    }
}
