<?php

class Kategori extends CI_Controller
{
    public function mouse_gaming()
    {
        $data['mouse_gaming'] = $this->model_kategori->data_mouse_gaming()->result;
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('mouse_gaming', $data);
        $this->load->view('templates/footer');
    }
}
