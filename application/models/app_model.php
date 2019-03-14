<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
		
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
    function count_records($table, $dtgl) {
		$hasil = 0;
		$q = $this->db->query("SELECT * FROM $table $dtgl");
		$result = $q->num_rows();
		
		$hasil = $result;		
		return $hasil;
	}
	
	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	
	public function formatgl($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	
	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
	
	public function randomPassword($length) {
		$allow = "ABCDEFGHJKLMNPQRSTUVWXYZ0123456789";
		$i = 1;
		$ret = "";
		while ($i <= $length) {
			$max = strlen($allow)-1;
			$num = rand(0, $max);
			$temp = substr($allow, $num, 1);
			$ret = $ret . $temp;
			$i++;
		}
		return $ret;
	}
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	public function send_sms($message, $destination){
		$user_sms	= urlencode("tf8gn3");
		$pass_sms	= urlencode("2EbRuf7s@");
		$destination= urlencode($destination);
	    $message 	= html_entity_decode($message, ENT_QUOTES, 'utf-8'); 
	    $message 	= urlencode($message);
	     
		$fp = "https://reguler.zenziva.net/apps/smsapi.php";
		$fp .= "?userkey=$user_sms&passkey=$pass_sms&nohp=$destination&pesan=$message";
        
		$http = curl_init($fp);
		curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);		
		$http_result = curl_exec($http);
		$http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
		curl_close($http);
		return $http_result;
	}
	
	public function saldo_ppob($username, $passw){
    	//execute Json register PPOB Guava
    	$result = '';		
        $jenis='SALDO';
        //API Url
        $url = 'http://202.158.48.172:9933/informasi.jsp';
        
        //Initiate cURL.
        $ch = curl_init($url);
        
        //The JSON data.
        $jsonData = array(
        
            'username' => $username,
            'password' => $passw,
            'jenis' => $jenis,
            'sign' => md5($username.$passw.$jenis)
        );
        
        //Encode the array into JSON.
        $jsonDataEncoded = json_encode($jsonData);
        
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);
        
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        
        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
       // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //Execute the request
        
        return $result = curl_exec($ch);
        
    	//end of Json
	}
	
	public function getMaxKodePinjaman()
	{
		$q = $this->db->query("select MAX(id_pinjam) as ID from pinjaman_header");
		$kd = "";
		if($q->num_rows()>0)
		{
			foreach($q->result() as $k)
			{
				$kode = substr($k->ID,2,7);
				$tmp = ((int)$kode)+1;
				$kd = "PK".sprintf("%07s", $tmp);
				//echo "Kode:".$kd; exit;
			}
		}
		else
		{
			$kd = "PK0000001"; //"A"."001";
		}
		return $kd;
	}
	
	//-rupiah------------
    public function bonus_format($rp)
    {
    	$rupiah = "";
    	$rupiah = "".number_format($rp, 0, '.', ',')." BV";
    	return $rupiah;
    }
    
    //-rupiah------------
    public function rupiah($rp)
    {
    	$rupiah = "";
    	$rupiah = "Rp ".number_format($rp, 2, '.', ',');
    	return $rupiah;
    }
    
    public function resetPassword($username)
	{
		$query =  $this->db->query("SELECT * from member where username = '".$username."' LIMIT 1");
		
		if ($query->num_rows() > 0) {
			
			foreach($query->result_array() as $row){
				$nama = $row['nama'];
				$email = $row['email'];
				$password = $row['pin'];
			}
			
			///API CHANGE PASS
			$up['pass'] = md5($password);	
			$up['pin'] = $password;
			$id['username'] = $username;
			$this->app_model->updateData("member",$up,$id);
			
			//execute Json register PPOB Guava
					
            //API Url
            
            $password_new = $password;
            $password_old = $password;
            $sign = md5($username,$password_new.$password_old);
            
            $url = 'http://202.158.48.172/pass.jsp';

            //Initiate cURL.
            $ch = curl_init($url);
            
            $username   = $user_session;
            $passwd_new = $password_new;
            $passwd_old = $password_new;
            $sign       = $username.$passwd_new.$passwd_old;
            
            //The JSON data.
            $jsonData = array(
            'username' => $username,
            'password_new' => $passwd_new,
            'password_old' => $passwd_old,
            'sign' => md5($sign),
            );
            
            $jsonDataEncoded = json_encode($jsonData);
            
            curl_setopt($ch, CURLOPT_POST, 1);
            
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            //curl_setopt($ch, CURLOPT_HEADER, 0);  
            //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  

            curl_exec($ch);

			
			//////////////
			
			
			///////////////////email registration/////////////////////////////////////////////////////////
			$fromEmail = "tambanghijaumandiri@gmail.com";
			$passWord = "tambanghijau168";
					
			$mail = new PHPMailer();
			$mail->IsHTML(true);    // set email format to HTML
			$mail->IsSMTP();   // we are going to use SMTP
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			
			$mail->SMTPAuth   = true; // enabled SMTP authentication
			$mail->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
			$mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
			$mail->Port       = 587;                   // SMTP port to connect to GMail
			$mail->Username   = $fromEmail;  // alamat email kamu
			$mail->Password   = $passWord; // password GMail
			$mail->SetFrom('tambanghijaumandiri@gmail.com', 'Tambang Hijau Mandiri');  //Siapa yg mengirim email
			$mail->addReplyTo('tambanghijaumandiri@gmail.com', 'Tambang Hijau Mandiri');
			$mail->Subject    = "Tambang Hijau Mandiri  - Password Recovery";
			//$mail->Body       = $isiEmail;
			$toEmail = $email; // siapa yg menerima email ini
			$mail->AddAddress($toEmail);
					
			///isi email		
	
			$email_body = "
			Hi $nama,<br />
			<br />
			Password anda adalah $password
			Mohon simpan data ini dan jangan dibagikan ke orang lain.
			<br />
			<br />
			Regards,
			Tambang Hijau
			";
				
			$mail->msgHTML($email_body);			
			//$mail->Send();			
			  /////END of email ////////////////////////////////////////////////////////	

			
			
			$this->session->set_flashdata('result_reset_success', 'Reset password successfull. Kami telah mengirim password anda ke no hp: '.$username.' dan ke alamat email:'.$email.'. Terima kasih');
			redirect(base_url().'forget');
		} else {
			$this->session->set_flashdata('result_reset_password', 'Invalid username / username has not registered yet');
			redirect(base_url().'forget');
		}
	}
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */