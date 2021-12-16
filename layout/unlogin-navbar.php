
<!-- Navbar -->
<?php 
session_start();
if(isset($_SESSION['role'])){
    echo $_SESSION['role'];}
?>
<nav class="navbar navbar-expand-lg navbar-dark hijau shadow fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php#home">
            <img src="assets/logop.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ">
            <a class="mx-4 nav-link text-light " aria-current="page" href="index.php#home">Seternak</a>
            <a class="mx-4 nav-link  text-light" href="index.php#tahukahkamu">Tahukah Kamu</a>
            <a class="mx-4 nav-link text-light" href="tentangkami.php">Tentang Kami</a>
        </div>
        <?php
            if (!isset($_SESSION['role'])) {
            ?>
        
            <div class="ms-auto">
                <a href="regis.php" class="btn btn-light mx-1 text-success shadow px-4">Daftar</a>
                <a href="login.php" class="btn btn-success mx-1 hijau shadow px-4">Masuk</a>
            </div>
        <?php }else{ 
                    
                    $link= "index-ahli.php";

                    if ($_SESSION['role']=="2"){
                        $link = "index-produksaya.php";
                    }if ($_SESSION['role']=="1"){
                        $link= "index-pasar.php";
                    }

            ?>
            <a class="mx-4 ms-auto nav-link text-light" href="<?php echo $link; ?>">Home</a>
        <?php } ?>   
        </div>
    </div>
</nav>
<!-- Navbarend -->