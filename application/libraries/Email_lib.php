<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_lib {

    protected $CI;

    public function __construct() {
        // Obtener la instancia de CodeIgniter
        $this->CI =& get_instance();
        // Cargar la librería de email y la configuración
        $this->CI->load->library('email'); // Cargar la librería de email de CodeIgniter
        $this->CI->config->load('email'); // Cargar la configuración del email
    }

    public function send_verification_email($email, $verification_token) {
        // Configurar el correo electrónico
        $this->email->from($this->config->item('smtp_user'), 'CemMaster');
        $this->email->to($email);
        $this->email->subject('Verificación de Correo Electrónico');
        
        // Asegurar que el correo se envíe como texto plano
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
    
        // Configurar el cuerpo del mensaje
        $this->email->message($message);
    
        // Enviar el correo
        if (!$this->email->send()) {
            log_message('error', 'Error al enviar el email de verificación: ' . $this->email->print_debugger());
            return $this->email->print_debugger();
        }
        log_message('debug', 'Correo de verificación enviado a: ' . $email);
        return true;
    }
    
    

    public function send_verification_code_email($email, $verification_code) {
        $this->CI->email->from($this->CI->config->item('smtp_user'), 'CemMaster'); // Nombre del remitente
        $this->CI->email->to($email);
        $this->CI->email->subject('Código de Verificación de Dos Factores');
        $message =  "Estimado/a ,\n\n" .
                    "Estamos verificando tu identidad para el acceso a tu cuenta en CementeryMaster.\n\n" .
                    "Tu código de verificación de dos factores es el siguiente:\n\n" .
                    "$verification_code\n\n" .
                    "Introduce este código en el campo correspondiente para completar el proceso de verificación.\n\n" .
                    "Si no solicitaste este código, por favor, ignora este mensaje. Si tienes alguna pregunta o necesitas asistencia adicional, contacta a nuestro equipo de soporte en davidsitho05@gmail.com o al +57 (317) 483 2248.\n\n" .
                    "Gracias por tu atención.\n\n" .
                    "Atentamente,\n\n" .
                    "El equipo de CemMaster\n" .
                    "davidsitho05@gmail.com\n" .
                    "https://ddcc-152-201-63-25.ngrok-free.app/cementerio/";
        $this->CI->email->set_mailtype("text");
        $this->CI->email->message($message);
                
        if (!$this->CI->email->send()) {
            log_message('error', 'Error al enviar el código de verificación: ' . $this->CI->email->print_debugger());
            return $this->CI->email->print_debugger();
        }
        log_message('debug', 'Código de verificación enviado a: ' . $email);
            return true;
        }
    
}
