<?

require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");

class cek_kartu extends mysql_db{

   function cek_uts($nis, $jenjangKelas){
        $this->execute("SELECT 
                        SUM(nominalRekap) as total 
                     FROM 
                        sis_rekap_iuran 
                     WHERE 
                        idIuranRekap=1 AND 
                        nisSiswaRekap='$nis'");
        
         $totalIuran = $this->get_array();
                                       
         $this->execute("SELECT 
                           (SELECT 
                              nominalIuran 
                           FROM 
                              sis_nominal_iuran 
                           WHERE 
                              idNominalJenisIuran=1 AND 
                              NominalJenjangKelas='$jenjangKelas')*6 AS syarat");
         
         $syaratIuran = $this->get_array();
         
         if($totalIuran['total']<$syaratIuran['syarat']){
            return false;
         } else {
            return true;
         }
      
   }
   
   function cek_uas($nis, $jenjangKelas){
   
   }

}

?>