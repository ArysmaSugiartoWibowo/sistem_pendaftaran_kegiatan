<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Daftar_model extends CI_Model {

    public function get_all_daftar() {
        return $this->db->get( 'tb_pendaftaran' )->result();
    }

    public function insert_daftar( $data ) {
        return $this->db->insert( 'tb_pendaftaran', $data );
    }

    public function insert_lpj_hmps( $data ) {
        return $this->db->insert( 'tb_lpj', $data );
    }

    public function delete_daftar( $id ) {
        $this->db->where( 'id_pendaftaran', $id );
        return $this->db->delete( 'tb_pendaftaran' );
    }

    public function delete_lpj( $id ) {
        $this->db->where( 'id_pendaftaran', $id );
        return $this->db->delete( 'tb_lpj' );
    }
    public function get_riwayat_by_id_user($id_user) {
        // Pastikan parameter id_user adalah angka
        if (!is_numeric($id_user)) {
            return false; // Jika bukan angka, langsung return false
        }
    
        // Query untuk mendapatkan data berdasarkan id_user, dengan join ke tb_ppkn, tb_pembina, dan tb_lpj
        $this->db->select('
            tb_pendaftaran.id_pendaftaran AS pendaftaran_id, 
            tb_pendaftaran.*, 
            tb_ppkn.*,  
            tb_pembina.*,  
            tb_lpj.*' 
        ); // Kolom yang ingin diambil
        $this->db->from('tb_pendaftaran'); // Tabel utama
        $this->db->join('tb_ppkn', 'tb_ppkn.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left'); // Join dengan tb_ppkn
        $this->db->join('tb_pembina', 'tb_pembina.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left'); // Join dengan tb_pembina
        $this->db->join('tb_lpj', 'tb_lpj.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left'); // Join dengan tb_lpj
        $this->db->where('tb_pendaftaran.id_user', $id_user); // Kondisi berdasarkan id_user
        $this->db->where('tb_pendaftaran.status', 7); // Tambahkan kondisi untuk status selain 7
    
        $query = $this->db->get(); // Jalankan query
    
        // Debug query (jika ingin melihat query yang dihasilkan, hapus komentar di bawah ini)
        // echo $this->db->last_query(); exit;
    
        // Periksa apakah data ditemukan
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Mengembalikan data sebagai array
        } else {
            return false; // Jika tidak ada data
        }
    }
    

    public function get_daftar_by_id_user($id_user) {
        // Pastikan parameter id_user adalah angka
        if (!is_numeric($id_user)) {
            return false; // Jika bukan angka, langsung return false
        }
    
        // Query untuk mendapatkan data berdasarkan id_user, dengan join ke tb_ppkn, tb_pembina, dan tb_lpj
        $this->db->select('
            tb_pendaftaran.id_pendaftaran AS pendaftaran_id, 
            tb_pendaftaran.*, 
            tb_ppkn.*,  
            tb_pembina.*,  
            tb_lpj.*' 
        ); // Kolom yang ingin diambil
        $this->db->from('tb_pendaftaran'); // Tabel utama
        $this->db->join('tb_ppkn', 'tb_ppkn.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left'); // Join dengan tb_ppkn
        $this->db->join('tb_pembina', 'tb_pembina.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left'); // Join dengan tb_pembina
        $this->db->join('tb_lpj', 'tb_lpj.id_pendaftaran = tb_pendaftaran.id_pendaftaran', 'left'); // Join dengan tb_lpj
        $this->db->where('tb_pendaftaran.id_user', $id_user); // Kondisi berdasarkan id_user
        $this->db->where('tb_pendaftaran.status !=', 7); // Tambahkan kondisi untuk status selain 7
    
        $query = $this->db->get(); // Jalankan query
    
        // Debug query (jika ingin melihat query yang dihasilkan, hapus komentar di bawah ini)
        // echo $this->db->last_query(); exit;
    
        // Periksa apakah data ditemukan
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Mengembalikan data sebagai array
        } else {
            return false; // Jika tidak ada data
        }
    }
    
    
    

}
