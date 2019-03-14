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

 

<h4>Bonus Reward</h4>
<p>&nbsp;</p>
<table width="100%" border="1" style="border:0px solid #CCCCCC; border-collapse:collapse">
   
    <tr height="30">
      <td rowspan="2" style="border:1px solid #CCCCCC; text-align: center;"><strong>REWARD</strong></td>
      <td rowspan="2" style="border:1px solid #CCCCCC; text-align: center;"><strong>KETERANGAN</strong></td>
      <td colspan="2" style="border:1px solid #CCCCCC; text-align: center;"><strong>OMZET</strong></td>
      <td width="60" rowspan="2" style="border:1px solid #CCCCCC; text-align: center;"><strong>STATUS</strong></td>
    </tr>
    <tr height="30"> 
      
      
      <td width="65" style="border:1px solid #CCCCCC; text-align: center;"><strong> KIRI</strong></td>
      <td width="65" style="border:1px solid #CCCCCC; text-align: center;"><strong> KANAN </strong></td>
    </tr>
    <tr> 
      
      <td width="108" height="25" valign="top" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward1; ?>" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;">
        <?= $nama_reward1; ?> senilai <?= $nilai_reward1; ?>
        <br />
	  <br />
	 Syarat (KIRI -  KANAN) : <?= number_format($syarat1,0); ?> : <?= number_format($syarat1,0); ?> </td>
      
<td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center">
        Belum Dicapai       </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward2; ?>" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward3; ?>" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward4; ?>" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward5; ?>" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward6; ?>" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward7; ?>" alt="" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward8; ?>" alt="test" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward9; ?>" alt="" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
    <tr>
      <td height="25" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= $nama_file_reward10; ?>" alt="" width="90" /></td>
      <td width="95" valign="top" style=" padding:5px;"><?= $nama_reward1; ?>
        senilai
        <?= $nilai_reward1; ?>
        <br />
        <br />
        Syarat (KIRI -  KANAN) :
  <?= number_format($syarat1,0); ?>
        :
  <?= number_format($syarat1,0); ?></td>
      <td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"> Belum Dicapai </td>
    </tr>
  </table>
