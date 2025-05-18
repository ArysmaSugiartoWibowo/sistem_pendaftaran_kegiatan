<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Pembina_model extends CI_Model {


        // Fungsi untuk mendapatkan jurusan user berdasarkan id_user
        private function get_jurusan_user($id_user) {
            $this->db->select('jurusan');
            $this->db->from('user');
            $this->db->where('id', $id_user);
            $user = $this->db->get()->row();
    
            // Jika user tidak ditemukan, kembalikan null
            return $user ? $user->jurusan : null;
        }
    
        // Fungsi untuk mendapatkan daftar pendaftaran
        public function get_all_daftar() {
            // Ambil id_user dari session
            $id_user = $this->session->session_login['id'];
        
            // Pastikan id_user valid
            if (!$id_user) {
                return []; // Jika id_user tidak valid, kembalikan array kosong
            }
        
            // Cari jurusan user berdasarkan id_user
            $jurusan_user = $this->get_jurusan_user($id_user);
        
            // Pastikan jurusan ditemukan
            if (!$jurusan_user) {
                return []; // Jika tidak ditemukan, kembalikan array kosong
            }
        
            // Ambil data dari tb_pendaftaran
            $this->db->select('
                tb_pendaftaran.id_pendaftaran AS id_pendaftaran_alias, 
                tb_pendaftaran.*, 
                tb_ppkn.desposisi, 
                tb_pembina.dokumen_proposal_ttd, 
                tb_lpj.*
            ');
            $this->db->from('tb_pendaftaran');
            $this->db->join('tb_ppkn', 'tb_ppkn.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left');
            $this->db->join('tb_pembina', 'tb_pembina.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left');
            $this->db->join('tb_lpj', 'tb_lpj.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left');
            $this->db->join('user', 'user.id = tb_pendaftaran.id_user', 'left');
            $this->db->where('user.jurusan', $jurusan_user);
            $this->db->where('tb_pendaftaran.status !=', 7);
        
            return $this->db->get()->result();
        }
    
        // Fungsi untuk mendapatkan riwayat pendaftaran
        public function riwayat() {
            // Ambil id_user dari session
            $id_user = $this->session->session_login['id'];
        
            // Pastikan id_user valid
            if (!$id_user) {
                return []; // Jika id_user tidak valid, kembalikan array kosong
            }
        
            // Cari jurusan user berdasarkan id_user
            $jurusan_user = $this->get_jurusan_user($id_user);
        
            // Pastikan jurusan ditemukan
            if (!$jurusan_user) {
                return []; // Jika tidak ditemukan, kembalikan array kosong
            }
        
            // Ambil data dari tb_pendaftaran
            $this->db->select('
                tb_pendaftaran.id_pendaftaran AS id_pendaftaran_alias, 
                tb_pendaftaran.*, 
                tb_ppkn.desposisi, 
                tb_pembina.dokumen_proposal_ttd, 
                tb_lpj.*
            ');
            $this->db->from('tb_pendaftaran');
            $this->db->join('tb_ppkn', 'tb_ppkn.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left');
            $this->db->join('tb_pembina', 'tb_pembina.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left');
            $this->db->join('tb_lpj', 'tb_lpj.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left');
            $this->db->join('user', 'user.id = tb_pendaftaran.id_user', 'left');
            $this->db->where('user.jurusan', $jurusan_user);
            $this->db->where('tb_pendaftaran.status',7);
            
        
            return $this->db->get()->result();
        }
    public function insert_pembina( $data ) {
        return $this->db->insert( 'tb_pembina', $data );
    }

    public function delete_pembina( $id ) {
        $this->db->where( 'id_pendaftaran', $id );
        return $this->db->delete( 'tb_pembina' );
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

    public function insert_lpj_pembina( $data ) {
        return $this->db->insert( 'tb_lpj', $data );
    }

    public function get_lpj_by_id( $id_lpj ) {
        return $this->db->get_where( 'tb_lpj', [ 'id_lpj' => $id_lpj ] )->row_array();
    }

    public function update_lpj_pembina( $id_lpj, $data ) {
        $this->db->where( 'id_lpj', $id_lpj );
        return $this->db->update( 'tb_lpj', $data );
    }


    // 

    public function get_all_user() {
        return $this->db->select('user.*, tb_fakultas.nama_fakultas, tb_jurusan.nama_jurusan') // Memilih kolom yang dibutuhkan
            ->from('user') // Mengambil data dari tabel user
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas = user.fakultas', 'left') // Join ke tb_fakultas
            ->join('tb_jurusan', 'tb_jurusan.id_jurusan = user.jurusan', 'left') // Join ke tb_jurusan
            ->where('user.level', 'hmps') // Kondisi level = 'ppkn'
            ->get()
            ->result();
    }


    public function delete_user( $id ) {
        $this->db->where( 'id', $id );
        return $this->db->delete( 'user' );
    }

    public function get_all_user_by_jurusan() {
        $id_jurusan = $this->session->session_login['jurusan'];
        // Pastikan parameter id_jurusan adalah angka
        if (!is_numeric($id_jurusan)) {
            return false; // Jika bukan angka, langsung return false
        }
    
        return $this->db->select('user.*, tb_fakultas.nama_fakultas, tb_jurusan.nama_jurusan') // Memilih kolom yang dibutuhkan
            ->from('user') // Mengambil data dari tabel user
            ->join('tb_fakultas', 'tb_fakultas.id_fakultas = user.fakultas', 'left') // Join ke tb_fakultas
            ->join('tb_jurusan', 'tb_jurusan.id_jurusan = user.jurusan', 'left') // Join ke tb_jurusan
            ->where('user.level', 'hmps') // Kondisi level = 'hmps'
            ->where('tb_jurusan.id_jurusan', $id_jurusan) // Filter jurusan berdasarkan id_jurusan
            ->get()
            ->result();
    }
    
}
