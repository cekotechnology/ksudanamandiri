 <h4>Stock Pin Upgrade</h4>
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
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($lst_pin_upgrade->num_rows()>0)
                        {
    						$nom=1;
    						foreach($lst_pin_upgrade->result_array() as $db)
    						{
    						?>
                                <tr>
                                    <td class="booking-history-type"><small><?= $nom; ?></small>
                                    </td>
                                    <td class="booking-history-title"><?= $db['serial']; ?></td>
                                    <td><?= $db['nama_paket']; ?></td>
                                    <td><?= $db['dealer']; ?> unit</td>
                                    <td><?= $db['status']; ?></td>
                                    <td><?= date("H:i:s",strtotime($db['tgl_aktivasi'])); ?></td>
                                    <td><?= $db['idmlm']; ?></td>
                                    
                                </tr>
                                <?php
    							$nom++;
    						}
						} else {
							?>
							<tr>
                                    <td class="booking-history-type" colspan="7"><small>Tidak ada data</small>
                                    </td>
                                </tr>
                        <?php
						}
                        ?>
                        </tbody>
                    </table>