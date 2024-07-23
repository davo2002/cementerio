
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Event_model');
        $this->load->model('Vault_model');
        $this->load->model('User_model');
        $this->load->library('session');

        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $this->load->view('admin/templates/header');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/templates/footer');
    }

    public function eventos() {
        $data['events'] = $this->Event_model->get_events();
        $this->load->view('admin/templates/header');
        $this->load->view('admin/eventos', $data);
        $this->load->view('admin/templates/footer');
    }
    public function get_notifications() {
        $this->load->model('Notification_model'); // Asegúrate de que el modelo está cargado
        $notifications = $this->Notification_model->get_notifications(); // Obtén las notificaciones
        echo json_encode($notifications); // Envía las notificaciones como JSON
    }
    
    
    public function bovedas() {
        $data['vaults'] = $this->Vault_model->get_vaults();
        $this->load->view('admin/templates/header');
        $this->load->view('admin/bovedas', $data);
        $this->load->view('admin/templates/footer');
    }

    public function usuarios() {
        $data['usuarios'] = $this->User_model->get_users();
        $this->load->view('admin/templates/header');
        $this->load->view('admin/users', $data);
        $this->load->view('admin/templates/footer');
    }
    public function catastro() {
        $this->load->view('admin/templates/header');
        $this->load->view('admin/catastro');
        $this->load->view('admin/templates/footer');
    }
    public function documentos() {
        $this->load->view('admin/templates/header');
        $this->load->view('admin/documentos');
        $this->load->view('admin/templates/footer');
    }
    public function pagos() {
        $this->load->view('admin/templates/header');
        $this->load->view('admin/pagos');
        $this->load->view('admin/templates/footer');
    }
}
