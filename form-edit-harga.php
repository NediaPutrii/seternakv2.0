<?php
include 'koneksi.php';
$id_harga=$_GET['id_harga'];

include 'koneksi.php';
// $username =$_GET['username'];
session_start();
if($_SESSION['role']!="3"){
header("location:login.php?pesan=gagal");
}
$username = $_SESSION['username'];

$query=pg_query("SELECT * FROM update_harga WHERE id_update='$id_harga'");
$pecah=pg_fetch_assoc($query);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- owl caurasl min.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- owl caurasel Theme.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icon boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">


    <title>Seternak</title>


  </head>
  <body id="home">

  
  <!-- Navbar -->
    <?php 
        include('layout/admin-navbar.php');
    ?>
  <!-- Navbar -->



   <div class="container-lg mt-5">

    <form action="function/edit-harga.php" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
          <div class="card shadow-sm bg-body rounded">
            <div class="card-header shadow-sm bg-body rounded" style="background-color: white;">
              <div class="card-title ps-3 fw-bold">Form Edit Harga Harian Produk</div>
            </div>
            <div class="card-body">
              <div class="row">
                    <div class="mb-3 pe-5 ps-5">
                    <!-- <label for="id_harga" class="form-label">ID Harga Harian</label> -->
                    <input type="hidden" class="form-control" id="id_info" name="id_update"  value="<?php echo $pecah['id_update']; ?>" required>
                    </div>

                    <div class="mb-3 pe-5 ps-5">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $pecah['tanggal'] ?>"  required>
                    </div>

                    <div class="mb-3 pe-5 ps-5">
                    <label for="harga_telur" class="form-label">Harga Telur</label>
                    <input type="text" class="form-control" id="harga_telur" name="harga_telur"  value="<?php echo $pecah['harga_telur'] ?>" required>
                    </div>

                    <div class="mb-3 pe-5 ps-5">
                    <label for="harga_daging" class="form-label">Harga Telur</label>
                    <input type="text" class="form-control" id="harga_daging" name="harga_daging"  value="<?php echo $pecah['harga_daging'] ?>" required>
                    </div>

              </div>

              
              <div class="field" style="display: flex; justify-content: flex-start; padding: 1rem; margin-left:1rem;">
                  <button type="submit" name="edit" class="btn btn-success ps-4 pe-4">Submit</button>
              </div>


            </div>
          </div>
        </div>
      </div>

  </div>

  <!-- Footer -->
<?php include('layout/admin-footer.php'); ?>
<!-- Footer end -->

  </body>
