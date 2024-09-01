<?php
    if(!isset($_SESSION['status'])){ 
      header('location:logout');
    }

    $dataID = $getData->getIDFungsi();
    $idBaru = substr($dataID['_id_fungsi'], 5, 2) + 1;

    if(strlen($idBaru) == 1){
      $idBaru = "0".$idBaru;
    }
    else {
      $idBaru = $idBaru;
    }
?>
<div class="container-form">
    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Form Tambah Data Fungsi</h5><br>
    <form method="POST" action="simpan-fungsi" class="form-input">
        <label for="id">ID Fungsi&nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="id_f" value="<?= substr($dataID['_id_fungsi'], 0, 5).$idBaru; ?>" placeholder="ID Perusahaan" required readonly><br>

        <label for="name">Nama Fungsi &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="nama_f" placeholder="Isi Nama Fungsi" required><br>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-fungsi'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>