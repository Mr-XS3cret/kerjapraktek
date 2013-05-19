<?
	require_once("mysql_db.class.php");
	
	class siswa extends mysql_db{
		private $nis_siswa;
		
		function siswa($nis){
			$this->nis_siswa = $nis;
		}
		
		function get_jenjang_kelas_siswa(){
			return $this->execute("SELECT jenjangKelasSiswa AS Jenjang FROM sis_siswa WHERE nisSiswa='$this->nis_siswa'");
		}
		
	}
?>