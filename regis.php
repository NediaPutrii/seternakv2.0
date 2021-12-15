<?php 
session_start();
require('function-user.php');
$obj = new Db_Class();

$error = '';
$validate = '';
if (isset($_POST['submit']) and !empty($_POST['submit'])){
    $uname = $_POST['username'];
    $query =pg_query($dbconn,"SELECT * FROM public.user WHERE username='$uname'");
    $cekid =  pg_affected_rows($query);
    if($cekid>0){
        $error =  'Username sudah digunakan !!';
    }else{
        $data   = pg_fetch_assoc($query);
        $pass = $_POST['password'];
        $repass = $_POST['repassword'];
        
        if($pass==$repass){
            $_SESSION['username'] = $uname;

            $ret_val = $obj->createUser();
            if($ret_val==1){
                $role = $_POST['role'];
                if($role==1){
                    $ret_val2 = $obj->tambahMitra();
                    if($ret_val2==1){
                        echo '<script>'; 
                        echo 'alert("Anda telah terdaftar sebagai User");'; 
                        echo 'window.location.href = "login.php";';
                        echo '</script>';
                
                    }else{
                        echo '<script>'; 
                        echo 'alert("Gagal menyimpan data");'; 
                        echo 'window.location.href = "regis.php";';
                        echo '</script>';
                    }
                }else if($role=2){
                    $ret_val1 = $obj->tambahPeternak();
                    if($ret_val1==1){
                        echo '<script>'; 
                        echo 'alert("Anda telah terdaftar sebagai Peternak");'; 
                        echo 'window.location.href = "login.php";';
                        echo '</script>';
                
                    }else{
                        echo '<script>'; 
                        echo 'alert("Gagal menyimpan data");'; 
                        echo 'window.location.href = "regis.php";';
                        echo '</script>';
                    }
                }
            // echo '<script>'; 
            // echo 'alert("Record Saved Successfully");'; 
    
            // echo 'window.location.href = "login.php";';
            
            
            // echo '</script>';
                
        }
            
        }else{
            $validate = 'Password tidak sama !!';
        }
        
    }
}


	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">


    <title>Daftar Seternak</title>
    <style>
        body{
            background-image: url(assets/bg-login.png);
            background-attachment: fixed;
            background-position: center center;
            background-repeat: no-repeat;
            background-size:cover;
        }
        #kartu{
            margin:50px auto;
            margin-top: 10%;;
           
        }
     
    </style>
