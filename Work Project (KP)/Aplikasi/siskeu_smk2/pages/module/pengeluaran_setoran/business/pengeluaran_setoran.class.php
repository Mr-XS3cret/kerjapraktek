<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class Setoran extends mysql_db{
		
		function display_jenis_setoran(){
			return $this->execute("SELECT 
											idJenisIuran AS ID, 
											CONCAT('Setoran ',namaJenisIuran) AS NAMA 
										FROM sis_nama_iuran");
		}
		
		function get_rekap_setoran(){
			return $this->execute("SELECT
											id AS ID,
											nama_setoran AS NAMA_SETORAN,
											SUM(jumlah_masuk) AS JUMLAH_MASUK,
											SUM(jumlah_disetorkan) AS JUMLAH_DISETORKAN,
											SUM(jumlah_masuk) - SUM(jumlah_disetorkan) AS JUMLAH_SISA
										FROM (
											SELECT
												idJenisIuran AS id,
												namaJenisIuran AS nama_setoran,
												IF(SUM(nominalRekap),SUM(nominalRekap),0) AS jumlah_masuk,
												0 AS jumlah_disetorkan
											      FROM
												sis_nama_iuran
											LEFT JOIN sis_rekap_iuran ON idJenisIuran=idIuranRekap
											GROUP BY idJenisIuran
												
											UNION
											      
											SELECT
												idJenisIuran AS id,
												namaJenisIuran AS nama_setoran,
												0 AS jumlah_masuk,
												IF(SUM(nominalRekapSetoran),SUM(nominalRekapSetoran),0) AS jumlah_disetorkan
											      FROM
												sis_nama_iuran
											LEFT JOIN sis_rekap_setoran ON idJenisIuran=idNamaRekapSetoran
											GROUP BY idJenisIuran
												) tmp
										GROUP BY id
										ORDER BY id ASC");
		}
		
		function get_nama_setoran($idSetoran){
			return $this->execute("SELECT
											namaJenisIuran AS NAMA
										FROM
											sis_nama_iuran
										WHERE
											idJenisIuran='$idSetoran'");
		}
		
		function get_history_setoran_detil($idSetoran){
			return $this->execute("SELECT 
											idRekapSetoran AS ID,
											tanggalPenyetoran AS TANGGAL,
											nominalRekapSetoran AS TOTAL,
											keterangan AS KETERANGAN
										FROM
											sis_rekap_setoran
										WHERE idNamaRekapSetoran = $idSetoran");
		}
		
		function get_max_setoran($idSetoran){					//echo "param = ".$idSetoran;
			return $this->execute("SELECT
											SUM(rekap) - SUM(setoran) AS maks
										FROM (
											SELECT 
											   SUM(nominalRekap) AS rekap,
											   0 AS setoran
											FROM sis_rekap_iuran WHERE idIuranRekap='$idSetoran' 
											   
											UNION 
											   
											SELECT 
											   0 AS rekap,
											   SUM(nominalRekapSetoran) AS setoran
											FROM sis_rekap_setoran WHERE idNamaRekapSetoran='$idSetoran'
										) tmp");
		}
		
		function get_detil_transaksi_st($idTr){ 								//echo "param = ".$idTr;
			return $this->execute("SELECT
											idRekapSetoran As ID_TR,
											tanggalPenyetoran AS TANGGAL,
											idNamaRekapSetoran AS ID_NAMA,
											nominalRekapSetoran AS NOMINAL,
											keterangan AS KETERANGAN
										FROM
											sis_nama_iuran
										JOIN sis_rekap_setoran ON idJenisIuran = idNamaRekapSetoran
										WHERE idRekapSetoran = '$idTr'");			
		}
		
		function insert_setoran($idSetoran, $nominal, $ket){			//echo "param = ".$idSetoran." - ".$nominal." - ".$ket;
			return $this->execute("INSERT INTO sis_rekap_setoran VALUES('', '$idSetoran', '$nominal', NOW(), '$ket')");
		}
		
		function update_setoran($idSt, $jmlTr, $tglTr, $ket, $idTr){
			return $this->execute("UPDATE 
											sis_rekap_setoran
										SET 
											idNamaRekapSetoran = '$idSt',
											nominalRekapSetoran = '$jmlTr',
											tanggalPenyetoran = '$tglTr',
											keterangan = '$ket'
										WHERE idRekapSetoran='$idTr'");
		}
	}
?>