<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class ControllerPembina extends CI_Controller
 {

    function __construct()
 {
        parent::__construct();
        $this->load->database();
        $this->load->model( 'Daftar_model' );
        $this->load->model( 'Pembina_model' );
        $this->load->model( 'Jurusan_model' );
        $this->load->model( 'LoginModel' );
  
        $this->load->library( 'form_validation' );
        $this->load->library( 'Datatables' );
        $this->load->helper( array( 'form', 'url', 'download', 'file' ) );
        if ( empty( $this->session->session_login[ 'username' ] ) ) {
            $this->session->set_flashdata( 'pesan', 'Anda harus login terlebih dahulu.' );
            redirect( site_url( 'controllerLogin' ) );
        }
        if ( $this->session->session_login[ 'level' ] != 'pembina' ) {
            redirect( site_url( 'controllerLogin' ) );
        }
    }

    public function index() {
        $data[ 'daftar' ] = $this->Pembina_model->get_all_daftar();
        $this->load->view( 'header' );
        $this->load->view( 'pembina/list_pembina', $data );
        $this->load->view( 'footer' );
    }

    public function riwayat() {

        $data[ 'daftar' ] = $this->Pembina_model->riwayat();
        $this->load->view( 'header' );
        $this->load->view( 'pembina/list_riwayat', $data );
        $this->load->view( 'footer' );
    }

    public function tambah() {
        $id_user = $this->session->session_login[ 'id' ];

        $this->load->view( 'header' );
        $this->load->view( 'pembina/form_pembina' );
        $this->load->view( 'footer' );
    }

    public function simpan() {
        $id_pendaftaran = $this->input->post( 'id_pendaftaran' );
        $this->load->library( 'upload' );

        // Konfigurasi dasar untuk file upload
        $config[ 'upload_path' ] = './uploads/';
        $config[ 'allowed_types' ] = 'pdf|doc|docx|jpg|jpeg|png';
        $config[ 'max_size' ] = 2048;

        // Validasi file dokumen_proposal_ttd
        if ( empty( $_FILES[ 'dokumen_proposal_ttd' ][ 'name' ] ) ) {
            $this->session->set_flashdata( 'error', 'File dokumen tidak ditemukan.' );
            redirect( 'pembina/ControllerPembina' );
            return;
        }

        // Buat nama file unik
        $cv_name = $this->generate_file_name( $_FILES[ 'dokumen_proposal_ttd' ][ 'name' ] );
        $config[ 'file_name' ] = $cv_name;

        $this->upload->initialize( $config );

        // Upload file
        if ( !$this->upload->do_upload( 'dokumen_proposal_ttd' ) ) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata( 'error', 'Gagal mengupload Dokumen: ' . $error );
            redirect( 'pembina/ControllerPembina' );
            return;
        }

        // Menyiapkan data untuk disimpan ke database
        $data = [
            'id_pendaftaran' => $this->input->post( 'id_pendaftaran' ),
            'dokumen_proposal_ttd' => $cv_name,
        ];

        // Simpan data ke database
        $this->Pembina_model->insert_pembina( $data );
        $this->ubah_status_dan_upload( $id_pendaftaran );
        $this->session->set_flashdata( 'success', 'Data magang berhasil disimpan' );
        redirect( 'pembina/ControllerPembina' );
    }

    private function generate_file_name( $original_name ) {
        $timestamp = time();
        $extension = pathinfo( $original_name, PATHINFO_EXTENSION );
        return $timestamp . '.' . $extension;
    }

    public function ubah_status_dan_upload( $id_pendaftaran ) {
        $data = [ 'status' => '2' ];
        $this->db->where( 'id_pendaftaran', $id_pendaftaran );
        $this->db->update( 'tb_pendaftaran', $data );

        $this->session->set_flashdata( 'message', 'Peserta berhasil diaktifkan dan file diunggah.' );
    }

    public function tolak() {
        $id_pendaftaran = $this->input->post( 'id_pendaftaran' );
        $data = [ 'status' => '0'
        , 'keterangan' => $this->input->post( 'keterangan' )
     ];
        $this->db->where( 'id_pendaftaran', $id_pendaftaran );
        $this->db->update( 'tb_pendaftaran', $data );

        $this->session->set_flashdata( 'message', 'Peserta berhasil diaktifkan dan file diunggah.' );
        redirect( 'pembina/ControllerPembina' );
    }

   


       // lpj

           public function simpan_lpj() {
               $id_pendaftaran = $this->input->post('id_pendaftaran');
               $id_lpj = $this->input->post('id_lpj');
               $this->load->library('upload');
       
               // Konfigurasi dasar untuk file upload
               $config['upload_path'] = './uploads/';
               $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
               $config['max_size'] = 2048;
       
               // Validasi file dokumen LPJ
               if (empty($_FILES['lpj_pembina']['name'])) {
                   $this->session->set_flashdata('error', 'File dokumen tidak ditemukan.');
                   redirect('pembina/ControllerPembina');
                   return;
               }
       
               // Buat nama file unik
               $cv_name = $this->generate_file_names($_FILES['lpj_pembina']['name']);
               $config['file_name'] = $cv_name;
       
               $this->upload->initialize($config);
       
               // Upload file
               if (!$this->upload->do_upload('lpj_pembina')) {
                   $error = $this->upload->display_errors();
                   $this->session->set_flashdata('error', 'Gagal mengupload dokumen: ' . $error);
                   redirect('pembina/ControllerPembina');
                   return;
               }
       
               // Cek apakah id_lpj sudah ada di database
               $existing_lpj = $this->Pembina_model->get_lpj_by_id($id_lpj);
       
               if ($existing_lpj) {
                   // Jika data ada, hapus file lama dari server
                   $old_file_path = './uploads/' . $existing_lpj['lpj_pembina'];
                   if (file_exists($old_file_path)) {
                       unlink($old_file_path);
                   }
       
                   // Update data dengan file baru
                   $data = [
                       'id_lpj' => $id_lpj,
                       'lpj_pembina' => $cv_name,
                   ];
                   $this->Pembina_model->update_lpj_pembina($id_lpj, $data);
               } else {
                   // Jika data tidak ada, insert data baru
                   $data = [
                       'id_lpj' => $id_lpj,
                       'lpj_pembina' => $cv_name,
                   ];
                   $this->Pembina_model->insert_lpj_pembina($data);
               }
       
               // Ubah status pendaftaran dan tambahkan upload baru
               $this->ubah_status_dan_uploads($id_pendaftaran);
       
               $this->session->set_flashdata('success', 'Data berhasil disimpan atau diperbarui.');
               redirect('pembina/ControllerPembina');
           }
       
           private function generate_file_names($original_name) {
               $timestamp = time();
               $extension = pathinfo($original_name, PATHINFO_EXTENSION);
               return $timestamp . '.' . $extension;
           }
       
           public function ubah_status_dan_uploads($id_pendaftaran) {
               $data = ['status' => '5'];
               $this->db->where('id_pendaftaran', $id_pendaftaran);
               $this->db->update('tb_pendaftaran', $data);
       
               $this->session->set_flashdata('message', 'Peserta berhasil diaktifkan dan file diunggah.');
           }


           public function tolak_lpj() {
            $id_pendaftaran = $this->input->post( 'id_pendaftaran' );
            $data = [ 'status' => '-2'
            , 'keterangan' => $this->input->post( 'keterangan' )
         ];
            $this->db->where( 'id_pendaftaran', $id_pendaftaran );
            $this->db->update( 'tb_pendaftaran', $data );
    
            $this->session->set_flashdata( 'message', 'Peserta berhasil diaktifkan dan file diunggah.' );
            redirect( 'pembina/ControllerPembina' );
        }




                  // regis
    public function register()
    {
 
           $this->load->view( 'header' );
           $this->load->view( 'pembina/register_hmps');
           $this->load->view( 'footer' );
       }
   
       public function register_action() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_message('required', '* {field} Harus diisi');
        $this->form_validation->set_message('is_unique', '* {field} sudah ada');
    
        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            // Mendapatkan fakultas dari sesi user yang sedang login
            $fakultas_user = $this->session->session_login[ 'fakultas' ];
    
            $jurusan_user = $this->session->session_login[ 'jurusan' ];
    
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level'    => $this->input->post('level'),
                'jurusan'  => $jurusan_user,
                'fakultas' => $fakultas_user, // Mengisi fakultas dengan fakultas user yang login
            ];
    
            $this->LoginModel->registerUser($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil');
            redirect('pembina/ControllerPembina/user');
        }
    }

    public function user() {
        $data[ 'user' ] = $this->Pembina_model->get_all_user_by_jurusan();
        $this->load->view( 'header' );
        $this->load->view( 'pembina/list_user_hmps', $data );
        $this->load->view( 'footer' );
    }
    

    public function hapus_user( $id ) {
        $this->Pembina_model->delete_user( $id );
        redirect( 'pembina/ControllerPembina/user' );
    }

       


}
