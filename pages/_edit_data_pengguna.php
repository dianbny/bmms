<?php
    if(!isset($_SESSION['status']) || $dataUserLogin['_level_user'] != "Admin"){ 
        header('location:logout');
    }
    
    if(isset($_SESSION['page'])){
        unset($_SESSION['page']);
    }

    $_SESSION['page'] = $_GET['page'];

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $dataPengguna = $getData->getDataUserbyID($id);
    }
    else {
        header('location:dashboard');
    }
    
    
?>
<div class="container-form">
    <h5><i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp; Form Edit Data Visitor</h5><br>
    <form method="POST" action="simpan-update-pengguna-<?= $id; ?>" class="form-input">
        <label for="id">No. Pekerja/ID &nbsp;</label><br>
        <input type="number" name="id" value="<?= $dataPengguna['_id_user']; ?>" readonly><br>

        <label for="username">Username &nbsp;</label><br>
        <input type="text" name="username" value="<?= $dataPengguna['_username']; ?>" readonly><br>

        <label for="password">Password &nbsp;</label><br>
        <input type="password" name="password" placeholder="Isi Password"><br>

        <label for="level">Level &nbsp;</label><br>
        <select name="level" class="select" required>
            <option value="<?= $dataPengguna['_level_user']; ?>" selected><?= $dataPengguna['_level_user']; ?></option>
            <option value="">- Pilih Level User -</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            
        </select>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-pengguna'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>