<?php

if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class Network extends CI_Controller {

 public function __construct() {
  parent::__construct();
  $this->load->model('data_model');
  $this->load->model('network_model');
  $this->load->model('config_model');
  $this->load->model('ewalet_model');
 }

 public function index() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $d['page_title'] = "Direct Sponsor List";

   $d['lst_sponsor'] = $this->db->query("SELECT * FROM member WHERE sponsor='$user_session' ORDER BY username ASC");
   $d['content']     = $this->load->view('network/sponsor', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url() . 'login');
  }
 }

 public function sponsor() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $d['page_title'] = "Direct Sponsor List";

   $d['lst_sponsor'] = $this->db->query("SELECT * FROM member WHERE sponsor='$user_session' ORDER BY username ASC");
   $d['content']     = $this->load->view('network/sponsor', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url() . 'index.php/login');
  }
 }

 public function downline() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $d['page_title'] = "Downline List";



   $d['content'] = $this->load->view('network/downline', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url() . 'index.php/login');
  }
 }

 public function tree() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $d['page_title'] = "Downline List";

   $d['content'] = $this->load->view('network/downline', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url() . 'login');
  }
 }

// TESTING TRIAL START
 public function tree_testing() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $d['page_title'] = "Downline List";
   $d['content']    = $this->load->view('network_testing/downline', $d, true);
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url() . 'login');
  }
 }

