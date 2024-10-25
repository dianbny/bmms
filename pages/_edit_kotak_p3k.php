<?php
    if(!isset($_SESSION['status'])){ 
      header('location:logout');
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $dataKotak = $getData->getDataKotak($id);
    }
?>
<div class="container-form">
    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Form Edit Data Kotak P3K</h5><br>
    <form method="POST" action="simpan-update-kotak-p3k-<?= $id; ?>" class="form-input">
        <label for="id">ID Kotak P3K&nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="id_k" id="id" value="<?= $id; ?>" placeholder="ID Kotak P3K" required readonly><br>

        <label for="lokasi">Lokasi Kotak P3K &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="lokasi_k" id="lokasi" value="<?= $dataKotak['_lokasi_kotak']; ?>" placeholder="Isi Lokasi Kotak P3K" required><br>

        <label for="nomor">Nomor Kotak P3K &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="number" name="nomor_k" id="nomor" value="<?= $dataKotak['_no_kotak']; ?>" placeholder="Isi Nomor Kotak P3K" required><br>

        <label>Tipe Kotak (A &plusmn; 25 Pekerja / B &plusmn; 50 Pekerja) &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <select name="tipe" class="select" required>
            <option value="<?= $dataKotak['_tipe_kotak']; ?>" selected><?= $dataKotak['_tipe_kotak']; ?></option>
            <option value="">- Pilih Tipe Kotak -</option>
            <option value="Tipe A">Tipe A</option>
            <option value="Tipe B">Tipe B</option>
        </select>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-kotak-p3k'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>