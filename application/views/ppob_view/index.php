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

<div class="panel panel-primary">
<div class="panel-heading" style="color:white;">
    <h2>Pembelian</h2>
</div>
<div class="panel-body">
<form id="info-form-container">
<ul class="nav nav-tabs">
	<?php foreach ($category as $key) { ?>
		<li role="presentation" id="li_<?= $key['id'] ?>" class="li_menu">
		
		<a href="#" onclick="show_content(<?= $key['id'] ?>)">
		<?= $key['product_name'] ?>
		</a>
		
		</li>
	<?php } ?>
  
</ul>

	<?php foreach ($category as $key) { ?>
			<div id="cat_<?= $key['id'] ?>" class="div_cont" >
				<div class="row margin-top-10">
					<div class="col-md-6">
						<label>Nomor Pengisian</label>
						<input type="number" name="data[phone]" class="form-control">
					</div>
				</div>
				<br>
				<br>
				<div class="row margin-top-10">
					<div class="col-md-6">
						<label>Provider/Operator</label>
						<select class="form-control op_list" id="operator_<?= $key['id'] ?>" name=""></select>
					</div>
				</div>
				<br>
				<br>
				<div class="row margin-top-10">
					<div class="col-md-6">
						<label>Produk</label>
						<select class="form-control produk_list" id="produk_<?= $key['id'] ?>" name="data[code]"></select>
					</div>
				</div>
				
				<br>
				<br>
				<div class="row margin-top-10">
					<div class="col-md-6">
						<label>Password</label>
						<input type="password" class="form-control " placeholder="isi password" name="data[password]">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						<input type="button" class="btn btn-primary save-button" value="Beli">
						<!-- <button type="button" id="cancel-button" class="btn btn-tutup">Tutup</button> -->
					</div>
				</div>
			</div>
	<?php } ?>
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">

	

	$( document ).ready(function() {
	    $('.div_cont').hide();
	});

	function show_content(id){
		id_operator = "";
		$('.produk_list').val("");
		$('.op_list').val("");

		$('.div_cont').hide();
		$('#cat_'+id).show();
		$('.li_menu').removeClass("active");
		$('#li_'+id).addClass("active");

		$('#operator_'+id).select2({
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
        });

		$('#produk_'+id).select2({
			allowClear: true,
			width:"100%",
			placeholder: 'Pilih Produk',
			ajax: {
				url: "/member/ppob_c/api_produk_by_op/pembelian/",
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
$(".save-button").click(function(){
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

	// formData.append('data[ID]',id);

	var xhr = new XMLHttpRequest();

	xhr.open('POST', '/member/ppob_c/api_pembelian/', true);

	var onerror = function(event) {
		toastr.error("Error");
	}

	xhr.onload = function () {
		if (xhr.status === 200) {
			response = JSON.parse(xhr.responseText);
			setTimeout($.unblockUI, 2000); 

			if(response.success==true) {
				Swal.fire({
                    type: 'success',
                    title: 'berhasil',
                    text: "Transaksi Berhasil",
                }).then((result) => {
                    if (result.value) {                        
                        location.reload();
                    }
                })
			} else {
				Swal.fire({
                    type: 'error',
                    title: 'gagal',
                    text: "Transaksi Gagal",
                }).then((result) => {
                    if (result.value) {                        
                        location.reload();
                    }
                })
			}

			
		}
	};

	xhr.send(formData);

	return false;
});
</script>