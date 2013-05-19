<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/mysql_db.class.php");
	
	class data_siswa extends mysql_db{
		
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
											namaSiswa AS NAMA,
											nominalDPS AS DPS
										FROM
											 sis_siswa
									   LEFT JOIN
									       sis_nominal_dps ON nisSiswaDps = nisSiswa
										WHERE jenjangKelasSiswa='$klsJenjang' AND idKelasSiswa='$klsId'
										ORDER BY nisSiswa ASC");
		}
		
		function get_data_siswa_by_id($nis){
         return $this->execute("SELECT
                                  nisSiswa AS NIS,
                                  namaSiswa AS NAMA,
                                  jenjangKelasSiswa AS JENJANG,
                                  namaKelas AS KELAS,
                                  nominalDps AS DPS
                              FROM
                                  sis_siswa
                              LEFT JOIN sis_kelas ON idKelasSiswa = idKelas
                              LEFT JOIN sis_nominal_dps ON nisSiswaDps = nisSiswa
                              WHERE nisSiswa = '$nis'");
      }
		
		function add_siswa($nis, $nama, $jenjang, $kelas){  //echo $nis.$nama.$jenjang.$kelas;
		   return $this->execute("INSERT INTO sis_siswa VALUE('$nis','$nama','$nis','99','$jenjang','$kelas')");
      }
      
      function add_dps($nis, $dps){     //echo $nis.$dps;
         return $this->execute("INSERT INTO sis_nominal_dps VALUES('$nis','$dps')");
      }
      
      function update_siswa($nis, $nama, $jenjang, $kelas, $oldnis){  //echo $nis.$nama.$jenjang.$kelas.$oldnis;exit;
		   return $this->execute("UPDATE 
                                 sis_siswa
                               SET 
                                 nisSiswa = '$nis',
                                 namaSiswa = '$nama',
                                 jenjangKelasSiswa = '$jenjang',
                                 idKelasSiswa = '$kelas'
                              WHERE
                                 nisSiswa = '$oldnis' ");
      }
      
      function update_dps($nis, $dps, $oldnis){     //echo $nis.$dps;
         return $this->execute("UPDATE 
                                 sis_nominal_dps 
                              SET 
                                 nisSiswaDps = '$nis',
                                 nominalDps = '$dps'
                              WHERE
                                 nisSiswaDps = '$oldnis' ");
      }
	
	}
?>