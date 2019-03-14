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

td{
line-height:16px;	
}
</style>
<table style="border-collapse: collapse;" border="0" cellpadding="0" width="100%">
											<tbody><tr>
											  <td>
												
												<div align="center">
													<table style="border-collapse: collapse;" border="0" bordercolor="#111111" cellpadding="0" width="100%">
														<tbody><tr>
															<td align="center" width="15">&nbsp;</td>
															<td align="center">
    <form action="" name="mid" method="post" >
      Search
	 
      <input name="mid" id="mid" class="form-controle" autocomplete="off" type="number" style="width:150px;" required />
	   
      <input class="btn btn-primary" name="Submit" value="Go" type="submit">
     
     </form>
		</td>
															<td align="center" width="15">&nbsp;</td>
														</tr>
														<tr>
															<td align="center" width="15">&nbsp;</td>
															<td align="center">
															<strong>Network <br />
															(<span style="color: rgb(255, 0, 0);"><?= $mid; ?></span> / <span style="color: rgb(255, 0, 0);"><?= $this->data_model->dataku("nama", $mid); ?></span>)<br>
															Sponsor (<span style="color: rgb(255, 0, 0);"><?= $this->data_model->dataku("sponsor", $mid); ?></span>)<br>
															<br></strong></td>
															<td align="center" width="15">&nbsp;</td>
														</tr>
													</tbody></table>
												</div>
												<div align="center">
													<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="683">
														<tbody><tr>
															<td align="center"><strong>Upline (<span style="color: rgb(255, 0, 0);"><?= $this->data_model->dataupline("upline0", $mid); ?></span>)</strong><br />&nbsp;</td>
														</tr>
														
														<tr>
															<td>
																<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody><tr>
																		<td align="center" width="301">
																			<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
																				<tbody><tr>
																					<td align="right">&nbsp;</td>
																				  <td align="center" width="10"></td>
																				</tr>
																			</tbody></table>																		</td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="1" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
	
 <?php
 if(!$this->data_model->dataku("foto", $mid)) {
 	$foto =  base_url()."asset/foto_profil/noimage.jpg";
} else {
	$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $mid);
}	
 ?>   
    																				<td align="center" bgcolor="#ffffff" height="125" width="81"><a href="#" title="<?= $this->data_model->dataku("nama", $mid); ?> <?= $this->data_model->dataku("kota", $mid); ?>"><table class="tbl03" cellpadding="0" cellspacing="0"><tbody><tr><td align="center" height="80" width="80"><img src="<?= $foto; ?>" title="<?= $this->data_model->dataku("nama", $mid); ?> <?= $this->data_model->dataku("kota", $mid); ?>" border="0" height="80" width="80"></td></tr></tbody></table></a><span style="font-size: 9px;"><?= $this->network_model->memberkiri($mid, ""); ?> | <?= $this->network_model->memberkanan($mid, ""); ?></span><br/>
<span style="font-size: 9px;"><?= $this->network_model->hitung_omzet($mid, "KIRI", ""); ?> | <?= $this->network_model->hitung_omzet($mid, "KANAN", ""); ?>
 Unit</span><br><span style="font-size: 9px;"><a href="#"><strong><?= $mid; ?></strong></a><br><?= $this->data_model->dataku("nama", $mid); ?><br /><?= $this->data_model->mypaket($mid); ?></span></td>
																				</tr>
																			</tbody></table>																		</td>
																		<td align="center" width="301">
																			<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
																				<tbody><tr>
																					<td align="center" width="10"></td>
																					<td align="left">&nbsp;</td>
																				</tr>
																			</tbody></table>																		</td>
																	</tr>
																</tbody></table>															</td>
														</tr>
														<tr>
														  <td align="center" background="<?php echo base_url(); ?>asset/network/tree03.gif" height="50">                                                            </td>
														</tr>
														<tr>
															<td>
																<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody><tr>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="1" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81"><?php
   
   $q = $this->db->query("SELECT kiri, kanan FROM upline WHERE username='$mid'");
   $row = $q->row_array();
   		$idki = $row['kiri'];
		$naki = $this->data_model->dataku("nama", $idki);
		$kotaki = $this->data_model->dataku("kota", $idki);
		 if(!$this->data_model->dataku("foto", $idki)) {
			$foto = base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki);
		}	
		
   if($idki) {
   		
   		$kiri = "<a href='".base_url()."index.php/network/genealogy/$idki' title='$naki $kotaki'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naki $kotaki' border='0' height='85' width='85' style='padding-top:2px'></td></tr></tbody></table></a><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki, "")." | ".$this->network_model->memberkanan($idki, "")."<br />".$this->network_model->hitung_omzet($idki, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki, "KANAN", "")." Unit</span><br><span style='font-size: 9px;'><strong>$idki</strong><br>$naki<br />".$this->data_model->mypaket($idki)."</span>";
   } else {
   		$kiri = "<form action='".base_url()."index.php/network/join' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$mid' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KIRI' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'>
		</td></tr></tbody></table>
		</form>";
		
   }
   echo $kiri;
   $kosong = "";
   ?></td>
																				</tr>
																			</tbody></table>																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="1" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81"><?php
   
   	$idka = $row['kanan'];
  
		$naka = $this->data_model->dataku("nama", $idka);
		$kotaka = $this->data_model->dataku("kota", $idka);
		 if(!$this->data_model->dataku("foto", $idka)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idka);
		}	
		
   if($idka) {
   		
   		$kanan = "<a href='".base_url()."index.php/network/genealogy/$idka' title='$naka $kotaka'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naki $kotaka' border='0' height='85' width='85'></td></tr></tbody></table></a><span style='font-size: 9px;'>".$this->network_model->memberkiri($idka, "")." | ".$this->network_model->memberkanan($idka, "")."<br />".$this->network_model->hitung_omzet($idka, "KIRI", "")." | ".$this->network_model->hitung_omzet($idka, "KANAN", "")." Unit</span><br><span style='font-size: 9px;'>$idka<br>$naka<br />".$this->data_model->mypaket($idka)."</span>";
   } else {
   		//$kanan = "<span style='font-size: 9px;'><a href='?m=join&sp=$awal&up=$mid&pos=KANAN'><strong>REG</strong></a></span>";
		
		$kanan = "<form action='".base_url()."index.php/network/join' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$mid' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KANAN' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
		
   }
   echo $kanan;
   ?></td>
																				</tr>
																			</tbody></table>																	  </td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">&nbsp;</td>
																				</tr>
																			</tbody></table>																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">&nbsp;</td>
																				</tr>
																			</tbody></table>																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">&nbsp;</td>
																				</tr>
																			</tbody></table>																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">&nbsp;</td>
																				</tr>
																			</tbody></table>																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">&nbsp;</td>
																				</tr>
																			</tbody></table>																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">&nbsp;</td>
																				</tr>
																			</tbody></table>																		</td>
																	</tr>
																</tbody></table>															</td>
														</tr>
													</tbody></table>
												</div>
												
												</td>
											</tr>
										</tbody></table>