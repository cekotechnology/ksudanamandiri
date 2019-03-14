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
<h4>History Pinjaman Anggota TRIAL 4</h4>
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
  if ($dataPinjaman->num_rows() > 0) {
   foreach ($dataPinjaman->result() as $key => $value) {
    $show         = $dataPinjaman->row();
    $sisaPjm      = $show->jumlah_disetujui;
    echo "
    <tr class='abuabu' style='text-align: right'>
    <td class='nomor'>1</td>
    <td>" . date('d-m-Y', strtotime($show->tgl_pengajuan)) . "</td>
    <td> - </td>
    <td> - </td>
    <td> - </td>
    <td> - </td>
    <td>" . number_format($sisaPjm) . "</td>
    </tr>
    ";
//    exit();
    $dataAngsuran = $this->db->query("SELECT *
     FROM pinjaman_detail_trial
     WHERE username = '$user_session'
      AND id_pinjam = '$value->id_pinjam'
       GROUP BY date_format(tgl_bayar, '%m-%Y')
       ORDER BY tgl_bayar");

    $noAngs = 2;
    if ($dataAngsuran->num_rows() > 0) {
//     debug($dataAngsuran->result_array());
     $last_key = end(array_keys($dataAngsuran->result_array()));
     foreach ($dataAngsuran->result_array() as $key => $val) {

      if ($key == $last_key) {
       $lastPjm      = $val['sisa_pinjaman'];
       $lastTgkBunga = $val['tunggakan_bunga'];
      }
      //HEADER ROW JATUH TEMPO PER BULAN
      $blnAngsJt    = substr($val['tgl_bayar'], 0, 7);
      $getDataJt    = $this->db->query("SELECT * FROM pinjaman_detail_trial WHERE DATE_FORMAT(tgl_bayar, '%Y-%m') = '$blnAngsJt'")->row();
      $cekAngs      = $this->db->query("SELECT * FROM pinjaman_detail_trial WHERE username = '$user_session' AND id_pinjam = '$value->id_pinjam'");
      $getFirstAngs = $this->db->query("SELECT * FROM pinjaman_detail_trial WHERE id_pinjam = '$value->id_pinjam' ORDER BY id ASC LIMIT 1")->row();
      if ($cekAngs->num_rows() > 0) {
       $selLastAngs = $this->db->query("SELECT * FROM pinjaman_detail_trial WHERE id_pinjam = '$value->id_pinjam' ORDER BY id DESC LIMIT 1")->row();
       $tgkBungaJt  = $selLastAngs->tunggakan_bunga + (2.5 / 100) * $selLastAngs->sisa_pinjaman - $selLastAngs->bunga;
      } else {
       $tgkBungaJt = getTunggakan($username, $nomor_pinjaman) - $jml_bunga;
      }
      echo "
        <tr class='text-right'>
        <td class='nomor'>asdas" . $noAngs++ . "</td>
        <td> 01-" . date('m-Y', strtotime($val['tgl_bayar'])) . "</td>
        <td>" . number_format($getFirstAngs->wajib_bunga) . "</td>
        <td></td>
        <td>" . number_format($tgkBungaJt) . "</td>
        <td></td>
        <td>" . number_format($getDataJt->sisa_pinjaman) . "</td>
       </tr>
       ";

      $blnAngs    = substr($val['tgl_bayar'], 0, 7);
      $cekAngsBln = $this->db->query("SELECT *
      FROM pinjaman_detail_trial
      WHERE id_pinjam = '$value->id_pinjam'
      AND DATE_FORMAT(tgl_bayar, '%Y-%m') = '$blnAngs'
      ORDER BY tgl_bayar ASC");
//      debug($cekAngsBln->result_array());
      if ($cekAngsBln->num_rows() > 0) {
       $last_keys = end(array_keys($cekAngsBln->result_array()));
       foreach ($cekAngsBln->result_array() as $keys => $vals) {
        if ($keys == $last_keys) {

        }
        if ($vals['bunga'] > 0) {
         $tBunga = number_format($vals['bunga']);
        } else {
         $tBunga = "";
        }
        if ($vals['angsuran'] > 0) {
         $tAngs = number_format($vals['angsuran']);
        } else {
         $tAngs = "";
        }
//        $tampilWajibBungaTemp = "<i class='text-muted'>" . number_format($vals['wajib_bunga']) . "</i>";
        $tampilWajibBungaTemp = "";
        echo "
        <tr class='text-right'>
        <td class='nomor'>as" . $noAngs++ . "</td>
        <td class='rowBayar'>as" . date('d-m-Y', strtotime($vals['tgl_bayar'])) . "</td>
        <td class='rowBayar'>as" . $tampilWajibBungaTemp . "</td>
        <td class='rowBayar'>ds" . $tBunga . "</td>
        <td class='rowBayar'>as" . number_format($vals['tunggakan_bunga']) . "</td>
        <td class='rowBayar'>ds" . $tAngs . "</td>
        <td class='rowBayar'>asd" . number_format($vals['sisa_pinjaman']) . "</td>
       </tr>
       ";
       }
      }
      //row jt per bulan
     }
    }
    echo "<tr class='text-right setrong'>";
    $cekAngsuranAkhir = $this->db->query("SELECT *
     FROM pinjaman_detail_trial
     WHERE username ='$user_session'
      AND id_pinjam ='$value->id_pinjam' ")->num_rows();
    if ($cekAngsuranAkhir > 0) {
     $idJt         = $this->db->query("SELECT MAX( id ) as idJt
      FROM pinjaman_detail_trial
      WHERE username ='$user_session' AND id_pinjam = '$value->id_pinjam'")->row()->idJt;
     $lastAngs     = $this->db->query("SELECT * FROM pinjaman_detail_trial WHERE id = '$idJt'")->row();
     $wajibBungaJt = $lastAngs->sisa_pinjaman * (2.5 / 100);
     $TgkBungaJt   = ($lastAngs->sisa_pinjaman * (2.5 / 100)) + $lastAngs->tunggakan_bunga;
     $tglJtempoL   = date('m-Y', strtotime($lastAngs->tgl_jatuh_tempo));
     $sisaPjmAkhir = $lastAngs->sisa_pinjaman;
    } else {
     $lastTgkBunga = getTunggakan($user_session, $value->id_pinjam);
     $wajibBungaJt = $sisaPjm * (2.5 / 100);
     $TgkBungaJt   = $lastTgkBunga;
     $tglJtempoL   = date('m-Y', strtotime('2019-02-01'));
     $sisaPjmAkhir = $sisaPjm;
    }

    echo "
     <td class='nomor'>asfas" . $noAngs ++ . "</td>
     <td>01-" . $tglJtempoL . "</td>
     <td>" . number_format($wajibBungaJt) . "</td>
     <td> - </td>
     <td>" . number_format($TgkBungaJt) . "</td>
     <td> - </td>
     <td>" . number_format($sisaPjmAkhir) . "</td>
     ";
    echo "</tr>";


    $_rest1     = $this->db->query("select jumlah_disetujui from pinjaman_header where id_pinjam = '" . $value->id_pinjam . "'")->row();
    $_angsuran1 = $this->db->query("select sum(angsuran) as angsuran from pinjaman_detail_trial where id_pinjam = '" . $value->id_pinjam . "'")->row();

    if ($_angsuran1->angsuran == $_rest1->jumlah_disetujui) {
     echo "<tr style='text-align: rightl; background:#666; color:#FFF;'>";
     echo "<td></td>";
     echo "<td colspan='6' style='text-align:center;'>LUNAS</td>";
     echo "</tr>";
    } else {

    }//endif
   }//endforeach
  } else {
   echo "
    <tr>
    <td colspan='7'> Tidak ada pembayaran angsuran</td>
    </tr>
    ";
  }
  ?>
 </tbody>
</table>