</head>
<body>
<div class="container">

  <div id="kartu" class="card" style="max-width: 600px;border:none;">
    <div class="row g-0">
      <div class="col-md-0">
        <div class=text-center>
        <!-- <img src="assets/ayam1.jpg" class="img-fluid" alt="...""> -->
        <div class="card bg-dark text-white" style="border:none;">
        <img src="assets/bghero.png" class="img-fluid" alt="..."style=border:none;">
          <div class="card-img-overlay text-start" style="margin-top:20%;">
            <h4 class="card-title">Daftar</h4>
            <p class="card-text">Silahkan daftar untuk melanjutkan akses</p>
          </div>
        </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card-body">

          <ul class="list-group list-group-horizontal">
            <li class="list-group-item" style="border: none"><img src="assets/logop.jpg" class="img-fluid" alt="..." style="max-width: 25px;"></li>
            <li class="list-group-item" style="border: none;align:text-end;"><b><h5 class="card-title" style="color:#0E8550;">Seternak</h5></b></li>
          </ul>
          <ul class="list-group list-group-horizontal">
            <li class="list-group-item" style="border: none"><h5 class="card-tittle" style="color:#0E8550;">Selamat Datang di Seternak</h5></li>
          </ul>
        
          <div style="padding:12px;">
          <?php if($error != ''){ ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>
        <form class="row g-3" method="post">
            <div class="col-sm-6">
                <label for="exampleFormControlInput1" class=" col-form-label col-form-label-sm">Name</label>
                <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="name" name="name" required>
            </div>
            <div class="col-sm-6">
                <label for="exampleFormControlInput1" class=" col-form-label col-form-label-sm">Username</label>
                <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="username" name="username" require>
            </div>
            <div class="col-12">
                <label for="exampleFormControlInput1" class=" col-form-label col-form-label-sm">Email address</label>
                <input type="email" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="name@example.com" name="email" require>
            </div>
            <!-- <div class="col-6">
                <label for="exampleFormControlInput1" class=" col-form-label col-form-label-sm">Confirm Email address</label>
                <input type="email" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="name@example.com" name="email" require>
            </div> -->
            <div class="col-md-12">
                <label for="exampleFormControlInput1" class=" col-form-label col-form-label-sm">Daftar sebagai</label>
                <select class="form-select" aria-label="Default select example" name="role" require>
                    <option value="1" >User</option>
                    <option value="2">Partner</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlInput1" class=" col-form-label col-form-label-sm">No. Telp</label>
                <input type="number" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="08XXXXXXX" name="contact" require>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlInput1" class="2 col-form-label col-form-label-sm">City</label>
                <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="Kota Payakumbuh" name="kota" require>
            </div>
            <div class="col-md-12">
                <label for="exampleFormControlTextarea1" class=" col-form-label col-form-label-sm">Address</label>
                <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="3" name="alamat" require></textarea>
            </div>
     
            <div class="col-md-12">
                <label for="exampleFormControlInput1" class=" col-form-label col-form-label-sm">Password</label>
                <div class="d-flex bd-highlight">
                    <input type="password" class="form-control form-control-sm" id="InputPassword" placeholder="password" name="password" pattern=".{8,12}" required title="8 to 12 characters" require>
                    <span id=showPassword data-toggle="tooltip" class="btn btn-success" title="Lihat Password"><i id="icon" class="bi bi-eye pt-2 text-light"></i></span>
                </div>
                <?php if($validate != '') {?>
                    <small class="text-danger"><?= $validate; ?></small>
                <?php }?>
            </div>
            <div class="col-md-12">
                <small><div id="passwordDescription"></div></small>
                <progress max="100" value="0" id="strength" style="width: 100%"></progress>
            </div>
            <div class="col-md-12">
                <label for="exampleFormControlInput1" class=" col-form-label col-form-label-sm">Confirm Password</label>
                <div class="d-flex bd-highlight">
                <input type="password" class="form-control form-control-sm" id="ConfirmPassword" placeholder="password" name="repassword" require>
                <span id=showPassword1 data-toggle="tooltip" class="btn btn-success" title="Lihat Password"><i id="icon1" class="bi bi-eye pt-2 text-light"></i></span>
                </div>
                <?php if($validate != '') {?>
                    <small class="text-danger"><?= $validate; ?></small>
                <?php }?>
            </div>
            <div class="col-12">
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-success" name="submit" value="Daftar">
              </div>
            </div>
            </form>

            
            <center><small><a href="login.php" class="link-success">Sudah punya akun?<b>Masuk</b></a></small></center>
             
            
          </div>
        
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
</body>
</html>


<script>
    var showPassword = document.getElementById('showPassword')
    var password = document.getElementById('InputPassword')
    var icon = document.querySelector('#showPassword i')
    
    showPassword.addEventListener('click', function(e) {
      if (password.type === 'password') {
        password.setAttribute('type', 'text')
        icon.classList.remove('bi bi-eye-slash')
        icon.classList.add('bi bi-eye')
      } else {
        password.setAttribute('type', 'password')
        icon.classList.remove('bi bi-eye')

        icon.classList.add('bi bi-eye-slash')

      }

    })

    var showPassword1 = document.getElementById('showPassword1')
    var confirmpassword = document.getElementById('ConfirmPassword')
    var icon = document.querySelector('#showPassword1 i')

    showPassword1.addEventListener('click', function(e) {
      if (confirmpassword.type === 'password') {
        confirmpassword.setAttribute('type', 'text')
        icon.classList.remove('bi bi-eye-slash')
        icon.classList.add('bi bi-eye')
      } else {
        confirmpassword.setAttribute('type', 'password')
        icon.classList.remove('bi bi-eye')

        icon.classList.add('bi bi-eye-slash')

      }

    })

  	var pass = document.getElementById("InputPassword")
  	pass.addEventListener('keyup', function(){
  		checkPassword(pass.value)
  	})

  	function checkPassword(InputPassword){
  		var strengthBar = document.getElementById("strength");
        var deskripsi = document.getElementById("passwordDescription");
        var desc = new Array();
        desc[0] = "Sangat Lemah";
        desc[1] = "Lemah";
        desc[2] = "Lebih Baik";
        desc[3] = "Medium";
        desc[4] = "Kuat";
        desc[5] = "Terkuat";

        var score = 0;
        if (InputPassword.length > 6) score++;
        
        //if password has both lower and uppercase characters give 1 point 
        if ( ( InputPassword.match(/[a-z]/) ) && ( InputPassword.match(/[A-Z]/) ) ) score++;
        if (InputPassword.match(/\d+/)) score++;
        if (InputPassword.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;
        if (InputPassword.length > 12) score++;
          document.getElementById("passwordDescription").innerHTML = desc[score];

  		switch(score){
  			//  akan menampilkan status progress bars sesuai Jika input sesuai karakter seperti dalam tanda bracket
  			case 0:
  					strengthBar.value = 0;
  					break
            case 1:
                    strengthBar.value = 10;
                    break
  			case 2:
  					strengthBar.value = 30;
  					break
  			case 3:
  					strengthBar.value = 50;
  					break
  			case 4:
  					strengthBar.value = 70;
  					break
  			case 5:
  					strengthBar.value = 100;
  					break
  		}
          
  	}

  </script>