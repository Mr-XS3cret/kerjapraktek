<?
require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/siswa.class.php");
require_once("business/input_iuran_tahunan.class.php");
//print_r($_POST);
if (trim($_POST['nis']) == '')
	$error[] = '-> Nomor Induk Harus Diisi';
if (trim($_POST['jumlah']) == '')
	$error[] = '-> Nominal Harus Diisi';
if ($_POST['iuran'] == '')
	$error[] = '-> Iuran Harus Dipilih Minimal Satu';
if (!is_numeric($_POST['jumlah']))
	$error[] = '-> Nominal Iuran harus diisi angka';
	
if ($error) {
	echo implode('<br />', $error);
} else {
	$nis=$_POST['nis'];
	$bayar=$_POST['jumlah'];
	$iuran = new inputIuranTahunan;
	$siswa = new siswa($nis);
	$siswa->get_jenjang_kelas_siswa();
	$result=$siswa->get_array();
	
	if(empty($result['Jenjang'])){
		echo "<b>Siswa dengan NIS : ".$_POST['nis']." tidak ditemukan</b>";
	} else {
		$i=0;
		while($i<count($_POST['iuran'])){
			$idIuran=$_POST['iuran'][$i];
							
			$iuran->get_nominal_iuran($idIuran);
			$nominal=$iuran->get_array();
			$jml_bayar=$nominal['Nominal'];
				
			if($bayar<$jml_bayar){
				echo "<b>Jumlah yang dibayarkan untuk -".$_POST['title'][$i]."- tidak mencukupi</b>";
				exit();
			} else {
				$iuran->update_rekap_iuran($nis, $idIuran, $jml_bayar);
				echo "<b>Data pembayaran -".$_POST['title'][$i]."- berhasil disubmit</b><br />";
			}
			$bayar=$bayar-$jml_bayar;
			$i++;
		}
		echo "<b>Sisa pembayaran : <b><strong>".number_format($bayar,2,',','.')."</strong>";
	}
}
?>