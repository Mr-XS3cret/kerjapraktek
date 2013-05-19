<?
//print_r($_POST); exit;
require_once("business/pengeluaran_bon.class.php");

if ($_POST['btn']=='Detil'){
   if (!is_numeric($_POST['jml_byr']))
      $error[] = '-> Nominal Pembayaran harus diisi angka';
   if ($_POST['jml_byr']<0)
   	$error[] = '-> Nominal Pembayaran tidak boleh negatif';
} elseif ($_POST['btn']=='Clear'){
   if (!is_numeric($_POST['new_bayar']))
   	$error[] = '-> Nominal Cicilan harus diisi angka';
   if ($_POST['new_bayar']<1)
   	$error[] = '-> Nominal Cicilan tidak boleh 0 atau negatif';
} else {
   if (!is_numeric($_POST['jml_pnjm']))
	   $error[] = '-> Nominal Peminjaman harus diisi angka';
   if ($_POST['jml_pnjm']<0)
	   $error[] = '-> Nominal Tidak Boleh Negatif';
   if (trim($_POST['nama'])== "")
      $error[] = '-> Nama Peminjam tidak boleh kosong';
}

if ($error) {
	echo implode('<br />', $error);
}else{
   $pay = new Peminjaman;
   $pay->connect(); 
   
   $id = $_POST['idPj'];
   $bayar = $_POST['new_bayar'];
   $nama = $_POST['nama'];
   $tanggal = $_POST['tanggal'];
   $nominal = $_POST['jml_pnjm'];
   $Editbayar = $_POST['jml_byr'];
   
   if ($_POST['btn']=='Clear'){
      $pay->pembayaran_baru($id, $bayar);
      echo "<b>Data Cicilan Peminjaman Berhasil Diupdate</b>";
   } elseif ($_POST['btn']=='Edit') {
      $pay->update_peminjaman($id, $tanggal, $nama, $nominal);
      echo "<b>Data Peminjaman Berhasil Diupdate</b>";
   } elseif ($_POST['btn']=='Insert') {
      $pay->insert_peminjaman($nama, $nominal);
      echo "<b>Data Peminjaman Berhasil Dimasukkan</b>";
   } elseif ($_POST['btn']=='Detil') {
      $pay->update_cicilan($id, $Editbayar);
      echo "<b>Data Peminjaman Berhasil Diupdate</b>";
   }
}
	
?>