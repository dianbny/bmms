<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    } 
    
?>

<label class="labelTitle"><i class="fa fa-angle-double-right" aria-hidden="true"></i>&nbsp;Persentase Daily Checkup Harian</label>
<br><br>
<?php
    if($getData->cekJumlahPekerja() > 0){ ?>

    <span style="font-size:12px;font-weight:bold;">Persentase Daily Checkup : <?= strftime('%d %B %Y', strtotime(date('Y-m-d'))); ?></span>

        <div class="table-layout">
            <table class="table-style">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Fungsi</th>
                    <th colspan="6" style="text-align:center;">PEKERJA</th>
                    <th colspan="6" style="text-align:center;">TKJP/MK</th>
                        <tr>
                            <th style="text-align:center;">On Duty</th>
                            <th style="text-align:center;">DCU</th>
                            <th style="text-align:center;">Fit</th>
                            <th style="text-align:center;">Unfit</th>
                            <th style="text-align:center;">Persentase</th>
                            <th style="text-align:center;">Status</th>
                            
                            <th style="text-align:center;">On Duty</th>
                            <th style="text-align:center;">DCU</th>
                            <th style="text-align:center;">Fit</th>
                            <th style="text-align:center;">Unfit</th>
                            <th style="text-align:center;">Persentase</th>
                            <th style="text-align:center;">Status</th>
                        </tr>
                </tr>
                <?php
                   $no = 1;
                   foreach($getData->listFungsi() as $row){ 
                       $dcuPekerjaDay = $getData->jumlahDCUFungsiDay(date('Y-m-d'), $row['_id_fungsi'], "PEKERJA");
                       $dcuTKJPDay = $getData->jumlahDCUFungsiDay(date('Y-m-d'), $row['_id_fungsi'], "TKJP/MK"); 
                       
                       $dcuPekerjaDayOld = $getData->jumlahDCUFungsiDay(date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d')))), $row['_id_fungsi'], "PEKERJA");
                       $dcuTKJPDayOld = $getData->jumlahDCUFungsiDay(date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d')))), $row['_id_fungsi'], "TKJP/MK");
                       ?>

                       <tr>
                           <td><?= $no++."."; ?></td>
                           <td><?= $row['_nama_fungsi']; ?></td>
                           <td style="text-align:center;"><?= $row['_total_masuk_pekerja']; ?></td>
                           <td style="text-align:center;"><?= $dcuPekerjaDay; ?></td>
                           <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($row['_id_fungsi'], date('Y-m-d'), "FIT", "PEKERJA"); ?></td>
                           <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($row['_id_fungsi'], date('Y-m-d'), "UNFIT", "PEKERJA"); ?></td>
                           <td style="text-align:center;"><?= ($dcuPekerjaDay != 0) ? ceil($dcuPekerjaDay/$row['_total_masuk_pekerja']*100) : 0; ?> &nbsp;%</td>
                           <td style="text-align:center;">
                               <?php
                                   if($dcuPekerjaDay > $dcuPekerjaDayOld){ ?>
                                       <span style="color:green;font-size:14px;"><i class="fa fa-sort-asc" aria-hidden="true"></i></span>
                             <?php }
                                   elseif($dcuPekerjaDay < $dcuPekerjaDayOld){ ?>
                                       <span style="color:maroon;font-size:14px;"><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                             <?php }
                                  else { ?>
                                       <span style="color:orange;font-size:12px;"><i class="fa fa-exchange" aria-hidden="true"></i></span>
                            <?php }
                               ?>
                           </td>

                           <td style="text-align:center;"><?= $row['_total_masuk_tkjp']; ?></td>
                           <td style="text-align:center;"><?= $dcuTKJPDay; ?></td>
                           <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($row['_id_fungsi'], date('Y-m-d'), "FIT", "TKJP/MK"); ?></td>
                           <td style="text-align:center;"><?= $getData->cekKeteranganDCUFungsi($row['_id_fungsi'], date('Y-m-d'), "UNFIT", "TKJP/MK"); ?></td>
                           <td style="text-align:center;"><?= ($dcuTKJPDay != 0) ? ceil($dcuTKJPDay/$row['_total_masuk_tkjp']*100) : 0; ?> &nbsp;%</td>
                           <td style="text-align:center;">
                               <?php
                                   if($dcuTKJPDay > $dcuTKJPDayOld){ ?>
                                       <span style="color:green;font-size:14px;"><i class="fa fa-sort-asc" aria-hidden="true"></i></span>
                             <?php }
                                   elseif($dcuTKJPDay < $dcuTKJPDayOld){ ?>
                                       <span style="color:maroon;font-size:14px;"><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                             <?php }
                                  else { ?>
                                       <span style="color:orange;font-size:12px;"><i class="fa fa-exchange" aria-hidden="true"></i></span>
                            <?php }
                               ?>
                           </td>
                       </tr>
             <?php }
                ?>  
            </table>
        </div>
<?php }
      else { ?>
        <br><br>
        <span style="color:red;">Belum ada data pegawai !</span><br>
<?php }
?>
<a href="pages/_act_export_5.php?tanggal=<?= date('d'); ?>&bulan=<?= date('m'); ?>&tahun=<?= date('Y'); ?>" class="linkTransferPg"><i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp; Export</a>
