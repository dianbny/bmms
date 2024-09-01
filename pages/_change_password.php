<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }
?>
<div class="container-form">
    <h5><i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp; Form Edit Password</h5><br>
    <form method="POST" action="simpan-password" class="form-input">

        <label for="password">Password Baru &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="password" name="password" placeholder="Isi Password Baru" required><br>

        <button type="button" class="btnForm" onclick="window.location.href = 'dashboard'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>