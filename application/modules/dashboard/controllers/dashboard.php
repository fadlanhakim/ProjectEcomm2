<?php

class Dashboard extends CI_Controller
{

    public function index()
    {
        $config['base_url']     = site_url('dashboard/index');
        $config['total_rows']   = $this->db->count_all('tb_barang');
        $config['per_page']     = 8;
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
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('vdashboard', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_ke_keranjang($id)
    {
        $barang = $this->model_barang->find($id);

        $data = array(
            'id'      => $barang->id_brg,
            'qty'     => 1,
            'price'   => $barang->harga,
            'name'    => $barang->nama_brg

        );

        $this->cart->insert($data);
        redirect('dashboard');
    }

    public function detail_keranjang()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('keranjang');
        $this->load->view('templates/footer');
    }

    public function hapus_keranjang()
    {
        $this->cart->destroy();
        redirect('dashboard/index');
    }

    public function pembayaran()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembayaran');
        $this->load->view('templates/footer');
    }

    public function proses_pesanan()
    {
        $is_processed = $this->model_invoice->index();
        if ($is_processed) {
            $this->cart->destroy();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('proses_pesanan');
            $this->load->view('templates/footer');
        } else {
            echo "Maaf, Pesanan Anda Gagal diroses!";
        }
    }

    public function detail($id_brg)
    {
        $data['barang'] = $this->model_barang->detail_brg($id_brg);
        $this->cart->destroy();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('detail_barang', $data);
        $this->load->view('templates/footer');
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['barang'] = $this->model_barang->get_keyword($keyword);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('vdashboard', $data);
        $this->load->view('templates/footer');
    }
}
