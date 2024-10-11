<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    } 

    if(isset($_GET['id']) && isset($_GET['bulan']) && isset($_GET['tahun'])){
        $id = $_GET['id'];
        $dataPekerja = $getData->getDataPekerja($id);

        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];

        $jumTgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    }
    
?>

<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Detail DCU Pekerja</h5>
<br><br>

<span style="font-size:12px;font-weight:bold;">Detail Data Checkup</span><br><br>

<span style="font-size:12px;font-weight:bold;"><?= $id." | ".$dataPekerja['_nama_pekerja']. " | " .$dataPekerja['_status']; ?></span>

<div class="table-layout">
    <table class="table-style">
        <tr>
            <th style="text-align:center;" rowspan="2">Tanggal</th>
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
                    <td style="text-align:center;"><?= strftime('%d %B %Y', strtotime($tahun."-".$bulan."-".$i)); ?></td>
                    <td style="text-align:center;">
                        <?php
                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){ ?>
                                <span style="font-size:14px;color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                      <?php }
                            else { ?>
                                <span style="font-size:14px;color:red;"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                      <?php }
                            ?>
                    </td>
                    <td style="text-align:center;">
                        <?php
                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                echo $dataDCU['_sistolik'];
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
                                echo $dataDCU['_diastolik'];
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
                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun); ?>
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
                            if($getData->cekDCUPekerja($id, $i, $bulan, $tahun) > 0){
                                $dataDCU = $getData->getDataDCU($id, $i, $bulan, $tahun);
                                echo $dataDCU['_waktu'];
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

<a href="pencarian-data-checkup" class="linkTransferPg"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; Kembali</a>
<a href="pages/_act_export_4.php?id=<?= $id; ?>&bulan=<?= $bulan; ?>&tahun=<?= $tahun; ?>" class="linkTransferPg"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export</a>