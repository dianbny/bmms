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

<label class="labelTitle"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Daftar Pengunjung (Visitor)</label>

<?php
    if($getData->cekJumlahVisitor() > 0){ ?>

    <form method="POST" action="daftar-visitor" class="form-table">
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

        <div class="table-layout">
            <table class="table-style">
                <tr>
                    <th>No.</th>
                    <th>No. (ID Card/KTP/Kartu Pelajar/SIM)</th>
                    <th>Nama Visitor</th>
                    <th style="text-align:center;">Jenis Kelamin</th>
                    <th>Instansi</th>
                    <th>Keperluan</th>
                    <th colspan="2" style="text-align:center;">Aksi</th>
                </tr>
                <?php
                    if(isset($_POST['search'])){
                        $no = 1;
                        if(isset($_POST['agency']) && empty($_POST['name'])){
                            if($getData->cekVisitorbyInstansi($_POST['agency']) > 0){
                                foreach($getData->listVisitorbyInstansi($_POST['agency']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++.'.'; ?></td>
                                        <td><?= $row['_id_visitor']; ?></td>
                                        <td><?= $row['_nama_visitor']; ?></td>
                                        <td style="text-align:center;"><?= $row['_jk']; ?></td>
                                        <td><?= $row['_nama_instansi']; ?></td>
                                        <td><?= $row['_keperluan']; ?></td>
                                        <td style="text-align:center;"><a href="edit-data-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                        <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_visitor']; ?>" class="linkError konfirmDeleteVisitor"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                                    </tr>
                          <?php }
                            }
                            else { ?>
                                <tr>
                                    <td colspan="11" style="text-align:center;"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                                </tr>
                      <?php }
                        }
                        elseif(isset($_POST['name']) && empty($_POST['agency'])){
                            if($getData->cekVisitorbyNama($_POST['name']) > 0){
                                foreach($getData->listVisitorbyNama($_POST['name']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++.'.'; ?></td>
                                        <td><?= $row['_id_visitor']; ?></td>
                                        <td><?= $row['_nama_visitor']; ?></td>
                                        <td style="text-align:center;"><?= $row['_jk']; ?></td>
                                        <td><?= $row['_nama_instansi']; ?></td>
                                        <td><?= $row['_keperluan']; ?></td>
                                        <td style="text-align:center;"><a href="edit-data-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                        <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_visitor']; ?>" class="linkError konfirmDeleteVisitor"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
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
                            if($getData->cekVisitorbyInstansiandNama($_POST['agency'], $_POST['name']) > 0){
                                foreach($getData->listVisitorbyInstansiandNama($_POST['agency'], $_POST['name']) as $row){ ?>
                                    <tr>
                                        <td><?= $no++.'.'; ?></td>
                                        <td><?= $row['_id_visitor']; ?></td>
                                        <td><?= $row['_nama_visitor']; ?></td>
                                        <td style="text-align:center;"><?= $row['_jk']; ?></td>
                                        <td><?= $row['_nama_instansi']; ?></td>
                                        <td><?= $row['_keperluan']; ?></td>
                                        <td style="text-align:center;"><a href="edit-data-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                        <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_visitor']; ?>" class="linkError konfirmDeleteVisitor"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
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
                    else {
                        $pages = ceil($getData->cekJumlahVisitor()/$halaman);
                    
                        $no = $mulai + 1;
                        foreach($getData->listVisitor($mulai, $halaman) as $row){ ?>
                            <tr>
                                <td><?= $no++.'.'; ?></td>
                                <td><?= $row['_id_visitor']; ?></td>
                                <td><?= $row['_nama_visitor']; ?></td>
                                <td style="text-align:center;"><?= $row['_jk']; ?></td>
                                <td><?= $row['_nama_instansi']; ?></td>
                                <td><?= $row['_keperluan']; ?></td>
                                <td style="text-align:center;"><a href="edit-data-visitor-<?= $row['_id_visitor']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_visitor']; ?>" class="linkError konfirmDeleteVisitor"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                            </tr>
                  <?php } ?>   
                            <tr>
                                <td>Halaman</td>
                                <td colspan="11" style="text-align:left;font-size:14px;">
                                    <?php
                                        for ($i=1; $i<=$pages ; $i++){ ?>
                                            <a href="daftar-visitor-halaman-<?= $i; ?>" class="linkDetail"><?= " ".$i." "; ?></a>
                                  <?php }
                                        ?>
                                </td>
                            </tr>
                            
             <?php  }
                ?>  
            </table>
        </div>
<?php }
      else { ?>
        <br><br>
        <span style="color:red;">Belum ada data visitor !</span><br>
<?php }
?>
<br>
<a href="tambah-data-visitor" class="linkTransferPg"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Data Baru</a>
<a href="daftar-visitor" class="linkTransferPg"><i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Refresh</a>