<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['auth/login'] = 'auth/login';
$route['auth/login_process'] = 'auth/login_process';
$route['auth/logout'] = 'auth/logout';
$route['auth/register'] = 'auth/register';
$route['auth/register_process'] = 'auth/register_process';
$route['auth/verify_email/(:any)'] = 'auth/verify_email/$1';
$route['admin/get_notifications'] = 'admin/get_notifications';


$route['auth/verify_two_factor'] = 'auth/verify_two_factor';
$route['auth/show_verification_result'] = 'auth/show_verification_result';

$route['auth/verify_two_factor_process'] = 'auth/verify_two_factor_process';
$route['admin'] = 'Admin/index';
$route['bovedas'] = 'Admin/bovedas';
$route['catastro'] = 'Admin/catastro';
$route['documentos'] = 'Admin/documentos';
$route['eventos'] = 'Admin/eventos';
$route['pagos'] = 'Admin/pagos';
$route['usuarios'] = 'Admin/usuarios';
