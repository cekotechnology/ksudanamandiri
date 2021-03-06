<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
 .rowBayar{
  background:#dbffdb !important;
 }
 .setrong{
  font-weight: bold;
 }
 .nomor{
  text-align: center;
 }
 .abuabu{
  background: #EAEAEA !important;
 }
</style>
<h4>History Pinjaman Anggota</h4>
<p>&nbsp;</p>
<form action="" method="post" name="form1" id="form1">
 <label>Period from <input name="dc" id="dc" type="text" class="form-controle" style="width:100px;" value="<?= $dc; ?>" size="12" />
  to <input name="dc2" id="dc2" type="text" class="form-controle" style="width:100px;" value="<?= $dc2; ?>" size="12" />
  <input class="btn btn-primary" type="submit" value="Go" /></label>
</form>
<?php
//echo $user_session;
error_reporting(E_ALL);
?>
<table class="table table-bordered table-booking-history">
 <thead style="background:#666; color:#FFF;">
  <tr>
   <th>No</th>
   <th>Tanggal</th>
   <th>Kewajiban Bunga</th>
   <th>Bayar Bunga</th>
   <th>Tunggakan Bunga</th>
   <th>Bayar Pokok</th>
   <th>Sisa Pinjaman</th>
  </tr>
 </thead>
 <tbody>
  <?php
  $dataPinjaman = $this->db->query("SELECT * FROM pinjaman_header WHERE username = '$user_session' AND `status` = 'DITERIMA'");
  $persenBunga  = 2.5 / 100;
  if ($dataPinjaman->num_rows() > 0) {
   $idc          = 1;
   $dPj          = $dataPinjaman->row();
   echo "
     <tr class='text-right abuabu'>
      <td class='nomor'>1</td>
      <td class='tgl_byr'>" . date('d-m-Y', strtotime($dPj->tgl_pengajuan)) . "</td>
      <td class='wajib_bunga'> - </td>
      <td class='byr_bunga'> - </td>
      <td class='tunggakan'> - </td>
      <td class='pokok'> - </td>
      <td class='sisapjm'>" . number_format($dPj->jumlah_disetujui) . "</td>
     </tr>
     ";
   $adaTunggakan = getTunggakan($user_session, $dPj->id_pinjam);
//   $adaTunggakan = 0;
   //HEADER HISTORY
   if ($adaTunggakan > 0) { //Ada Tunggakan sebelum Februari 2019
    $idc = 3;
    echo "
     <tr class='text-right'>
      <td class='nomor'>2</td>
      <td class='tgl_byr'>01-02-2019</td>
      <td class='wajib_bunga'>" . number_format($persenBunga * $dPj->jumlah_disetujui) . "</td>
      <td class='byr_bunga'> - </td>
      <td class='tunggakan'>" . number_format($adaTunggakan) . "</td>
      <td class='pokok'> - </td>
      <td class='sisapjm'>" . number_format($dPj->jumlah_disetujui) . "</td>
     </tr>
     ";
   } else {
    $idc        = 4; //Tidak ada tunggakan
    $tglJtAkhir = "01-" . date('m-Y', strtotime("+1 month", strtotime($dPj->tgl_pengajuan)));
    $tglSkr     = date('Y-m-d');
    if ($tglSkr > (date('Y-m-d', strtotime($tglJtAkhir)))) {
     $idc = 5;
     echo "
     <tr class='text-right'>
      <td class='nomor'>2</td>
      <td class='tgl_byr'>01-" . date('m-Y', strtotime("+1 month", strtotime($dPj->tgl_pengajuan))) . "</td>
      <td class='wajib_bunga'>" . number_format($persenBunga * $dPj->jumlah_disetujui) . "</td>
      <td class='byr_bunga'> - </td>
      <td class='tunggakan'> - </td>
      <td class='pokok'> - </td>
      <td class='sisapjm'>" . number_format($dPj->jumlah_disetujui) . "</td>
     </tr>
     ";
    }
   }
   //END HEADER HISTORY

   $dataAngsuran = $this->db->query("SELECT * FROM pinjaman_detail WHERE username = '$user_session'
    AND id_pinjam = '$dPj->id_pinjam' GROUP BY DATE_FORMAT(tgl_bayar, '%Y-%m')");
   $no           = 3;
   if ($dataAngsuran->num_rows() > 0) { //Ada Angsuran
    $idc      = 6;
    $last_key = end(array_keys($dataAngsuran->result_array()));
    foreach ($dataAngsuran->result_array() as $key => $a) {
     $periodeBayar   = substr($a['tgl_bayar'], 0, 7);
     $getAngsPeriode = $this->db->query("SELECT * FROM pinjaman_detail
      WHERE username ='$user_session' AND id_pinjam = '$dPj->id_pinjam'
       AND DATE_FORMAT(tgl_bayar,'%Y-%m') = '$periodeBayar' ORDER BY tgl_bayar");
     if ($key == $last_key) {

      $kSisaPjm    = $a['sisa_pinjaman'];
      $kTunggakan  = $a['tunggakan_bunga'];
      $kJatuhTempo = $a['tgl_jatuh_tempo'];
     }
     $wajibBungaJt = $persenBunga * $a['sisa_pinjaman'];
     $tglJt        = date('d-m-Y', strtotime($a['tgl_jatuh_tempo']));
     $tunggakanJt  = $a['tunggakan_bunga'];

     $last_keys = end(array_keys($getAngsPeriode->result_array()));
     foreach ($getAngsPeriode->result_array() as $keys => $b) {
      if ($keys == $last_keys) {
       $lSisaPjm    = $b['sisa_pinjaman'];
       $lBayarBunga = $b['bunga'];
       $lTunggakan  = $b['tunggakan_bunga'];
       $lJatuhTempo = $b['tgl_jatuh_tempo'];
      }
      $byrBunga    = $b['bunga'] > 0 ? number_format($b['bunga']) : "";
      $byrAngsuran = $b['angsuran'] > 0 ? number_format($b['angsuran']) : "";
      echo "
     <tr class='text-right rowBayar setrong'>
      <td class='nomor'>" . $no++ . ".</td>
      <td class='tgl_byr'>" . date('d-m-Y', strtotime($b['tgl_bayar'])) . "</td>
      <td class='wajib_bunga'></td>
      <td class='byr_bunga'>" . $byrBunga . "</td>
      <td class='tunggakan'>" . number_format($b['tunggakan_bunga']) . "</td>
      <td class='pokok'>" . $byrAngsuran . "</td>
      <td class='sisapjm'>" . number_format($b['sisa_pinjaman']) . "</td>
     </tr>
     ";
     }
     $tglSkr = date("Y-m-d");
     if ($tglSkr < $lJatuhTempo) {

      if ($lSisaPjm == "0") {
       $idc = 8;
       echo "
     <tr class='text-center abuabu'>
      <td colspan='7'>L U N A S</td>
     </tr>
     ";
      }
     } else {
      $idc           = 9;
      //CEK ADA ANGSURAN BULAN INI
      $cekAngsBlnSkr = $this->db->query("SELECT * FROM pinjaman_detail
      WHERE username ='$user_session' AND id_pinjam = '$dPj->id_pinjam'
       AND DATE_FORMAT(tgl_bayar,'%Y-%m') = '$periodeBayar'");
      if ($cekAngsBlnSkr->num_rows() > 0) {
       $idc = 10;
       //FOOTER ANGSURAN
//       if ($b['sisa_pinjaman'] > 0) {
       if ($lSisaPjm !== "0") {
        $idc = 11;
        echo "
     <tr class='text-right'>
      <td class='nomor'>" . $no++ . "</td>
      <td class='tgl_byr'>01-" . date('m-Y', strtotime($lJatuhTempo)) . "</td>
      <td class='wajib_bunga'>" . number_format($persenBunga * $lSisaPjm) . "</td>
      <td class='byr_bunga'>-</td>
      <td class='tunggakan'>" . number_format($lTunggakan + ($lSisaPjm * $persenBunga)) . "</td>
      <td class='pokok'>-</td>
      <td class='sisapjm'>" . number_format($b['sisa_pinjaman']) . "</td>
     </tr>
     ";
//        echo "
//     <tr class='text-right'>
//      <td class='nomor'>" . $no++ . "</td>
//      <td class='tgl_byr'>01-" . date('m-Y', strtotime("+1 month", strtotime($lJatuhTempo))) . "</td>
//      <td class='wajib_bunga'>" . number_format($persenBunga * $lSisaPjm) . "</td>
//      <td class='byr_bunga'>-</td>
//      <td class='tunggakan'>" . number_format($lTunggakan + ($lSisaPjm * $persenBunga)) . "</td>
//      <td class='pokok'>-</td>
//      <td class='sisapjm'>" . number_format($b['sisa_pinjaman']) . "</td>
//     </tr>
//     ";
       } else {
        $idc = 12;
        echo "
     <tr class='text-center abuabu'>
      <td colspan='7'>L U N A S</td>
     </tr>
     ";
       }
      }
     }
     $nos = $no++;
    }
   } else { //Tidak Ada Angsuran
    $wajibBungaJt = $persenBunga * $dPj->jumlah_disetujui;
    $tglJt        = $dPj->tgl_pengajuan;
    $tunggakanJt  = getTunggakan($user_session, $dPj->id_pinjam);
    $getLastAngs  = $this->db->query("SELECT tgl_jatuh_tempo FROM pinjaman_detail
     WHERE username ='$user_session' AND id_pinjam = '$dPj->id_pinjam' ORDER BY tgl_bayar DESC LIMIT 1 ");
    $tglSkr       = date('Y-m-d');
    if ($tglSkr <= $tglJt) {
     $idc = 13;
     echo "
     <tr class='text-center'>
      <td colspan='7'>Belum Ada Angsuran</td>
     </tr>
     ";
    } else {
     $idc = 14;
     echo "
     <tr class='text-right'>
      <td class='nomor'>" . $no++ . "</td>
      <td class='tgl_byr'>01-" . date('m-Y', strtotime("+1 month", strtotime($tglJt))) . "</td>
      <td class='wajib_bunga'>" . number_format($persenBunga * $dPj->jumlah_disetujui) . "</td>
      <td class='byr_bunga'>-</td>
      <td class='tunggakan'>" . number_format($tunggakanJt + ($dPj->jumlah_disetujui * $persenBunga)) . "</td>
      <td class='pokok'>-</td>
      <td class='sisapjm'>" . number_format($dPj->jumlah_disetujui) . "</td>
     </tr>
     ";
    }
   }
  } else {
   $idc = 2;
   echo "
    <tr class='text-center'>
    <td colspan='7'> Tidak ada pembayaran angsuran</td>
    </tr>
    ";
  }

  var_dump($idc);
  ?>
 </tbody>
</table>
