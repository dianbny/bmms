<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }
    
    $halaman = 50;
    $page = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
?>

<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Daftar Pekerja / TKJP/ Mitra Kerja</h5>

<?php
    if($getData->cekJumlahPekerja() > 0){ ?>

    <form method="POST" action="data-checkup" class="form-table">
        <select name="function" class="select">
            <option value="" selected>- Pilih Fungsi -</option>
            <?php
                foreach($getData->listFungsi() as $row){ ?>
                    <option value="<?= $row['_id_fungsi']; ?>"><?= $row['_nama_fungsi']; ?></option>
          <?php }
            ?>
        </select>
        <input type="text" name="name" placeholder="Pencarian Berdasarkan Nama">
        <input type="submit" name="search" value="Cari">
    </form>

    <span style="font-size:12px;font-weight:bold;">Daily Checkup : <?= strftime('%d %B %Y', strtotime(date('Y-m-d'))); ?></span>

        <div class="table-layout">
            <table class="table-style">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">No. Pekerja/TKJP/MK</th>
                    <th rowspan="2">Nama Pekerja/TKJP/MK</th>
                    <th rowspan="2">Fungsi</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2">Kategori Pekerjaan</th>
                    <th style="text-align:center;" rowspan="2">Checkup</th>
                    <th style="text-align:center;" colspan="5">Pemeriksaan Vital</th>
                    <th style="text-align:center;" colspan="10">Anamnesis/Pemeriksaan Fisik</th>
                    <th style="text-align:center;" rowspan="2">Hasil (Fit/Unfit)</th>
                    <th style="text-align:center;" rowspan="2">Waktu</th>
                    <th rowspan="2">Pemeriksa (Medic)</th>
                    <th style="text-align:center;" colspan="2" rowspan="2">Aksi</th>
                
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
                    if(isset($_POST['search'])){
                        if(!preg_match("/^[A-Z0-9-]*$/", $_POST['function'])){ ?>
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Terjadi Kesalahan !",
                                        text: "Fungsi tidak boleh mengandung karakter khusus !",
                                        type: "error",
                                        confirmButtonText: "OK"
                                        },
                                            function(isConfirm){
                                                if (isConfirm) {
                                                    window.location.href = "data-checkup";
                                                }
                                    }); }, 500);
                            </script>
                  <?php }
                        elseif(!preg_match("/^[a-zA-Z .']*$/", $_POST['name'])){ ?>
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Terjadi Kesalahan !",
                                        text: "Nama tidak boleh mengandung angka/karakter khusus !",
                                        type: "error",
                                        confirmButtonText: "OK"
                                        },
                                            function(isConfirm){
                                                if (isConfirm) {
                                                    window.location.href = "data-checkup";
                                                }
                                    }); }, 500);
                            </script>
                  <?php }
                        else {
                            $no = 1;
                            if(isset($_POST['function']) && empty($_POST['name'])){
                                if($getData->cekPekerjaAllbyFungsi($_POST['function']) > 0){
                                    foreach($getData->listPekerjaAllbyFungsi($_POST['function']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++."."; ?></td>
                                        <td><?= $row['_id_pekerja']; ?></td>
                                        <td><?= $row['_nama_pekerja']; ?></td>
                                        <td><?= $row['_nama_fungsi']; ?></td>
                                        <td><?= $row['_status']; ?></td>
                                        <td><?= $row['_kategori']; ?></td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <span style="font-size:14px;color:black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                        <?php }
                                                else { ?>
                                                    <a href="input-data-checkup-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
                                        <?php }
                                                ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_sistolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_diastolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_denyut_nadi'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_suhu_tubuh'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_frekuensi_nafas'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_riwayat_penyakit'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_detail_riwayat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_konsumsi_obat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_tujuan_obat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_status_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_tingkat_kesadaran'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pemeriksaan_mata'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pemeriksaan_keseimbangan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pengaruh_alkohol'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y')); ?>
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
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_waktu'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    $dataMedic = $getData->getDataPekerja($dataDCU['_medic']);
    
                                                    echo $dataMedic['_nama_pekerja'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="edit-data-checkup-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="javascript:void(0)" class="linkError konfirmDeleteDCU" data-id="<?= $row['_id_pekerja']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                              <?php }
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="26" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                            elseif(isset($_POST['name']) && empty($_POST['function'])){
                                if($getData->cekPekerjaAllbyNama($_POST['name']) > 0){
                                    foreach($getData->listPekerjaAllbyNama($_POST['name']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++."."; ?></td>
                                        <td><?= $row['_id_pekerja']; ?></td>
                                        <td><?= $row['_nama_pekerja']; ?></td>
                                        <td><?= $row['_nama_fungsi']; ?></td>
                                        <td><?= $row['_status']; ?></td>
                                        <td><?= $row['_kategori']; ?></td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <span style="font-size:14px;color:black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                        <?php }
                                                else { ?>
                                                    <a href="input-data-checkup-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
                                        <?php }
                                                ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_sistolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_diastolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_denyut_nadi'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_suhu_tubuh'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_frekuensi_nafas'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_riwayat_penyakit'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_detail_riwayat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_konsumsi_obat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_tujuan_obat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_status_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_tingkat_kesadaran'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pemeriksaan_mata'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pemeriksaan_keseimbangan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pengaruh_alkohol'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y')); ?>
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
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_waktu'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    $dataMedic = $getData->getDataPekerja($dataDCU['_medic']);
    
                                                    echo $dataMedic['_nama_pekerja'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="edit-data-checkup-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="javascript:void(0)" class="linkError konfirmDeleteDCU" data-id="<?= $row['_id_pekerja']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                    </tr>   
                              <?php }
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="26" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                            else {
                                if($getData->cekPekerjaAllbyFungandNama($_POST['name'], $_POST['function']) > 0){
                                    foreach($getData->listPekerjaAllbyFungandNama($_POST['name'], $_POST['function']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++."."; ?></td>
                                        <td><?= $row['_id_pekerja']; ?></td>
                                        <td><?= $row['_nama_pekerja']; ?></td>
                                        <td><?= $row['_nama_fungsi']; ?></td>
                                        <td><?= $row['_status']; ?></td>
                                        <td><?= $row['_kategori']; ?></td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <span style="font-size:14px;color:black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                        <?php }
                                                else { ?>
                                                    <a href="input-data-checkup-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
                                        <?php }
                                                ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_sistolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_diastolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_denyut_nadi'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_suhu_tubuh'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_frekuensi_nafas'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_riwayat_penyakit'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_detail_riwayat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_konsumsi_obat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_tujuan_obat'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_status_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_tingkat_kesadaran'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pemeriksaan_mata'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pemeriksaan_keseimbangan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_pengaruh_alkohol'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y')); ?>
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
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_waktu'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                                    $dataMedic = $getData->getDataPekerja($dataDCU['_medic']);
    
                                                    echo $dataMedic['_nama_pekerja'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="edit-data-checkup-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUPekerja($row['_id_pekerja'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="javascript:void(0)" class="linkError konfirmDeleteDCU" data-id="<?= $row['_id_pekerja']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                    </tr>
                            <?php }
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="26" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                        }
                    }
                    else {
                        if($getData->cekDCUbyTglAll(date('d'), date('m'), date('Y')) > 0){

                            $pages = ceil($getData->cekDCUbyTglAll(date('d'), date('m'), date('Y'))/$halaman);
                        
                            $no = $mulai + 1;
                            foreach($getData->listDCUAllbyDateAll(date('d'), date('m'), date('Y'), $mulai, $halaman) as $row){ ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $row['_id_pekerja']; ?></td>
                                <td><?= $row['_nama_pekerja']; ?></td>
                                <td><?= $row['_nama_fungsi']; ?></td>
                                <td><?= $row['_status']; ?></td>
                                <td><?= $row['_kategori']; ?></td>
                                <td style="text-align:center;"><span style="font-size:14px;color:black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></td>
                                <td style="text-align:center;"><?= $row['_sistolik']; ?></td>
                                <td style="text-align:center;"><?= $row['_diastolik']; ?></td>
                                <td style="text-align:center;"><?= $row['_denyut_nadi']; ?></td>
                                <td style="text-align:center;"><?= $row['_suhu_tubuh']; ?></td>
                                <td><?= $row['_frekuensi_nafas']; ?></td>
                                <td><?= $row['_riwayat_penyakit']; ?></td>
                                <td><?= $row['_detail_riwayat']; ?></td>
                                <td><?= $row['_konsumsi_obat']; ?></td>
                                <td><?= $row['_tujuan_obat']; ?></td>
                                <td><?= $row['_status_keluhan']; ?></td>
                                <td><?= $row['_keluhan']; ?></td>
                                <td><?= $row['_tingkat_kesadaran']; ?></td>
                                <td><?= $row['_pemeriksaan_mata']; ?></td>
                                <td><?= $row['_pemeriksaan_keseimbangan']; ?></td>
                                <td><?= $row['_pengaruh_alkohol']; ?></td>
                                <td style="text-align:center;">
                                    <span class="span-ket-dcu" style="background-color:<?= ($row['_keterangan']) == "FIT" ? 'green' : 'red'; ?>">
                                        <?= $row['_keterangan']; ?>
                                    </span>
                                </td>
                                <td style="text-align:center;"><?= $row['_waktu']; ?></td>
                                <td>
                                    <?php
                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], date('d'), date('m'), date('Y'));
                                        $dataMedic = $getData->getDataPekerja($dataDCU['_medic']);

                                        echo $dataMedic['_nama_pekerja'];
                                    ?>
                                </td>
                                <td style="text-align:center;"><a href="edit-data-checkup-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
                                <td style="text-align:center;"><a href="javascript:void(0)" class="linkError konfirmDeleteDCU" data-id="<?= $row['_id_pekerja']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                            </tr>
                    <?php } ?>   
                            <tr>
                                <td>Halaman</td>
                                <td colspan="26" style="text-align:left;font-size:14px;">
                                    <?php
                                        for ($i=1; $i<=$pages ; $i++){ ?>
                                            <a href="data-checkup-halaman-<?= $i; ?>" class="linkDetail"><?= " ".$i." "; ?></a>
                                <?php }
                                        ?>
                                </td>
                            </tr>
                 <?php }
                        else { ?>
                            <tr>
                                <td colspan="26" style="text-align:center;"><span style="color:red;">Belum Ada Data Checkup !</span></td>
                            </tr>
                  <?php }
                    }
                ?>  
            </table>
        </div>
<?php }
      else { ?>
        <br><br>
        <span style="color:red;">Belum ada data pegawai !</span><br>
<?php }
?>
<a href="data-checkup" class="linkTransferPg"><i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Refresh</a>
<a href="pages/_act_export_1.php?tanggal=<?= date('d'); ?>&bulan=<?= date('m'); ?>&tahun=<?= date('Y'); ?>" class="linkTransferPg"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export</a>
