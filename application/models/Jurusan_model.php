<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Jurusan_model extends CI_Model {

    public function __construct()
 {
        parent::__construct();
    }

    public function get_by_fakultas( $id_fakultas ) {
        return $this->db->get_where( 'tb_jurusan', [ 'id_fakultas' => $id_fakultas ] )->result();
    }

    // Create ( insert data )

    public function create( $data )
 {
        return $this->db->insert( 'tb_jurusan', $data );
    }

    // Read ( get all data )

    public function get_all()
 {
        return $this->db->get( 'tb_jurusan' )->result();
    }

    // Read ( get single data )

    public function get_by_id( $id )
 {
        return $this->db->get_where( 'tb_jurusan', [ 'id_jurusan' => $id ] )->row();
    }

    public function get_by_status()
 {
        return $this->db->get_where( 'tb_jurusan', [ 'status' => 'Aktif' ] )->result();
    }

    // Update ( update data )

    public function update( $id, $data )
 {
        $this->db->where( 'id_jurusan', $id );
        return $this->db->update( 'tb_jurusan', $data );
    }

    // Delete ( delete data )

    public function delete( $id )
 {
        $this->db->where( 'id_jurusan', $id );
        return $this->db->delete( 'tb_jurusan' );
    }
    public function get_by_fakultass($fakultas_id) {
        // Filter data jurusan berdasarkan id_fakultas
        $this->db->where('id_fakultas', $fakultas_id);
        $query = $this->db->get('tb_jurusan'); // Ganti 'jurusan' dengan nama tabel Anda
        return $query->result(); // Mengembalikan hasil sebagai array objek
    }
}


