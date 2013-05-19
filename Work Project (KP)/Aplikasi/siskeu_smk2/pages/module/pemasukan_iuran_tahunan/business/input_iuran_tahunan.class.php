<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class inputIuranTahunan extends mysql_db{
		
		function display_jenis_iuran_tahunan(){
			return $this->execute("SELECT idJenisIuran AS ID, namaJenisIuran AS NAMA FROM sis_nama_iuran WHERE JenisIuran = 'Tahunan'");
		}
		
		function get_nominal_iuran($idIuran){
			return $this->execute("SELECT	nominalIuran AS Nominal FROM sis_nominal_iuran WHERE idNominalJenisIuran='$idIuran'");
		}
				
		function update_rekap_iuran($nis, $idIuran, $jml_bayar){
			return $this->execute("INSERT INTO sis_rekap_iuran VALUES ('$nis', '$idIuran', '$jml_bayar', NOW(), '')");
		}
	}
?>