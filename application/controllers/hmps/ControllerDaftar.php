<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class ControllerDaftar extends CI_Controller
 {

    function __construct()
 {
        parent::__construct();
        $this->load->database();
        $this->load->model( 'Daftar_model' );
        $this->load->model( 'Pembina_model' );
        $this->load->model( 'Ppkn_model' );

        $this->load->library( 'form_validation' );
        $this->load->library( 'Datatables' );
        $this->load->helper( array( 'form', 'url', 'download', 'file' ) );
        if ( empty( $this->session->session_login[ 'username' ] ) ) {
            $this->session->set_flashdata( 'pesan', 'Anda harus login terlebih dahulu.' );
            redirect( site_url( 'controllerLogin' ) );
        }
        if ( $this->session->session_login[ 'level' ] != 'hmps' ) {
            redirect( site_url( 'controllerLogin' ) );
        }
    }

    public function index() {
        $id_user = $this->session->session_login[ 'id' ];
        $data[ 'daftar' ] = $this->Daftar_model->get_daftar_by_id_user( $id_user );
        $this->load->view( 'header' );
        $this->load->view( 'daftar/list_daftar', $data );
        $this->load->view( 'footer' );
    }

    public function riwayat() {
        $id_user = $this->session->session_login[ 'id' ];
        $data[ 'daftar' ] = $this->Daftar_model->get_riwayat_by_id_user( $id_user );
        $this->load->view( 'header' );
        $this->load->view( 'daftar/list_daftar', $data );
        $this->load->view( 'footer' );
    }

    public function tambah() {

        $id_user = $this->session->session_login[ 'id' ];
        $this->load->view( 'header' );
        $this->load->view( 'daftar/form_daftar' );
        $this->load->view( 'footer' );
    }

    public function simpan() {
        // Load library upload
        $this->load->library( 'upload' );

        // Konfigurasi dasar untuk file upload
        $config[ 'upload_path' ] = './uploads/';
        // Pastikan folder ini ada
        $config[ 'allowed_types' ] = 'pdf|doc|docx|jpg|jpeg|png';
        // Jenis file
        $config[ 'max_size' ] = 2048;
        // Maksimum ukuran file ( KB )

        // Fungsi untuk membuat nama file unik

        function generate_file_name( $original_name ) {
            $timestamp = time();
            // Timestamp sebagai nama unik
            $extension = pathinfo( $original_name, PATHINFO_EXTENSION );
            return $timestamp . '.' . $extension;
        }

        // Buat nama file unik dan tetapkan ke konfigurasi
        $cv_name = generate_file_name( $_FILES[ 'dokumen' ][ 'name' ] );
        $config[ 'file_name' ] = $cv_name;

        // Initialize konfigurasi upload
        $this->upload->initialize( $config );

        // Proses upload
        if ( !$this->upload->do_upload( 'dokumen' ) ) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata( 'error', 'Gagal mengupload Dokumen: ' . $error );
            redirect( 'hmps/ControllerDaftar/tambah' );
            return;
        }

        // Ambil nama file yang berhasil diupload
        $uploaded_data = $this->upload->data();
        $file_name = $uploaded_data[ 'file_name' ];
        // Nama file yang diunggah

        // Data untuk disimpan ke database
        $data = [
            'nama_kegiatan' => $this->input->post( 'nama_kegiatan' ),
            'tanggal_mulai' => $this->input->post( 'tanggal_mulai' ),
            'tanggal_berakhir' => $this->input->post( 'tanggal_berakhir' ),
            'dokumen' => $file_name, // Simpan nama file
            'id_user' => $this->session->session_login[ 'id' ],
            'status' => '1',
        ];

        // Simpan data ke database
        $this->Daftar_model->insert_daftar( $data );
        $this->session->set_flashdata( 'success', 'Data magang berhasil disimpan' );
        redirect( 'hmps/ControllerDaftar' );
    }

    public function hapus( $id ) {
        $this->Daftar_model->delete_daftar( $id );
        $this->Pembina_model->delete_pembina( $id );
        $this->Ppkn_model->delete_ppkn( $id );
        redirect( 'hmps/ControllerDaftar' );
    }

    public function hapus_lpj($id) {
        // Menghapus LPJ berdasarkan ID
        $this->Daftar_model->delete_lpj($id);
    
        // Menghapus keterangan di field tb_pendaftaran berdasarkan id_pendaftaran
        $this->db->where('id_pendaftaran', $id);
        $this->db->update('tb_pendaftaran', ['keterangan' => null]);
    
        // Pastikan fungsi `ubah_status` dipanggil dengan `this->` untuk akses metode di dalam class
        $this->ubah_status($id);
    
        // Redirect setelah proses selesai
        redirect('hmps/ControllerDaftar');
    }
    

    public function ubah_status( $id_pendaftaran ) {
        // Data yang ingin diubah
        $data = [ 'status' => '3' ];

        // Lakukan update pada database dengan kondisi `id_pendaftaran`
        $this->db->where( 'id_pendaftaran', $id_pendaftaran );
        $this->db->update( 'tb_pendaftaran', $data );

        // Set pesan flashdata untuk memberi feedback ke user
        $this->session->set_flashdata( 'message', 'Status berhasil diubah ke status 3.' );
    }

    // lpj

    public function upload_lpj() {
        $id_pendaftaran = $this->input->post( 'id_pendaftaran' );
        $this->load->library( 'upload' );

        // Konfigurasi dasar untuk file upload
        $config[ 'upload_path' ] = './uploads/';
        $config[ 'allowed_types' ] = 'pdf|doc|docx|jpg|jpeg|png';
        $config[ 'max_size' ] = 2048;

        // Validasi file dokumen_lpj
        if ( empty( $_FILES[ 'dokumen_lpj' ][ 'name' ] ) ) {
            $this->session->set_flashdata( 'error', 'File dokumen tidak ditemukan.' );
            redirect( 'hmps/ControllerDaftar' );
            return;
        }

        // Buat nama file unik
        $cv_name = $this->generate_file_name( $_FILES[ 'dokumen_lpj' ][ 'name' ] );
        $config[ 'file_name' ] = $cv_name;

        $this->upload->initialize( $config );

        // Upload file
        if ( !$this->upload->do_upload( 'dokumen_lpj' ) ) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata( 'error', 'Gagal mengupload Dokumen: ' . $error );
            redirect( 'hmps/ControllerDaftar' );
            return;
        }

        // Menyiapkan data untuk disimpan ke database
        $data = [
            'id_pendaftaran' => $this->input->post( 'id_pendaftaran' ),
            'dokumen_lpj' => $cv_name,
        ];

        // Simpan data ke database
        $this->Daftar_model->insert_lpj_hmps( $data );
        $this->ubah_status_dan_upload( $id_pendaftaran );
        $this->session->set_flashdata( 'success', 'Data berhasil disimpan' );
        redirect( 'hmps/ControllerDaftar' );
    }

    private function generate_file_name( $original_name ) {
        $timestamp = time();
        $extension = pathinfo( $original_name, PATHINFO_EXTENSION );
        return $timestamp . '.' . $extension;
    }

    public function ubah_status_dan_upload( $id_pendaftaran ) {
        $data = [ 'status' => '4' ];
        $this->db->where( 'id_pendaftaran', $id_pendaftaran );
        $this->db->update( 'tb_pendaftaran', $data );

        $this->session->set_flashdata( 'message', 'Peserta berhasil diaktifkan dan file diunggah.' );
    }
}
