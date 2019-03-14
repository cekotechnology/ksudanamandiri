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

<div class="panel panel-success">
    <div class="panel-heading" style="background:#009b4d;color:white;">
        <h4>Detail Transaksi</h4>
    </div>
    <div class="pane-body">
        
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="50px">
                                    <img src="https://tripay.co.id/assets/images/icons/icon-152x152.png" style="display: inline;width: 40px">
                                </td>
                                <td>
                                    <span class="text-success" style="font-color:#009b4d; vertical-align:middle; font-size: 20px;font-weight: bold;"><?= $data['produk']; ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <form id="form-container">
                    <input type='hidden' name='trxid' value='<?= $data['trxid']; ?>'>
                    <input type='hidden' name='harga' value='<?= $data['harga'] ?>'>
                    <input type='hidden' name='target' value='<?= $data['target']; ?>'>
                    <input type='hidden' name='status' value='<?= $data['status']; ?>'>
                    <input type='hidden' name='produk' value='<?= $data['produk']; ?>'>
                    <input type='hidden' name='tanggal' value='<?= $data['created_at']; ?>'>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="100px">Trx Id</td>
                                <td width="500px"><?= $data['trxid']; ?></td>
                                <td width="75px">Tanggal</td>
                                <td><?= $data['created_at']; ?></td>
                            </tr>
                            <tr>
                                <td>Target</td>
                                <td><?= $data['target']; ?></td>
                            </tr>
                            <tr>
                                <td>No Meter</td>
                                <td><?= $data['mtrpln']; ?></td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>Rp. <?= number_format((float)$data['harga']+100,0,".",","); ?></td>
                            </tr>
                            <tr>
                                <td>Token</td>
                                <td><?= $data['token']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <?php
                                    
                                    if($data['status']==1) {
                                        echo "<span style='font-color:#009b4d;' class='text-success'>Berhasil</span>";
                                    }elseif($data['status']==2){
                                        echo "<span style='font-color:red' class='text-danger'>Tidak Berhasil</span>";   
                                    }elseif($data['status']==0){
                                        echo "<span style='font-color:red' class='text-danger'>Sedang Proses</span>";   
                                    }
                                      ?></td>
                                
                                <?php 
                                    $query = $this->db->query("select * from dataewalet where trxid = ".$data['trxid']." limit 1");
                                    
                                    if($query->num_rows()>0){
                                        echo "<tr>";
                                            echo "<td>Kembalikan Dana</td>";
                                            echo "<td>Berhasil Dikembalikan</td>";
                                            echo "</tr>";
                                    }else{
                                        if($data['status']==2){
                                            echo "<tr>";
                                            echo "<td>Kembalikan Dana</td>";
                                            echo "<td><button type='button' class='btn btn-danger' onclick='kembalikan($(this))'>Kembalikan</button></td>";
                                            echo "</tr>";
                                        } 
                                    }
                                    
                                ?>                                  
                            </tr

                        </tbody>
                    </table>
                    </form>
                              
                </div>      
            </div>
            <div class="panel-footer">
                <span>Catatan: <?= $data['note']; ?></span>
                
            </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    function kembalikan(button){
        var object = $("#form-container").serialize();
        
        $.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
        
        $.ajax({
            url : '<?=base_url("ppob_c/refund_tripay"); ?>',
            type : 'POST',
            dataType : 'json',
            data : object,
            success : function(response){
                if(response.success==true){
                    Swal.fire({
                        type: 'success',
                        title: 'berhasil',
                        text: response.message,
                    }).then((result) => {
                        if (result.value) {                        
                            location.reload();
                        }
                    })
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Gagal',
                        text: response.message,
                    }).then((result) => {
                        if (result.value) {                        
                            location.reload();
                        }
                    })
                }
            }
        })
    }
</script>