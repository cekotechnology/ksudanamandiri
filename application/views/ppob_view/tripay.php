<?php
/**
 * @Author: Cekotechnology
 * @Date:   2019-02-02 16:25:00
 * @Last Modified by:   Cekotechnology
 * @Last Modified time: 2019-02-03 10:03:29
 * Phone: 0878200000778
 * WA: 087820000778
 * Hotline: (024) 765 30086
 * Email: info@cekotechnology.com
 * Website: www.cekotechnology.com
 */
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


<style type="text/css">
	.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
		color: #5cb85c;
	}
	.nav-tabs>li>a{
		color: black;
	}
	.panel-primary > .panel-heading{
		background: #5cb85c;
	}
</style>

<div class="panel panel-primary">
<div class="panel-heading">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="background: white; color:black;">
		<li role="presentation" class="active">
			<a href="#all-operator" id="all_operator" data-tab="all-operator" data-kategori="1" onclick="show_content('pembelian',1)" aria-controls="all-operator" role="tab" data-toggle="tab">
			<i class="fa fa-mobile"></i> 
			Pulsa All Operator
			</a>
		</li>
		<li role="presentation">
			<a href="#paket-data"  id="paket_data" data-tab="paket-data" data-kategori="2" onclick="show_content('pembelian',2)" aria-controls="paket-data" role="tab" data-toggle="tab">
			<i class="fab fa-internet-explorer"></i>
			Paket Data
			</a>
		</li>
		<li role="presentation">
			<a href="#gojek" aria-controls="ojek" id="ojek" data-tab="gojek" data-kategori="3" onclick="show_content('pembelian',3)"  role="tab" data-toggle="tab">
			<i class="fa fa-motorcycle"></i>
			Saldo Ojek
			</a>
		</li>
		<li role="presentation">
			<a href="#token-listrik" id="token_listrik" data-tab="token-listrik" data-kategori="10" onclick="show_content('pembelian',10)" aria-controls="token-listrik" role="tab" data-toggle="tab">
			<i class="fa fa-bolt"></i>
			Token Listrik
			</a>
		</li>
		<li role="presentation">
			<a href="#voucher-game" id="voucher_game" data-tab="voucher-game" data-kategori="11" onclick="show_content('pembelian',11)" aria-controls="voucher-game" role="tab" data-toggle="tab">
			<i class="fa fa-gamepad"></i>
			Voucher Game
			</a>
		</li>
		<li role="presentation">
			<a href="#tagihan-pembayaran" id="tagihan" aria-controls="tagihan" data-tab="tagihan-pembayaran" onclick="show_content('pembelian','pembelian')" role="tab" data-toggle="tab">
			<i class="fa fa-building"></i>
			Tagihan
			</a>
		</li>
	</ul>
