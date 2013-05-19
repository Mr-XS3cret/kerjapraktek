<?
   require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
   
   class password extends mysql_db{
   
      function update_password($new, $nama){
         return $this->execute("UPDATE pub_user SET passwordUser = '$new' WHERE namaUser = '$nama'");
      }
   
   }
?>