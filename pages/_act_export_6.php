<?php
    error_reporting(0);
    session_start();
    
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    require_once '../config/_getData.php';
    $getData = new _getData();

    $fungsi = $_GET['fungsi'];
    $namaFungsi = $getData->getNamaFungsi($fungsi);
    $bln = $_GET['bulan'];
    $thn = $_GET['tahun'];
    $jumTgl = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);

?>
    <h3>Persentase Daily Checkup Fungsi : <?= $namaFungsi['_nama_fungsi']; ?> | Bulan : <?= $bln; ?> | Tahun : <?= $thn; ?></h3>
        <div class="table-layout">
            <?php
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Persentase Bulanan Daily Checkup.xls");
            ?>
            <table>
                <tr>
                    <th rowspan="2" style="text-align:center;">Tanggal</th>
                    <th colspan="6" style="text-align:center;">PEKERJA</th>
                    <th colspan="6" style="text-align:center;">TKJP/MK</th>
                        <tr>
                            <th style="text-align:center;">DCU</th>
                            <th style="text-align:center;">Fit</th>
                            <th style="text-align:center;">Unfit</th>
                            <th style="text-align:center;">Persentase</th>
                            <th style="text-align:center;">Status</th>
                                        
                            <th style="text-align:center;">DCU</th>
                            <th style="text-align:center;">Fit</th>
                            <th style="text-align:center;">Unfit</th>
                            <th style="text-align:center;">Persentase</th>
                            <th style="text-align:center;">Status</th>
                        </tr>
                </tr>
                <?php
                    if($getData->cekPekerjaAllbyFungsi($fungsi) > 0){
                        for($i = 1; $i <= $jumTgl; $i++){ 
                            $totalMasuk = $getData->getNamaFungsi($fungsi);

                            $dcuPekerjaDay = $getData->jumlahDCUFungsiDay(date($thn."-".$bln."-".$i), $fungsi, "PEKERJA");
                            $dcuTKJPDay = $getData->jumlahDCUFungsiDay(date($thn."-".$bln."-".$i), $fungsi, "TKJP/MK"); 
                        
                            $dcuPekerjaDayOld = $getData->jumlahDCUFungsiDay(date('Y-m-d', strtotime("-1 day", strtotime(date($thn."-".$bln."-".$i)))), $fungsi, "PEKERJA");
                            $dcuTKJPDayOld = $getData->jumlahDCUFungsiDay(date('Y-m-d', strtotime("-1 day", strtotime(date($thn."-".$bln."-".$i)))), $fungsi, "TKJP/MK");
                        ?>
                            <tr>
                                <td style="text-align:center;"><?= strftime('%d %B %Y', strtotime($thn."-".$bln."-".$i)); ?></td>
                                <td style="text-align:center;"><?= $dcuPekerjaDay; ?></td>
                                <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($fungsi, date($thn."-".$bln."-".$i), "FIT", "PEKERJA"); ?></td>
                                <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($fungsi, date($thn."-".$bln."-".$i), "UNFIT", "PEKERJA"); ?></td>
                                <td style="text-align:center;"><?= ($dcuPekerjaDay != 0) ? ceil($dcuPekerjaDay/$totalMasuk['_total_masuk_pekerja']*100) : 0; ?> &nbsp;%</td>
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

                                <td style="text-align:center;"><?= $dcuTKJPDay; ?></td>
                                <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($fungsi, date($thn."-".$bln."-".$i), "FIT", "TKJP/MK"); ?></td>
                                <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($fungsi, date($thn."-".$bln."-".$i), "UNFIT", "TKJP/MK"); ?></td>
                                <td style="text-align:center;"><?= ($dcuTKJPDay != 0) ? ceil($dcuTKJPDay/$totalMasuk['_total_masuk_tkjp']*100) : 0; ?> &nbsp;%</td>
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
                    } ?>
                </table>
            </div>
