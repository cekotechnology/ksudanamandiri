 <h4>Direct Sponsor List</h4>
<table class="table table-bordered table-striped table-booking-history">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Member ID</th>
                                <th>Full Name</th>
                                <th>No HP</th>
                                <th>Reg Date</th>
                                <th>Time</th>
                                <th>City</th>
                                <th>Package</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
						$nom=1;
						if($lst_sponsor->num_rows()>0){
    						foreach($lst_sponsor->result_array() as $db)
    						{
    						?>
                                <tr>
                                    <td class="booking-history-type"><small><?= $nom; ?></small>
                                    </td>
                                    <td class="booking-history-title"><?= $db['username']; ?></td>
                                    <td><?= $db['nama']; ?></td>
                                    <td><?= $db['hp']; ?></td>
                                    <td><?= $this->app_model->formatgl($db['tglaktif']); ?></td>
                                    <td><?= date("H:i:s",strtotime($db['tglaktif'])); ?></td>
                                    <td><?= $db['kota']; ?></td>
                                    <td class="text-center"><?= $this->data_model->mypaket($db['username']); ?></td>
                                </tr>
                                <?php
    							$nom++;
    						}
						} else {
							?>
							
							<tr>
                                    <td colspan="8" align="center"><small>Tidak ada data</small>
                                    </td>
                                    
                                </tr>
							
							<?php
						}
							?>
                        </tbody>
                    </table>