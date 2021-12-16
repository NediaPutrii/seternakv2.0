<?php 
include('../koneksi.php');

$id_update = $_GET["id_harga"];

$hasil = pg_query("DELETE FROM update_harga WHERE id_update='$id_update'");

if($hasil)
{
	echo "<script>
				alert('data berhasil dihapus');
				document.location.href='../index-update-harga.php';
				
			</script>";
	} else{
		echo "			
			<script>
				alert('data gagal dihapus');
				document.location.href='../index-update-harga.php';
			</script>
		";
	}

?>