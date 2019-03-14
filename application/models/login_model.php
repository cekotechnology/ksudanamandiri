<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	//query login
	public function getLoginData($usr,$psw)
	{
	    $this->load->model('ewalet_model');
		$u = $this->db->escape($usr);
		$p = md5($psw);
		//$b = 0;
		//$q_cek_login = $this->db->get_where('member', array('username' => $u, 'pass' => $p));
		$q_cek_login = $this->db->query("SELECT * FROM member WHERE (username=".$u." OR userid=".$u.") AND pass='$p'");
		
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
			    
			    if($this->ewalet_model->myewaletdone($u,'') >=0){	
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'aingLoginAkuntansiYeuh';
						$sess_data['username'] = $qad->username;
						$sess_data['nama'] = $qad->nama;
                        $sess_data['sponsor'] = $qad->sponsor;
						$sess_data['upline'] = $qad->upline;
                        $sess_data['foto'] = $qad->foto;
						$this->session->set_userdata($sess_data);
					}

					// start baru di tambah untuk ecommerce
					$db2 = $this->load->database('db2',true);
					$get_user = $this->get_member_detail($u);
					
					$db2->select("*");
					$db2->from('ontime_cekotech_users');
					$db2->where(array('user_email' => $get_user->email));
					$check_account = $db2->get();

					if($check_account->num_rows() < 1){
						$db2->insert('ontime_cekotech_users',[
							'user_login' => $get_user->username,
							'user_pass' => md5($get_user->pin),
							'user_nicename' => $get_user->nama,
							'display_name' => $get_user->nama,
							'user_status' => 0,
							'user_email' => $get_user->email,
							'user_registered' => date('Y-m-d H:i:s')
						]);
					}

					// end baru di tambah 

					header('location:'.base_url().'home');
			    } else {
			        $this->session->set_flashdata('result_login', '<br>Status keanggotaan anda belum aktif. Silakan menabung minimal 5 juta agar status anda aktif');
					header('location:'.base_url().'login');
			    }
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', '<br>Wrong username or password.');
			header('location:'.base_url().'login');
		}
	}

	function get_member_detail($username){
        $user_info=$this->session->all_userdata();
        
        $this->db->select("*");
        $this->db->from("member");
        $this->db->where(array('username' => $user_info['username']));

        $rest = $this->db->get()->row();

        return $rest;
    }
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */