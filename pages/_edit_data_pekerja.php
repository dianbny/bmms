<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    if(isset($_SESSION['page'])){
        unset($_SESSION['page']);
    }

    $_SESSION['page'] = $_GET['page'];

    if(isset($_GET['id'])){
        if($getData->cekNopek($_GET['id']) < 1){ ?>
            <script>    
                window.location.href = "dashboard";
            </script>
  <?php }
        
        $id = $_GET['id'];
        $dataPekerja = $getData->getDataPekerja($id);
    }
    
?>
<div class="container-form">
    <h5><i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp; Form Edit Data Pekerja</h5><br>
    <form method="POST" action="simpan-update-pekerja-<?= $id; ?>" class="form-input">
        <fieldset>
            <legend> Data Pribadi </legend>
            <label for="name">Nama &nbsp;</label><br>
            <input type="text" name="name" placeholder="Isi Nama Pegawai" value="<?= $dataPekerja['_nama_pekerja']; ?>" required><br>

            <label for="gender">Jenis Kelamin &nbsp;</label><br>
            <select name="gender" class="select" required>
                <option value="<?= $dataPekerja['_jk']; ?>" selected><?= ($dataPekerja['_jk'] == "L") ? "Laki-laki" : "Perempuan"; ?></option>
                <option value="">- Pilih Jenis Kelamin -</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <label for="placeofbirth">Tempat Lahir &nbsp;</label><br>
            <input type="text" name="placeofbirth" value="<?= $dataPekerja['_tempat_lahir']; ?>" required><br>

            <label for="birtday">Taggal Lahir &nbsp;</label><br>
            <input type="date" name="birthday" value="<?= $dataPekerja['_tgl_lahir']; ?>" required><br>
        </fieldset>

        <fieldset>
            <legend> Data Perusahaan </legend>
            <label for="id">Nomor/ID &nbsp;</label><br>
            <input type="number" name="id" value="<?= $dataPekerja['_id_pekerja']; ?>" readonly><br>

            <label for="function">Asal Fungsi &nbsp;</label><br>
            <select name="function" class="select" required>
                <option value="<?= $dataPekerja['_fungsi']; ?>" selected>
                    <?php
                        $fungsi = $getData->getNamaFungsi($dataPekerja['_fungsi']);

                        echo $fungsi['_nama_fungsi'];
                    ?>
                </option>
                <option value="">- Pilih Fungsi -</option>
                <?php
                    foreach($getData->listFungsi() as $row){ ?>
                        <option value="<?= $row['_id_fungsi']; ?>"><?= $row['_nama_fungsi']; ?></option>
            <?php }
                ?>
            </select>

            <label for="category">Kategori Pekerjaan &nbsp;</label><br>
            <select name="category" class="select" required>
                <option value="<?= $dataPekerja['_kategori_pekerjaan']; ?>" selected>
                    <?php
                        $kategori = $getData->getKategoriPekerjaan($dataPekerja['_kategori_pekerjaan']);

                        echo $kategori['_kategori'];
                    ?>
                </option>
                <option value="">- Pilih Kategori Pekerjaan -</option>
                <?php
                    foreach($getData->listKategori() as $row){ ?>
                        <option value="<?= $row['_id_kategori']; ?>"><?= $row['_kategori']; ?></option>
            <?php }
                ?>
            </select>

            <label for="company">Perusahaan &nbsp;</label><br>
            <select name="company" class="select" required>
                <option value="<?= $dataPekerja['_perusahaan']; ?>" selected>
                    <?php
                        $perusahaan = $getData->getNamaPerusahaan($dataPekerja['_perusahaan']);

                        echo $perusahaan['_perusahaan'];
                    ?>
                </option>
                <option value="">- Pilih Perusahaan -</option>
                <?php
                    foreach($getData->listPerusahaan() as $row){ ?>
                        <option value="<?= $row['_id_perusahaan']; ?>"><?= $row['_perusahaan']; ?></option>
            <?php }
                ?>
            </select>

            <label for="position">Jabatan &nbsp;</label><br>
            <input type="text" name="position" placeholder="Isi Jabatan Pegawai" value="<?= $dataPekerja['_jabatan']; ?>" required><br>

            <label for="status">Status &nbsp;</label><br>
            <input type="text" name="status" value="<?= $dataPekerja['_status']; ?>" readonly><br>
        </fieldset>
        
        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-pegawai'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>