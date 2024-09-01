<?php
    error_reporting(0);
    require_once '../config/_getData.php';
    $getData = new _getData();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/pertamina.png" type="image/gif">
    <link rel="stylesheet" type="text/css" href="assets/css/_style_page.css">
    <title>Cek Akun User</title>

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        
</head>
<body>
    <?php
        if(isset($_POST['login'])){
            if(!preg_match("/^[a-zA-Z0-9 .]*$/", $_POST['username'])){ ?>
                <script>
                    setTimeout(function() { 
                        swal({
                            title: "Terjadi Kesalahan !",
                            text: "Username tidak boleh mengandung karakter khusus !",
                            type: "error",
                            confirmButtonText: "OK"
                            },
                                function(isConfirm){
                                    if (isConfirm) {
                                        window.location.href = "daftar-pegawai";
                                    }
                        }); }, 500);
                </script>
      <?php }
            else {
                $user = $_POST['username'];
                $pass = md5($_POST['password']);
    
                if($getData->cekLogin($user, $pass) == TRUE){
    
                    session_start();
                    
                    $_SESSION['status'] = "TRUE";
                    $_SESSION['username'] = $user;
                    ?>
                    
                    <script>    
                        window.location.href = "dashboard";
                    </script>
                    
        <?php }
                else { ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pastikan anda telah terdaftar pada sistem !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                function(isConfirm){
                                    if (isConfirm) {
                                        window.location.href = "login";
                                    }
                        }); }, 500);
                    </script>
        <?php } 
                
            }
        }
        else { ?>
            <script>    
                window.location.href = "logout";
            </script>
  <?php }
    ?>

    <!-- Script Javascript -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
</body>
</html>