</div>
	<div class="panel-body">
	<div role="tabpanel">
		<form id="info-form-container">				
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="all-operator">
				
			</div>
			<div role="tabpanel" class="tab-pane" id="paket-data">
			</div>
			<div role="tabpanel" class="tab-pane" id="gojek">
			</div>
			<div role="tabpanel" class="tab-pane" id="token-listrik">
			</div>
			<div role="tabpanel" class="tab-pane" id="voucher-game">
				
			</div>
			<div role="tabpanel" class="tab-pane" id="tagihan-pembayaran">
			
			</div>
		</div>
	</form>
	</div>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">

	
    var flag = "";
	$( document ).ready(function() {
	    
	    $("#operator_1").select2({placeholder: "Pilih Operator"});
	    $("#produk_1").select2({placeholder: "Pilih Produk"});

	    //show_content("pembelian",1);
	    $('#myTab a').on('click', function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		  $("input").val(null)
		  $("select").val(null).trigger
		  var tab = e.currentTarget.dataset.tab;
		  var id = e.currentTarget.dataset.kategori;
		  
		  $("#"+tab).empty();
		  $("#all-operator").empty();
		  $("#paket-data").empty();
		  $("#gojek").empty();
		  $("#token-listrik").empty();
		  $("#voucher-game").empty();
		  $("#tagihan-pembayaran").empty();
		  
		  var jenis_transaksi = "";
		  if(tab=="all-operator"){
		      jenis_transaksi = "Pulsa";
		  }else if(tab=="paket-data"){
		      jenis_transaksi = "Paket Data";
		  }else if(tab=="gojek"){
		      jenis_transaksi = "Gojek";
		  }else if(tab=="token-listrik"){
		      jenis_transaksi = "Token Listrik";
		  }else if(tab=="voucher-game"){
		      jenis_transaksi = "Voucher Game";
		  }else if(tab=="tagihan-pembayaran"){
		      jenis_transaksi = "Tagihan Pembayaran";
		  }
		  
		  var html_produk = "";
		  if(jenis_transaksi == "Token Listrik"){
		      html_produk += '<div class="col-md-6">'+
				'<div class="form-group">'+
					'<label for="">'+
						'<h5>Produk</h5>'+
					'</label>'+
					'<select class="form-control" name="product" id="produk"></select>	'+
				'</div>'+
			'</div>'+
			'<div class="col-md-6">'+
				'<div class="form-group">'+
					'<label for="">'+
						'<h5>No Meter / ID. Pelanggan</h5>'+
					'</label>'+
					'<input type="number" class="form-control" name="no_meter_pln" placeholder="masukan no meter / Id Pelanggan">'+
				'</div>'+
			'</div>'
		  }else{
		      html_produk += '<div class="col-md-6">'+
				'<div class="form-group">'+
					'<label for="">'+
						'<h5>Operator</h5>'+
					'</label>'+
					'<select class="form-control" id="operator"></select>	'+
				'</div>'+
			'</div>'+
			'<div class="col-md-6">'+
				'<div class="form-group">'+
					'<label for="">'+
						'<h5>Produk</h5>'+
					'</label>'+
					'<select class="form-control" name="product" id="produk"></select>	'+
				'</div>'+
			'</div>'
		  }
		  
		  var html_pembelian = '<div class="row">'+
			'<div class="col-md-6 col-xs-12">'+
					'<div class="form-group">'+
						'<label for=""><h5>Nomor Pengisian</h5></label>'+
						'<input type="number" class="form-control" id="phone-1" name="phone" placeholder="masukan no handphone / rekening pengisian" id="" placeholder="Input field">'+
					'</div>'+						
					'<div class="row">'+ 
						html_produk +
					'</div>'+
					'<div class="row">'+
						'<div class="col-md-12">'+
							'<div class="form-group">'+
								'<label>Password</label>'+
								'<input type="password" class="form-control" name="password" placeholder="isi password login anda">'+
								'<input type="hidden" class="form-control" name="type" value="pembelian">'+
								'<input type="hidden" class="form-control" id="harga" name="harga" value="">'+
								'<input type="hidden" class="form-control" id="nama_product" name="nama_product" value="">'+
								'<input type="hidden" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="'+ jenis_transaksi +'">'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="row">'+
						'<div class="form-group">'+
							'<div class="col-md-12">'+
								'<button type="button" class="btn btn-success btn-save" onclick="transaksi()">Beli Sekarang</button>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'
		  
		  var html_pembayaran = '<div class="row">'+
				'<div class="col-md-6 col-xs-12">'+
						'<div class="row">'+
							'<div class="col-md-6">'+
								'<div class="form-group">'+
									'<label for="">'+
										'<h5>Pilih Provider/Operator</h5>'+
									'</label>'+
									'<select class="form-control"  id="operator_pembayaran"></select>	'+
								'</div>'+								
							'</div>'+
							'<div class="col-md-6">'+
								'<div class="form-group">'+
									'<label for="">'+
										'<h5>Jenis Tagihan</h5>'+
									'</label>'+
									'<select class="form-control" name="product"  id="jenis_tagihan"></select>	'+
								'</div>'+								
							'</div>	'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-md-6">'+
								'<div class="form-group">'+
									'<label for="">'+
										'<h5>Id. Pelanggan:</h5>'+
									'</label>'+
									'<input type="text" class="form-control" name="id_pelanggan" placeholder="masukan no pelanggan">'+
								'</div>'+								
							'</div>	'+
							'<div class="col-md-6">'+
								'<div class="form-group">'+
									'<label for="">'+
										'<h5>Nomor Hp Pembeli</h5>'+
									'</label>'+
									'<input type="text" id="phone-6" class="form-control" name="phone" placeholder="masukan nomor handphone">	'+
								'</div>'+								
							'</div>'+	
						'</div>'+
						'<div class="row">'+
							'<div class="col-md-12">'+
								'<div class="form-group">'+
									'<label>Password</label>'+
									'<input type="password" class="form-control" name="password" placeholder="isi password login anda">'+
									'<input type="hidden" class="form-control" name="type" value="pembayaran">'+
    								'<input type="hidden" class="form-control" id="harga" name="harga" value="">'+
    								'<input type="hidden" class="form-control" id="nama_product" name="nama_product" value="">'+
    								'<input type="hidden" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="'+ jenis_transaksi +'">'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row hidden-xs">'+
							'<div class="form-group">'+
								'<div class="col-md-12">'+
									'<button type="button" class="btn btn-success" onclick="transaksi()">Beli Sekarang</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row visible-md">'+
							'<div class="form-group">'+
								'<div class="col-md-12">'+
									'<button type="button" class="btn btn-block btn-success save-button" onclick="transaksi()">Bayar Sekarang</button>'+
								'</div>'+
							'</div>'+
						'</div>		'+
				'</div>'+
			'</div>'
		  
		  id_operator = "";
		  if(tab=="tagihan-pembayaran"){
		      flag = "pembayaran"
		    $("#"+tab).append(html_pembayaran) 
		    
		    $('#operator_pembayaran').select2({
    			allowClear: true,
    			width:"100%",
    			placeholder: 'Pilih Operator',
    			ajax: {
    				url: "/member/ppob_c/get_operator_pembayaran",
    				dataType: 'json',
    				delay: 250,
    				quietMillis: 50,
    				async:false,
    				data: function (params) {
    					return {
    						q: params.term,
    						page: params.page,
    						type: params.type,
    					};
    				},
    				processResults: function (data) {
    					var rData = [];
    					data.forEach(function(e) {
    
    						rData.push({
    							'id': e['id'],
    							'text': e['product_name'],
    						});
    					});
    
    					return {
    						results: rData
    					};
    				},
    				cache: true
    			}
    		}).on("change", function() {
    			id_operator = $(this).val();
    			// console.log(id_operator)
    			select_jenis.val(null).trigger('change')
            });    
            
            let select_jenis = $('#jenis_tagihan').select2({
    			allowClear: true,
    			width:"100%",
    			placeholder: 'Pilih Produk',
    			ajax: {
    				url: "/member/ppob_c/get_operator_pembayaran_byid/",
    				dataType: 'json',
    				delay: 250,
    				quietMillis: 50,
    				async:false,
    				data: function (params) {
    					return {
    						q: params.term,
    						page: params.page,
    						type: params.type,
    					};
    				},
    				processResults: function (data) {
    					var rData = [];
    					data.forEach(function(e) {
    
    						rData.push({
    							'id': e['code'],
    							'text': e['product_name'],
    							'harga': e['price'],
    						});
    					});
    
    					return {
    						results: rData
    					};
    				},
    				transport: function (params, success, failure) {
                            
                        params.url += id_operator;
                        var request = $.ajax(params);
                        request.then(success);
                        request.fail(failure);
    
                        return request;
                    },
    				cache: true
    			}
    		}).on('change', function(){
    		    
    		    if($(this).select2('data').length > 0  ){
    		        $("#harga").val($(this).select2('data')[0].harga);     
    		        $("#nama_product").val($(this).select2('data')[0].text);     
    		    }
    		    
    		});
		  }else{
		      
		      flag = "pembelian"
		    $("#"+tab).append(html_pembelian)  
		    
		    
		    $('#operator').select2({
			allowClear: true,
			width:"100%",
			placeholder: 'Pilih Operator',
			ajax: {
				url: "/member/ppob_c/api_operator/pembelian/"+id,
				dataType: 'json',
				delay: 250,
				quietMillis: 50,
				async:false,
				data: function (params) {
					return {
						q: params.term,
						page: params.page,
						type: params.type,
					};
				},
				processResults: function (data) {
					var rData = [];
					data.forEach(function(e) {

						rData.push({
							'id': e['id'],
							'text': e['product_name'],
						});
					});

					return {
						results: rData
					};
				},
				cache: true
			}
		}).on("change", function() {
			id_operator = $(this).val();
			// console.log(id_operator)
			select_produk.val(null).trigger('change')
        });
        
        if(tab=="token-listrik"){
	      id_operator = 50;
	      //select_produk.val(null).trigger('change')
	    }

    		let select_produk = $('#produk').select2({
    			allowClear: true,
    			width:"100%",
    			placeholder: 'Pilih Produk',
    			ajax: {
    				url: "/member/ppob_c/api_operator_produk/pembelian/",
    				dataType: 'json',
    				delay: 250,
    				quietMillis: 50,
    				async:false,
    				data: function (params) {
    					return {
    						q: params.term,
    						page: params.page,
    						type: params.type,
    					};
    				},
    				processResults: function (data) {
    					var rData = [];
    					data.forEach(function(e) {
    
    						rData.push({
    							'id': e['code'],
    							'text': e['product_name'],
    							'harga': e['price'],
    						});
    					});
    
    					return {
    						results: rData
    					};
    				},
    				transport: function (params, success, failure) {
                            
                        params.url += id_operator;
                        var request = $.ajax(params);
                        request.then(success);
                        request.fail(failure);
    
                        return request;
                    },
    				cache: true
    			}
    		}).on('change',function(){
    		    
    		    if($(this).select2('data').length > 0  ){
    		        $("#harga").val($(this).select2('data')[0].harga);     
    		        $("#nama_product").val($(this).select2('data')[0].text);     
    		    }
    		   
    		});
		  }
		  
		  
		})
	});


	function show_content(flag="pembelian",id){
		id_operator = "";
		$('.produk_list').val("");
		$('.op_list').val("");

		$('.div_cont').hide();
		$('#cat_'+id).show();
		$('.li_menu').removeClass("active");
		$('#li_'+id).addClass("active");
		
		if(flag=="pembayaran"){
    		$('#operator_pembayaran').select2({
    			allowClear: true,
    			width:"100%",
    			placeholder: 'Pilih Operator',
    			ajax: {
    				url: "/member/ppob_c/get_operator_pembayaran",
    				dataType: 'json',
    				delay: 250,
    				quietMillis: 50,
    				async:false,
    				data: function (params) {
    					return {
    						q: params.term,
    						page: params.page,
    						type: params.type,
    					};
    				},
    				processResults: function (data) {
    					var rData = [];
    					data.forEach(function(e) {
    
    						rData.push({
    							'id': e['id'],
    							'text': e['product_name'],
    						});
    					});
    
    					return {
    						results: rData
    					};
    				},
    				cache: true
    			}
    		}).on("change", function() {
    			id_operator = $(this).val();
    			// console.log(id_operator)
    			select_jenis.val(null).trigger('change')
            });    
            
            let select_jenis = $('#jenis_tagihan').select2({
    			allowClear: true,
    			width:"100%",
    			placeholder: 'Pilih Produk',
    			ajax: {
    				url: "/member/ppob_c/get_operator_pembayaran_byid/",
    				dataType: 'json',
    				delay: 250,
    				quietMillis: 50,
    				async:false,
    				data: function (params) {
    					return {
    						q: params.term,
    						page: params.page,
    						type: params.type,
    					};
    				},
    				processResults: function (data) {
    					var rData = [];
    					data.forEach(function(e) {
    
    						rData.push({
    							'id': e['code'],
    							'text': e['product_name'],
    						});
    					});
    
    					return {
    						results: rData
    					};
    				},
    				transport: function (params, success, failure) {
                            
                        params.url += id_operator;
                        var request = $.ajax(params);
                        request.then(success);
                        request.fail(failure);
    
                        return request;
                    },
    				cache: true
    			}
    		});
		}else{

		$('#operator_'+id).select2({
			allowClear: true,
			width:"100%",
			placeholder: 'Pilih Operator',
			ajax: {
				url: "/member/ppob_c/api_operator/"+ flag +"/"+id,
				dataType: 'json',
				delay: 250,
				quietMillis: 50,
				async:false,
				data: function (params) {
					return {
						q: params.term,
						page: params.page,
						type: params.type,
					};
				},
				processResults: function (data) {
					var rData = [];
					data.forEach(function(e) {

						rData.push({
							'id': e['id'],
							'text': e['product_name'],
						});
					});

					return {
						results: rData
					};
				},
				cache: true
			}
		}).on("change", function() {
			id_operator = $(this).val();
			// console.log(id_operator)
			select_produk.val(null).trigger('change')
        });

		let select_produk = $('#produk_'+id).select2({
			allowClear: true,
			width:"100%",
			placeholder: 'Pilih Produk',
			ajax: {
				url: "/member/ppob_c/api_operator_produk/"+ flag +"/",
				dataType: 'json',
				delay: 250,
				quietMillis: 50,
				async:false,
				data: function (params) {
					return {
						q: params.term,
						page: params.page,
						type: params.type,
					};
				},
				processResults: function (data) {
					var rData = [];
					data.forEach(function(e) {

						rData.push({
							'id': e['code'],
							'text': e['product_name'],
						});
					});

					return {
						results: rData
					};
				},
				transport: function (params, success, failure) {
                        
                    params.url += id_operator;
                    var request = $.ajax(params);
                    request.then(success);
                    request.fail(failure);

                    return request;
                },
				cache: true
			}
		});
		}
		
	}
