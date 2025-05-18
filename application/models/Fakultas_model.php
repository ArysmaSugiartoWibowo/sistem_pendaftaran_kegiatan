<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Fakultas_model extends CI_Model {

    public function __construct()
 {
        parent::__construct();
    }

    // Create ( insert data )

    public function create( $data )
 {
        return $this->db->insert( 'tb_fakultas', $data );
    }

    // Read ( get all data )

    public function get_all()
 {
        return $this->db->get( 'tb_fakultas' )->result();
    }

    // Read ( get single data )

    public function get_by_id( $id )
 {
        return $this->db->get_where( 'tb_fakultas', [ 'id_fakultas' => $id ] )->row();
    }

    public function get_by_status()
 {
        return $this->db->get_where( 'tb_fakultas', [ 'status' => 'Aktif' ] )->result();
    }

    // Update ( update data )

    public function update( $id, $data )
 {
        $this->db->where( 'id_fakultas', $id );
        return $this->db->update( 'tb_fakultas', $data );
    }

    // Delete ( delete data )

    public function delete( $id )
 {
        $this->db->where( 'id_fakultas', $id );
        return $this->db->delete( 'tb_fakultas' );
    }
}
