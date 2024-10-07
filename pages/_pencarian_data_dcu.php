<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    } 
    
?>

<label class="labelTitle"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Pencarian Data Checkup</label>

<?php
    
    if($getData->cekJumlahPekerja() > 0){ ?>

        <form method="POST" action="pencarian-data-checkup" class="form-table">
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
            <input type="text" name="name" placeholder="Pencarian Berdasarkan Nama" required>
            <input type="submit" name="search" value="Cari">
        </form>

        <?php

            if(isset($_POST['search'])){ 
                if(!preg_match("/^[a-zA-Z .']*$/", $_POST['name'])){ ?>
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
                    if($getData->cekPekerjaAllbyNama($_POST['name']) > 0){ ?>
                        <div class="table-layout">
                            <table class="table-style">
                                <tr>
                                    <th>No.</th>
                                    <th>No. Pekerja/TKJP/MK</th>
                                    <th>Nama Pekerja/TKJP/MK</th>
                                    <th>Fungsi</th>
                                    <th>Status</th>
                                    <th>Perusahaan</th>
                                    <th style="text-align:center;">Detail</th>
                                </tr>
                                <?php
                                    $no = 1;
                                    foreach($getData->listPekerjaAllbyNama($_POST['name']) as $row){ ?>
                                        <tr>
                                            <td><?= $no++."."; ?></td>
                                            <td><?= $row['_id_pekerja']; ?></td>
                                            <td><?= $row['_nama_pekerja']; ?></td>
                                            <td><?= $row['_nama_fungsi']; ?></td>
                                            <td><?= $row['_status']; ?></td>
                                            <td><?= $row['_perusahaan']; ?></td>
                                            <td style="text-align:center;"><a href="detail-data-checkup-pekerja-<?= $row['_id_pekerja']; ?>-<?= $_POST['month']; ?>-<?= $_POST['year']; ?>" class="linkDetail"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                                        </tr>
                              <?php }
                                ?>
                            </table>
                        </div>
              <?php }
                    else { ?> 

                        <span style="color:red;font-size:13px;">Data Tidak Ditemukan !</span><br>
              <?php }
                } ?>

            <a href="pencarian-data-checkup" class="linkTransferPg"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; Kembali</a>
      <?php }
            else { ?>
                <span style="color:red;font-size:13px;">Pilih Bulan, Tahun dan Nama Pekerja/TKJP/MK Terlebih Dahulu !</span><br>
      <?php }
    }
    else { ?>
        <br><br>
        <span style="color:red;">Belum ada data pegawai !</span><br>
<?php }
?>