//function transaksi(type, id){
//$(".btn-save").click(function(){
function transaksi(){
    var id = "";
    
    id = $(this).data('id');
    
	$.blockUI({ css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 

	var formData = new FormData();

	var formRawData = $('#info-form-container').serializeArray();
	
	var json_data = {data:{}};

	formRawData.forEach(function(element) {
		if(element.value!=""){
			formData.append(element.name, element.value);
			json_data[element.name] = element.value;
		}
	});

    $.ajax({
            type : "POST",
        url : "<?=base_url('ppob_c/post_transaksi'); ?>",
        dataType : "json",
        data : $("#info-form-container").serialize(),
        success : function(response){
            if(flag == "pembayaran"){
                
                if(response.success==true) {
                    
                    var order_id = response.data.id;
                    
                    const swalWithBootstrapButtons = Swal.mixin({
                      confirmButtonClass: 'btn btn-success',
                      cancelButtonClass: 'btn btn-danger',
                      buttonsStyling: false,
                    })
                    
                    swalWithBootstrapButtons.fire({
                      title: '<strong>Informasi <u>Pembayaran</u></strong>',
                      type: 'info',
                      html: '<table class="table table-bordered table-stripped">'+
                        '<tr>'+
                            '<td>Nama</td>'+
                            '<td>'+ response.data.nama +'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Periode</td>'+
                            '<td>'+ response.data.periode +'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Jumlah Tagihan</td>'+
                            '<td>'+ response.data.jumlah_tagihan +'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Biaya Admin</td>'+
                            '<td>'+ response.data.jumlah_tagihan +'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Jumlah Bayar</td>'+
                            '<td>'+ response.data.jumlah_bayar +'</td>'+
                        '</tr>'+
                      '</table>',
                       showCancelButton: true,
                      confirmButtonText: 'Bayar',
                      cancelButtonText: 'Batal',
                      reverseButtons: true
                    }).then((result) => {
                        if (result.value) {   
                            $.ajax({
                                url : '<?= base_url("ppob_c/pembayaran"); ?>',    
                                type : "POST",
                                dataType : "json",
                                data : {order_id : order_id},
                                success : function(res){
                                    if(res.success==true){
                                        
                                        swalWithBootstrapButtons.fire({
                                          title: 'Berhasil',
                                          text: res.message,
                                          type: 'success',
                                         
                                        }).then((result) => {
                                            if(result){
                                                location.reload()
                                            }
                                        })
                                    }
                                    
                                }
                            })
                            
                            //location.reload();
                        }else if (
                            // Read more about handling dismissals
                            result.dismiss === Swal.DismissReason.cancel
                        ){
                            // Read more about handling dismissals
                            result.dismiss === Swal.DismissReason.cancel
                        } 
                    })
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'gagal',
                        text: response.message,
                    }).then((result) => {
                        if (result.value) {                        
                            location.reload();
                        }
                    })
                }
            }else{
                if(response.success==true) {
    				Swal.fire({
                        type: 'success',
                        title: 'berhasil',
                        text: response.message,
                    }).then((result) => {
                        if (result.value) {                        
                            location.reload();
                        }
                    })
    			} else {
    				Swal.fire({
                        type: 'error',
                        title: 'gagal',
                        text: response.message,
                    }).then((result) => {
                        if (result.value) {                        
                            location.reload();
                        }
                    })
    			}    
            }
            
        }
    })
    
    
// 	var xhr = new XMLHttpRequest();

// 	xhr.open('POST', '/member/ppob_c/api_transaksi/', true);

// 	var onerror = function(event) {
// 		toastr.error("Error");
// 	}

// 	xhr.onload = function () {
// 		if (xhr.status === 200) {
// 			response = JSON.parse(xhr.responseText);
// 			setTimeout($.unblockUI, 2000); 

// 			if(response.success==true) {
// 				Swal.fire({
//                     type: 'success',
//                     title: 'berhasil',
//                     text: "Transaksi Berhasil",
//                 }).then((result) => {
//                     if (result.value) {                        
//                         location.reload();
//                     }
//                 })
// 			} else {
// 				Swal.fire({
//                     type: 'error',
//                     title: 'gagal',
//                     text: "Transaksi Gagal",
//                 }).then((result) => {
//                     if (result.value) {                        
//                         location.reload();
//                     }
//                 })
// 			}

			
// 		}
// 	};

// 	xhr.send(formData);

// 	return false;
}
</script>