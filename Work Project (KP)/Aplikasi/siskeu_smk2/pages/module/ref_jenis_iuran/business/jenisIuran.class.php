<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
		
	class jenisIuran extends mysql_db{
		
		function view_all(){
			return $this->execute("SELECT
									idJenisIuran AS Id, 
									namaJenisIuran AS Nama, 
									JenisIuran AS Jenis, 
									IF(NominalJenjangKelas, NominalJenjangKelas, '1-2-3') AS Jenjang, 
									nominalIuran AS Nominal, CONCAT(syaratUTS,'%') AS Syarat_UTS, 
									CONCAT(syaratUAS,'%') AS Syarat_UAS 
								FROM 
									sis_nama_iuran 
								JOIN 
									sis_nominal_iuran ON idNominalJenisIuran=idJenisIuran");
		}
	
		function get_iuran($idEd, $jenjang){
			if($jenjang=='1-2-3') $jenjang=0;
			return $this->execute("SELECT 
									idJenisIuran AS Id, 
									namaJenisIuran AS Nama, 
									JenisIuran AS Jenis, 
									NominalJenjangKelas AS Jenjang, 
									nominalIuran AS Nominal, 
									syaratUTS AS Syarat_UTS, 
									syaratUAS AS Syarat_UAS 
								FROM 
									sis_nama_iuran 
								JOIN 
									sis_nominal_iuran ON idNominalJenisIuran=idJenisIuran 
								WHERE 
									idJenisIuran='$idEd' AND 
									NominalJenjangKelas='$jenjang'");
		}
		
		function get_jenis(){
			return $this->execute("SELECT DISTINCT 
									JenisIuran AS Jenis_Iuran 
								FROM 
									sis_nama_iuran");
		}
	}
?>