<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class rekap_siswa extends mysql_db{
	
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
								ORDER BY tanggal DESC, namaJenisIuran ASC");
		}
		
	}
?>