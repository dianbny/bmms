<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    } 
    
?>

<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Persentase Daily Checkup Bulanan Kategori High Risk</h5>

<?php
    if($getData->cekJumlahPekerja() > 0){ ?>

        <form method="POST" action="persentase-dcu-high-risk" class="form-table">
            <select name="kategori" class="select" required>
                <option value="" selected>- Pilih Kategori -</option>
                <?php
                    foreach($getData->ListKategoriNoHR() as $row){ ?>
                        <option value="<?= $row['_id_kategori']; ?>"><?= $row['_kategori']; ?></option>
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
                                            window.location.href = "persentase-dcu-high-risk";
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
                                            window.location.href = "persentase-dcu-high-risk";
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
                                            window.location.href = "persentase-dcu-high-risk";
                                        }
                            }); }, 500);
                    </script>
          <?php }
                else {
                    $jumTgl = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
                    $kategori = $getData->getKategoriPekerjaan($_POST['kategori']); ?>
                    <span style="font-size:14px;">PERSENTASE CHECKUP <i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp; KATEGORI PEKERJAAN : <?= $kategori['_kategori']; ?> | BULAN : <?= $_POST['month']; ?> | TAHUN : <?= $_POST['year']; ?>
                    <div class="table-layout">
                        <table class="table-style">
                            <tr>
                                <th style="text-align:center;" rowspan="2">Tanggal</th>
                                <th style="text-align:center;" rowspan="2">Total Pekerja</th>
                                <th style="text-align:center;" colspan="5">Checkup Harian</th>
        
                            </tr>

                                <tr>
                                    <th style="text-align:center;">DCU</th>
                                    <th style="text-align:center;">Fit</th>
                                    <th style="text-align:center;">Unfit</th>
                                    <th style="text-align:center;">Persentase</th>
                                    <th style="text-align:center;">Status</th>

                                            
                                </tr>
                            
                            <?php
                            if(isset($_POST['kategori'])){
                                if($getData->cekTotalKategoriPekerjaan($_POST['kategori']) > 0){
                                    for($i = 1; $i <= $jumTgl; $i++){ 
                                        
                                        $dcuHRDay = $getData->jumlahDCUHRDay(date($_POST['year']."-".$_POST['month']."-".$i), $_POST['kategori']);
                                    
                                        $dcuHRDayOld = $getData->jumlahDCUHRDay(date('Y-m-d', strtotime("-1 day", strtotime(date($_POST['year']."-".$_POST['month']."-".$i)))), $_POST['kategori']);
                                        

                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?= strftime('%d %B %Y', strtotime($_POST['year']."-".$_POST['month']."-".$i)); ?></td>
                                            <td style="text-align:center;"><?= $getData->cekTotalKategoriPekerjaan($_POST['kategori']); ?></td>
                                            <td style="text-align:center;"><?= $dcuHRDay; ?></td>
                                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUKategori($_POST['kategori'], date($_POST['year']."-".$_POST['month']."-".$i), "FIT"); ?></td>
                                            <td style="text-align:center;"><?= $getData->cekKeteranganDCUKategori($_POST['kategori'], date($_POST['year']."-".$_POST['month']."-".$i), "UNFIT"); ?></td>
                                            <td style="text-align:center;"><?= ($dcuHRDay != 0) ? ceil($dcuHRDay/$getData->cekTotalKategoriPekerjaan($_POST['kategori'])*100) : 0; ?> &nbsp;%</td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($dcuHRDay > $dcuHRDayOld){ ?>
                                                        <span style="color:green;font-size:14px;"><i class="fa fa-sort-asc" aria-hidden="true"></i></span>
                                                <?php }
                                                    elseif($dcuHRDay < $dcuHRDayOld){ ?>
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
                                        <td colspan="12"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                        <?php }
                            } ?>
                        </table>
                    </div>
                    <a href="pages/_act_export_9.php?kategori=<?= $_POST['kategori']; ?>&bulan=<?= $_POST['month']; ?>&tahun=<?= $_POST['year']; ?>" class="linkTransferPg"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export</a>
         <?php  }
            }
            else { ?>
                <span style="color:red;font-size:13px;">Pilih Kategori, Bulan dan Tahun Terlebih Dahulu !</span><br>
      <?php }  ?>
<?php }
      else { ?>
        <br><br>
        <span style="color:red;font-size:13px;">Belum ada data pegawai !</span><br>
<?php }
?>



