<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    if(isset($_GET['id'])){
        if(isset($_GET['id'])){
            if($getData->cekNopek($_GET['id']) < 1){ ?>
                <script>    
                    window.location.href = "dashboard";
                </script>
      <?php }
            
            $id = $_GET['id'];
            $dataPekerja = $getData->getDataPekerja($id);
            $dataDCU = $getData->getDataDCU($id, date('d'), date('m'), date('Y'));
        }
       
    }
    else {
        header('location:dashboard');
    }
    
?>
<div class="container-form">
    <h5><i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp; Form Edit Daily Checkup</h5><br>
    <form method="POST" action="simpan-update-checkup-<?= $id; ?>" class="form-input">

        <fieldset>

            <legend> Data Pekerja/TKJP/MK </legend>
            <label for="id">Nomor/ID &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="number" name="id" value="<?= $dataPekerja['_id_pekerja']; ?>" readonly><br>

            <label for="name">Nama &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="text" name="name" value="<?= $dataPekerja['_nama_pekerja']; ?>" readonly><br>
        </fieldset>

        <fieldset>
            <legend> Pemeriksaan Vital </legend>
            <label for="sistolik">Sistolik &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="number" name="sistolik" placeholder="Isi Sistolik" value="<?= $dataDCU['_sistolik']; ?>" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required><br>
        
            <label for="diastolik">Diastolik &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="number" name="diastolik" placeholder="Isi Diastolik" value="<?= $dataDCU['_diastolik']; ?>" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required><br>
        
            <label for="denyutnadi">Denyut Nadi &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="number" name="denyutnadi" placeholder="Isi Denyut Nadi" value="<?= $dataDCU['_denyut_nadi']; ?>" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required><br>
        
            <label for="suhutubuh">Suhu Tubuh &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <input type="number" name="suhutubuh" placeholder="Isi Suhu Tubuh" value="<?= $dataDCU['_suhu_tubuh']; ?>" maxlength="5" step="0.1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required><br>

            <label for="frekuensinafas">Frekuensi Pernafasan &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
            <select name="frekuensinafas" id="" class="select" required>
                <option value="<?= $dataDCU['_frekuensi_nafas']; ?>" selected><?= $dataDCU['_frekuensi_nafas']; ?></option>
                <option value="">- Pilih -</option>
                <option value="Teratur, Tidak Sesak">Teratur, Tidak Sesak</option>
                <option value="Tidak Teratur, Terlihat Tanda Sesak">Tidak Teratur, Terlihat Tanda Sesak</option>
            </select>
        </fieldset>

        <fieldset>
            <legend> Anamnesis / Pemeriksaan Fisik</legend>
            <label for="riwayatpenyakit">Riwayat Penyakit &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <select name="riwayatpenyakit" id="" class="select" required>
                    <option value="<?= $dataDCU['_riwayat_penyakit']; ?>" selected><?= $dataDCU['_riwayat_penyakit']; ?></option>
                    <option value="">- Pilih -</option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak">Tidak</option>
                </select>

                <label for="detailriwayat">Riwayat Penyakit &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <input type="text" name="detailriwayat" value="<?= $dataDCU['_detail_riwayat']; ?>" placeholder="Isi Riwayat Pemyakit (Jika Ada)"><br>

                <label for="konsumsiobat">Mengkonsumsi Obat &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <select name="konsumsiobat" id="" class="select" required>
                    <option value="<?= $dataDCU['_konsumsi_obat']; ?>" selected><?= $dataDCU['_konsumsi_obat']; ?></option>
                    <option value="">- Pilih -</option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak">Tidak</option>
                </select>

                <label for="tujuanobat">Tujuan Mengkonsumsi/Nama Obat &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <input type="text" name="tujuanobat" value="<?= $dataDCU['_tujuan_obat']; ?>" placeholder="Isi Tujuan Mengkonsumsi Obat Tersebut (Jika Ada)"><br>

                <label for="keluhan">Keluhan &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <select name="keluhan" id="" class="select" required>
                    <option value="<?= $dataDCU['_status_keluhan']; ?>" selected><?= $dataDCU['_status_keluhan']; ?></option>
                    <option value="">- Pilih -</option>
                    <option value="Ada">Ada</option>
                    <option value="Tidak">Tidak</option>
                </select>

                <label for="detailkeluhan">Keluhan &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <input type="text" name="detailkeluhan" value="<?= $dataDCU['_keluhan']; ?>" placeholder="Isi Keluhan (Jika Ada)"><br>
            
                <label for="tingkatkesadaran">Tingkat Kesadaran &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <select name="tingkatkesadaran" id="" class="select" required>
                    <option value="<?= $dataDCU['_tingkat_kesadaran']; ?>" selected><?= $dataDCU['_tingkat_kesadaran']; ?></option>
                    <option value="">- Pilih -</option>
                    <option value="Baik">Baik (Dalam Keadaan Sadar)</option>
                    <option value="Buruk">Buruk (Penurunan Kesadaran)</option>
                </select>

                <label for="cekmata">Pemeriksaan Mata &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <select name="cekmata" id="" class="select" required>
                    <option value="<?= $dataDCU['_pemeriksaan_mata']; ?>" selected><?= $dataDCU['_pemeriksaan_mata']; ?></option>
                    <option value="">- Pilih -</option>
                    <option value="Normal">Normal</option>
                    <option value="Tidak Normal">Tidak Normal</option>
                </select>

                <label for="romberg">Pemeriksaan Keseimbangan &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <select name="romberg" id="" class="select" required>
                    <option value="<?= $dataDCU['_pemeriksaan_keseimbangan']; ?>" selected><?= $dataDCU['_pemeriksaan_keseimbangan']; ?></option>
                    <option value="">- Pilih -</option>
                    <option value="Baik">Baik</option>
                    <option value="Buruk">Buruk</option>
                </select>

                <label for="drugs">Gejala Pengaruh Alkohol/Napza &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <select name="drugs" id="" class="select" required>
                    <option value="<?= $dataDCU['_pengaruh_alkohol']; ?>" selected><?= $dataDCU['_pengaruh_alkohol']; ?></option>
                    <option value="">- Pilih -</option>
                    <option value="Negatif">Negatif (Tidak Dalam Pengaruh Alkohol/Napza)</option>
                    <option value="Positif">Positif (Dalam Pengaruh Alkohol/Napza)</option>
                </select>

                <label for="catatan">Rekomendasi/Catatan &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
                <input type="text" name="catatan" value="<?= $dataDCU['_catatan']; ?>" placeholder="Isi Rekomendasi/Catatan (Jika Ada)" required><br>
        </fieldset>

        <button type="button" class="btnForm" onclick="window.location.href = 'data-checkup'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>