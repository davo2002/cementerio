<?php
class Vault_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_vaults() {
        $query = $this->db->get('Bovedas');
        return $query->result_array();
    }
}
