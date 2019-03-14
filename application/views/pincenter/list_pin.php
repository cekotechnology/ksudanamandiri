 <h4>Stock Pin Registrasi</h4>
<table class="table table-bordered table-striped table-booking-history">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Serial</th>
                                <th>Nama Paket</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Tgl Aktivasi</th>
                                <th>Member ID</th>
                                <th>#</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($lst_pin_register->num_rows()>0)
                        {
    						$nom=1;
    						foreach($lst_pin_register->result_array() as $db)
    						{
    						    if($db['dealer'] == 1){
    						        $nama_paket = "Agen";
    						    } else if($db['dealer'] == 2){
    						        $nama_paket = "Silver";
    						    } else if($db['dealer'] == 3){
    						        $nama_paket = "Gold";
    						    } else if($db['dealer'] == 4){
    						        $nama_paket = "Platinum";
    						   
    						    } else {
    						        
    						        $nama_paket = "-";
    						    }
								if($db['status'] ==1)
								{
									$status = 'Activated';
								} else {
									$status = '-';
								}
    						?>
                                <tr>
                                    <td class="booking-history-type"><?= $nom; ?></td>
                                    <td class="booking-history-title"><?= $db['pin']; ?></td>
                                    <td><?= $nama_paket; ?></td>
                                    <td><?= $db['dealer']; ?> unit</td>
                                    <td><?= $status; ?></td>
                                    <td><?= date("H:i:s",strtotime($db['tgl_aktivasi'])); ?></td>
                                    <td><?= $db['idmlm']; ?></td>
                                    <td>
                                    <?php
									if($db['status']==0)
									{
									?>	
                                    <form method="post" action="<?php echo base_url(); ?>pincenter/transfer/register">
                                      <input name="card_id" type="hidden" id="card_id" value="<?= $db['id']; ?>
                                      ">
                                      <input name="serial" type="hidden" id="serial" value="<?= $db['serial']; ?>
                                      ">
                                      <input name="transfer" type="submit" class="btn btn-warning" value="Transfer"></form>
                                    <?php
									} else {
									?>
                                    <input name="done" type="button" class="btn btn" value="Done">
                                    <?php
									}
									?>
                                    
                                    </td>
                                    
                                </tr>
                                <?php
    							$nom++;
    						}
						} else {
							?>
							<tr>
                                    <td class="booking-history-type" colspan="8"><small>Tidak ada data</small>
                                    </td>
                                </tr>
                        <?php
						}
                        ?>
                        </tbody>
                    </table>