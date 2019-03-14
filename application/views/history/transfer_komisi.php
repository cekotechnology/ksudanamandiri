 

<div class="bd-example">

<h4>History Transfer (Withdrawal)</h4>
<table class="table table-striped">
                      
    <tr>
        <th>No</th>
        <th>Date</th>
        <th>Jumlah (Rp)</th>
        <th>Adm</th>
        <th>Ditransfer ke</th>
        <th>Status</th>
    </tr>
                        
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
            <td class="booking-history-title"><?= $this->app_model->formatgl($db['tgl_req']); ?></td>
            <td align="left">
              <?= number_format($db['jumlah'],0); ?>            </td>
            <td align="left"><?= number_format($db['adm'],0); ?>            </td>
            <td><?= $db['bank']; ?><br />Norek.<?= $db['norek']; ?><br /> a/n.<?= $db['namarek']; ?> </td>
            <td align="left"><?= $status; ?></td>
        </tr>
                            
		<?php
    $nom++;
    $total = $total + $db['rp'];
    }
        ?>
        <tr>
          <td colspan="2" class="booking-history-type" style="text-align:right; font-weight:bold">Total</td>
          <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
          <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
          <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
          <td class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
        </tr>
 </table>
</div>