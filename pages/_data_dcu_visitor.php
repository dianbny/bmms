<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }
    
    $halaman = 50;
    $page = (isset($_GET["halaman"])) ? (int)$_GET["halaman"] : 1;
    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
?>

<label class="labelTitle"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Daftar Pengunjung (Visitor) </label>

<?php
    if($getData->cekJumlahVisitor() > 0){ ?>

    <form method="POST" action="data-checkup-visitor" class="form-table">
        <select name="agency" class="select">
            <option value="" selected>- Pilih Asal Instansi -</option>
            <?php
                foreach($getData->listInstansi() as $row){ ?>
                    <option value="<?= $row['_id_instansi']; ?>"><?= $row['_nama_instansi']; ?></option>
          <?php }
            ?>
        </select>
        <input type="text" name="name" placeholder="Pencarian Berdasarkan Nama">
        <input type="submit" name="search" value="Cari">
    </form>

    <span style="font-size:12px;font-weight:bold;">Daily Checkup Visitor Checkup : <?= strftime('%d %B %Y', strtotime(date('Y-m-d'))); ?></span>

        <div class="table-layout">
            <table class="table-style">
                <tr>
                    <th>No.</th>
                    <th>ID Card/KTP/Kartu Pelajar/SIM</th>
                    <th>Nama Visitor</th>
                    <th>Asal Instansi</th>
                    <th style="text-align:center;">Checkup</th>
                    <th style="text-align:center;">Sistolik</th>
                    <th style="text-align:center;">Diastolik</th>
                    <th style="text-align:center;">Denyut Nadi</th>
                    <th>Keluhan</th>
                    <th>Hasil (Fit/Unfit)</th>
                    <th style="text-align:center;">Waktu</th>
                    <th>Pemeriksa (Medic)</th>
                    <th colspan="2" style="text-align:center;">Aksi</th>
                </tr>
                <?php
                    if(isset($_POST['search'])){
                        if(!preg_match("/^[A-Z0-9-]*$/", $_POST['agency'])){ ?>
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Terjadi Kesalahan !",
                                        text: "Instansi tidak boleh mengandung karakter khusus !",
                                        type: "error",
                                        confirmButtonText: "OK"
                                        },
                                            function(isConfirm){
                                                if (isConfirm) {
                                                    window.location.href = "data-checkup-visitor";
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
                                                    window.location.href = "data-checkup-visitor";
                                                }
                                    }); }, 500);
                            </script>
                  <?php }
                        else {
                            $no = 1;
                            if(isset($_POST['agency']) && empty($_POST['name'])){
                                if($getData->cekVisitorbyInstansi($_POST['agency']) > 0){
                                    foreach($getData->listVisitorbyInstansi($_POST['agency']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++."."; ?></td>
                                        <td><?= $row['_id_visitor']; ?></td>
                                        <td><?= $row['_nama_visitor']; ?></td>
                                        <td><?= $row['_nama_instansi']; ?></td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <span style="font-size:14px;color:black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                        <?php }
                                                else { ?>
                                                    <a href="input-data-checkup-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
                                        <?php }
                                                ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_sistolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_diastolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_denyut_nadi'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')); ?>
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
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_waktu'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
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
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="edit-data-checkup-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="javascript:void(0)" class="linkError konfirmDeleteDCUVisitor" data-id="<?= $row['_id_visitor']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
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
                                        <td colspan="14" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                            elseif(isset($_POST['name']) && empty($_POST['agency'])){
                                if($getData->cekVisitorbyNama($_POST['name']) > 0){
                                    foreach($getData->listVisitorbyNama($_POST['name']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++."."; ?></td>
                                        <td><?= $row['_id_visitor']; ?></td>
                                        <td><?= $row['_nama_visitor']; ?></td>
                                        <td><?= $row['_nama_instansi']; ?></td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <span style="font-size:14px;color:black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                        <?php }
                                                else { ?>
                                                    <a href="input-data-checkup-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
                                        <?php }
                                                ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_sistolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_diastolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_denyut_nadi'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')); ?>
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
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_waktu'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
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
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="edit-data-checkup-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="javascript:void(0)" class="linkError konfirmDeleteDCUVisitor" data-id="<?= $row['_id_visitor']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
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
                                        <td colspan="14" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                            else {
                                if($getData->cekVisitorbyInstansiandNama($_POST['agency'], $_POST['name']) > 0){
                                    foreach($getData->listVisitorbyInstansiandNama($_POST['agency'], $_POST['name']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++."."; ?></td>
                                        <td><?= $row['_id_visitor']; ?></td>
                                        <td><?= $row['_nama_visitor']; ?></td>
                                        <td><?= $row['_nama_instansi']; ?></td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <span style="font-size:14px;color:black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                        <?php }
                                                else { ?>
                                                    <a href="input-data-checkup-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-stethoscope" aria-hidden="true"></i></a>
                                        <?php }
                                                ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_sistolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_diastolik'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_denyut_nadi'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_keluhan'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')); ?>
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
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                                    echo $dataDCU['_waktu'];
                                                }
                                                else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){
                                                    $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
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
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="edit-data-checkup-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <?php }
                                                else {
                                                    echo ".....";
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align:center;">
                                            <?php
                                                if($getData->cekDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y')) > 0){ ?>
                                                    <a href="javascript:void(0)" class="linkError konfirmDeleteDCUVisitor" data-id="<?= $row['_id_visitor']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
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
                                        <td colspan="14" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                    </tr>
                          <?php }
                            }
                        }
                    }
                    else {
                        if($getData->cekDCUVisitorbyTglAll(date('d'), date('m'), date('Y')) > 0){

                            $pages = ceil($getData->cekDCUVisitorbyTglAll(date('d'), date('m'), date('Y'))/$halaman);
                        
                            $no = $mulai + 1;
                            foreach($getData->listDCUVisitorbyDateAll(date('d'), date('m'), date('Y'), $mulai, $halaman) as $row){ ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $row['_id_visitor']; ?></td>
                                <td><?= $row['_nama_visitor']; ?></td>
                                <td><?= $row['_nama_instansi']; ?></td>
                                <td style="text-align:center;"><span style="font-size:14px;color:black;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></td>
                                <td style="text-align:center;"><?= $row['_sistolik']; ?></td>
                                <td style="text-align:center;"><?= $row['_diastolik']; ?></td>
                                <td style="text-align:center;"><?= $row['_denyut_nadi']; ?></td>
                                <td><?= $row['_keluhan']; ?></td>
                                <td>
                                    <span class="span-ket-dcu" style="background-color:<?= ($row['_keterangan']) == "FIT" ? 'green' : 'red'; ?>">
                                        <?= $row['_keterangan']; ?>
                                    </span>
                                </td>
                                <td style="text-align:center;"><?= $row['_waktu']; ?></td>
                                <td>
                                    <?php
                                        $dataDCU = $getData->getDataDCUVisitor($row['_id_visitor'], date('d'), date('m'), date('Y'));
                                        $dataMedic = $getData->getDataPekerja($dataDCU['_medic']);

                                        echo $dataMedic['_nama_pekerja'];
                                    ?>
                                </td>
                                <td style="text-align:center;"><a href="edit-data-checkup-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                <td style="text-align:center;"><a href="javascript:void(0)" class="linkError konfirmDeleteDCUVisitor" data-id="<?= $row['_id_visitor']; ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                            </tr>
                    <?php } ?>   
                            <tr>
                                <td>Halaman</td>
                                <td colspan="14" style="text-align:left;font-size:14px;">
                                    <?php
                                        for ($i=1; $i<=$pages ; $i++){ ?>
                                            <a href="data-checkup-visitor-halaman-<?= $i; ?>" class="linkDetail"><?= " ".$i." "; ?></a>
                                <?php }
                                        ?>
                                </td>
                            </tr>
                  <?php }
                        else { ?>
                            <tr>
                                <td colspan="14" style="text-align:center;"><span style="color:red;">Belum Ada Data Checkup !</span></td>
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

<a href="data-checkup-visitor" class="linkTransferPg"><i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Refresh</a>
<a href="pages/_act_export_3.php?tanggal=<?= date('d'); ?>&bulan=<?= date('m'); ?>&tahun=<?= date('Y'); ?>" class="linkTransferPg"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export</a>