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
    <h3>Daily Checkup Fungsi : <?= $namaFungsi['_nama_fungsi']; ?> | Bulan : <?= $bln; ?> | Tahun : <?= $thn; ?></h3>
        <div class="table-layout">
            <?php
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Report Bulanan Daily Checkup.xls");
            ?>
            <table>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">No. Pekerja</th>
                    <th rowspan="2">Nama Pekerja/TKJP/MK</th>
                    <th rowspan="2">Fungsi</th>
                    <th rowspan="2">Kategori Pekerjaan</th>
                    <th rowspan="2">Total DCU</th>
                        <?php
                            for ($i = 1; $i <= $jumTgl; $i++){ ?>

                                <th colspan="5" style="text-align:center;"><?= $i; ?></th>
                      <?php } ?>
                    <tr>
                        <?php
                            for ($i = 1; $i <= $jumTgl; $i++){ ?>
                                <th style="text-align:center;">Sis.</th>
                                <th style="text-align:center;">Dia.</th>
                                <th style="text-align:center;">DN</th>
                                <th>Keluhan</th>
                                <th style="text-align:center;">Ket.</th>
                      <?php } ?>
                    </tr>
                </tr>
                <?php
                    if($getData->cekPekerjaAllbyFungsi($fungsi) > 0){
                        foreach($getData->listPekerjaAllbyFungsi($fungsi) as $row){ ?>
                            <tr>
                                <td>'<?= $no++."."; ?></td>
                                <td>'<?= $row['_id_pekerja']; ?></td>
                                <td><?= $row['_nama_pekerja']; ?></td>
                                <td><?= $row['_nama_fungsi']; ?></td>
                                <td><?= $row['_kategori']; ?></td>
                                <td style="text-align:center;"><?= $getData->cekDCUPekerjaBln($row['_id_pekerja'], $bln, $thn); ?></td>
                                <?php
                                    for ($i = 1; $i <= $jumTgl; $i++){ ?>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], $i, $bln, $thn) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, $bln, $thn);
                                                    echo $dataDCU['_sistolik'];
                                                }
                                                
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                            if($getData->cekDCUPekerja($row['_id_pekerja'], $i, $bln, $thn) > 0){
                                                $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, $bln, $thn);
                                                    echo $dataDCU['_diastolik'];
                                                }
                                                
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], $i, $bln, $thn) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, $bln, $thn);
                                                    echo $dataDCU['_denyut_nadi'];
                                                }
                                                
                                            ?> 
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], $i, $bln, $thn) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, $bln, $thn);
                                                    echo $dataDCU['_keluhan'];
                                                }
                                                
                                            ?> 
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], $i, $bln, $thn) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, $bln, $thn);
                                                    echo $dataDCU['_keterangan'];
                                                }
                                                
                                            ?>
                                        </td>
                            <?php } ?>
                            </tr>
                    <?php } 
                    } ?>
                </table>
            </div>
