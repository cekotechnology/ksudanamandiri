<meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?=base_url(); ?>/asset/countdown/dscountdown.css">
  
  <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?=base_url(); ?>/asset/js/blockui.js"></script>
  <script src="<?=base_url(); ?>/asset/countdown/dscountdown.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

  
<div class="panel panel-primary">
    <div class="panel-heading">List Order On-Time 
        <div class="pull-right"></div>
    </div>
    <div class="panel-body">
    <form method="POST" action="/member/history_toko/insert_history">
        <!-- <h2>Email : <?= $email ?>-->
        </h2><input type="hidden" name="data[created]" value="<?= $email ?>"> 
        <input type="hidden" name="data[tanggal_order]" value="<?= $tgl_order ?>">
        <!-- <h2>Id Order : <?= $order_id ?>
        </h2> -->
        <h2>Daftar Pembelian</h2>
        <input type="hidden" id="idorder" name="data[order_id]" value="<?= $order_id ?>">
        <div class="table-responsive">
        <table class="table table bordered">
            <tr>
                <th>Transaksi Detail</th>
                <th>Qty</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
            <?php $total_all = 0 ?>
            <?php foreach ($order_all as $key => $value) { ?>
                <input type="hidden" name="data[id_produk][]" value="<?= $value['id'] ?>">
                <tr>
                    <td><a href="<?= $value['view_order_url'] ?>" title="pilih untuk melihat detail" target="_blank"><?= "Pesanan - ".$value['order_number'] ?></a><input type="hidden" name="data[nama_produk][]" value="<?= $value['name'] ?>"></input></td>
                    
                    <td><?= $value['total_line_items_quantity'] ?><input type="hidden" name="data[quantity][]" value="<?= $value['total_line_items_quantity'] ?>"></td>
                    <td>
                        <?php if($value['status']=="on-hold"){
                        echo "<span class='label label-danger'>Belum Dibayar</span>";
                    }elseif($value['status']=="completed"){
                        echo "<span class='label label-success'>Pesanan Diterima</span>"; 
                    }elseif($value['status']=="refunded"){
                        echo "<span class='label label-default' style='background: black; color:white;'>Dana Dikembalikan</span>"; 
                    }else{
                        echo "<span class='label label-success'>Sedang Proses</span>"; 
                    }
                        
                        ?>                        

                    </td>
                    <td><?= date('d-m-Y H:i:s', strtotime($value['created_at'])); ?></td>
                    <td><?= number_format($value['total'],2,",","."); ?></td>
                    <td>

                         <?php if($value['status']=="on-hold"){
                        echo '<button class="btn btn-danger" type="button" data-id="'.$value["id"].'"  data-total="'.$value["total"].'"data-toggle="modal" data-target="#myModal" >Bayar</button>';
                    }elseif($value['status']=="completed"){
                        echo '<button class="btn btn-success" type="button" >Sudah Terbayar</button>'; 
                    }elseif($value['status']=="refunded"){
                        echo '<button class="btn btn-default"  type="button" style="background: black; color:white;">Dana Dikembalikan</button>'; 
                    }else{
                        echo '<button class="btn btn-success" type="button" >Sudah Terbayar</button>'; 
                    }
                        
                        ?> 
                    </td>
                </tr>
                <?php $total_all = $total_all + $value['total'] ?>
            <?php } ?>
            <tr>
                <th colspan=4 text-align:right>Total</th>
                <td>Rp. <?= number_format($total_all,2,",",".") ?>
                    <input type="hidden" value="<?= $total_all; ?>" id="total">
                </td>
                <td></td>
            </tr>
        </table>
        </div>
        
    </form>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            
            <div class="table-responsive">
                <input type="hidden" class="form-control" id="order_id" value="">
                <input type="hidden" class="form-control" id="total" value="">
                <input type="password" class="form-control" id="password" placeholder="silahkan isi password anda">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success" onclick="konfirmasi()">Konfirmasi</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

    </div>
    <?php if(count($order_all[0]['item_orders']) > 0): ?>
    <div class="panel-footer" id="konfirmasi-div" >
        <div class="row">
            <div class="col-md-8" style="display:block;" id="input_verifikasi">
                <input type="text" class="form-control" id="key" placeholder="masukan kunci terakhir yang di terima">            
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" id="konfirmasi">
                    Konfirmasi Pembayaran
                </button>
            </div>
    </div>    
    <?php endif ?>
