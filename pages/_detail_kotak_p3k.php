<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $dataKotak = $getData->getDataKotak($id);
    }
?>

<h5><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Detail Kotak P3K</h5>
<br>
    <span style="font-size:11px;font-weight:bold;">No. Kotak : <?= $dataKotak['_no_kotak']; ?> | Lokasi : <?= $dataKotak['_lokasi_kotak']; ?></span>
    <div class="table-layout">
        <table class="table-style">
            <tr>
                <th>No.</th>
                <th>Nama Peralatan Medis/Obat P3K</th>
                <th>Expired</th>
                <th style="text-align:center;">Ketersediaan</th>
                <th style="text-align:center;">Jumlah</th>
                <th>Pemeriksaan Terakhir</th>
                <th>Pemeriksa</th>
                <th>Keterangan</th>
                <th colspan="2" style="text-align:center;">Aksi</th>
            </tr>
            <?php
                if($getData->cekIsiKotakP3K($id) > 0){
                    $nom = 1;
                    foreach($getData->listIsiKotakP3K($id) as $row){ ?>
                        <tr>
                            <td><?= $nom++.'.'; ?></td>
                            <td><?= $row['_nama_isi_kotak']; ?></td>
                            <td><?= strftime('%d %B %Y', strtotime($row['_expired'])); ?></td>
                            <td style="text-align:center;"><?= $row['_status_tersedia']; ?></td>
                            <td style="text-align:center;"><?= $row['_jumlah']; ?></td>
                            <td><?= strftime('%d %B %Y', strtotime($row['_pemeriksaan_terakhir'])); ?></td>
                            <td>
                                <?php
                                    $pemeriksa = $getData->getDataPekerja($row['_pemeriksa']);

                                    echo $pemeriksa['_nama_pekerja'];
                                    ?>
                            </td>
                            <td><?= $row['_keterangan']; ?></td>
                            <td style="text-align:center;"><a href="edit-data-isi-kotak-p3k-<?= $row['_id_isi_kotak']; ?>" class="linkDetail"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td style="text-align:center;"><a href="javascript:void(0)" data-id="<?= $row['_id_isi_kotak']; ?>" class="linkError konfirmDeleteIsiKotakP3K"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
                        </tr>
              <?php }
                }
                else { ?>
                    <tr>
                        <td style="text-align:center;" colspan="12"><span style="color:red;">Data Tidak Ditemukan !</span></td>
                    </tr>
          <?php }
            ?>
        </table>
    </div>
<br>
<a href="daftar-kotak-p3k" class="linkTransferPg"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; Kembali</a>
<a href="tambah-data-isi-kotak-p3k-<?= $id; ?>" class="linkTransferPg"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Data Baru</a>
