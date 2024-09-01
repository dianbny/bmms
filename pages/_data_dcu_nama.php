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

<label class="labelTitle"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Detail DCU Pekerja</label>
<br><br>

<span style="font-size:12px;font-weight:bold;">Detail Data Checkup</span><br><br>

<span style="font-size:12px;font-weight:bold;"><?= $id." | ".$dataPekerja['_nama_pekerja']; ?></span>

<div class="table-layout">
    <table class="table-style">
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