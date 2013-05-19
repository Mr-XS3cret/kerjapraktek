<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class blackList extends mysql_db{
		
		function get_black_list_uts(){
			return $this->execute("SELECT 
									nisSiswa AS NIS,
									namasiswa AS NAMA,
									CONCAT(jenjangKelasSiswa,' - ',namaKelas) AS KELAS,
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 1 AND nisSiswaRekap=nisSiswa) AS TOTAL_KOMITE
								FROM
									 sis_siswa
								LEFT OUTER JOIN
									 sis_rekap_iuran ON (nisSiswa=nisSiswaRekap)
								LEFT OUTER JOIN
									 sis_nominal_dps ON (nisSiswa=nisSiswaDps)
								LEFT JOIN
									 sis_kelas ON (idKelasSiswa=idKelas) 
								WHERE
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 1 AND nisSiswaRekap=nisSiswa) IS NULL OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 1 AND nisSiswaRekap=nisSiswa) 
										< 
									(SELECT nominalIuran FROM sis_nominal_iuran WHERE idNominalJenisIuran=1 AND NominalJenjangKelas=jenjangKelasSiswa)*12*0.5
								GROUP BY nisSiswa
                        ORDER BY nisSiswa");
		}
		
		function get_black_list_uas(){
			return $this->execute("SELECT 
									nisSiswa AS NIS,
									namasiswa AS NAMA,
									CONCAT(jenjangKelasSiswa,' - ',namaKelas) AS KELAS,
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 1 AND nisSiswaRekap=nisSiswa) AS TOTAL_KOMITE,
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 2 AND nisSiswaRekap=nisSiswa) AS TOTAL_TA,
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 3 AND nisSiswaRekap=nisSiswa) AS TOTAL_PRAKERIN,
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 4 AND nisSiswaRekap=nisSiswa) AS TOTAL_OSIS,
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 5 AND nisSiswaRekap=nisSiswa) AS TOTAL_DPS
								FROM
									sis_siswa
								LEFT OUTER JOIN
									sis_rekap_iuran ON (nisSiswa=nisSiswaRekap)
								LEFT OUTER JOIN
									sis_nominal_dps ON (nisSiswa=nisSiswaDps)
								LEFT JOIN
									sis_kelas ON (idKelasSiswa=idKelas) 
								WHERE
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 1 AND nisSiswaRekap=nisSiswa) IS NULL OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 1 AND nisSiswaRekap=nisSiswa) < 
									(SELECT nominalIuran FROM sis_nominal_iuran WHERE idNominalJenisIuran=1 AND NominalJenjangKelas=jenjangKelasSiswa)*12
									 OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 2 AND nisSiswaRekap=nisSiswa) IS NULL OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 2 AND nisSiswaRekap=nisSiswa) < 
									(SELECT nominalIuran FROM sis_nominal_iuran WHERE idNominalJenisIuran=2 AND NominalJenjangKelas=jenjangKelasSiswa)*12
									 OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 3 AND nisSiswaRekap=nisSiswa) IS NULL OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 3 AND nisSiswaRekap=nisSiswa) < 
									(SELECT nominalIuran FROM sis_nominal_iuran WHERE idNominalJenisIuran=3 AND NominalJenjangKelas=jenjangKelasSiswa)
									 OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 4 AND nisSiswaRekap=nisSiswa) IS NULL OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 4 AND nisSiswaRekap=nisSiswa) < 
									(SELECT nominalIuran FROM sis_nominal_iuran WHERE idNominalJenisIuran=4 AND NominalJenjangKelas=jenjangKelasSiswa)
									 OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 5 AND nisSiswaRekap=nisSiswa) IS NULL OR
									(SELECT SUM(nominalRekap) FROM sis_rekap_iuran WHERE idIuranRekap = 5 AND nisSiswaRekap=nisSiswa) < 
									(SELECT nominalDps FROM sis_nominal_dps WHERE nisSiswaDps=nisSiswa)
								GROUP BY nisSiswa
                        ORDER BY nisSiswa");
		}
		
	}
?>