// TESTING TRIAL END


 public function member() {


  $text            = "SELECT username, nama, pin FROM member";
  $d['lst_member'] = $this->db->query($text);
  $this->load->view('member-list', $d);
 }

 public function genealogy() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;

  if (!empty($user_session)) {
   $d['page_title'] = "Network Genealogy";
   if ($this->uri->segment(3) == "") {
    $d['awal'] = $user_session;
    $d['mid']  = $user_session;
    $mid       = $user_session;
   } else {
    $d['awal'] = $user_session;
    $d['mid']  = $this->uri->segment(3);
    $mid       = $this->uri->segment(3);
   }

   if (!$this->uri->segment(3)) {
    $mid      = $user_session;
    $d['mid'] = $user_session;
   } else {
    $cari = $this->input->post('cari');
    if ($cari == 1) {
     //---levelku--
     $mid     = $this->input->post('mid');
     $mylev   = $this->data_model->dataupline("level", $user_session);
     $lev_uid = $this->data_model->dataupline("level", $mid);
     for ($i = 0; $i < $lev_uid; $i++) {
      $jd = $this->app_model->count_records("upline", "username='$mid' and upline$i='$user_session'");
      $ad = $ad + $jd;
     }
     if ($lev_uid > $mylev and $ad > 0) {
      $d['mid'] = $mid;
     }
    } else {
     $d['mid'] = $this->uri->segment(3);
     $mid      = $this->uri->segment(3);
    }
   }
   $cek_user = $this->app_model->count_records("member", "WHERE username='$mid'");
   if ($cek_user == 0) {
    $d['content'] = $this->load->view('network/genealogy_not_found', $d, true);
   } else {

    $d['content'] = $this->load->view('network/genealogy', $d, true);
   }
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url() . 'index.php/login');
  }
 }

 public function join() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $d['page_title'] = "Form Pendaftaran";
   //$d['lst_paket'] = $this->db->query("SELECT * FROM paket WHERE status='1' ORDER BY urutan ASC");
   $pkt             = explode("|", $this->config_model->index("paket"));
   $by              = explode("|", $this->config_model->index("biaya"));
   $mybv            = explode("|", $this->config_model->index("bv"));
   $btg             = explode("|", $this->config_model->index("batang"));

   $d['pkt'] = $pkt;
   $d['by']  = $by;
   $d['btg'] = $btg;
   $d['bv']  = $mybv;
   if ($this->input->post('verified')) {
    $error       = 0;
    $serial      = $this->input->post('serial', TRUE);
    $sponsor     = $this->input->post('sponsor', TRUE);
    $jenis_paket = $this->input->post('jenis_paket', TRUE);
    $upline      = $this->input->post('upline', TRUE);
    $posisi      = $this->input->post('posisi', TRUE);
    $username    = $this->data_model->getusername($serial);
    //$pass = $this->data_model->randomPassword(6);
    $pass        = "123456";
    $pin         = $pass;
    //echo "Password $pass"; exit;
    //	$pass2 = $this->input->post('pass2', TRUE);
    $nama        = $this->input->post('nama', TRUE);
    $ktp         = $this->input->post('ktp', TRUE);
    $tglahir     = $this->input->post('tglahir', TRUE);
    $alamat      = $this->input->post('alamat', TRUE);
    $kota        = $this->input->post('kota', TRUE);
    $propinsi    = $this->input->post('propinsi', TRUE);
    $negara      = $this->input->post('propinsi', TRUE);

    $kodepos  = $this->input->post('kodepos', TRUE);
    $hp       = $this->input->post('hp', TRUE);
    $email    = $this->input->post('email', TRUE);
    $acc_type = $this->input->post('acc_type', TRUE);
    $namarek  = $this->input->post('namarek', TRUE);
    $norek    = $this->input->post('norek', TRUE);
    $bank     = $this->input->post('bank', TRUE);

    if ($jenis_paket == 1) {
     $batang = $btg[0];
     $bv     = 0;
     $biaya  = $by[0];
    } else if ($jenis_paket == 2) {
     $batang = $btg[1];
     $bv     = 2;
     $biaya  = $by[1];
    } else if ($jenis_paket == 3) {
     $batang = $btg[2];
     $bv     = 3;
     $biaya  = $by[2];
    } else if ($jenis_paket == 4) {
     $batang = $btg[3];
     $bv     = 4;
     $biaya  = $by[3];
    } else {
     $batang = 0;
     $bv     = 0;
     $biaya  = 0;

     $d['message'] = 'Register failed!. Anda belum memilih paket join.';
     $error        = 1;
    }
    //echo "batang: $batang";
    $d['jenis_paket'] = $jenis_paket;
    $d['sponsor']     = $sponsor;
    $d['upline']      = $upline;
    $d['posisi']      = $posisi;
    $d['username']    = $username;
    $d['serial']      = $serial;
    $d['pass']        = $pass;
    //$d['pass2'] = $pass2;
    $d['nama']        = $nama;
    $d['ktp']         = $ktp;
    $d['tglahir']     = $tglahir;
    $d['alamat']      = $alamat;
    $d['kota']        = $kota;
    $d['propinsi']    = $propinsi;
    $d['negara']      = $negara;
    $d['kodepos']     = $kodepos;
    $d['hp']          = $hp;
    $d['email']       = $email;
    $d['acc_type']    = $acc_type;
    $d['namarek']     = $namarek;
    $d['norek']       = $norek;
    $d['bank']        = $bank;
    //cek username
    $cek_user         = $this->app_model->count_records("member", "WHERE username='$username'");
    if ($cek_user > 0) {
     $d['message'] = 'Username already exist. Please change username';
     $error        = 1;
    }

    //cek serial or pin
    $cek_pin = $this->app_model->count_records("card", "WHERE pin='$serial' AND status=0");
    if ($cek_pin == 0) {
     $d['message'] = 'Pin not valid. Please input the correct pin';
     $error        = 1;
    }

    //cek paket
    $cek_paket = $this->app_model->count_records("card", "WHERE pin='$serial' AND status=0 AND dealer='$jenis_paket'");
    if ($cek_paket == 0) {
     $d['message'] = 'Pin not valid. Please input the correct pin';
     $error        = 1;
    }

    //cek upline
    $cek_upline = $this->app_model->count_records("member", "WHERE username='$upline'");
    if ($cek_upline == 0) {
     $d['message'] = 'Invalid Upline ID. Please change Upline ID';
     $error        = 1;
    }

    //cek posisi
    $q_posisi     = $this->db->query("SELECT $posisi FROM upline WHERE username='$upline'");
    $row_posisi   = $q_posisi->row();
    $result_array = array_values((array) $row_posisi);
    $cek_posisi   = $result_array[0];
    if ($cek_posisi <> "") {
     $d['message'] = 'Invalid Position. Posisi sudah terisi, silakan refresh dan ganti posisi';
     $error        = 1;
    }
    /* cek saldo ewalet
      if($this->ewalet_model->myeregisterdone($user_session,"") < $biaya)
      {
      $d['message'] = 'Saldo E-register does not enough. Please do topup!';
      $error = 1;
      }
     */
    if ($error == 1) {
     $d['content'] = $this->load->view('network/join', $d, true);
    } else {

     ///semua OKE
     $mem['harga']     = $jenis_paket;
     $mem['sponsor']   = $sponsor;
     $mem['upline']    = $upline;
     $mem['username']  = $username;
     $mem['pass']      = md5($pass);
     $mem['pin']       = $pass;
     $mem['nama']      = $nama;
     $mem['ktp']       = $ktp;
     $mem['tglahir']   = $tglahir;
     $mem['alamat']    = $alamat;
     $mem['kota']      = $kota;
     $mem['propinsi']  = $propinsi;
     $mem['negara']    = $negara;
     $mem['kodepos']   = $kodepos;
     $mem['hp']        = $hp;
     $mem['email']     = $email;
     $mem['acc_type']  = $acc_type;
     $mem['namarek']   = $namarek;
     $mem['norek']     = $norek;
     $mem['bank']      = $bank;
     $mem['adminrp']   = $biaya;
     $mem['tgl']       = date('Y-m-d');
     $mem['paket']     = 1;
     $mem['status']    = 0;
     $mem['harga']     = $jenis_paket;
     $mem['batang']    = $batang;
     $mem['rank_code'] = $jenis_paket;
     $mem['bv']        = $bv;

     //cek sponsor monoleg

     $cek_monoleg = $this->app_model->count_records("member", "WHERE sponsor='$sponsor'");
     if ($cek_monoleg > 0) {
      $mem['monoleg']         = 'no';
      $mem['sponsor_monoleg'] = '';
     } else {
      $mem['monoleg'] = 'yes';
      if ($this->data_model->dataku("sponsor_monoleg", $username) == "") {
       $mem['sponsor_monoleg'] = $this->data_model->dataku("sponsor", $sponsor);
      } else {
       $mem['sponsor_monoleg'] = $this->data_model->dataku("sponsor_monoleg", $sponsor);
      }
     }
     //

     $up['username']  = $username;
     $up['sponsor']   = $sponsor;
     $up['upline0']   = $upline;
     $up['posisi']    = $posisi;
     $up['harga']     = $jenis_paket;
     $up['batang']    = $batang;
     $up['rank_code'] = $jenis_paket;
     $up['bv']        = $bv;
     $up['adminrp']   = $biaya;
     $up['upline1']   = $this->data_model->dataupline("upline0", $upline);
     $up['upline2']   = $this->data_model->dataupline("upline1", $upline);
     $up['upline3']   = $this->data_model->dataupline("upline2", $upline);
     $up['upline4']   = $this->data_model->dataupline("upline3", $upline);
     $up['upline5']   = $this->data_model->dataupline("upline4", $upline);
     $up['upline6']   = $this->data_model->dataupline("upline5", $upline);
     $up['upline7']   = $this->data_model->dataupline("upline6", $upline);
     $up['upline8']   = $this->data_model->dataupline("upline7", $upline);
     $up['upline9']   = $this->data_model->dataupline("upline8", $upline);
     $up['upline10']  = $this->data_model->dataupline("upline9", $upline);
     $up['upline11']  = $this->data_model->dataupline("upline10", $upline);
     $up['upline12']  = $this->data_model->dataupline("upline11", $upline);
     $up['upline13']  = $this->data_model->dataupline("upline12", $upline);
     $up['upline14']  = $this->data_model->dataupline("upline13", $upline);
     $up['upline15']  = $this->data_model->dataupline("upline14", $upline);
     $up['upline16']  = $this->data_model->dataupline("upline15", $upline);
     $up['upline17']  = $this->data_model->dataupline("upline16", $upline);
     $up['upline18']  = $this->data_model->dataupline("upline17", $upline);
     $up['upline19']  = $this->data_model->dataupline("upline18", $upline);
     $up['upline20']  = $this->data_model->dataupline("upline19", $upline);
     $upline20        = $this->data_model->dataupline("upline19", $upline);
     $up['upline21']  = $this->data_model->dataupline("upline0", $upline20);
     $up['upline22']  = $this->data_model->dataupline("upline1", $upline20);
     $up['upline23']  = $this->data_model->dataupline("upline2", $upline20);
     $up['upline24']  = $this->data_model->dataupline("upline3", $upline20);
     $up['upline25']  = $this->data_model->dataupline("upline4", $upline20);
     $up['upline26']  = $this->data_model->dataupline("upline5", $upline20);
     $up['upline27']  = $this->data_model->dataupline("upline6", $upline20);
     $up['upline28']  = $this->data_model->dataupline("upline7", $upline20);
     $up['upline29']  = $this->data_model->dataupline("upline8", $upline20);
     $up['upline30']  = $this->data_model->dataupline("upline9", $upline20);
     $up['upline31']  = $this->data_model->dataupline("upline10", $upline20);
     $up['upline32']  = $this->data_model->dataupline("upline11", $upline20);
     $up['upline33']  = $this->data_model->dataupline("upline12", $upline20);
     $up['upline34']  = $this->data_model->dataupline("upline13", $upline20);
     $up['upline35']  = $this->data_model->dataupline("upline14", $upline20);
     $up['upline36']  = $this->data_model->dataupline("upline15", $upline20);
     $up['upline37']  = $this->data_model->dataupline("upline16", $upline20);
     $up['upline38']  = $this->data_model->dataupline("upline17", $upline20);
     $up['upline39']  = $this->data_model->dataupline("upline18", $upline20);
     $up['upline40']  = $this->data_model->dataupline("upline19", $upline20);
     $up['tglaktif']  = date('Y-m-d H:i:s');

     $levele      = $this->data_model->dataupline("level", $upline);
     $up['level'] = $levele + 1;
     $up['paket'] = 1;

     $pos_upline = $this->data_model->dataupline("myposisi", $upline);
     if ($posisi == "KIRI") {
      $pose           = "L";
      $up['myposisi'] = $pos_upline . $pose;
     } else {
      $pose           = "R";
      $up['myposisi'] = $pos_upline . $pose;
     }
     $this->app_model->insertData("member", $mem);
     $this->app_model->insertData("upline", $up);

     if ($posisi == "KIRI") {
      $upd['kiri']    = $username;
      $id['username'] = $upline;
      $this->app_model->updateData("upline", $upd, $id);
     } else {
      $upd['kanan']   = $username;
      $id['username'] = $upline;
      $this->app_model->updateData("upline", $upd, $id);
     }

     $idpin['pin']         = $serial;
     $spin['tgl_aktivasi'] = date('Y-m-d H:i:s');
     $spin['idmlm']        = $username;
     $spin['status']       = 1;
     $this->app_model->updateData("card", $spin, $idpin);

     ///masukka ke daftar ROI
     $droi['username']      = $username;
     $droi['jenis']         = 'paid';
     $droi['tgl_register']  = date('Y-m-d');
     $droi['tgl_start_roi'] = date('Y-m-d', strtotime('+7 day'));
     $droi['code_paket']    = $jenis_paket;
     $droi['bv']            = $bv;
     $droi['cycle']         = 60;
     $droi['bayar']         = $biaya;
     $droi['status']        = 1;
     $droi['created_date']  = date('Y-m-d H:i:s');
     $droi['created_user']  = 'register';
     $result                = $this->db->insert('tb_roi', $droi);

     $this->data_model->aktivasi($username);

     if ($jenis_paket == 4) {
      //tambahkan saldo khusus platinum
      $data_ereg['username'] = $user_session;
      $data_ereg['jumlah']   = 150000;
      $data_ereg['uraian']   = "Autosave member: $username";
      $data_ereg['tgl']      = date('Y-m-d H:i:s');
      $data_ereg['status']   = 1;
      $data_ereg['jenis']    = 'kredit';
      $this->app_model->insertData("dataewalet", $data_ereg);

      //end of
     }


     $datasms['out_starttime'] = date('Y-m-d H:i:s');
     $datasms['out_hpnumber']  = $username;
     $datasms['provider']      = 'XL';
     $datasms['out_message']   = "Hi $nama, Anda telah sukses terdaftar pada sistem kami dengan user id:$username, pass: $pass";
     $datasms['tipe']          = 'SMS';
     $this->app_model->insertData("outbox", $datasms);


     $d['content'] = $this->load->view('network/success-register', $d, true);
    }

    $this->load->view('include/template', $d);
   } else {
    $sponsor          = $this->input->post('sp', TRUE);
    $upline           = $this->input->post('up', TRUE);
    $posisi           = $this->input->post('pos', TRUE);
    $jenis_paket      = '';
    $username         = '';
    $pass             = '';
    $pass2            = '';
    $nama             = '';
    $ktp              = '';
    $tglahir          = '';
    $alamat           = '';
    $kota             = '';
    $propinsi         = '';
    $negara           = 'Indonesia';
    $hp               = '';
    $serial           = "";
    $kodepos          = '';
    $email            = '';
    $acc_type         = '';
    $namarek          = '';
    $norek            = '';
    $bank             = '';
    $d['jenis_paket'] = $jenis_paket;
    $d['sponsor']     = $sponsor;
    $d['upline']      = $upline;
    $d['posisi']      = $posisi;
    $d['username']    = $username;
    $d['pass']        = $pass;
    $d['serial']      = $serial;
    $d['pass2']       = $pass2;
    $d['nama']        = $nama;
    $d['ktp']         = $ktp;
    $d['tglahir']     = $tglahir;
    $d['alamat']      = $alamat;
    $d['kota']        = $kota;
    $d['propinsi']    = $propinsi;
    $d['negara']      = $negara;
    $d['kodepos']     = $kodepos;
    $d['hp']          = $hp;
    $d['email']       = $email;
    $d['acc_type']    = $acc_type;
    $d['namarek']     = $namarek;
    $d['norek']       = $norek;
    $d['bank']        = $bank;

    $d['message'] = '';
    $d['content'] = $this->load->view('network/join', $d, true);
    $this->load->view('include/template', $d);
   }
  } else {
   header('location:' . base_url() . 'index.php/login');
  }
 }

 public function logout() {
  $cek = $this->session->userdata('logged_in');
  if (empty($cek)) {
   header('location:' . base_url() . 'index.php/login');
  } else {
   $this->session->sess_destroy();
   header('location:' . base_url() . 'index.php/login');
  }
 }

 public function genealogy_free() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;

  if (!empty($user_session)) {
   $d['page_title'] = "Network Genealogy Free Signup";
   if ($this->uri->segment(3) == "") {
    $d['awal'] = $user_session;
    $d['mid']  = $user_session;
    $mid       = $user_session;
   } else {
    $d['awal'] = $user_session;
    $d['mid']  = $this->uri->segment(3);
    $mid       = $this->uri->segment(3);
   }

   if (!$this->uri->segment(3)) {
    $mid      = $user_session;
    $d['mid'] = $user_session;
   } else {
    $cari = $this->input->post('cari');
    if ($cari == 1) {
     //---levelku--
     $mid     = $this->input->post('mid');
     $mylev   = $this->data_model->dataupline("level", $user_session);
     $lev_uid = $this->data_model->dataupline("level", $mid);
     for ($i = 0; $i < $lev_uid; $i++) {
      $jd = $this->app_model->count_records("upline", "username='$mid' and upline$i='$user_session'");
      $ad = $ad + $jd;
     }
     if ($lev_uid > $mylev and $ad > 0) {
      $d['mid'] = $mid;
     }
    } else {
     $d['mid'] = $this->uri->segment(3);
     $mid      = $this->uri->segment(3);
    }
   }
   $cek_user = $this->app_model->count_records("member", "WHERE username='$mid'");
   if ($cek_user == 0) {
    $d['content'] = $this->load->view('network/genealogy_not_found', $d, true);
   } else {

    $d['content'] = $this->load->view('network/genealogy_free', $d, true);
   }
   $this->load->view('include/template', $d);
  } else {
   header('location:' . base_url() . 'login');
  }
 }

 public function join_free() {
  $user_session      = $this->session->userdata('username');
  $d['user_session'] = $user_session;
  if (!empty($user_session)) {
   $d['page_title'] = "Form Pendaftaran";
   //$d['lst_paket'] = $this->db->query("SELECT * FROM paket WHERE status='1' ORDER BY urutan ASC");
   $pkt             = explode("|", $this->config_model->index("paket"));
   $by              = explode("|", $this->config_model->index("biaya"));
   $mybv            = explode("|", $this->config_model->index("bv"));
   $btg             = explode("|", $this->config_model->index("batang"));

   $d['pkt'] = $pkt;
   $d['by']  = $by;
   $d['btg'] = $btg;
   $d['bv']  = $mybv;
   if ($this->input->post('verified')) {
    $error       = 0;
    $sponsor     = $this->input->post('sponsor', TRUE);
    $jenis_paket = $this->input->post('jenis_paket', TRUE);
    $upline      = $this->input->post('upline', TRUE);
    $posisi      = $this->input->post('posisi', TRUE);
    $username    = $this->input->post('username', TRUE);
    $pass        = $this->input->post('pass', TRUE);
    $pass2       = $this->input->post('pass2', TRUE);
    $nama        = $this->input->post('nama', TRUE);
    $ktp         = $this->input->post('ktp', TRUE);
    $tglahir     = $this->input->post('tglahir', TRUE);
    $alamat      = $this->input->post('alamat', TRUE);
    $kota        = $this->input->post('kota', TRUE);
    $propinsi    = $this->input->post('propinsi', TRUE);
    $negara      = $this->input->post('propinsi', TRUE);
    $kodepos     = $this->input->post('kodepos', TRUE);
    $hp          = $this->input->post('hp', TRUE);
    $email       = $this->input->post('email', TRUE);
    $acc_type    = $this->input->post('acc_type', TRUE);
    $namarek     = $this->input->post('namarek', TRUE);
    $norek       = $this->input->post('norek', TRUE);
    $bank        = $this->input->post('bank', TRUE);

    if ($jenis_paket == 1) {
     $batang = $btg[0];
     $bv     = $mybv[0];
     $biaya  = $by[0];
    } else if ($jenis_paket == 2) {
     $batang = $btg[1];
     $bv     = $mybv[1];
     $biaya  = $by[1];
    } else if ($jenis_paket == 3) {
     $batang = $btg[2];
     $bv     = $mybv[2];
     $biaya  = $by[2];
    } else if ($jenis_paket == 4) {
     $batang = $btg[3];
     $bv     = $mybv[3];
     $biaya  = $by[3];
    } else if ($jenis_paket == 5) {
     $batang = $btg[4];
     $bv     = $mybv[4];
     $biaya  = $by[4];
    } else if ($jenis_paket == 6) {
     $batang = $btg[5];
     $bv     = $mybv[5];
     $biaya  = $by[5];
    } else {
     $batang = 0;
     $bv     = 0;
     $biaya  = 0;

     $d['message'] = 'Register failed!. Anda belum memilih paket join.';
     $error        = 1;
    }
    //echo "batang: $batang";
    $d['jenis_paket'] = $jenis_paket;
    $d['sponsor']     = $sponsor;
    $d['upline']      = $upline;
    $d['posisi']      = $posisi;
    $d['username']    = $username;
    $d['pass']        = $pass;
    $d['pass2']       = $pass2;
    $d['nama']        = $nama;
    $d['ktp']         = $ktp;
    $d['tglahir']     = $tglahir;
    $d['alamat']      = $alamat;
    $d['kota']        = $kota;
    $d['propinsi']    = $propinsi;
    $d['negara']      = $negara;
    $d['kodepos']     = $kodepos;
    $d['hp']          = $hp;
    $d['email']       = $email;
    $d['acc_type']    = $acc_type;
    $d['namarek']     = $namarek;
    $d['norek']       = $norek;
    $d['bank']        = $bank;
    //cek username
    $cek_user         = $this->app_model->count_records("member", "WHERE username='$username'");
    if ($cek_user > 0) {
     $d['message'] = 'Username already exist. Please change username';
     $error        = 1;
    }
    //cek upline
    $cek_upline = $this->app_model->count_records("member", "WHERE username='$upline'");
    if ($cek_upline == 0) {
     $d['message'] = 'Invalid Upline ID. Please change Upline ID';
     $error        = 1;
    }

    //cek posisi
    $q_posisi     = $this->db->query("SELECT $posisi FROM upline WHERE username='$upline'");
    $row_posisi   = $q_posisi->row();
    $result_array = array_values((array) $row_posisi);
    $cek_posisi   = $result_array[0];
    if ($cek_posisi <> "") {
     $d['message'] = 'Invalid Position. Posisi sudah terisi, silakan refresh dan ganti posisi';
     $error        = 1;
    }

    if ($this->ewalet_model->myeregisterdone($user_session, "") == 55) {
     $d['message'] = 'Saldo E-register does not enough. Please do topup!';
     $error        = 1;
    }

    if ($error == 1) {
     $d['content'] = $this->load->view('network/join_free', $d, true);
    } else {

     ///semua OKE
     $mem['harga']     = $jenis_paket;
     $mem['sponsor']   = $sponsor;
     $mem['upline']    = $upline;
     $mem['username']  = $username;
     $mem['pass']      = md5($pass);
     $mem['pin']       = $pass;
     $mem['nama']      = $nama;
     $mem['ktp']       = $ktp;
     $mem['tglahir']   = $tglahir;
     $mem['alamat']    = $alamat;
     $mem['kota']      = $kota;
     $mem['propinsi']  = $propinsi;
     $mem['negara']    = $negara;
     $mem['kodepos']   = $kodepos;
     $mem['hp']        = $hp;
     $mem['email']     = $email;
     $mem['acc_type']  = $acc_type;
     $mem['namarek']   = $namarek;
     $mem['norek']     = $norek;
     $mem['bank']      = $bank;
     $mem['adminrp']   = $biaya;
     $mem['tgl']       = date('Y-m-d');
     $mem['paket']     = 1;
     $mem['status']    = 1;
     $mem['harga']     = 0;
     $mem['batang']    = 0;
     $mem['rank_code'] = 1;
     $mem['bv']        = 0;

     $up['username']  = $username;
     $up['sponsor']   = $sponsor;
     $up['upline0']   = $upline;
     $up['posisi']    = $posisi;
     $up['harga']     = 0;
     $up['batang']    = 0;
     $up['rank_code'] = 1;
     $up['bv']        = 0;
     $up['adminrp']   = $biaya;
     $up['upline1']   = $this->data_model->dataupline("upline0", $upline);
     $up['upline2']   = $this->data_model->dataupline("upline1", $upline);
     $up['upline3']   = $this->data_model->dataupline("upline2", $upline);
     $up['upline4']   = $this->data_model->dataupline("upline3", $upline);
     $up['upline5']   = $this->data_model->dataupline("upline4", $upline);
     $up['upline6']   = $this->data_model->dataupline("upline5", $upline);
     $up['upline7']   = $this->data_model->dataupline("upline6", $upline);
     $up['upline8']   = $this->data_model->dataupline("upline7", $upline);
     $up['upline9']   = $this->data_model->dataupline("upline8", $upline);
     $up['upline10']  = $this->data_model->dataupline("upline9", $upline);
     $up['upline11']  = $this->data_model->dataupline("upline10", $upline);
     $up['upline12']  = $this->data_model->dataupline("upline11", $upline);
     $up['upline13']  = $this->data_model->dataupline("upline12", $upline);
     $up['upline14']  = $this->data_model->dataupline("upline13", $upline);
     $up['upline15']  = $this->data_model->dataupline("upline14", $upline);
     $up['upline16']  = $this->data_model->dataupline("upline15", $upline);
     $up['upline17']  = $this->data_model->dataupline("upline16", $upline);
     $up['upline18']  = $this->data_model->dataupline("upline17", $upline);
     $up['upline19']  = $this->data_model->dataupline("upline18", $upline);
     $up['upline20']  = $this->data_model->dataupline("upline19", $upline);
     $upline20        = $this->data_model->dataupline("upline19", $upline);
     $up['upline21']  = $this->data_model->dataupline("upline0", $upline20);
     $up['upline22']  = $this->data_model->dataupline("upline1", $upline20);
     $up['upline23']  = $this->data_model->dataupline("upline2", $upline20);
     $up['upline24']  = $this->data_model->dataupline("upline3", $upline20);
     $up['upline25']  = $this->data_model->dataupline("upline4", $upline20);
     $up['upline26']  = $this->data_model->dataupline("upline5", $upline20);
     $up['upline27']  = $this->data_model->dataupline("upline6", $upline20);
     $up['upline28']  = $this->data_model->dataupline("upline7", $upline20);
     $up['upline29']  = $this->data_model->dataupline("upline8", $upline20);
     $up['upline30']  = $this->data_model->dataupline("upline9", $upline20);
     $up['upline31']  = $this->data_model->dataupline("upline10", $upline20);
     $up['upline32']  = $this->data_model->dataupline("upline11", $upline20);
     $up['upline33']  = $this->data_model->dataupline("upline12", $upline20);
     $up['upline34']  = $this->data_model->dataupline("upline13", $upline20);
     $up['upline35']  = $this->data_model->dataupline("upline14", $upline20);
     $up['upline36']  = $this->data_model->dataupline("upline15", $upline20);
     $up['upline37']  = $this->data_model->dataupline("upline16", $upline20);
     $up['upline38']  = $this->data_model->dataupline("upline17", $upline20);
     $up['upline39']  = $this->data_model->dataupline("upline18", $upline20);
     $up['upline40']  = $this->data_model->dataupline("upline19", $upline20);
     $up['tglaktif']  = date('Y-m-d H:i:s');

     $levele      = $this->data_model->dataupline("level", $upline);
     $up['level'] = $levele + 1;
     $up['paket'] = 1;

     $pos_upline = $this->data_model->dataupline("myposisi", $upline);
     if ($posisi == "KIRI") {
      $pose           = "L";
      $up['myposisi'] = $pos_upline . $pose;
     } else {
      $pose           = "R";
      $up['myposisi'] = $pos_upline . $pose;
     }
     $this->app_model->insertData("member", $mem);
     $this->app_model->insertData("upline", $up);

     if ($posisi == "KIRI") {
      $upd['kiri']    = $username;
      $id['username'] = $upline;
      $this->app_model->updateData("upline", $upd, $id);
     } else {
      $upd['kanan']   = $username;
      $id['username'] = $upline;
      $this->app_model->updateData("upline", $upd, $id);
     }


     ///masukka ke daftar ROI
     $droi['username']      = $username;
     $droi['jenis']         = 'paid';
     $droi['tgl_register']  = date('Y-m-d');
     $droi['tgl_start_roi'] = date('Y-m-d', strtotime('+7 day'));
     $droi['code_paket']    = $jenis_paket;
     $droi['bv']            = $bv;
     $droi['cycle']         = 60;
     $droi['bayar']         = $biaya;
     $droi['status']        = 1;
     $droi['created_date']  = date('Y-m-d H:i:s');
     $droi['created_user']  = 'register';
     //	$result = $this->db->insert('tb_roi',$droi);
     //	$this->data_model->aktivasi($username);
     //kurangi saldo e-register
     $data_ereg['username'] = $user_session;
     $data_ereg['jumlah']   = $biaya;
     $data_ereg['uraian']   = "Register new member $username";
     $data_ereg['tgl']      = date('Y-m-d H:i:s');
     $data_ereg['status']   = 1;
     $data_ereg['jenis']    = 'debit';
     //	$this->app_model->insertData("dataeregister",$data_ereg);
     //end of



     $datasms['out_starttime'] = date('Y-m-d H:i:s');
     $datasms['out_hpnumber']  = $username;
     $datasms['provider']      = 'XL';
     $datasms['out_message']   = "Hi $nama, Anda telah sukses terdaftar pada sistem kami dengan user id:$username, pass: $pass";
     $datasms['tipe']          = 'SMS';
     $this->app_model->insertData("outbox", $datasms);

     //execute Json register PPOB Guava
     $deposit = $this->data_model->data_paket('ppob', $jenis_paket);

     $msisdn   = $username;
     $alamat   = $kota;
     $passwd   = $pass;
     $mem_name = $nama;

     //API Url
     $url = 'http://202.158.48.172/reg.jsp';

     //Initiate cURL.
     $ch = curl_init($url);

     //The JSON data.
     $jsonData = array(
         /* 'username' => $msisdn,
           'password' => 'MyPassword' */

         'msisdn'      => $msisdn,
         'alamat'      => $alamat,
         'passwd'      => $passwd,
         'mem_name'    => $mem_name,
         'sign'        => md5($msisdn . $mem_name . $passwd),
         'nominal_dep' => 0
     );

     //Encode the array into JSON.
     $jsonDataEncoded = json_encode($jsonData);

     //Tell cURL that we want to send a POST request.
     curl_setopt($ch, CURLOPT_POST, 1);

     //Attach our encoded JSON string to the POST fields.
     curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

     //Set the content type to application/json
     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
     // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

     curl_setopt($ch, CURLOPT_HEADER, 0);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     //Execute the request
     $d['result'] = curl_exec($ch);

     //end of Json
     //$d['content']= $this->load->view('network/sukses',$d,true);
     $d['content'] = $this->load->view('network/success-register', $d, true);
    }

    $this->load->view('include/template', $d);
   } else {
    $sponsor          = $this->input->post('sp', TRUE);
    $upline           = $this->input->post('up', TRUE);
    $posisi           = $this->input->post('pos', TRUE);
    $jenis_paket      = '';
    $username         = '628';
    $pass             = '';
    $pass2            = '';
    $nama             = '';
    $ktp              = '';
    $tglahir          = '';
    $alamat           = '';
    $kota             = '';
    $propinsi         = '';
    $negara           = 'Indonesia';
    $hp               = '';
    $kodepos          = '';
    $email            = '';
    $acc_type         = '';
    $namarek          = '';
    $norek            = '';
    $bank             = '';
    $d['jenis_paket'] = $jenis_paket;
    $d['sponsor']     = $sponsor;
    $d['upline']      = $upline;
    $d['posisi']      = $posisi;
    $d['username']    = $username;
    $d['pass']        = $pass;
    $d['pass2']       = $pass2;
    $d['nama']        = $nama;
    $d['ktp']         = $ktp;
    $d['tglahir']     = $tglahir;
    $d['alamat']      = $alamat;
    $d['kota']        = $kota;
    $d['propinsi']    = $propinsi;
    $d['negara']      = $negara;
    $d['kodepos']     = $kodepos;
    $d['hp']          = $hp;
    $d['email']       = $email;
    $d['acc_type']    = $acc_type;
    $d['namarek']     = $namarek;
    $d['norek']       = $norek;
    $d['bank']        = $bank;

    $d['message'] = '';
    $d['content'] = $this->load->view('network/join_free', $d, true);
    $this->load->view('include/template', $d);
   }
  } else {
   header('location:' . base_url() . 'login');
  }
 }

}

/* End of file index.php */
/* Location: ./application/controllers/index.php */