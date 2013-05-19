<?php

//print_r($_POST);exit;
require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/siswa.class.php");
require_once("business/data_siswa.class.php");

if($_POST['btn']=='tambah_kelas'){
   if (trim($_POST['kelas']) == '')
      $error[] = '-> Kelas Harus Diisi';
} elseif ($_POST['btn']=='tambah_siswa' || $_POST['btn']=='edit_siswa') {
   if (trim($_POST['nis']) == '')
	   $error[] = '-> Nomor Induk Harus Diisi';
   if (trim($_POST['nama']) == '')
      $error[] = '-> Nama Siswa Harus Diisi';
   if ($_POST['jenjang'] == '')
      $error[] = '-> Jenjang Kelas Harus Diisi';
   if (trim($_POST['kelas']) == '')
      $error[] = '-> Kelas Harus Diisi';
   if (!is_numeric($_POST['dps']))
   	$error[] = '-> Nominal DPS harus diisi angka';
   if (strlen($_POST['nis'])>8)
      $error[] = '->NIS Terlalu Panjang';
}


	
if ($error) {
	echo implode('<br />', $error);
}else{
   if($_POST['btn']=='tambah_kelas'){
      $nama_kelas = $_POST['nama_kelas'];
      
   } else {
      $oldnis = $_POST['oldnis'];
      $nis = $_POST['nis'];
      $nama = $_POST['nama'];
      $jenjang = $_POST['jenjang'];
      $idKelas = $_POST['kelas'];
      $dps = $_POST['dps'];         
      
       //print_r($hasil);exit;
      $siswa = new data_siswa;
      
      $check = new siswa($nis);
      $check->get_jenjang_kelas_siswa();
   	$result=$check->get_array();   
   	
   	//print_r($result);exit;
   	
   	if($_POST['btn']=='tambah_siswa'){
   	   if(empty($result['Jenjang'])){
            $siswa->add_siswa($nis,$nama,$jenjang,$idKelas);
            $siswa->add_dps($nis,$dps); 
            echo "<b>Penambahan Data Berhasil Dilakukan </b>";
         } else {
            echo "<b>Penambahan Data Gagal, NIS sudah terpakai</b>";   
         }
      }elseif($_POST['btn']=='edit_siswa'){
         if(empty($result['Jenjang']) || $nis==$oldnis){
            $siswa->update_siswa($nis,$nama,$jenjang,$idKelas,$oldnis);
            $siswa->update_dps($nis,$dps,$oldnis); 
            echo "<b>Update Data Berhasil Dilakukan </b>";
         } else {
            echo "<b>Update Data Gagal, NIS sudah terpakai</b>";   
         }
      }     
   }
}

?>