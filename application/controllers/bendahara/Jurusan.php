<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Jurusan extends CI_Controller {

    public function __construct()
 {
        parent::__construct();
        $this->load->model( 'Fakultas_model' );
        $this->load->model( 'Jurusan_model' );
        $this->load->model( 'Bendahara_model' );
        $this->load->helper( 'url' );
        if (empty($this->session->session_login['username'])) {
            $this->session->set_flashdata("pesan", "Anda harus login terlebih dahulu.");
            redirect(site_url("controllerLogin"));
        }
        if ($this->session->session_login['level']!= 'bp') {
           
            redirect(site_url("controllerLogin"));
        }
    }

    // Menampilkan semua data

    public function index($fakultas_id = null) {
        // Ambil data fakultas berdasarkan id_fakultas
        $fakultas = $this->db->get_where('tb_fakultas', ['id_fakultas' => $fakultas_id])->row();
    
        // Periksa apakah data fakultas ditemukan
        if ($fakultas) {
            $data['nama_fakultas'] = $fakultas->nama_fakultas;
            // Ambil data jurusan berdasarkan fakultas
            $data['jurusan'] = $this->Jurusan_model->get_by_fakultass($fakultas_id);
        } else {
            $data['nama_fakultas'] = 'Semua Fakultas';
            // Jika fakultas_id tidak valid, tampilkan semua data jurusan
            $data['jurusan'] = $this->Jurusan_model->get_all();
        }
    
        // Load views dengan data
        $this->load->view('header');
        $this->load->view('bendahara/jurusan/list_jurusan', $data);
        $this->load->view('footer');
    }
    

    // Menampilkan form tambah data

    public function create()
 {
    $data[ 'fakultas' ] = $this->Bendahara_model->get_all_fakultas();
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/jurusan/form_jurusan',$data );
        $this->load->view( 'footer' );
    }

    // Menyimpan data baru

    public function store()
 {
        $data = [
            'nama_jurusan' => $this->input->post( 'nama_jurusan' ),
            'id_fakultas' => $this->input->post( 'id_fakultas' ),
            'status' => $this->input->post( 'status' )
        ];
        $this->Jurusan_model->create( $data );
        redirect( 'bendahara/fakultas' );
    }

    // Menampilkan form edit data

    public function edit( $id )
 {
    $data[ 'fakultas' ] = $this->Fakultas_model->get_all();
        $data[ 'jurusan' ] = $this->Jurusan_model->get_by_id( $id );
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/jurusan/edit', $data );
        $this->load->view( 'footer' );
    }

    // Menyimpan perubahan data

    public function update( $id )
 {
        $data = [
            'nama_jurusan' => $this->input->post( 'nama_jurusan' ),
            'id_fakultas' => $this->input->post( 'id_fakultas' ),
            'status' => $this->input->post( 'status' )
        ];
        $this->Jurusan_model->update( $id, $data );
        redirect( 'bendahara/fakultas' );
    }

    // Menghapus data

    public function delete( $id )
 {
        $this->Jurusan_model->delete( $id );
        redirect( 'bendahara/fakultas' );
    }
}
