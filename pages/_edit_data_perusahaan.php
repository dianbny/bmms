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
        $perusahaan = $getData->getNamaPerusahaan($id);
    }
    else {
        header('location:dashboard');
    }
    
      
?>
<div class="container-form">
    <h5><i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp; Form Edit Data Perusahaan</h5><br>
    <form method="POST" action="simpan-update-perusahaan-<?= $id; ?>" class="form-input">
        <label for="id">ID Perusahaan &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
        <input type="text" name="id_p" value="<?= $id; ?>" required readonly><br>

        <label for="name">Nama Perusahaan &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
        <input type="text" name="nama_p" value="<?= $perusahaan['_perusahaan']; ?>" placeholder="Isi Nama Perusahaan" required><br>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-perusahaan'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>