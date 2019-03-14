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

 

<h4>Bonus Summary</h4>
<p>&nbsp;</p>
<form action="" method="post" name="form1" id="form1">
<label>Period from <input name="dc" id="dc" type="text" class="form-controle" style="width:100px;" value="<?= $dc; ?>" size="12" /> to <input name="dc2" id="dc2" type="text" class="form-controle" style="width:100px;" value="<?= $dc2; ?>" size="12" /> <input class="btn btn-primary" type="submit" value="Go" /></label>
</form>
<span>Sponsoring Profit </span>
<table class="table table-bordered table-striped table-booking-history">
                        <thead style="background:#666; color:#FFF;">
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$nom=1;
						$total_spon = 0;
						if($lst_bonus_sponsor->num_rows()>0){
						foreach($lst_bonus_sponsor->result_array() as $db)
						{
						?>
                            <tr>
                                <td class="booking-history-type"><?= $nom; ?></td>
                                <td class="booking-history-title"><?= $this->app_model->formatgl($db['tglbayar']); ?></td>
                                <td>Bonus sponsor dari aktivasi member ID: <?= $db['dari']; ?></td>
                                <td align="right"><?= number_format($db['bayar'],2); ?></td>
                            </tr>
                            
                            
                            <?php
						$nom++;
						$total_spon = $total_spon + $db['bayar'];
						} 
						
							?>
                            <tr>
                              <td colspan="3" class="booking-history-type" style="text-align:right; font-weight:bold">Total</td>
                              <td align="right" style="font-weight:bold"><?= number_format($total_spon,2); ?></td>
                            </tr>
                         <?php
						} else {
						 ?>
                         <tr>
                              <td colspan="4" class="booking-history-type" style="text-align:center">No data</td>
                            </tr>
                           <?php
						}
						   ?>
                        </tbody>
                    </table>

<span>Personal Profit </span>
<table class="table table-bordered table-striped table-booking-history">
                        <thead style="background:#666; color:#FFF;">
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$nom=1;
						$total_pair = 0;
						if($lst_bonus_pairing->num_rows()>0){
						foreach($lst_bonus_pairing->result_array() as $db)
						{
						?>
                            <tr>
                                <td class="booking-history-type"><?= $nom; ?></td>
                                <td class="booking-history-title"><?= $this->app_model->formatgl($db['tglbayar']); ?></td>
                                <td>Bonus pasangan dari aktivasi member ID: <?= $db['dari']; ?></td>
                                <td align="right"><?= number_format($db['bayar'],2); ?></td>
                            </tr>
                            
                            
                            <?php
						$nom++;
						$total_pair = $total_pair + $db['bayar'];
						} 
						
							?>
                            <tr>
                              <td colspan="3" class="booking-history-type" style="text-align:right; font-weight:bold">Total</td>
                              <td align="right" style="font-weight:bold"><?= number_format($total_pair,2); ?></td>
                            </tr>
                         <?php
						} else {
						 ?>
                         <tr>
                              <td colspan="4" class="booking-history-type" style="text-align:center">No data</td>
                            </tr>
                           <?php
						}
						   ?>
                        </tbody>
                    </table> 

<span>Development</span>
<table class="table table-bordered table-striped table-booking-history">
                        <thead style="background:#666; color:#FFF;">
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$nom=1;
						$total_roi = 0;
						if($lst_bonus_roi->num_rows()>0){
						foreach($lst_bonus_leadership->result_array() as $db)
						{
						?>
                            <tr>
                                <td class="booking-history-type"><?= $nom; ?></td>
                                <td class="booking-history-title"><?= $this->app_model->formatgl($db['tglbayar']); ?></td>
                                <td>Bonus matching dari </td>
                                <td align="right"><?= number_format($db['bayar'],2); ?></td>
                            </tr>
                            
                            
                            <?php
						$nom++;
						$total_roi = $total_roi + $db['bayar'];
						} 
						
							?>
                            <tr>
                              <td colspan="3" class="booking-history-type" style="text-align:right; font-weight:bold">Total</td>
                              <td align="right" style="font-weight:bold"><?= number_format($total_roi,2); ?></td>
                            </tr>
                         <?php
						} else {
						 ?>
                         <tr>
                              <td colspan="4" class="booking-history-type" style="text-align:center">No data</td>
                            </tr>
                           <?php
						}
						   ?>
                        </tbody>
                    </table>