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

 

<h4><?= $page_title; ?></h4>
<p>&nbsp;</p>
<form action="" method="post" name="form1" id="form1">
<label>Period from <input name="dc" id="dc" type="text" class="form-controle" style="width:100px;" value="<?= $dc; ?>" size="12" /> to <input name="dc2" id="dc2" type="text" class="form-controle" style="width:100px;" value="<?= $dc2; ?>" size="12" /> <input class="btn btn-primary" type="submit" value="Go" /></label>
</form>
<table class="table table-bordered table-striped table-booking-history">
                        <thead style="background:#666; color:#FFF;">
                            <tr>
                                <th style="width:10%">Date</th>
                                <th style="width:6%">Trans ID</th>
                                <th style="width:40%">Description</th>
                                <th style="width:15%">Amount</th>
                                <th style="width:15%">Balance</th>
                                <th style="width:8%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                              <td colspan="3" align="right">Previous balance</td>
                              <td align="right"><?= $this->bonus_model->rupiah2($saldo_last); ?></td>
                              <td align="right"><?= $this->bonus_model->rupiah2($saldo_last); ?></td>
                              <td align="right">&nbsp;</td>
                            </tr>
	<?php
    $nom=1;
    $totkr = 0;
    $totdb = 0;
    $totsd = 0;
	$jumlah = 0;
    foreach($lst_ewalet->result_array() as $db)
    {
        if($db['status'] > 0) {
            $status = "done";

        } else {
            $status = "pending";
        }	
		if($db['jenis'] == "kredit") {
			$jumlah = $db['jumlah'];
			$totkr = $totkr + $db['jumlah'];
			$color = "#303030";
		} else {
			$jumlah = $db['jumlah'] * -1;
			$totdb = $totdb + ($db['jumlah'] * -1);
			$color = "#FF0000";
		}		
	$totsd = $totkr - $totdb;
	if($nom == 1) {	
		$bal = $jumlah + $saldo_last;	
	} else {
		$bal = $jumlah  + $bal;	
	}		
    ?>
                            
                            <tr>
                                <td style="width:10%" align="center"><?= date("m/d/Y", strtotime($db['tgl'])); ?></td>
                                <td style="width:6%" align="center"><?= $db['id']; ?></td>
                                <td style="width:40%"><?= $db['uraian']; ?></td>
                                <td style="width:15%" align="right"><?= $jumlah; ?></td>
                                <td style="width:15%" align="right"><?=$this->bonus_model->rupiah2($bal); ?></td>
                                <td style="width:10%" align="right"><?= $status; ?></td>
                            </tr>
                            
                            
                            <?php
						$nom++;
						
						}
							?>
                            <tr>
                              <td class="booking-history-type">&nbsp;</td>
                              <td class="booking-history-title">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" align="right">Total Income</td>
                              <td align="right"><strong><?= $this->bonus_model->rupiah2($totkr); ?></strong></td>
                              <td align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" align="right">Total Expense</td>
                              <td align="right"><strong>
                                <?= $this->bonus_model->rupiah2($totdb * -1); ?></strong></td>
                              <td align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" align="right">Balance current period</td>
                              <td align="right"><?= $this->bonus_model->rupiah2($bal); ?></td>
                              <td align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="3" align="right">Balance</td>
                              <td align="right"><?= $this->bonus_model->rupiah2($this->ewalet_model->myewaletdone($user_session, "")); ?>
                              </strong></td>
                              <td align="right">&nbsp;</td>
                              <td align="right">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>