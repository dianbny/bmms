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
        $dataMCU = $getData->getDataMCU($id);
    }
    
?>
<div class="container-form">
    <h5><i class="fa fa-stethoscope" aria-hidden="true"></i> &nbsp; Form Medical Checkup</h5><br>
    <form method="POST" action="simpan-medical-checkup-<?= $id; ?>" class="form-input">
        <label for="id">Nomor/ID &nbsp;</label><br>
        <input type="text" name="id" value="<?= $dataPekerja['_id_pekerja']; ?>" readonly><br>

        <label for="name">Nama &nbsp;</label><br>
        <input type="text" name="name" value="<?= $dataPekerja['_nama_pekerja']; ?>" readonly><br>

        <label for="mcudate">Tanggal MCU &nbsp;<span style="color:red;font-size:15px;">*</span></label><br>
        <input type="date" name="mcudate" value="<?= ($getData->statusMCU($id) > 0) ? $dataMCU['_tgl_mcu'] : ""; ?>"required><br>
       
        <button type="button" class="btnForm" onclick="window.location.href = 'data-mcu-pekerja'">Kembali</button>
        <input type="submit" name="save" value="Simpan" class="btnForm">
    </form>

</div>