<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class inputIuranDps extends mysql_db{
		
		function display_dps(){
			return $this->execute("SELECT idJenisIuran AS ID, namaJenisIuran AS NAMA FROM sis_nama_iuran WHERE JenisIuran = 'Sumbangan'");
		}
		
		function get_nominal_dps($idSiswa){
			return $this->execute("SELECT	nominalDps AS Nominal FROM sis_nominal_dps WHERE nisSiswaDps='$idSiswa'");
		}
		
		function update_rekap_iuran($nis, $idIuran, $jml_bayar){
			return $this->execute("INSERT INTO sis_rekap_iuran VALUES ('$nis', '$idIuran', '$jml_bayar', NOW(), '')");
		}
	}
?>