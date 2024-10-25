<?php
    require_once "_dataBase.php";
    
    class _deleteData extends _dataBase {

        //Delete data pekerja
        function hapusPekerja($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_pekerja_pegawai WHERE _id_pekerja = '$idFilter'"); 
        }

        //Delete data DCU pekerja
        function hapusDCU($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_daily_checkup WHERE _id_pekerja = '$idFilter' AND _tgl_dcu = CURDATE()"); 
        }

        //Delete data Visitor
        function hapusVisitor($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_visitor WHERE _id_visitor = '$idFilter'"); 
        }

        //Delete data DCU Visitor
        function hapusDCUVisitor($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_daily_checkup_visitor WHERE _id_visitor = '$idFilter' AND _tgl_dcu = CURDATE()"); 
        }

        //Delete data pengguna
        function hapusPengguna($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_user WHERE _id_user = '$idFilter'"); 
        }

        //Delete data perusahaan
        function hapusPerusahaan($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_perusahaan WHERE _id_perusahaan = '$idFilter'"); 
        }

        //Delete data fungsi
        function hapusFungsi($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_fungsi WHERE _id_fungsi = '$idFilter'"); 
        }

         //Delete data kotak p3k
         function hapusKotakP3K($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_kotak_p3k WHERE _id_kotak = '$idFilter'"); 
        }

        //Delete data kotak p3k
        function hapusIsiKotakP3K($id){
            $idFilter = mysqli_real_escape_string($this->koneksi, $id);
            
			mysqli_query($this->koneksi,"DELETE FROM _tb_isi_kotak_p3k WHERE _id_isi_kotak = '$idFilter'"); 
        }

    }

?>