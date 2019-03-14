<div class="btn-group btn-group-justified">
  <a href="<?php echo base_url(); ?>withdrawal" class="btn btn-warning">Withdraw E-Bonus</a>
  <a href="<?php echo base_url(); ?>history" class="btn btn-warning">History E-Bonus</a>
  <a href="<?php echo base_url(); ?>withdrawal/eregister" class="btn btn-warning">Withdraw E-Register</a>
  <a href="<?php echo base_url(); ?>history/eregister" class="btn btn-warning">History E-Register</a>
</div> 

<div class="bd-example">

<h4>History Request Transfer E-Register</h4>
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
              <?= number_format($db['jumlah_rp'],0); ?>
            </td>
            <td align="left"><?= number_format($db['adm'],0); ?>
            </td>
            <td><?= $db['tujuan']; ?></td>
            <td align="left"><?= $status; ?></td>
        </tr>
                            
		<?php
    $nom++;
    $total = $total + $db['jumlah_rp'];
    }
        ?>
        <tr>
          <td colspan="2" class="booking-history-type" style="text-align:center; font-weight:bold">Total</td>
          <td class="booking-history-type" style="text-align:left; font-weight:bold">
            <?= number_format($total,0); ?>
          </td>
          <td colspan="3 class="booking-history-type" style="text-align:right; font-weight:bold">&nbsp;</td>
        </tr>
                      
 </table>
</div>