</div>

<script>
function konfirmasi(){
    $.blockUI({ css: { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#000', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: .5, 
        color: '#fff' 
    } }); 
    $("#myModal").modal('hide')
    $.ajax({
        url : '<?=base_url('history_toko/konfirmasi_pembayaran'); ?>',
        type: "POST",
        data : {password : $("#password").val(),order_id : $("#order_id").val(),total : parseFloat(total)},
        dataType : "json",
        success : function(data){
            setTimeout($.unblockUI, 2000); 

            if(data.error==0){
                Swal.fire({
                    type: 'success',
                    title: 'berhasil',
                    text: data.message,
                }).then((result) => {
                    if (result.value) {                        
                        location.reload();
                    }
                })
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Gagal',
                    text: data.message,
                }).then((result) => {
                    if (result.value) {                        
                        location.reload();
                    }
                })
            }
            
        }
    })
}
var total= 0;

// function show_modal(button){
//     $('#myModal').modal('show')
    
//     var order_id = button.data('id') // Extract info from data-* attributes
//     total = button.data('total') // Extract info from data-* attributes

//     var modal = $("#myModal")
//     modal.find('.modal-title').text('Konfirmasi Untuk OrderId ' + order_id)
//     modal.find("#order_id").val(order_id)
//     modal.find("#total").val(parseFloat(total))
//}

$(document).ready(function(){
    

    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var order_id = button.data('id') // Extract info from data-* attributes
        total = button.data('total') // Extract info from data-* attributes

        var modal = $(this)
        modal.find('.modal-title').text('Konfirmasi Untuk OrderId ' + order_id)
        modal.find("#order_id").val(order_id)
        modal.find("#total").val(parseFloat(total))
        $.ajax({
            url : '<?=base_url('history_toko/get_order_id_detail'); ?>',
            type: "POST",
            data : {order_id : order_id, total : total},
            dataType : "json",
            success : function(data){
                
            }
        })
    })

    $("#konfirmasi").click(function(){        
        message = false;
        var key_input = $("#key").val();
        //console.log(key_input)
        //$("#input_verifikasi").show();
        //$(".progress").css('display','block');
        var button = $(this)
        
         var url = "";
        // if(key_input == undefined || key_input == "" || key_input == null){
        //     url += "<?=base_url('history_toko/send_verifikasi'); ?>";
        // }else{
            url = "<?=base_url('history_toko/get_verifikasi'); ?>";
        //}
        $("#myModal").modal('hide')
        $.ajax({
            url : url,
            type : "POST",
            data : {email : "<?=$email; ?>", key : key_input, idorder : $("#idorder").val(), total : $("#total").val() },
            dataType : "json",
            success : function(data){
                if(data.message == true){
                    Swal.fire({
                        type: 'success',
                        title: 'berhasil',
                        text: 'pembayaran berhasil!',
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                    
                }else{
                     Swal.fire({
                        type: 'error',
                        title: 'gagal',
                        text: 'Password salah!',
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                }
            }
        })

        // var counter = 0;
        // var total = 100;
        // var hasil = 0;
        // var interval = setInterval(function() {
        //     counter++;
        //     hasil = ((counter /60)*100).toFixed(0)
            
        //     $('.progress-bar').css('width', hasil+"%");
        //     $('.progress-bar').text(hasil+"%")
        //     if (counter == 90 || message == true) {
        //         $("#key").val(null)
        //         clearInterval(interval);
        //         $('.progress-bar').text("selesai")
        //         $("#input_verifikasi").hide();
        //         $(".progress").css('display','none');
        //         button.text("Konfirmasi Pembayaran");
        //         location.reload();
        //         if(message==true){

        //             Swal.fire({
        //                 type: 'success',
        //                 title: 'berhasil',
        //                 text: 'Berhasil konfirmasi pembayaran!',
        //             }).then((result) => {
        //                 if (result.value) {
        //                     location.reload();
        //                 }
        //             })
        //         }
        //     }
        // }, 1000);
    })
});
</script>