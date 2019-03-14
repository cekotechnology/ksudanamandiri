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

 

<h4>History Transfer Komisi</h4>
<p>&nbsp;</p>
<table class="table table-bordered table-striped table-booking-history">
                        <thead style="background:#666; color:#FFF;">
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Jumlah</th>
                                <th>Ditransfer ke</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$nom=1;
						$total = 0;
						foreach($lst_transfer->result_array() as $db)
						{
							if($db['status']==1){
								$status = "Terbayar";	
							} else {
								$status = "Pending";
							}
						?>
                            <tr>
                                <td class="booking-history-type"><?= $nom; ?></td>
                                <td class="booking-history-title"><?= $this->app_model->formatgl($db['tglbayar']); ?></td>
                                <td class="booking-history-title" align="right">
                                  <?= number_format($db['rp'],0); ?>
                                </span></td>
                                <td><?= $db['tujuan']; ?></td>
                                <td align="right"><?= $status; ?></td>
                            </tr>
                            
                            <?php
						$nom++;
						$total = $total + $db['rp'];
						}
							?>
                            <tr>
                              <td colspan="2" class="booking-history-type" style="text-align:right; font-weight:bold">Total</td>
                              <td class="booking-history-type" style="text-align:right; font-weight:bold"><span style="font-weight:bold">
                                <?= $this->bonus_model->rupiah2($total); ?>
                              </span></td>
                              <td colspan="2" class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>