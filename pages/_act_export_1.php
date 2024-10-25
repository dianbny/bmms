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
                        <th rowspan="2">No.</th>
                        <th rowspan="2">No. Pekerja/TKJP/MK</th>
                        <th rowspan="2">Nama Pekerja/TKJP/MK</th>
                        <th rowspan="2">Fungsi</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Kategori Pekerjaan</th>
                        <th style="text-align:center;" rowspan="2">Checkup</th>
                        <th style="text-align:center;" rowspan="2">Waktu</th>
                        <th style="text-align:center;" colspan="5">Pemeriksaan Vital</th>
                        <th style="text-align:center;" colspan="10">Anamnesis/Pemeriksaan Fisik</th>
                        <th style="text-align:center;" rowspan="2">Hasil (Fit/Unfit)</th>
                        <th rowspan="2">Rekomendasi/Catatan</th>
                        <th rowspan="2">Pemeriksa (Medic)</th>
                    
                    </tr>
                            <tr>
                                <th style="text-align:center;">Sistolik</th>
                                <th style="text-align:center;">Diastolik</th>
                                <th style="text-align:center;">Denyut Nadi</th>
                                <th style="text-align:center;">Suhu Tubuh</th>
                                <th>Frekuensi Pernafasan</th>

                                <th>Riwayat Penyakit</th>
                                <th>Detail Riwayat</th>
                                <th>Mengonsumsi Obat</th>
                                <th>Tujuan Mengonsumsi Obat</th>
                                <th>Keluhan</th>
                                <th>Detail Keluhan</th>
                                <th>Tingkat Kesadaran</th>
                                <th>Pemeriksaan Mata</th>
                                <th>Pemeriksaan keseimbangan</th>
                                <th>Gejala Pengaruh Alkohol/Napza</th>
                            </tr>

                    <?php
                        $no = 1;
                        foreach($getData->listPekerjaAllExp() as $row){ ?>
                        <tr>
                            <td>'<?= $no++."."; ?></td>
                            <td>'<?= $row['_id_pekerja']; ?></td>
                            <td><?= $row['_nama_pekerja']; ?></td>
                            <td><?= $row['_nama_fungsi']; ?></td>
                            <td><?= $row['_status']; ?></td>
                            <td><?= $row['_kategori']; ?></td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        echo "Telah Checkup";
                                    }
                                    else { 
                                        echo "Belum Checkup";
                                    }
                                    ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo "'".$dataDCU['_waktu'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo "'".$dataDCU['_sistolik'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo "'".$dataDCU['_diastolik'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo "'".$dataDCU['_denyut_nadi'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_suhu_tubuh'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_frekuensi_nafas'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_riwayat_penyakit'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_detail_riwayat'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_konsumsi_obat'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_tujuan_obat'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_status_keluhan'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_keluhan'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_tingkat_kesadaran'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_pemeriksaan_mata'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_pemeriksaan_keseimbangan'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_pengaruh_alkohol'];
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_keterangan'];
                                                
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
                                        echo $dataDCU['_catatan'];
                                                
                                    }
                                    else {
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $tgl, $bln, $thn) > 0){
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $tgl, $bln, $thn);
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