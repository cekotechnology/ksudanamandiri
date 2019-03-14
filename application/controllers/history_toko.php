<?php



/**

 * @Author: Cekotechnology

 * @Date:   2019-01-01 20:29:00

 * @Last Modified by:   Cekotechnology

 * @Last Modified time: 2019-01-13 20:58:30

 */



if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class History_toko extends CI_Controller {



    public function __construct(){

		parent::__construct();

		$this->load->model('data_model');	

    }



	public function index(){

		//    echo "<pre>"; print_r($this->session->all_userdata()); echo "</pre>";

        //     die;



        $db2 = $this->load->database('db2',true);

        $get_user = $this->get_member_detail();

        

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

        }else{

            echo "ada";

        }

        echo "<pre>";

        print_r($check_account->row());

        die;



        $user_session = $this->session->userdata('username');        

		$d['user_session'] = $user_session;

		if(!empty($user_session)){

			$d['page_title']="Home";

			$lst_content = $this->db->query("SELECT id, title, maintext FROM content WHERE title='Home - Member Area'");

			$result = $lst_content->row();

			$result_array =  array_values((array)$result);

			$d['main_content'] = $result_array[2];

			

			// $d['lst_profit'] = $this->db->query("SELECT * FROM tb_roi WHERE username='$user_session'");

			// $d['tot_byr_profit'] = $this->app_model->count_records("komisi","WHERE username='$user_session' AND jenis='komroi'");

						

            // $d['saldo_ppob'] = 0;

			

			$d['content']= $this->load->view('history_toko/index',$d,true);

			$this->load->view('include/template',$d);

		}else{

			header('location:'.base_url().'index.php/login');

		}

	}

	public function list_order(){

	   $ch = curl_init('https://on-time.id/wc-api/v3/orders?consumer_key=ck_0e2c0848dc4d1c473695979f548eea0ebf7e5795&consumer_secret=cs_92aac94dd2a9afa1912d6bc544fcb791fa10219e');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    

        $json = curl_exec($ch);

        curl_close($ch);

        $array_json = json_decode($json);

        

        $data = [];

        // $data['customer']= [];

        $data['item']= [];

        

        $mail = "riyo@cekotechnology.com";

        

        $banyak = count($array_json->orders);

        

        for ($i=0; $i < $banyak; $i++) { 

            $data['customer_mail'] = $array_json->orders[$i]->billing_address->email; 

            if($array_json->orders[$i]->billing_address->email == $mail){

                 $banyak_item = count($array_json->orders[$i]->line_items);

                for ($j=0; $j < $banyak_item; $j++) {

                	array_push($data['item'], [

                	    'nama_item' => $array_json->orders[$i]->line_items[$j]->name,

                	    'harga' => $array_json->orders[$i]->line_items[$j]->price,

                	    'qty' => $array_json->orders[$i]->line_items[$j]->quantity,

                	    'subtotal' => $array_json->orders[$i]->line_items[$j]->subtotal,

                	]);

                }

            }

           

        }

        

        // echo $banyak;

        

        echo "<pre>";

        print_r($array_json);

        // print_r($array_json->orders[0]->billing_address->email);

	}

	public function test_array(){

	    $userdb=Array

                (

                (0) => Array

                    (

                        (uid) => '100',

                        (name) => 'Sandra Shush',

                        (url) => 'urlof100'

                    ),

                

                (1) => Array

                    (

                        (uid) => '5465',

                        (name) => 'Stefanie Mcmohn',

                        (pic_square) => 'urlof100'

                    ),

                

                (2) => Array

                    (

                        (uid) => '40489',

                        (name) => 'Michael',

                        (pic_square) => 'urlof40489'

                    ),

                (3) => Array

                    (

                        (uid) => '40489',

                        (name) => 'Michael',

                        (pic_square) => 'urlof40489'

                    )

                );

                

                $key .= array_search(40489, array_column($userdb, 'uid'));

                

                echo ("The key is: ".$key);

	}



    function get_member_detail(){

        $user_info=$this->session->all_userdata();



        $this->db->select("*");

        $this->db->from("member");

        $this->db->where(array('username' => $user_info['username']));



        $rest = $this->db->get()->row();



        return $rest;

    }



    function get_list_orders(){

        $d['email'] = $this->get_member_detail()->email;

        $ch = curl_init('https://on-time.id/wc-api/v3/orders?consumer_key=ck_0e2c0848dc4d1c473695979f548eea0ebf7e5795&consumer_secret=cs_92aac94dd2a9afa1912d6bc544fcb791fa10219e');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    

        $json = curl_exec($ch);

        curl_close($ch);

        $array_json = json_decode($json,true);        

        $d['order_all'] = [];

        $d['order_id'] = "";

        $d['tgl_order'] = "";



        foreach ($array_json['orders'] as $key => $value) {

            if($value["payment_details"]["method_id"]=="other_payment"){

                if($value["billing_address"]["email"] == $d['email']){

                    $d['order_id'] .= $value['id'].",";

                    $d['tgl_order'] .= $value['created_at'];

                    array_push($d['order_all'], $value);
                    //     [

                    //     "payment_details" => $value["payment_details"]["method_id"],

                    //     "item_orders" => $value["line_items"],
                    //     "shipping_lines" => $value["shipping_lines"],
                    //     "fee_lines" => $value["fee_lines"],
                    //     "coupon_lines" => $value["coupon_lines"],

                    // ]);    

                }                

            }

        }

        // echo "<pre>";
        // print_r($d['order_all']);die;
        

        //$this->load->view('list_order',$data);



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

			if(! empty($d['order_all'])){

				foreach ($d['order_all'] as $key => $value) {

					if($value["status"]=="refunded"){
						$rest = $this->db->query("select * from dataewalet where refund_ecommerce = ".$value['order_number']."");
						if($rest->num_rows()<1){
						 $insert = $this->db->insert('dataewalet',[

				                    'username' => $this->session->userdata('username'),

				                    'jumlah' => $value['total'],

				                    'uraian' => 'Dana dikembalikan dari ecommerce dengan Pesanan '. $value['order_number'].' <a target="_blank" href="https://on-time.id/akun-saya/view-order/'. $value['order_number'].'">Detail nya</a>',
		
				                    'tgl' => date('Y-m-d H:i:s'),

				                    'status' => 1,

				                    'jenis' => 'kredit',
                  				'refund_ecommerce' => $value['order_number']

				                ]);
						}
					}		
				}
			}
				
			

			$d['content']= $this->load->view('list_order',$d,true);

		    $this->load->view('include/template',$d);

		}else{

			header('location:'.base_url().'index.php/login');

		}

    }

    function get_order_id_detail(){
        $order_id = $this->input->post('order_id');
        $url = "https://on-time.id/wc-api/v3/orders/".$order_id."?consumer_key=ck_0e2c0848dc4d1c473695979f548eea0ebf7e5795&consumer_secret=cs_92aac94dd2a9afa1912d6bc544fcb791fa10219e";
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    

        $json = curl_exec($ch);

        curl_close($ch);

        $array_json = json_decode($json,true);
        
        echo json_encode($array_json);
    }

    function konfirmasi_pembayaran(){
        $data = $this->input->post();
        
        if(md5($data['password']) == $this->get_member_detail()->pass){

            $rest = $this->update_order_id($data['order_id']);
            

            if($rest){
                 $insert = $this->db->insert('dataewalet',[

                    'username' => $this->session->userdata('username'),

                    'jumlah' => $data['total'],

                    'uraian' => 'Pembelian dari ecommerce dengan Pesanan '. $data['order_id'].' <a target="_blank" href="https://on-time.id/akun-saya/view-order/'. $data['order_id'].'">Detail nya</a>',

                    'tgl' => date('Y-m-d H:i:s'),

                    'status' => 1,

                    'jenis' => 'debit'

                ]);

                 if($insert){
                    $array = ["error" => 0 ,"message" => "Transaksi Berhasil"];
                 }else{
                    $array = ["error" => 1 ,"message" => "Transaksi Gagal"];
                 }

                 
            }else{
                $array = ["error" => 1 ,"message" => "Transaksi Gagal"];
            }
        }else{
            $array = ["error" => 1 ,"message" => "Password Anda Salah"];
        }


        echo json_encode($array);
    }


    function update_order_id($id_order){
        
        $data = array("order" => array("status" => "processing"));

        $ch = curl_init("https://on-time.id/wc-api/v3/orders/".$id_order."?consumer_key=ck_0e2c0848dc4d1c473695979f548eea0ebf7e5795&consumer_secret=cs_92aac94dd2a9afa1912d6bc544fcb791fa10219e");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));

        $response = curl_exec($ch);
        
        if (!$response) 

        {
            return false;
        }else{

            return true;

        }

        

    }

    function insert_history(){

        $data = $this->input->post('data');

        

        $order_id = substr($data['order_id'],0,-1);

        

        $order_id_up = (explode(",",$order_id));

        

        $loop_update = count($order_id_up);

        

        // for ($i=0; $i < $loop_update; $i++) {

            

        // }

        

        print_r($order_id_up);die;

        

        $banyak = count($data['nama_produk']);

        

        for ($i=0; $i < $banyak; $i++) { 

            $insert = array(

                'order_id' => $data['order_id'],

                'username' => $this->get_member_detail()->email,

                'created' => $data['created'],

                'nama_produk' => $data['nama_produk'][$i],

                'harga' => $data['harga'][$i],

                'quantity' => $data['quantity'][$i],

                'tanggal_order' => $data['tanggal_order'],

            );

            $this->db->insert('history_pembelian',$insert);

        }

        echo "<pre>";

        print_r($data);die;

    }



    function send_verifikasi(){
        $email = $this->input->post("email");
        $rand = mt_rand(100000, 999999);
        $rest = $this->send_email($email, "Verifikasi Kode", $rand);
        $rest = $this->send_sms($this->get_member_detail()->hp, "Kode Verifikasi = ".$rand);
        die;
        $this->session->set_userdata('key', $rand);
        echo json_encode(true);
        echo $rand;
    }

    function get_verifikasi(){

        $set_sesssion = $this->session->userdata("key");

        $key = $this->input->post("key");
        
        if(md5($key)!=$this->get_member_detail()->pass){
            
            echo json_encode(['message' => false]);
            return;
        }

        $idorder = $this->input->post("idorder");

        $total = $this->input->post("total");

        $get_id_order = explode(",",$idorder);
        // echo $this->get_member_detail()->hp;
        // echo $set_sesssion." = ".$key;
        // die;
        if(md5($key) ==$this->get_member_detail()->pass){

            echo json_encode(["message" => true]);

            foreach($get_id_order as $row){

                if(! empty($row) || $row != ""){

                    $this->update_order_id($row);

                }

            }
            

            $this->db->insert('dataewalet',[

                'username' => $this->session->userdata('username'),

                'jumlah' => $total,

                'uraian' => 'Pembelian dari ecommerce',

                'tgl' => date('Y-m-d H:i:s'),

                'status' => 1,

                'jenis' => 'debit'

            ]);

                echo json_encode(["message" => true]);
                return;
            

        }else{

            echo json_encode(["message" => false]);
            return;

        }

        return;

    }



    function send_email($to, $subject="Verifikasi Kode", $kode){

        //$to = "dadanasep15@gmail.com";

        $htmlContent = '

            <html>

            <head>

                <title>KSU Dana Mandiri</title>

            </head>

            <body>

                <h1>Send Kunci Verifikasi!</h1>

                <table cellspacing="0" style="border: 2px dashed #FB4314; width: 300px; height: 200px;">

                    <tr style="background-color: #e0e0e0;">

                        <td  style="text-align:center;"><b>'.$kode.'</b></td>

                    </tr>

                </table>

            </body>

            </html>';



        $config = [

            'mailtype'  => 'html',

            'charset'   => 'utf-8',

            'protocol'  => 'smtp',

            'smtp_host' => 'mail.ksudanamandiri.com',

            'smtp_user' => 'info@ksudanamandiri.com',    // Ganti dengan email gmail kamu

            'smtp_pass' => 'ksudanamandiri',      // Password gmail kamu

            'smtp_port' => 26,

            'crlf'      => "rn",

            'newline'   => "rn",

        ];

        $this->load->library('email', $config);

        $this->email->from('info@ksudanamandiri.com', 'KSU Mandiri');

        $this->email->to($to); 

        $this->email->subject($subject);

        $this->email->message($htmlContent);

        if ($this->email->send()) {

            return true;

        } else {

            return false;

        }

    }

    function send_sms($destination, $message){
        $user_sms	 	= urlencode("5emsyn");
        $pass_sms		= urlencode("2EbRuf7s@");
        
        $fp="https://reguler.zenziva.net/apps/smsapi.php?userkey=5emsyn&passkey=2EbRuf7s@&nohp=$destination&pesan=$message";
        echo $fp;die;
        $http = curl_init($fp);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($http, CURLOPT_SSL_VERIFYPEER, false);
        
        $http_result = curl_exec($http);
        $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
        curl_close($http);
        $xml=simplexml_load_string($http_result) or die("Error: Cannot create object");
        
        if($xml->message->status==0){
            return true;
        }else{
            return false;
        }
    }

}

