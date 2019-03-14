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
  $data_oktober     = [
      ["tunggakan" => 500000, "tanggal" => "01-11-2019"],
  ];
  $dataPinjaman     = $this->db->query("SELECT * FROM pinjaman_header WHERE username = '$user_session' AND `status` = 'DITERIMA'");
  $no               = 1;
  $jumlah_disetujui = $dataPinjaman->row_array()['jumlah_disetujui'];
  echo "
	<tr style='text-align: right'>
	<td>" . $no++ . "</td>
	<td>" . date('d-m-Y', strtotime($dataPinjaman->row()->tgl_pengajuan)) . "</td>
	<td> - </td>
	<td> - </td>
	<td> - </td>
	<td> - </td>
	<td>" . number_format(5000000) . "</td>
	</tr>
	";
  foreach ($data_oktober as $_value) {
   echo "<tr style='text-align: right'>";
   echo "<td>" . $no++ . "</td>";
   // echo "<td style='text-align:left;'> 01 " . $bulan[(int)$bulan_con-1] ." ".$tahun_con."</td>";
   echo "<td style='text-align:right;'> " . $_value['tanggal'] . "</td>";
   echo "<td>" . number_format($sisaPjm * (2.5 / 100)) . "</td>";
   echo "<td ></td>";
   // echo "<td>" . number_format($r['bunga']) . "</td>";
   echo "<td>" . number_format($_value['tunggakan']) . "</td>";
   echo "<td ></td>";
   echo "<td>" . number_format($jumlah_disetujui) . "</td>";
   echo "</tr>";
  }
  $bulan        = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
