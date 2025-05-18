<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Fakultas extends CI_Controller {

    public function __construct()
 {
        parent::__construct();
        $this->load->model( 'Fakultas_model' );
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

    public function index()
 {
        $data[ 'fakultas' ] = $this->Fakultas_model->get_all();
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/fakultas/list_fakultas', $data );
        $this->load->view( 'footer' );

    }

    // Menampilkan form tambah data

    public function create()
 {
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/fakultas/form_fakultas' );
        $this->load->view( 'footer' );
    }

    // Menyimpan data baru

    public function store()
 {
        $data = [
            'nama_fakultas' => $this->input->post( 'nama_fakultas' ),
            'status' => $this->input->post( 'status' )
        ];
        $this->Fakultas_model->create( $data );
        redirect( 'bendahara/fakultas' );
    }

    // Menampilkan form edit data

    public function edit( $id )
 {
        $data[ 'fakultas' ] = $this->Fakultas_model->get_by_id( $id );
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/fakultas/edit', $data );
        $this->load->view( 'footer' );
    }

    // Menyimpan perubahan data

    public function update( $id )
 {
        $data = [
            'nama_fakultas' => $this->input->post( 'nama_fakultas' ),
            'status' => $this->input->post( 'status' )
        ];
        $this->Fakultas_model->update( $id, $data );
        redirect( 'bendahara/fakultas' );
    }

    // Menghapus data

    public function delete( $id )
 {
        $this->Fakultas_model->delete( $id );
        redirect( 'bendahara/fakultas' );
    }
}
