<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }
    
    if(isset($_SESSION['page'])){
        unset($_SESSION['page']);
    }

    $_SESSION['page'] = $_GET['page'];

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $dataVisitor = $getData->getDataVisitor($id);
    }
    else {
        header('location:dashboard');
    }
    
    
?>
<div class="container-form">
    <h5><i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp; Form Edit Data Visitor</h5><br>
    <form method="POST" action="simpan-update-visitor-<?= $id; ?>" class="form-input">
        <label for="id">ID Card/KTP/SIM &nbsp;</label><br>
        <input type="number" name="id" value="<?= $dataVisitor['_id_visitor']; ?>" readonly><br>

        <label for="name">Nama &nbsp;</label><br>
        <input type="text" name="name" value="<?= $dataVisitor['_nama_visitor']; ?>" placeholder="Isi Nama TKJP/MK" required><br>

        <label for="gender">Jenis Kelamin &nbsp;</label><br>
        <select name="gender" class="select" required>
            <option value="<?= $dataVisitor['_jk']; ?>" selected><?= ($dataVisitor['_jk'] == "L") ? "Laki-laki" : "Perempuan"; ?></option>
            <option value="">- Pilih Jenis Kelamin -</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>

        <label for="agency">Asal Instansi &nbsp;</label><br>
        <select name="agency" class="select" required>
            <option value="<?= $dataVisitor['_instansi']; ?>" selected>
                <?php
                    $instansi = $getData->getNamaInstansi($dataVisitor['_instansi']);

                    echo $instansi['_nama_instansi'];
                ?>
            </option>
            <option value="">- Pilih Asal Instansi -</option>
            <?php
                foreach($getData->listInstansi() as $row){ ?>
                    <option value="<?= $row['_id_instansi']; ?>"><?= $row['_nama_instansi']; ?></option>
          <?php }
            ?>
        </select>

        <label for="needs">Keperluan &nbsp;</label><br>
        <input type="text" name="needs" value="<?= $dataVisitor['_keperluan']; ?>" placeholder="Isi Keperluan Pengunjung" required><br>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-visitor'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>