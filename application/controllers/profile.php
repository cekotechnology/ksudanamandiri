<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('data_model');
    }

	public function index()
	{
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		if(!empty($user_session)){			
			$d['page_title']="Profile";			
			
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('tglahir', 'Tgl Lahir', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('ktp', 'No KTP', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('kota', 'Kota', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('propinsi', 'Propinsi', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('negara', 'Negara', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('kodepos', 'Kode Pos', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('hp', 'No HP', 'required|trim|xss_clean|strip_tags');
			
			if ($this->form_validation->run() == FALSE){
				$d['message'] = "";
				$d['content']= $this->load->view('profile/view',$d,true);
				$this->load->view('include/template',$d);
			} else {
				$nama = $this->input->post('nama', TRUE);
				$ktp = $this->input->post('ktp', TRUE);
				$tglahir = $this->input->post('tglahir', TRUE);
				$alamat = $this->input->post('alamat', TRUE);
				$kota = $this->input->post('kota', TRUE);
				$propinsi = $this->input->post('propinsi', TRUE);
				$negara = $this->input->post('negara', TRUE);
				$kodepos = $this->input->post('kodepos', TRUE);
				$email = $this->input->post('email', TRUE);
				$hp = $this->input->post('hp', TRUE);
				$acc_type = $this->input->post('acc_type', TRUE);
				$bank = $this->input->post('bank', TRUE);
				$norek = $this->input->post('norek', TRUE);
				$namarek = $this->input->post('namarek', TRUE);
				
				
				$up['nama'] = $nama;
				$up['tglahir'] = $tglahir;
				$up['ktp'] = $ktp;
				$up['alamat'] = $alamat;
				$up['kota'] = $kota;
				$up['propinsi'] = $propinsi;
				$up['negara'] = $negara;
				$up['email'] = $email;
				$up['hp'] = $hp;
				$up['kodepos'] = $kodepos;
				$up['acc_type'] = $acc_type;
				$up['bank'] = $bank;
				$up['norek'] = $norek;
				$up['namarek'] = $namarek;
				
				$id['username'] = $user_session;
				$this->app_model->updateData("member",$up,$id);
				$d['message'] = "Update successfully";
				
				$d['content']= $this->load->view('profile/view',$d,true);
				$this->load->view('include/template',$d);
								
			}
		}else{
			header('location:'.base_url().'login');
		}
	}
  
	public function changepassword()
	  {
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		if(!empty($user_session)){			
			$d['page_title']="Profile";			
			
			$this->form_validation->set_rules('pass', 'Current Password', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('newpass', 'New Password', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('newpass2', 'Confirm Password', 'required|trim|xss_clean|strip_tags');
			
			
			if ($this->form_validation->run() == FALSE){
				$d['message'] = "";
				$d['content']= $this->load->view('profile/changepass',$d,true);
				$this->load->view('include/template',$d);
			} else {
				$pass = $this->input->post('pass', TRUE);
				$newpass = $this->input->post('newpass', TRUE);
				$newpass2 = $this->input->post('newpass2', TRUE);	
				if($newpass<>$newpass2){
					$d['message'] = "Password tidak sama";
				} else {
					$id['username'] = $user_session;
					$id['pass'] = md5($pass);
					$data = $this->app_model->getSelectedData("member",$id);
					if($data->num_rows()==0){
						$d['message'] = "Password salah";
					} else {
						$up['pass'] = md5($newpass2);	
						$up['pin'] = $newpass2;
						$id['username'] = $user_session;
						$this->app_model->updateData("member",$up,$id);
						$d['message'] = "Update password successfully";
						
						//execute Json register PPOB Guava
					
                        $username = $user_session;
                        $password_new = $newpass2;
                        $password_old = $pass;
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
                        curl_setopt($ch, CURLOPT_HEADER, 0);  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  

                        curl_exec($ch);
                       
                        if(curl_error($ch))
                        {
                            $d['result'] =  curl_error($ch);
                        } else {
                             $d['result'] = 'Update password PPOB success';
                        }
					}
				}
				$d['content']= $this->load->view('profile/changepass',$d,true);
				$this->load->view('include/template',$d);			
			}
		}else{
			header('location:'.base_url().'login');
		}
	}
	
	
	public function changepin()
	  {
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		if(!empty($user_session)){			
			$d['page_title']="Profile";			
			
			$this->form_validation->set_rules('pass', 'Current Password', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('newpass', 'New Password', 'required|trim|xss_clean|strip_tags');
			$this->form_validation->set_rules('newpass2', 'Confirm Password', 'required|trim|xss_clean|strip_tags');
			
			
			if ($this->form_validation->run() == FALSE){
				$d['message'] = "";
				$d['content']= $this->load->view('profile/changepass',$d,true);
				$this->load->view('include/template',$d);
			} else {
				$pass = $this->input->post('pass', TRUE);
				$newpass = $this->input->post('newpass', TRUE);
				$newpass2 = $this->input->post('newpass2', TRUE);	
				if($newpass<>$newpass2){
					$d['message'] = "Password tidak sama";
				} else {
					$id['username'] = $user_session;
					$id['pass'] = md5($pass);
					$data = $this->app_model->getSelectedData("member",$id);
					if($data->num_rows()==0){
						$d['message'] = "Password salah";
					} else {
						$up['pass'] = md5($newpass2);	
						$up['pin'] = $newpass2;
						$id['username'] = $user_session;
						$this->app_model->updateData("member",$up,$id);
						$d['message'] = "Update password successfully";
					}
				}
				$d['content']= $this->load->view('profile/changepass',$d,true);
				$this->load->view('include/template',$d);			
			}
		}else{
			header('location:'.base_url().'login');
		}
	}
	
	public function simpan()
	{
        
		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		$d['page_title']="Profile Upload Photo";		
		if($user_session){

			$foto = $_FILES['foto'];

				$config['upload_path'] = './asset/foto_profil';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= TRUE;
				$new_name = time().$_FILES["foto"]['name'];
                $config['file_name'] = $new_name;
				$config['max_size']	= '1000*2';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('foto')){
					$this->upload->data();
					$up['foto'] = $new_name;
					$error = 'upload sukses';
					$id['username'] = $user_session;
    				$this->db->update("member",$up,$id);
    				$this->session->set_flashdata('info','Data sukses di Update');
    			
    				$d['message'] = "Upload photo successfully";
    				$d['content']= $this->load->view('profile/upload_success',$d,true);
				}else{
					$error = 'Error Upload Foto : '.$this->upload->display_errors();
					$this->session->set_flashdata('error',$error);
					$d['message'] = $error;
					$d['content']= $this->load->view('profile/upload_error',$d,true);
				}
               
				$this->load->view('include/template',$d);		

		}else{
		    
			header('location:'.base_url());
		}

	}

	public function upload()
	{

		$user_session = $this->session->userdata('username');
		$d['user_session'] = $user_session;
		if(!empty($user_session)){
			$d['page_title']="Upload Photo";	

			$this->form_validation->set_rules('foto', 'File Photo', 'required|trim|xss_clean|strip_tags');
			if ($this->form_validation->run() == FALSE){
				$d['message'] = "";
				$d['content']= $this->load->view('profile/upload',$d,true);
				$this->load->view('include/template',$d);
			} else {
			
				$foto = $_FILES['foto'];

				$config['upload_path'] = './asset/foto_profil';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite']	= TRUE;
				$config['max_size']	= '1000*2';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('foto')){
					$this->upload->data();
					$up['foto'] = $foto['name'];
					$error = 'upload sukses';
					$this->session->set_flashdata('error',$error);
				}else{
					$error = 'Error Upload Foto : '.$this->upload->display_errors();
					$this->session->set_flashdata('error',$error);
				}

				$this->app_model->updateData("member",$up,$id);
				$this->session->set_flashdata('info','Data sukses di Update');
			

				redirect('profile/upload');
			}

		}else{
			header('location:'.base_url());
		}

	}

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
