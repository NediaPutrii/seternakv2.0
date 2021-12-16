<?php
    include '../koneksi.php';

    $tanggal = date("d-m-Y");
    $id_harga = $_POST['id_harga'];
    $harga_telur = $_POST['harga_telur'];
    $harga_daging = $_POST['harga_daging'];

    $query = pg_query("INSERT INTO update_harga (
        id_update, tanggal, harga_telur, harga_daging) VALUES ('$id_harga','$tanggal',$harga_telur,$harga_daging)");


    if ($query){
        echo "<script>
        alert ('Data Successfully Added');
        </script>";
        header("location:../index-update-harga.php?berhasil=no");
    }else{
        echo "<script>
        alert ('Error');
        </script>";
        header("location:../index-update-harga.php?berhasil=no");

    }
?>
