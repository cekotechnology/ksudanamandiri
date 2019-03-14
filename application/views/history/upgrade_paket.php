<h4>Dartar Upgrade Paket (GSI)</h4>
<table class="table table-bordered table-striped table-booking-history">
    <thead style="background:#666; color:#FFF; ">
        <tr>
            <th>No</th>
            <th>Tgl Upgrade</th>
            <th>Nama Paket</th>
            <th>Biaya Paket</th>
            <th>Business Value</th>
            <th>Tgl Start GSI</th>
            <th>Max Payout</th>
            <th>Total dibayar</th>
            <th>Sisa</th>
            <th>Status</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    <?php
	$nom=1;
	$total = 0;
	if($lst_upgrade->num_rows()){
	foreach($lst_upgrade->result_array() as $db){
		
		$nama_paket = $this->data_model->nama_paket($db['code_paket']);
		$max_payout = $db['bv']*2.4;
		$total_bayar = $this->data_model->tot_bayar_roi($user_session,$db['id']);
		
		if($total_bayar>=$max_payout){
			$status_profit = "Expired";
		} else {
			$status_profit = "Active";	
		}
	?>
        <tr>
            <td><?= $nom; ?></td>
            <td><?= $db['tgl_register']; ?></td>
            <td><?= $nama_paket; ?></td>
            <td><?= number_format($db['bayar'],2); ?> </td>
            
            <td><?= $db['bv']; ?> BV</td>
            <td><?= $db['tgl_start_roi']; ?></td>
            <td><?= number_format($max_payout,2); ?> BV</td>
            <td><?= number_format($total_bayar,2); ?> BV</td>
            <td><?= number_format($max_payout-$total_bayar,2); ?> BV</td>
            <td align="center"><?= $status_profit; ?></td>
            <td align="center"><button type="button" class="btn btn-info btn-xs"  data-toggle="modal" data-target="#myModal<?= $nom; ?>">VIEW</button>
            <!-- Modal -->
<div id="myModal<?= $nom; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">History Pembayaran GSI untuk Paket <?= $nama_paket; ?></h4>
      </div>
      <div class="modal-body">
        <p>Update</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
            </td>
        </tr>
       
        
        <?php
	$nom++;
	}
	} else {
		?>
         <tr>
          <td colspan="11" align="center">Tidak ada data</td>
        </tr>
    <?php
	}
	?>
    </tbody>
</table>