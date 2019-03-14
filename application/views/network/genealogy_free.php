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
																			</tbody></table>
																		</td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
	
 <?php
 if(!$this->data_model->dataku("foto", $mid)) {
 	$foto =  base_url()."asset/foto_profil/noimage.jpg";
} else {
	$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $mid);
}	
 ?>   
    																				<td align="center" bgcolor="#ffffff" height="125" width="81"><a href="#" title="<?= $this->data_model->dataku("nama", $mid); ?> <?= $this->data_model->dataku("kota", $mid); ?>"><table class="tbl03" cellpadding="0" cellspacing="0"><tbody><tr><td align="center" height="80" width="80"><img src="<?= $foto; ?>" title="<?= $this->data_model->dataku("nama", $mid); ?> <?= $this->data_model->dataku("kota", $mid); ?>" border="0" height="80" width="80"></td></tr></tbody></table></a><span style="font-size: 9px;"><?= $this->network_model->memberkiri($mid, ""); ?> | <?= $this->network_model->memberkanan($mid, ""); ?></span><br/>
<span style="font-size: 9px;"><?= $this->network_model->hitung_omzet($mid, "KIRI", ""); ?> | <?= $this->network_model->hitung_omzet($mid, "KANAN", ""); ?> BV</span><br><span style="font-size: 9px;"><a href="#"><strong><?= $mid; ?></strong></a><br><?= $this->data_model->dataku("nama", $mid); ?><br /><?= $this->data_model->mypaket($mid); ?></span></td>
																				</tr>
																			</tbody></table>
																		</td>
																		<td align="center" width="301">
																			<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
																				<tbody><tr>
																					<td align="center" width="10"></td>
																					<td align="left">&nbsp;</td>
																				</tr>
																			</tbody></table>
																		</td>
																	</tr>
																</tbody></table>
															</td>
														</tr>
														<tr>
														  <td align="center" background="<?php echo base_url(); ?>asset/network/tree01.gif" height="50"></td>
														</tr>
														<tr>
															<td>
																<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody><tr>
																		<td align="center" width="129"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
                                                                                    
   <?php
   
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
   		
   		$kiri = "<a href='".base_url()."index.php/network/genealogy_free/$idki' title='$naki $kotaki'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naki $kotaki' border='0' height='85' width='85' style='padding-top:2px'></td></tr></tbody></table></a><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki, "")." | ".$this->network_model->memberkanan($idki, "")."<br />".$this->network_model->hitung_omzet($idki, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki</strong><br>$naki<br />".$this->data_model->mypaket($idki)."</span>";
   } else {
   		$kiri = "<form action='".base_url()."index.php/network/join_free' method='post' >
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
   ?>                                                                             </td>
																				</tr>
																			</tbody></table>
																		</td>
																		<td align="center" width="263"></td>
																	  <td align="center" width="81">
                                                                        <table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
	<?php
   
   	$idka = $row['kanan'];
  
		$naka = $this->data_model->dataku("nama", $idka);
		$kotaka = $this->data_model->dataku("kota", $idka);
		 if(!$this->data_model->dataku("foto", $idka)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idka);
		}	
		
   if($idka) {
   		
   		$kanan = "<a href='".base_url()."index.php/network/genealogy_free/$idka' title='$naka $kotaka'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naki $kotaka' border='0' height='85' width='85'></td></tr></tbody></table></a><span style='font-size: 9px;'>".$this->network_model->memberkiri($idka, "")." | ".$this->network_model->memberkanan($idka, "")."<br />".$this->network_model->hitung_omzet($idka, "KIRI", "")." | ".$this->network_model->hitung_omzet($idka, "KANAN", "")." BV</span><br><span style='font-size: 9px;'>$idka<br>$naka<br />".$this->data_model->mypaket($idka)."</span>";
   } else {
   		//$kanan = "<span style='font-size: 9px;'><a href='?m=join&sp=$awal&up=$mid&pos=KANAN'><strong>REG</strong></a></span>";
		
		$kanan = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$mid' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KANAN' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
		
   }
   echo $kanan;
   ?>  
																		</td></tr></tbody></table></td>
																		<td align="center" width="129"></td>
																	</tr>
																</tbody></table>
															</td>
														</tr>
														<tr>
														  <td align="center" background="<?php echo base_url(); ?>asset/network/tree02.gif" height="50"></td>
														</tr>
														<tr>
															<td>
																<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody><tr>
																		<td align="center" width="43"></td>
																		<td align="center" width="81">
                                                                        <table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
					
   <?php
   //----level 2 kiri---
   if(!$idki) {
   	echo $kosong;
	$idki2 = '';
	} else {
		
		$q = $this->db->query("SELECT kiri, kanan FROM upline WHERE username='$idki'");
   		$row2 = $q->row_array();
		$idki2 = $row2['kiri'];
			$naki2 = $this->data_model->dataku("nama", $idki2);
			$kotaki2 = $this->data_model->dataku("kota", $idki2);
			 if(!$this->data_model->dataku("foto", $idki2)) {
				$foto =  base_url()."asset/foto_profil/noimage.jpg";
			} else {
				$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki2);
			}	
	   if($idki2) {
			
			$kiri2 = "<a href='".base_url()."index.php/network/genealogy_free/$idki2' title='$naki2 $kotaki2'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naki2 $kotaki2' border='0' height='85' width='85'></td></tr></tbody></table></a><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki2, "")." | ".$this->network_model->memberkanan($idki2, "")."<br />".$this->network_model->hitung_omzet($idki2, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki2, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki2</strong><br>$naki2<br />".$this->data_model->mypaket($idki2)."</span>";
	   } else {
			//$kiri2 = "<span style='font-size: 9px;'><a href='?m=join&sp=$awal&up=$idki&pos=KIRI'><strong>REG</strong></a></span>";
			
			$kiri2 = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idki' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KIRI' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri2;	
   }
   ?>                 
                    
                    														
																			</td>
																				</tr>
																			</tbody></table>
                                                                        </td>
																		<td align="center" width="91"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
        <?php
   //----level 2b kiri---
   if(!$idki) {
   	echo $kosong;
	$idki2b = '';
	} else {
		
		$idki2b = $row2['kanan'];
			$naki2b = $this->data_model->dataku("nama", $idki2b);
			$kotaki2b = $this->data_model->dataku("kota", $idki2b);
		 if(!$this->data_model->dataku("foto", $idki2b)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki2b);
		}	

	   if($idki2b) {
			
			$kiri2b = "<a href='".base_url()."index.php/network/genealogy_free/$idki2b' title='$naki2b $kotaki2b'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naki2b $kotaki2b' border='0' height='85' width='85'></td></tr></tbody></table></a><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki2b, "")." | ".$this->network_model->memberkanan($idki2b, "")."<br />".$this->network_model->hitung_omzet($idki2b, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki2b, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki2b</strong><br>$naki2b<br />".$this->data_model->mypaket($idki2b)."</span>";
	   } else {
			//$kiri2b = "<span style='font-size: 9px;'><a href='?m=join&sp=$awal&up=$idki&pos=KANAN'><strong>REG</strong></a></span>";
			
			$kiri2b = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idki' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KANAN' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri2b;	
   }
   ?>                                                                                
                                                                                    
                                                                                    </td>
																				</tr>
																			</tbody></table>
																		</td>
																		<td align="center" width="91"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
       <?php
   //----level 2 kanan---
   if(!$idka) {
   	echo $kosong;
		$idka2 = "";
	} else {
		
		$q = $this->db->query("SELECT kiri, kanan FROM upline WHERE username='$idka'");
   		$rowa2 = $q->row_array();
		$idka2 = $rowa2['kiri'];
			$naka2 = $this->data_model->dataku("nama", $idka2);
			$kotaka2 = $this->data_model->dataku("kota", $idka2);
		 if(!$this->data_model->dataku("foto", $idka2)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idka2);
		}	

	   if($idka2) {
			
			$kanan2 = "<a href='".base_url()."index.php/network/genealogy_free/$idka2' title='$naka2 $kotaka2'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka2 $kotaka2' border='0' height='85' width='85'></td></tr></tbody></table></a><span style='font-size: 9px;'>".$this->network_model->memberkiri($idka2, "")." | ".$this->network_model->memberkanan($idka2, "")."<br />".$this->network_model->hitung_omzet($idka2, "KIRI", "")." | ".$this->network_model->hitung_omzet($idka2, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idka2</strong><br>$naka2<br />".$this->data_model->mypaket($idka2)."</span>";
	   } else {
			//$kanan2 = "<span style='font-size: 9px;'><a href='?m=join&sp=$awal&up=$idka&pos=KIRI'><strong>REG</strong></a></span>";
			
			$kanan2 = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idka' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KIRI' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kanan2;	
   }
   ?>                                                                                       
                                                                                    
                                                                                    </td>
																				</tr>
																			</tbody></table>	
																		</td>
																		<td align="center" width="91"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
                                                                                    
    <?php
   //----level 2b kanan---
   if(!$idka) {
   	echo $kosong;
		$idka2b = "";
	} else {
		
		$idka2b = $rowa2['kanan'];
			$naka2b = $this->data_model->dataku("nama", $idka2b);
			$kotaka2b = $this->data_model->dataku("kota", $idka2b);
		 if(!$this->data_model->dataku("foto", $idka2b)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idka2b);
		}	

	   if($idka2b) {
			
			$kanan2b = "<a href='".base_url()."index.php/network/genealogy_free/$idka2b' title='$naka2b $kotaka2b'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka2b $kotaka2b' border='0' height='85' width='85'></td></tr></tbody></table></a><span style='font-size: 9px;'>".$this->network_model->memberkiri($idka2b, "")." | ".$this->network_model->memberkanan($idka2b, "")."<br />".$this->network_model->hitung_omzet($idka2b, "KIRI", "")." | ".$this->network_model->hitung_omzet($idka2b, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idka2b</strong><br>$naka2b<br />".$this->data_model->mypaket($idka2b)."</span>";
	   } else {
			//$kanan2b = "<span style='font-size: 9px;'><a href='?m=join&sp=$awal&up=$idka&pos=KANAN'><strong>REG</strong></a></span>";
			
			
			$kanan2b = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idka' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KANAN' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kanan2b;	
   }
   ?>                                                                                  
                                                                                    
                                                                                    </td>
																				</tr>
																			</tbody></table>
																		</td>
																		<td align="center" width="43"></td>
																	</tr>
																</tbody></table>
															</td>
														</tr>
														<tr>
														  <td align="center" background="<?php echo base_url(); ?>asset/network/tree03.gif" height="50">
                                                                                                 
                                                            </td>
														</tr>
														<tr>
															<td>
																<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
																	<tbody><tr>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
                                                                                    
   <?php
   //----level 3 A kiri---
   if(!$idki2) {
   	echo $kosong;
	} else {
		
		$q = $this->db->query("SELECT kiri, kanan FROM upline WHERE username='$idki2'");
   		$row3 = $q->row_array();
		$idki3 = $row3['kiri'];
			$naka3 = $this->data_model->dataku("nama", $idki3);
			$kotaka3 = $this->data_model->dataku("kota", $idki3);
		 if(!$this->data_model->dataku("foto", $idki3)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki3);
		}	

	   if($idki3) {
			
			$kiri3 = "<a href='".base_url()."index.php/network/genealogy_free/$idki3' title='$naka3 $kotaka3'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka3 $kotaka3' border='0' height='85' width='85'></td></tr></tbody></table></a><br><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki3, "")." | ".$this->network_model->memberkanan($idki3, "")."<br />".$this->network_model->hitung_omzet($idki3, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki3, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki3</strong><br>$naka3<br />".$this->data_model->mypaket($idki3)."</span>";
	   } else {
			
			$kiri3 = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idki2' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KIRI' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri3;	
   }
   ?>                                                                           
                                                                                    </td>
																				</tr>
																			</tbody></table>
																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81"><?php
   //----level 3 B kiri---
   if(!$idki2) {
   	echo $kosong;
	} else {
		
		$idki3b = $row3['kanan'];
			$naka3b = $this->data_model->dataku("nama", $idki3b);
			$kotaka3b = $this->data_model->dataku("kota", $idki3b);
		 if(!$this->data_model->dataku("foto", $idki3b)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki3b);
		}	

	   if($idki3b) {
			
			$kiri3b = "<a href='".base_url()."index.php/network/genealogy_free/$idki3b' title='$naka3b $kotaka3b'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka2 $kotaka2' border='0' height='85' width='85'></td></tr></tbody></table></a><br><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki3b, "")." | ".$this->network_model->memberkanan($idki3b, "")."<br />".$this->network_model->hitung_omzet($idki3b, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki3b, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki3b</strong><br>$naka3b<br />".$this->data_model->mypaket($idki3b)."</span>";
	   } else {
			//$kiri3b = "<span style='font-size: 9px;'><a href='?m=join&sp=$awal&up=$idki2&pos=KANAN'><strong>REG</strong></a></span>";
			
			$kiri3b = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idki2' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KANAN' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri3b;	
   }
   ?></td>
																				</tr>
																			</tbody></table>
																	  </td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
                                                                                    
   <?php
   //----level 3 C kiri---
   if(!$idki2b) {
   	echo $kosong;
	} else {
		
		$q = $this->db->query("SELECT kiri, kanan FROM upline WHERE username='$idki2b'");
   		$row3a = $q->row_array();
		$idki3c = $row3a['kiri'];
			$naka3c = $this->data_model->dataku("nama", $idki3c);
			$kotaka3c = $this->data_model->dataku("kota", $idki3c);
		 if(!$this->data_model->dataku("foto", $idki3c)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki3c);
		}	

	   if($idki3c) {
			
			$kiri3c = "<a href='".base_url()."index.php/network/genealogy_free/$idki3c' title='$naka3c $kotaka3c'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka3c $kotaka3c' border='0' height='85' width='85'></td></tr></tbody></table></a><br><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki3c, "")." | ".$this->network_model->memberkanan($idki3c, "")."<br />".$this->network_model->hitung_omzet($idki3c, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki3c, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki3c</strong><br>$naka3c<br/>".$this->data_model->mypaket($idki3c)."</span>";
	   } else {
			
			
			$kiri3c = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idki2b' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KIRI' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri3c;	
   }
   ?>                                                                                  
                                                                                    
                                                                                    </td>
																				</tr>
																			</tbody></table>	
																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
                                                                                    
                                                                                    
                               <?php
   //----level 3 D kiri---
   if(!$idki2b) {
   	echo $kosong;
	} else {
		
		$idki3d = $row3a['kanan'];
			$naka3d = $this->data_model->dataku("nama", $idki3d);
			$kotaka3d = $this->data_model->dataku("kota", $idki3d);
		 if(!$this->data_model->dataku("foto", $idki3d)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki3d);
		}	

	   if($idki3d) {
			
			$kiri3d = "<a href='".base_url()."index.php/network/genealogy_free/$idki3d' title='$naka3d $kotaka3d'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka3d $kotaka3d' border='0' height='85' width='85'></td></tr></tbody></table></a><br><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki3d, "")." | ".$this->network_model->memberkanan($idki3d, "")."<br />".$this->network_model->hitung_omzet($idki3d, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki3d, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki3d</strong><br>$naka3d<br />".$this->data_model->mypaket($idki3d)."</span>";
	   } else {
			
			$kiri3d = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idki2b' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KANAN' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri3d;	
   }
   //---end lev 3d
   ?>                                                                                  
                                                                                             
                                                                                    </td>
																				</tr>
																			</tbody></table>
																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
    <?php
   //----level 3 E kiri---
   if(!$idka2) {
   	echo $kosong;
	} else {
		$q = $this->db->query("SELECT kiri, kanan FROM upline WHERE username='$idka2'");
   		$row3b = $q->row_array();
		$idki3e = $row3b['kiri'];
			$naka3e = $this->data_model->dataku("nama", $idki3e);
			$kotaka3e = $this->data_model->dataku("kota", $idki3e);
		 if(!$this->data_model->dataku("foto", $idki3e)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki3e);
		}	

	   if($idki3e) {
			
			$kiri3e = "<a href='".base_url()."index.php/network/genealogy_free/$idki3e' title='$naka3e $kotaka3e'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka3e $kotaka3e' border='0' height='85' width='85'></td></tr></tbody></table></a><br><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki3e, "")." | ".$this->network_model->memberkanan($idki3e, "")."<br />".$this->network_model->hitung_omzet($idki3e, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki3e, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki3e</strong><br>$naka3e<br />".$this->data_model->mypaket($idki3e)."</span>";
	   } else {
			
			$kiri3e = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idka2' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KIRI' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri3e;	
   }
   ?>                                                                                  
                                                                                                  
                                                                                    </td>
																				</tr>
																			</tbody></table>
																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
   <?php
   //----level 3 F kiri---
   if(!$idka2) {
   	echo $kosong;
	} else {
		
		$idki3f = $row3b['kanan'];
			$naka3f = $this->data_model->dataku("nama", $idki3f);
			$kotaka3f = $this->data_model->dataku("kota", $idki3f);
		 if(!$this->data_model->dataku("foto", $idki3f)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki3f);
		}	

	   if($idki3f) {
			
			$kiri3f = "<a href='".base_url()."index.php/network/genealogy_free/$idki3f' title='$naka3f $kotaka3f'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka3f $kotaka3f' border='0' height='85' width='85'></td></tr></tbody></table></a><br><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki3f, "")." | ".$this->network_model->memberkanan($idki3f, "")."<br />".$this->network_model->hitung_omzet($idki3f, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki3f, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki3f</strong><br>$naka3f<br />".$this->data_model->mypaket($idki3f)."</span>";
	   } else {
			
			
			$kiri3f = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idka2' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KANAN' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri3f;	
   }
   ?>                                                                                                    
                                                                                    
                                                                                    </td>
																				</tr>
																			</tbody></table>
																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
                                                                                    
   <?php
   //----level 3 G kiri---
   if(!$idka2b) {
   	echo $kosong;
		
	} else {
		
		$q = $this->db->query("SELECT kiri, kanan FROM upline WHERE username='$idka2b'");
   		$row3c = $q->row_array();
		$idki3g = $row3c['kiri'];
			$naka3g = $this->data_model->dataku("nama", $idki3g);
			$kotaka3g = $this->data_model->dataku("kota", $idki3g);
		 if(!$this->data_model->dataku("foto", $idki3g)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki3g);
		}	

	   if($idki3g) {
			
			$kiri3g = "<a href='".base_url()."index.php/network/genealogy_free/$idki3g' title='$naka3g $kotaka3g'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka3g $kotaka3g' border='0' height='85' width='85'></td></tr></tbody></table></a><br><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki3g, "")." | ".$this->network_model->memberkanan($idki3g, "")."<br />".$this->network_model->hitung_omzet($idki3g, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki3g, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki3g</strong><br>$naka3g<br />".$this->data_model->mypaket($idki3g)."</span>";
	   } else {
			$kiri3g = "<span style='font-size: 9px;'><a href='?m=join&sp=$awal&up=$idka2b&pos=KIRI'><strong>REG</strong></a></span>";
			
			$kiri3g = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idka2b' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KIRI' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri3g;	
   }
   ?>                                                                                                  
                                                                                    </td>
																				</tr>
																			</tbody></table>	
																		</td>
																		<td align="center" width="5"></td>
																		<td align="center" width="81">
																			<table class="tbl03" style="border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0" height="116" width="100%">
																				<tbody><tr>
																					<td align="center" bgcolor="#ffffff" height="125" width="81">
   <?php
   //----level 3 H kiri---
   if(!$idka2b) {
   	echo $kosong;
	} else {
		
		$idki3h = $row3c['kanan'];
			$naka3h = $this->data_model->dataku("nama", $idki3h);
			$kotaka3h = $this->data_model->dataku("kota", $idki3h);
		 if(!$this->data_model->dataku("foto", $idki3h)) {
			$foto =  base_url()."asset/foto_profil/noimage.jpg";
		} else {
			$foto =	base_url()."asset/foto_profil/".$this->data_model->dataku("foto", $idki3h);
		}	

	   if($idki3h) {
			
			$kiri3h = "<a href='".base_url()."index.php/network/genealogy_free/$idki3h' title='$naka3h $kotaka3h'><table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85'><img src='$foto' title='$naka3h $kotaka3h' border='0' height='85' width='85'></td></tr></tbody></table></a><br><span style='font-size: 9px;'>".$this->network_model->memberkiri($idki3h, "")." | ".$this->network_model->memberkanan($idki3h, "")."<br />".$this->network_model->hitung_omzet($idki3h, "KIRI", "")." | ".$this->network_model->hitung_omzet($idki3h, "KANAN", "")." BV</span><br><span style='font-size: 9px;'><strong>$idki3h</strong><br>$naka3h<br />".$this->data_model->mypaket($idki3h)."</span>";
	   } else {
		
			$kiri3h = "<form action='".base_url()."index.php/network/join_free' method='post' >
		<table class='tbl03' cellpadding='0' cellspacing='0'><tbody><tr><td align='center' height='85' width='85' valign='top'>
		<input name='sp' value='$awal' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='up' value='$idka2b' class='form-controle' type='hidden' style='width:150px;' required />
		<input name='pos' value='KANAN' class='form-controle' type='hidden' style='width:150px;' required />
		<input class='btn btn-primary' name='Submit' value='REG' type='submit'></td></tr></tbody></table>
		</form>";
			
	   }
	   echo $kiri3h;	
   }
   ?>                                                                                           
                                                                                    </td>
																				</tr>
																			</tbody></table>
																		</td>
																	</tr>
																</tbody></table>
															</td>
														</tr>
													</tbody></table>
												</div>
												
												</td>
											</tr>
										</tbody></table>