<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }
?>
<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Rekap Data Daily Checkup Kategori High Risk</h5>

<?php
    if($getData->cekJumlahPekerja() > 0){ ?>

        <form method="POST" action="high-risk-checkup" class="form-table">
            <select name="kategori" class="select" required>
                <option value="" selected>- Pilih Kategori -</option>
                <?php
                    foreach($getData->ListKategoriNoHR() as $row){ ?>
                        <option value="<?= $row['_id_kategori']; ?>"><?= $row['_kategori']; ?></option>
            <?php }
                ?>
            </select>
            <input type="date" name="tanggal" required>
            <input type="submit" name="search" value="Cari">
        </form>
        
        <?php
            if(isset($_POST['search'])){
                $tanggal = $_POST['tanggal'];
                $thn = substr($tanggal, 0, 4);
                $bln = substr($tanggal, 5, 2);
                $day = substr($tanggal, 8, 2);

                if(!preg_match("/^[A-Z0-9-]*$/", $_POST['kategori'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Kategori tidak boleh mengandung karakter khusus !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "high-risk-checkup";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9\/-]*$/", $_POST['tanggal'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Format input tanggal tidak valid !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "high-risk-checkup";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                
                else {
                    $kategori = $getData->getKategoriPekerjaan($_POST['kategori']); ?>
                    <span style="font-size:14px;">DATA CHECKUP <i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; KATEGORI PEKERJAAN : <?= $kategori['_kategori']; ?> | TANGGAL : <?= strftime('%d %B %Y', strtotime($_POST['tanggal'])); ?> 
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
                            if(isset($_POST['kategori'])){
                                if($getData->cekTotalKategoriPekerjaan($_POST['kategori']) > 0){
                                    foreach($getData->listPekerjaAllbyKategori($_POST['kategori']) as $row){ ?>
                                        <tr>
                                            <td><?= $no++."."; ?></td>
                                            <td><?= $row['_id_pekerja']; ?></td>
                                            <td><?= $row['_nama_pekerja']; ?></td>
                                            <td><?= $row['_nama_fungsi']; ?></td>
                                            <td><?= $row['_status']; ?></td>
                                            <td><?= $row['_kategori']; ?></td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){ ?>
                                                        <span style="font-size:14px;color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                            <?php }
                                                    else { ?>
                                                        <span style="font-size:14px;color:red;"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                            <?php }
                                                    ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_sistolik'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_diastolik'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_denyut_nadi'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_suhu_tubuh'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_frekuensi_nafas'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_riwayat_penyakit'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_detail_riwayat'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_konsumsi_obat'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_tujuan_obat'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_status_keluhan'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_keluhan'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_tingkat_kesadaran'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_pemeriksaan_mata'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_pemeriksaan_keseimbangan'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_pengaruh_alkohol'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn); ?>
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
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_waktu'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
                                                        echo $dataDCU['_catatan'];
                                                    }
                                                    else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->cekDCUPekerja($row['_id_pekerja'], $day, $bln, $thn) > 0){
                                                        $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $day, $bln, $thn);
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
                                }
                                else { ?>
                                    <tr>
                                        <td style="text-align:center;" colspan="26"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                        <?php }
                            } ?>
                        </table>
                    </div>
                    <a href="pages/_act_export_8.php?kategori=<?= $_POST['kategori']; ?>&tanggal=<?= $day; ?>&bulan=<?= $bln; ?>&tahun=<?= $thn; ?>" class="linkTransferPg"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export</a>
         <?php  }
            }
            else { ?>
                <span style="color:red;font-size:13px;">Pilih Jenis Kategori Pekerjaan dan Tanggal Terlebih Dahulu !</span><br>
      <?php }  ?>
<?php }
      else { ?>
        <br><br>
        <span style="color:red;font-size:13px;">Belum ada data pegawai !</span><br>
<?php }
?>

