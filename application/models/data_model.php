<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {
	
	public function dataku($field, $username) {
		$hasil = "";
		$q = $this->db->query("SELECT $field FROM member WHERE username='$username'");
		if($q->num_rows>0){
			$result = $q->row();
			$result_array =  array_values((array)$result);
			$hasil = $result_array[0];
		} else {
			$hasil = "";
		}
		return $hasil;
	}
	
	public function dataupline($field, $username) {
		$hasil = "";
		$q = $this->db->query("SELECT $field FROM upline WHERE username='$username'");
		if($q->num_rows>0)
		{
			$result = $q->row();
			$result_array =  array_values((array)$result);
			$hasil = $result_array[0];
		} else {
			$hasil = '';
		}
		return $hasil;
	}
	
	public function randomPassword($length) 
	{
        $ret = "";
        $allow = "ABCDEFGHJKLMNPQRSTUVWXYZ0123456789";
        $i = 1;
        while ($i <= $length) {
        $max = strlen($allow)-1;
        $num = rand(0, $max);
        $temp = substr($allow, $num, 1);
        $ret = $ret . $temp;
        $i++;
        
        }
        return $ret;
	}
	
	public function getpaket($field,$code) {
		$kat = "";
		$q = $this->db->query("SELECT $field FROM paket WHERE code='$code'");
		$result = $q->row();
		$result_array =  array_values((array)$result);
		$kat = $result_array[0];
		return $kat;

	}
	
	public function getcard_detail($field,$code) {
		$kat = "";
		//echo "SELECT $field FROM card WHERE serial='$code'"; exit;
		$q = $this->db->query("SELECT $field FROM card WHERE serial='$code'");
		$result = $q->row();
		$result_array =  array_values((array)$result);
		$kat = $result_array[0];
		return $kat;

	}
	
	public function getusername($code) {
		$kat = "";
		$q = $this->db->query("SELECT idmlm FROM card WHERE pin='$code'");
		$result = $q->row();
		$result_array =  array_values((array)$result);
		$kat = $result_array[0];
		return $kat;

	}
	
	public function mypaket($username) {
		$mypaket = "";
		//ambil library nama paket
		$q = $this->db->query("SELECT paket FROM configuration WHERE id=1");
		$result = $q->row();
		$result_array =  array_values((array)$result);
		$paket = $result_array[0];
		$pkt = explode("|", $paket);
		
		//cek paket member
		$qe = $this->db->query("SELECT harga FROM member WHERE username='$username'");
		$resulte = $qe->row();
		$result_arraye =  array_values((array)$resulte);
		$harga = $result_arraye[0];
		
		if($harga == 1)
		{
			$mypaket = $pkt[0];
		} else if($harga == 2)
		{
			$mypaket = $pkt[1];
		} else if($harga == 3)
		{
			$mypaket = $pkt[2];
		} else if($harga == 4)
		{
			$mypaket = $pkt[3];
		
		} else {
			$mypaket = "Invalid";
		}
		return $mypaket;

	}
	
	function formatgl($tgaktif) {
		$tg = "";
		$hari=array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		$bulane = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		$expire = date("w, d m Y",strtotime($tgaktif)); 
		$day = substr($expire, 0, 1);
		$tgle = substr($expire, 3,2);
		$blne = substr($expire, 6,2);
		$thne = substr($expire, 9,4);
		if($blne < 10 ) {
			$blne0 = substr($blne, 1,1) - 1;
		} else {
			$blne0 = $blne - 1;
		}
		$tg =  "$tgle $bulane[$blne0] $thne";
		return $tg;
	}
	
	function config($field){
		$sql=mysql_query("select $field from configuration where id=1");
		$row=mysql_fetch_row($sql);
		$kat = $row[0];
		return $kat;
	}
	
	function nama_paket($kode) {
		$s=0;
		$sql=mysql_query("select paket FROM paket WHERE code='$kode'");
		$row=mysql_fetch_row($sql);
		
		$s = $row[0];					
		return $s;
	}
	
	function data_paket($field,$kode) {
		$s=0;
		$sql=mysql_query("select $field FROM paket WHERE code='$kode'");
		$row=mysql_fetch_row($sql);
		
		$s = $row[0];					
		return $s;
	}
	
	function tot_bayar_roi($username,$id_paket) {
		$s=0;
		$sql=mysql_query("select bayar FROM komisi WHERE status='$id_paket' AND username='$username'");
		$ada = mysql_num_rows($sql);
		if($ada > 0){
		    while($row=mysql_fetch_row($sql))
		    {
		        $s = $s + $row[0];
		    }
		} else {
		    $s = $row[0];
		}
		return $s;
	}
	
	
	function count_records($table, $dtgl) {
		$hasil = 0;
		$q = $this->db->query("SELECT * FROM $table $dtgl");
		$result = $q->num_rows();
		
		$hasil = $result;		
		return $hasil;
	}
	
	//--------jumlah downline 
	function jumlahdl($username, $status) {
		$td = 0;
		$lev = mysql_query("select level from upline order by level desc");
		$lv = mysql_fetch_row($lev);
			if($lv[0] > 40){
				$jmlev = 40;
			} else {
				$jmlev = $lv[0];
			}
		for($i=0;$i<$jmlev;$i++) {
			$sql=mysql_query("SELECT a.username, b.status FROM upline as a INNER JOIN member as b on a.username=b.username WHERE a.upline$i='$username' AND b.status='$status'");
			$ada = mysql_num_rows($sql);
			$td = $td + $ada;
		}
		$jdl = $td;
		return $jdl;
	}
	
	
	
	function match($username) {
		$mt=0;	
		//	if($dtgl == "") {
		$kia=$this->network_model->hitung_omzet($username, "KIRI", ""); 
		$kaa=$this->network_model->hitung_omzet($username, "KANAN", ""); 
		
		//echo "Username: $username: KIA: $kia, KAA: $kaa<br />";
		
		if($kia > $kaa) {
			$match = $kaa;
			$ki_unmatch = $kia - $kaa;
			$ka_unmatch = $kaa - $kia;
		} else {
			$match = $kia;
			$ki_unmatch = $kaa - $kia;
			$ka_unmatch = $kia - $kaa;
		}
		$mt= $match;
		return $mt;
			
	}
	
	
	function aktivasi($username) {
		$clientdate = date("Y-m-d h:i:s"); //--tgl skr
		$tgl_skr = $this->data_model->dataku("tgl", $username);
		$dtfrom = "$tgl_skr 00:00:00";
		$dtto = "$tgl_skr 23:59:59";
		$by = explode("|",$this->data_model->config("biaya"));
		$sales = explode("|",$this->data_model->config("roi"));
		$biaya = $by[0];
		$kom_sales = $sales[0];
		
		//---update status mbr----
		$mem['status']=1;
		$mem['tglaktif']=$clientdate;
		$id['username']=$username;
		$this->db->update("member",$mem,$id);	
		$this->db->update("upline",$mem,$id);
        
        $sponsore = $this->data_model->dataku("sponsor", $username);
		
		//Bonus Sponsor
		$k_sp = explode("|", $this->data_model->config("komisi_sponsor"));
		$ada_kom_sp = $this->data_model->count_records("komisi", "WHERE dari='$username' AND jenis='komsponsor'");
		if($ada_kom_sp >= 0) {
			
			$pkt_sponsor = $this->data_model->dataku("harga",$sponsore);
			$pkt_member = $this->data_model->dataku("harga",$username);
			$nama_paket = $this->data_model->nama_paket($pkt_member);
			if($pkt_member == 1){
			    $kom_spon = $k_sp[0]/100*$biaya;
			    
			} else if($pkt_member == 2){
			    $kom_spon = $k_sp[1]/100*$biaya;
			   
			} else if($pkt_member == 3){
			    $kom_spon = $k_sp[2]/100*$biaya;
			    
			} else if($pkt_member == 4){
			    $kom_spon = $k_sp[3]/100*$biaya;
			   
			}
			
			 $mykom_sales = $kom_sales; 
			//bonus sponsor ke 2 dst
			$kome['username'] = $username;
			$kome['bayar'] = $mykom_sales;
			$kome['tglbayar'] = $clientdate;
			$kome['status'] = 0;
			$kome['total'] = "";
			$kome['jenis'] = 'komsales';
			$kome['dari'] = $username;
	        
	        $this->db->insert("komisi",$kome);
			
			if($sponsore) {
		
			
			        $mykom_sp = $kom_spon; 
    				//bonus sponsor ke 2 dst
    				$kom['username'] = $sponsore;
    				$kom['bayar'] = $kom_spon;
    				$kom['tglbayar'] = $clientdate;
    				$kom['status'] = 0;
    				$kom['total'] = "";
    				$kom['jenis'] = 'komsponsor';
    				$kom['dari'] = $username;
			        
			        $this->db->insert("komisi",$kom);
			
				
				
			} // 
			
		
			//Bonus Matching
		    $k_match = explode("|", $this->data_model->config("komlev"));
			
		
					
			//bonus matching
			$spon_upli = $this->data_model->dataku("sponsor", $sponsore);
			$spon_upli2 = $this->data_model->dataku("sponsor", $spon_upli);
			$spon_upli3 = $this->data_model->dataku("sponsor", $spon_upli2);
			$spon_upli4 = $this->data_model->dataku("sponsor", $spon_upli3);
			$spon_upli5 = $this->data_model->dataku("sponsor", $spon_upli4);
			$spon_upli6 = $this->data_model->dataku("sponsor", $spon_upli5);
			if($sponsore) {

		
			$mykom_sp = ($k_match[0]/100)*$biaya; 
			//generasi 1
			$kom['username'] = $spon_upli;
			$kom['bayar'] = $mykom_sp;
			$kom['tglbayar'] = $clientdate;
			$kom['status'] = 'new';
			$kom['total'] = "$k_match[0]% x $biaya";
			$kom['jenis'] = 'komlev1';
			$kom['dari'] = $username;
    			if($spon_upli){
    				$this->db->insert("komisi",$kom);
    			}
    			//generasi 2
    			$mykom_sp2 = ($k_match[1]/100)*$biaya; 
    			$kom['username'] = $spon_upli2;
    			$kom['bayar'] = $mykom_sp2;
    			$kom['tglbayar'] = $clientdate;
    			$kom['status'] = 'new';
    			$kom['total'] = "$k_match[1]% x $biaya";
    			$kom['jenis'] = 'komlev2';
    			$kom['dari'] = $username;
    			if($spon_upli2){
    				$this->db->insert("komisi",$kom);
    			}
    			
    			//generasi 3
    			$mykom_sp3 = ($k_match[2]/100)*$biaya; 
    			$kom['username'] = $spon_upli3;
    			$kom['bayar'] = $mykom_sp3;
    			$kom['tglbayar'] = $clientdate;
    			$kom['status'] = 'new';
    			$kom['total'] = "$k_match[2]% x $biaya";
    			$kom['jenis'] = 'komlev3';
    			$kom['dari'] = $username;
    			if($spon_upli3){
    				$this->db->insert("komisi",$kom);
    			}
    			
    			//generasi 4
    			$mykom_sp4 = ($k_match[3]/100)*$biaya; 
    			$kom['username'] = $spon_upli4;
    			$kom['bayar'] = $mykom_sp4;
    			$kom['tglbayar'] = $clientdate;
    			$kom['status'] = 'new';
    			$kom['total'] = "$k_match[3]% x $biaya";
    			$kom['jenis'] = 'komlev4';
    			$kom['dari'] = $username;
    			if($spon_upli4){
    				$this->db->insert("komisi",$kom);
    			}
    			
    			//generasi 5
    			$mykom_sp5 = ($k_match[4]/100)*$biaya; 
    			$kom['username'] = $spon_upli5;
    			$kom['bayar'] = $mykom_sp5;
    			$kom['tglbayar'] = $clientdate;
    			$kom['status'] = 'new';
    			$kom['total'] = "$k_match[4]% x $biaya";
    			$kom['jenis'] = 'komlev5';
    			$kom['dari'] = $username;
    			if($spon_upli5){
    				$this->db->insert("komisi",$kom);
    			}
        			
			
			}	
			
			//end of bonus pasangan
			
			
		}	
	}
	
	function calculate_bonus_upgrade($username, $kode_paket) {
		$clientdate = date("Y-m-d h:i:s"); //--tgl skr
		$tgl_skr = $this->data_model->dataku("tgl", $username);
		$dtfrom = "$tgl_skr 00:00:00";
		$dtto = "$tgl_skr 23:59:59";
		$nilai_bv = $this->data_model->config("nilai_bv");
		$by = explode("|",$this->data_model->config("biaya"));
		$biaya = $by[0];
		
		//---update status mbr----
		$mem['status']=1;
		$mem['tglaktif']=$clientdate;
		$id['username']=$username;
		$this->db->update("member",$mem,$id);	
		$this->db->update("upline",$mem,$id);
        
        $sponsore = $this->data_model->dataku("sponsor", $username);
		
		//Bonus Sponsor
		$k_sp = explode("|", $this->data_model->config("komisi_sponsor"));
		$ada_kom_sp = $this->data_model->count_records("komisi", "WHERE dari='$username' AND jenis='komsponsor'");
		if($ada_kom_sp >= 0) {
			
			$pkt_sponsor = $this->data_model->dataku("harga",$sponsore);
			$pkt_member = $this->data_model->dataku("harga",$username);
			$nama_paket = $this->data_model->nama_paket($pkt_member);
			if($pkt_member == 1){
			    $kom_spon = $k_sp[0]/100*$biaya;
			    
			} else if($pkt_member == 2){
			    $kom_spon = $k_sp[1]/100*$biaya;
			   
			} else if($pkt_member == 3){
			    $kom_spon = $k_sp[2]/100*$biaya;
			    
			} else if($pkt_member == 4){
			    $kom_spon = $k_sp[3]/100*$biaya;
			   
			}
			
			if($sponsore) {
		
			
			        $mykom_sp = $kom_spon; 
    				//bonus sponsor ke 2 dst
    				$kom['username'] = $sponsore;
    				$kom['bayar'] = $kom_spon;
    				$kom['tglbayar'] = $clientdate;
    				$kom['status'] = 0;
    				$kom['total'] = "";
    				$kom['jenis'] = 'komsponsor';
    				$kom['dari'] = $username;
			        
			        $this->db->insert("komisi",$kom);
			
				
				
			} // 
			
		
			//Bonus Matching
		    $k_match = explode("|", $this->data_model->config("komlev"));
			
		
					
			//bonus matching
			$spon_upli = $this->data_model->dataku("sponsor", $upli);
			$spon_upli2 = $this->data_model->dataku("sponsor", $spon_upli);
			$spon_upli3 = $this->data_model->dataku("sponsor", $spon_upli2);
			$spon_upli4 = $this->data_model->dataku("sponsor", $spon_upli3);
			$spon_upli5 = $this->data_model->dataku("sponsor", $spon_upli4);
			$spon_upli6 = $this->data_model->dataku("sponsor", $spon_upli5);
			if($sponsore) {

		
			$mykom_sp = ($k_match[0]/100)*$biaya; 
			//generasi 1
			$kom['username'] = $spon_upli;
			$kom['bayar'] = $mykom_sp;
			$kom['tglbayar'] = $clientdate;
			$kom['status'] = 'new';
			$kom['total'] = "$k_match[0]% x $biaya";
			$kom['jenis'] = 'komlev1';
			$kom['dari'] = $username;
			if($spon_upli){
				$this->db->insert("komisi",$kom);
			}
			//generasi 2
			$mykom_sp2 = ($k_match[1]/100)*$biaya; 
			$kom['username'] = $spon_upli2;
			$kom['bayar'] = $mykom_sp2;
			$kom['tglbayar'] = $clientdate;
			$kom['status'] = 'new';
			$kom['total'] = "$k_match[1]% x $biaya";
			$kom['jenis'] = 'komlev2';
			$kom['dari'] = $username;
			if($spon_upli2){
				$this->db->insert("komisi",$kom);
			}
			
			//generasi 3
			$mykom_sp3 = ($k_match[2]/100)*$biaya; 
			$kom['username'] = $spon_upli3;
			$kom['bayar'] = $mykom_sp3;
			$kom['tglbayar'] = $clientdate;
			$kom['status'] = 'new';
			$kom['total'] = "$k_match[2]% x $biaya";
			$kom['jenis'] = 'komlev3';
			$kom['dari'] = $username;
			if($spon_upli3){
				$this->db->insert("komisi",$kom);
			}
			
			//generasi 4
			$mykom_sp4 = ($k_match[3]/100)*$biaya; 
			$kom['username'] = $spon_upli4;
			$kom['bayar'] = $mykom_sp4;
			$kom['tglbayar'] = $clientdate;
			$kom['status'] = 'new';
			$kom['total'] = "$k_match[3]% x $biaya";
			$kom['jenis'] = 'komlev4';
			$kom['dari'] = $username;
			if($spon_upli4){
				$this->db->insert("komisi",$kom);
			}
			
			//generasi 5
			$mykom_sp5 = ($k_match[4]/100)*$biaya; 
			$kom['username'] = $spon_upli5;
			$kom['bayar'] = $mykom_sp5;
			$kom['tglbayar'] = $clientdate;
			$kom['status'] = 'new';
			$kom['total'] = "$k_match[4]% x $biaya";
			$kom['jenis'] = 'komlev5';
			$kom['dari'] = $username;
			if($spon_upli5){
				$this->db->insert("komisi",$kom);
			}
    			
				//---------update jml downline aktif------------
				$jdl = $this->data_model->jumlahdl($upli, "1");
				
				$mem_dl['dl']=$jdl;
				$id['username']=$username;
				$this->db->update("upline",$mem_dl,$id);
			}	
			
			//end of bonus pasangan
			
			
		}	
	}
	
	function calculate_pairing($username) {
		$clientdate = date("Y-m-d h:i:s"); //--tgl skr
		$tgl_skr = $this->data_model->dataku("tgl", $username);
		$dtfrom = "$tgl_skr 00:00:00";
		$dtto = "$tgl_skr 23:59:59";
		$nilai_bv = $this->data_model->config("nilai_bv");
		
		//---update status mbr----
		$mem['status']=1;
		$mem['tglaktif']=$clientdate;
		$id['username']=$username;
		$this->db->update("member",$mem,$id);	
		$this->db->update("upline",$mem,$id);

		
		//Bonus Sponsor
		$k_sp = explode("|", $this->data_model->config("komisi_sponsor"));
		$ada_kom_sp = $this->count_records("komisi", "WHERE dari='$username' AND jenis='komsponsor'");
		if($ada_kom_sp == 0) {
			
			$sponsore = $this->data_model->dataku("sponsor", $username);
			$sponsore2 = $this->data_model->dataku("sponsor", $sponsore);
			$sponsore3 = $this->data_model->dataku("sponsor", $sponsore2);
			$sponsore4 = $this->data_model->dataku("sponsor", $sponsore3);
			$sponsore5 = $this->data_model->dataku("sponsor", $sponsore4);
			$sponsore6 = $this->data_model->dataku("sponsor", $sponsore5);
			
			$pkt_sponsor = $this->data_model->dataku("harga",$sponsore);
			$pkt_member = $this->data_model->dataku("harga",$username);
			$nama_paket = $this->data_model->nama_paket($pkt_member);
			$member_bv = $this->data_model->dataku("bv",$username);
			if($sponsore) {
		
				
				$mykom_sp = ($k_sp[0]/100)*$member_bv; 
				//generasi 1
				$kom['username'] = $sponsore;
				$kom['bayar'] = $mykom_sp;
				$kom['tglbayar'] = $clientdate;
				$kom['status'] = 0;
				$kom['total'] = "$k_sp[0]% x $member_bv BV ($nama_paket)";
				$kom['jenis'] = 'komsponsor';
				$kom['dari'] = $username;
				if($sponsore){
					$this->db->insert("komisi",$kom);
				}
				//generasi 2
				$mykom_sp2 = ($k_sp[1]/100)*$member_bv; 
				$kom['username'] = $sponsore2;
				$kom['bayar'] = $mykom_sp2;
				$kom['tglbayar'] = $clientdate;
				$kom['status'] = 0;
				$kom['total'] = "$k_sp[1]% x $member_bv BV ($nama_paket)";
				$kom['jenis'] = 'komsponsor2';
				$kom['dari'] = $username;
				if($sponsore2){
					$this->db->insert("komisi",$kom);
				}
				
				//generasi 3
				$mykom_sp3 = ($k_sp[2]/100)*$member_bv; 
				$kom['username'] = $sponsore3;
				$kom['bayar'] = $mykom_sp3;
				$kom['tglbayar'] = $clientdate;
				$kom['status'] = 0;
				$kom['total'] = "$k_sp[2]% x $member_bv BV ($nama_paket)";
				$kom['jenis'] = 'komsponsor3';
				$kom['dari'] = $username;
				if($sponsore3){
					$this->db->insert("komisi",$kom);
				}
				
				//generasi 4
				$mykom_sp4 = ($k_sp[3]/100)*$member_bv; 
				$kom['username'] = $sponsore4;
				$kom['bayar'] = $mykom_sp4;
				$kom['tglbayar'] = $clientdate;
				$kom['status'] = 0;
				$kom['total'] = "$k_sp[3]% x $member_bv BV ($nama_paket)";
				$kom['jenis'] = 'komsponsor4';
				$kom['dari'] = $username;
				if($sponsore4){
					$this->db->insert("komisi",$kom);
				}
				
				//generasi 5
				$mykom_sp5 = ($k_sp[4]/100)*$member_bv; 
				$kom['username'] = $sponsore5;
				$kom['bayar'] = $mykom_sp5;
				$kom['tglbayar'] = $clientdate;
				$kom['status'] = 0;
				$kom['total'] = "$k_sp[4]% x $member_bv BV ($nama_paket)";
				$kom['jenis'] = 'komsponsor5';
				$kom['dari'] = $username;
				if($sponsore5){
					$this->db->insert("komisi",$kom);
				}
				
				//generasi 6
				$mykom_sp6 = ($k_sp[5]/100)*$member_bv; 
				$kom['username'] = $sponsore6;
				$kom['bayar'] = $mykom_sp6;
				$kom['tglbayar'] = $clientdate;
				$kom['status'] = 0;
				$kom['total'] = "$k_sp[5]% x $member_bv BV ($nama_paket)";
				$kom['jenis'] = 'komsponsor6';
				$kom['dari'] = $username;
				if($sponsore6){
					$this->db->insert("komisi",$kom);
				}
				
			} // 
		}
	
		$sponsore = $this->data_model->dataku("sponsor", $username);
		$pkt_sponsor = $this->data_model->dataku("harga",$sponsore);
		$pkt_member = $this->data_model->dataku("harga",$username);
		$nama_paket = $this->data_model->nama_paket($pkt_member);
		$member_bv = $this->data_model->dataku("bv",$username);
		
		///Bonus pasangan
		//----komisi pasangan---
		$level = $this->data_model->dataupline("level", $username);
		
		if($pkt_sponsor == 1){
			$k_pas = $this->data_model->config("kompasangan");
			$fo = $this->data_model->config("flushout"); //----max flushout
		} else if($pkt_sponsor == 2){
			$k_pas = $this->data_model->config("kompasangan2");
			$fo = $this->data_model->config("flushout2");
		} else if($pkt_sponsor == 3){
			$k_pas = $this->data_model->config("kompasangan3");
			$fo = $this->data_model->config("flushout3");
		} else if($pkt_sponsor == 4){
			$k_pas = $this->data_model->config("kompasangan4");
			$fo = $this->data_model->config("flushout4");
		} else if($pkt_sponsor == 5){
			$k_pas = $this->data_model->config("kompasangan5");
			$fo = $this->data_model->config("flushout5");
		} else if($pkt_sponsor == 6){
			$k_pas = $this->data_model->config("kompasangan6");
			$fo = $this->data_model->config("flushout6");
		}
		
		for($i=0;$i<$level;$i++) {
			$upli = $this->data_model->dataupline("upline$i", $username);
								
			$matchnow=$this->data_model->match($upli);
			
			//--cek jml kompas--
			$uql = mysql_query("select SUM(status) AS tot_bv from komisi WHERE jenis='kompasangan' and username='$upli' GROUP BY username"); 
			$row_uql = mysql_fetch_row($uql);
			$match = $row_uql[0]; 
			
			$sql_fo = mysql_query("select SUM(status) AS tot_bv from komisi where jenis='kompasangan' and username='$upli' and (tglbayar between '$dtfrom' and '$dtto') GROUP BY username");
			$row_fo = mysql_fetch_row($sql_fo);
			$ada_fo = $row_fo[0];; //---flush out hari ini
							
		
			if($matchnow > $match) {
				$selisih_bv = $matchnow - $match;
				if($ada_fo < $fo) {
					$mykom_pas = ($k_pas/100)*$selisih_bv; 
					$kom_pas['total'] = "$k_pas% x $selisih_bv BV ($nama_paket)";					
				} else {
					$mykom_pas = 0; 
					$kom_pas['total'] = "flushout";
				}
				
				
			
				$kom_pas['username'] = $upli;
				$kom_pas['bayar'] = $mykom_pas;
				$kom_pas['tglbayar'] = $clientdate;
				$kom_pas['status'] = $selisih_bv;
				
				$kom_pas['jenis'] = 'kompasangan';
				$kom_pas['dari'] = $username;
				
				$this->db->insert("komisi",$kom_pas);
				
			} //--end if match
		
		}	
		
		//end of bonus pasangan
			
			
			
	}
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */