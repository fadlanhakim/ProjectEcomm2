<?php

class model_kategori extends CI_Model
{
    public function data_mouse_gaming()
    {
        $this->db->get_where("tb_barang", array('kategori' =>
        'mouse_gaming'));
    }
}
