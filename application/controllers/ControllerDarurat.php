<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class ControllerDarurat extends CI_Controller
 {

    function __construct()
 {
        parent::__construct();
        $this->load->database();
        $this->load->model( 'Daftar_model' );

        $this->load->model( 'Pembina_model' );
        $this->load->model( 'Bendahara_model' );
        $this->load->model( 'Jurusan_model' );
        $this->load->model( 'LoginModel' );
        // $this->load->model( 'Fakultas_model' );

        $this->load->library( 'form_validation' );
        $this->load->library( 'Datatables' );
        $this->load->helper( array( 'form', 'url', 'download', 'file' ) );

    }

    public function index()
 {
        // Load database library
        $this->load->database();

        // Eksekusi query untuk mengambil seluruh data dari tabel tb_pendaftaran
        $query = $this->db->get( 'tb_lpj' );
        // SELECT * FROM tb_pendaftaran

        // Ambil hasilnya
        $data = $query->result();

        // Tampilkan data menggunakan vardump
        echo '<pre>';
        var_dump( $data );
        echo '</pre>';

        // Pastikan tidak ada output lain
        exit();
    }

}
