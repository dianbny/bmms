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

<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Daftar Kotak P3K</h5>
<br>
    <span style="font-size:11px;font-weight:bold;">Ket : Tipe A (&plusmn; 25 Pekerja), Tipe B (&plusmn; 50 Pekerja)</span>
    <div class="table-layout">
        <table class="table-style">
            <tr>
                <th>No.</th>
                <th>Lokasi Kotak P3K</th>
                <th style="text-align:center;">No. Kotak P3K</th>
                <th style="text-align:center;">Tipe Kotak P3K</th>
                <th style="text-align:center;">Jumlah Item</th>
                <th style="text-align:center;">Jumlah Isi Kotak</th>
                <th style="text-align:center;">Detail List Kotak</th>
                <th colspan="2" style="text-align:center;">Aksi</th>
            </tr>
            <?php
                if($getData->cekP3K() > 0){
                    $no = 1;
                    foreach($getData->listKotakP3K() as $row){ 
                    $jumIsiKotak = $getData->getJumDataIsiKotak($row['_id_kotak']); ?>
                        <tr>
                            <td><?= $no++."."; ?></td>
                            <td><?= $row['_lokasi_kotak']; ?></td>
                            <td style="text-align:center;"><?= $row['_no_kotak']; ?></td>
                            <td style="text-align:center;"><?= $row['_tipe_kotak']; ?></td>
                            <td style="text-align:center;">
                                <?php 
                                    if($getData->cekIsiKotakP3K($row['_id_kotak']) > 0){
                                        echo $getData->cekIsiKotakP3K($row['_id_kotak']);
                                    } 
                                    else { ?>
                                        <span style="color:red;">0</span>
                              <?php }
                                ?>
                            </td>
                            <td style="text-align:center;">
                                <?php
                                    if($jumIsiKotak['jumlah'] > 0){
                                        echo $jumIsiKotak['jumlah'];
                                    }
                                    else { ?>
                                        <span style="color:red;">0</span>
                              <?php }
                                ?>
                            </td>
                            <td style="text-align:center;"><a href="detail-data-kotak-<?= $row['_id_kotak']; ?>" class="linkDetail"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                            <td style="text-align:center;"><a href="edit-data-kotak-<?= $row['_id_kotak']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_kotak']; ?>" class="linkError konfirmDeleteKotakP3K"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
              <?php }
                }
                else { ?>
                    <tr>
                        <td colspan="9" style="text-align:center;"><span style="color:red;">Belum Ada Data Kotak P3K !</span></td>
                    </tr>
          <?php }
            ?>
        </table>
    </div>
<br>
<a href="tambah-data-kotak-p3k" class="linkTransferPg"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Data Baru</a>