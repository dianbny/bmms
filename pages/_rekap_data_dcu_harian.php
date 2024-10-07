<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }
?>
<label class="labelTitle"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Rekap Data Daily Checkup</label>

<?php
    if($getData->cekJumlahPekerja() > 0){ ?>

        <form method="POST" action="rekap-data-checkup-harian" class="form-table">
            <select name="function" class="select" required>
                <option value="" selected>- Pilih Fungsi -</option>
                <?php
                    foreach($getData->listFungsi() as $row){ ?>
                        <option value="<?= $row['_id_fungsi']; ?>"><?= $row['_nama_fungsi']; ?></option>
            <?php }
                ?>
            </select>
            <input type="date" name="tanggal">
            <input type="submit" name="search" value="Cari">
        </form>
        
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
                                            window.location.href = "rekap-data-checkup";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['month'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Format input bulan tidak valid !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "rekap-data-checkup";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                elseif(!preg_match("/^[0-9]*$/", $_POST['year'])){ ?>
                    <script>
                        setTimeout(function() { 
                            swal({
                                title: "Terjadi Kesalahan !",
                                text: "Tahun hanya boleh mengandung angka !",
                                type: "error",
                                confirmButtonText: "OK"
                                },
                                    function(isConfirm){
                                        if (isConfirm) {
                                            window.location.href = "rekap-data-checkup";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $jumTgl = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
                    $namaFungsi = $getData->getNamaFungsi($_POST['function']); ?>
                    <span style="font-size:14px;">DATA CHECKUP <i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; FUNGSI : <?= $namaFungsi['_nama_fungsi']; ?> | BULAN : <?= $_POST['month']; ?> | TAHUN : <?= $_POST['year']; ?>
                    <div class="table-layout">
                        <table class="table-style">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">No. Pekerja</th>
                                <th rowspan="2">Nama Pekerja/TKJP/MK</th>
                                <th rowspan="2">Fungsi</th>
                                <th rowspan="2">Status</th>
                                <th rowspan="2">Kategori Pekerjaan</th>
                                <th rowspan="2">Total DCU</th>
                                <?php
                                    for ($i = 1; $i <= $jumTgl; $i++){ ?>

                                        <th colspan="6" style="text-align:center;"><?= $i; ?></th>
                            <?php } ?>
                            </tr>
                            
                                <tr>
                                <?php
                                    for ($i = 1; $i <= $jumTgl; $i++){ ?>
                                        <th style="text-align:center;">Sis.</th>
                                        <th style="text-align:center;">Dia.</th>
                                        <th style="text-align:center;">DN</th>
                                        <th style="text-align:center;">Suhu</th>
                                        <th style="text-align:center;">Frek. Nafas</th>
                                        <th style="text-align:center;">Ket.</th>
                            <?php } ?>
                                </tr>
                            
                            <?php
                            $no = 1;
                            if(isset($_POST['function'])){
                                if($getData->cekPekerjaAllbyFungsi($_POST['function']) > 0){
                                    foreach($getData->listPekerjaAllbyFungsi($_POST['function']) as $row){ ?>
                                        <tr>
                                            <td><?= $no++."."; ?></td>
                                            <td><?= $row['_id_pekerja']; ?></td>
                                            <td><?= $row['_nama_pekerja']; ?></td>
                                            <td><?= $row['_nama_fungsi']; ?></td>
                                            <td><?= $row['_status']; ?></td>
                                            <td><?= $row['_kategori']; ?></td>
                                            <td style="text-align:center;"><?= $getData->cekDCUPekerjaBln($row['_id_pekerja'], (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y')); ?></td>
                                            <?php
                                                for ($i = 1; $i <= $jumTgl; $i++){ ?>
                                                    <td style="text-align:center;">
                                                        <?php
                                                            if($getData->cekDCUPekerja($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y')) > 0){
                                                                $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y'));
                                                                echo $dataDCU['_sistolik'];
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <?php
                                                        if($getData->cekDCUPekerja($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y')) > 0){
                                                            $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y'));
                                                                echo $dataDCU['_diastolik'];
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <?php
                                                            if($getData->cekDCUPekerja($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y')) > 0){
                                                                $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y'));
                                                                echo $dataDCU['_denyut_nadi'];
                                                            }
                                                            
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if($getData->cekDCUPekerja($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y')) > 0){
                                                                $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y'));
                                                                echo $dataDCU['_suhu_tubuh'];
                                                            }
                                                            
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if($getData->cekDCUPekerja($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y')) > 0){
                                                                $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y'));
                                                                echo $dataDCU['_frekuensi_nafas'];
                                                            }
                                                            
                                                        ?> 
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <?php
                                                            if($getData->cekDCUPekerja($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y')) > 0){
                                                                $dataDCU = $getData->getDataDCU($row['_id_pekerja'], $i, (isset($_POST['month']) && !empty($_POST['month'])) ? $_POST['month'] : date('m'), (isset($_POST['year']) && !empty($_POST['year'])) ? $_POST['year'] : date('Y'));

                                                                    if($dataDCU['_keterangan'] == "FIT"){ ?>
                                                                        <span style="font-size:14px;color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                                            <?php }
                                                                    else { ?>
                                                                        <span style="font-size:14px;color:red;"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                                            <?php }
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                        <?php } ?>
                                        </tr>
                                <?php } 
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="<?= 6 + ($jumTgl*5); ?>"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                        <?php }
                            } ?>
                        </table>
                    </div>
                    <a href="pages/_act_export_2.php?fungsi=<?= $_POST['function']; ?>&bulan=<?= $_POST['month']; ?>&tahun=<?= $_POST['year']; ?>" class="linkTransferPg"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export</a>
         <?php  }
            }
            else { ?>
                <span style="color:red;font-size:13px;">Pilih Fungsi, Bulan dan Tahun Terlebih Dahulu !</span><br>
      <?php }  ?>
<?php }
      else { ?>
        <br><br>
        <span style="color:red;font-size:13px;">Belum ada data pegawai !</span><br>
<?php }
?>

