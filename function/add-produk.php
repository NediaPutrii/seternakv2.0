<?php
    include '../koneksi.php';

    $id_produk = $_POST['id_produk'];
    $id_peternak = $_POST['id_peternak'];
    $nama_produk = $_POST['nama_produk'];
    $id_peternak = $_POST['id_peternak'];
    $harga = $_POST['harga'];
    $satuan = $_POST['satuan'];
    $waktu_produksi = $_POST['waktu_produksi'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $stock = $_POST['stock'];
    // $tanggal = date("d-m-Y");
    // var_dump ($waktu_produksi);

    $sql = pg_query($conn,"SELECT * FROM update_harga ORDER BY tanggal asc limit 1");
    $limit = pg_fetch_assoc($sql);



    $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
    $foto = $_FILES['foto']['name'];
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];	

 

    if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
        if($ukuran < 1044070000){	
            move_uploaded_file($file_tmp, '../assets/produk/'.$foto);
            if($nama_produk=="Telur ayam"){
               
                if($harga>$limit['harga_telur']){
                    $query = pg_query("INSERT INTO produk (id_produk, id_peternak, nama_produk, harga, foto, deskripsi_produk, stok, satuan, waktu_produksi) 
                    VALUES ('$id_produk', '$id_peternak', '$nama_produk', $harga, '$foto', '$deskripsi_produk', $stock, '$satuan', '$waktu_produksi')");
                }else{
                    $message = "Harga Telur kurang dari minimal harga harian";
                    echo "<script>alert('Harga Telur kurang dari minimal harga harian');
    window.location = '../index-produksaya.php?berhasil=yes';</script>";


                    // echo "<script>
                    // alert ('Harga Telur kurang dari minimal harga harian');
                    // </script>";
                    // header("location:../index-produksaya.php?berhasil=yes");
                }
            }elseif($nama_produk=="Daging ayam"){
                if($harga>$limit['harga_daging']){
                    $query = pg_query("INSERT INTO produk (id_produk, id_peternak, nama_produk, harga, foto, deskripsi_produk, stok, satuan, waktu_produksi) 
                    VALUES ('$id_produk', '$id_peternak', '$nama_produk', $harga, '$foto', '$deskripsi_produk', $stock, '$satuan', '$waktu_produksi')");
                }else{
                    $message = "Harga Daging Ayam kurang dari minimal harga harian";

                    echo "<script>alert('Harga Daging Ayam kurang dari minimal harga harian');
                    window.location = '../index-produksaya.php?berhasil=yes';</script>";
                
                    // echo "<script>
                    // alert ('Harga Daging Ayam kurang dari minimal harga harian');
                    // </script>";
                    // header("location:../index-produksaya.php?berhasil=yes");
                }
            }

            if($query){
                $message = "Data berhasil ditambahkan";
                echo "<script>alert('Data Successfully Added');
                window.location = '../index-produksaya.php?berhasil=yes';</script>";
            
                // echo "<script>
                //     alert ('Data Successfully Added');
                // </script>";
                // header("location:../index-produksaya.php?berhasil=yes");
                
            }else{
                $message = "Data TIDAK berhasil ditambahkan";

                echo "<script>alert('Data Unsuccessfully Added');
                window.location = '../index-produksaya.php?berhasil=no';</script>";
                
                // echo "<script>
                //     alert ('Data Unsuccessfully Added');
                // </script>";
                // header("location:../index-produksaya.php?berhasil=no");
                
            }
        }else{
            $message = "Ukuran File terlalu besar";

            echo "<script>alert('UKURAN FILE TERLALU BESAR');
            window.location = '../index-produksaya.php?berhasil=no';</script>";
            
            // echo 'UKURAN FILE TERLALU BESAR';
            // header("location:../index-produksaya.php?berhasil=no");
        }
    }else{
        $message = "Ekstensi File yang di upliad tidak diperbolehkan";
        
        echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        header("location:../index-produksaya.php?berhasil=no");
    }

//     echo '<script language="Javascript" type="text/javascript">';
// echo     'alert('. json_encode($message) .');';
// echo '</script>';
// header("location:../index-produksaya.php");


?>
