<h4>Downline List</h4>
<style>
 #rowMerah{
  font-weight: bold;
  color: #FF0000 !important;
 }
 .rp {
  float: left;
 }
</style>

<?php
//error_reporting(E_ALL);
$lv      = 8;
$jml_mem = 0;
for ($i = 0; $i <= $lv; $i++) {
 $j = $i + 1;

 $posisi   = $this->db->query("SELECT a.myposisi
  FROM upline a, member b
  WHERE b.username = a.username
  AND b.username = '$user_session'
  ")->row()->myposisi;
 $nonAktif = $this->db->query("
  SELECT
  count( a.username ) as nonaktif
  FROM member AS a
		LEFT JOIN upline AS b ON a.username=b.username
		LEFT JOIN ewalet_saldo AS c ON a.username=c.username
		WHERE b.upline$i ='$user_session' AND
		(select sum(z.jumlah) from dataewalet z where z.username = a.username and z.status = 1 and z.jenis = 'kredit') is null
  ")->row()->nonaktif;
 $aktif    = $this->db->query("
  SELECT
  count( a.username ) as aktif
  FROM member AS a
		LEFT JOIN upline AS b ON a.username=b.username
		LEFT JOIN ewalet_saldo AS c ON a.username=c.username
		WHERE b.upline$i ='$user_session' AND
		(select sum(z.jumlah) from dataewalet z where z.username = a.username and z.status = 1 and z.jenis = 'kredit') is not null
  ")->row()->aktif;

// echo "Posisi: " . $posisi . "<br>";
// echo "NON-AKTIF: " . $nonAktif . "<br>";
// $ja = $this->network_model->jmlmember($user_session, "AND a.status=1 and b.upline$i='$user_session'"); //jml mbr aktif per level
// $jf = $this->network_model->jmlmember($user_session, "AND a.status=0 and blokir=0 and b.upline$i='$user_session'"); //jml mbr free per level
// $jb = $this->network_model->jmlmember($user_session, "AND a.blokir=1 and b.upline$i='$user_session'"); //jml mbr blokir per level
// debug($jf);
 if ($aktif > 0 or $nonAktif > 0) {
  ?>
  <p>
   <strong>LEVEL <?= $j; ?> :</strong>
   <span style="color:#006600"><strong><?= $aktif; ?> Anggota Aktif</strong></span> -
   <span style="color:#FF0000"><strong><?= $nonAktif; ?> Anggota Tidak Aktif</strong></span>
   <!--<span style="color:#FF0000"><strong><?= $jb; ?> Anggota Blocked</strong></span>-->
  </p>

  <?php
  //$db->select("a.username, a.nama, a.status, a.blokir, a.hp, a.phone, a.email, a.tglaktif, a.upline, b.sponsor, b.posisi", "member as a inner join upline as b on a.username=b.username", "b.upline$i='$user_session'");

  $dt_dwn = $this->db->query("SELECT
   a.username,
   a.nama,
   a.status,
   a.blokir,
   a.hp,
   a.phone,
   a.email,
   a.tglaktif,
   a.tgl,
   a.upline,
   b.sponsor,
   b.posisi,
   c.sisa,
   (select sum(z.jumlah) from dataewalet z where z.username = a.username and z.status = 1 and z.jenis = 'kredit') as kredit,
   (select sum(z.jumlah) from dataewalet z where z.username = a.username and z.status = 1  and  z.jenis = 'debit') as debit
   FROM member AS a
		LEFT JOIN upline AS b ON a.username=b.username
		LEFT JOIN ewalet_saldo AS c ON a.username=c.username
		WHERE b.upline$i='$user_session'");
  ?>
  <table class="table table-bordered table-hover table-striped table-booking-history">
   <thead>
    <tr>
     <th width="5%"><center>#</center></th>
  <th width="12%"><strong>No Anggota</strong></th>
  <th width="25%"><strong>Nama</strong></th>
  <th width="12%"><strong>Sponsor</strong></th>
  <th width="5%"><strong>HP</strong></th>
  <th width="16%"><strong>Tgl Daftar</strong></th>
  <th width="16%">Saldo</th>
  </tr>
  </thead>
  <tbody>
   <?php
   $n      = 1;
   foreach ($dt_dwn->result_array() as $row) {
    $saldo = $row['kredit'] - $row['debit'];
    if ($saldo > 0) {
     $idRow = "";
    } else {
     $idRow = "rowMerah";
    }
    ?>
    <tr id="<?= $idRow ?>" height="20">
     <td><?= $n; ?></td>
     <td><?= $row['username']; ?></td>
     <td><?= strtoupper($row['nama']); ?></td>
     <td><?= $row['sponsor']; ?></td>
     <td><?= $row['hp']; ?></td>

     <td align="center"><?= date('d.m.y', strtotime($row['tgl'])); ?></td>
     <td align="right"><span class="rp">Rp.</span>
      <?php
//      echo $saldo;
      echo number_format($saldo, 0, ',', '.');
      ?></td>
    </tr>

    <?php
    $n++;
    if ($row['sisa'] >= 5000000) {
     $jml_mem++;
    }
   }
   ?>
  </tbody>
  <tfoot>
   <tr height="20">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left"><?php echo $jml_mem; ?></td>
   </tr>
  </tfoot>
  </table>

  <?php
 }
}
?>
