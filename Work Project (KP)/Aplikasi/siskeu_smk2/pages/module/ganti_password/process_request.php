<?
   session_start();
   //print_r($_SESSION);
   require_once("business/password.class.php");
   
   $old = $_POST['old'];
   $new = $_POST['new'];
   
   if($_SESSION['password']==$old){
      $change = new password;
      $change->update_password($new, $_SESSION['user']);
      echo "<b>Password Berhasil Diupdate</b>";
   } else {
      echo "<b>Pengupdetan Gagal, Password Lama Salah</b>";
   }
   
   
?>