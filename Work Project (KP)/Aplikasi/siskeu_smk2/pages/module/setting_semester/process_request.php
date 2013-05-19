<?
session_start();
//print_r($_POST);
if($_POST['semester']==''){
   echo "<b>Silahkan Pilih Setting</b>";
}else{
$_SESSION['semester']=$_POST['semester'];
   echo "<b>Setting Semester Berhasil Dirubah</b>";
}
?>