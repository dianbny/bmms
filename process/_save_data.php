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

        //Simpan Data Pekerja
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

        //Update Data Pekerja
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

        //Simpan Data DCU
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
                elseif(!preg_match("/^[0-9.]*$/", $_POST['suhutubuh'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Suhu Tubuh hanya boleh mengandung angka !",
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
                elseif(!preg_match("/^[a-zA-Z ,]*$/", $_POST['frekuensinafas'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Frekuensi pernafasan tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['riwayat'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan riwayat penyakit tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ,-]*$/", $_POST['detailriwayat'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Riwayat penyakit tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['konsumsiobat'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan konsumsi obat tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ,-]*$/", $_POST['tujuanobat'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tujuan mengkonsumsi obat tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['keluhan'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan keluhan tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ,-]*$/", $_POST['detailkeluhan'])){ ?>
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['tingkatkesadaran'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan tingkat kesadaran tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['cekmata'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan pemeriksaan mata tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['romberg'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan pemeriksaan keseimbangan tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['drugs'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan gejala pengaruh alkohol tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ,-]*$/", $_POST['catatan'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Catatan tidak boleh mengandung karakter khusus !",
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
                    if($getData->cekDCUPekerja($id, date('d'), date('m'), date('Y')) < 1){
                        $tgl = date('Y-m-d');
                        $waktu = date('H:i:s');
                        $sistol = $_POST['sistolik'];
                        $diastol = $_POST['diastolik'];
                        $denyut = $_POST['denyutnadi'];
                        $suhu = $_POST['suhutubuh'];
                        $nafas = $_POST['frekuensinafas'];
                        $riwayat = $_POST['riwayatpenyakit'];
                        $detailriwayat = ($_POST['detailriwayat'] == "") ? "-" : trim($_POST['detailriwayat']);
                        $konsumsiobat = $_POST['konsumsiobat'];
                        $tujuanobat = ($_POST['tujuanobat'] == "") ? "-" : trim($_POST['tujuanobat']);
                        $keluhan = $_POST['keluhan'];
                        $detailkeluhan = ($_POST['detailkeluhan'] == "") ? "-" : trim($_POST['detailkeluhan']);
                        $kesadaran = $_POST['tingkatkesadaran'];
                        $mata = $_POST['cekmata'];
                        $romberg = $_POST['romberg'];
                        $napza = $_POST['drugs'];
                        $catatan = ($_POST['catatan'] == "") ? "-" : trim($_POST['catatan']);
                        $ket;

                        if($riwayat == "Ada" || $konsumsiobat == "Ada" || $keluhan == "Ada"){

                            if($sistol > 139){
                                $ket = "UNFIT";
                            }
                            elseif($diastol > 99){
                                $ket = "UNFIT";
                            }
                            elseif($suhu > 37.5){
                                $ket = "UNFIT";
                            }
                            elseif($nafas == "Tidak Teratur, Terlihat Tanda Sesak"){
                                $ket = "UNFIT";
                            }
                            elseif($kesadaran == "Buruk"){
                                $ket = "UNFIT";
                            }
                            elseif($mata == "Tidak Normal"){
                                $ket = "UNFIT";
                            }
                            elseif($romberg == "Buruk"){
                                $ket = "UNFIT";
                            }
                            elseif($napza == "Positif"){
                                $ket = "UNFIT";
                            }
                            else {
                                $ket = "FIT";
                            }
                        }
                        else {
                            if($sistol > 139){
                                $ket = "UNFIT";
                            }
                            elseif($diastol > 99){
                                $ket = "UNFIT";
                            }
                            elseif($suhu > 37.5){
                                $ket = "UNFIT";
                            }
                            elseif($nafas == "Tidak Teratur, Terlihat Tanda Sesak"){
                                $ket = "UNFIT";
                            }
                            elseif($kesadaran == "Buruk"){
                                $ket = "UNFIT";
                            }
                            elseif($mata == "Tidak Normal"){
                                $ket = "UNFIT";
                            }
                            elseif($romberg == "Buruk"){
                                $ket = "UNFIT";
                            }
                            elseif($napza == "Positif"){
                                $ket = "UNFIT";
                            }
                            else {
                                $ket = "FIT";
                            }
                        }

                        $saveData->simpanCheckup($id, $tgl, $waktu, $sistol, $diastol, $denyut, $suhu, $nafas, $riwayat, ucwords($detailriwayat), $konsumsiobat, ucwords($tujuanobat), $keluhan, ucwords($detailkeluhan), $kesadaran, $mata, $romberg, $napza, $ket, ucwords($catatan), $dataUserLogin['_id_user']); ?>
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

        //Update Data DCU
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
                elseif(!preg_match("/^[0-9.]*$/", $_POST['suhutubuh'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Suhu Tubuh hanya boleh mengandung angka !",
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
                elseif(!preg_match("/^[a-zA-Z ,]*$/", $_POST['frekuensinafas'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Frekuensi pernafasan tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['riwayat'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan riwayat penyakit tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ,-]*$/", $_POST['detailriwayat'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Riwayat penyakit tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['konsumsiobat'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan konsumsi obat tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ,-]*$/", $_POST['tujuanobat'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tujuan mengkonsumsi obat tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['keluhan'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan keluhan tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ,-]*$/", $_POST['detailkeluhan'])){ ?>
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['tingkatkesadaran'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan tingkat kesadaran tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['cekmata'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan pemeriksaan mata tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['romberg'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan pemeriksaan keseimbangan tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ]*$/", $_POST['drugs'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pilihan gejala pengaruh alkohol tidak boleh mengandung angka/karakter khusus !",
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
                elseif(!preg_match("/^[a-zA-Z ,-]*$/", $_POST['catatan'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Catatan tidak boleh mengandung karakter khusus !",
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
                    $suhu = $_POST['suhutubuh'];
                    $nafas = $_POST['frekuensinafas'];
                    $riwayat = $_POST['riwayatpenyakit'];
                    $detailriwayat = ($_POST['detailriwayat'] == "") ? "-" : trim($_POST['detailriwayat']);
                    $konsumsiobat = $_POST['konsumsiobat'];
                    $tujuanobat = ($_POST['tujuanobat'] == "") ? "-" : trim($_POST['tujuanobat']);
                    $keluhan = $_POST['keluhan'];
                    $detailkeluhan = ($_POST['detailkeluhan'] == "") ? "-" : trim($_POST['detailkeluhan']);
                    $kesadaran = $_POST['tingkatkesadaran'];
                    $mata = $_POST['cekmata'];
                    $romberg = $_POST['romberg'];
                    $napza = $_POST['drugs'];
                    $catatan = ($_POST['catatan'] == "") ? "-" : trim($_POST['catatan']);
                    $ket;

                    if($riwayat == "Ada" || $konsumsiobat == "Ada" || $keluhan == "Ada"){

                        if($sistol > 139){
                            $ket = "UNFIT";
                        }
                        elseif($diastol > 99){
                            $ket = "UNFIT";
                        }
                        elseif($denyut > 100){
                            $ket = "UNFIT";
                        }
                        elseif($suhu > 37.5){
                            $ket = "UNFIT";
                        }
                        elseif($nafas == "Tidak Teratur, Terlihat Tanda Sesak"){
                            $ket = "UNFIT";
                        }
                        elseif($kesadaran == "Buruk"){
                            $ket = "UNFIT";
                        }
                        elseif($mata == "Tidak Normal"){
                            $ket = "UNFIT";
                        }
                        elseif($romberg == "Buruk"){
                            $ket = "UNFIT";
                        }
                        elseif($napza == "Positif"){
                            $ket = "UNFIT";
                        }
                        else {
                            $ket = "FIT";
                        }
                    }
                    else {
                        if($sistol > 139){
                            $ket = "UNFIT";
                        }
                        elseif($diastol > 99){
                            $ket = "UNFIT";
                        }
                        elseif($denyut > 100){
                            $ket = "UNFIT";
                        }
                        elseif($suhu > 37.5){
                            $ket = "UNFIT";
                        }
                        elseif($nafas == "Tidak Teratur, Terlihat Tanda Sesak"){
                            $ket = "UNFIT";
                        }
                        elseif($kesadaran == "Buruk"){
                            $ket = "UNFIT";
                        }
                        elseif($mata == "Tidak Normal"){
                            $ket = "UNFIT";
                        }
                        elseif($romberg == "Buruk"){
                            $ket = "UNFIT";
                        }
                        elseif($napza == "Positif"){
                            $ket = "UNFIT";
                        }
                        else {
                            $ket = "FIT";
                        }
                    }

                    $saveData->updateCheckup($id, $tgl, $waktu, $sistol, $diastol, $denyut, $suhu, $nafas, $riwayat, ucwords($detailriwayat), $konsumsiobat, ucwords($tujuanobat), $keluhan, ucwords($detailkeluhan), $kesadaran, $mata, $romberg, $napza, $ket, ucwords($catatan), $dataUserLogin['_id_user']); ?>
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

        //Simpan Visitor
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

        //Simpan Update Visitor
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

        //Simpan Checkup Visitor
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

        //Simpan Update Checkup Visitor
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

        //Simpan Pengguna
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

        //Simpan Update Pengguna
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

        //Simpan Perusahaan
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

        //Simpan Update Perusahaan
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

        //Simpan Fungsi
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

        //Simpan Update Fungsi
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

        //Simpan Medical Checkup
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

        //Simpan Kotak P3K
        elseif($_GET['action'] == "simpan-kotak-p3k"){
            if(isset($_POST['save'])){
                if(!preg_match("/^[A-Z0-9-]*$/", $_POST['id_k'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID Kotak P3K tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-kotak-p3k";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Za-z0-9- &]*$/", $_POST['lokasi_k'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Lokasi Kotak P3K tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-kotak-p3k";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['nomor_k'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nomor Kotak P3K hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-kotak-p3k";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Za-z ]*$/", $_POST['tipe'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tipe Kotak P3K tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-kotak-p3k";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $id = $_POST['id_k'];
                    $lokasi = trim($_POST['lokasi_k']);
                    $nomor = $_POST['nomor_k'];
                    $tipe = $_POST['tipe'];

                    $saveData->simpanKotakP3K($id, strtoupper($lokasi), $nomor, $tipe); ?>
                    
                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data Kotak P3K berhasil tersimpan",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "daftar-kotak-p3k";
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

        //Simpan Update Kotak P3K
        elseif($_GET['action'] == "simpan-update-kotak-p3k"){
            $id = $_GET['id'];
            if(isset($_POST['save'])){
                if(!preg_match("/^[A-Z0-9-]*$/", $_POST['id_k'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "ID Kotak P3K tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-kotak-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Za-z0-9- &]*$/", $_POST['lokasi_k'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Lokasi Kotak P3K tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-kotak-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['nomor_k'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nomor Kotak P3K hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-kotak-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Za-z ]*$/", $_POST['tipe'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tipe Kotak P3K tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-kotak-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $lokasi = trim($_POST['lokasi_k']);
                    $nomor = $_POST['nomor_k'];
                    $tipe = $_POST['tipe'];

                    $saveData->updateKotakP3K($id, strtoupper($lokasi), $nomor, $tipe); ?>
                    
                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data Kotak P3K berhasil diperbarui",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "daftar-kotak-p3k";
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

        //Simpan Isi Kotak P3K
        elseif($_GET['action'] == "simpan-isi-kotak-p3k"){
            $id = $_GET['id'];
            if(isset($_POST['save'])){
                if(!preg_match("/^[A-Za-z0-9- &()]*$/", $_POST['nama'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9\/-]*$/", $_POST['expired'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Axpired hanya boleh berupa angka dalam format tanggal !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Za-z ]*$/", $_POST['status'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Status ketersediaan tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['jumlah'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jumlah hanya boleh berupa angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9\/-]*$/", $_POST['pemeriksaan_t'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pemeriksaan terakhir hanya boleh berupa angka dalam format tanggal !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Za-z0-9 &()]*$/", $_POST['keterangan'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jumlah hanya boleh berupa angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "tambah-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $nama = trim($_POST['nama']);
                    $exp = $_POST['expired'];
                    $status = $_POST['status'];
                    $jumlah = $_POST['jumlah'];
                    $pemeriksaan = $_POST['pemeriksaan_t'];
                    $ket = trim($_POST['keterangan']);

                    $saveData->simpanIsiKotakP3K($id, ucwords($nama), $exp, $status, $jumlah, $pemeriksaan, $dataUserLogin['_id_user'], ucwords($ket)); ?>
                    
                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data Isi Kotak P3K berhasil diperbarui",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "detail-data-kotak-<?= $id; ?>";
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

        //Simpan Isi Kotak P3K
        elseif($_GET['action'] == "simpan-update-isi-kotak-p3k"){
            $id = $_GET['id'];
            $dataKotak = $getData->getDataIsiKotak($id);
            if(isset($_POST['save'])){
                if(!preg_match("/^[A-Za-z0-9- &()]*$/", $_POST['nama'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Nama tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9\/-]*$/", $_POST['expired'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Axpired hanya boleh berupa angka dalam format tanggal !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Za-z ]*$/", $_POST['status'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Status ketersediaan tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['jumlah'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jumlah hanya boleh berupa angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9\/-]*$/", $_POST['pemeriksaan_t'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Pemeriksaan terakhir hanya boleh berupa angka dalam format tanggal !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[A-Za-z0-9 &()]*$/", $_POST['keterangan'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Jumlah hanya boleh berupa angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "edit-data-isi-kotak-p3k-<?= $id; ?>";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $nama = trim($_POST['nama']);
                    $exp = $_POST['expired'];
                    $status = $_POST['status'];
                    $jumlah = $_POST['jumlah'];
                    $pemeriksaan = $_POST['pemeriksaan_t'];
                    $ket = trim($_POST['keterangan']);

                    $saveData->updateIsiKotakP3K($id, ucwords($nama), $exp, $status, $jumlah, $pemeriksaan, $dataUserLogin['_id_user'], ucwords($ket)); ?>
                    
                        <script>
                            setTimeout(function() { 
                                swal({
                                    title: "Informasi",
                                    text: "Data Isi Kotak P3K berhasil diperbarui",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "detail-data-kotak-<?= $dataKotak['_id_kotak']; ?>";
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



    ?>
    <!-- Script Javascript -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

</body>
</html>

