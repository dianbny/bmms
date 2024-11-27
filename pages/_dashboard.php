<?php
    //error_reporting(0);
    session_start();

    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }
    else {
        require_once '../config/_getData.php';
        $getData = new _getData();
        
        //Get Session User 
        $username = $_SESSION['username'];

        if($getData->cekUsername($username) < 1){ ?>
            <script>    
                window.location.href = "logout";
            </script>
  <?php }

        //Get Data User Login
        $dataUserLogin = $getData->getDataUserLogin($username);
        $dataUser = $getData->getDataPekerja($dataUserLogin['_id_user']);
        $fungsi = $getData->getNamaFungsi($dataUser['_fungsi']);
        

        //Waktu 
        date_default_timezone_set("Asia/Kuala_Lumpur");
        setlocale(LC_ALL, 'id-ID', 'id_ID');

    }
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/pertamina.png" type="image/gif">
    <link rel="stylesheet" type="text/css" href="assets/css/_style_page.css">
    <link rel="stylesheet" type="text/css" href="assets/vendors/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="assets/js/chart.js"></script>
    <title><?= $dataUser['_nama_pekerja']; ?></title>
</head>
<body>
    <!-- Loading Animation -->
    <div id="load"></div>

    <!-- Topbar -->
    <div class="topbar">
        <span style="font-size:26px;cursor:pointer;color:black;" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></span>&nbsp;&nbsp;
        <img src="assets/images/pertamina.png">
        <span class="span">PERTAMINA <span style="color:red;">EP</span></span>
        <div class="divuser">
            Hi, &nbsp; <strong><?= ucwords($dataUser['_nama_pekerja']); ?></strong> | Date : <?= date('d-m-Y'); ?>
            <img src="assets/images/user.png">
        </div>
    </div>
    <!-- Akhir Topbar -->

    <!-- Sidebar -->
    <div id="mySidenav" class="sidenav">
        <button class="closebtn" onclick="closeNav()"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
        
        <a href="dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp; Dashboard</a>
        <a href="javascript:void(0)" id="first"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; Pekerja</a>
            <div class="menu-first">
                <a href="daftar-pegawai"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; Pegawai</a>
                <a href="daftar-tkjp-mk"><i class="fa fa-users" aria-hidden="true"></i>&nbsp; TKJP / MK</a>
            </div>
        <a href="javascript:void(0)" id="second"><i class="fa fa-stethoscope" aria-hidden="true"></i>&nbsp; Daily Checkup</a>
            <div class="menu-second">
                <a href="data-checkup"><i class="fa fa-stethoscope" aria-hidden="true"></i>&nbsp; Data Checkup</a>
                <a href="pencarian-data-checkup"><i class="fa fa-search" aria-hidden="true"></i>&nbsp; Pencarian</a>
            </div>
        <a href="javascript:void(0)" id="third"><i class="fa fa-percent" aria-hidden="true"></i>&nbsp; Persentase Checkup</a>
            <div class="menu-third">
                <a href="persentase-dcu-harian"><i class="fa fa-percent" aria-hidden="true"></i>&nbsp; Harian</a>
                <a href="persentase-dcu-bulanan"><i class="fa fa-percent" aria-hidden="true"></i>&nbsp; Bulanan</a>
                <a href="persentase-dcu-high-risk"><i class="fa fa-percent" aria-hidden="true"></i>&nbsp; High Risk</a>
            </div>
        <a href="javascript:void(0)" id="fourth"><i class="fa fa-heartbeat" aria-hidden="true"></i>&nbsp; Medical Checkup</a>
            <div class="menu-fourth">
                <a href="data-mcu-pekerja"><i class="fa fa-heartbeat" aria-hidden="true"></i>&nbsp; Pegawai</a>
                <a href="data-mcu-tkjp-mk"><i class="fa fa-heartbeat" aria-hidden="true"></i>&nbsp; TKJP / MK</a>
            </div>
        <a href="daftar-kotak-p3k"><i class="fa fa-medkit" aria-hidden="true"></i>&nbsp; Kotak P3K</a>
        <?php
            if($dataUserLogin['_level_user'] == "Admin"){ ?>
                <a href="daftar-pengguna"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp; Daftar Pengguna</a>
      <?php }
        ?>
        <a href="javascript:void(0)" id="sixth"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Export</a>
            <div class="menu-sixth">
                <a href="rekap-data-checkup-harian"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Rekap Harian</a>
                <a href="rekap-data-checkup"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Rekap Bulanan</a>
                <a href="high-risk-checkup"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; High Risk</a>
            </div>
        <a href="javascript:void(0)" id="seventh"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp; Pengaturan</a>
            <div class="menu-seventh">
                <a href="daftar-perusahaan"><i class="fa fa-university" aria-hidden="true"></i>&nbsp; Perusahaan</a>
                <a href="daftar-fungsi"><i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp; Fungsi</a>
                <a href="ubah-password"><i class="fa fa-key" aria-hidden="true"></i>&nbsp; Password</a>
            </div>
        <a href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; Logout</a>
        
    </div>
    <!-- Akhir Sidebar -->

    <!-- Container -->
    <div class="container animate__animated animate__fadeIn">
        <?php
            $page = addslashes($_GET['page']);

            switch($page){
                case "daftar-pegawai":

                    include "_daftar_pegawai.php";
    
                    break;

                case "daftar-tkjp-mk":

                    include "_daftar_tkjp_mk.php";

                    break;

                case "tambah-data-pekerja":

                    include "_tambah_pekerja.php";

                    break;
                
                case "edit-data-pekerja":

                    include "_edit_data_pekerja.php";
    
                    break;
                
                case "edit-data-tkjp-mk":

                    include "_edit_data_tkjp_mk.php";
        
                    break;

                case "tambah-data-tkjp-mk":

                    include "_tambah_tkjp_mk.php";

                    break;

                case "data-checkup":

                    include "_data_dcu.php";

                    break;

                case "input-data-checkup":

                    include "_input_data_dcu.php";
    
                    break;

                case "edit-data-checkup":

                    include "_edit_data_dcu.php";
        
                    break;

                case "high-risk-checkup":

                    include "_data_hr_dcu.php";
    
                    break;

                case "daftar-visitor":

                    include "_daftar_visitor.php";
    
                    break;

                case "tambah-data-visitor":

                    include "_tambah_visitor.php";
        
                    break;
                
                case "edit-data-visitor":

                    include "_edit_data_visitor.php";

                    break;

                case "data-checkup-visitor":

                    include "_data_dcu_visitor.php";
    
                    break;

                case "input-data-checkup-visitor":

                    include "_input_data_dcu_visitor.php";

                    break;
                
                case "edit-data-checkup-visitor":

                    include "_edit_data_dcu_visitor.php";

                    break;
                case "daftar-pengguna":
                    
                    include "_daftar_pengguna.php";

                    break;

                case "tambah-data-pengguna":

                    include "_tambah_pengguna.php";
            
                    break;

                case "edit-data-pengguna":

                    include "_edit_data_pengguna.php";
                
                    break;
                
                case "daftar-perusahaan":

                    include "_daftar_perusahaan.php";

                    break;

                case "tambah-data-perusahaan":

                    include "_tambah_perusahaan.php";
    
                    break;

                case "edit-data-perusahaan":

                    include "_edit_data_perusahaan.php";
        
                    break;

                case "daftar-perusahaan":

                    include "_daftar_perusahaan.php";

                    break;

                case "tambah-data-perusahaan":

                    include "_tambah_perusahaan.php";
    
                    break;

                case "edit-data-perusahaan":

                    include "_edit_data_perusahaan.php";
        
                    break;

                case "daftar-fungsi":

                    include "_daftar_fungsi.php";
    
                    break;
    
                case "tambah-data-fungsi":
    
                    include "_tambah_fungsi.php";
        
                    break;
    
                case "edit-data-fungsi":
    
                    include "_edit_data_fungsi.php";
            
                    break;

                case "ubah-password":

                    include "_change_password.php";

                    break;

                case "persentase-dcu-harian":

                    include "_persentase_dcu_harian.php";
    
                    break;

                case "persentase-dcu-bulanan":

                    include "_persentase_dcu_bulanan.php";
        
                    break;

                case "persentase-dcu-high-risk":

                    include "_persentase_dcu_high_risk.php";
            
                    break;

                case "pencarian-data-checkup":

                    include "_pencarian_data_dcu.php";
            
                    break;

                case "detail-data-checkup-pekerja":

                    include "_data_dcu_nama.php";
                
                    break;

                case "data-mcu-pekerja":

                    include "_mcu_pegawai.php";
                    
                    break;

                case "data-mcu-tkjp-mk":

                    include "_mcu_tkjp_mk.php";
                        
                    break;

                case "input-mcu-pekerja":

                    include "_input_data_mcu.php";
                        
                    break;

                case "input-mcu-tkjp-mk":

                    include "_input_data_mcu_tkjp.php";
                            
                    break;

                case "rekap-data-checkup":

                    include "_rekap_data_dcu.php";
                
                    break;

                case "rekap-data-checkup-harian":

                    include "_rekap_data_dcu_harian.php";
                    
                    break;

                case "daftar-kotak-p3k":

                    include "_kotak_p3k.php";
                        
                    break;

                case "tambah-data-kotak-p3k":

                    include "_tambah_kotak_p3k.php";
                            
                    break;

                case "edit-data-kotak":

                    include "_edit_kotak_p3k.php";
                                
                    break;

                case "detail-data-kotak":

                    include "_detail_kotak_p3k.php";
                                    
                    break;

                case "tambah-data-isi-kotak-p3k":

                    include "_tambah_isi_kotak_p3k.php";
                                
                    break;

                case "edit-data-isi-kotak-p3k":

                    include "_edit_isi_kotak_p3k.php";
                                    
                    break;

                case "dashboard" : 
                    $jumTglBln = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
                    foreach($getData->listFungsi() as $row){
                        $namaFungsi[] = substr($row['_nama_fungsi'], 0, 4);

                        //$totalMasuk = $getData->getNamaFungsi($row['_id_fungsi']);
                        //$totalMasukBulan = $totalMasuk['_total_masuk_tkjp'] * $jumTglBln;
            
                        $dcuPekerjaDay = $getData->jumlahDCUFungsiDay(date('Y-m-d'), $row['_id_fungsi'], "PEKERJA");
                        $dcuTKJPDay = $getData->jumlahDCUFungsiDay(date('Y-m-d'), $row['_id_fungsi'], "TKJP/MK");
            
                        $jumlahDCUDayPeg[] = ($dcuPekerjaDay != 0) ? ceil($dcuPekerjaDay / $row['_total_masuk_pekerja'] *100) : 0;
                        $jumlahDCUDay[] = ($dcuTKJPDay != 0) ? ceil($dcuTKJPDay / $row['_total_masuk_tkjp'] *100) : 0;
                        
                        //$jumlahDCUMonth[] = ceil($getData->jumlahDCUFungsiMonth(date('m'), $row['_id_fungsi'])/$totalMasukBulan*100);
            
                    } 
                    
                    foreach($getData->ListKategoriNoHR() as $row){
                        $kategori[] = $row['_kategori'];

                        $totalPekerjaHR[] = $getData->cekTotalKategoriPekerjaan($row['_id_kategori']);
                        $totalMasukHRBulan = $getData->cekTotalKategoriPekerjaan($row['_id_kategori']) * $jumTglBln;

                        $dcuHRDay = $getData->jumlahDCUHRDay(date('Y-m-d'), $row['_id_kategori']);
                        $dcuHRMonth = $getData->jumlahDCUHRMonth(date('m'), date('Y'), $row['_id_kategori']);

                        $jumlahDCUHRDay[] = ($dcuHRDay != 0) ? ceil($dcuHRDay / $getData->cekTotalKategoriPekerjaan($row['_id_kategori']) * 100) : 0;
                        $jumlahDCUHRMonth[] = ($dcuHRMonth != 0) ? ceil($dcuHRMonth / $totalMasukHRBulan * 100) : 0;

                    } ?>

        <h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Dashboard</h5>

        <!-- Dashboar Total -->
        <div class="panel">
            <div class="dashboard color1">
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <div class="title">
                    <h4>Pekerja/TKJP/MK</h4>
                    <span><?= $getData->cekJumlahPekerja(); ?></span><br>
                    Total
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="svg-wave"><path fill="#f3f4f5" fill-opacity="0.1" d="M0,32L48,32C96,32,192,32,288,69.3C384,107,480,181,576,197.3C672,213,768,171,864,176C960,181,1056,235,1152,245.3C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </div>
            <div class="dashboard color2">
                <div class="icon">
                    <i class="fa fa-stethoscope" aria-hidden="true"></i>
                </div>
                <div class="title">
                    <h4>Daily Checkup</h4>
                    <span><?= $getData->cekDCU(date('d'), date('m'), date('Y')); ?></span><br>
                    Total
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="svg-wave"><path fill="#f3f4f5" fill-opacity="0.1" d="M0,32L48,32C96,32,192,32,288,69.3C384,107,480,181,576,197.3C672,213,768,171,864,176C960,181,1056,235,1152,245.3C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </div>
            <div class="dashboard color3">
                <div class="icon">
                    <i class="fa fa-user-times" aria-hidden="true"></i>
                </div>
                <div class="title">
                    <h4>No Checkup</h4>
                    <span><?= $getData->cekNoDCU(date('d'), date('m'), date('Y')); ?></span><br>
                    Total
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="svg-wave"><path fill="#f3f4f5" fill-opacity="0.1" d="M0,32L48,32C96,32,192,32,288,69.3C384,107,480,181,576,197.3C672,213,768,171,864,176C960,181,1056,235,1152,245.3C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </div>
            <div class="dashboard color4">
                <div class="icon">
                    <i class="fa fa-check-square" aria-hidden="true"></i>
                </div>
                <div class="title">
                    <h4>Fit to Work</h4>
                    <span><?= $getData->cekKeteranganDCU(date('d'), date('m'), date('Y'), "FIT"); ?></span><br>
                    Total <br>
                    
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="svg-wave"><path fill="#f3f4f5" fill-opacity="0.1" d="M0,32L48,32C96,32,192,32,288,69.3C384,107,480,181,576,197.3C672,213,768,171,864,176C960,181,1056,235,1152,245.3C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </div>
            <div class="dashboard color5">
                <div class="icon">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </div>
                <div class="title">
                    <h4>Unfit to Work</h4>
                    <span><?= $getData->cekKeteranganDCU(date('d'), date('m'), date('Y'), "UNFIT"); ?></span><br>
                    Total <br>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="svg-wave"><path fill="#f3f4f5" fill-opacity="0.1" d="M0,32L48,32C96,32,192,32,288,69.3C384,107,480,181,576,197.3C672,213,768,171,864,176C960,181,1056,235,1152,245.3C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </div>
        </div>

        <!-- Grafik Checkup -->
        <div class="panel-bottom">
            <div class="dashboard-bottom">
                <span class="color6">Grafik Checkup Pekerja Fungsi Hari Ini</span>
                <div class="table-dashboard">
                    <canvas id="chartDayPeg" style="width:100%;height:100%;"></canvas>
                </div>
                
            </div>

            <div class="dashboard-bottom">
                <span class="color6">Grafik Checkup TKJP/MK Fungsi Hari Ini</span>
                <div class="table-dashboard">
                    <canvas id="chartDayTKJP" style="width:100%;height:100%;"></canvas>
                </div>
                
            </div>


            <script>
                //Grafik Pegawai Ini
                var ctxDayPeg = document.getElementById("chartDayPeg").getContext('2d');
                var myChartDayPeg = new Chart(ctxDayPeg, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($namaFungsi); ?>,
                        datasets: [{
                            label: 'Grafik Checkup Pekerja Fungsi (%)',
                            data: <?php echo json_encode($jumlahDCUDayPeg); ?>,
                            backgroundColor: 'rgba(255, 104, 101, 0.5)',
                            borderColor: 'rgba(255, 104, 101, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

                //Grafik TKJP Hari Ini
                var ctxDayTKJP = document.getElementById("chartDayTKJP").getContext('2d');
                var myChartDayTKJP = new Chart(ctxDayTKJP, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($namaFungsi); ?>,
                        datasets: [{
                            label: 'Grafik Checkup TKJP/MK Fungsi (%)',
                            data: <?php echo json_encode($jumlahDCUDay); ?>,
                            backgroundColor: 'rgba(28, 198, 255, 0.5)',
                            borderColor: 'rgba(28, 198, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

                
            </script>
        </div>

        <!-- Hasil Checkup -->
        <div class="panel-bottom">
            <div class="dashboard-bottom">
                <span class="color6">Total Kategori High Risk</span>
                <div class="table-dashboard">
                    <canvas id="chartHR" style="width:100%;height:100%;"></canvas>
                </div>
                
            </div>
            <div class="dashboard-bottom">
                <span class="color6">Grafik Checkup Harian</span>
                <div class="table-dashboard">
                    <canvas id="chartHRDay" style="width:100%;height:100%;"></canvas>
                </div>

            </div>
            <div class="dashboard-bottom">
                <span class="color6">Grafik Checkup Bulanan</span>
                <div class="table-dashboard">
                    <canvas id="chartHRMonth" style="width:100%;height:100%;"></canvas>
                </div>

            </div>

            <script>
                //Grafik Pekerja Kategori High Risk
                var ctxHR = document.getElementById("chartHR").getContext('2d');
                var myChartHR = new Chart(ctxHR, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode($kategori); ?>,
                        datasets: [{
                            label: 'Grafik Total Kategori High Risk',
                            data: <?php echo json_encode($totalPekerjaHR); ?>,
                            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#008B8B','#CD5C5C']
                            
                        }]
                    },
                    
                });

                //Grafik Checkup High Risk Hari Ini
                var ctxDayHR = document.getElementById("chartHRDay").getContext('2d');
                var myChartDayHR = new Chart(ctxDayHR, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($kategori); ?>,
                        datasets: [{
                            label: 'Grafik Checkup Kategori High Risk (%)',
                            data: <?php echo json_encode($jumlahDCUHRDay); ?>,
                            backgroundColor: 'rgba(0, 184, 173, 0.5)',
                            borderColor: 'rgba(0, 184, 173, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

                //Grafik Checkup High Risk Bulan Ini
                var ctxMonthHR = document.getElementById("chartHRMonth").getContext('2d');
                var myChartMonthHR = new Chart(ctxMonthHR, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($kategori); ?>,
                        datasets: [{
                            label: 'Grafik Checkup Kategori High Risk (%)',
                            data: <?php echo json_encode($jumlahDCUHRMonth); ?>,
                            backgroundColor: 'rgba(0, 184, 173, 0.5)',
                            borderColor: 'rgba(0, 184, 173, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

            </script>
        </div>

        <?php

            break;

            } ?>
    </div>
    <!-- Akhir Container -->

    <!-- Footer Halaman -->
    <div class="footer">
        Bunyu Medical Management System | Ver. 1.4
    </div>
    <!-- Akhir Footer -->


    <!-- Script JS -->
    <script>
        function openNav() {
        document.getElementById("mySidenav").style.width = "210px";
        }

        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <script>
        var load = document.getElementById('load');

        window.addEventListener('load', function(){
            load.style.display = "none";
        });
    </script>
    <script src="assets/js/script.js"></script>
    
</body>
</html>