//print_r($this->session->all_userdata());
  $dataPinjaman = $this->db->query("SELECT * FROM pinjaman_header WHERE username = '$user_session' AND `status` = 'DITERIMA'");
  if ($dataPinjaman->num_rows() > 0) {
//   debug($dataPinjaman->result_array());

   foreach ($dataPinjaman->result() as $key => $value) {
    // }


    $show    = $dataPinjaman->row();
    $sisaPjm = $show->jumlah_disetujui;



    $dataAngsuran = $this->db->query("SELECT * FROM pinjaman_detail WHERE username = '$user_session' AND id_pinjam = '$value->id_pinjam'  group by date_format(tgl_bayar, '%m-%Y') order by tgl_bayar");

    $no = 2;
    if ($dataAngsuran->num_rows() > 0) {

     $tunggakan_bunga = 0;
     // $bulan_con = date('m', strtotime("+1 month",$show->tgl_pengajuan));
     // $tahun_con = date('Y', strtotime($show->tgl_pengajuan));

     $date                  = strtotime(date("Y-m-d", strtotime($show->tgl_pengajuan)) . " +1 month");
     $bulan_con             = date("m-Y", $date);
     $tunggakan_bunga_child = 0;
     foreach ($dataAngsuran->result_array() as $key => $r) {

      if ($tunggakan_bunga == 0) {
       $tunggakan_bunga = ($sisaPjm * (2.5 / 100)) - $r['bunga'];
      } else {
       $kewajiban_bunga = $sisaPjm * (2.5 / 100);
       $tunggakan_bunga = ($tunggakan_bunga + $kewajiban_bunga) - $r['bunga'];
      }


      $jum       = $key + 1;
      $date      = strtotime(date("Y-m-d", strtotime($value->tgl_pengajuan)) . " +" . $jum . " month");
      $bulan_con = date("m", $date);
      $tahun_con = date("Y", $date);

      echo "<tr style='text-align: right'>";
      echo "<td>" . $no++ . "</td>";
      // echo "<td style='text-align:left;'> 01 " . $bulan[(int)$bulan_con-1] ." ".$tahun_con."</td>";
      echo "<td style='text-align:right;'> 01-" . $bulan_con . "-" . $tahun_con . "</td>";
      echo "<td>" . number_format($sisaPjm * (2.5 / 100)) . "</td>";
      echo "<td ></td>";
      // echo "<td>" . number_format($r['bunga']) . "</td>";
      echo "<td>" . number_format($sisaPjm * (2.5 / 100) + $tunggakan_bunga_child) . "</td>";
      echo "<td ></td>";
      echo "<td>" . number_format($sisaPjm) . "</td>";
      echo "</tr>";

      $sisa_for_child = $sisaPjm * (2.5 / 100);

      $bulan_con = date("m-Y", $date);
      $query     = $this->db->query("select * from pinjaman_detail where date_format(tgl_bayar, '%m-%Y') = '" . $bulan_con . "' and id_pinjam = '" . $value->id_pinjam . "' order by tgl_bayar asc ")->result();


      if (count($query) > 0) {


       foreach ($query as $keys => $values) {

        $_rest     = $this->db->query("select jumlah_disetujui from pinjaman_header where id_pinjam = '" . $value->id_pinjam . "'")->row();
        $_angsuran = $this->db->query("select sum(angsuran) as angsuran from pinjaman_detail where id_pinjam = '" . $value->id_pinjam . "'")->row();

        if ($values->bunga != 0) {
         if ($tunggakan_bunga_child == 0) {
          $tunggakan_bunga_child = $sisaPjm * (2.5 / 100) - $values->bunga;
         } else {
          $tunggakan_bunga_child = $tunggakan_bunga_child - $values->bunga;
         }
        } else {
         $tunggakan_bunga_child = $tunggakan_bunga_child + $sisaPjm * (2.5 / 100);
        }




        echo "<tr style='text-align: right'>";
        echo "<td></td>";
        echo "<td style='text-align:right;background:#dbffdb;'>" . date('d-m-Y', strtotime($values->tgl_bayar)) . "</td>";
        echo "<td style='text-align:right;background:#dbffdb;'></td>";
        echo $values->bunga == 0 ? "<td style='background:#dbffdb;text-align:right;'></td>" : "<td style='background:#dbffdb;text-align:right;'>" . number_format($values->bunga) . "</td>";
        echo "<td style='text-align:right;background:#dbffdb;'>" . number_format($tunggakan_bunga_child) . "</td>";
        echo $values->angsuran == 0 ? "<td style='background:#dbffdb;text-align:right;'></td>" : "<td style='background:#dbffdb;text-align:right;'>" . number_format($values->angsuran) . "</td>";
        echo "<td style='text-align:right;'>" . number_format($sisaPjm - $values->angsuran) . "</td>";
        echo "</tr>";

        $sisaPjm = $sisaPjm - $values->angsuran;
       }//endforeach
      }//endif
     }//endforeach

     if ($sisaPjm == 0) {
      echo "<tr style='text-align: right'>";
      echo "<td></td>";
      echo "<td></td>";
      echo "<td></td>";
      echo "<td style='background:#dbffdb'></td>";
      // echo "<td>" . number_format($r['bunga']) . "</td>";
      echo "<td></td>";
      echo "<td style='background:#dbffdb'></td>";
      echo "<td></td>";

      echo "</tr>";
     } else {
      $jum       = $dataAngsuran->num_rows() + 1;
      $bulan_con = date('m', strtotime("+" . $jum . " month", $show->tgl_pengajuan));

      // $bulan_con = date('m', strtotime("+".$jum." month",$show->tgl_pengajuan));
      $date      = strtotime(date("Y-m-d", strtotime($show->tgl_pengajuan)) . " +" . $jum . " month");
      $bulan_con = date("m-Y", $date);

      if (date('d') == "01" || date('d') == "1") {
       echo "<tr style='text-align: right'>";
       echo "<td>" . $no++ . "</td>";
       echo "<td>01-" . $bulan_con . "</td>";
       echo "<td>" . number_format($sisaPjm * (2.5 / 100)) . "</td>";
       echo "<td></td>";
       // echo "<td>" . number_format($r['bunga']) . "</td>";
       $kewajibanbunga = $sisaPjm * (2.5 / 100);
       echo "<td>" . number_format($tunggakan_bunga_child + $kewajibanbunga) . "</td>";
       echo "<td></td>";
       echo "<td></td>";

       echo "</tr>";
      }
     }
     //$tunggakan_bunga = ($tunggakan_bunga + $kewajiban_bunga);
    } else {
     $jum       = $dataAngsuran->num_rows() + 1;
     $bulan_con = date('m', strtotime("+" . $jum . " month", $show->tgl_pengajuan));

     // $bulan_con = date('m', strtotime("+".$jum." month",$show->tgl_pengajuan));
     $date      = strtotime(date("Y-m-d", strtotime($show->tgl_pengajuan)) . " +" . $jum . " month");
     $bulan_con = date("m-Y", $date);

     $year  = date("Y", $date);
     $bulan = date("m", $date);


     if (date('d') >= "01" && date('d') <= "10") {
      echo "<tr style='text-align: right'>";
      echo "<td>" . $no . "</td>";
      echo "<td>01-" . $bulan_con . "</td>";
      echo "<td>" . number_format($sisaPjm * (2.5 / 100)) . "</td>";
      echo "<td style='background:#dbffdb'></td>";
      // echo "<td>" . number_format($r['bunga']) . "</td>";
      $kewajibanbunga = $sisaPjm * (2.5 / 100);
      echo "<td>" . number_format($tunggakan_bunga + $kewajibanbunga) . "</td>";
      echo "<td style='background:#dbffdb'></td>";
      echo "<td></td>";

      echo "</tr>";
     }
    }

    $_rest1     = $this->db->query("select jumlah_disetujui from pinjaman_header where id_pinjam = '" . $value->id_pinjam . "'")->row();
    $_angsuran1 = $this->db->query("select sum(angsuran) as angsuran from pinjaman_detail where id_pinjam = '" . $value->id_pinjam . "'")->row();

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
