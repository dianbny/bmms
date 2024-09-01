<?php
    if(!isset($_SESSION['status'])){ 
      header('location:logout');
    }

    $dataID = $getData->getIDPerusahaan();
    $idBaru = substr($dataID['_id_perusahaan'], 5, 2) + 1;

    if(strlen($idBaru) == 1){
      $idBaru = "0".$idBaru;
    }
    else {
      $idBaru = $idBaru;
    }
?>
<div class="container-form">
    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Form Tambah Data Perusahaan</h5><br>
    <form method="POST" action="simpan-perusahaan" class="form-input">
        <label for="id">ID Perusahaan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="id_p" value="<?= substr($dataID['_id_perusahaan'], 0, 5).$idBaru; ?>" placeholder="ID Perusahaan" required readonly><br>

        <label for="name">Nama Perusahaan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="nama_p" placeholder="Isi Nama Perusahaan" required><br>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-perusahaan'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>