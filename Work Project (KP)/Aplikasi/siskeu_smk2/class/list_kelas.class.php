<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class list_kelas extends mysql_db{
	
		function get_list_kelas(){
			return $this->execute("SELECT 
											idKelas AS ID,
											namaKelas AS NAMA
										FROM 
											sis_kelas");
		}
	
	}
?>