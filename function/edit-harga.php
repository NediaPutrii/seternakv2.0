<?php

include '../koneksi.php';

if(isset($_POST['edit']))
{
    $id_update = $_POST['id_update'];
    $tanggal = $_POST['tanggal'];
    $harga_telur = $_POST['harga_telur'];
    $harga_daging = $_POST['harga_daging'];

    $query = pg_query("UPDATE update_harga SET
    tanggal = '$tanggal', harga_telur = $harga_telur, harga_daging = $harga_daging WHERE
    id_update = '$id_update' ");

    if ($query){
        echo "<script>alert ('Data Successfully Change');</script>";
    }else{
        echo "<script>alert ('Error');</script>";
    }
    header("location:../index-update-harga.php?berhasil=yes");

}


?>