<?
require_once("business/pengeluaran_setoran.class.php");

#print_r($_POST);exit();
if (trim($_POST['nominal']) == '')
	$error[] = '-> Nominal Setoran Harus Diisi';
if (trim($_POST['setoran']) == '')
	$error[] = '-> Jenis Setoran Harus Dipilih Salah Satu';
if (!is_numeric($_POST['nominal']))
	$error[] = '-> Nominal harus diisi angka';
if ($_POST['nominal']<1)
	$error[] = '-> Nominal tidak boleh 0 atau negatif';
	
if ($error) {
	echo implode('<br />', $error);
} else {
	$jmlSt = $_POST['nominal'];
	$idSt = $_POST['setoran'];
	$idTr = $_POST['idTr'];
	$ketSt = $_POST['ket'];
	$tglSt = $_POST['tanggal'];
	
	$st = new Setoran;
	$st->connect();
	$st->get_max_setoran($idSt);
	$maxSt = $st->get_array();
	
	if($_POST['btn']=='Insert'){
		if($jmlSt>$maxSt['maks']){
			echo "<b>Jumlah maksimal setoran yang diperbolehkan saat ini ".$maxSt['maks']."</b>";
			exit();
		} else {
			$st->insert_setoran($idSt, $jmlSt, $ketSt);
			echo "<b>Penyetoran dana sebesar ".$jmlSt." berhasil dilakukan</b>";
		}
	}
	elseif($_POST['btn']=='edit'){
		$st->update_setoran($idSt, $jmlSt, $tglSt, $ketSt, $idTr);
		echo "<b>Data berhasil diupdate</b>";
	}
}
?>