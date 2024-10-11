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

<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Daftar Fungsi</h5>

<?php
    if($getData->cekFungsi() > 0){ ?>

    <form method="POST" action="daftar-fungsi" class="form-table">
        <input type="text" name="name" placeholder="Pencarian Berdasarkan Nama Fungsi">
        <input type="submit" name="search" value="Cari">
    </form>

        <div class="table-layout">
            <table class="table-style">
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Nama Fungsi</th>
                    <th>Jumlah Pekerja</th>
                    <th colspan="2" style="text-align:center;">Aksi</th>
                </tr>
                <?php
                    if(isset($_POST['search'])){
                        if(!preg_match("/^[a-zA-Z .']*$/", $_POST['name'])){ ?>
                            <script>
                                setTimeout(function() { 
                                    swal({
                                        title: "Terjadi Kesalahan !",
                                        text: "Nama fungsi tidak boleh mengandung angka/karakter khusus !",
                                        type: "error",
                                        confirmButtonText: "OK"
                                        },
                                            function(isConfirm){
                                                if (isConfirm) {
                                                    window.location.href = "daftar-fungsi";
                                                }
                                    }); }, 500);
                            </script>
                  <?php }
                        else {
                            $no = 1;
                            if(isset($_POST['name'])){
                                if($getData->cekFungsibyName($_POST['name']) > 0){
                                    foreach($getData->ListFungsibyName($_POST['name']) as $row){ ?>
                                        <tr>
                                            <td><?= $no++.'.'; ?></td>
                                            <td><?= $row['_id_fungsi']; ?></td>
                                            <td><?= $row['_nama_fungsi']; ?></td>
                                            <td><?= $getData->cekJumlahPekerjaFungsi($row['_id_fungsi']); ?> &nbsp;Pekerja</td>
                                            <td style="text-align:center;"><a href="edit-data-fungsi-<?= $row['_id_fungsi']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                            <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_fungsi']; ?>" class="linkError konfirmDeleteFungsi"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
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
                        $pages = ceil($getData->cekFungsi()/$halaman);
                    
                        $no = $mulai + 1;
                        foreach($getData->listFungsiAll($mulai, $halaman) as $row){ ?>
                            <tr>
                                <td><?= $no++.'.'; ?></td>
                                <td><?= $row['_id_fungsi']; ?></td>
                                <td><?= $row['_nama_fungsi']; ?></td>
                                <td><?= $getData->cekJumlahPekerjaFungsi($row['_id_fungsi']); ?> &nbsp;Pekerja</td>
                                <td style="text-align:center;"><a href="edit-data-fungsi-<?= $row['_id_fungsi']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_fungsi']; ?>" class="linkError konfirmDeleteFungsi"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                            </tr>
                  <?php }  ?> 
                            <tr>
                                <td>Halaman</td>
                                <td colspan="11" style="text-align:left;font-size:14px;">
                                    <?php
                                        for ($i=1; $i<=$pages ; $i++){ ?>
                                            <a href="daftar-fungsi-halaman-<?= $i; ?>" class="linkDetail"><?= " ".$i." "; ?></a>
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
<a href="tambah-data-fungsi" class="linkTransferPg"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Data Baru</a>
<a href="daftar-fungsi" class="linkTransferPg"><i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Refresh</a>
