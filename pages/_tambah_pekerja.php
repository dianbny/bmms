<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }
    
    if(isset($_SESSION['page'])){
        unset($_SESSION['page']);
    }

    $_SESSION['page'] = $_GET['page'];
?>
<div class="container-form">
    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Form Tambah Data Pekerja</h5><br>
    <form method="POST" action="simpan-pekerja" class="form-input">
        <fieldset>
            <legend> Data Pribadi </legend>
            <label for="name">Nama &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="text" name="name" placeholder="Isi Nama Pegawai" required><br>

            <label for="gender">Jenis Kelamin &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <select name="gender" class="select" required>
                <option value="" selected>- Pilih Jenis Kelamin -</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <label for="placeofbirth">Tempat Lahir &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="text" name="placeofbirth" placeholder="Isi Tempat Lahir" required><br>

            <label for="birtday">Taggal Lahir &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="date" name="birthday" required><br>
        </fieldset>
        
        <fieldset>
            <legend> Data Perusahaan </legend>
            <label for="id">Nomor/ID &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="number" name="id" placeholder="Isi Nomor/ID Pegawai" required><br>

            <label for="function">Asal Fungsi &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <select name="function" class="select" required>
                <option value="" selected>- Pilih Fungsi -</option>
                <?php
                    foreach($getData->listFungsi() as $row){ ?>
                        <option value="<?= $row['_id_fungsi']; ?>"><?= $row['_nama_fungsi']; ?></option>
            <?php }
                ?>
            </select>

            <label for="category">Kategori Pekerjaan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <select name="category" class="select" required>
                <option value="" selected>- Pilih Kategori Pekerjaan -</option>
                <?php
                    foreach($getData->listKategori() as $row){ ?>
                        <option value="<?= $row['_id_kategori']; ?>"><?= $row['_kategori']; ?></option>
            <?php }
                ?>
            </select>

            <label for="company">Perusahaan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <select name="company" class="select" required>
                <option value="" selected>- Pilih Perusahaan -</option>
                <?php
                    foreach($getData->listPerusahaan() as $row){ ?>
                        <option value="<?= $row['_id_perusahaan']; ?>"><?= $row['_perusahaan']; ?></option>
            <?php }
                ?>
            </select>

            <label for="position">Jabatan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="text" name="position" placeholder="Isi Jabatan Pegawai" required><br>

            <label for="status">Status &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
            <input type="text" name="status" value="PEKERJA" readonly><br>
        </fieldset>
        

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-pegawai'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>