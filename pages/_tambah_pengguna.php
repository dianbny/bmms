<?php
    if(!isset($_SESSION['status']) || $dataUserLogin['_level_user'] != "Admin"){ 
        header('location:logout');
    }

?>
<div class="container-form">
    <h5><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp; Form Tambah Data Pengguna</h5><br>
    <form method="POST" action="simpan-pengguna" class="form-input">
        <label for="id">No. Pekerja/ID &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="id" placeholder="ID Card/KTP/Kartu Pelajar/SIM" required><br>

        <label for="username">Username &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="username" placeholder="Isi Username (Bukan Email) Ex : dian.pratama" required><br>

        <label for="password">Password &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="password" name="password" placeholder="Isi Password" required><br>

        <label for="level">Level &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <select name="level" class="select" required>
            <option value="" selected>- Pilih Level User -</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            
        </select>

        <button type="button" class="btnForm" onclick="window.location.href = 'daftar-pengguna'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>