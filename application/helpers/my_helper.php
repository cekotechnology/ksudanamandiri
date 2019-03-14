<?php

function get_jumlah_pinjaman($id_pinjam){
        $ci = & get_instance();
       
        $jml_pinjaman = $ci->db->where(array('id_pinjam' => $id_pinjam, 'status' => 'DITERIMA'))->get('pinjaman_header')->row('jumlah_disetujui');
        return $jml_pinjaman;
    }

function get_bunga_pinjaman($id_pinjam){
        $ci = & get_instance();
       
        $bunga = $ci->db->where(array('id_pinjam' => $id_pinjam))->get('pinjaman_header')->row('bunga');
        return $bunga;
    }

    function display_money($value, $currency = false, $decimal = 0)
    {
    
        switch (config_item('money_format')) {
            case 1:
                $value = number_format($value, $decimal, ',', '.');
                break;
            case 2:
                $value = number_format($value, $decimal, ',', '.');
                break;
            case 3:
                $value = number_format($value, $decimal, '.', '');
                break;
            case 4:
                $value = number_format($value, $decimal, '.', '');
                break;
            case 5:
                $value = number_format($value, $decimal, ".", "'");
                break;
            case 6:
                $value = number_format($value, $decimal, ".", " ");
                break;
            case 7:
                $value = number_format($value, $decimal, ".", " ");
                break;
            case 8:
                $value = number_format($value, $decimal, "'", " ");
                break;
            default:
                $value = number_format($value, $decimal, ',', '.');
                break;
        }
        switch (config_item('currency_position')) {
            case 1:
                $return = $currency . ' ' . $value;
                break;
            case 2:
                $return = $value . ' ' . $currency;
                break;
            case false:
                $return = $value;
                break;
            default:
                $return = $currency . ' ' . $value;
                break;
        }
    
        return $return;
    }