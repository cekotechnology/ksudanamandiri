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

 

<h4>Withdrawal Funds</h4>
<p>&nbsp;</p>
 <form method="post" action="<?php echo base_url();?>index.php/fund/transfer">
<table class="table table-bordered table-striped table-booking-history">
                                                              <tr>
                                                                <td align="right">Current Ballance :</td>
                                                                <td>US$ <?= $this->bonus_model->rupiah2($this->ewalet_model->myewaletdone($user_session, "")); ?></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right">Amount to Withdraw :</td>
                                                                <td><input name="jumlah" type="number" class="form-controle" id="jumlah" size="15" style="width:150px;" required /></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right"> Transfer to :</td>
                                                                <td>Bank Name : <?= $this->data_model->dataku("bank",$user_session); ?><br />
                                                                Account No. : <?= $this->data_model->dataku("norek",$user_session); ?><br />
                                                                Account Name. : <?= $this->data_model->dataku("namarek",$user_session); ?><br /></td>
                                                              </tr>
                                                              <tr>
                                                                <td align="right" valign="top">&nbsp;</td>
                                                                <td><input type="submit" name="submit" id="submit" value="NEXT" class="btn btn-primary" /></td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="2"><span><strong>Terms and conditions :</strong></span>
                                                                  <ol style="margin:20px;">
                                                                    <li>Minimum withdraw amount US.10.00</li>
                                                                    <li>Every transaction will be charge US 0.5 for administration fee.<br />
                                                                    </li>
                                                                </ol></td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="2" align="center"></td>
              </tr>
                                                            </table>
</form>