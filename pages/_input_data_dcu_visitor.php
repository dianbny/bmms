<?php
    if(!isset($_SESSION['status'])){ 
        header('location:logout');
    }

    $id = $_GET['id'];
    $dataVisitor = $getData->getDataVisitor($id);
?>
<div class="container-form">
    <h5><i class="fa fa-stethoscope" aria-hidden="true"></i> &nbsp; Form Daily Checkup</h5><br>
    <form method="POST" action="simpan-checkup-visitor-<?= $id; ?>" class="form-input">
        <label for="id">Nomor/ID &nbsp;</label><br>
        <input type="number" name="id" value="<?= $dataVisitor['_id_visitor']; ?>" readonly><br>

        <label for="name">Nama &nbsp;</label><br>
        <input type="text" name="name" value="<?= $dataVisitor['_nama_visitor']; ?>" readonly><br>

        <label for="sistolik">Sistolik &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="number" name="sistolik" placeholder="Isi Sistolik" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required><br>

        <label for="diastolik">Diastolik &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="number" name="diastolik" placeholder="Isi Diastolik" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required><br>

        <label for="denyutnadi">Denyut Nadi &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="number" name="denyutnadi" placeholder="Isi Denyut Nadi" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required><br>

        <label for="complaint">Keluhan &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="text" name="complaint" placeholder="Isi Keluhan" required><br>
       
        <button type="button" class="btnForm" onclick="window.location.href = 'data-checkup-visitor'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>