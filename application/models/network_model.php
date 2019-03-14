<?php

if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class Network_model extends CI_Model {

 public function memberkiri($username, $dtgl) {
  $total_pv = 0;

  if ($username == "") {
   $total_pv = 0;
  } else {
   $q_s = $this->db->query("SELECT myposisi FROM upline WHERE username='$username'");

   $result   = $q_s->row();
   $r_s      = array_values((array) $result);
   $myposisi = $r_s[0];

   $myposisiL = $myposisi . "L";

   $q_upv = $this->db->query("SELECT paket FROM upline WHERE myposisi LIKE '$myposisiL%' $dtgl");
   if ($q_upv->num_rows() > 0) {
    $total = 0;
    foreach ($q_upv->result_array() as $r_upv) {
     $total = $total + $r_upv["paket"];
    }
    $total_pv = $total_pv + $total;
   } else {
    $total_pv = 0;
   }
  }
  return $total_pv;
 }

 public function memberkanan($username, $dtgl) {
  $total_pv = 0;
  if ($username == "") {
   $total_pv = 0;
  } else {
   $q_s       = $this->db->query("SELECT myposisi FROM upline WHERE username='$username'");
   $result    = $q_s->row();
   $r_s       = array_values((array) $result);
   $myposisi  = $r_s[0];
   $myposisiR = $myposisi . "R";


   $q_upv = $this->db->query("SELECT paket FROM upline WHERE myposisi LIKE '$myposisiR%' $dtgl");
   if ($q_upv->num_rows() > 0) {
    $total = 0;
    foreach ($q_upv->result_array() as $r_upv) {
     $total = $total + $r_upv["paket"];
    }
    $total_pv = $total_pv + $total;
   } else {
    $total_pv = 0;
   }
  }
  return $total_pv;
 }

 function mybv($username) {
  $mybv = 0;
  $sql  = $this->db->query("SELECT * FROM member WHERE sponsor='$username'");
  if ($sql->num_rows > 0) {
   foreach ($sql->result_array() as $db) {
    $mybv = $mybv + 1;
   }
  } else {
   $mybv = 0;
  }

  return $mybv;
 }

 function hitung_omzet($user, $posisi, $dtgl) {
  $total_pv = 0;

  $q_s = mysql_query("SELECT myposisi FROM upline WHERE username='$user'");

  $r_s      = mysql_fetch_row($q_s);
  $myposisi = $r_s[0];
  if ($posisi == "KIRI") {
   $myposisiL = $myposisi . "L";
  } else {
   $myposisiL = $myposisi . "R";
  }
  $q_upv = mysql_query("SELECT bv, username FROM upline WHERE myposisi LIKE '$myposisiL%' $dtgl");

  if (mysql_num_rows($q_upv) > 0) {
   $total = 0;
   while ($r_upv = mysql_fetch_array($q_upv)) {
    $total = $total + $this->network_model->mybv($r_upv['username']);
   }
   $total_pv = $total_pv + $total;
  } else {
   $total_pv = 0;
  }

  return $total_pv;
 }

 function my_autosave($username) {
  $mybv = 0;
  $sql  = $this->db->query("SELECT SUM(jumlah) AS bv FROM dataewalet WHERE username='$username' AND jenis='kredit' GROUP BY username");
  if ($sql->num_rows > 0) {
   foreach ($sql->result_array() as $db) {
    $mybve = $db['bv'];
   }
   if ($mybve >= 150000) {
    $mybv = 1;
   } else {
    $mybv = 0;
   }
  } else {
   $mybv = 0;
  }

  return $mybv;
 }

 function hitung_omzet_reward($user, $posisi, $dtgl) {
  $total_pv = 0;

  $q_s = mysql_query("SELECT myposisi FROM upline WHERE username='$user'");

  $r_s      = mysql_fetch_row($q_s);
  $myposisi = $r_s[0];
  if ($posisi == "KIRI") {
   $myposisiL = $myposisi . "L";
  } else {
   $myposisiL = $myposisi . "R";
  }
  $q_upv = mysql_query("SELECT bv, username FROM upline WHERE myposisi LIKE '$myposisiL%' $dtgl");

  if (mysql_num_rows($q_upv) > 0) {
   $total = 0;
   while ($r_upv = mysql_fetch_array($q_upv)) {
    $total = $total + $this->network_model->my_autosave($r_upv['username']);
   }
   $total_pv = $total_pv + $total;
  } else {
   $total_pv = 0;
  }

  return $total_pv;
 }

 public function dwn_cal($username, $total_downline = 0) {
  global $total_downline;

  $query = mysql_query("SELECT username FROM member WHERE sponsor='" . $username . "'");

  while ($row = mysql_fetch_assoc($query)) {

   ++$total_downline;

   $this->network_model->dwn_cal($row["username"], $total_downline);
  }
 }

 public function hitung_downline($upline) {
  global $total_downline;

  $total_downline = 0;

  $q_posisi = mysql_query("SELECT username FROM member WHERE sponsor='" . $upline . "'");


  if (mysql_num_rows($q_posisi) > 0) {
   while ($r_posisi = mysql_fetch_assoc($q_posisi)) {
    $total_downline = $total_downline + 1;
    $this->network_model->dwn_cal($r_posisi['username']);
   }
  }

  return $total_downline;
 }

 public function jmlmember($username, $dtgl) {
  $jm       = 0;
  $total_pv = 0;
  $q_s      = $this->db->query("SELECT b.myposisi
   FROM upline b, member a
   WHERE a.username=b.username
   AND a.username='$username'");
  $result   = $q_s->row();
  $r_s      = array_values((array) $result);
  $myposisi = isset($r_s[0]) ? $r_s[0] : "";

  $q_upv = $this->db->query("SELECT b.paket
   FROM upline b, member a
   WHERE a.username=b.username
   AND b.myposisi LIKE '$myposisi%' $dtgl");
  if ($q_upv->num_rows() > 0) {
   $total = 0;
   foreach ($q_upv->result_array() as $r_upv) {
    $total = $total + $r_upv["paket"];
   }
   $total_pv = $total_pv + $total;
  } else {
   $total_pv = 0;
  }
  return $total_pv;
  return $jm;
 }

}

/* End of file app_model.php */
/* Location: ./application/models/app_model.php */