<?php

if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class Login extends CI_Controller {

 public function __construct() {
  parent::__construct();
  $this->load->model('login_model');
 }

 public function index() {
  $d['judul'] = "LOGIN MEMBER";

  $cek = $this->session->userdata('logged_in');
  if (empty($cek)) {
   $this->form_validation->set_rules('userloginx', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('passloginx', 'Password', 'trim|required|xss_clean');
    
   if ($this->form_validation->run() == FALSE) {
    //$d['content']= $this->load->view('login',$d,true);
    $this->load->view('login', $d);
   } else {
       
    $u = $this->input->post('userloginx', TRUE);
    $p = $this->input->post('passloginx', TRUE);
    $rest = $this->login_model->getLoginData($u, $p);
    
   }
  } else {
   header('location:' . base_url() . 'home');
  }
 }

 public function admin() {
  $d['judul'] = "LOGIN MEMBER";

  $cek = $this->session->userdata('logged_in');
  if (empty($cek)) {
   $this->form_validation->set_rules('userloginx', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('passloginx', 'Password', 'trim|required|xss_clean');

   if ($this->form_validation->run() == FALSE) {
    //$d['content']= $this->load->view('login',$d,true);
    $this->load->view('login_old', $d);
   } else {
    $u = $this->input->post('userloginx', TRUE);
    $p = $this->input->post('passloginx', TRUE);
    $this->login_model->getLoginData($u, $p);
   }
  } else {
   header('location:' . base_url() . 'home');
  }
 }

 public function logout() {
  $cek = $this->session->userdata('logged_in');
  if (empty($cek)) {
   header('location:' . base_url() . '');
  } else {
   $this->session->sess_destroy();
   header('location:https://ksudanamandiri.com/home/');
  }
 }

}

/* End of file welcome.php */
/* Location: ./application/controllers/koperasi.php */