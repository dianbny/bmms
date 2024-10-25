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
    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Form Tambah Data Isi Kotak P3K</h5><br>
    <form method="POST" action="simpan-isi-kotak-p3k-<?= $id; ?>" class="form-input">
        <fieldset>
            <legend> Data Kotak P3K</legend>
            <label for="id">ID Kotak P3K&nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="text" id="id" value="<?= $dataKotak['_id_kotak']; ?>" placeholder="ID Kotak P3K" required readonly><br>
    
            <label for="lokasi">Lokasi Kotak P3K &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="text" id="lokasi" value="<?= $dataKotak['_lokasi_kotak']; ?>" placeholder="Isi Lokasi Kotak P3K" required readonly><br>
    
            <label for="nomor">Nomor Kotak P3K &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="number" id="nomor" value="<?= $dataKotak['_no_kotak']; ?>" placeholder="Isi Nomor Kotak P3K" required readonly><br>
        </fieldset>

        <fieldset>
            <legend> Isi Kotak P3K </legend>
            <label for="nama">Nama Peralatan Medis/Obat &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="text" name="nama" id="nama" placeholder="Isi Nama Peralatan Medis/Obat" required><br>

            <label for="expired">Masa Expired &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="date" name="expired" id="expired" required><br>

            <label>Status Ketersediaan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <select name="status" class="select" required>
                <option value="" selected>- Pilih Status -</option>
                <option value="Tersedia">Tersdia</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>

            <label for="jumlah">Jumlah &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="number" name="jumlah" id="jumlah" placeholder="Isi Jumlah" required><br>

            <label for="pemeriksaan_t">Pemeriksaan Terakhir &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="date" name="pemeriksaan_t" id="pemeriksaan_t" required><br>

            <label for="keterangan">Keterangan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="text" name="keterangan" id="keterangan" placeholder="Isi Keterangan" required><br>

        </fieldset>

        <button type="button" class="btnForm" onclick="window.location.href = 'detail-data-kotak-<?= $id; ?>'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>