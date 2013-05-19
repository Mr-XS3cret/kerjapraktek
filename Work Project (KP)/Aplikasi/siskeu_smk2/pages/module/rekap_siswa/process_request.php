<?

require_once("business/rekap_siswa.class.php");
//print_r($_POST);
if (!is_numeric($_POST['nominal']))
	$error[] = '-> Nominal harus diisi angka';
if ($_POST['nominal']<0)
   $error[] = '-> Nominal tidak boleh 0 atau negatif';
   
if ($error) {
	echo implode('<br />', $error);
}else{
   $nis = $_POST['nis'];
   $nominal = $_POST['nominal'];
   $iuran = $_POST['iuran'];
   $idTr = $_POST['idTr'];

   $update = new rekap_siswa;
   
   $update->update_transaksi($nis, $nominal, $iuran, $idTr);
   echo "<b>Data Transaksi Berhasil Diupdate</b>";
}

?>