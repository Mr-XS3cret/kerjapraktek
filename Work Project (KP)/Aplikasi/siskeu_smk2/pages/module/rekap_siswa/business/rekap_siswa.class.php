<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class rekap_siswa extends mysql_db{
	
		function get_kelas_detil($klsId){
			return $this->execute("SELECT
									namaKelas AS NAMA
								FROM
									sis_kelas
								WHERE idKelas='$klsId'");
		}
		
		function get_list_siswa($klsJenjang, $klsId){			
			return $this->execute("SELECT 
									nisSiswa AS NIS,
									namasiswa AS NAMA,
									  (SELECT 
											SUM(nominalRekap) 
										FROM 
											sis_rekap_iuran 
										WHERE 
											idIuranRekap = 1 AND 
											nisSiswaRekap=nisSiswa) AS TOTAL_KOMITE,
										(SELECT 
											SUM(nominalRekap) 
										FROM 
											sis_rekap_iuran 
										WHERE 
											idIuranRekap = 2 AND 
											nisSiswaRekap=nisSiswa) AS TOTAL_TA,
										(SELECT 
											SUM(nominalRekap) 
										FROM 
											sis_rekap_iuran 
										WHERE 
											idIuranRekap = 3 AND 
											nisSiswaRekap=nisSiswa) AS TOTAL_PRAKERIN,
										(SELECT 
											SUM(nominalRekap) 
										FROM 
											sis_rekap_iuran 
										WHERE idIuranRekap = 4 AND 
											nisSiswaRekap=nisSiswa) AS TOTAL_OSIS,
										(SELECT 
											SUM(nominalRekap) 
										FROM 
											sis_rekap_iuran 
										WHERE 
											idIuranRekap = 5 AND 
											nisSiswaRekap=nisSiswa) AS TOTAL_DPS,
									nominalDPS AS NoMINAL_DPS
								FROM
									sis_siswa
								LEFT OUTER JOIN
									sis_rekap_iuran ON (nisSiswa=nisSiswaRekap) 
								LEFT OUTER JOIN
									sis_nominal_dps ON (nisSiswa=nisSiswaDps)
								WHERE
									jenjangKelasSiswa = '$klsJenjang' AND
									idKelasSiswa = '$klsId'
								GROUP BY nisSiswa");
		}
		
		function get_siswa($nis){
			return $this->execute("SELECT 
									nisSiswa AS NIS,
									namaSiswa AS NAMA,
									jenjangKelasSiswa AS JENJANG,
									namaKelas AS KELAS
								FROM
									sis_siswa
								JOIN
									sis_kelas ON idKelasSiswa=idKelas
								WHERE
									nisSiswa='$nis'");
		}
	
		function get_rekap_siswa_detil($nis){
			return $this->execute("SELECT
									namaJenisIuran AS NAMA_IURAN,
									SUM(nominalRekap) AS NOMINAL
								FROM
									sis_rekap_iuran
								LEFT JOIN
									sis_nama_iuran ON idJenisIuran=idIuranRekap
								WHERE 
									nisSiswaRekap='$nis'
								GROUP BY idiuranRekap");
		}
		
		function get_list_transaksi($nis){
			return $this->execute("SELECT 
									tanggal AS TANGGAL,
									CONCAT('Pembayaran ', namaJenisIuran) AS TRANSAKSI,
									nominalRekap AS TOTAL,
									idRekapSiswa AS ID_TRANS
								FROM
									sis_rekap_iuran
								JOIN
									sis_nama_iuran ON idIuranRekap = idJenisIuran
								WHERE 
									nisSiswaRekap = '$nis'
								ORDER BY tanggal DESC");
		}
		
		function get_detail_transaksi($idTr){
         return $this->execute("SELECT 
                                   nisSiswaRekap AS NIS,
                                   namaSiswa AS NAMA,
                                   tanggal AS TANGGAL,
                                   idIuranRekap AS ID_TRANS,
                                   nominalRekap AS NOMINAL
                              FROM
                                   sis_rekap_iuran
                              JOIN 
                                   sis_siswa ON nisSiswa=nisSiswaRekap
                              WHERE
                                   idRekapSiswa = '$idTr'");
      }
      
      function display_iuran(){
			return $this->execute("SELECT 
											idJenisIuran AS ID, 
											namaJenisIuran AS NAMA 
										FROM sis_nama_iuran");
		}
		
		function update_transaksi($nis, $nominal, $iuran, $idTr){   // echo $nis.$iuran.$nominal.$idTr;
         return $this->execute("UPDATE 
                                 sis_rekap_iuran
                              SET 
                                 nisSiswaRekap='$nis',
                                 idIuranRekap='$iuran',
                                 nominalRekap='$nominal'
                              WHERE 
                                 idRekapSiswa='$idTr'");
         
      }
	}
?>