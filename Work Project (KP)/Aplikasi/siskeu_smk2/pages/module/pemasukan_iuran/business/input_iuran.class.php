<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class inputIuran extends mysql_db{
		
		function display_jenis_iuran(){
			return $this->execute("SELECT 
									idJenisIuran AS ID, 
									namaJenisIuran AS NAMA 
								FROM 
									sis_nama_iuran 
								WHERE 
									JenisIuran = 'Bulanan'");
		}
		
		function get_nominal_iuran($kelas, $idIuran){
			$check=$this->execute("SELECT 
									IsGeneral 
								FROM 
									sis_nama_iuran 
								WHERE 
									idJenisIuran='$idIuran'");
			$checkResult=$this->get_array();
			
			if($checkResult=0){
				return $this->execute("SELECT
										nominalIuran AS Nominal 
									FROM 
										sis_nominal_iuran 
									WHERE 
										NominalJenjangKelas='$kelas' AND 
										idNominalJenisIuran='$idIuran'");
			}else{
				return $this->execute("SELECT	
										nominalIuran AS Nominal 
									FROM 
										sis_nominal_iuran 
									WHERE 
										idNominalJenisIuran='$idIuran'");
			}
		}
		
		function update_rekap_iuran($nis, $idIuran, $jml_bayar){
			return $this->execute("INSERT INTO sis_rekap_iuran VALUES ('$nis', '$idIuran', '$jml_bayar', NOW(), '')");
		}
	}
?>