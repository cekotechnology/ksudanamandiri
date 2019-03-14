

<h4>Downline List</h4>


<?php
$lv = 9;
for ($i = 0; $i < $lv; $i++) {
 $j = $i + 1;

 $ja = $this->network_model->jmlmember($user_session, "AND a.status=1 and b.upline$i='$user_session'"); //jml mbr aktif per level
 $jf = $this->network_model->jmlmember($user_session, "AND a.status=0 and blokir=0 and b.upline$i='$user_session'"); //jml mbr free per level
 $jb = $this->network_model->jmlmember($user_session, "AND a.blokir=1 and b.upline$i='$user_session'"); //jml mbr blokir per level

 if ($ja > 0 or $jf > 0) {
  ?>
  <a class="newsTitle">Level <?= $j; ?>: <span style="color:#006600"><?= $ja; ?></span> <span style="color:#0000CC"><?= $jf; ?></span> <span style="color:#FF0000"><?= $jb; ?></span></a>

  <?php
  //$db->select("a.username, a.nama, a.status, a.blokir, a.hp, a.phone, a.email, a.tglaktif, a.upline, b.sponsor, b.posisi", "member as a inner join upline as b on a.username=b.username", "b.upline$i='$user_session'");

  $dt_dwn = $this->db->query(" SELECT a.username, a.nama, a.status, a.blokir, a.hp, a.phone, a.email, a.tglaktif, a.tgl, a.upline, b.sponsor, b.posisi, c.sisa,(select sum(z.jumlah) from dataewalet z where z.username = a.username and z.status = 1 and z.jenis = 'kredit') as kredit, (select sum(z.jumlah) from dataewalet z where z.username = a.username and z.status = 1  and  z.jenis = 'debit') as debit  FROM member AS a
		LEFT JOIN upline AS b ON a.username=b.username
		LEFT JOIN ewalet_saldo AS c ON a.username=c.username
		WHERE b.upline$i='$user_session'");
  ?>
  <table class="table table-bordered table-striped table-booking-history">
   <tr>
    <td width="5%">#</strong></td>
    <td width="12%"><strong>No Anggota</strong></td>
    <td width="25%"><strong>Nama</strong></td>
    <td width="12%"><strong>Sponsor</strong></td>
    <td width="5%"><strong>HP</strong></td>

    <td width="16%"><strong>Tgl Daftar</strong></td>
    <td width="16%">Saldo</td>
   </tr>
   <?php
   $n      = 1;
   foreach ($dt_dwn->result_array() as $row) {

    if ($row['status'] > 0) {
     $status    = "" . date("d.m.y", strtotime($row['tgl']));
     $cl_status = "status_active";
    } else if ($row['blokir'] > 0) {
     $status    = "BLOKIR";
     $cl_status = "status_blokir";
    } else {
     $status    = "" . date("d.m.y", strtotime($row['tgl']));
     //	$status = "AKTIF &nbsp;".date("d.m.y", strtotime($row['tgl']));
     $cl_status = "status_free";
    }
    ?>
    <tr height="20">
     <td><?= $n; ?></td>
     <td><?= $row['username']; ?></td>
     <td><?= strtoupper($row['nama']); ?></td>
     <td><?= $row['sponsor']; ?></td>
     <td><?= $row['hp']; ?></td>

     <td class="<?= $cl_status; ?>" align="center"><?= $status; ?></td>
     <?php $saldo = $row['kredit'] - $row['debit']; ?>
     <!-- <td class="<?= $cl_status; ?>" align="right">Rp <?= number_format($row['sisa'], 0, ',', '.'); ?></td> -->
     <td class="<?= $cl_status; ?>" align="right">Rp <?= number_format($saldo, 0, ',', '.'); ?></td>
    </tr>

    <?
    $n++;
    if($row['sisa']>=5000000){
    $jml_mem++;
    }
    }
    ?>
    <tr height="20">
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td class="<?= $cl_status; ?>" align="center">&nbsp;</td>
     <td class="<?= $cl_status; ?>" align="left"><?= $jml_mem; ?></td>
 </tr>
</table>

<?
}
}
?>
