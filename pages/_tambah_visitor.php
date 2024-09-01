<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    } 

?>
<div class="container-form">
    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Form Tambah Data Visitor</h5><br>
    <form method="POST" action="simpan-visitor" class="form-input">
        <label for="id">ID Card/KTP/Kartu Pelajar/SIM &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="number" name="id" placeholder="ID Card/KTP/Kartu Pelajar/SIM" required><br>

        <label for="name">Nama &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="name" placeholder="Isi Nama TKJP/MK" required><br>

        <label for="gender">Jenis Kelamin &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <select name="gender" class="select" required>
            <option value="" selected>- Pilih Jenis Kelamin -</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>

        <label for="agency">Asal Instansi &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <select name="agency" class="select" required>
            <option value="" selected>- Pilih Asal Instansi -</option>
            <?php
                foreach($getData->listInstansi() as $row){ ?>
                    <option value="<?= $row['_id_instansi']; ?>"><?= $row['_nama_instansi']; ?></option>
          <?php }
            ?>
        </select>

        <label for="needs">Keperluan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="needs" placeholder="Isi Keperluan Pengunjung" required><br>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-visitor'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>