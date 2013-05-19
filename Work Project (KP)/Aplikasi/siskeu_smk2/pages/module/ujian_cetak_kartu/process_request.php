<?

//print_r($_POST); 
require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/siswa.class.php");
require_once("business/print_kartu.class.php");

$nis=$_POST['nis'];
if(!empty($_SESSION['semester'])){      
   $ujian = $_SESSION['semester'];
} else {
   $ujian='uts';
}

$siswa = new siswa($nis);
$siswa->get_jenjang_kelas_siswa();
$result=$siswa->get_array();

if(empty($result['Jenjang'])){
	echo "<b>Siswa dengan NIS : ".$_POST['nis']." tidak ditemukan</b>";
} else {
   $jenjangKelas = $result['Jenjang'];
   $cek = new cek_kartu;
   
   if($ujian=='uts'){
      $cek = $cek->cek_uts($nis, $jenjangKelas);
   } else {
      $cek = $cek->cek_uas($nis, $jenjangKelas);
   }
   if($cek==true){
      echo "SISWA DENGAN NIS ".$nis." DIPERBOLEHKAN IKUT UJIAN";
   } elseif($cek==false){
      echo "SISWA DENGAN NIS ".$nis." TIDAK DIPERBOLEHKAN IKUT UJIAN";
   } else {
      echo "OOPS....ERROR..CONTACT THE ADMINISTRATOR";
   }
}

?>