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
    <h3>Daily Checkup Tanggal : <?= $tgl."-".$bln."-".$thn; ?></h3>
                <div class="table-layout">
                    <?php
                        header("Content-type: application/vnd-ms-excel");
                        header("Content-Disposition: attachment; filename=Report Daily Checkup.xls");
                    ?>
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>ID Card/KTP/Kartu Pelajar/SIM</th>
                            <th>Nama Visitor</th>
                            <th>Asal Instansi</th>
                            <th style="text-align:center;">Checkup</th>
                            <th style="text-align:center;">Waktu</th>
                            <th style="text-align:center;">Sistolik</th>
                            <th style="text-align:center;">Diastolik</th>
                            <th style="text-align:center;">Denyut Nadi</th>
                            <th>Keluhan</th>
                            <th style="text-align:center;">Hasil (Fit/Unfit)</th>
                            <th>Pemeriksa (Medic)</th>
                        </tr>

                    <?php
                        $no = 1;
                        foreach($getData->listVisitorAll() as $row){ ?>
                        <tr>
                            <td>'<?= $no++."."; ?></td>
                            <td>'<?= $row['_id_visitor']; ?></td>
                            <td><?= $row['_nama_visitor']; ?></td>
                            <td><?= $row['_nama_instansi']; ?></td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn) > 0){ 
                                        echo "Telah Checkup";
                                    }
                                    else { 
                                        echo "Belum Checkup";
                                    }
                                    ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn);
                                        echo "'".$dataDCU['_waktu'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn);
                                        echo "'".$dataDCU['_sistolik'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn);
                                        echo "'".$dataDCU['_diastolik'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn);
                                        echo "'".$dataDCU['_denyut_nadi'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn);
                                        echo $dataDCU['_keluhan'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn);
                                        echo $dataDCU['_keterangan'];
                                                
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], $tgl, $bln, $thn);
                                        $dataMedic = $getData->getDataPekerja($dataDCU['_medic']);

                                        echo $dataMedic['_nama_pekerja'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                        </tr>
                  <?php } ?>
                
                    </table>
                </div>