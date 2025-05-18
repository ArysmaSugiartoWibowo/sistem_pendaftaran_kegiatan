<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class ControllerBendahara extends CI_Controller
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
        if ( empty( $this->session->session_login[ 'username' ] ) ) {
            $this->session->set_flashdata( 'pesan', 'Anda harus login terlebih dahulu.' );
            redirect( site_url( 'controllerLogin' ) );
        }
        if ( $this->session->session_login[ 'level' ] != 'bp' ) {
            redirect( site_url( 'controllerLogin' ) );
        }
    }

    public function index() {
        $data[ 'daftar' ] = $this->Bendahara_model->get_all_daftar();
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/list_bendahara', $data );
        $this->load->view( 'footer' );
    }

    public function riwayat() {
        $data[ 'daftar' ] = $this->Bendahara_model->riwayat();
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/list_bendahara', $data );
        $this->load->view( 'footer' );
    }
    public function user() {
        $data[ 'user' ] = $this->Bendahara_model->get_all_user();
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/list_user_komitmen', $data );
        $this->load->view( 'footer' );
    }

    public function hapus_user( $id ) {
        $this->Bendahara_model->delete_user( $id );
        redirect( 'bendahara/ControllerBendahara/user' );
    }


    // regis
    public function register()
 {
    $data[ 'fakultas' ] = $this->Bendahara_model->get_all_fakultas();
        $this->load->view( 'header' );
        $this->load->view( 'bendahara/register_komitmen',$data );
        $this->load->view( 'footer' );
    }

    public function register_action()
 {
        $this->form_validation->set_rules( 'username', 'Username', 'required|is_unique[user.username]' );
        $this->form_validation->set_rules( 'password', 'Password', 'required' );
        $this->form_validation->set_rules( 'fakultas', 'fakultas', 'required' );
        $this->form_validation->set_rules( 'level', 'Level', 'required' );
        $this->form_validation->set_message( 'required', '* {field} Harus diisi' );
        $this->form_validation->set_message( 'is_unique', '* {field} sudah ada' );

        if ( $this->form_validation->run() == FALSE ) {
            $this->register();
        } else {
            $data = [
                'username' => $this->input->post( 'username' ),
                'password' => password_hash( $this->input->post( 'password' ), PASSWORD_DEFAULT ),
                'level'    => $this->input->post( 'level' ),
                'fakultas'    => $this->input->post( 'fakultas' ),
            ];

            $this->LoginModel->registerUser( $data );
            $this->session->set_flashdata( 'success', 'Registrasi berhasil' );
            redirect( 'bendahara/ControllerBendahara/user' );
        }
    }





    public function simpan() {
        $id_pendaftaran = $this->input->post( 'id_pendaftaran' );
        $this->load->library( 'upload' );

        // Konfigurasi dasar untuk file upload
        $config[ 'upload_path' ] = './uploads/';
        $config[ 'allowed_types' ] = 'pdf|doc|docx|jpg|jpeg|png';
        $config[ 'max_size' ] = 2048;

        // Validasi file desposisi
        if ( empty( $_FILES[ 'desposisi' ][ 'name' ] ) ) {
            $this->session->set_flashdata( 'error', 'File dokumen tidak ditemukan.' );
            redirect( 'bendahara/ControllerBendahara' );
            return;
        }

        // Buat nama file unik
        $cv_name = $this->generate_file_name( $_FILES[ 'desposisi' ][ 'name' ] );
        $config[ 'file_name' ] = $cv_name;

        $this->upload->initialize( $config );

        // Upload file
        if ( !$this->upload->do_upload( 'desposisi' ) ) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata( 'error', 'Gagal mengupload Dokumen: ' . $error );
            redirect( 'bendahara/ControllerBendahara' );
            return;
        }

        // Menyiapkan data untuk disimpan ke database
        $data = [
            'id_pendaftaran' => $this->input->post( 'id_pendaftaran' ),
            'desposisi' => $cv_name,
        ];

        // Simpan data ke database
        $this->Bendahara_model->insert_ppkn( $data );
        $this->ubah_status_dan_upload( $id_pendaftaran );
        $this->session->set_flashdata( 'success', 'Data magang berhasil disimpan' );
        redirect( 'bendahara/ControllerBendahara' );
    }

    private function generate_file_name( $original_name ) {
        $timestamp = time();
        $extension = pathinfo( $original_name, PATHINFO_EXTENSION );
        return $timestamp . '.' . $extension;
    }

    public function ubah_status_dan_upload( $id_pendaftaran ) {
        $data = [ 'status' => '3' ];
        $this->db->where( 'id_pendaftaran', $id_pendaftaran );
        $this->db->update( 'tb_pendaftaran', $data );

        $this->session->set_flashdata( 'message', 'Peserta berhasil diaktifkan dan file diunggah.' );
    }

    public function tolak() {
        $id_pendaftaran = $this->input->post( 'id_pendaftaran' );
        $data = [ 'status' => '-1'
        , 'keterangan' => $this->input->post( 'keterangan' )
     ];
        $this->db->where( 'id_pendaftaran', $id_pendaftaran );
        $this->db->update( 'tb_pendaftaran', $data );

        $this->session->set_flashdata( 'message', 'Peserta berhasil diaktifkan dan file diunggah.' );
        redirect( 'bendahara/ControllerBendahara' );
    }

 

           // lpj

           public function respon_lpj() {
            $id_pendaftaran = $this->input->post('id_pendaftaran');
            $id_lpj = $this->input->post('id_lpj');
            $this->load->library('upload');
    
            // Konfigurasi dasar untuk file upload
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
            $config['max_size'] = 2048;
    
            // Validasi file dokumen LPJ
            if (empty($_FILES['kwitansi_bendahara']['name'])) {
                $this->session->set_flashdata('error', 'File dokumen tidak ditemukan.');
                redirect('bendahara/ControllerBendahara');
                return;
            }
    
            // Buat nama file unik
            $cv_name = $this->generate_file_names($_FILES['kwitansi_bendahara']['name']);
            $config['file_name'] = $cv_name;
    
            $this->upload->initialize($config);
    
            // Upload file
            if (!$this->upload->do_upload('kwitansi_bendahara')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', 'Gagal mengupload dokumen: ' . $error);
                redirect('bendahara/ControllerBendahara');
                return;
            }
    
            // Cek apakah id_lpj sudah ada di database
            $existing_lpj = $this->Bendahara_model->get_lpj_by_id($id_lpj);
    
            if ($existing_lpj) {
                // Jika data ada, hapus file lama dari server
                $old_file_path = './uploads/' . $existing_lpj['kwitansi_bendahara'];
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
    
                // Update data dengan file baru
                $data = [
                    'id_lpj' => $id_lpj,
                    'kwitansi_bendahara' => $cv_name,
                ];
                $this->Bendahara_model->update_lpj_ppkn($id_lpj, $data);
            } else {
                // Jika data tidak ada, insert data baru
                $data = [
                    'id_lpj' => $id_lpj,
                    'kwitansi_bendahara' => $cv_name,
                ];
                $this->Bendahara_model->insert_lpj_ppkn($data);
            }
    
            // Ubah status pendaftaran dan tambahkan upload baru
            $this->ubah_status_dan_uploads($id_pendaftaran);
    
            $this->session->set_flashdata('success', 'Data berhasil disimpan atau diperbarui.');
            redirect('bendahara/ControllerBendahara');
        }
    
        private function generate_file_names($original_name) {
            $timestamp = time();
            $extension = pathinfo($original_name, PATHINFO_EXTENSION);
            return $timestamp . '.' . $extension;
        }
    
        public function ubah_status_dan_uploads($id_pendaftaran) {
            $data = ['status' => '7'];
            $this->db->where('id_pendaftaran', $id_pendaftaran);
            $this->db->update('tb_pendaftaran', $data);
    
            $this->session->set_flashdata('message', 'Peserta berhasil diaktifkan dan file diunggah.');
        }

        public function tolak_lpj() {
            $id_pendaftaran = $this->input->post( 'id_pendaftaran' );
            $data = [ 'status' => '-4'
            , 'keterangan' => $this->input->post( 'keterangan' )
         ];
            $this->db->where( 'id_pendaftaran', $id_pendaftaran );
            $this->db->update( 'tb_pendaftaran', $data );
    
            $this->session->set_flashdata( 'message', 'Peserta berhasil diaktifkan dan file diunggah.' );
            redirect( 'bendahara/ControllerBendahara' );
        }
    

}
