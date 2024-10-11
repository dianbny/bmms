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

<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Daftar Perusahaan</h5>

<?php
    if($getData->cekPerusahaan() > 0){ ?>

    <form method="POST" action="daftar-perusahaan" class="form-table">
        <input type="text" name="name" placeholder="Pencarian Berdasarkan Nama Perusahaan">
        <input type="submit" name="search" value="Cari">
    </form>

        <div class="table-layout">
            <table class="table-style">
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Nama Perusahaan</th>
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
                                        text: "Nama Perusahaan tidak boleh mengandung angka/karakter khusus !",
                                        type: "error",
                                        confirmButtonText: "OK"
                                        },
                                            function(isConfirm){
                                                if (isConfirm) {
                                                    window.location.href = "daftar-perusahaan";
                                                }
                                    }); }, 500);
                            </script>
                  <?php }
                        else {
                            $no = 1;
                            if(isset($_POST['name'])){
                                if($getData->cekPerusahaanbyName($_POST['name']) > 0){
                                    foreach($getData->ListPerusahaanbyName($_POST['name']) as $row){ ?>
                                        <tr>
                                            <td><?= $no++.'.'; ?></td>
                                            <td><?= $row['_id_perusahaan']; ?></td>
                                            <td><?= $row['_perusahaan']; ?></td>
                                            <td><?= $getData->cekJumlahPekerjaPerusahaan($row['_id_perusahaan']); ?> &nbsp;Pekerja</td>
                                            <td style="text-align:center;"><a href="edit-data-perusahaan-<?= $row['_id_perusahaan']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                            <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_perusahaan']; ?>" class="linkError konfirmDeletePerusahaan"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
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
                        $pages = ceil($getData->cekPerusahaan()/$halaman);
                    
                        $no = $mulai + 1;
                        foreach($getData->listPerusahaanAll($mulai, $halaman) as $row){ ?>
                            <tr>
                                <td><?= $no++.'.'; ?></td>
                                <td><?= $row['_id_perusahaan']; ?></td>
                                <td><?= $row['_perusahaan']; ?></td>
                                <td><?= $getData->cekJumlahPekerjaPerusahaan($row['_id_perusahaan']); ?> &nbsp;Pekerja</td>
                                <td style="text-align:center;"><a href="edit-data-perusahaan-<?= $row['_id_perusahaan']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_perusahaan']; ?>" class="linkError konfirmDeletePerusahaan"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                            </tr>
                  <?php }  ?> 
                            <tr>
                                <td>Halaman</td>
                                <td colspan="11" style="text-align:left;font-size:14px;">
                                    <?php
                                        for ($i=1; $i<=$pages ; $i++){ ?>
                                            <a href="daftar-perusahaan-halaman-<?= $i; ?>" class="linkDetail"><?= " ".$i." "; ?></a>
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
<a href="tambah-data-perusahaan" class="linkTransferPg"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Data Baru</a>
<a href="daftar-perusahaan" class="linkTransferPg"><i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Refresh</a>
