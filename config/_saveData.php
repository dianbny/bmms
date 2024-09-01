<?php
    require_once "_dataBase.php";
    
    class _saveData extends _dataBase {

        //Simpan Data Pegawai
        function simpanPegawai($id, $nama, $jk, $tempatlahir, $tgllahir, $fungsi, $kategori, $perusahaan, $jabatan, $status){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$namaFilter = mysqli_real_escape_string($this->koneksi, $nama);
			$jkFilter = mysqli_real_escape_string($this->koneksi, $jk);
			$tempatlahirFilter = mysqli_real_escape_string($this->koneksi, $tempatlahir);
			$tgllahirFilter = mysqli_real_escape_string($this->koneksi, $tgllahir);
			$fungsiFilter = mysqli_real_escape_string($this->koneksi, $fungsi);
			$kategoriFilter = mysqli_real_escape_string($this->koneksi, $kategori);
			$perusahaanFilter = mysqli_real_escape_string($this->koneksi, $perusahaan);
			$jabatanFilter = mysqli_real_escape_string($this->koneksi, $jabatan);
			$statusFilter = mysqli_real_escape_string($this->koneksi, $status);
			
			mysqli_query($this->koneksi,"INSERT INTO _tb_pekerja_pegawai VALUES ('$idFilter','$namaFilter','$jkFilter','$tempatlahirFilter','$tgllahirFilter', '$fungsiFilter','$kategoriFilter','$perusahaanFilter','$jabatanFilter','$statusFilter')");
		}

		//Update Data Pegawai
        function updatePegawai($id, $nama, $jk, $tempatlahir, $tgllahir, $fungsi, $kategori, $perusahaan, $jabatan, $status){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$namaFilter = mysqli_real_escape_string($this->koneksi, $nama);
			$jkFilter = mysqli_real_escape_string($this->koneksi, $jk);
			$tempatlahirFilter = mysqli_real_escape_string($this->koneksi, $tempatlahir);
			$tgllahirFilter = mysqli_real_escape_string($this->koneksi, $tgllahir);
			$fungsiFilter = mysqli_real_escape_string($this->koneksi, $fungsi);
			$kategoriFilter = mysqli_real_escape_string($this->koneksi, $kategori);
			$perusahaanFilter = mysqli_real_escape_string($this->koneksi, $perusahaan);
			$jabatanFilter = mysqli_real_escape_string($this->koneksi, $jabatan);
			$statusFilter = mysqli_real_escape_string($this->koneksi, $status);
			
			mysqli_query($this->koneksi,"UPDATE _tb_pekerja_pegawai SET _nama_pekerja = '$namaFilter', _jk = '$jkFilter', _tempat_lahir = '$tempatlahirFilter', _tgl_lahir = '$tgllahirFilter', _fungsi = '$fungsiFilter', _kategori_pekerjaan = '$kategoriFilter', _perusahaan = '$perusahaanFilter', _jabatan = '$jabatanFilter', _status = '$statusFilter' WHERE _id_pekerja = '$idFilter'");
		}

		//Simpan Hasil Checkup
		function simpanCheckup($id, $tgl, $waktu, $sistol, $diastol, $denyutnadi, $keluhan, $keterangan, $medic){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$tglFilter = mysqli_real_escape_string($this->koneksi, $tgl);
			$waktuFilter = mysqli_real_escape_string($this->koneksi, $waktu);
			$sistolFilter = mysqli_real_escape_string($this->koneksi, $sistol);
			$diastolFilter = mysqli_real_escape_string($this->koneksi, $diastol);
			$denyutnadiFilter = mysqli_real_escape_string($this->koneksi, $denyutnadi);
			$keluhanFilter = mysqli_real_escape_string($this->koneksi, $keluhan);
			$keteranganFilter = mysqli_real_escape_string($this->koneksi, $keterangan);
			$medicFilter = mysqli_real_escape_string($this->koneksi, $medic);

			mysqli_query($this->koneksi,"INSERT INTO _tb_daily_checkup VALUES ('$idFilter','$tglFilter','$waktuFilter','$sistolFilter','$diastolFilter','$denyutnadiFilter','$keluhanFilter','$keteranganFilter','$medicFilter')");
		}

		//Update Hasil Checkup
		function updateCheckup($id, $tgl, $waktu, $sistol, $diastol, $denyutnadi, $keluhan, $keterangan){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$tglFilter = mysqli_real_escape_string($this->koneksi, $tgl);
			$waktuFilter = mysqli_real_escape_string($this->koneksi, $waktu);
			$sistolFilter = mysqli_real_escape_string($this->koneksi, $sistol);
			$diastolFilter = mysqli_real_escape_string($this->koneksi, $diastol);
			$denyutnadiFilter = mysqli_real_escape_string($this->koneksi, $denyutnadi);
			$keluhanFilter = mysqli_real_escape_string($this->koneksi, $keluhan);
			$keteranganFilter = mysqli_real_escape_string($this->koneksi, $keterangan);
			
			mysqli_query($this->koneksi,"UPDATE _tb_daily_checkup SET _waktu = '$waktuFilter', _sistolik = '$sistolFilter', _diastolik = '$diastolFilter', _denyut_nadi = '$denyutnadiFilter', _keluhan = '$keluhanFilter', _keterangan = '$keteranganFilter' WHERE _id_pekerja = '$idFilter' AND _tgl_dcu = '$tglFilter'");
		}

		//Simpan Daftar Visitor
		function simpanVisitor($id, $nama, $jk, $instansi, $keperluan){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$namaFilter = mysqli_real_escape_string($this->koneksi, $nama);
			$jkFilter = mysqli_real_escape_string($this->koneksi, $jk);
			$instansiFilter = mysqli_real_escape_string($this->koneksi, $instansi);
			$keperluanFilter = mysqli_real_escape_string($this->koneksi, $keperluan);

			mysqli_query($this->koneksi,"INSERT INTO _tb_visitor VALUES ('$idFilter','$namaFilter','$jkFilter','$instansiFilter','$keperluanFilter')");
		}

		//Simpan Daftar Visitor
		function updateVisitor($id, $nama, $jk, $instansi, $keperluan){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$namaFilter = mysqli_real_escape_string($this->koneksi, $nama);
			$jkFilter = mysqli_real_escape_string($this->koneksi, $jk);
			$instansiFilter = mysqli_real_escape_string($this->koneksi, $instansi);
			$keperluanFilter = mysqli_real_escape_string($this->koneksi, $keperluan);

			mysqli_query($this->koneksi,"UPDATE _tb_visitor SET _nama_visitor = '$namaFilter', _jk = '$jkFilter', _instansi = '$instansiFilter', _keperluan = '$keperluanFilter' WHERE _id_visitor = '$idFilter'");
		}

		//Simpan Hasil Checkup Visitor
		function simpanCheckupVisitor($id, $tgl, $waktu, $sistol, $diastol, $denyutnadi, $keluhan, $keterangan, $medic){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$tglFilter = mysqli_real_escape_string($this->koneksi, $tgl);
			$waktuFilter = mysqli_real_escape_string($this->koneksi, $waktu);
			$sistolFilter = mysqli_real_escape_string($this->koneksi, $sistol);
			$diastolFilter = mysqli_real_escape_string($this->koneksi, $diastol);
			$denyutnadiFilter = mysqli_real_escape_string($this->koneksi, $denyutnadi);
			$keluhanFilter = mysqli_real_escape_string($this->koneksi, $keluhan);
			$keteranganFilter = mysqli_real_escape_string($this->koneksi, $keterangan);
			$medicFilter = mysqli_real_escape_string($this->koneksi, $medic);

			mysqli_query($this->koneksi,"INSERT INTO _tb_daily_checkup_visitor VALUES ('$idFilter','$tglFilter','$waktuFilter','$sistolFilter','$diastolFilter','$denyutnadiFilter','$keluhanFilter','$keteranganFilter','$medicFilter')");
		}

		//Update Hasil Checkup Visitor
		function updateCheckupVisitor($id, $tgl, $waktu, $sistol, $diastol, $denyutnadi, $keluhan, $keterangan){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$tglFilter = mysqli_real_escape_string($this->koneksi, $tgl);
			$waktuFilter = mysqli_real_escape_string($this->koneksi, $waktu);
			$sistolFilter = mysqli_real_escape_string($this->koneksi, $sistol);
			$diastolFilter = mysqli_real_escape_string($this->koneksi, $diastol);
			$denyutnadiFilter = mysqli_real_escape_string($this->koneksi, $denyutnadi);
			$keluhanFilter = mysqli_real_escape_string($this->koneksi, $keluhan);
			$keteranganFilter = mysqli_real_escape_string($this->koneksi, $keterangan);
			
			mysqli_query($this->koneksi,"UPDATE _tb_daily_checkup_visitor SET _waktu = '$waktuFilter', _sistolik = '$sistolFilter', _diastolik = '$diastolFilter', _denyut_nadi = '$denyutnadiFilter', _keluhan = '$keluhanFilter', _keterangan = '$keteranganFilter' WHERE _id_visitor = '$idFilter' AND _tgl_dcu = '$tglFilter'");
		}

		//Simpan Data Pengguna
		function simpanDataPengguna($id, $username, $password, $level){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$userFilter = mysqli_real_escape_string($this->koneksi, $username);
			$passwordFilter = mysqli_real_escape_string($this->koneksi, $password);
			$levelFilter = mysqli_real_escape_string($this->koneksi, $level);

			mysqli_query($this->koneksi,"INSERT INTO _tb_user VALUES ('$idFilter','$userFilter','$passwordFilter','$levelFilter')");
		}

		//Update Data Pengguna
		function updateDataPengguna($id, $level){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$levelFilter = mysqli_real_escape_string($this->koneksi, $level);

			mysqli_query($this->koneksi,"UPDATE _tb_user SET _level_user = '$levelFilter' WHERE _id_user = '$idFilter'");
		}

		//Update Data Pengguna
		function updatePassword($id, $password){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$passFilter = mysqli_real_escape_string($this->koneksi, $password);
		
			mysqli_query($this->koneksi,"UPDATE _tb_user SET _password = '$passFilter' WHERE _id_user = '$idFilter'");
		}

		//Simpan Data Perusahaan
		function simpanDataPerusahaan($id, $name){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$nameFilter = mysqli_real_escape_string($this->koneksi, $name);
			
			mysqli_query($this->koneksi,"INSERT INTO _tb_perusahaan VALUES ('$idFilter','$nameFilter')");
		}

		//Update Data Perusahaan
		function updatePerusahaan($id, $nama){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$namaFilter = mysqli_real_escape_string($this->koneksi, $nama);
		
			mysqli_query($this->koneksi,"UPDATE _tb_perusahaan SET _perusahaan = '$namaFilter' WHERE _id_perusahaan = '$idFilter'");
		}

		//Simpan Data Fungsi
		function simpanDataFungsi($id, $name){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$nameFilter = mysqli_real_escape_string($this->koneksi, $name);
			
			mysqli_query($this->koneksi,"INSERT INTO _tb_fungsi VALUES ('$idFilter','$nameFilter','0','0')");
		}

		//Update Data Fungsi
		function updateFungsi($id, $nama){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$namaFilter = mysqli_real_escape_string($this->koneksi, $nama);
		
			mysqli_query($this->koneksi,"UPDATE _tb_fungsi SET _nama_fungsi = '$namaFilter' WHERE _id_fungsi = '$idFilter'");
		}

		//Simpan Data MCU
		function simpanDataMCU($id, $tglMCU, $tglExpMCU){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$tglMCUFilter = mysqli_real_escape_string($this->koneksi, $tglMCU);
			$tglExpMCUFilter = mysqli_real_escape_string($this->koneksi, $tglExpMCU);
			
			mysqli_query($this->koneksi,"INSERT INTO _tb_mcu VALUES ('$idFilter','$tglMCUFilter','$tglExpMCUFilter')");
		}

		//Update Data MCU
		function updateDataMCU($id, $tglMCU, $tglExpMCU){
			$idFilter = mysqli_real_escape_string($this->koneksi, $id);
			$tglMCUFilter = mysqli_real_escape_string($this->koneksi, $tglMCU);
			$tglExpMCUFilter = mysqli_real_escape_string($this->koneksi, $tglExpMCU);
			
			mysqli_query($this->koneksi,"UPDATE _tb_mcu SET _tgl_mcu = '$tglMCUFilter', _tgl_kadaluarsa_mcu = '$tglExpMCUFilter' WHERE _id_pekerja = '$idFilter'");
		}


    }

?>