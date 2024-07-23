<?php
class Notification_model extends CI_Model {
    public function get_notifications() {
        // Consulta para obtener las notificaciones
        $query = $this->db->get('notifications'); // Asegúrate de que la tabla 'notifications' existe
        return $query->result();
    }
}

