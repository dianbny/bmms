<?php
    error_reporting(0);
    session_start();
    
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    require_once '../config/_getData.php';
    $getData = new _getData();

    $id = $_GET['id'];
    $bln = $_GET['bulan'];
    $thn = $_GET['tahun'];
    $jumTgl = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);

?>
    <h3>Daily Checkup : <?= $id." | ".$bln." | ".$thn; ?></h3>
                <div class="table-layout">
                    <?php
                        header("Content-type: application/vnd-ms-excel");
                        header("Content-Disposition: attachment; filename=Daily Checkup $id Bulan $bln Tahun $thn.xls");
                    ?>
                     <table>
                        <tr>
                            <th style="text-align:center;">Tanggal</th>
                            <th style="text-align:center;">Status Checkup</th>
                            <th style="text-align:center;">Sistolik</th>
                            <th style="text-align:center;">Diastolik</th>
                            <th style="text-align:center;">Denyut Nadi</th>
                            <th>Keluhan</th>
                            <th style="text-align:center;">Keterangan</th>
                            <th style="text-align:center;">Waktu</th>
                            <th>Pemeriksa</th>
                        </tr>

                        <?php
                            for($i = 1; $i <= $jumTgl; $i++){ ?>
                                <tr>
                                    <td style="text-align:center;"><?= strftime('%d %B %Y', strtotime($thn."-".$bln."-".$i)); ?></td>
                                    <td style="text-align:center;">
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bln, $thn) > 0){ 
                                                echo "CHECKUP";    
                                            }
                                            else {
                                                echo "NO CHECKUP";
                                            }
                                            ?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bln, $thn) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bln, $thn);
                                                echo $dataDCU['_sistolik'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bln, $thn) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bln, $thn);
                                                echo $dataDCU['_diastolik'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bln, $thn) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bln, $thn);
                                                echo $dataDCU['_denyut_nadi'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bln, $thn) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bln, $thn);
                                                echo $dataDCU['_keluhan'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bln, $thn) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bln, $thn); ?>
                                                <span class="span-ket-dcu" style="background-color:<?= ($dataDCU['_keterangan']) == "FIT" ? 'green' : 'red'; ?>">
                                                    <?= $dataDCU['_keterangan']; ?>
                                                </span>
                                    <?php }
                                            else {
                                                    echo "-";
                                            }
                                            ?>
                                    </td>
                                    <td style="text-align:center;">
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bln, $thn) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bln, $thn);
                                                echo $dataDCU['_waktu'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bln, $thn) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bln, $thn);
                                                $dataMedic = $getData->getDataPekerja($dataDCU['_medic']);
                    
                                                echo $dataMedic['_nama_pekerja'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>                 
                                </tr>
                    <?php }
                        ?>
                    </table>
                </div>