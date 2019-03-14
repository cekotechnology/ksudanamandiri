<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<h4>History Pinjaman Anggota</h4>
<p>&nbsp;</p>
<form action="" method="post" name="form1" id="form1">
 <label>Period from <input name="dc" id="dc" type="text" class="form-controle" style="width:100px;" value="<?= $dc; ?>" size="12" />
  to <input name="dc2" id="dc2" type="text" class="form-controle" style="width:100px;" value="<?= $dc2; ?>" size="12" />
  <input class="btn btn-primary" type="submit" value="Go" /></label>
</form>
<?php
//echo $user_session;
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
  </tr>
 </thead>
 <tbody>
  <?php
  $dataPinjaman = $this->db->query("SELECT * FROM pinjaman_header WHERE username = '$user_session' AND `status` = 'DITERIMA'");
  if ($dataPinjaman->num_rows() > 0) {
//   debug($dataPinjaman->result_array());
   $show         = $dataPinjaman->row();
   $sisaPjm      = $show->jumlah_disetujui;
   echo "
    <tr style='text-align: right'>
    <td>1</td>
    <td>" . date('d-m-Y', strtotime($show->tgl_pengajuan)) . "</td>
    <td> - </td>
    <td> - </td>
    <td> - </td>
    <td> - </td>
    <td>" . number_format($sisaPjm) . "</td>
    </tr>
    ";
   $dataAngsuran = $this->db->query("SELECT * FROM pinjaman_detail WHERE username = '$user_session' AND id_pinjam = '$show->id_pinjam' order by tgl_bayar");
   if ($dataAngsuran->num_rows() > 0) {
    $no = 2;
    $tunggakan_bunga = 0;
    foreach ($dataAngsuran->result_array() as $r) {

    if($tunggakan_bunga==0){
      $tunggakan_bunga = ($sisaPjm * (2.5 / 100))-$r['bunga'];
    }else{
      $kewajiban_bunga = $sisaPjm * (2.5 / 100);
      $tunggakan_bunga = ($tunggakan_bunga + $kewajiban_bunga) - $r['bunga'];
    }

     echo "<tr style='text-align: right'>";
     echo "<td>" . $no++ . "</td>";
     echo "<td>" . date('d-m-Y', strtotime($r['tgl_bayar'])) . "</td>";
     echo "<td>" . number_format($sisaPjm * (2.5 / 100)) . "</td>";
     echo "<td style='background:#dbffdb'>" . number_format($r['bunga']) . "</td>";
     // echo "<td>" . number_format($r['bunga']) . "</td>";
     echo "<td>" . number_format($tunggakan_bunga) . "</td>";
     echo "<td style='background:#dbffdb'>" . number_format($r['angsuran']) . "</td>";
     echo "<td>" . number_format($sisaPjm - $r['angsuran']) . "</td>";

     echo "</tr>";
     $sisaPjm = $sisaPjm - $r['angsuran'];
     // $kewajiban_bunga = $sisaPjm * (2.5 / 100);
     // $tunggakan_bunga = ($tunggakan_bunga + $kewajiban_bunga) - $r['bunga'];

     
    }

    $tunggakan_bunga = ($tunggakan_bunga + $kewajiban_bunga);
   echo "<tr style='text-align: right'>";
   echo "<td>" . $no++ . "</td>";
   echo "<td></td>";
   echo "<td>" . number_format($sisaPjm * (2.5 / 100)) . "</td>";
   echo "<td style='background:#dbffdb'></td>";
   // echo "<td>" . number_format($r['bunga']) . "</td>";
   echo "<td>" . number_format($tunggakan_bunga) . "</td>";
   echo "<td style='background:#dbffdb'></td>";
   echo "<td></td>";

   echo "</tr>";
   } else {
    echo "
    <tr>
    <td colspan='7'> Tidak ada pembayaran angsuran</td>
    </tr>
    ";
   }
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
