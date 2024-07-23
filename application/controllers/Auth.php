<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php'; // Asegúrate de haber instalado Twilio SDK con Composer

use Twilio\Rest\Client;
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('email_lib'); // Cargar la librería personalizada 'email_lib'
    }

    public function login() {
        $this->load->view('templates/header');
        $this->load->view('auth/login');
        $this->load->view('templates/footer');
    }public function register() {
        $this->load->view('templates/header');
        $this->load->view('auth/register');
        $this->load->view('templates/footer');
    }
    public function register_process() {
        // Configurar las reglas de validación
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[Usuarios.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('phone', 'Teléfono', 'trim|numeric');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('snombre', 'Segundo Nombre', 'trim');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('sapellido', 'Segundo Apellido', 'trim');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirmar Contraseña', 'required|matches[password]');
    
        if ($this->form_validation->run() == FALSE) {
            // Mostrar errores de validación
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/register');
        } else {
            // Obtener los datos del formulario
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $phone = $this->input->post('phone');
            $nombre = $this->input->post('nombre');
            $snombre = $this->input->post('snombre');
            $apellido = $this->input->post('apellido');
            $sapellido = $this->input->post('sapellido');
            $direccion = $this->input->post('direccion');
    
            // Registrar el usuario
            $user_id = $this->User_model->register($email, $password, $phone, $nombre, $snombre, $apellido, $sapellido, $direccion);
    
            if ($user_id) {
                $verification_token = uniqid();
                $this->User_model->store_verification_token($user_id, $verification_token);
    
                // Enviar correo de verificación al usuario
                $this->email->from($this->config->item('smtp_user'), 'CemMaster');
                $this->email->to($email);
                $this->email->subject('Verificación de Correo Electrónico');
                $this->email->set_mailtype('text');
    
                // Cuerpo del mensaje
                $message = "Estimado/a $nombre $apellido,\n\n" .
                           "Gracias por registrarte en CemeteryMaster. Para completar el proceso de registro, necesitamos verificar tu dirección de correo electrónico.\n\n" .
                           "Por favor, haz clic en el siguiente enlace para verificar tu correo electrónico y activar tu cuenta:\n\n" .
                           site_url('auth/verify_email/' . $verification_token) . "\n\n" .
                           "Si no has creado una cuenta en CemeteryMaster o crees que este correo electrónico ha sido enviado por error, puedes ignorar este mensaje.\n\n" .
                           "Si tienes alguna pregunta o necesitas asistencia adicional, no dudes en ponerte en contacto con nuestro equipo de soporte en davidsitho05@gmail.com o al +57 (317) 483 2248.\n\n" .
                           "Gracias por elegir SGC. Estamos emocionados de tenerte a bordo.\n\n" .
                           "Atentamente,\n\n" .
                           "El equipo de CemMaster\n" .
                           "davidsitho05@gmail.com\n" .
                           "https://ddcc-152-201-63-25.ngrok-free.app/cementerio/";
    
                $this->email->message($message);
    
                if (!$this->email->send()) {
                    log_message('error', 'Error al enviar el email de verificación: ' . $this->email->print_debugger());
                    $this->session->set_flashdata('error', 'Hubo un problema al enviar el correo de verificación.');
                } else {
                    log_message('debug', 'Correo de verificación enviado a: ' . $email);
                    $this->session->set_flashdata('success', 'Registro exitoso. Por favor verifica tu correo electrónico.');
                }
    
                // Notificar al administrador sobre el registro del nuevo usuario
                $this->User_model->notify_admin('Nuevo registro de usuario', 'El usuario con email ' . $email . ' se ha registrado en el sistema.');
    
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Hubo un problema al registrar el usuario.');
                redirect('auth/register');
            }
        }
    }
    
    
    public function show_verification_result() {
        $this->load->view('auth/verification_result');
    }
    

    public function verify_email($verification_token) {
        $this->load->model('User_model');
    
        // Verificar el token
        $user = $this->User_model->verify_email($verification_token);
    
        if ($user) {
            $message = 'Correo electrónico verificado con éxito para el usuario ID: ' . $user->id;
            $this->send_notification_email($message);
            $this->session->set_flashdata('message', $message);
        } else {
            $message = 'Token de verificación inválido o expirado: ' . $verification_token;
            $this->send_notification_email($message);
            $this->session->set_flashdata('message', $message);
        }
    
        // Redirige a una página que mostrará el mensaje
        redirect('auth/login');
    }
    
    
    private function send_notification_email($message) {
        $this->load->library('email');
    
        $this->email->from('tu_correo@dominio.com', 'Administrador');
        $this->email->to('davidsitho05@gmail.com');
        $this->email->subject('Notificación de Registro');
        $this->email->message($message);
    
        if ($this->email->send()) {
            log_message('info', 'Correo de notificación enviado con éxito.');
        } else {
            log_message('error', 'Error al enviar el correo de notificación: ' . $this->email->print_debugger());
        }
    }
    
    
    
    

    public function login_process() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('verification_method', 'Método de Verificación', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $verification_method = $this->input->post('verification_method');
            $user = $this->User_model->login($email, $password);
    
            if ($user) {
                if ($user['verificado']) {
                    $verification_code = rand(100000, 999999);
                    $this->session->set_userdata('verification_code', $verification_code);
                    $this->session->set_userdata('temp_user_id', $user['id']); // Almacenar temporalmente el user_id
    
                    if ($verification_method == 'email') {
                        $this->email_lib->send_verification_code_email($email, $verification_code);
                    } elseif ($verification_method == 'phone') {
                        $this->send_verification_code_sms($user['telefono'], $verification_code);
                    }
    
                    $this->session->set_flashdata('success', 'Código de verificación enviado. Por favor, revisa tu ' . ($verification_method == 'email' ? 'correo electrónico' : 'mensaje de texto') . '.');
                    redirect('auth/verify_two_factor');
                } else {
                    $this->session->set_flashdata('error', 'Tu correo electrónico aún no ha sido verificado.');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Correo o contraseña incorrectos.');
                redirect('auth/login');
            }
        }
    }
    
    public function verify_two_factor() {
        $this->load->view('templates/header');
        $this->load->view('auth/verify_two_factor');
        $this->load->view('templates/footer');
    }
    
    public function verify_two_factor_process() {
        $verification_code = $this->input->post('verification_code');
        $saved_verification_code = $this->session->userdata('verification_code');
    
        if ($verification_code == $saved_verification_code) {
            $this->session->unset_userdata('verification_code');
            $user_id = $this->session->userdata('temp_user_id');
            $this->session->unset_userdata('temp_user_id');
            $this->session->set_userdata('user_id', $user_id); // Establecer user_id para indicar que el usuario está autenticado
            $this->session->set_flashdata('success', 'Iniciando sesión.');
            redirect('admin');
        } else {
            $this->session->set_flashdata('error', 'Código de verificación incorrecto.');
            redirect('auth/verify_two_factor');
        }
    }
    
    public function send_verification_code_sms() {
        $this->session->set_flashdata('error', 'Lo sentimos, este metodo de verificacion no se encuentra disponible por el momento, intenta mas tarde');
        
        redirect('auth/login');
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}
