<?php
    error_reporting(0);
    session_start();
    require_once '../config/_getData.php';
    require_once '../config/_saveData.php';
    $getData = new _getData();
    $saveData = new _saveData();

    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    } 

    //Waktu 
    date_default_timezone_set("Asia/Kuala_Lumpur");
    setlocale(LC_ALL, 'id-ID', 'id_ID');

    $username = $_SESSION['username'];

    $dataUserLogin = $getData->getDataUserLogin($username);

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
        if($_GET['action'] == "simpan-pekerja"){
            $pageSuccess = ($_SESSION['page'] == "tambah-data-pekerja") ? "daftar-pegawai" : "daftar-tkjp-mk";
            $pageErr = ($_SESSION['page'] == "tambah-data-pekerja") ? $_SESSION['page'] : "tambah-data-tkjp-mk";
            if(isset($_POST['save'])){
                if(!preg_match("/^[0-9A-Z-]*$/", $_POST['id'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID/Nomor Pekerja tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z .',]*$/", $_POST['name'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z]*$/", $_POST['gender'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jenis Kelamin tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z .'-]*$/", $_POST['placeofbirth'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tempat lahir tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9-\/]*$/", $_POST['birthday'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tanggal Lahir hanya boleh mengandung angka dalam format tanggal !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z0-9-]*$/", $_POST['function'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Fungsi tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z0-9-]*$/", $_POST['category'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Kategori tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z0-9-]*$/", $_POST['company'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Perusahaan tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z0-9& .',\/]*$/", $_POST['position'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jabatan tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z\/]*$/", $_POST['status'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Status tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {

                    if($getData->cekNopek($_POST['id']) < 1){

                        $id = $_POST['id'];
                        $nama = trim($_POST['name']);
                        $jk = $_POST['gender'];
                        $tempatlahir = trim($_POST['placeofbirth']);
                        $tgllahir = $_POST['birthday'];
                        $fungsi = $_POST['function'];
                        $kategori = $_POST['category'];
                        $perusahaan = $_POST['company'];
                        $jabatan = trim($_POST['position']);
                        $status = $_POST['status'];

                        $saveData->simpanPegawai($id, ucwords($nama), $jk, ucwords($tempatlahir), $tgllahir, $fungsi, $kategori, $perusahaan, ucwords($jabatan), $status); ?>

                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Informasi",
                                        text: "Data pekerja/TKJP/MK berhasil tersimpan",
                                        type: "success",
                                        confirmButtonText: "OK"
                                        },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "<?= $pageSuccess; ?>";
                                            }
                                }); }, 500);
                            </script>
            <?php   }
                    else { ?>
                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Terjadi Kesalahan !",
                                    text: "Nomor Pekerja Telah Terdaftar !",
                                    type: "error",
                                    confirmButtonText: "OK"
                                    },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "<?= $pageErr; ?>";
                                            }
                                }); }, 500);
                        </script>
              <?php }
                }
            }
            else { 
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "<?= $pageSuccess; ?>";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-update-pekerja"){  
            $id = $_GET['id'];
            $pageSuccess = ($_SESSION['page'] == "edit-data-pekerja") ? "daftar-pegawai" : "daftar-tkjp-mk";
            $pageErr = ($_SESSION['page'] == "edit-data-pekerja") ? $_SESSION['page']."-".$id : "edit-data-tkjp-mk-".$id;
            if(isset($_POST['save'])){
                if(!preg_match("/^[a-zA-Z .',]*$/", $_POST['name'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z]*$/", $_POST['gender'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jenis Kelamin tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z .'-]*$/", $_POST['placeofbirth'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tempat lahir tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9-\/]*$/", $_POST['birthday'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tanggal Lahir hanya boleh mengandung angka dalam format tanggal !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z0-9-]*$/", $_POST['function'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Fungsi tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z0-9-]*$/", $_POST['category'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Kategori tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z0-9-]*$/", $_POST['company'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Perusahaan tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z0-9& .',\/]*$/", $_POST['position'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jabatan tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z\/]*$/", $_POST['status'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Status tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $nama = trim($_POST['name']);
                    $jk = $_POST['gender'];
                    $tempatlahir = trim($_POST['placeofbirth']);
                    $tgllahir = $_POST['birthday'];
                    $fungsi = $_POST['function'];
                    $kategori = $_POST['category'];
                    $perusahaan = $_POST['company'];
                    $jabatan = trim($_POST['position']);
                    $status = $_POST['status'];

                    $saveData->updatePegawai($id, ucwords($nama), $jk, ucwords($tempatlahir), $tgllahir, $fungsi, $kategori, $perusahaan, ucwords($jabatan), $status); ?>

                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Informasi",
                                        text: "Data pekerja/TKJP/MK berhasil diperbarui",
                                        type: "success",
                                        confirmButtonText: "OK"
                                        },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "<?= $pageSuccess; ?>";
                                            }
                                }); }, 500);
                            </script>
                    <?php
                }
            }
            else { 
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "<?= $pageSuccess; ?>";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-checkup"){
            if(isset($_POST['save'])){
                $id = $_GET['id'];
                if(!preg_match("/^[0-9]*$/", $_POST['sistolik'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Sistolik hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['diastolik'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Diastolik hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['denyutnadi'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Denyut Nadi hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z .'\/]*$/", $_POST['complaint'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Keluhan tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    if($getData->cekDCUPekerja($id, date('d'), date('m'), date('Y')) < 1){
                        $tgl = date('Y-m-d');
                        $waktu = date('H:i:s');
                        $sistol = $_POST['sistolik'];
                        $diastol = $_POST['diastolik'];
                        $denyut = $_POST['denyutnadi'];
                        $keluhan = $_POST['complaint'];
                        $ket;

                        if($sistol > 139 || $diastol > 99){
                            $ket = "UNFIT";
                        }
                        else {
                            $ket = "FIT";
                        }

                        $saveData->simpanCheckup($id, $tgl, $waktu, $sistol, $diastol, $denyut, ucwords($keluhan), $ket, $dataUserLogin['_id_user']); ?>
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Informasi",
                                        text: "Data checkup berhasil tersimpan",
                                        type: "success",
                                        confirmButtonText: "OK"
                                        },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "data-checkup";
                                            }
                                }); }, 500);
                            </script>
             <?php  }
               }

            }
            else { 
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "data-checkup";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-update-checkup"){
            if(isset($_POST['save'])){
                $id = $_GET['id'];
                if(!preg_match("/^[0-9]*$/", $_POST['sistolik'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Sistolik hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-checkup-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['diastolik'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Diastolik hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-checkup-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['denyutnadi'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Denyut Nadi hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-checkup-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z .'-\/]*$/", $_POST['complaint'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Keluhan tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-checkup-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $tgl = date('Y-m-d');
                    $waktu = date('H:i:s');
                    $sistol = $_POST['sistolik'];
                    $diastol = $_POST['diastolik'];
                    $denyut = $_POST['denyutnadi'];
                    $keluhan = $_POST['complaint'];
                    $ket;

                    if($sistol > 139 || $diastol > 99){
                        $ket = "UNFIT";
                    }
                    else {
                        $ket = "FIT";
                    }

                    $saveData->updateCheckup($id, $tgl, $waktu, $sistol, $diastol, $denyut, ucwords($keluhan), $ket); ?>
                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data checkup berhasil diperbarui",
                                    type: "success",
                                    confirmButtonText: "OK"
                                    },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "data-checkup";
                                        }
                            }); }, 500);
                        </script>
          <?php }
            }
            else { 
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "data-checkup";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            } 
        }
        elseif($_GET['action'] == "simpan-visitor"){
            if(isset($_POST['save'])){
                if(!preg_match("/^[0-9]*$/", $_POST['id'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID/Nomor Pekerja hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-visitor";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z .',]*$/", $_POST['name'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-visitor";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z]*$/", $_POST['gender'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jenis Kelamin tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-visitor";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z0-9-]*$/", $_POST['agency'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Instansi tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-visitor";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['needs'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Keperluan tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-visitor";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    if($getData->cekIDVisitor($_POST['id']) < 1){

                        $id = $_POST['id'];
                        $nama = trim($_POST['name']);
                        $jk = $_POST['gender'];
                        $instansi = $_POST['agency'];
                        $keperluan = $_POST['needs'];

                        $saveData->simpanVisitor($id, ucwords($nama), $jk, $instansi, ucwords($keperluan)); ?>

                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Informasi",
                                        text: "Data visitor berhasil tersimpan",
                                        type: "success",
                                        confirmButtonText: "OK"
                                        },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "daftar-visitor";
                                            }
                                }); }, 500);
                            </script>
              <?php }
                    else { ?>
                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Terjadi Kesalahan !",
                                    text: "ID Visitor telah terdaftar !",
                                    type: "error",
                                    confirmButtonText: "OK"
                                    },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "daftar-visitor";
                                            }
                                }); }, 500);
                        </script>
             <?php  }
                }
            }
            else { 
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "daftar-visitor";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-update-visitor"){
            if(isset($_POST['save'])){
                $id = $_GET['id'];
                if(!preg_match("/^[a-zA-Z .',]*$/", $_POST['name'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z]*$/", $_POST['gender'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jenis Kelamin tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Z0-9-]*$/", $_POST['agency'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Instansi tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['needs'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Keperluan tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $nama = trim($_POST['name']);
                    $jk = $_POST['gender'];
                    $instansi = $_POST['agency'];
                    $keperluan = $_POST['needs'];

                    $saveData->updateVisitor($id, ucwords($nama), $jk, $instansi, ucwords($keperluan)); ?>

                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data visitor berhasil tersimpan",
                                    type: "success",
                                    confirmButtonText: "OK"
                                    },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "daftar-visitor";
                                        }
                            }); }, 500);
                        </script>
              <?php }
            }
            else { 
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "daftar-visitor";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-checkup-visitor"){
            if(isset($_POST['save'])){
                $id = $_GET['id'];
                if(!preg_match("/^[0-9]*$/", $_POST['sistolik'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Sistolik hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['diastolik'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Diastolik hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['denyutnadi'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Denyut Nadi hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z .'\/]*$/", $_POST['complaint'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Keluhan tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    if($getData->cekDCUVisitor($id, date('d'), date('m'), date('Y')) < 1){
                        $tgl = date('Y-m-d');
                        $waktu = date('H:i:s');
                        $sistol = $_POST['sistolik'];
                        $diastol = $_POST['diastolik'];
                        $denyut = $_POST['denyutnadi'];
                        $keluhan = $_POST['complaint'];
                        $ket;

                        if($sistol > 139 || $diastol > 99){
                            $ket = "UNFIT";
                        }
                        else {
                            $ket = "FIT";
                        }

                        $saveData->simpanCheckupVisitor($id, $tgl, $waktu, $sistol, $diastol, $denyut, ucwords($keluhan), $ket, $dataUserLogin['_id_user']); ?>
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Informasi",
                                        text: "Data checkup berhasil tersimpan",
                                        type: "success",
                                        confirmButtonText: "OK"
                                        },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "data-checkup-visitor";
                                            }
                                }); }, 500);
                            </script>
             <?php  }
               }

            }
            else { 
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "data-checkup-visitor";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-update-checkup-visitor"){
            if(isset($_POST['save'])){
                $id = $_GET['id'];
                if(!preg_match("/^[0-9]*$/", $_POST['sistolik'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Sistolik hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['diastolik'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Diastolik hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['denyutnadi'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Denyut Nadi hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z .'\/]*$/", $_POST['complaint'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Keluhan tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "input-data-checkup-visitor-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $tgl = date('Y-m-d');
                        $waktu = date('H:i:s');
                        $sistol = $_POST['sistolik'];
                        $diastol = $_POST['diastolik'];
                        $denyut = $_POST['denyutnadi'];
                        $keluhan = $_POST['complaint'];
                        $ket;

                        if($sistol > 139 || $diastol > 99){
                            $ket = "UNFIT";
                        }
                        else {
                            $ket = "FIT";
                        }

                        $saveData->updateCheckupVisitor($id, $tgl, $waktu, $sistol, $diastol, $denyut, ucwords($keluhan), $ket); ?>
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Informasi",
                                        text: "Data checkup berhasil diperbarui",
                                        type: "success",
                                        confirmButtonText: "OK"
                                        },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "data-checkup-visitor";
                                            }
                                }); }, 500);
                            </script>
        <?php   }

            }
            else { 
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "data-checkup-visitor";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-pengguna"){
            if(isset($_POST['save'])){
                if(!preg_match("/^[0-9A-Z-]*$/", $_POST['id'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID/Nomor Pekerja tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-pengguna";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z0-9 .',]*$/", $_POST['username'])){ ?>
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
                                            window.location.href = "tambah-data-pengguna";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z]*$/", $_POST['level'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Level User tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-pengguna";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    if($getData->cekNopek($_POST['id']) > 0){
                        if($getData->cekUsername($_POST['username']) < 1){
                            $id = $_POST['id'];
                            $username = $_POST['username'];
                            $password = md5($_POST['password']);
                            $level = $_POST['level'];

                            $saveData->simpanDataPengguna($id, $username, $password, $level); ?>

                                <script>
                                    setTimeout(function() { 
                                        swal({
                                            title: "Informasi",
                                            text: "Data pengguna baru berhasil tersimpan",
                                            type: "success",
                                            confirmButtonText: "OK"
                                            },
                                            function(isConfirm){
                                                if (isConfirm) {
                                                    window.location.href = "daftar-pengguna";
                                                }
                                    }); }, 500);
                                </script>
                  <?php }
                        else { ?>
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Terjadi Kesalahan !",
                                        text: "Username telah terdaftar !",
                                        type: "error",
                                        confirmButtonText: "OK"
                                        },
                                            function(isConfirm){
                                                if (isConfirm) {
                                                    window.location.href = "tambah-data-pengguna";
                                                }
                                    }); }, 500);
                            </script>
                  <?php }

                    }
                    else { ?>
                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Terjadi Kesalahan !",
                                    text: "No. Pekerja tidak terdaftar !",
                                    type: "error",
                                    confirmButtonText: "OK"
                                    },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "tambah-data-pengguna";
                                            }
                                }); }, 500);
                        </script>
              <?php }
                }
            }
            else {
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "daftar-pengguna";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-update-pengguna"){
            $id = $_GET['id'];
            if(isset($_POST['save'])){
                if(!preg_match("/^[a-zA-Z]*$/", $_POST['level'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Level User tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-pengguna-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $level = $_POST['level'];
                    $saveData->updateDataPengguna($id, $level); 
                    if(!empty($_POST['password'])){
                        $password = md5($_POST['password']);
                        $saveData->updatePassword($id, $password);
                        
                    } ?>

                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data pengguna baru berhasil diperbarui",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "daftar-pengguna";
                                    }
                                }); }, 500);
                        </script>
                    
          <?php }
            }
            else {
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "daftar-pengguna";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-perusahaan"){
            if(isset($_POST['save'])){
                if(!preg_match("/^[A-Z0-9-]*$/", $_POST['id_p'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID Perusahaan tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-perusahaan";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z. ]*$/", $_POST['nama_p'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama Perusahaan tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-perusahaan";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $id = $_POST['id_p'];
                    $name = $_POST['nama_p'];

                    $saveData->simpanDataPerusahaan($id, ucwords($name)); ?>

                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data perusahaan berhasil tersimpan",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "daftar-perusahaan";
                                    }
                                }); }, 500);
                        </script>

          <?php }
            }
            else {
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "dashboard";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-update-perusahaan"){
            $id = $_GET['id'];
            if(isset($_POST['save'])){
                if(!preg_match("/^[A-Z0-9-]*$/", $_POST['id_p'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID Perusahaan tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-perusahaan-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z. ]*$/", $_POST['nama_p'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama Perusahaan tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-perusahaan-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $name = $_POST['nama_p'];

                    $saveData->updatePerusahaan($id, ucwords($name)); ?>

                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data perusahaan berhasil diperbarui",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "daftar-perusahaan";
                                    }
                                }); }, 500);
                        </script>

          <?php }
            }
            else {
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "dashboard";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-fungsi"){
            if(isset($_POST['save'])){
                if(!preg_match("/^[A-Z0-9-]*$/", $_POST['id_f'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID Fungsi tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-fungsi";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z. ]*$/", $_POST['nama_f'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama Fungsi tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-fungsi";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $id = $_POST['id_f'];
                    $name = $_POST['nama_f'];

                    $saveData->simpanDataFungsi($id, ucwords($name)); ?>

                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data fungsi berhasil tersimpan",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "daftar-fungsi";
                                    }
                                }); }, 500);
                        </script>

          <?php }
            }
            else {
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "dashboard";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-update-fungsi"){
            $id = $_GET['id'];
            if(isset($_POST['save'])){
                if(!preg_match("/^[A-Z0-9-]*$/", $_POST['id_f'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID Fungsi tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-fungsi-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[a-zA-Z. ]*$/", $_POST['nama_f'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama Fungsi tidak boleh mengandung angka/karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-fungsi-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $name = $_POST['nama_f'];

                    $saveData->updateFungsi($id, ucwords($name)); ?>

                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data fungsi berhasil diperbarui",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "daftar-fungsi";
                                    }
                                }); }, 500);
                        </script>

          <?php }
            }
            else {
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "dashboard";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-password"){
            if(isset($_POST['save'])){
                $id = $dataUserLogin['_id_user'];
                $password = md5($_POST['password']);

                $saveData->updatePassword($id, $password); ?>

                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Password berhasil diperbarui",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "logout";
                                    }
                                }); }, 500);
                        </script>

      <?php }
            else {
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "dashboard";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
        }
        elseif($_GET['action'] == "simpan-medical-checkup"){
            if(isset($_POST['save'])){
                $id = $_GET['id'];
                $pageSuccess = ($_SESSION['page'] == "input-mcu-pekerja") ? "data-mcu-pekerja" : "data-mcu-tkjp-mk";
                $pageErr = ($_SESSION['page'] == "input-mcu-pekerja") ? $_SESSION['page']."-".$id : "input-mcu-tkjp-mk-".$id;
                if(!preg_match("/^[0-9-\/]*$/", $_POST['mcudate'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tanggal hanya boleh mengandung angka dalam format tanggal !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "<?= $pageErr; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $tglMCU = $_POST['mcudate'];
                    $tglExpMCU = date('Y-m-d', strtotime("+1 year", strtotime($tglMCU)));

                    if($getData->statusMCU($id) < 1){

                        $saveData->simpanDataMCU($id, $tglMCU, $tglExpMCU); ?>

                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Informasi",
                                        text: "Data MCU berhasil diperbarui",
                                        type: "success",
                                        confirmButtonText: "OK"
                                    },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "<?= $pageSuccess; ?>";
                                        }
                                    }); }, 500);
                            </script>
              
              <?php }
                    else { 
                        $saveData->updateDataMCU($id, $tglMCU, $tglExpMCU); ?>
                                                    
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Informasi",
                                        text: "Data MCU berhasil diperbarui",
                                        type: "success",
                                        confirmButtonText: "OK"
                                    },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location.href = "<?= $pageSuccess; ?>";
                                        }
                                    }); }, 500);
                            </script>
              <?php }

                }
            }
            else {
                if(isset($_SESSION['status'])){ ?>
                    <script>    
                        window.location.href = "dashboard";
                    </script>
            <?php }
                else { ?>
                    <script>    
                        window.location.href = "logout";
                    </script>
          <?php }
            }
            
        }
    ?>
    <!-- Script Javascript -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

</body>
</html>

