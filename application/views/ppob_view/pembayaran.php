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
<div class="panel-heading" >
    <h2>Pembayaran</h2>
</div>
<div class="panel-body">
    <ul class="nav nav-tabs">
    <?php foreach ($category as $key) { ?>
		<li role="presentation" id="li_<?= $key['id'] ?>" class="li_menu">
		
		<a href="#" onclick="show_content(<?= $key['id'] ?>)">
		<?= $key['name'] ?>
		</a>
		
		</li>
	<?php } ?>
    </ul>
    <div class="col-md-6">
<form id="info-form-container">
	<?php foreach ($category as $key) { ?>
			<div id="cat_<?= $key['id'] ?>" class="div_cont" >
				<div class="row margin-top-10">
                    <label>Nomor Pengisian(nomor pelanggan)</label>
                    <input type="number" name="data[no_pelanggan]" class="form-control">
				</div>				
				<div class="row margin-top-10">					
                    <label>Provider/Operator</label>
                    <select class="form-control op_list" id="operator_<?= $key['id'] ?>" name=""></select>
				</div>				
				<div class="row margin-top-10"><label>Produk</label>
					<select class="form-control produk_list" id="produk_<?= $key['id'] ?>" name="data[product]"></select>
				</div>
				<div class="row margin-top-10"><label>Password</label>
					<input type="password" name="data[password]" class="form-control" placeholder="Masukkan password Anda">
				</div>
				<br>
				<div class="row">
					<input type="button" class="btn btn-primary save-button" value="Cek Pembayaran">
					<!-- <button type="button" id="cancel-button" class="btn btn-tutup">Tutup</button> -->
				</div>
			</div>
	<?php } ?>
</form>
</div>
<div class="col-md-6" id="status">
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
				url: "/member/ppob_c/api_operator/pembayaran/"+id,
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
				url: "/member/ppob_c/api_produk_by_op/pembayaran/",
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
							'text': e['product_name']+ " Biaya Admin "+e['biaya_admin'],
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

	xhr.open('POST', '/member/ppob_c/cek_pembayaran/', true);

	var onerror = function(event) {
		toastr.error("Error");
	}

	xhr.onload = function () {
		if (xhr.status === 200) {
			response = JSON.parse(xhr.responseText);

			if(response.error==0) {
				// notifsuccess(response.message);
                $("#status").append(
                    "<pre>"+
                    "<h4>"+ response.message +"</h4>"+
                    "</pre>"+
                    "<div>"+
                    "<input type='hidden' class='form-control' name='jumlah_bayar' value='"+ response.data.jumlah_bayar +"'>"+
                    "<input type='hidden' class='form-control' name='produk' value='"+ response.data.produk +"'>"+
                    "<input type='hidden' class='form-control' name='no_pelanggan' value='"+ response.data.no_pelanggan +"'>"+
                    "<input type='hidden' class='form-control' name='phone' value='"+ response.data.phone +"'>"+
                    "</div>"
                )

                setTimeout($.unblockUI, 2000); 
			} else {
				$("#status").append(
                    "<pre>"+
                    "<h4>"+ response.message +"</h4>"+
                    "</pre>"
                )

                setTimeout($.unblockUI, 2000); 
			}
		}
	};

	xhr.send(formData);

	return false;
});
</script>