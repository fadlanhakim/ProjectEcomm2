<?php

class Data_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('role_id') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Anda Belum Login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('login/auth/login');
        }
    }
    public function index()
    {
        $config['base_url']     = site_url('admin/data_barang/index');
        $config['total_rows']   = $this->db->count_all('tb_barang');
        $config['per_page']     = 10;
        $config['uri_segmen']   = 3;
        $choice                 = $config["total_rows"] / $config['per_page'];
        $config["num_links"]    = floor($choice);

        $config['first_link']       =   'First';
        $config['last_link']        =   'Last';
        $config['next_link']        =   'Next';
        $config['prev_link']        =   'Prev';
        $config['full_tag_open']    =   '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   =   '</ul></nav></div>';
        $config['num_tag_open']     =   '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    =   '</span></li>';
        $config['cur_tag_open']     =   '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']     =   '</span></li>';
        $config['next_tag_open']     =   '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']     =  '<span aria-hidden="true">&raquo</span></span></li>';
        $config['prev_tag_open']     =   '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']     =  '</span>Next</li>';
        $config['first_tag_open']     =   '<li class="page-item"><span class="page-link">';
        $config['first_tag_close']     =  '</span></li>';
        $config['last_tag_open']     =   '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']     =  '</span></li>';

        $this->pagination->initialize($config);
        $data['page']   = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['barang'] = $this->model_barang->tampil_data($config["per_page"], $data['page'])->result();
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/vdata_barang', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_aksi()
    {
        $nama_brg   = $this->input->post('nama_brg');
        $keterangan = $this->input->post('keterangan');
        $kategori   = $this->input->post('kategori');
        $harga      = $this->input->post('harga');
        $stok       = $this->input->post('stok');
        $gambar     = $_FILES['gambar']['name'];
        if ($gambar = '') {
        } else {
            $config['upload_path']   = './uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                echo "Gambar gagal diupload !";
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = array(
            'nama_brg'   => $nama_brg,
            'keterangan' => $keterangan,
            'kategori'   => $kategori,
            'harga'      => $harga,
            'stok'       => $stok,
            'gambar'     => $gambar
        );

        $this->model_barang->tambah_barang($data, 'tb_barang');
        redirect('admin/data_barang/index');
    }

    public function edit($id)
    {
        $where = array('id_brg' => $id);
        $data['barang'] = $this->model_barang->edit_barang(
            $where,
            'tb_barang'
        )->result();
        $this->load->view('templates_admin/header');
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/edit_barang', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update()
    {
        $id                 = $this->input->post('id_brg');
        $nama_brg           = $this->input->post('nama_brg');
        $keterangan         = $this->input->post('keterangan');
        $kategori           = $this->input->post('kategori');
        $harga              = $this->input->post('harga');
        $stok               = $this->input->post('stok');

        $data = array(

            'nama_brg'      => $nama_brg,
            'keterangan'    => $keterangan,
            'kategori'      => $kategori,
            'harga'         => $harga,
            'stok'          => $stok
        );

        $where = array(
            'id_brg'    => $id
        );

        $this->model_barang->update_data($where, $data, 'tb_barang');
        redirect('admin/data_barang/index');
    }

    public function hapus($id)
    {
        $where = array('id_brg' => $id);
        $this->model_barang->hapus_data($where, 'tb_barang');
        redirect('admin/data_barang/index');
    }
}
