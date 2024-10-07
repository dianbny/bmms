<?php
    error_reporting(0);
    session_start();
    
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    require_once '../config/_getData.php';
    $getData = new _getData();

    $id = $_GET['id'];
    $dataPekerja = $getData->getDataPekerja($id);
    $bln = $_GET['bulan'];
    $thn = $_GET['tahun'];
    $jumTgl = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);

?>
    <h3>Daily Checkup : <?= $id. " | ".$dataPekerja['_nama_pekerja']." | ".$bln." | ".$thn; ?></h3>
                <div class="table-layout">
                    <?php
                        header("Content-type: application/vnd-ms-excel");
                        header("Content-Disposition: attachment; filename=Daily Checkup $id Bulan $bln Tahun $thn.xls");
                    ?>
                     <table>
                     <tr>
                        <th style="text-align:center;width:100px;" rowspan="2">Tanggal</th>
                        <th style="text-align:center;" rowspan="2">Status Checkup</th>
                        <th style="text-align:center;" colspan="5">Pemeriksaan Vital</th>
                        <th style="text-align:center;" colspan="10">Anamnesis/Pemeriksaan Fisik</th>
                        <th style="text-align:center;" rowspan="2">Hasil (Fit/Unfit)</th>
                        <th style="text-align:center;" rowspan="2">Waktu</th>
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
                                    <td style="text-align:center;">
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_suhu_tubuh'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_frekuensi_nafas'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_riwayat_penyakit'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_detail_riwayat'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_konsumsi_obat'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_tujuan_obat'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_status_keluhan'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_keluhan'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_tingkat_kesadaran'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_pemeriksaan_mata'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_pemeriksaan_keseimbangan'];
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                                echo $dataDCU['_pengaruh_alkohol'];
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