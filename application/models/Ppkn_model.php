<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Ppkn_model extends CI_Model {
    public function get_all_daftar() {
        // Ambil id_user dari sesi login
        $id_user = $this->session->session_login[ 'id' ];

        // Dapatkan fakultas user yang login
        $this->db->select( 'user.fakultas' );
        $this->db->from( 'user' );
        $this->db->where( 'id', $id_user );
        $fakultas = $this->db->get()->row()->fakultas;

        // Memilih kolom secara eksplisit dengan alias untuk menghindari konflik
        $this->db->select( '
            tb_pendaftaran.id_pendaftaran AS pendaftaran_id, 
            tb_pendaftaran.*, 
            user.jurusan, 
            user.fakultas, 
            tb_jurusan.nama_jurusan, 
            tb_pembina.dokumen_proposal_ttd,
            tb_ppkn.id_pendaftaran AS ppkn_pendaftaran_id, 
            tb_ppkn.*,
            tb_lpj.*
        ' );

        // Mengambil data dari tabel tb_pendaftaran
        $this->db->from( 'tb_pendaftaran' );

        // Menghubungkan tabel user dengan left join
        $this->db->join( 'user', 'user.id = tb_pendaftaran.id_user', 'left' );

        // Menghubungkan tabel tb_jurusan dengan left join
        $this->db->join( 'tb_jurusan', 'tb_jurusan.id_jurusan = user.jurusan', 'left' );

        // Menghubungkan tabel tb_pembina dengan left join
        $this->db->join( 'tb_pembina', 'tb_pembina.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left' );

        // Menghubungkan tabel tb_ppkn dengan left join
        $this->db->join( 'tb_ppkn', 'tb_ppkn.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left' );

        // Menghubungkan tabel tb_lpj dengan left join
        $this->db->join( 'tb_lpj', 'tb_lpj.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left' );

        // Tambahkan filter fakultas berdasarkan user yang login
        $this->db->where( 'user.fakultas', $fakultas );
        $this->db->where('tb_pendaftaran.status !=', 7);

        // Menjalankan query dan mengembalikan hasilnya
        return $this->db->get()->result();
    }

    public function riwayat() {
        // Ambil id_user dari sesi login
        $id_user = $this->session->session_login[ 'id' ];

        // Dapatkan fakultas user yang login
        $this->db->select( 'user.fakultas' );
        $this->db->from( 'user' );
        $this->db->where( 'id', $id_user );
        $fakultas = $this->db->get()->row()->fakultas;

        // Memilih kolom secara eksplisit dengan alias untuk menghindari konflik
        $this->db->select( '
            tb_pendaftaran.id_pendaftaran AS pendaftaran_id, 
            tb_pendaftaran.*, 
            user.jurusan, 
            user.fakultas, 
            tb_jurusan.nama_jurusan, 
            tb_pembina.dokumen_proposal_ttd,
            tb_ppkn.id_pendaftaran AS ppkn_pendaftaran_id, 
            tb_ppkn.*,
            tb_lpj.*
        ' );

        // Mengambil data dari tabel tb_pendaftaran
        $this->db->from( 'tb_pendaftaran' );

        // Menghubungkan tabel user dengan left join
        $this->db->join( 'user', 'user.id = tb_pendaftaran.id_user', 'left' );

        // Menghubungkan tabel tb_jurusan dengan left join
        $this->db->join( 'tb_jurusan', 'tb_jurusan.id_jurusan = user.jurusan', 'left' );

        // Menghubungkan tabel tb_pembina dengan left join
        $this->db->join( 'tb_pembina', 'tb_pembina.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left' );

        // Menghubungkan tabel tb_ppkn dengan left join
        $this->db->join( 'tb_ppkn', 'tb_ppkn.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left' );

        // Menghubungkan tabel tb_lpj dengan left join
        $this->db->join( 'tb_lpj', 'tb_lpj.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left' );

        // Tambahkan filter fakultas berdasarkan user yang login
        $this->db->where( 'user.fakultas', $fakultas );
        $this->db->where('tb_pendaftaran.status', 7);

        // Menjalankan query dan mengembalikan hasilnya
        return $this->db->get()->result();
    }

    public function get_all_magang_proses() {
        return $this->db->where( 'status', 'proses' ) // Menambahkan kondisi untuk status 'proses'
        ->get( 'tb_magang' )
        ->result();
    }

    public function insert_ppkn( $data ) {
        return $this->db->insert( 'tb_ppkn', $data );
    }

    public function get_magang_by_id( $id ) {
        return $this->db->get_where( 'tb_magang', [ 'id_pm' => $id ] )->row();
    }

    public function update_magang( $id, $data ) {
        $this->db->where( 'id', $id );
        return $this->db->update( 'tb_magang', $data );
    }

    public function delete_ppkn( $id ) {
        $this->db->where( 'id_pendaftaran', $id );
        return $this->db->delete( 'tb_ppkn' );
    }

    public function get_daftar_by_id_user( $id_user ) {
        // Pastikan parameter id_user adalah angka
        if ( !is_numeric( $id_user ) ) {
            return false;
        }

        // Query untuk mendapatkan data barang berdasarkan id_user
        $this->db->where( 'id_user', $id_user );
        $query = $this->db->get( 'tb_pendaftaran' );

        // Periksa apakah data ditemukan
        if ( $query->num_rows() > 0 ) {
            return $query->result_array();
            // Mengembalikan data sebagai array
        } else {
            return false;
            // Jika tidak ada data
        }
    }

    public function insert_lpj_ppkn( $data ) {
        return $this->db->insert( 'tb_lpj', $data );
    }

    public function get_lpj_by_id( $id_lpj ) {
        return $this->db->get_where( 'tb_lpj', [ 'id_lpj' => $id_lpj ] )->row_array();
    }

    public function update_lpj_ppkn( $id_lpj, $data ) {
        $this->db->where( 'id_lpj', $id_lpj );
        return $this->db->update( 'tb_lpj', $data );
    }

    public function get_all_jurusan() {
        // Mengambil fakultas yang ada di sesi
        $fakultas_user = $this->session->session_login[ 'fakultas' ];
        // Mengambil data jurusan yang id_fakultas-nya sama dengan fakultas_user
        return $this->db->where('id_fakultas', $fakultas_user) // Menambahkan kondisi berdasarkan fakultas_user
                        ->get('tb_jurusan') // Mengambil data dari tb_jurusan
                        ->result();
    }
    
    public function get_all_user() {
        return $this->db->select('user.*, tb_fakultas.nama_fakultas, tb_jurusan.nama_jurusan') // Memilih kolom yang dibutuhkan
            ->from('user') // Mengambil data dari tabel user
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas = user.fakultas', 'left') // Join ke tb_fakultas
            ->join('tb_jurusan', 'tb_jurusan.id_jurusan = user.jurusan', 'left') // Join ke tb_jurusan
            ->where('user.level', 'pembina') // Kondisi level = 'ppkn'
            ->get()
            ->result();
    }


    public function delete_user( $id ) {
        $this->db->where( 'id', $id );
        return $this->db->delete( 'user' );
    }
    

}
