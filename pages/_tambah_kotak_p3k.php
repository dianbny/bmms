<?php
    if(!isset($_SESSION['status'])){ 
      header('location:logout');
    }

    $newIDPost;

    if($getData->cekP3K() > 0){
        $dataID = $getData->getIDKotak();
        $idBaru = substr($dataID['_id_kotak'], 5, 2) + 1;
    
        if(strlen($idBaru) == 1){
            $idBaru = "0".$idBaru;
        }
        else {
            $idBaru = $idBaru;
        }

        $newIDPost = substr($dataID['_id_kotak'], 0, 5).$idBaru;
    }
    else {
        $newIDPost = "KO-0001";
    }
?>
<div class="container-form">
    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Form Tambah Data Kotak P3K</h5><br>
    <form method="POST" action="simpan-kotak-p3k" class="form-input">
        <label for="id">ID Kotak P3K&nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="id_k" id="id" value="<?= $newIDPost; ?>" placeholder="ID Kotak P3K" required readonly><br>

        <label for="lokasi">Lokasi Kotak P3K &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="lokasi_k" id="lokasi" placeholder="Isi Lokasi Kotak P3K" required><br>

        <label for="nomor">Nomor Kotak P3K &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="number" name="nomor_k" id="nomor" placeholder="Isi Nomor Kotak P3K" required><br>

        <label>Tipe Kotak (A &plusmn; 25 Pekerja / B &plusmn; 50 Pekerja) &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <select name="tipe" class="select" required>
            <option value="" selected>- Pilih Tipe Kotak -</option>
            <option value="Tipe A">Tipe A</option>
            <option value="Tipe B">Tipe B</option>
        </select>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-kotak-p3k'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>