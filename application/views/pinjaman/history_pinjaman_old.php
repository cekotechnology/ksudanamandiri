<style type="text/css">
 .form-controle {

  width: 100%;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555555;
  background-color: #ffffff;
  background-image: none;
  border: 1px solid #cccccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
 }
 .form-controle:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
 }
 .form-controle::-moz-placeholder {
  color: #999999;
  opacity: 1;
 }
 .form-controle:-ms-input-placeholder {
  color: #999999;
 }
 .form-controle::-webkit-input-placeholder {
  color: #999999;
 }
 .form-controle[disabled],
 .form-controle[readonly],
 fieldset[disabled] .form-controle {
  cursor: not-allowed;
  background-color: #eeeeee;
  opacity: 1;
 }
 textarea.form-controle {
  height: auto;
 }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<h4>History Pinjaman Anggota</h4>
<p>&nbsp;</p>
<form action="" method="post" name="form1" id="form1">
 <label>Period from <input name="dc" id="dc" type="text" class="form-controle" style="width:100px;" value="<?= $dc; ?>" size="12" /> to <input name="dc2" id="dc2" type="text" class="form-controle" style="width:100px;" value="<?= $dc2; ?>" size="12" /> <input class="btn btn-primary" type="submit" value="Go" /></label>
</form>
<?php
$total      = 0;
$total_kr   = 0;
$total_db   = 0;
$saldo_last = 0;
?>
<table class="table table-bordered table-striped table-booking-history">
 <thead style="background:#666; color:#FFF;">
  <tr>
   <th>No</th>
   <th>Tanggal</th>
   <th>Kewajiban Bunga</th>
   <th>Bayar Bunga</th>
   <th>Tunggakan Bunga</th>
   <th>Bayar Pokok</th>
   <th>Sisa Pinjaman</th>
   <!--baru-->
   <!--<th>Pembayaran Bunga</th>-->
  </tr>
 </thead>
 <tbody>

  <?php
  if ($lst_pinjaman->num_rows() > 0) {
   $nom = 1;
   foreach ($lst_pinjaman->result_array() as $db) {
    ?>
    <tr>
     <td class="booking-history-type"><?= $nom++; ?></td>
     <td style="text-align:center"><?= date('d M Y', strtotime($db['tgl_pengajuan'])); ?></td>
     <td style="text-align:right"> - </td>
     <td style="text-align:right"> - </td>
     <td style="text-align:right">- </td>
     <td align="right">-</td>
     <!--Baru-->
     <td align="right"><?= number_format($db["jumlah_disetujui"], 2); ?></td>
     <!--<td align="right">0</td>-->
    </tr>
    <!--<tr>-->
    <!--    <td class="booking-history-type"><?= $nom++; ?></td>-->
    <!--    <td style="text-align:center"><?= date('d M Y', strtotime($db['tgl'] . "+1 month")); ?></td>-->
    <!--    <td style="text-align:right"><?php $hasil    = 0.03 * $db["jumlah_disetujui"];
  echo number_format($hasil);
    ?></td>-->
    <!--    <td style="text-align:right">-</td>-->
    <!--    <td style="text-align:right"><?php $hasil    = 0.03 * $db["jumlah_disetujui"];
  echo number_format($hasil);
  ?></td>-->
    <!--    <td align="right">-</td>-->
    <!--Baru-->
  <!--    <td align="right"><?= number_format($db["jumlah_disetujui"], 2); ?></td>-->
      <!--<td align="right">0</td>-->
    <!--</tr>-->
    <!--<tr>-->
    <!--  <td class="booking-history-type" style="text-align:right; font-weight:bold"></td>-->
    <!--  <td class="booking-history-type" style="text-align:right; font-weight:bold"></td>-->
    <!--  <td class="booking-history-type" style="text-align:right; font-weight:bold"></td>-->
    <!--  <td class="booking-history-type" style="text-align:right; font-weight:bold"></td>-->
    <!--  <td class="booking-history-type" style="text-align:right; font-weight:bold"></td>-->
    <!--  <td class="booking-history-type" style="text-align:right; font-weight:bold"></td>-->
    <!--  <td class="booking-history-type" style="text-align:right; font-weight:bold"></td>-->
    <!--</tr>-->
    <?php
    $nom++;
    $total_kr = $total_kr + $tot_kr;
    $total_db = $total_db + $tot_db;
    //$total = $total + $db['jumlah'];
   }
  } else {
   ?>

   <tr>
    <td colspan="8" style="text-align:center">Tidak ada data Pinjaman</td>
   </tr>
   <?php
  }
  ?>
 </tbody>
</table>
