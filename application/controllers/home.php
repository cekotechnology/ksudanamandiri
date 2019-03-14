<?php

if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class Home extends CI_Controller {

 public function __construct() {
  parent::__construct();
  $this->load->model('data_model');
  $this->load->model('ewalet_model');
  $this->load->model('network_model');
  $this->load->model('bonus_model');
 }

 public function index() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $d['page_title']   = "Home";
   $lst_content       = $this->db->query("SELECT id, title, maintext FROM content WHERE title='Home - Member Area'");
   $result            = $lst_content->row();
   $result_array      = array_values((array) $result);
   $d['main_content'] = $result_array[2];

   $d['sal_bayar']    = $this->db->where(array('userid' => $user_session))->get('vkomisi_transfer')->row('bayar');
   $d['sal_komisi']   = $this->db->where(array('username' => $user_session))->get('vkomisi')->row()->jumlah;
   $d['sal_pinjaman'] = $this->db->query("SELECT SUM( jumlah_disetujui ) AS total FROM pinjaman_header WHERE username = '$user_session' AND `status` = 'DITERIMA'")->row()->total;

   $d['lst_profit']     = $this->db->query("SELECT * FROM tb_roi WHERE username='$user_session'");
   $d['tot_byr_profit'] = $this->app_model->count_records("komisi", "WHERE username='$user_session' AND jenis='komroi'");

   $d['saldo_ppob'] = 0;

   $d['content'] = $this->load->view('home', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url() . 'index.php/login');
  }
 }

 public function logout() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   header('location:' . base_url() . 'index.php/login');
  } else {
   $this->session->sess_destroy();
   header('location:' . base_url() . 'index.php/login');
  }
 }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */