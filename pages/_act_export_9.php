<?php
    error_reporting(0);
    session_start();
    
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    require_once '../config/_getData.php';
    $getData = new _getData();

    $kategori = $_GET['kategori'];
    $namakategori = $getData->getKategoriPekerjaan($kategori);
    $bln = $_GET['bulan'];
    $thn = $_GET['tahun'];
    $jumTgl = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);

?>
    <h3>Persentase Daily Checkup Kategori Pekerjaan : <?= $namakategori['_kategori']; ?> | Bulan : <?= $bln; ?> | Tahun : <?= $thn; ?></h3>
        <div class="table-layout">
            <?php
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Persentase Bulanan Daily Checkup Kategori High Risk.xls");
            ?>
            <table>
                <tr>
                                <th style="text-align:center;" rowspan="2">Tanggal</th>
                                <th style="text-align:center;" rowspan="2">Total Pekerja</th>
                                <th style="text-align:center;" colspan="5">Checkup Harian</th>
        
                            </tr>

                                <tr>
                                    <th style="text-align:center;">DCU</th>
                                    <th style="text-align:center;">Fit</th>
                                    <th style="text-align:center;">Unfit</th>
                                    <th style="text-align:center;">Persentase</th>
                                    <th style="text-align:center;">Status</th>

                                            
                                </tr>
                            
                            <?php
                            if(isset($kategori)){
                                if($getData->cekTotalKategoriPekerjaan($kategori) > 0){
                                    for($i = 1; $i <= $jumTgl; $i++){ 
                                        
                                        $dcuHRDay = $getData->jumlahDCUHRDay(date($thn."-".$bln."-".$i), $kategori);
                                    
                                        $dcuHRDayOld = $getData->jumlahDCUHRDay(date('Y-m-d', strtotime("-1 day", strtotime(date($thn."-".$bln."-".$i)))), $kategori);
                                        

                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?= strftime('%d %B %Y', strtotime($thn."-".$bln."-".$i)); ?></td>
                                            <td style="text-align:center;"><?= $getData->cekTotalKategoriPekerjaan($kategori); ?></td>
                                            <td style="text-align:center;"><?= $dcuHRDay; ?></td>
                                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUKategori($kategori, date($thn."-".$bln."-".$i), "FIT"); ?></td>
                                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUKategori($kategori, date($thn."-".$bln."-".$i), "UNFIT"); ?></td>
                                            <td style="text-align:center;"><?= ($dcuHRDay != 0) ? ceil($dcuHRDay/$getData->cekTotalKategoriPekerjaan($kategori)*100) : 0; ?> &nbsp;%</td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($dcuHRDay > $dcuHRDayOld){
                                                        echo "UP";
                                                    }
                                                    elseif($dcuHRDay < $dcuHRDayOld){ 
                                                        echo "DOWN";
                                                    }
                                                    else {
                                                        echo "EQUALS";
                                                    }
                                                ?>
                                            </td>
                                            
                                           

                                        </tr>
                              <?php }
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="12"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                        <?php }
                        } ?>
                </table>
            </div>
