<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    $halaman = 100;
    $page = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;

    if(isset($_SESSION['page'])){
        unset($_SESSION['page']);
    }

    $_SESSION['page'] = $_GET['page'];

?>

<label class="labelTitle"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Medical Checkup Pekerja</label>

<?php
    if($getData->cekJumlahPekerjaPegawai() > 0){ ?>

    <form method="POST" action="data-mcu-pekerja" class="form-table">
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

        <div class="table-layout">
            <table class="table-style">
                <tr>
                    <th>No.</th>
                    <th>No. Pekerja</th>
                    <th>Nama Pekerja</th>
                    <th style="text-align:center;">Jenis Kelamin</th>
                    <th style="text-align:center;">Status MCU</th>
                    <th>Tanggal MCU</th>
                    <th>Berlaku Hingga</th>
                    <th style="text-align:center;">Keterangan</th>
                    <?php
                        if($dataUserLogin['_level_user'] == "Admin"){ ?>
                            <th style="text-align:center;">Aksi</th>
                  <?php }
                    ?>
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
                                                    window.location.href = "data-mcu-pekerja";
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
                                                    window.location.href = "data-mcu-pekerja";
                                                }
                                    }); }, 500);
                            </script>
                  <?php }
                        else {
                            $no = 1;
                            if(isset($_POST['function']) && empty($_POST['name'])){
                                if($getData->cekPekerjabyFungsi($_POST['function'], "PEKERJA") > 0){
                                    foreach($getData->listPekerjabyFungsi($_POST['function'], "PEKERJA") as $row){ ?>
                                        <tr>
                                            <td><?= $no++.'.'; ?></td>
                                            <td><?= $row['_id_pekerja']; ?></td>
                                            <td><?= $row['_nama_pekerja']; ?></td>
                                            <td style="text-align:center;"><?= $row['_jk']; ?></td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ ?>
                                                        <span style="font-size:14px;color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                              <?php }
                                                    else { ?>
                                                        <span style="font-size:14px;color:maroon;"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                              <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        echo strftime('%d %B %Y', strtotime($dataMCU['_tgl_mcu']));
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        echo strftime('%d %B %Y', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        $bulanA = date('m', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                        $bulanB = (int)$bulanA - 1; 
                                                        $tahun = date('Y', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                        
                                                        if($tahun == date('Y')){
                                                            if($bulanB == date('m')){ ?>
                                                                <span style="font-size:14px;color:orange;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                            elseif($bulanA <= date('m')){ ?>
                                                                <span style="font-size:14px;color:maroon;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                            elseif($bulanA > date('m')){ ?>
                                                                <span style="font-size:14px;color:green;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                        }
                                                        elseif($tahun < date('Y')){ ?>
                                                            <span style="font-size:14px;color:maroon;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                  <?php }
                                                        else { ?>
                                                            <span style="font-size:14px;color:green;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                  <?php }
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <?php
                                                if($dataUserLogin['_level_user'] == "Admin"){ ?>
                                                    <td style="text-align:center;"><a href="input-mcu-pekerja-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                                    
                                          <?php } 
                                          ?>   
                                        </tr>
                              <?php }
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="11" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                            elseif(isset($_POST['name']) && empty($_POST['function'])){
                                if($getData->cekPekerjabyNama($_POST['name'], "PEKERJA") > 0){
                                    foreach($getData->listPekerjabyNama($_POST['name'], "PEKERJA") as $row){ ?>
                                        <tr>
                                            <td><?= $no++.'.'; ?></td>
                                            <td><?= $row['_id_pekerja']; ?></td>
                                            <td><?= $row['_nama_pekerja']; ?></td>
                                            <td style="text-align:center;"><?= $row['_jk']; ?></td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ ?>
                                                        <span style="font-size:14px;color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                              <?php }
                                                    else { ?>
                                                        <span style="font-size:14px;color:maroon;"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                              <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        echo strftime('%d %B %Y', strtotime($dataMCU['_tgl_mcu']));
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        echo strftime('%d %B %Y', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        $bulanA = date('m', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                        $bulanB = (int)$bulanA - 1; 
                                                        $tahun = date('Y', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                        
                                                        if($tahun == date('Y')){
                                                            if($bulanB == date('m')){ ?>
                                                                <span style="font-size:14px;color:orange;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                            elseif($bulanA <= date('m')){ ?>
                                                                <span style="font-size:14px;color:maroon;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                            elseif($bulanA > date('m')){ ?>
                                                                <span style="font-size:14px;color:green;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                        }
                                                        elseif($tahun < date('Y')){ ?>
                                                            <span style="font-size:14px;color:maroon;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                  <?php }
                                                        else { ?>
                                                            <span style="font-size:14px;color:green;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                  <?php }
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <?php
                                                if($dataUserLogin['_level_user'] == "Admin"){ ?>
                                                    <td style="text-align:center;"><a href="input-mcu-pekerja-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                                    
                                          <?php } 
                                          ?>   
                                        </tr>
                              <?php }
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="11" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                            else {
                                if($getData->cekPekerjabyFungandNama($_POST['name'], $_POST['function'], "PEKERJA") > 0){
                                    foreach($getData->listPekerjabyFungandNama($_POST['name'], $_POST['function'], "PEKERJA") as $row){ ?>
                                        <tr>
                                            <td><?= $no++.'.'; ?></td>
                                            <td><?= $row['_id_pekerja']; ?></td>
                                            <td><?= $row['_nama_pekerja']; ?></td>
                                            <td style="text-align:center;"><?= $row['_jk']; ?></td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ ?>
                                                        <span style="font-size:14px;color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                              <?php }
                                                    else { ?>
                                                        <span style="font-size:14px;color:maroon;"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                              <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        echo strftime('%d %B %Y', strtotime($dataMCU['_tgl_mcu']));
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        echo strftime('%d %B %Y', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <td style="text-align:center;">
                                                <?php
                                                    if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                                        $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                                        $bulanA = date('m', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                        $bulanB = (int)$bulanA - 1; 
                                                        $tahun = date('Y', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                                        
                                                        if($tahun == date('Y')){
                                                            if($bulanB == date('m')){ ?>
                                                                <span style="font-size:14px;color:orange;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                            elseif($bulanA <= date('m')){ ?>
                                                                <span style="font-size:14px;color:maroon;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                            elseif($bulanA > date('m')){ ?>
                                                                <span style="font-size:14px;color:green;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                      <?php }
                                                        }
                                                        elseif($tahun < date('Y')){ ?>
                                                            <span style="font-size:14px;color:maroon;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                  <?php }
                                                        else { ?>
                                                            <span style="font-size:14px;color:green;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                                  <?php }
                                                    }
                                                    else { 
                                                        echo "-";
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <?php
                                                if($dataUserLogin['_level_user'] == "Admin"){ ?>
                                                    <td style="text-align:center;"><a href="input-mcu-pekerja-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                                    
                                          <?php } 
                                          ?>   
                                        </tr>
                            <?php }
                                }
                                else { ?>
                                    <tr>
                                        <td colspan="11" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                        }
                    }
                    else {
                        $pages = ceil($getData->cekJumlahPekerjaPegawai()/$halaman);
                    
                        $no = $mulai + 1;
                        foreach($getData->listPekerja("PEKERJA", $mulai, $halaman) as $row){ ?>
                            <tr>
                                <td><?= $no++.'.'; ?></td>
                                <td><?= $row['_id_pekerja']; ?></td>
                                <td><?= $row['_nama_pekerja']; ?></td>
                                <td style="text-align:center;"><?= $row['_jk']; ?></td>
                                <td style="text-align:center;">
                                    <?php
                                        if($getData->statusMCU($row['_id_pekerja']) > 0){ ?>
                                            <span style="font-size:14px;color:green;"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                                  <?php }
                                        else { ?>
                                            <span style="font-size:14px;color:maroon;"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                  <?php }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                            $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                            echo strftime('%d %B %Y', strtotime($dataMCU['_tgl_mcu']));
                                        }
                                        else { 
                                            echo "-";
                                        }
                                                    
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                            $dataMCU = $getData->getDataMCU($row['_id_pekerja']);
                                            echo strftime('%d %B %Y', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                        }
                                        else { 
                                            echo "-";
                                        }
                                                    
                                    ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php
                                        if($getData->statusMCU($row['_id_pekerja']) > 0){ 
                                            $dataMCU = $getData->getDataMCU($row['_id_pekerja']); 
                                            $bulanA = date('m', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                            $bulanB = (int)$bulanA - 1; 
                                            $tahun = date('Y', strtotime($dataMCU['_tgl_kadaluarsa_mcu']));
                                            
                                            if($tahun == date('Y')){
                                                if($bulanB == date('m')){ ?>
                                                    <span style="font-size:14px;color:orange;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                          <?php }
                                                elseif($bulanA <= date('m')){ ?>
                                                    <span style="font-size:14px;color:maroon;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                          <?php }
                                                elseif($bulanA > date('m')){ ?>
                                                    <span style="font-size:14px;color:green;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                          <?php }
                                            }
                                            elseif($tahun < date('Y')){ ?>
                                                <span style="font-size:14px;color:maroon;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                      <?php }
                                            else { ?>
                                                <span style="font-size:14px;color:green;"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                      <?php }
                                            
                                        }
                                        else { 
                                            echo "-";
                                        }
                                                    
                                    ?>
                                </td>
                                <?php
                                    if($dataUserLogin['_level_user'] == "Admin"){ ?>
                                        <td style="text-align:center;"><a href="input-mcu-pekerja-<?= $row['_id_pekerja']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                        
                              <?php }
                                ?>
                            </tr>
                  <?php }  ?> 
                            <tr>
                                <td>Halaman</td>
                                <td colspan="11" style="text-align:left;font-size:14px;">
                                    <?php
                                        for ($i=1; $i<=$pages ; $i++){ ?>
                                            <a href="data-mcu-pekerja-halaman-<?= $i; ?>" class="linkDetail"><?= " ".$i." "; ?></a>
                                  <?php }
                                        ?>
                                </td>
                            </tr>
           <?php    }
                ?>  
            </table>
        </div>
<?php }
      else { ?>
        <br><br>
        <span style="color:red;">Belum ada data pegawai !</span><br>
<?php }
?>
<br>

<a href="data-mcu-pekerja" class="linkTransferPg"><i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Refresh</a>
