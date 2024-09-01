<?php
    error_reporting(0);
    session_start();
    require_once '../config/_getData.php';
    require_once '../config/_deleteData.php';
    $getData = new _getData();
    $deleteData = new _deleteData();

    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    } 

    //Waktu 
    date_default_timezone_set("Asia/Kuala_Lumpur");
    setlocale(LC_ALL, 'id-ID', 'id_ID');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/pertamina.png" type="image/gif">
    <link rel="stylesheet" type="text/css" href="assets/css/_style_page.css">
    <title>Save Data</title>

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        
</head>
<body>
    <?php
        if($_GET['action'] == "hapus-data-pekerja"){
            $id = $_GET['id'];
            $pageSuccess = ($_SESSION['page'] == "daftar-pegawai") ? $_SESSION['page'] : "daftar-tkjp-mk";

            $deleteData->hapusPekerja($id); ?>

                <script>
                    setTimeout(function() { 
                        swal({
                                title: "Informasi",
                                text: "Data berhasil terhapus",
                                type: "success",
                                confirmButtonText: "OK"
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    window.location.href="<?= $pageSuccess; ?>";
                                }
                    }); }, 500);
                </script>
  <?php }
        elseif($_GET['action'] == "hapus-data-checkup"){
            $id = $_GET['id'];

            $deleteData->hapusDCU($id); ?>

                <script>
                    setTimeout(function() { 
                        swal({
                                title: "Informasi",
                                text: "Data berhasil terhapus",
                                type: "success",
                                confirmButtonText: "OK"
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    window.location.href="data-checkup";
                                }
                    }); }, 500);
                </script>
  
  <?php }
        elseif($_GET['action'] == "hapus-data-visitor"){
            $id = $_GET['id'];

            $deleteData->hapusVisitor($id); ?>

                <script>
                    setTimeout(function() { 
                        swal({
                                title: "Informasi",
                                text: "Data berhasil terhapus",
                                type: "success",
                                confirmButtonText: "OK"
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    window.location.href="daftar-visitor";
                                }
                    }); }, 500);
                </script>
  <?php }
        elseif($_GET['action'] == "hapus-data-checkup-visitor"){
            $id = $_GET['id'];

            $deleteData->hapusDCUVisitor($id); ?>

                <script>
                    setTimeout(function() { 
                        swal({
                                title: "Informasi",
                                text: "Data berhasil terhapus",
                                type: "success",
                                confirmButtonText: "OK"
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    window.location.href="data-checkup-visitor";
                                }
                    }); }, 500);
                </script>
  
  <?php }
        elseif($_GET['action'] == "hapus-data-pengguna"){
            $id = $_GET['id'];

            $deleteData->hapusPengguna($id); ?>

                <script>
                    setTimeout(function() { 
                        swal({
                                title: "Informasi",
                                text: "Data berhasil terhapus",
                                type: "success",
                                confirmButtonText: "OK"
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    window.location.href="daftar-pengguna";
                                }
                    }); }, 500);
                </script>
  <?php }
        elseif($_GET['action'] == "hapus-data-perusahaan"){
            $id = $_GET['id'];

            $deleteData->hapusPerusahaan($id); ?>

                <script>
                    setTimeout(function() { 
                        swal({
                                title: "Informasi",
                                text: "Data berhasil terhapus",
                                type: "success",
                                confirmButtonText: "OK"
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    window.location.href="daftar-perusahaan";
                                }
                    }); }, 500);
                </script>
  <?php }
        elseif($_GET['action'] == "hapus-data-fungsi"){
            $id = $_GET['id'];

            $deleteData->hapusFungsi($id); ?>

                <script>
                    setTimeout(function() { 
                        swal({
                                title: "Informasi",
                                text: "Data berhasil terhapus",
                                type: "success",
                                confirmButtonText: "OK"
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    window.location.href="daftar-fungsi";
                                }
                    }); }, 500);
                </script>
  <?php }
                    
    ?>

    <!-- Script Javascript -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

</body>
</html>