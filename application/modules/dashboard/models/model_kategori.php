<?php

class Model_Kategori extends CI_Model
{
    public function data_mouse_gaming()
    {
        return $this->db->get_where("tb_barang", array('kategori' =>
        'mouse_gaming'));
    }
}
