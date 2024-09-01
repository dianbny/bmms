<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    } 
    
?>

<label class="labelTitle"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Persentase Daily Checkup Bulanan</label>

<?php
    if($getData->cekJumlahPekerja() > 0){ ?>

        <form method="POST" action="persentase-dcu-bulanan" class="form-table">
            <select name="function" class="select" required>
                <option value="" selected>- Pilih Fungsi -</option>
                <?php
                    foreach($getData->listFungsi() as $row){ ?>
                        <option value="<?= $row['_id_fungsi']; ?>"><?= $row['_nama_fungsi']; ?></option>
            <?php }
                ?>
            </select>
            <select name="month" class="select" required>
                <option value="" selected>- Pilih Bulan -</option>
                <?php
                    for($i = 0; $i <= 11; $i++){ 
                        $bln = $i+1; 
                        $namaBln = strftime('%B', strtotime($i.'month', strtotime($bln)));
                        ?>
                        <option value="<?= $bln; ?>"><?= $namaBln; ?></option>
              <?php }
                ?>
            </select>
            <select name="year" class="select" required>
                <option value="" selected>- Pilih Tahun -</option>
                <?php
                    for($i = date('Y', strtotime('-2 Year', strtotime(date('Y')))); $i <= date('Y', strtotime('+5 Year', strtotime(date('Y')))); $i++){ ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php }
                ?>
            </select>
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
                    <span style="font-size:14px;">PERSENTASE CHECKUP <i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; FUNGSI : <?= $namaFungsi['_nama_fungsi']; ?> | BULAN : <?= $_POST['month']; ?> | TAHUN : <?= $_POST['year']; ?>
                    <div class="table-layout">
                        <table class="table-style">
                            <tr>
                                <th rowspan="2" style="text-align:center;">Tanggal</th>
                                <th colspan="6" style="text-align:center;">PEKERJA</th>
                                <th colspan="6" style="text-align:center;">TKJP/MK</th>
                                    <tr>
                                        <th style="text-align:center;">DCU</th>
                                        <th style="text-align:center;">Fit</th>
                                        <th style="text-align:center;">Unfit</th>
                                        <th style="text-align:center;">Persentase</th>
                                        <th style="text-align:center;">Status</th>
                                        
                                        <th style="text-align:center;">DCU</th>
                                        <th style="text-align:center;">Fit</th>
                                        <th style="text-align:center;">Unfit</th>
                                        <th style="text-align:center;">Persentase</th>
                                        <th style="text-align:center;">Status</th>
                                    </tr>
                            </tr>
                            <?php
                            if(isset($_POST['function'])){
                                if($getData->cekPekerjaAllbyFungsi($_POST['function']) > 0){
                                    for($i = 1; $i <= $jumTgl; $i++){ 
                                        $totalMasuk = $getData->getNamaFungsi($_POST['function']);

                                        $dcuPekerjaDay = $getData->jumlahDCUFungsiDay(date($_POST['year']."-".$_POST['month']."-".$i), $_POST['function'], "PEKERJA");
                                        $dcuTKJPDay = $getData->jumlahDCUFungsiDay(date($_POST['year']."-".$_POST['month']."-".$i), $_POST['function'], "TKJP/MK"); 
                                    
                                        $dcuPekerjaDayOld = $getData->jumlahDCUFungsiDay(date('Y-m-d', strtotime("-1 day", strtotime(date($_POST['year']."-".$_POST['month']."-".$i)))), $_POST['function'], "PEKERJA");
                                        $dcuTKJPDayOld = $getData->jumlahDCUFungsiDay(date('Y-m-d', strtotime("-1 day", strtotime(date($_POST['year']."-".$_POST['month']."-".$i)))), $_POST['function'], "TKJP/MK");
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?= strftime('%d %B %Y', strtotime($_POST['year']."-".$_POST['month']."-".$i)); ?></td>
                                            <td style="text-align:center;"><?= $dcuPekerjaDay; ?></td>
                                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($_POST['function'], date($_POST['year']."-".$_POST['month']."-".$i), "FIT", "PEKERJA"); ?></td>
                                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($_POST['function'], date($_POST['year']."-".$_POST['month']."-".$i), "UNFIT", "PEKERJA"); ?></td>
                                            <td style="text-align:center;"><?= ($dcuPekerjaDay != 0) ? ceil($dcuPekerjaDay/$totalMasuk['_total_masuk_pekerja']*100) : 0; ?> &nbsp;%</td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($dcuPekerjaDay > $dcuPekerjaDayOld){ ?>
                                                        <span style="color:green;font-size:14px;"><i class="fa fa-sort-asc" aria-hidden="true"></i></span>
                                                <?php }
                                                    elseif($dcuPekerjaDay < $dcuPekerjaDayOld){ ?>
                                                        <span style="color:maroon;font-size:14px;"><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                                                <?php }
                                                    else { ?>
                                                        <span style="color:orange;font-size:12px;"><i class="fa fa-exchange" aria-hidden="true"></i></span>
                                                <?php }
                                                ?>
                                            </td>

                                            <td style="text-align:center;"><?= $dcuTKJPDay; ?></td>
                                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($_POST['function'], date($_POST['year']."-".$_POST['month']."-".$i), "FIT", "TKJP/MK"); ?></td>
                                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($_POST['function'], date($_POST['year']."-".$_POST['month']."-".$i), "UNFIT", "TKJP/MK"); ?></td>
                                            <td style="text-align:center;"><?= ($dcuTKJPDay != 0) ? ceil($dcuTKJPDay/$totalMasuk['_total_masuk_tkjp']*100) : 0; ?> &nbsp;%</td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($dcuTKJPDay > $dcuTKJPDayOld){ ?>
                                                        <span style="color:green;font-size:14px;"><i class="fa fa-sort-asc" aria-hidden="true"></i></span>
                                                <?php }
                                                    elseif($dcuTKJPDay < $dcuTKJPDayOld){ ?>
                                                        <span style="color:maroon;font-size:14px;"><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                                                <?php }
                                                    else { ?>
                                                        <span style="color:orange;font-size:12px;"><i class="fa fa-exchange" aria-hidden="true"></i></span>
                                                <?php }
                                                ?>
                                            </td>
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
                    <a href="pages/_act_export_6.php?fungsi=<?= $_POST['function']; ?>&bulan=<?= $_POST['month']; ?>&tahun=<?= $_POST['year']; ?>" class="linkTransferPg"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export</a>
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



