<?php
    error_reporting(0);
    session_start();
    
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    require_once '../config/_getData.php';
    $getData = new _getData();

    $tgl = $_GET['tanggal'];
    $bln = $_GET['bulan'];
    $thn = $_GET['tahun'];

?>
    <h3>Persentase Daily Checkup Tanggal : <?= $tgl."-".$bln."-".$thn; ?></h3>
                <div class="table-layout">
                    <?php
                        header("Content-type: application/vnd-ms-excel");
                        header("Content-Disposition: attachment; filename=Persentase Daily Checkup.xls");
                    ?>
                    <table>
                        <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Nama Fungsi</th>
                        <th colspan="6" style="text-align:center;">PEKERJA</th>
                        <th colspan="6" style="text-align:center;">TKJP/MK</th>
                            <tr>
                                <th style="text-align:center;">On Duty</th>
                                <th style="text-align:center;">DCU</th>
                                <th style="text-align:center;">Fit</th>
                                <th style="text-align:center;">Unfit</th>
                                <th style="text-align:center;">Persentase</th>
                                <th style="text-align:center;">Status</th>
                                
                                <th style="text-align:center;">On Duty</th>
                                <th style="text-align:center;">DCU</th>
                                <th style="text-align:center;">Fit</th>
                                <th style="text-align:center;">Unfit</th>
                                <th style="text-align:center;">Persentase</th>
                                <th style="text-align:center;">Status</th>
                            </tr>
                        </tr>

                    <?php
                    $no = 1;
                    foreach($getData->listFungsi() as $row){ 
                        $dcuPekerjaDay = $getData->jumlahDCUFungsiDay(date('Y-m-d'), $row['_id_fungsi'], "PEKERJA");
                        $dcuTKJPDay = $getData->jumlahDCUFungsiDay(date('Y-m-d'), $row['_id_fungsi'], "TKJP/MK"); 
                            
                        $dcuPekerjaDayOld = $getData->jumlahDCUFungsiDay(date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d')))), $row['_id_fungsi'], "PEKERJA");
                        $dcuTKJPDayOld = $getData->jumlahDCUFungsiDay(date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d')))), $row['_id_fungsi'], "TKJP/MK");
                        ?>

                        <tr>
                            <td><?= $no++."."; ?></td>
                            <td><?= $row['_nama_fungsi']; ?></td>
                            <td style="text-align:center;"><?= $row['_total_masuk_pekerja']; ?></td>
                            <td style="text-align:center;"><?= $dcuPekerjaDay; ?></td>
                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($row['_id_fungsi'], date('Y-m-d'), "FIT", "PEKERJA"); ?></td>
                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($row['_id_fungsi'], date('Y-m-d'), "UNFIT", "PEKERJA"); ?></td>
                            <td style="text-align:center;"><?= ($dcuPekerjaDay != 0) ? ceil($dcuPekerjaDay/$row['_total_masuk_pekerja']*100) : 0; ?> &nbsp;%</td>
                            <td style="text-align:center;">
                                <?php
                                    if($dcuPekerjaDay > $dcuPekerjaDayOld){ 
                                        echo "UP";
                                    }
                                    elseif($dcuPekerjaDay < $dcuPekerjaDayOld){
                                        echo "DOWN";
                                    }
                                    else {
                                        echo "EQUALS";
                                    }
                                ?>
                            </td>

                            <td style="text-align:center;"><?= $row['_total_masuk_tkjp']; ?></td>
                            <td style="text-align:center;"><?= $dcuTKJPDay; ?></td>
                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($row['_id_fungsi'], date('Y-m-d'), "FIT", "TKJP/MK"); ?></td>
                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($row['_id_fungsi'], date('Y-m-d'), "UNFIT", "TKJP/MK"); ?></td>
                            <td style="text-align:center;"><?= ($dcuTKJPDay != 0) ? ceil($dcuTKJPDay/$row['_total_masuk_tkjp']*100) : 0; ?> &nbsp;%</td>
                            <td style="text-align:center;">
                                <?php
                                    if($dcuTKJPDay > $dcuTKJPDayOld){
                                        echo "UP";
                                    }
                                    elseif($dcuTKJPDay < $dcuTKJPDayOld){
                                        echo "DOWN";
                                    }
                                    else {
                                        echo "EQUALS";
                                    }
                                ?>
                            </td>
                        </tr>
             <?php }
                ?>  
            </table>
        </div>