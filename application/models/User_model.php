<?php
class User_model extends CI_Model {

    public function register(
        $email, $password, $phone,
        $nombre, $snombre, $apellido, $sapellido, $direccion
    ) {
        $data = array(
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'nombre' => $nombre,
            'snombre' => $snombre,
            'apellido' => $apellido,
            'sapellido' => $sapellido,
            'direccion' => $direccion,
            'verificado' => false,
            'verification_token' => uniqid()
        );
        $this->db->insert('Usuarios', $data);
        return $this->db->insert_id(); // Devuelve el ID del usuario insertado
    }
    public function verify_email($verification_token) {
        $this->db->where('verification_token', $verification_token);
        $query = $this->db->get('Usuarios');
    
        echo "Número de filas encontradas: " . $query->num_rows() . "<br>";
    
        if ($query->num_rows() == 1) {
            $user = $query->row();
            $this->db->where('id', $user->id);
            $this->db->update('Usuarios', array('verificado' => true, 'verification_token' => NULL));
            return $user;
        }
        return false;
    }
    
    public function store_verification_token($user_id, $verification_token) {
        $data = array(
            'verification_token' => $verification_token
        );
        $this->db->where('id', $user_id);
        $this->db->update('Usuarios', $data);
    }
    
    public function notify_admin($subject, $message) {
        $this->load->library('email');
        $this->email->from($this->config->item('smtp_user'), 'Sr. Zeus');
        $this->email->to('davidsitho05@gmail.com');
        $this->email->subject($subject);
        $this->email->message($message);

        if (!$this->email->send()) {
            log_message('error', $this->email->print_debugger());
        }
    }
    
    public function get_user_id_by_verification_token($verification_token) {
        $this->db->where('verification_token', $verification_token);
        $query = $this->db->get('Usuarios');
        if ($query->num_rows() == 1) {
            return $query->row_array()['id'];
        }
        return false;
    }

    
    public function login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('Usuarios');
        if ($query->num_rows() == 1) {
            $user = $query->row_array();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    public function get_users(){
        return $this->db->get('usuarios')->result();
    } 
}
