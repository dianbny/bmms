<?php
    if(!isset($_SESSION['status']) || $dataUserLogin['_level_user'] != "Admin"){ 
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

<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Daftar Pengguna</h5>

<?php
    if($getData->cekDaftarPengguna() > 0){ ?>

    <form method="POST" action="daftar-pengguna" class="form-table">
        <input type="text" name="name" placeholder="Pencarian Berdasarkan Nama">
        <input type="submit" name="search" value="Cari">
    </form>

        <div class="table-layout">
            <table class="table-style">
                <tr>
                    <th>No.</th>
                    <th>ID/No. Pekerja</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level User</th>
                    <th colspan="2" style="text-align:center;">Aksi</th>
                </tr>
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
                                                    window.location.href = "daftar-pengguna";
                                                }
                                    }); }, 500);
                            </script>
                  <?php }
                        else {
                            $no = 1;
                            if(isset($_POST['name'])){
                                if($getData->cekPenggunabyName($_POST['name']) > 0){
                                    foreach($getData->listPenggunabyName($_POST['name']) as $row){ ?>
                                        <tr>
                                            <td><?= $no++.'.'; ?></td>
                                            <td><?= $row['_id_user']; ?></td>
                                            <td><?= $row['_username']; ?></td>
                                            <td><?= $row['_nama_pekerja']; ?></td>
                                            <td><?= $row['_level_user']; ?></td>
                                            <td style="text-align:center;"><a href="edit-data-pengguna-<?= $row['_id_user']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                            <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_user']; ?>" class="linkError konfirmDeleteUser"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
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
                        $pages = ceil($getData->cekDaftarPengguna()/$halaman);
                    
                        $no = $mulai + 1;
                        foreach($getData->listPengguna($mulai, $halaman) as $row){ ?>
                            <tr>
                                <td><?= $no++.'.'; ?></td>
                                <td><?= $row['_id_user']; ?></td>
                                <td><?= $row['_username']; ?></td>
                                <td><?= $row['_nama_pekerja']; ?></td>
                                <td><?= $row['_level_user']; ?></td>
                                <td style="text-align:center;"><a href="edit-data-pengguna-<?= $row['_id_user']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_user']; ?>" class="linkError konfirmDeleteUser"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                            </tr>
                  <?php }  ?> 
                            <tr>
                                <td>Halaman</td>
                                <td colspan="11" style="text-align:left;font-size:14px;">
                                    <?php
                                        for ($i=1; $i<=$pages ; $i++){ ?>
                                            <a href="daftar-pengguna-halaman-<?= $i; ?>" class="linkDetail"><?= " ".$i." "; ?></a>
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
<a href="tambah-data-pengguna" class="linkTransferPg"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Data Baru</a>
<a href="daftar-pengguna" class="linkTransferPg"><i class="fa fa-refresh" aria-hidden="true"></i> &nbsp; Refresh</a>
