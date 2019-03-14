<?php



/**

 * @Author: Cekotechnology

 * @Date:   2019-01-01 20:29:00

 * @Last Modified by:   Cekotechnology

 * @Last Modified time: 2019-01-13 20:58:30

 */



if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Ppob_c extends CI_Controller {



    public function __construct(){

		parent::__construct();

		$this->load->model('data_model');	

    }

    
    public function index(){
        
        
        $url = 'https://tripay.co.id/api/v2/pembelian/category/';

        $header = array(
           'Accept: application/json',
           'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503', // Ganti [apikey] dengan API KEY Anda
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        
        if(curl_errno($ch)){
           return 'Request Error:' . curl_error($ch);
        }
        
        $rest = json_decode($result, true);
        if($rest['success']){
            $d['category'] = $rest["data"];
        }

$user_session = $this->session->userdata('username');        

		$d['user_session'] = $user_session;

		if(!empty($user_session)){

			$d['page_title']="List Orders";

			$lst_content = $this->db->query("SELECT id, title, maintext FROM content WHERE title='Home - Member Area'");

			$result = $lst_content->row();

			$result_array =  array_values((array)$result);

			$d['main_content'] = $result_array[2];

			

			// $d['lst_profit'] = $this->db->query("SELECT * FROM tb_roi WHERE username='$user_session'");

			// $d['tot_byr_profit'] = $this->app_model->count_records("komisi","WHERE username='$user_session' AND jenis='komroi'");

						

            // $d['saldo_ppob'] = 0;

			

			
        
        $d['content']= $this->load->view('ppob_view/index',$d,true);


		}else{

			header('location:'.base_url().'index.php/login');

		}
		$this->load->view('include/template',$d); 
    }
    
    public function api_operator($flag="pembelian",$id){

        $url = 'https://tripay.co.id/api/v2/'.$flag.'/operator/bycategory?id='.$id;
        $header = array(
           'Accept: application/json',
           'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503', // Ganti [apikey] dengan API KEY Anda
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        
        if(curl_errno($ch)){
           return 'Request Error:' . curl_error($ch);
        }
        
        $rest = json_decode($result, true);
        
        if($rest["success"]){
            echo json_encode($rest["data"]);
        }else{
            echo json_encode(["message" => "sedang gangguan","detail" => $rest]);
        }
    }

    public function api_operator_produk($flag="pembelian",$id){
    	
        $url = 'https://tripay.co.id/api/v2/pembelian/produk/byoperator?id='.$id;

        $header = array(
           'Accept: application/json',
           'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503', // Ganti [apikey] dengan API KEY Anda
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        
        if(curl_errno($ch)){
           return 'Request Error:' . curl_error($ch);
        }
        
        $rest = json_decode($result, true);
        
        if($rest["success"]){
            echo json_encode($rest["data"]);
        }else{
            echo json_encode(["message" => "sedang gangguan"]);
        }
    }
    
    
    public function pembelian(){
        
        
        $url = 'https://tripay.co.id/api/v2/pembelian/category/';

        $header = array(
           'Accept: application/json',
           'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503', // Ganti [apikey] dengan API KEY Anda
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        
        if(curl_errno($ch)){
           return 'Request Error:' . curl_error($ch);
        }
        
        $rest = json_decode($result, true);
        if($rest['success']){
            $d['category'] = $rest["data"];
        }
        
		$user_session = $this->session->userdata('username');        

		$d['user_session'] = $user_session;

		if(!empty($user_session)){

			$d['page_title']="List Orders";

			$lst_content = $this->db->query("SELECT id, title, maintext FROM content WHERE title='Home - Member Area'");

			$result = $lst_content->row();

			$result_array =  array_values((array)$result);

			$d['main_content'] = $result_array[2];

			

			// $d['lst_profit'] = $this->db->query("SELECT * FROM tb_roi WHERE username='$user_session'");

			// $d['tot_byr_profit'] = $this->app_model->count_records("komisi","WHERE username='$user_session' AND jenis='komroi'");

						

            // $d['saldo_ppob'] = 0;

			

			
        $d['content']= $this->load->view('ppob_view/tripay',$d,true);

		$this->load->view('include/template',$d); 


		}else{

			header('location:'.base_url().'index.php/login');

		}
    }
    
    public function get_operator_pembayaran(){
        $url = 'https://tripay.co.id/api/v2/pembayaran/operator';

        $header = array(
           'Accept: application/json',
           'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503', // Ganti [apikey] dengan API KEY Anda
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        
        if(curl_errno($ch)){
           return 'Request Error:' . curl_error($ch);
        }
        
        $rest = json_decode($result, true);
        echo json_encode($rest["data"]);
    }
    
    public function get_operator_pembayaran_byid($id){
        $url = 'https://tripay.co.id/api/v2/pembayaran/produk/byoperator?id='.$id;

        $header = array(
           'Accept: application/json',
           'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503',
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        
        if(curl_errno($ch)){
           return 'Request Error:' . curl_error($ch);
        }
        
        $rest = json_decode($result, true);
        
        echo json_encode($rest["data"]);
    }

    public function post_transaksi(){
        
    	$data = $this->input->post();
    	
//     	$jumlah = (float)$data['harga'] + 100;
//     	$code = $data['product'];
//             $phone = $data['phone'];
//             if($data['jenis_transaksi']=="token-listrik"){
//         	        $tujuan = $data['no_meter_pln'];    
//         	}else{
//         	    $tujuan = $data['phone'];
//         	}   
        	
// //     		$data = array( 
// // 				'inquiry' => ($data['jenis_transaksi'] == "Token Listrik")? 'PLN' :  'I' , // konstan I OR PLN
// // 				'code' => $code, // kode produk
// // 				'phone' => $phone, // nohp pembeli
// // 				'no_meter_pln' => ($data['jenis_transaksi'] == "Token Listrik")? $tujuan : '', // khusus untuk pembelian token PLN prabayar
// // 				'pin' => '6838', // pin member
// // 			);
    	
//     	$array = [

//                     'username' => $this->session->userdata('username'),

//                     'jumlah' => $jumlah,

//                     'uraian' => 'Pembelian  '.$data['jenis_transaksi'].' '.$data['nama_product'].' Ke no Tujuan '.$tujuan,

//                     'tgl' => date('Y-m-d H:i:s'),

//                     'status' => 1,

//                     'jenis' => 'debit',

//                 ];
//         print_r($array);
//          print_r($data);
//          die;

    	if(md5($data['password']) != $this->get_member_detail()->pass){
			echo json_encode(["error" => false, "message" => "password salah"]);
			return;
			exit;
		}
    	
    		
    	if($data['type']=="pembelian"){
    	    
    	    $url = 'https://tripay.co.id/api/v2/transaksi/pembelian';

            $header = array(
               'Accept: application/json',
               'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503',
            );
            $code = $data['product'];
            $phone = $data['phone'];
            if($data['jenis_transaksi']=="Token Listrik"){
        	    $tujuan = $data['no_meter_pln'];    
        	}else{
        	    $tujuan = $data['phone'];    
        	}   
        	
    		$data_send = array( 
				'inquiry' => ($data['jenis_transaksi'] == "Token Listrik")? 'PLN' :  'I' , // konstan I OR PLN
				'code' => $code, // kode produk
				'phone' => $phone, // nohp pembeli
				'no_meter_pln' => ($data['jenis_transaksi'] == "Token Listrik")? $tujuan : '', // khusus untuk pembelian token PLN prabayar
				'pin' => '6838', // pin member
			);
            
            //print_r($data_send);die;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_send);
			$result = curl_exec($ch);
			
			if(curl_errno($ch)){
               return 'Request Error:' . curl_error($ch);
            }
            
            $rest = json_decode($result, true);
            
            if($rest["success"]){
                $jumlah = (float)$data['harga'] + 100;
                $trxid = $rest['trxid'];
                $insert = $this->db->insert('dataewalet',[

                    'username' => $this->session->userdata('username'),

                    'jumlah' => $jumlah,

                    'uraian' => 'Pembelian  '.$data['jenis_transaksi'].' '.$data['nama_product'].' Ke no Tujuan '.$tujuan.' <a href="'.base_url().'/ppob_c/detail_transaksi/'.$trxid.'" target="_blank">lihat detail</a>',

                    'tgl' => date('Y-m-d H:i:s'),

                    'status' => 1,

                    'jenis' => 'debit',

                ]);
                echo json_encode($rest);
            }else{
                echo json_encode(["success" => false,"message" => $rest['message']]);
            }
            
    	}else{
    	    
    	    $url = 'https://tripay.co.id/api/v2/pembayaran/cek-tagihan';

            $header = array(
               'Accept: application/json',
               'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503', // Ganti [apikey] dengan API KEY Anda
            );
            
            $data = array( 
            'product' =>  "PLNPASCH",// Produk (exp : PLN)
            'phone' => $data['phone'], // Masukkan No.hp Anda
            'no_pelanggan' => $data['id_pelanggan'], // Masukkan ID Pelanggan (exp: no.meteran/ id pembayaran)
            'pin' => '6838', // Masukkan PIN user (anda)
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
    	    
    	    $rest = json_decode($result, true);
            
            if($rest["success"]){
                echo json_encode($rest);
            }else{
                echo json_encode($rest);
            }
    	    
    	}
    }
    
    function pembayaran(){
        $user_session = $this->session->userdata('username');        
        $data = $this->input->post();
		$d['user_session'] = $user_session;

		if(!empty($user_session)){
		       
		    
            $url = 'https://tripay.co.id/api/v2/transaksi/pembayaran';
    
            $header = array(
               'Accept: application/json',
               'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503', // Ganti [apikey] dengan API KEY Anda
            );
            
            $data_send = array( 
            'order_id' => $data['order_id'], // Masukkan ID yang didapat setelah melakukan pengecekan pembayaran
            'pin' => '6838', // Masukkan PIN user (anda)
            );
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_send));
            $result = curl_exec($ch);
            
            if(curl_errno($ch)){
               return 'Request Error:' . curl_error($ch);
            }
            
            $rest = json_decode($result, true);
            
            if($rest["success"]){
                
                $insert = $this->db->insert('dataewalet',[

                    'username' => $this->session->userdata('username'),

                    'jumlah' => $jumlah,

                    'uraian' => 'Pembayaran Tagihan '.$data['no_pelanggan'].' nama '.$data['nama'].' periode '.$data['periode'].' dengan biaya admin '.$data['biaya_admin'].' dengan total tagihan '.$data['jumlah_bayar'],

                    'tgl' => date('Y-m-d H:i:s'),

                    'status' => 1,

                    'jenis' => 'debit',

                ]);
                
                echo json_encode($rest);
            }else{
                echo json_encode($rest);
            }
		}
        
    }

    function get_member_detail(){

        $user_info=$this->session->all_userdata();



        $this->db->select("*");

        $this->db->from("member");

        $this->db->where(array('username' => $user_info['username']));


        $rest = $this->db->get()->row();



        return $rest;

    }

    function detail_transaksi($trx_id){
        
        $url = 'https://tripay.co.id/api/v2/histori/transaksi/detail';

        $header = array(
           'Accept: application/json',
           'Authorization: Bearer 7b558b597138f17c37f49acd35822c5c1ff749d7b8c87504b4007c66b503', // Ganti [apikey] dengan API KEY Anda
        );
        
        $data = array( 
        'trxid' => $trx_id, 
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($ch);
        
        if(curl_errno($ch)){
           return 'Request Error:' . curl_error($ch);
        }
        
        $rest = json_decode($result, TRUE);
        
        if($rest['success']){
            $d['data'] = $rest["data"];
        }else{
            $d['data'] = $rest["data"];
        }
        
        if(empty($d['data'])){
            echo "<script>confirm('Sedang dalam ganguan')</script>";
            echo "<a href='".base_url()."'>Kembali</a>";
            return;
        }
        
        $user_session = $this->session->userdata('username');        

		$d['user_session'] = $user_session;

		if(!empty($user_session)){

			$d['page_title']="List Orders";

			$lst_content = $this->db->query("SELECT id, title, maintext FROM content WHERE title='Home - Member Area'");

			$result = $lst_content->row();

			$result_array =  array_values((array)$result);

			$d['main_content'] = $result_array[2];

			

			// $d['lst_profit'] = $this->db->query("SELECT * FROM tb_roi WHERE username='$user_session'");

			// $d['tot_byr_profit'] = $this->app_model->count_records("komisi","WHERE username='$user_session' AND jenis='komroi'");

						

            // $d['saldo_ppob'] = 0;

			

			
        $d['content']= $this->load->view('ppob_view/detail_transaksi',$d,true);

		$this->load->view('include/template',$d); 


		}else{

			header('location:'.base_url().'index.php/login');

		}       
    }
    
    function refund_tripay(){
        $data = $this->input->post();
        
        if( !empty($data) && $data['trxid']!='' && $data['harga']!='' && $data['target']!='' && $data['status']!='' ){
            $jumlah = $data['harga'] + 100;
            if($data['status']==2){
                
                $query = $this->db->query("select * from dataewalet where trxid = ".$data['trxid']." limit 1");
                
                if($query->num_rows() > 0){
                    echo json_encode(["success" => false, "message" => "pengembalian sudah di kembalikan pada tanggal ".$query->row()->tgl]);    
                    return;
                }else{
                    $insert = $this->db->insert('dataewalet',[
        
                        'username' => $this->session->userdata('username'),
        
                        'jumlah' => $jumlah,
        
                        'uraian' => 'Pengembalian transaksi '.$data['produk'].' dengan harga '.$jumlah.' target '.$data['target'].' pada tanggal '.$data['tanggal'].' berhasil di kembalikan',
        
                        'tgl' => date('Y-m-d H:i:s'),
        
                        'status' => 1,
        
                        'jenis' => 'kredit',
                        
                        'trxid' => $data['trxid']
        
                    ]);  
    
                    if($insert){
                        echo json_encode(["success" => true, "message" => "pengembalian dana berhasil"]);    
                        return;
                    }else{
                        echo json_encode(["success" => false, "message" => "pengembalian dana gagal"]);    
                        return;
                    }    
                }
                
            }
            
            
        }else{
            echo json_encode(["success" => false, "message" => "pengembalian dana tidak boleh"]);
            return;
        }
    }

}
