<?
require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/siswa.class.php");
require_once("business/input_iuran_dps.class.php");
//print_r($_POST);
if (trim($_POST['nis']) == '')
	$error[] = '-> Nomor Induk Harus Diisi';
if (trim($_POST['jumlah']) == '')
	$error[] = '-> Nominal Harus Diisi';
if (!is_numeric($_POST['jumlah']))
	$error[] = '-> Nominal harus diisi angka';
if ($_POST['jumlah']<1)
	$error[] = '-> Nominal tidak boleh 0 atau negatif';
	
if ($error) {
	echo implode('<br />', $error);
} else {
	$nis=$_POST['nis'];
	$bayar=$_POST['jumlah'];
	
	$iuran = new inputIuranDps;
	// $iuran->get_nominal_dps($nis);
	// $nominal=$iuran->get_array();
	
	$siswa = new siswa($_POST['nis']);
	$siswa->get_jenjang_kelas_siswa();
	$result=$siswa->get_array();
	
	if(empty($result['Jenjang'])){
		echo "<b>Siswa dengan NIS : ".$_POST['nis']." tidak ditemukan</b>";
	} else {
		$idIuran=$_POST['dps'];
		//$jml_bayar=$nominal['Nominal'];
			
		$iuran->update_rekap_iuran($nis, $idIuran, $bayar);
		$i++;
		
		echo "<b>pembayaran DPS sebesar ".number_format($bayar,2,',','.')." berhasil disubmit</b><br />";
	}
}
?>