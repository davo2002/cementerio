<?php
class Event_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_events() {
        $query = $this->db->get('Eventos');
        return $query->result_array();
    }
}
