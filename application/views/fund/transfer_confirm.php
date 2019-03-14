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

 

<h4>Confirmation of Transfer Fund</h4>
<p style="color:#F00;"><?= $message; ?></p>
 <form method="post" action="<?php echo base_url();?>index.php/fund/transfer">
<table class="table table-bordered table-striped table-booking-history">
                                                                                        <tr>
                                                                <td align="right">Amount Transfer : </td>
                                                                <td>US.$ <?= $this->bonus_model->rupiah2($jumlah); ?> <input name="jumlah" type="hidden" id="jumlah" value="<?= $jumlah; ?>" size="10" /></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right"> Transfer to :</td>
                                                                <td><b>
                                                                  <?= $username; ?>
                                                                </b>
                                                                  
                                                                  <input name="username" type="hidden" id="username" value="<?= $username; ?>" size="10" /> / <?= strtoupper($nama); ?></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right"><strong>Input PIN :</strong></td>
                                                                <td>
                                                                  <input name="passwd" class="form-controle" type="password" id="passwd" size="15" style="width:150px;"  required /></td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="2" align="center"><input type="submit" name="transfer" id="transfer" value="TRANSFER" class="btn btn-primary" <?=$dis?> /></td>
                                                              </tr>
                                                 
                                                            </table>
</form>