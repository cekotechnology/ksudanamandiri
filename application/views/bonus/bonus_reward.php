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
<table  class="table table-bordered table-striped table-booking-history">
   
    <tr height="30">
      <td rowspan="2"><strong>NO</strong></td>
      <td rowspan="2" align="center"><strong>REWARD</strong></td>
      <td rowspan="2"><strong>KETERANGAN</strong></td>
      <td colspan="2" align="center"><strong>OMZET</strong></td>
      <td width="90" rowspan="2" align="center"><strong>STATUS</strong></td>
    </tr>
    <tr height="30"> 
      
      
      <td width="65"><strong> KIRI</strong></td>
      <td width="65"><strong> KANAN </strong></td>
    </tr>
    <?php
	for($i=0;$i<10;$i++){
		$j = $i+1;
	?>
    <tr>
      <td width="10" valign="top" style=" padding:5px; text-align:center"><?= $j; ?></td> 
      
      <td width="50" height="25" valign="top" style=" padding:5px; text-align:center"><img src="<?= base_url(); ?>asset/reward/<?= ${"nama_file_reward".$j}; ?>" style="width:110px;" /></td>
      <td width="200" valign="top" style=" padding:5px;">
        <?= ${"nama_reward".$j}; ?> senilai Rp <?= number_format(${"nilai_reward".$j}); ?>
        <br />
	  <br />
	 Syarat Omzet (KIRI -  KANAN) : <br />
	 Rp <?= number_format(${"syarat".$j},0); ?> : Rp <?= number_format(${"syarat".$j},0); ?> </td>
      
<td style=" text-align:center"><?= number_format($mki,0); ?></td>
      <td style="text-align:center"><?= number_format($mka); ?></td>
      <td align="center"><?= ${"status_reward".$j}; ?></td>
    </tr>
    <?php
	}
	?>
  </table>
