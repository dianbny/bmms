<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/pertamina.png" type="image/gif">
    <link rel="stylesheet" type="text/css" href="assets/css/_style_login.css">
    <link rel="stylesheet" type="text/css" href="assets/vendors/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Halaman Login</title>
</head>
<body>
    
    <!-- Container -->
    <div class="container animate__animated animate__fadeInDown">

        <!-- Atas/Header Container -->
        <div class="top">
            <div class="icon">
                <img src="assets/images/pertamina.png" alt="Pertamina">
            </div>
            <div class="title">
                PERTAMINA <span style="color:red;">EP</span>
            </div>
        </div>
        <!-- Akhir Atas/Header Container -->


        <!-- Icon Form Login -->
        <div class="icon-form">
            <img src="assets/images/user.png" alt="User">
            <h3>L O G I N</h3>
        </div>
        <!-- Akhir Icon Form Login -->

        <!-- Form Login -->
        <form method="POST" action="act-login">
            <div class="withIcon">
                <input type="text" name="username" class="input-text" placeholder="Username" autocomplete="off" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="withIcon">
                <input type="password" name="password" class="input-text" placeholder="Password" autocomplete="off" required>
                <i class="fa fa-key"></i>
            </div>

            <input type="submit" name="login" value="Login" class="submit-button">
        </form>
        <!-- Akhir Form Login -->

        <!-- Bawah/Footer Container -->
        <div class="container-footer">
            <div>
                <div class="listImg">
                    <img src="assets/images/bumn.png" alt="BUMN" style="width:100px;">
                </div>
                <div class="listImg">
                    <img src="assets/images/akhlak.png" alt="Akhlak" style="width:70px;">
                </div>
            </div>
        </div>
        <!-- Akhir Bawah/Footer Container -->

    </div>
    <!-- Akhir Container -->

    <!-- Footer Halaman -->
    <div class="footer">
        Bunyu Medical Management System | &copy; Copyright Pertamina EP Bunyu Field
    </div>
    <!-- Akhir Footer -->

    <!-- Script JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <script>
        var load = document.getElementById('load');

        window.addEventListener('load', function(){
            load.style.display = "none";
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

</body>
</html>