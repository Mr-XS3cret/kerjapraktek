<?
require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/siswa.class.php");
require_once("business/input_iuran.class.php");
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
	$siswa = new siswa($_POST['nis']);
	$iuran = new inputIuran;
	$siswa->get_jenjang_kelas_siswa();
	$result=$siswa->get_array();
	
	$nis=$_POST['nis'];
	$bayar=$_POST['jumlah'];
	
	if (empty($result['Jenjang'])){
		echo "<b>Siswa dengan NIS : ".$_POST['nis']." Tidak Ditemukan</b>";
	} else {	
		$i=0;
		while($i<count($_POST['iuran'])){
			$bulan="bulan_".$_POST['iuran'][$i];
			$idIuran=$_POST['iuran'][$i];
								
			if (empty($_POST[$bulan])){
				echo "<b>Bulan harus diisi<b><br />";
				exit();
			} else {
				$iuran->get_nominal_iuran($result['Jenjang'], $idIuran);
				$nominal=$iuran->get_array();
				$jml_bayar=$nominal['Nominal']*$_POST[$bulan];
				
				if($bayar<$jml_bayar){
					echo "<b>Jumlah yang dibayarkan untuk - ".$_POST['title'][$i]." - tidak mencukupi<br /></b>";
				} else {
					$iuran->update_rekap_iuran($nis, $idIuran, $jml_bayar);
					echo "<b>Data pembayaran - ".$_POST['title'][$i]." - berhasil  disubmit</b><br />";
					$bayar=$bayar-($nominal['Nominal']*$_POST[$bulan]);
				}
			}
			$i++;
		}
		echo "<b>Sisa pembayaran : <b><strong>".number_format($bayar,2,',','.')."</strong>";
	}
}
?>