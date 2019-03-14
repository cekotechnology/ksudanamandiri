<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ewalet_model extends CI_Model {
	
	
	public function mysaldo_kom($username, $dtgl) {
		$te = 0;
		//--ngitung kredit--
		$q = $this->db->query("SELECT bayar AS jumlah FROM komisi WHERE username='$username'");
		
		$ted = 0;
		foreach($q->result_array() as $row)
		{
			$ted = $ted + $row['jumlah'];
		}
		
		//---ngitung debet--
		$qe = $this->db->query("SELECT jumlah FROM tb_withdrawal WHERE username='$username' AND status='1' AND jenis='ebonus'");
		$tek = 0;
		foreach($qe->result_array() as $row)
		{
			$tek = $tek + $row['jumlah'];
		}	
		$te = $ted - $tek;
		return $te;
	}
	
	public function myewaletdone($username, $dtgl) {
		$te = 0;
		//--ngitung kredit--
		$q = $this->db->query("SELECT jumlah FROM dataewalet WHERE username=".$username." AND jenis='kredit' $dtgl");
		
		$ted = 0;
		foreach($q->result_array() as $row)
		{
			$ted = $ted + $row['jumlah'];
		}
		
		//---ngitung debet--
		$qe = $this->db->query("SELECT jumlah FROM dataewalet WHERE username=".$username." AND jenis='debit' $dtgl");
		$tek = 0;
		foreach($qe->result_array() as $row)
		{
			$tek = $tek + $row['jumlah'];
		}	
		$te = $ted - $tek;
		return $te;
	}
	
	public function myeregisterdone($username, $dtgl) {
		$te = 0;
		//--ngitung kredit--
		$q = $this->db->query("SELECT jumlah FROM dataeregister WHERE username='$username' AND jenis='kredit' $dtgl");
		
		$ted = 0;
		foreach($q->result_array() as $row)
		{
			$ted = $ted + $row['jumlah'];
		}
		
		//---ngitung debet--
		$qe = $this->db->query("SELECT jumlah FROM dataeregister WHERE username='$username' AND jenis='debit' $dtgl");
		$tek = 0;
		foreach($qe->result_array() as $row)
		{
			$tek = $tek + $row['jumlah'];
		}	
		$te = $ted - $tek;
		return $te;
	}
	
	public function saldo_ppob($username) {
	    $saldo = 0;
	    
       
        return 0;
	}
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */