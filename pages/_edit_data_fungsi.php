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
        $fungsi = $getData->getNamaFungsi($id);
    }
    else {
        header('location:dashboard');
    }
      
?>
<div class="container-form">
    <h5><i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp; Form Edit Data Fungsi</h5><br>
    <form method="POST" action="simpan-update-fungsi-<?= $id; ?>" class="form-input">
        <label for="id">ID Fungsi &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
        <input type="text" name="id_f" value="<?= $id; ?>" required readonly><br>

        <label for="name">Nama Fungsi &nbsp;<span style="color:red;font-size:15px;"></span></label><br>
        <input type="text" name="nama_f" value="<?= $fungsi['_nama_fungsi']; ?>" placeholder="Isi Nama Fungsi" required><br>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-fungsi'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>